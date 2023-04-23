<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Favicons
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

ossn_register_languages('de', array(
	// admin backend
	'favicons' => 'Favicons', // Configure menu entry - don't translate

	'com_favicons_enabling_service_worker_failure' => 'Service worker Aktivierung nicht möglich',
	'com_favicons_settings_workflow' => '
		Um Favicons für deine Seite zu erstellen, musst du: <br><br>
		1. Einen API-Schlüssel anfordern<br>
		2. Ein Bild als Vorlage hochladen, von dem die Favicons generiert werden sollen<br>
		3. "Speichern" klicken, um deine Einstellungen zu sichern<br>
		4. "Favicons erstellen" klicken<br>
		5. "Favicons installieren" klicken<br>',
	'com_favicons_settings_api_key' => 'API-Schlüssel',
	'com_favicons_settings_api_key_instruction' => 'Fordere einen Schlüssel von %s an und gib ihn hier unten ein',
	'com_favicons_settings_api_key_saved' => 'API-Schlüssel erfolgreich gespeichert',
	'com_favicons_settings_master_image' => 'Bild-Vorlage',
	'com_favicons_settings_master_image_instruction' => 'mit Vorschau auf die generierten Favicons - wichtige Bestandteile sollten innerhalb des nicht maskierten Bereich plaziert sein',
	'com_favicons_settings_master_image_instruction_upload' => 'Neue Bild-Vorlage hochladen (ein quadratisches PNG Bild mit mindestens 512 x 512 Pixel Kantenlänge)',
	'com_favicons_settings_master_image_too_large' => 'Die Bild-Datei darf nicht größer als 500 kB sein',
	'com_favicons_settings_master_image_wrong_type' => 'Die Bild-Datei muss eine PNG-Datei sein',
	'com_favicons_settings_master_image_wrong_aspect_ratio' => 'Die Bild-Datei muss QUADRATISCH sein',
	'com_favicons_settings_master_image_too_small' => 'Die minimale Höhe und Breite muss mindestens 512 pixel betragen',
	'com_favicons_settings_master_image_and_key_saved' => 'API-Schlüssel und Bild-Vorlage wurden erfolgreich gespeichert',
	'com_favicons_settings_master_image_saved' => 'Die Bild-Vorlage wurde  erfolgreich gespeichert',
	'com_favicons_settings_master_image_upload_failed' => 'Das Hochladen der Bild-Vorlage ist fehlgeschlagen',
	'com_favicons_settings_mkdir_failed' => 'Das Unterverzeichnis für die Favicons konnte nicht angelegt werden',
	'com_favicons_settings_favicon_generator' => 'Favicon Generator',
	'com_favicons_settings_favicon_generator_instruction' => '
		Beim Klicken auf <b>Favicons erstellen</b> generiert RealFaviconGenerator.net eine Reihe von Favicons,
		die von deiner Bildvorlage abgeleitet sind, zusammen mit den erforderlichen HTML-Header-Tags, um die Favicons korrekt einzubinden.
		Hab Geduld und schließe diese Seite nicht, bevor unten eine Erfolgsmeldung angezeigt wird.',
	'com_favicons_settings_create_favicons' => 'Favicons erstellen',
	'com_favicons_settings_preview' => 'Vorschau',
	'com_favicons_settings_installation' => 'Installation',
	'com_favicons_settings_installation_instruction' => '
		Wenn Du mit der Vorschau zufrieden bist, klicke <b>Favicons installieren</b> - 
		ansonsten lade eine neue Bild-Vorlage hoch und wiederhole den Erstellungsvorgang.',
	'com_favicons_settings_install_favicons' => 'Favicons installieren',
	'com_favicons_settings_files_location' => 'Speicherort der Dateien',
	'com_favicons_settings_files_location_instruction' => 'Deine Favicon-Dateien befinden sich in',
	'com_favicons_settings_files_location_instruction_migrating' => '
		Wenn du deine Seite migrieren willst oder ein Ossn-Upgrade vorbereitest, erstelle zuerst eine Sicherungskopie dieses Verzeichnisses
		und kopiere es anschließend wieder zurück an dieselbe Stelle, um zu vermeiden, dass die Favicons erneut erstellt werden müssen.',
	'com_favicons_settings_error_session_timeout' => 'Fehler: Sitzung abgelaufen oder ein Netzwerkproblem',
	
	'com_favicons_create_error_getting_post_data' => 'Fehler: beim abrufen der Post Daten',
	'com_favicons_create_processing_generating_icons' => 'Favicons werden generiert ... Dies kann je nach Netzwerk etwa eine Minute oder sogar länger dauern',
	'com_favicons_create_error_no_response' => 'Fehler: Keine Antwort von RealFaviconGenerator.net',
	'com_favicons_create_error_api_request' => 'Fehler: API-Anfrage %s',
	'com_favicons_create_processing_processing_archive' => 'Verarbeitung des Favicon-Archivs ...',
	'com_favicons_create_error_processing_archive' => 'Fehler: Verarbeitung des Favicon-Archivs %s',
	'com_favicons_create_processing_success' => 'Erfolg!',
	
	'com_favicons_install_processing_opening_download_dir' => 'Download-Verzeichnis wird geöffnet',
	'com_favicons_install_processing_copying_package' => 'Favicons-Paket wird kopiert',
	'com_favicons_install_error_copying_package' => 'Fehler: beim Kopieren des Favicons-Pakets',
	'com_favicons_install_processing_updating_manifest' => 'Manifestdatei wird aktualisiert',
	'com_favicons_install_processing_success' => 'Erfolg',
	
));