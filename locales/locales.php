<?php
class GP_Locale {
	var $english_name;
	var $native_name;
	var $text_direction = 'ltr';
	var $lang_code_iso_639_1 = null;
	var $country_code;
	var $wp_locale;
	var $slug;
	var $nplurals = 2;
	var $plural_expression = 'n != 1';
	var $google_code = null;
	var $preferred_sans_serif_font_family = null;
	// TODO: days, months, decimals, quotes
	
	function GP_Locale( $args = array() ) {
		foreach( $args as $key => $value ) {
			$this->$key = $value;
		}
	}
	
	static function __set_state( $state ) {
		return new GP_Locale( $state );
	}
	
	function combined_name() {
		/* translators: combined name for locales: 1: name in English, 2: native name */
		return sprintf( _x( '%1$s/%2$s', 'locales' ), $this->english_name, $this->native_name );
	}
	
	function numbers_for_index( $index, $how_many = 3, $test_up_to = 1000 ) {
		$numbers = array();
		for( $number = 0; $number < $test_up_to; ++$number ) {
			if ( $this->index_for_number( $number ) == $index ) {
				$numbers[] = $number;
				if ( count( $numbers ) >= $how_many ) break;
			}
		}
		return $numbers;
	}
	
	function index_for_number( $number ) {
		if ( !isset( $this->_index_for_number ) ) {
			$expression = Gettext_Translations::parenthesize_plural_exression( $this->plural_expression );
			$this->_index_for_number = Gettext_Translations::make_plural_form_function( $this->nplurals, $expression );
		}
		$f = $this->_index_for_number;
		return $f( $number );
	}
}

class GP_Locales {
	
	var $locales = array();
	
	function GP_Locales() {
		$aa = new GP_Locale();
		$aa->english_name = 'Afar';
		$aa->native_name = 'Afaraf';
		$aa->lang_code_iso_639_1 = 'aa';
		$aa->lang_code_iso_639_2 = 'aar';
		$aa->country_code = '';
		$aa->slug = 'aa';

		$ae = new GP_Locale();
		$ae->english_name = 'Avestan';
		$ae->native_name = 'avesta';
		$ae->lang_code_iso_639_1 = 'ae';
		$ae->lang_code_iso_639_2 = 'ave';
		$ae->country_code = '';
		$ae->slug = 'ae';

		$af = new GP_Locale();
		$af->english_name = 'Afrikaans';
		$af->native_name = 'Afrikaans';
		$af->lang_code_iso_639_1 = 'af';
		$af->lang_code_iso_639_2 = 'afr';
		$af->country_code = 'za';
		$af->wp_locale = 'af';
		$af->slug = 'af';
		$af->google_code = 'af';

		$ak = new GP_Locale();
		$ak->english_name = 'Akan';
		$ak->native_name = 'Akan';
		$ak->lang_code_iso_639_1 = 'ak';
		$ak->lang_code_iso_639_2 = 'aka';
		$ak->country_code = '';
		$ak->wp_locale = 'ak';
		$ak->slug = 'ak';

		$am = new GP_Locale();
		$am->english_name = 'Amharic';
		$am->native_name = 'አማርኛ';
		$am->lang_code_iso_639_1 = 'am';
		$am->lang_code_iso_639_2 = 'amh';
		$am->country_code = 'et';
		$am->slug = 'am';
		$am->google_code = 'am';

		$an = new GP_Locale();
		$an->english_name = 'Aragonese';
		$an->native_name = 'Aragonés';
		$an->lang_code_iso_639_1 = 'an';
		$an->lang_code_iso_639_2 = 'arg';
		$an->country_code = 'es';
		$an->slug = 'an';

		$ar = new GP_Locale();
		$ar->english_name = 'Arabic';
		$ar->native_name = 'العربية';
		$ar->lang_code_iso_639_1 = 'ar';
		$ar->lang_code_iso_639_2 = 'ara';
		$ar->country_code = '';
		$ar->wp_locale = 'ar';
		$ar->slug = 'ar';
		$ar->google_code = 'ar';
		$ar->nplurals = 6;
		$ar->plural_expression = 'n==0 ? 0 : n==1 ? 1 : n==2 ? 2 : n%100>=3 && n%100<=10 ? 3 : n%100>=11 && n%100<=99 ? 4 : 5';
		$ar->rtl = true;
		$ar->preferred_sans_serif_font_family = 'Tahoma';

		$as= new GP_Locale();
		$as->english_name = 'Assamese';
		$as->native_name = 'অসমীয়া';
		$as->lang_code_iso_639_1 = 'asm';
		$as->lang_code_iso_639_2 = 'as';
		$as->country_code = 'in';
		$as->slug = 'as';

		$ast = new GP_Locale();
		$ast->english_name = 'Asturian';
		$ast->native_name = 'Asturianu';
		$ast->lang_code_iso_639_1 = null;
		$ast->lang_code_iso_639_2 = 'ast';
		$ast->country_code = 'es';
		$ast->slug = 'ast';

		$av = new GP_Locale();
		$av->english_name = 'Avaric';
		$av->native_name = 'авар мацӀ';
		$av->lang_code_iso_639_1 = 'av';
		$av->lang_code_iso_639_2 = 'ava';
		$av->country_code = '';		
		$av->slug = 'av';

		$ay = new GP_Locale();
		$ay->english_name = 'Aymara';
		$ay->native_name = 'aymar aru';
		$ay->lang_code_iso_639_1 = 'ay';
		$ay->lang_code_iso_639_2 = 'aym';
		$ay->country_code = '';
		$ay->slug = 'ay';
		$ay->nplurals = 1;
		$ay->plural_expression = '0';

		$az = new GP_Locale();
		$az->english_name = 'Azerbaijani';
		$az->native_name = 'Azərbaycan dili';
		$az->lang_code_iso_639_1 = 'az';
		$az->lang_code_iso_639_2 = 'aze';
		$az->country_code = 'az';
		$az->wp_locale = 'az';
		$az->slug = 'az';
		$az->google_code = 'az';

		$ba = new GP_Locale();
		$ba->english_name = 'Bashkir';
		$ba->native_name = 'башҡорт теле';
		$ba->lang_code_iso_639_1 = 'ba';
		$ba->lang_code_iso_639_2 = 'bak';
		$ba->country_code = '';
		$ba->wp_locale = 'ba';
		$ba->slug = 'ba';

		$bal = new GP_Locale();
		$bal->english_name = 'Catalan (Balear)';
		$bal->native_name = 'Català (Balear)';
		$bal->lang_code_iso_639_1 = null;
		$bal->lang_code_iso_639_2 = 'bal';
		$bal->country_code = 'es';
		$bal->wp_locale = 'bal';
		$bal->slug = 'bal';

		$be = new GP_Locale();
		$be->english_name = 'Belarusian';
		$be->native_name = 'Беларуская мова';
		$be->lang_code_iso_639_1 = 'be';
		$be->lang_code_iso_639_2 = 'bel';
		$be->country_code = 'by';
		$be->slug = 'be';
		$be->google_code = 'be';
		$be->nplurals = 3;
		$be->plural_expression = '(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2)';

		$bg = new GP_Locale();
		$bg->english_name = 'Bulgarian';
		$bg->native_name = 'Български';
		$bg->lang_code_iso_639_1 = 'bg';
		$bg->lang_code_iso_639_2 = 'bul';
		$bg->country_code = 'bg';
		$bg->wp_locale = 'bg_BG';
		$bg->slug = 'bg';
		$bg->google_code = 'bg';

		$bh = new GP_Locale();
		$bh->english_name = 'Bihari';
		$bh->native_name = 'भोजपुरी';
		$bh->lang_code_iso_639_1 = 'bh';
		$bh->lang_code_iso_639_2 = 'bih';
		$bh->country_code = '';
		$bh->slug = 'bh';

		$bi = new GP_Locale();
		$bi->english_name = 'Bislama';
		$bi->native_name = 'Bislama';
		$bi->lang_code_iso_639_1 = 'bi';
		$bi->lang_code_iso_639_2 = 'bis';
		$bi->country_code = 'vu';
		$bi->slug = 'bi';

		$bm = new GP_Locale();
		$bm->english_name = 'Bambara';
		$bm->native_name = 'Bamanankan';
		$bm->lang_code_iso_639_1 = 'bm';
		$bm->lang_code_iso_639_2 = 'bam';
		$bm->country_code = '';
		$bm->slug = 'bm';

		$bn_bd = new GP_Locale();
		$bn_bd->english_name = 'Bengali';
		$bn_bd->native_name = 'বাংলা';
		$bn_bd->lang_code_iso_639_1 = 'bn';
		$bn_bd->country_code = 'bn';
		$bn_bd->wp_locale = 'bn_BD';
		$bn_bd->slug = 'bn';
		$bn_bd->google_code = 'bn';

		$bo = new GP_Locale();
		$bo->english_name = 'Tibetan';
		$bo->native_name = 'བོད་སྐད';
		$bo->lang_code_iso_639_1 = 'bo';
		$bo->lang_code_iso_639_2 = 'tib';
		$bo->country_code = '';
		$bo->slug = 'bo';
		$bo->google_code = 'bo';
		$bo->nplurals = 1;
		$bo->plural_expression = '0';

		$br = new GP_Locale();
		$br->english_name = 'Breton';
		$br->native_name = 'brezhoneg';
		$br->lang_code_iso_639_1 = 'br';
		$br->lang_code_iso_639_2 = 'bre';
		$br->country_code = 'fr';
		$br->slug = 'br';
		$br->nplurals = 2;
		$br->plural_expression = '(n > 1)';

		$bs = new GP_Locale();
		$bs->english_name = 'Bosnian';
		$bs->native_name = 'Bosanski';
		$bs->lang_code_iso_639_1 = 'bs';
		$bs->lang_code_iso_639_2 = 'bos';
		$bs->country_code = 'ba';
		$bs->wp_locale = 'bs_BA';
		$bs->slug = 'bs';
		$bs->nplurals = 3;
		$bs->plural_expression = '(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2)';

		$ca = new GP_Locale();
		$ca->english_name = 'Catalan';
		$ca->native_name = 'Català';
		$ca->lang_code_iso_639_1 = 'ca';
		$ca->lang_code_iso_639_2 = 'cat';
		$ca->country_code = '';
		$ca->wp_locale = 'ca';
		$ca->slug = 'ca';

		$ce = new GP_Locale();
		$ce->english_name = 'Chechen';
		$ce->native_name = 'Нохчийн мотт';
		$ce->lang_code_iso_639_1 = 'ce';
		$ce->lang_code_iso_639_2 = 'che';
		$ce->country_code = '';
		$ce->slug = 'ce';

		$ch = new GP_Locale();
		$ch->english_name = 'Chamorro';
		$ch->native_name = 'Chamoru';
		$ch->lang_code_iso_639_1 = 'ch';
		$ch->lang_code_iso_639_2 = 'cha';
		$ch->slug = 'ch';

		$ckb = new GP_Locale();
		$ckb->english_name = 'Kurdish (Sorani)';
		$ckb->native_name = 'كوردی‎';
		$ckb->lang_code_iso_639_1 = 'ku';
		$ckb->lang_code_iso_639_2 = 'ckb';
		$ckb->country_code = 'ku';
		$ckb->wp_locale = 'ckb';
		$ckb->slug = 'ckb';

		$co = new GP_Locale();
		$co->english_name = 'Corsican';
		$co->native_name = 'corsu';
		$co->lang_code_iso_639_1 = 'co';
		$co->lang_code_iso_639_2 = 'cos';
		$co->country_code = 'it';
		$co->slug = 'co';

		$cr = new GP_Locale();
		$cr->english_name = 'Cree';
		$cr->native_name = 'ᓀᐦᐃᔭᐍᐏᐣ';
		$cr->lang_code_iso_639_1 = 'cr';
		$cr->lang_code_iso_639_2 = 'cre';
		$cr->country_code = 'ca';
		$cr->slug = 'cr';

		$cs = new GP_Locale();
		$cs->english_name = 'Czech';
		$cs->native_name = 'čeština‎';
		$cs->lang_code_iso_639_1 = 'cs';
		$cs->lang_code_iso_639_2 = 'ces';
		$cs->country_code = 'cz';
		$cs->wp_locale = 'cs_CZ';
		$cs->slug = 'cs';
		$cs->google_code = 'cs';
		$cs->nplurals = 3;
		$cs->plural_expression = '(n==1) ? 0 : (n>=2 && n<=4) ? 1 : 2';

		$csb = new GP_Locale();
		$csb->english_name = 'Kashubian';
		$csb->native_name = 'Kaszëbsczi';
		$csb->lang_code_iso_639_1 = null;
		$csb->lang_code_iso_639_2 = 'csb';
		$csb->country_code = '';
		$csb->slug = 'csb';
		$csb->nplurals = 3;
		$csb->plural_expression = 'n==1 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2';

		$cu = new GP_Locale();
		$cu->english_name = 'Church Slavic';
		$cu->native_name = 'ѩзыкъ словѣньскъ';
		$cu->lang_code_iso_639_1 = 'cu';
		$cu->lang_code_iso_639_2 = 'chu';
		$cu->country_code = '';
		$cu->slug = 'cu';

		$cv = new GP_Locale();
		$cv->english_name = 'Chuvash';
		$cv->native_name = 'чӑваш чӗлхи';
		$cv->lang_code_iso_639_1 = 'cv';
		$cv->lang_code_iso_639_2 = 'chv';
		$cv->country_code = 'ru';
		$cv->slug = 'cv';

		$cy = new GP_Locale();
		$cy->english_name = 'Welsh';
		$cy->native_name = 'Cymraeg';
		$cy->lang_code_iso_639_1 = 'cy';
		$cy->lang_code_iso_639_2 = 'cym';
		$cy->country_code = 'uk';
		$cy->wp_locale = 'cy';
		$cy->slug = 'cy';
		$cy->google_code = 'cy';
		$cy->nplurals = 4;
		$cy->plural_expression = '(n==1) ? 0 : (n==2) ? 1 : (n != 8 && n != 11) ? 2 : 3';

		$da = new GP_Locale();
		$da->english_name = 'Danish';
		$da->native_name = 'Dansk';
		$da->lang_code_iso_639_1 = 'da';
		$da->lang_code_iso_639_2 = 'dan';
		$da->country_code = 'dk';
		$da->wp_locale = 'da_DK';
		$da->slug = 'da';
		$da->google_code = 'da';
		
		$de = new GP_Locale();
		$de->english_name = 'German';
		$de->native_name = 'Deutsch';
		$de->lang_code_iso_639_1 = 'de';
		$de->country_code = 'de';
		$de->wp_locale = 'de_DE';
		$de->slug = 'de';
		$de->google_code = 'de';
		
		$dv = new GP_Locale();
		$dv->english_name = 'Divehi';
		$dv->native_name = 'ދިވެހި';
		$dv->lang_code_iso_639_1 = 'dv';
		$dv->lang_code_iso_639_1 = 'div';
		$dv->country_code = 'mv';
		$dv->slug = 'dv';
		$dv->google_code = 'dv';
		$dv->rtl = true;
		
		$dz = new GP_Locale();
		$dz->english_name = 'Dzongkha';
		$dz->native_name = 'རྫོང་ཁ';
		$dz->lang_code_iso_639_1 = 'dz';
		$dz->lang_code_iso_639_1 = 'dzo';
		$dz->country_code = 'bt';
		$dz->slug = 'dz';
		$dz->nplurals = 1;
		$dz->plural_expression = '0';
		
		$ee = new GP_Locale();
		$ee->english_name = 'Ewe';
		$ee->native_name = 'Eʋegbe';
		$ee->lang_code_iso_639_1 = 'ee';
		$ee->lang_code_iso_639_1 = 'ewe';
		$ee->country_code = '';
		$ee->slug = 'ee';

		$el_po = new GP_Locale();
		$el_po->english_name = 'Greek (Polytonic)';
		$el_po->native_name = 'Greek (Polytonic)'; // TODO
		$el_po->lang_code_po_iso_639_1 = null;
		$el_po->lang_code_po_iso_639_2 = null;
		$el_po->country_code = 'gr';
		$el_po->slug = 'el-po';

		$el = new GP_Locale();
		$el->english_name = 'Greek';
		$el->native_name = 'Ελληνικά';
		$el->lang_code_iso_639_1 = 'el';
		$el->lang_code_iso_639_2 = 'ell';
		$el->country_code = 'gr';
		$el->wp_locale = 'el';
		$el->slug = 'el';
		$el->google_code = 'el';
		
		$en = new GP_Locale();
		$en->english_name = 'English';
		$en->native_name = 'English';
		$en->lang_code_iso_639_1 = 'en';
		$en->country_code = 'us';
		$en->wp_locale = 'en_US';
		$en->slug = 'en';
		$en->google_code = 'en';

		$eo = new GP_Locale();
		$eo->english_name = 'Esperanto';
		$eo->native_name = 'Esperanto';
		$eo->lang_code_iso_639_1 = 'eo';
		$eo->lang_code_iso_639_2 = 'epo';
		$eo->country_code = '';
		$eo->wp_locale = 'eo';
		$eo->slug = 'eo';
		$eo->google_code = 'eo';

		$es_cl = new GP_Locale();
		$es_cl->english_name = 'Spanish (Chile)';
		$es_cl->native_name = 'Español de Chile';
		$es_cl->lang_code_iso_639_1 = 'es';
		$es_cl->lang_code_iso_639_2 = 'spa';
		$es_cl->country_code = 'cl';
		$es_cl->wp_locale = 'es_CL';
		$es_cl->slug = 'es-cl';
		$es_cl->google_code = 'es';

		$es_pe = new GP_Locale();
		$es_pe->english_name = 'Spanish (Peru)';
		$es_pe->native_name = 'Español de Perú';
		$es_pe->lang_code_iso_639_1 = 'es';
		$es_pe->lang_code_iso_639_2 = 'spa';
		$es_pe->country_code = 'pe';
		$es_pe->wp_locale = 'es_PE';
		$es_pe->slug = 'es-pe';
		$es_pe->google_code = 'es';

		$es_pr = new GP_Locale();
		$es_pr->english_name = 'Spanish (Puerto Rico)';
		$es_pr->native_name = 'Español de Puerto Rico';
		$es_pr->lang_code_iso_639_1 = 'es';
		$es_pr->lang_code_iso_639_2 = 'spa';
		$es_pr->country_code = 'pr';
		$es_pr->wp_locale = 'es_PR';
		$es_pr->slug = 'es-pr';
		$es_pr->google_code = 'es';
		
		$es_ve = new GP_Locale();
		$es_ve->english_name = 'Spanish (Venezuela)';
		$es_ve->native_name = 'Español de Venezuela';
		$es_ve->lang_code_iso_639_1 = 'es';
		$es_ve->lang_code_iso_639_2 = 'spa';
		$es_ve->country_code = 'pe';
		$es_ve->wp_locale = 'es_VE';
		$es_ve->slug = 'es-ve';
		$es_ve->google_code = 'es';

		$es_co = new GP_Locale();
		$es_co->english_name = 'Spanish (Colombia)';
		$es_co->native_name = 'Español de Colombia';
		$es_co->lang_code_iso_639_1 = 'es';
		$es_co->lang_code_iso_639_2 = 'spa';
		$es_co->country_code = 'co';
		$es_co->wp_locale = 'es_CO';
		$es_co->slug = 'es-co';
		$es_co->google_code = 'es';

		$es = new GP_Locale();
		$es->english_name = 'Spanish (Spain)';
		$es->native_name = 'Español';
		$es->lang_code_iso_639_1 = 'es';
		$es->country_code = 'es';
		$es->wp_locale = 'es_ES';
		$es->slug = 'es';
		$es->google_code = 'es';
		
		$et = new GP_Locale();
		$et->english_name = 'Estonian';
		$et->native_name = 'Eesti';
		$et->lang_code_iso_639_1 = 'et';
		$et->lang_code_iso_639_2 = 'est';
		$et->country_code = 'ee';
		$et->wp_locale = 'et';
		$et->slug = 'et';
		$et->google_code = 'et';

		$eu = new GP_Locale();
		$eu->english_name = 'Basque';
		$eu->native_name = 'Euskara';
		$eu->lang_code_iso_639_1 = 'eu';
		$eu->lang_code_iso_639_2 = 'eus';
		$eu->country_code = 'es';
		$eu->wp_locale = 'eu';
		$eu->slug = 'eu';
		$eu->google_code = 'eu';

		$fa = new GP_Locale();
		$fa->english_name = 'Persian';
		$fa->native_name = 'فارسی';
		$fa->lang_code_iso_639_1 = 'fa';
		$fa->lang_code_iso_639_2 = 'fas';
		$fa->country_code = '';
		$fa->wp_locale = 'fa_IR';
		$fa->slug = 'fa';
		$fa->google_code = 'fa';
		$fa->nplurals = 1;
		$fa->plural_expression = '0';
		$fa->rtl = true;

		$fi = new GP_Locale();
		$fi->english_name = 'Finnish';
		$fi->native_name = 'Suomi';
		$fi->lang_code_iso_639_1 = 'fi';
		$fi->lang_code_iso_639_2 = 'fin';
		$fi->country_code = 'fi';
		$fi->wp_locale = 'fi';
		$fi->slug = 'fi';
		$fi->google_code = 'fi';

		$fj = new GP_Locale();
		$fj->english_name = 'Fijian';
		$fj->native_name = 'vosa Vakaviti';
		$fj->lang_code_iso_639_1 = 'fj';
		$fj->lang_code_iso_639_2 = 'fij';
		$fj->country_code = 'fj';
		$fj->slug = 'fj';

		$fo = new GP_Locale();
		$fo->english_name = 'Faroese';
		$fo->native_name = 'føroyskt';
		$fo->lang_code_iso_639_1 = 'fo';
		$fo->lang_code_iso_639_2 = 'fao';
		$fo->country_code = 'fo';
		$fo->wp_locale = 'fo';
		$fo->slug = 'fo';
		
		$fr = new GP_Locale();
		$fr->english_name = 'French (France)';
		$fr->native_name = 'Français';
		$fr->lang_code_iso_639_1 = 'fr';
		$fr->country_code = 'fr';
		$fr->wp_locale = 'fr_FR';
		$fr->slug = 'fr';
		$fr->google_code = 'fr';
		$fr->nplurals = 2;
		$fr->plural_expression = 'n > 1';

		$fr_be = new GP_Locale();
		$fr_be->english_name = 'French (Belgium)';
		$fr_be->native_name = 'Français de Belgique';
		$fr_be->lang_code_iso_639_1 = 'fr';
		$fr_be->lang_code_iso_639_2 = 'fra';
		$fr_be->country_code = 'be';
		$fr_be->wp_locale = 'fr_BE';
		$fr_be->slug = 'fr-be';

		$fr_ca = new GP_Locale();
	 	$fr_ca->english_name = 'French (Canada)';
	 	$fr_ca->native_name = 'Français du Canada';
	 	$fr_ca->lang_code_iso_639_1 = 'fr';
	 	$fr_ca->lang_code_iso_639_2 = 'fra';
	 	$fr_ca->country_code = 'ca';
	 	$fr_ca->slug = 'fr-ca';

		$fr_ch = new GP_Locale();
	 	$fr_ch->english_name = 'French (Switzerland)';
	 	$fr_ch->native_name = 'Français de Suisse';
	 	$fr_ch->lang_code_iso_639_1 = 'fr';
	 	$fr_ch->lang_code_iso_639_2 = 'fra';
	 	$fr_ch->country_code = 'ch';
	 	$fr_ch->slug = 'fr-ch';

		$fy = new GP_Locale();
	 	$fy->english_name = 'Frisian';
	 	$fy->native_name = 'Frysk';
	 	$fy->lang_code_iso_639_1 = 'fy';
	 	$fy->lang_code_iso_639_2 = 'fry';
	 	$fy->country_code = 'fy';
	 	$fy->slug = 'fy';
	 	$fy->wp_locale = 'fy';
                
		$ga = new GP_Locale();
		$ga->english_name = 'Irish';
		$ga->native_name = 'Gaelige';
		$ga->lang_code_iso_639_1 = 'ga';
		$ga->lang_code_iso_639_2 = 'gle';
		$ga->country_code = 'ie';
		$ga->slug = 'ga';
		$ga->google_code = 'ga';
		$ga->nplurals = 5;
		$ga->plural_expression = 'n==1 ? 0 : n==2 ? 1 : n<7 ? 2 : n<11 ? 3 : 4';

		$gl = new GP_Locale();
		$gl->english_name = 'Galician';
		$gl->native_name = 'Galego';
		$gl->lang_code_iso_639_1 = 'gl';
		$gl->lang_code_iso_639_2 = 'glg';
		$gl->country_code = 'es';
		$gl->wp_locale = 'gl_ES';
		$gl->slug = 'gl';
		$gl->google_code = 'gl';

		$gn = new GP_Locale();
		$gn->english_name = 'Guaraní';
		$gn->native_name = 'Avañe\'ẽ';
		$gn->lang_code_iso_639_1 = 'gn';
		$gn->lang_code_iso_639_2 = 'grn';
		$gn->country_code = '';
		$gn->wp_locale = 'gn';
		$gn->slug = 'gn';
		$gn->google_code = 'gn';

		$gu = new GP_Locale();
		$gu->english_name = 'Gujarati';
		$gu->native_name = 'ગુજરાતી';
		$gu->lang_code_iso_639_1 = 'gu';
		$gu->lang_code_iso_639_2 = 'guj';
		$gu->country_code = '';
		$gu->slug = 'gu';
		$gu->google_code = 'gu';

		$ha = new GP_Locale();
		$ha->english_name = 'Hausa';
		$ha->native_name = 'هَوُسَ';
		$ha->lang_code_iso_639_1 = 'he';
		$ha->lang_code_iso_639_2 = 'hau';
		$ha->country_code = '';
		$ha->slug = 'ha';
		$ha->rtl = true;
		
		$haw = new GP_Locale();
		$haw->english_name = 'Hawaiian';
		$haw->native_name = 'Ōlelo Hawaiʻi';
		$haw->lang_code_iso_639_1 = null;
		$haw->lang_code_iso_639_2 = 'haw';
		$haw->country_code = 'us';
		$haw->wp_locale = 'haw_US';
		$haw->slug = 'haw';

		$he = new GP_Locale();
		$he->english_name = 'Hebrew';
		$he->native_name = 'עִבְרִית';
		$he->lang_code_iso_639_1 = 'he';
		$he->country_code = 'il';
		$he->wp_locale = 'he_IL';
		$he->slug = 'he';
		$he->google_code = 'iw';
		$he->rtl = true;

		$hi = new GP_Locale();
		$hi->english_name = 'Hindi';
		$hi->native_name = 'हिन्दी';
		$hi->lang_code_iso_639_1 = 'hi';
		$hi->lang_code_iso_639_2 = 'hin';
		$hi->country_code = 'in';
		$hi->wp_locale = 'hi_IN';
		$hi->slug = 'hi';
		$hi->google_code = 'hi';

		$hr = new GP_Locale();
		$hr->english_name = 'Croatian';
		$hr->native_name = 'Hrvatski';
		$hr->lang_code_iso_639_1 = 'hr';
		$hr->lang_code_iso_639_2 = 'hrv';
		$hr->country_code = 'hr';
		$hr->wp_locale = 'hr';
		$hr->slug = 'hr';
		$hr->google_code = 'hr';
		$hr->nplurals = 3;
		$hr->plural_expression = '(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2)';

		$hu = new GP_Locale();
		$hu->english_name = 'Hungarian';
		$hu->native_name = 'Magyar';
		$hu->lang_code_iso_639_1 = 'hu';
		$hu->lang_code_iso_639_2 = 'hun';
		$hu->country_code = 'hu';
		$hu->wp_locale = 'hu_HU';
		$hu->slug = 'hu';
		$hu->google_code = 'hu';

		$hy = new GP_Locale();
		$hy->english_name = 'Armenian';
		$hy->native_name = 'Հայերեն';
		$hy->lang_code_iso_639_1 = 'hy';
		$hy->lang_code_iso_639_2 = 'hye';
		$hy->country_code = 'am';
		$hy->slug = 'hy';
		$hy->nplurals = 1;
		$hy->plural_expression = '0';

		$ia = new GP_Locale();
		$ia->english_name = 'Interlingua';
		$ia->native_name = 'Interlingua';
		$ia->lang_code_iso_639_1 = 'ia';
		$ia->lang_code_iso_639_2 = 'ina';
		$ia->country_code = '';
		$ia->slug = 'ia';

		$id = new GP_Locale();
		$id->english_name = 'Indonesian';
		$id->native_name = 'Bahasa Indonesia';
		$id->lang_code_iso_639_1 = 'id';
		$id->lang_code_iso_639_2 = 'ind';
		$id->country_code = 'id';
		$id->wp_locale = 'id_ID';
		$id->slug = 'id';
		$id->google_code = 'id';
		$id->nplurals = 2;
		$id->plural_expression = 'n > 1';

		$ilo = new GP_Locale();
		$ilo->english_name = 'Iloko';
		$ilo->native_name = 'Pagsasao nga Iloko';
		$ilo->lang_code_iso_639_1 = null;
		$ilo->lang_code_iso_639_2 = 'ilo';
		$ilo->country_code = 'ph';
		$ilo->slug = 'ilo';

		$is = new GP_Locale();
		$is->english_name = 'Icelandic';
		$is->native_name = 'Íslenska';
		$is->lang_code_iso_639_1 = 'is';
		$is->lang_code_iso_639_2 = 'isl';
		$is->country_code = 'is';
		$is->slug = 'is';
		$is->google_code = 'is';
		$is->wp_locale = 'is_IS';
		$is->nplurals = 2;
		$is->plural_expression = '(n % 100 != 1 && n % 100 != 21 && n % 100 != 31 && n % 100 != 41 && n % 100 != 51 && n % 100 != 61 && n % 100 != 71 && n % 100 != 81 && n % 100 != 91)';

		$it = new GP_Locale();
		$it->english_name = 'Italian';
		$it->native_name = 'Italiano';
		$it->lang_code_iso_639_1 = 'it';
		$it->lang_code_iso_639_2 = 'ita';
		$it->country_code = 'it';
		$it->wp_locale = 'it_IT';
		$it->slug = 'it';
		$it->google_code = 'it';

		$ja = new GP_Locale();
		$ja->english_name = 'Japanese';
		$ja->native_name = '日本語';
		$ja->lang_code_iso_639_1 = 'ja';
		$ja->country_code = 'jp';
		$ja->wp_locale = 'ja';
		$ja->slug = 'ja';
		$ja->google_code = 'ja';
		$ja->nplurals = 1;
		$ja->plural_expression = '0';

		$jv = new GP_Locale();
		$jv->english_name = 'Javanese';
		$jv->native_name = 'Basa Jawa';
		$jv->lang_code_iso_639_1 = 'jv';
		$jv->lang_code_iso_639_1 = 'jav';
		$jv->country_code = 'id';
		$jv->wp_locale = 'jv_ID';
		$jv->slug = 'jv';

		$ka = new GP_Locale();
		$ka->english_name = 'Georgian';
		$ka->native_name = 'ქართული';
		$ka->lang_code_iso_639_1 = 'ka';
		$ka->lang_code_iso_639_2 = 'kat';
		$ka->country_code = 'ge';
		$ka->wp_locale = 'ka_GE';
		$ka->slug = 'ka';
		$ka->google_code = 'ka';
		$ka->nplurals = 1;
		$ka->plural_expression = '0';

		$kk = new GP_Locale();
		$kk->english_name = 'Kazakh';
		$kk->native_name = 'Қазақ тілі';
		$kk->lang_code_iso_639_1 = 'kk';
		$kk->lang_code_iso_639_2 = 'kaz';
		$kk->country_code = 'kz';
		$kk->slug = 'kk';
		$kk->google_code = 'kk';

		$km = new GP_Locale();
		$km->english_name = 'Khmer';
		$km->native_name = 'ភាសាខ្មែរ';
		$km->lang_code_iso_639_1 = 'km';
		$km->lang_code_iso_639_2 = 'khm';
		$km->country_code = 'kh';
		$km->slug = 'km';
		$km->google_code = 'km';
		$km->nplurals = 1;
		$km->plural_expression = '0';

		$kn = new GP_Locale();
		$kn->english_name = 'Kannada';
		$kn->native_name = 'ಕನ್ನಡ';
		$kn->lang_code_iso_639_1 = 'kn';
		$kn->lang_code_iso_639_2 = 'kan';
		$kn->country_code = 'in';
		$kn->wp_locale = 'kn';
		$kn->slug = 'kn';
		$kn->google_code = 'kn';

		$ko = new GP_Locale();
		$ko->english_name = 'Korean';
		$ko->native_name = '한국어';
		$ko->lang_code_iso_639_1 = 'ko';
		$ko->lang_code_iso_639_2 = 'kor';
		$ko->country_code = 'kr';
		$ko->wp_locale = 'ko_KR';
		$ko->slug = 'ko';
		$ko->google_code = 'ko';
		$ko->nplurals = 1;
		$ko->plural_expression = '0';

		$ks = new GP_Locale();
		$ks->english_name = 'Kashmiri';
		$ks->native_name = 'कश्मीरी';
		$ks->lang_code_iso_639_1 = 'ks';
		$ks->lang_code_iso_639_2 = 'kas';
		$ks->country_code = '';
		$ks->slug = 'ks';

		$ku = new GP_Locale();
		$ku->english_name = 'Kurdish (Kurmanji)';
		$ku->native_name = 'Kurdî';
		$ku->lang_code_iso_639_1 = 'ku';
		$ku->lang_code_iso_639_2 = 'kur';
		$ku->country_code = 'ku';
		$ku->slug = 'ku';
		$ku->google_code = 'ku';

		$ky = new GP_Locale();
		$ky->english_name = 'Kirghiz';
		$ky->native_name = 'кыргыз тили';
		$ky->lang_code_iso_639_1 = 'ky';
		$ky->lang_code_iso_639_2 = 'kir';
		$ky->country_code = 'kg';
		$ky->wp_locale = 'ky_KY';
		$ky->slug = 'ky';
		$ky->nplurals = 1;
		$ky->plural_expression = '0';

		$la = new GP_Locale();
		$la->english_name = 'Latin';
		$la->native_name = 'latine';
		$la->lang_code_iso_639_1 = 'la';
		$la->lang_code_iso_639_2 = 'lat';
		$la->country_code = '';
		$la->slug = 'la';

		$lb = new GP_Locale();
		$lb->english_name = 'Luxembourgish';
		$lb->native_name = 'Lëtzebuergesch';
		$lb->lang_code_iso_639_1 = 'lb';
		$lb->country_code = 'lu';
		$lb->wp_locale = 'lb_LU';
		$lb->slug = 'lb';

		$lo = new GP_Locale();
		$lo->english_name = 'Lao';
		$lo->native_name = 'ພາສາລາວ';
		$lo->lang_code_iso_639_1 = 'lo';
		$lo->lang_code_iso_639_2 = 'lao';
		$lo->country_code = '';
		$lo->slug = 'lo';
		$lo->google_code = 'lo';
		$lo->nplurals = 1;
		$lo->plural_expression = '0';

		$lt = new GP_Locale();
		$lt->english_name = 'Lithuanian';
		$lt->native_name = 'Lietuvių kalba';
		$lt->lang_code_iso_639_1 = 'lt';
		$lt->lang_code_iso_639_2 = 'lit';
		$lt->country_code = 'lt';
		$lt->slug = 'lt';
		$lt->google_code = 'lt';
		$lt->nplurals = 3;
		$lt->plural_expression = '(n%10==1 && n%100!=11 ? 0 : n%10>=2 && (n%100<10 || n%100>=20) ? 1 : 2)';

		$lv = new GP_Locale();
		$lv->english_name = 'Latvian';
		$lv->native_name = 'latviešu valoda';
		$lv->lang_code_iso_639_1 = 'lv';
		$lv->lang_code_iso_639_2 = 'lav';
		$lv->country_code = 'lv';
		$lv->wp_locale = 'lv';
		$lv->slug = 'lv';
		$lv->google_code = 'lv';
		$lv->nplurals = 3;
		$lv->plural_expression = '(n%10==1 && n%100!=11 ? 0 : n != 0 ? 1 : 2)';

		$mk = new GP_Locale();
		$mk->english_name = 'Macedonian';
		$mk->native_name = 'македонски јазик';
		$mk->lang_code_iso_639_1 = 'mk';
		$mk->lang_code_iso_639_2 = 'mkd';
		$mk->country_code = 'mk';
		$mk->wp_locale = 'mk_MK';
		$mk->slug = 'mk';
		$mk->google_code = 'mk';
		$mk->nplurals = 2;
		$mk->plural_expression = 'n==1 || n%10==1 ? 0 : 1';

		$ml = new GP_Locale();
		$ml->english_name = 'Malayalam';
		$ml->native_name = 'മലയാളം';
		$ml->lang_code_iso_639_1 = 'ml';
		$ml->lang_code_iso_639_2 = 'mal';
		$ml->country_code = 'in';
		$ml->wp_locale = 'ml_IN';
		$ml->slug = 'ml';
		$ml->google_code = 'ml';

		$mn = new GP_Locale();
		$mn->english_name = 'Mongolian';
		$mn->native_name = 'Монгол';
		$mn->lang_code_iso_639_1 = 'mn';
		$mn->lang_code_iso_639_2 = 'mon';
		$mn->country_code = 'mn';
		$mn->slug = 'mn';
		$mn->google_code = 'mn';

		$mr = new GP_Locale();
		$mr->english_name = 'Marathi';
		$mr->native_name = 'मराठी';
		$mr->lang_code_iso_639_1 = 'mr';
		$mr->lang_code_iso_639_2 = 'mar';
		$mr->country_code = '';
		$mr->slug = 'mr';
		$mr->google_code = 'mr';

		$ms = new GP_Locale();
		$ms->english_name = 'Malay';
		$ms->native_name = 'Bahasa Melayu';
		$ms->lang_code_iso_639_1 = 'ms';
		$ms->lang_code_iso_639_2 = 'msa';
		$ms->country_code = '';
		$ms->wp_locale = 'ms_MY';
		$ms->slug = 'ms';
		$ms->google_code = 'ms';
		$ms->nplurals = 1;
		$ms->plural_expression = '0';

		$mwl = new GP_Locale();
		$mwl->english_name = 'Mirandese';
		$mwl->native_name = 'Mirandés';
		$mwl->lang_code_iso_639_1 = null;
		$mwl->lang_code_iso_639_2 = 'mwl';
		$mwl->country_code = '';
		$mwl->slug = 'mwl';

		$my = new GP_Locale();
		$my->english_name = 'Burmese';
		$my->native_name = 'ဗမာစာ';
		$my->lang_code_iso_639_1 = 'my';
		$my->lang_code_iso_639_2 = 'mya';
		$my->country_code = 'mm';
		$my->wp_locale = 'my_MM';
		$my->slug = 'my';
		$my->google_code = 'my';

		$ne = new GP_Locale();
		$ne->english_name = 'Nepali';
		$ne->native_name = 'नेपाली';
		$ne->lang_code_iso_639_1 = 'ne';
		$ne->lang_code_iso_639_2 = 'nep';
		$ne->country_code = 'np';
		$ne->wp_locale = 'ne_NP';
		$ne->slug = 'ne';

		$nb = new GP_Locale();
		$nb->english_name = 'Norwegian (Bokmål)';
		$nb->native_name = 'Norsk bokmål';
		$nb->lang_code_iso_639_1 = 'nb';
		$nb->lang_code_iso_639_2 = 'nob';
		$nb->country_code = 'no';
		$nb->wp_locale = 'nb_NO';
		$nb->slug = 'nb';
		$nb->google_code = 'no';

		$nl = new GP_Locale();
		$nl->english_name = 'Dutch';
		$nl->native_name = 'Nederlands';
		$nl->lang_code_iso_639_1 = 'nl';
		$nl->lang_code_iso_639_2 = 'nld';
		$nl->country_code = 'nl';
		$nl->wp_locale = 'nl_NL';
		$nl->slug = 'nl';
		$nl->google_code = 'nl';

		$nn = new GP_Locale();
		$nn->english_name = 'Norwegian (Nynorsk)';
		$nn->native_name = 'Norsk nynorsk';
		$nn->lang_code_iso_639_1 = 'nn';
		$nn->lang_code_iso_639_2 = 'nno';
		$nn->country_code = 'no';
		$nn->wp_locale = 'nn_NO';
		$nn->slug = 'nn';

		$no = new GP_Locale();
		$no->english_name = 'Norwegian';
		$no->native_name = 'Norsk';
		$no->lang_code_iso_639_1 = 'no';
		$no->lang_code_iso_639_2 = 'nor';
		$no->country_code = 'no';
		$no->slug = 'no';
		$no->google_code = 'no';

		$oc = new GP_Locale();
		$oc->english_name = 'Occitan';
		$oc->native_name = 'Occitan';
		$oc->lang_code_iso_639_1 = 'oc';
		$oc->lang_code_iso_639_2 = 'oci';
		$oc->country_code = '';
		$oc->slug = 'oc';
		
		$pa = new GP_Locale();
		$pa->english_name = 'Punjabi';
		$pa->native_name = 'ਪੰਜਾਬੀ';
		$pa->lang_code_iso_639_1 = 'pa';
		$pa->lang_code_iso_639_2 = 'pan';
		$pa->country_code = '';
		$pa->slug = 'pa';

		$pl = new GP_Locale();
		$pl->english_name = 'Polish';
		$pl->native_name = 'Polski';
		$pl->lang_code_iso_639_1 = 'pl';
		$pl->lang_code_iso_639_2 = 'pol';
		$pl->country_code = 'pl';
		$pl->wp_locale = 'pl_PL';
		$pl->slug = 'pl';
		$pl->google_code = 'pl';
		$pl->nplurals = 3;
		$pl->plural_expression = '(n==1 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2)';


		$pt_br = new GP_Locale();
		$pt_br->english_name = 'Portuguese (Brazil)';
		$pt_br->native_name = 'Português do Brasil';
		$pt_br->lang_code_iso_639_1 = 'pt';
		$pt_br->lang_code_iso_639_2 = 'por';
		$pt_br->country_code = 'br';
		$pt_br->wp_locale = 'pt_BR';
		$pt_br->slug = 'pt-br';
		$pt_br->google_code = 'pt-PT';
		$pt_br->nplurals = 2;
		$pt_br->plural_expression = '(n > 1)';
		
		$pt = new GP_Locale();
		$pt->english_name = 'Portuguese (Portugal)';
		$pt->native_name = 'Português';
		$pt->lang_code_iso_639_1 = 'pt';
		$pt->country_code = 'pt';
		$pt->wp_locale = 'pt_PT';
		$pt->slug = 'pt';
		$pt->google_code = 'pt-PT';
		
		$ps = new GP_Locale();
		$ps->english_name = 'Pashto';
		$ps->native_name = 'پښتو';
		$ps->lang_code_iso_639_1 = 'ps';
		$ps->country_code = '';
		$ps->wp_locale = 'ps';
		$ps->slug = 'ps';
		$ps->google_code = 'ps';
		$ps->rtl = true;		

		$ro = new GP_Locale();
		$ro->english_name = 'Romanian';
		$ro->native_name = 'Română';
		$ro->lang_code_iso_639_1 = 'ro';
		$ro->lang_code_iso_639_2 = 'ron';
		$ro->country_code = 'ro';
		$ro->wp_locale = 'ro_RO';
		$ro->slug = 'ro';
		$ro->google_code = 'ro';
		$ro->nplurals = 3;
		$ro->plural_expression = '(n==1 ? 0 : (n==0 || (n%100 > 0 && n%100 < 20)) ? 1 : 2);';

		$ru_ua = new GP_Locale();
		$ru_ua->english_name = 'Russian (Ukraine)';
		$ru_ua->native_name = 'Ukrainian Russian'; // TODO
		$ru_ua->lang_code_iso_639_1 = 'ru';
		$ru_ua->lang_code_iso_639_2 = 'rus';
		$ru_ua->country_code = 'ua';
		$ru_ua->wp_locale = 'ru_UA';
		$ru_ua->slug = 'ru-ua';
		$ru_ua->google_code = 'ru';
		$ru_ua->nplurals = 3;
		$ru_ua->plural_expression = '(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2)';

		$ru = new GP_Locale();
		$ru->english_name = 'Russian';
		$ru->native_name = 'Русский';
		$ru->lang_code_iso_639_1 = 'ru';
		$ru->lang_code_iso_639_2 = 'rus';
		$ru->country_code = 'ru';
		$ru->wp_locale = 'ru_RU';
		$ru->slug = 'ru';
		$ru->google_code = 'ru';
		$ru->nplurals = 3;
		$ru->plural_expression = '(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2)';

		$sc = new GP_Locale();
		$sc->english_name = 'Sardinian';
		$sc->native_name = 'sardu';
		$sc->lang_code_iso_639_1 = 'sc';
		$sc->lang_code_iso_639_2 = 'srd';
		$sc->country_code = '';
		$sc->wp_locale = 'sc';
		$sc->slug = 'sc';

		$sd = new GP_Locale();
		$sd->english_name = 'Sindhi';
		$sd->native_name = 'سندھ';
		$sd->lang_code_iso_639_1 = 'sd';
		$sd->lang_code_iso_639_2 = 'snd';
		$sd->country_code = 'pk';
		$sd->wp_locale = 'sd_PK';
		$sd->slug = 'sd';
		$sd->google_code = 'sd';

		$si = new GP_Locale();
		$si->english_name = 'Sinhala';
		$si->native_name = 'සිංහල';
		$si->lang_code_iso_639_1 = 'si';
		$si->lang_code_iso_639_2 = 'sin';
		$si->country_code = 'lk';
		$si->wp_locale = 'si_LK';
		$si->slug = 'si';
		$si->google_code = 'si';

		$sk = new GP_Locale();
		$sk->english_name = 'Slovak';
		$sk->native_name = 'Slovenčina';
		$sk->lang_code_iso_639_1 = 'sk';
		$sk->lang_code_iso_639_2 = 'slk';
		$sk->country_code = 'sk';
		$sk->slug = 'sk';
		$sk->wp_locale = 'sk_SK';
		$sk->google_code = 'sk';
		$sk->nplurals = 3;
		$sk->plural_expression = '(n==1) ? 0 : (n>=2 && n<=4) ? 1 : 2';

		$sl = new GP_Locale();
		$sl->english_name = 'Slovenian';
		$sl->native_name = 'slovenščina';
		$sl->lang_code_iso_639_1 = 'sl';
		$sl->lang_code_iso_639_2 = 'slv';
		$sl->country_code = 'si';
		$sl->wp_locale = 'sl_SI';
		$sl->slug = 'sl';
		$sl->google_code = 'sl';
		$sl->nplurals = 4;
		$sl->plural_expression = '(n%100==1 ? 0 : n%100==2 ? 1 : n%100==3 || n%100==4 ? 2 : 3)';

		$sq = new GP_Locale();
		$sq->english_name = 'Albanian';
		$sq->native_name = 'Shqip';
		$sq->lang_code_iso_639_1 = 'sq';
		$sq->lang_code_iso_639_2 = 'sqi';
		$sq->wp_locale = 'sq';
		$sq->country_code = 'al';
		$sq->slug = 'sq';
		$sq->google_code = 'sq';

		$sr = new GP_Locale();
		$sr->english_name = 'Serbian';
		$sr->native_name = 'Српски језик';
		$sr->lang_code_iso_639_1 = 'sr';
		$sr->lang_code_iso_639_2 = 'srp';
		$sr->country_code = 'rs';
		$sr->wp_locale = 'sr_RS';
		$sr->slug = 'sr';
		$sr->google_code = 'sr';
		$sr->nplurals = 3;
		$sr->plural_expression = '(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 or n%100>=20) ? 1 : 2)';

		$su = new GP_Locale();
		$su->english_name = 'Sundanese';
		$su->native_name = 'Basa Sunda';
		$su->lang_code_iso_639_1 = 'su';
		$su->lang_code_iso_639_2 = 'sun';
		$su->country_code = 'id';
		$su->wp_locale = 'su_ID';
		$su->slug = 'su';
		$su->nplurals = 1;
		$su->plural_expression = '0';

		$sv = new GP_Locale();
		$sv->english_name = 'Swedish';
		$sv->native_name = 'Svenska';
		$sv->lang_code_iso_639_1 = 'sv';
		$sv->lang_code_iso_639_2 = 'swe';
		$sv->country_code = 'se';
		$sv->wp_locale = 'sv_SE';
		$sv->slug = 'sv';
		$sv->google_code = 'sv';

		$sw = new GP_Locale();
		$sw->english_name = 'Swahili';
		$sw->native_name = 'Kiswahili';
		$sw->lang_code_iso_639_1 = 'sw';
		$sw->lang_code_iso_639_2 = 'swa';
		$sw->country_code = '';
		$sw->wp_locale = 'sw';
		$sw->slug = 'sw';
		$sw->google_code = 'sw';

		$ta = new GP_Locale();
		$ta->english_name = 'Tamil';
		$ta->native_name = 'தமிழ்';
		$ta->lang_code_iso_639_1 = 'ta';
		$ta->lang_code_iso_639_2 = 'tam';
		$ta->country_code = 'IN';
		$ta->wp_locale = 'ta_IN';
		$ta->slug = 'ta';
		$ta->google_code = 'ta';

		$te = new GP_Locale();
		$te->english_name = 'Telugu';
		$te->native_name = 'తెలుగు';
		$te->lang_code_iso_639_1 = 'te';
		$te->lang_code_iso_639_2 = 'tel';
		$te->country_code = '';
		$te->wp_locale = 'te';
		$te->slug = 'te';
		$te->google_code = 'te';

		$th = new GP_Locale();
		$th->english_name = 'Thai';
		$th->native_name = 'ไทย';
		$th->lang_code_iso_639_1 = 'th';
		$th->lang_code_iso_639_2 = 'tha';
		$th->country_code = '';
		$th->wp_locale = 'th';
		$th->slug = 'th';
		$th->google_code = 'th';
		$th->nplurals = 1;
		$th->plural_expression = '0';
		
		$tlh = new GP_Locale();
		$tlh->english_name = 'Klingon';
		$tlh->native_name = 'TlhIngan';
		$tlh->lang_code_iso_639_1 = '';
		$tlh->lang_code_iso_639_2 = 'tlh';
		$tlh->country_code = '';
		$tlh->slug = 'tlh';
		$tlh->nplurals = 1;
		$tlh->plural_expression = '0';

		$tl = new GP_Locale();
		$tl->english_name = 'Tagalog';
		$tl->native_name = 'Tagalog';
		$tl->lang_code_iso_639_1 = 'tl';
		$tl->lang_code_iso_639_2 = 'tgl';
		$tl->country_code = 'ph';
		$tl->slug = 'tl';
		$tl->google_code = 'tl';

		$tr = new GP_Locale();
		$tr->english_name = 'Turkish';
		$tr->native_name = 'Türkçe';
		$tr->lang_code_iso_639_1 = 'tr';
		$tr->lang_code_iso_639_2 = 'tur';
		$tr->country_code = 'tr';
		$tr->wp_locale = 'tr_TR';
		$tr->slug = 'tr';
		$tr->google_code = 'tr';
		$tr->nplurals = 1;
		$tr->plural_expression = '0';

		$udm = new GP_Locale();
		$udm->english_name = 'Udmurt';
		$udm->native_name = 'удмурт кыл';
		$udm->lang_code_iso_639_1 = null;
		$udm->lang_code_iso_639_2 = 'udm';
		$udm->country_code = '';
		$udm->slug = 'udm';

		$ug = new GP_Locale();
		$ug->english_name = 'Uighur';
		$ug->native_name = 'Uyƣurqə';
		$ug->lang_code_iso_639_1 = 'ug';
		$ug->lang_code_iso_639_2 = 'uig';
		$ug->country_code = 'cn';
		$ug->wp_locale = 'ug_CN';
		$ug->slug = 'ug';
		$ug->google_code = 'ug';

		$uk = new GP_Locale();
		$uk->english_name = 'Ukrainian';
		$uk->native_name = 'Українська';
		$uk->lang_code_iso_639_1 = 'uk';
		$uk->lang_code_iso_639_2 = 'ukr';
		$uk->country_code = 'ua';
		$uk->wp_locale = 'uk';
		$uk->slug = 'uk';
		$uk->google_code = 'uk';
		$uk->nplurals = 3;
		$uk->plural_expression = '(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2)';

		$ur = new GP_Locale();
		$ur->english_name = 'Urdu';
		$ur->native_name = 'اردو';
		$ur->lang_code_iso_639_1 = 'ur';
		$ur->lang_code_iso_639_2 = 'urd';
		$ur->country_code = '';
		$ur->wp_locale = 'ur';
		$ur->slug = 'ur';
		$ur->google_code = 'ur';

		$uz = new GP_Locale();
		$uz->english_name = 'Uzbek';
		$uz->native_name = 'O‘zbekcha';
		$uz->lang_code_iso_639_1 = 'uz';
		$uz->lang_code_iso_639_2 = 'uzb';
		$uz->country_code = 'uz';
		$uz->wp_locale = 'uz_UZ';
		$uz->slug = 'uz';
		$uz->google_code = 'uz';
		$uz->rtl = true;
		$uz->nplurals = 1;
		$uz->plural_expression = '0';

		$vec = new GP_Locale();
		$vec->english_name = 'Venetian';
		$vec->native_name = 'vèneta';
		$vec->lang_code_iso_639_1 = null;
		$vec->lang_code_iso_639_2 = 'roa';
		$vec->country_code = 'uz';
		$vec->slug = 'vec';

		$vi = new GP_Locale();
		$vi->english_name = 'Vietnamese';
		$vi->native_name = 'Tiếng Việt';
		$vi->lang_code_iso_639_1 = 'vi';
		$vi->lang_code_iso_639_2 = 'vie';
		$vi->country_code = 'vn';
		$vi->wp_locale = 'vi';
		$vi->slug = 'vi';
		$vi->google_code = 'vi';
		$vi->nplurals = 1;
		$vi->plural_expression = '0';

		$wa = new GP_Locale();
		$wa->english_name = 'Walloon';
		$wa->native_name = 'Walon';
		$wa->lang_code_iso_639_1 = 'wa';
		$wa->lang_code_iso_639_2 = 'wln';
		$wa->country_code = 'be';
		$wa->wp_locale = 'wa';
		$wa->slug = 'wa';

		$yi = new GP_Locale();
		$yi->english_name = 'Yiddish';
		$yi->native_name = 'ייִדיש';
		$yi->lang_code_iso_639_1 = 'yi';
		$yi->lang_code_iso_639_2 = 'yid';
		$yi->country_code = '';
		$yi->slug = 'yi';
		$yi->google_code = 'yi';
		$yi->rtl = true;

		$zh_cn = new GP_Locale();
		$zh_cn->english_name = 'Chinese (China)';
		$zh_cn->native_name = '中文';
		$zh_cn->lang_code_iso_639_1 = 'zh';
		$zh_cn->lang_code_iso_639_2 = 'zho';
		$zh_cn->country_code = 'cn';
		$zh_cn->wp_locale = 'zh_CN';
		$zh_cn->slug = 'zh-cn';
		$zh_cn->google_code = 'zh-CN';
		$zh_cn->nplurals = 1;
		$zh_cn->plural_expression = '0';

		$zh_hk = new GP_Locale();
		$zh_hk->english_name = 'Chinese (Hong Kong)';
		$zh_hk->native_name = '香港中文版	';
		$zh_hk->lang_code_iso_639_1 = 'zh';
		$zh_hk->lang_code_iso_639_2 = 'zho';
		$zh_hk->country_code = 'hk';
		$zh_hk->wp_locale = 'zh_HK';
		$zh_hk->slug = 'zh-hk';
		$zh_hk->nplurals = 1;
		$zh_hk->plural_expression = '0';

		$zh_sg = new GP_Locale();
		$zh_sg->english_name = 'Chinese (Singapore)';
		$zh_sg->native_name = '中文';
		$zh_sg->lang_code_iso_639_1 = 'zh';
		$zh_sg->lang_code_iso_639_2 = 'zho';
		$zh_sg->country_code = 'sg';
		$zh_sg->slug = 'zh-sg';
		$zh_sg->nplurals = 1;
		$zh_sg->plural_expression = '0';

		$zh_tw = new GP_Locale();
		$zh_tw->english_name = 'Chinese (Taiwan)';
		$zh_tw->native_name = '中文';
		$zh_tw->lang_code_iso_639_1 = 'zh';
		$zh_tw->lang_code_iso_639_2 = 'zho';
		$zh_tw->country_code = 'tw';
		$zh_tw->slug = 'zh-tw';
		$zh_tw->wp_locale= 'zh_TW';
		$zh_tw->google_code = 'zh-TW';
		$zh_tw->nplurals = 1;
		$zh_tw->plural_expression = '0';

		$zh = new GP_Locale();
		$zh->english_name = 'Chinese';
		$zh->native_name = '中文';
		$zh->lang_code_iso_639_1 = 'zh';
		$zh->lang_code_iso_639_2 = 'zho';
		$zh->country_code = '';
		$zh->slug = 'zh';
		$zh->nplurals = 1;
		$zh->plural_expression = '0';
		
		foreach( get_defined_vars() as $locale ) {
			$this->locales[$locale->slug] = $locale;
		}
	}
	
	function &instance() {
		if ( !isset( $GLOBALS['gp_locales'] ) )
			$GLOBALS['gp_locales'] = &new GP_Locales();
		return $GLOBALS['gp_locales'];
	}
	
	function locales() {
		$instance = GP_Locales::instance();
		return $instance->locales;
	}
	
	function exists( $slug ) {
		$instance = GP_Locales::instance();
		return isset( $instance->locales[$slug] );
	}
	
	function by_slug( $slug ) {
		$instance = GP_Locales::instance();
		return isset( $instance->locales[$slug] )? $instance->locales[$slug] : null;
	}

	function by_field( $field_name, $field_value ) {
		$instance = GP_Locales::instance();
		$result = false;
		foreach( $instance->locales() as $locale ) {
			if ( isset( $locale->$field_name ) && $locale->$field_name == $field_value ) {
				$result = $locale;
				break;
			}
		}
		return $result;
	}
}
