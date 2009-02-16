<?php
/**
 * Class for a set of entries for translation and their associated headers
 *
 * @version $Id$
 * @package pomo
 * @subpackage translations
 */

require_once dirname(__FILE__) . '/entry.php';

class Translations {
	var $entries = array();
	var $headers = array();

	/**
	 * Add entry to the PO structure
	 *
	 * @param object &$entry
	 * @return bool true on success, false if the entry doesn't have a key
	 */
	function add_entry(&$entry) {
		$key = $entry->key();
		if (false === $key) return false;
		$this->entries[$key] = &$entry;
		return true;
	}

	/**
	 * Sets $header PO header to $value
	 *
	 * If the header already exists, it will be overwritten
	 *
	 * TODO: this should be out of this class, it is gettext specific
	 *
	 * @param string $header header name, without trailing :
	 * @param string $value header value, without trailing \n
	 */
	function set_header($header, $value) {
		$this->headers[$header] = $value;
	}

	function set_headers(&$headers) {
		foreach($headers as $header => $value) {
			$this->set_header($header, $value);
		}
	}

	function get_header($header) {
		return isset($this->headers[$header])? $this->headers[$header] : false;
	}

	function translate_entry(&$entry) {
		$key = $entry->key();
		return isset($this->entries[$key])? $this->entries[$key] : false;
	}

	function translate($singular, $context=null) {
		$entry = new Translation_Entry(array('singular' => $singular, 'context' => $context));
		$translated = $this->translate_entry($entry);
		return ($translated && !empty($translated->translations))? $translated->translations[0] : $singular;
	}

	/**
	 * Given the number of items, returns the 0-based index of the plural form to use
	 *
	 * Here, in the base Translations class, the commong logic for English is implmented:
	 * 	0 if there is one element, 1 otherwise
	 *
	 * This function should be overrided by the sub-classes. For example MO/PO can derive the logic
	 * from their headers.
	 *
	 * @param integer $count number of items
	 */
	function select_plural_form($count) {
		return 1 == $count? 0 : 1;
	}

	function get_plural_forms_count() {
		return 2;
	}

	function translate_plural($singular, $plural, $count, $context = null) {
		$entry = new Translation_Entry(array('singular' => $singular, 'plural' => $plural, 'context' => $context));
		$translated = $this->translate_entry($entry);
		$index = $this->select_plural_form($count);
		$total_plural_forms = $this->get_plural_forms_count();
		if ($translated && 0 <= $index && $index < $total_plural_forms &&
				is_array($translated->translations) &&
				count($translated->translations) == $total_plural_forms)
			return $translated->translations[$index];
		else
			return 1 == $count? $singular : $plural;
	}

	/**
	 * The gettext implmentation of select_plural_form.
	 *
	 * It lives in this class, because there are more than one descendand, which will use it and
	 * they can't share it effectively.
	 *
	 */
	function gettext_select_plural_form($count) {
		if (!isset($this->_gettext_select_plural_form) || is_null($this->_gettext_select_plural_form)) {
			$plural_header = $this->get_header('Plural-Forms');
			$this->_gettext_select_plural_form = $this->_make_gettext_select_plural_form($plural_header);
		}
		return call_user_func($this->_gettext_select_plural_form, $count);
	}

	/**
	 * Makes a function, which will return the right translation index, according to the
	 * plural forms header
	 */
	function _make_gettext_select_plural_form($plural_header) {
		$res = create_function('$count', 'return 1 == $count? 0 : 1;');
		if ($plural_header && (preg_match('/^\s*nplurals\s*=\s*(\d+)\s*;\s+plural\s*=\s*(.+)$/', $plural_header, $matches))) {
			$nplurals = (int)$matches[1];
			$this->_nplurals = $nplurals;
			$plural_expr = trim($this->_parenthesize_plural_exression($matches[2]));
			$plural_expr = str_replace('n', '$n', $plural_expr);
			$func_body = "
				\$index = (int)($plural_expr);
				return (\$index < $nplurals)? \$index : $nplurals - 1;";
			$res = create_function('$n', $func_body);
		}
		return $res;
	}

	/**
	 * Adds parantheses to the inner parts of ternary operators in
	 * plural expressions, because PHP evaluates ternary oerators from left to right
	 * 
	 * @param string $expression the expression without parentheses
	 * @return string the expression with parentheses added
	 */
	function _parenthesize_plural_exression($expression) {
		$expression .= ';';
		$res = '';
		$depth = 0;
		for ($i = 0; $i < strlen($expression); ++$i) {
			$char = $expression[$i];
			switch ($char) {
				case '?':
					$res .= ' ? (';
					$depth++;
					break;
				case ':':
					$res .= ') : (';
					break;
				case ';':
					$res .= str_repeat(')', $depth) . ';';
					$depth= 0;
					break;
				default:
					$res .= $char;
			}
		}
		return rtrim($res, ';');
	}
}

?>
