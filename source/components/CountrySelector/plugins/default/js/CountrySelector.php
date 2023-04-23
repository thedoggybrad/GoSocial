/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Country Selector
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
$(document).ready(function() {
	if ($('#ossn-home-signup').length) {
		$('#country-selector').parent().find('label').hide();
		$('#country-selector').prepend("<option value=\"\" selected hidden>" + Ossn.Print('com:country:selector:label') + "</option>");
		<?php
		$component = new OssnComponents;
		$settings = $component->getSettings('CountrySelector');
		if ($settings && isset($settings->auto_locator) && $settings->auto_locator == 'on') {
		?>
			// retrieve the location of the visitor
			$.ajax({
				url: 'https://ipinfo.io',
				type: 'GET',
				dataType: 'json',
				async: false,
				success: function(json) {
					// and pre-select the corresponding entry in the dropdown
					$('#country-selector option[value=' + json.country + ']').prop('selected', 'selected').change();
				},
				error: function(err) {
					// fall back to manual selection in case no valid country code was returned
					console.log("Request failed, error= " + err);
				}
			});
		<?php
		}
		?>
	}
});
