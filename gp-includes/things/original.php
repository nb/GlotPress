<?php
class GP_Original extends GP_Thing {

	var $table_basename = 'originals';
	var $field_names = array( 'id', 'context', 'singular', 'plural', 'comment', 'priority', 'date_added' );
	var $non_updatable_attributes = array( 'id', 'path' );

    static $priorities = array( '-2' => 'hidden', '-1' => 'low', '0' => 'normal', '1' => 'high' );
	static $count_cache_group = 'active_originals_count_by_project_id';

	function restrict_fields( $original ) {
		$original->singular_should_not_be('empty');
		$original->priority_should_be('int');
		$original->priority_should_be('between', -2, 1);
	}

	function normalize_fields( $args ) {
		$args = (array)$args;
		foreach ( array('plural', 'context', 'comment') as $field ) {
			if ( isset( $args['parent_project_id'] ) ) {
				$args[$field] = $this->force_false_to_null( $args[$field] );
			}
		}

		if ( isset( $args['priority'] ) && !is_numeric( $args['priority'] ) ) {
			$args['priority'] = $this->priority_by_name( $args['priority'] );
			if ( is_null( $args['priority'] ) ) {
				unset( $args['priority'] );
			}
		}

		return $args;
	}

	function by_project_id( $project_id ) {
		global $gpdb;
		return $this->many( "SELECT * FROM $this->table AS o INNER JOIN $gpdb->project_original AS po ON o.id = po.original_id WHERE po.project_id= %d AND po.active = 1", $project_id );
	}

	function count_by_project_id( $project_id ) {
		global $gpdb;
		if ( false !== ( $cached = wp_cache_get( $project_id, self::$count_cache_group ) ) ) {
			return $cached;
		}
		$count = $this->value( "SELECT COUNT(*) FROM $this->table AS o INNER JOIN $gpdb->project_original AS po ON o.id = po.original_id WHERE po.project_id= %d AND po.active = 1", $project_id );
		wp_cache_set( $project_id, $count, self::$count_cache_group );
		return $count;
	}


	function by_project_id_and_entry( $project_id, $entry, $active = null ) {
		global $gpdb;
		$where = array();
		// now each condition has to contain a %s not to break the sequence
		$where[] = is_null( $entry->context )? '(context IS NULL OR %s IS NULL)' : 'BINARY context = %s';
		$where[] = 'BINARY singular = %s';
		$where[] = is_null( $entry->plural )? '(plural IS NULL OR %s IS NULL)' : 'BINARY plural = %s';
		if ( !is_null( $status ) ) $where[] = $gpdb->prepare( 'active = %d', $active );
		$where = implode( ' AND ', $where );
		return $this->one( "SELECT * FROM $this->table AS o INNER JOIN $gpdb->project_original AS po ON o.id = po.original_id AND po.project_id = %d WHERE $where", $project_id, $entry->context, $entry->singular, $entry->plural );
	}

	function import_for_project( $project, $translations ) {
		global $gpdb;
		wp_cache_delete( $project->id, self::$count_cache_group );

		$originals_added = $originals_existing = $originals_obsoleted = 0;

		$all_originals_for_project = $this->many_no_map( "SELECT o.*, po.* FROM $this->table AS o INNER JOIN $gpdb->project_original AS po ON o.id = po.original_id WHERE po.project_id= %d", $project->id );
		$originals_by_key = array();
		foreach( $all_originals_for_project as $original ) {
			$entry = new Translation_Entry( array( 'singular' => $original->singular, 'plural' => $original->plural, 'context' => $original->context ) );
			$originals_by_key[$entry->key()] = $original;
		}

		foreach( $translations->entries as $entry ) {
			$gpdb->queries = array();
			$original_data = array( 'context' => $entry->context, 'singular' => $entry->singular,
				'plural' => $entry->plural, 'comment' => $entry->extracted_comments );
			$project_data = array(
				'references' => implode( ' ', $entry->references ),
				'active' => 1,
			);
			$original_data = apply_filters( 'import_original_array', $original_data );
			$original_data = apply_filters( 'import_original_data_array', $original_data );
			$project_data = apply_filters( 'import_project_data_array', $project_data );

			// TODO: do not obsolete similar translations
			if ( isset( $originals_by_key[$entry->key()] ) ) {
				$original = $originals_by_key[$entry->key()];

				// we are using != instead of !== on purpose, falsy values can be very different
				// also, false positives are OK< because they will only cost us an extra update
				if ( $original_data['comment'] != $original->comment ) {
					$this->update( array( 'comment' => $original_data['comment'] ) , array( 'id' => $original->id ) );
				}

				if ( $project_data['references'] != $original->references || $project_data['active'] != $original->active ) {
					$gpdb->update( $gpdb->project_original,
						array( 'references' => $project_data['references'], 'active' => (int)$project_data['active'] ),
						array( 'project_id' => $project->id, 'original_id' => $original->id )
					);
				}

				$originals_existing++;
			}
			else {
				$new_original = GP::$original->create( $original_data );
				$gpdb->insert( $gpdb->project_original, array_merge( $project_data, array( 'project_id' => $project->id, 'original_id' => $new_original->id ) ) );
				$originals_added++;
			}
		}

		// Mark previously active, but now removed strings as obsolete
		foreach ( $originals_by_key as $key => $value) {
			if ( ! key_exists( $key, $translations->entries ) && $value->active ) {
				$gpdb->update( $gpdb->project_original, array( 'active' => 0 ), array( 'original_id' => $value->id, 'project_id' => $project->id ) );
				$originals_obsoleted++;
			}
		}

		// Clear cache when the amount of strings are changed
		if ( $originals_added > 0 || $originals_obsoleted > 0 ) {
			gp_clean_translation_sets_cache( $project->id );
		}

		do_action( 'originals_imported', $project->id, $originals_added, $originals_existing, $originals_obsoleted );

		return array( $originals_added, $originals_existing );
	}

	function priority_by_name( $name ) {
		$by_name = array_flip( self::$priorities );
		return isset( $by_name[$name] )? $by_name[$name] : null;
	}
}
GP::$original = new GP_Original();
