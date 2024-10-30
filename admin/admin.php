<?php 
    // Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) exit;

    add_action('admin_menu', 'cf7liz_add_page');
        //function to add page under setting options in wordpress admin section
        function cf7liz_add_page() {
            add_options_page('Zoho Setting Page', 'Zoho Settings', 'manage_options', 'cf7liz_plugin', 'cf7liz_plugin_options_frontpage');
        } 

    function cf7liz_plugin_options_frontpage()
    {
?>
        <div class="wrap">
            <h1>Zoho Settings<hr></h1>         
            <form action="options.php" method="post">
            <?php settings_fields('cf7liz_plugin_options'); ?>
            <?php do_settings_sections('cf7liz_plugin'); ?>
            <table class="form-table"> 
              <tr valign="top">
                <td colspan="2">
                    <input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
                </td>
              </tr>
            </table>
            </form>
        </div>
<?php
    }    

    add_action('admin_init', 'cf7liz_plugin_admin_init');

    function cf7liz_plugin_admin_init(){
        register_setting( 'cf7liz_plugin_options', 'cf7liz_plugin_options', 'cf7liz_plugin_options_validate' );
        add_settings_section('cf7liz_plugin_main', 'Zoho Settings', 'cf7liz_plugin_section_text', 'cf7liz_plugin');
        add_settings_field('cf7liz_plugin_text_input1', 'Zoho Auth Token', 'cf7liz_plugin_input1', 'cf7liz_plugin', 'cf7liz_plugin_main');
        add_settings_field('cf7liz_plugin_text_input2', 'Company Name', 'cf7liz_plugin_input2', 'cf7liz_plugin', 'cf7liz_plugin_main');
    }

    function cf7liz_plugin_section_text() {
        //echo '<p>New input setting to be saved.</p>';
    }

    function cf7liz_plugin_input1() {
        $options = get_option('cf7liz_plugin_options');
        echo "<input id='plugin_input1' class='normal-text code' name='cf7liz_plugin_options[auth_token]' size='30' type='text' value='{$options['auth_token']}' />";
    }

    function cf7liz_plugin_input2() {
        $options = get_option('cf7liz_plugin_options');
        echo "<input id='plugin_input2' class='normal-text code' name='cf7liz_plugin_options[company]' size='30' type='text' value='{$options['company']}' />";
    }

    function cf7liz_plugin_options_validate($input) {
        $options = get_option('cf7liz_plugin_options');
        $options['auth_token'] = trim($input['auth_token']);
        $options['company'] = trim($input['company']);
        if(!preg_match('/^[a-z0-9]{32}$/i', $options['auth_token'])) {
            $options['auth_token'] = '';
        }        
        return $options;
    }