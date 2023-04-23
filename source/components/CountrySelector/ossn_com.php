<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Country Selector
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__COUNTRY_SELECTOR__', ossn_route()->com . 'CountrySelector/');

function com_country_selector_init()
{
		ossn_extend_view('js/opensource.socialnetwork', 'js/CountrySelector');
		ossn_add_hook('user', 'default:fields', 'com_country_selector_extra_field');
		if (ossn_isLoggedin()) {
			ossn_add_hook('profile', 'subpage', 'com_country_selector_customfield_about_user_page');
		}
		if (ossn_isAdminLoggedin()){
			ossn_register_com_panel('CountrySelector', 'settings');
			ossn_register_action('CountrySelector/admin/settings', __COUNTRY_SELECTOR__ . 'actions/CountrySelector/admin/settings.php');		
		}	
}

function com_country_selector_customfield_about_user_page($hook, $type, $return, $params)
{
		if (isset($params['subpage']) && $params['subpage'] == 'about') {
			echo ossn_plugin_view('CountrySelector/CustomField', $params);
		}
}

function com_country_selector_extra_field($hook, $type, $fields)
{
		$component = new OssnComponents();
		if ($component->isActive('CustomFields')) {
			$label = true;
			$placeholder = ossn_print('com:country:selector:label');
		} else {
			$label = ossn_print('com:country:selector:label');
			$placeholder = '';
		}
		
		$options = array (
				'AF' => ossn_print('afghanistan'),
				'AX' => ossn_print('alandislands'),
				'AL' => ossn_print('albania'),
				'DZ' => ossn_print('algeria'),
				'AS' => ossn_print('americansamoa'),
				'AD' => ossn_print('andorra'),
				'AO' => ossn_print('angola'),
				'AI' => ossn_print('anguilla'),
				'AQ' => ossn_print('antarctica'),
				'AG' => ossn_print('antiguabarbuda'),
				'AR' => ossn_print('argentina'),
				'AM' => ossn_print('armenia'),
				'AW' => ossn_print('aruba'),
				'AU' => ossn_print('australia'),
				'AT' => ossn_print('austria'),
				'AZ' => ossn_print('azerbaijan'),
				'BS' => ossn_print('bahamas'),
				'BH' => ossn_print('bahrain'),
				'BD' => ossn_print('bangladesh'),
				'BB' => ossn_print('barbados'),
				'BY' => ossn_print('belarus'),
				'BE' => ossn_print('belgium'),
				'BZ' => ossn_print('belize'),
				'BJ' => ossn_print('benin'),
				'BM' => ossn_print('bermuda'),
				'BT' => ossn_print('bhutan'),
				'BO' => ossn_print('bolivia'),
				'BQ' => ossn_print('bonairesinteustatiussaba'),
				'BA' => ossn_print('bosniaherzegovina'),
				'BW' => ossn_print('botswana'),
				'BV' => ossn_print('bouvetisland'),
				'BR' => ossn_print('brazil'),
				'IO' => ossn_print('britishindianoceanterritory'),
				'BN' => ossn_print('bruneidarussalam'),
				'BG' => ossn_print('bulgaria'),
				'BF' => ossn_print('burkinafaso'),
				'BI' => ossn_print('burundi'),
				'KH' => ossn_print('cambodia'),
				'CM' => ossn_print('cameroon'),
				'CA' => ossn_print('canada'),
				'CV' => ossn_print('capeverde'),
				'KY' => ossn_print('caymanislands'),
				'CF' => ossn_print('centralafricanrepublic'),
				'TD' => ossn_print('chad'),
				'CL' => ossn_print('chile'),
				'CN' => ossn_print('china'),
				'CX' => ossn_print('christmasisland'),
				'CC' => ossn_print('cocoskeelingislands'),
				'CO' => ossn_print('colombia'),
				'KM' => ossn_print('comoros'),
				'CG' => ossn_print('congo'),
				'CD' => ossn_print('congodemocraticrepublic'),
				'CK' => ossn_print('cookislands'),
				'CR' => ossn_print('costarica'),
				'CI' => ossn_print('cotedivoire'),
				'HR' => ossn_print('croatia'),
				'CU' => ossn_print('cuba'),
				'CW' => ossn_print('curaçao'),
				'CY' => ossn_print('cyprus'),
				'CZ' => ossn_print('czechrepublic'),
				'DK' => ossn_print('denmark'),
				'DJ' => ossn_print('djibouti'),
				'DM' => ossn_print('dominica'),
				'DO' => ossn_print('dominicanrepublic'),
				'EC' => ossn_print('ecuador'),
				'EG' => ossn_print('egypt'),
				'SV' => ossn_print('elsalvador'),
				'GQ' => ossn_print('equatorialguinea'),
				'ER' => ossn_print('eritrea'),
				'EE' => ossn_print('estonia'),
				'ET' => ossn_print('ethiopia'),
				'FK' => ossn_print('falklandislands'),
				'FO' => ossn_print('faroeislands'),
				'FJ' => ossn_print('fiji'),
				'FI' => ossn_print('finland'),
				'FR' => ossn_print('france'),
				'GF' => ossn_print('frenchguiana'),
				'PF' => ossn_print('frenchpolynesia'),
				'TF' => ossn_print('frenchsouthern'),
				'GA' => ossn_print('gabon'),
				'GM' => ossn_print('gambia'),
				'GE' => ossn_print('georgia'),
				'DE' => ossn_print('germany'),
				'GH' => ossn_print('ghana'),
				'GI' => ossn_print('gibraltar'),
				'GR' => ossn_print('greece'),
				'GL' => ossn_print('greenland'),
				'GD' => ossn_print('grenada'),
				'GP' => ossn_print('guadeloupe'),
				'GU' => ossn_print('guam'),
				'GT' => ossn_print('guatemala'),
				'GG' => ossn_print('guernsey'),
				'GN' => ossn_print('guinea'),
				'GW' => ossn_print('guineabissau'),
				'GY' => ossn_print('guyana'),
				'HT' => ossn_print('haiti'),
				'HM' => ossn_print('heardislandmcdonaldislands'),
				'VA' => ossn_print('vaticancitystate'),
				'HN' => ossn_print('honduras'),
				'HK' => ossn_print('hongkong'),
				'HU' => ossn_print('hungary'),
				'IS' => ossn_print('iceland'),
				'IN' => ossn_print('india'),
				'ID' => ossn_print('indonesia'),
				'IR' => ossn_print('iranislamicrepublic'),
				'IQ' => ossn_print('iraq'),
				'IE' => ossn_print('ireland'),
				'IM' => ossn_print('isleofman'),
				'IL' => ossn_print('israel'),
				'IT' => ossn_print('italy'),
				'JM' => ossn_print('jamaica'),
				'JP' => ossn_print('japan'),
				'JE' => ossn_print('jersey'),
				'JO' => ossn_print('jordan'),
				'KZ' => ossn_print('kazakhstan'),
				'KE' => ossn_print('kenya'),
				'KI' => ossn_print('kiribati'),
				'KP' => ossn_print('koreanorth'),
				'KR' => ossn_print('koreasouth'),
				'KW' => ossn_print('kuwait'),
				'KG' => ossn_print('kyrgyzstan'),
				'LA' => ossn_print('laopeoplesdemocraticrepublic'),
				'LV' => ossn_print('latvia'),
				'LB' => ossn_print('lebanon'),
				'LS' => ossn_print('lesotho'),
				'LR' => ossn_print('liberia'),
				'LY' => ossn_print('libya'),
				'LI' => ossn_print('liechtenstein'),
				'LT' => ossn_print('lithuania'),
				'LU' => ossn_print('luxembourg'),
				'MO' => ossn_print('macao'),
				'MK' => ossn_print('macedonia'),
				'MG' => ossn_print('madagascar'),
				'MW' => ossn_print('malawi'),
				'MY' => ossn_print('malaysia'),
				'MV' => ossn_print('maldives'),
				'ML' => ossn_print('mali'),
				'MT' => ossn_print('malta'),
				'MH' => ossn_print('marshallislands'),
				'MQ' => ossn_print('martinique'),
				'MR' => ossn_print('mauritania'),
				'MU' => ossn_print('mauritius'),
				'YT' => ossn_print('mayotte'),
				'MX' => ossn_print('mexico'),
				'FM' => ossn_print('micronesiafederatedstates'),
				'MD' => ossn_print('moldova'),
				'MC' => ossn_print('monaco'),
				'MN' => ossn_print('mongolia'),
				'ME' => ossn_print('montenegro'),
				'MS' => ossn_print('montserrat'),
				'MA' => ossn_print('morocco'),
				'MZ' => ossn_print('mozambique'),
				'MM' => ossn_print('myanmar'),
				'NA' => ossn_print('namibia'),
				'NR' => ossn_print('nauru'),
				'NP' => ossn_print('nepal'),
				'NL' => ossn_print('netherlands'),
				'AN' => ossn_print('netherlandsantilles'),
				'NC' => ossn_print('newcaledonia'),
				'NZ' => ossn_print('newzealand'),
				'NI' => ossn_print('nicaragua'),
				'NE' => ossn_print('niger'),
				'NG' => ossn_print('nigeria'),
				'NU' => ossn_print('niue'),
				'NF' => ossn_print('norfolkisland'),
				'MP' => ossn_print('northernmarianaislands'),
				'NO' => ossn_print('norway'),
				'OM' => ossn_print('oman'),
				'PK' => ossn_print('pakistan'),
				'PW' => ossn_print('palau'),
				'PS' => ossn_print('palestinianterritory'),
				'PA' => ossn_print('panama'),
				'PG' => ossn_print('papuanewguinea'),
				'PY' => ossn_print('paraguay'),
				'PE' => ossn_print('peru'),
				'PH' => ossn_print('philippines'),
				'PN' => ossn_print('pitcairn'),
				'PL' => ossn_print('poland'),
				'PT' => ossn_print('portugal'),
				'PR' => ossn_print('puertorico'),
				'QA' => ossn_print('qatar'),
				'RE' => ossn_print('reunion'),
				'RO' => ossn_print('romania'),
				'RU' => ossn_print('russianfederation'),
				'RW' => ossn_print('rwanda'),
				'BL' => ossn_print('saintbarthelemy'),
				'SH' => ossn_print('sainthelenaascensiontristandacunha'),
				'KN' => ossn_print('saintkittsnevis'),
				'LC' => ossn_print('saintlucia'),
				'MF' => ossn_print('saintmartin'),
				'PM' => ossn_print('saintpierremiquelon'),
				'VC' => ossn_print('saintvincentgrenadines'),
				'WS' => ossn_print('samoa'),
				'SM' => ossn_print('sanmarino'),
				'ST' => ossn_print('saotomeprincipe'),
				'SA' => ossn_print('saudiarabia'),
				'SN' => ossn_print('senegal'),
				'RS' => ossn_print('serbia'),
				'SC' => ossn_print('seychelles'),
				'SL' => ossn_print('sierraleone'),
				'SG' => ossn_print('singapore'),
				'SX' => ossn_print('sintmaarten'),
				'SK' => ossn_print('slovakia'),
				'SI' => ossn_print('slovenia'),
				'SB' => ossn_print('solomonislands'),
				'SO' => ossn_print('somalia'),
				'ZA' => ossn_print('southafrica'),
				'GS' => ossn_print('southgeorgiasouthsandwichislands'),
				'SS' => ossn_print('southsudan'),
				'ES' => ossn_print('spain'),
				'LK' => ossn_print('srilanka'),
				'SD' => ossn_print('sudan'),
				'SR' => ossn_print('suriname'),
				'SJ' => ossn_print('svalbardandjanmayen'),
				'SZ' => ossn_print('swaziland'),
				'SE' => ossn_print('sweden'),
				'CH' => ossn_print('switzerland'),
				'SY' => ossn_print('syrianarabrepublic'),
				'TW' => ossn_print('taiwan'),
				'TJ' => ossn_print('tajikistan'),
				'TZ' => ossn_print('tanzania'),
				'TH' => ossn_print('thailand'),
				'TL' => ossn_print('timorleste'),
				'TG' => ossn_print('togo'),
				'TK' => ossn_print('tokelau'),
				'TO' => ossn_print('tonga'),
				'TT' => ossn_print('trinidadandtobago'),
				'TN' => ossn_print('tunisia'),
				'TR' => ossn_print('turkey'),
				'TM' => ossn_print('turkmenistan'),
				'TC' => ossn_print('turkscaicosislands'),
				'TV' => ossn_print('tuvalu'),
				'UG' => ossn_print('uganda'),
				'UA' => ossn_print('ukraine'),
				'AE' => ossn_print('unitedarabemirates'),
				'GB' => ossn_print('unitedkingdom'),
				'US' => ossn_print('unitedstates'),
				'UM' => ossn_print('unitedstatesminoroutlyingislands'),
				'UY' => ossn_print('uruguay'),
				'UZ' => ossn_print('uzbekistan'),
				'VU' => ossn_print('vanuatu'),
				'VE' => ossn_print('venezuela'),
				'VN' => ossn_print('vietnam'),
				'VG' => ossn_print('virginislandsgb'),
				'VI' => ossn_print('virginislandsus'),
				'WF' => ossn_print('wallisfutuna'),
				'EH' => ossn_print('westernsahara'),
				'YE' => ossn_print('yemen'),
				'ZM' => ossn_print('zambia'),
				'ZW' => ossn_print('zimbabwe')
		);
		// SORT_LOCALE_STRING needs LC_COLLATE to be set like 'de_DE.utf8' in order to work
		$locale = ossn_site_settings('language');
		if (ossn_isLoggedin() && isset(ossn_loggedin_user()->language)) {
			$locale = ossn_loggedin_user()->language;
		}
		$locale = $locale . '_' . strtoupper($locale) . '.utf8';
		setlocale(LC_COLLATE, $locale);
		array_multisort($options, SORT_ASC, SORT_LOCALE_STRING, array_keys($options));

		$extrafield = 	array(
			'name' => 'country',
			'label' => $label,
			'placeholder' => $placeholder,
			'display_on_about_page' => true,
			'options' => $options,
			'id' => 'country-selector'
		);
		$fields['required']['dropdown'][] = $extrafield;
		return $fields;
}

ossn_register_callback('ossn', 'init', 'com_country_selector_init');
