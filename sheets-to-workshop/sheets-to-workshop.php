<?php
/*
Plugin Name: Google Sheet to Workshop
Description: En enkel plugin som henter data fra en Google Sheet og viser det på en side via en shortcode.
Version: 1.0
Author: Bjørn-Tore Almås
*/

// Legg til en meny for plugin-innstillinger
add_action('admin_menu', 'sheets2workshop_add_admin_menu');
function sheets2workshop_add_admin_menu() {
    add_options_page(
        'Sheets 2 Workshop Innstillinger', // Sidetittel
        'Sheets 2 Workshop',               // Menytittel
        'manage_options',                 // Kapasitet
        'sheets-2-workshop',               // Meny-slug
        'sheets2workshop_options_page'         // Funksjon som viser innholdet på innstillingssiden
    );
}

// Registrer innstillinger
add_action('admin_init', 'sheets2workshop_settings_init');
function sheets2workshop_settings_init() {
    register_setting('sheets2workshopPlugin', 'sheets2workshop_settings');

    add_settings_section(
        'sheets2workshop_section',
        __('Innstillinger', 'sheets-2-workshop'),
        null,
        'min-enkle-plugin'
    );

    add_settings_field(
        'sheets2workshop_json_url',
        __('JSON URL', 'sheets-2-workshop'),
        'sheets2workshop_json_url_render',
        'sheets-2-workshop',
        'sheets2workshop_section'
    );

    add_settings_field(
        'sheets2workshop_auth_token',
        __('Autentiseringstoken', 'sheets-2-workshop'),
        'sheets2workshop_auth_token_render',
        'sheets-2-workshop',
        'sheets2workshop_section'
    );
}

// Funksjon for å vise JSON URL-feltet
function sheets2workshop_json_url_render() {
    $options = get_option('sheets2workshop_settings');
    ?>
    <input type='text' name='sheets2workshop_settings[sheets2workshop_json_url]' value='<?php echo $options['sheets2workshop_json_url']; ?>'>
    <?php
}

// Funksjon for å vise autentiseringstoken-feltet
function sheets2workshop_auth_token_render() {
    $options = get_option('sheets2workshop_settings');
    ?>
    <input type='text' name='sheets2workshop_settings[sheets2workshop_auth_token]' value='<?php echo $options['sheets2workshop_auth_token']; ?>'>
    <?php
}

// Funksjon for å vise innstillingssiden
function sheets2workshop_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h2>Sheets 2 Workshop Innstillinger</h2>
        <?php
        settings_fields('sheets2workshopPlugin');
        do_settings_sections('sheets-2-workshop');
        submit_button();
        ?>
    </form>
    <?php
}
?>