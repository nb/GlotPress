<?php
gp_title( $kind == 'originals'?
 	sprintf( __('Import Originals &lt; %s &lt; GlotPress'), esc_html( $project->name ) ) :
	sprintf( __('Import Translations &lt; %s &lt; GlotPress'), esc_html( $project->name ) ) );
gp_breadcrumb( array(
	gp_link_project_get( $project, $project->name ),
	$kind == 'originals'? __('Import Originals') : __('Import Translations'),
) );
gp_tmpl_header();
?>
<form action="" method="post" enctype="multipart/form-data">
	<dl>
	<dt><label for="import-file"><?php _e('Import File:'); ?></label></dt>
	<dd><input type="file" name="import-file" id="import-file" /></dd>
<?php
	$format_slugs = array_keys( GP::$formats );
	$format_dropdown = gp_select( 'format', array_combine( $format_slugs, $format_slugs ), 'po' );
?>
	<dt><label	for="format"><?php _e('Format:'); ?></label></dt>
	<dd><?php echo $format_dropdown; ?></dd>
	<dt><input type="submit" value="<?php echo esc_attr( __('Import') ); ?>"></dt>
</form>
<?php gp_tmpl_footer(); ?>