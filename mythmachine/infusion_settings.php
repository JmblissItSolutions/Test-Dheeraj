<?php 

class MySettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Infusion API Settings Admin', 
            'Infusion API', 
            'manage_options', 
            'api-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'Infusion_api_option' );
        ?>
        <div class="wrap">
            <h1>Infusion API Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'Infusion_api_group' );
                do_settings_sections( 'api-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php

$api_settings = get_option('Infusion_api_option');
echo 'Token'.get_option("stored_tokensss",true);
echo "<br />";
//session_start();
require_once 'vendor/autoload.php';
$infusionsoft = new Infusionsoft\Infusionsoft(array(
    'clientId' => $api_settings['client_id'],
    'clientSecret' => $api_settings['client_secret'],
    'redirectUri' => 'https://mythmachine.com/wp-admin/options-general.php?page=api-setting-admin',
));
// By default, the SDK uses the Guzzle HTTP library for requests. To use CURL,
// you can change the HTTP client by using following line:
// $infusionsoft->setHttpClient(new \Infusionsoft\Http\CurlClient());
// If the serialized token is available in the session storage, we tell the SDK
// to use that token for subsequent requests.
$stored_token = get_option("stored_tokensss",true);
if ($stored_token) {
    $infusionsoft->setToken(unserialize($stored_token));
}
// If we are returning from Infusionsoft we need to exchange the code for an
// access token.
if (isset($_GET['code']) and !$infusionsoft->getToken()) {
    $infusionsoft->requestAccessToken($_GET['code']);
}
function add($infusionsoft, $email)
{
    $email1 = new \stdClass;
    $email1->field = 'EMAIL1';
    $email1->email = $email;
    $contact = ['given_name' => 'New', 'family_name' => 'Guy', 'email_addresses' => [$email1]];
    return $infusionsoft->contacts()->create($contact);

}
if ($infusionsoft->getToken()) {
    // try {
    //     $email = 'newguytagsss@example.com';
    //     try {
    //         $cid = $infusionsoft->contacts()->where('email', $email)->first();
    //     } catch (\Infusionsoft\InfusionsoftException $e) {
    //         $cid = add($infusionsoft, $email);
    //     }
    // } catch (\Infusionsoft\TokenExpiredException $e) {
    //     // If the request fails due to an expired access token, we can refresh
    //     // the token and then do the request again.
    //     $infusionsoft->refreshAccessToken();
    //     $cid = add($infusionsoft);
    
    $tag = ['description' => 'ChapterTag', 'name' => 'onfly6'];

    $result = $infusionsoft->tags()->create($tag);
    $return = $result->toArray();
    echo $return['id'];

    //$contact = $infusionsoft->contacts()->with('custom_fields')->find($cid->id);
    //var_dump($contact->toArray());
    // Save the serialized token to the current session for subsequent requests
    
    $new_token = $infusionsoft->getToken();
    //print_r($new_token->accessToken);
    update_option('stored_tokensss', serialize($new_token));
    // $contactID = $cid->id;
    // $tagID = array(112);
    // $contact->addTags($tagID);
    
} else {
    echo '<a href="' . $infusionsoft->getAuthorizationUrl() . '">Click here to authorize</a>';
}

















    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'Infusion_api_group', // Option group
            'Infusion_api_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Infusion API Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'api-setting-admin' // Page
        );  

        add_settings_field(
            'client_id', // ID
            'Client ID', // Title 
            array( $this, 'client_id_callback' ), // Callback
            'api-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'client_secret', 
            'Client Secret', 
            array( $this, 'client_secret_callback' ), 
            'api-setting-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['client_id'] ) )
            $new_input['client_id'] = sanitize_text_field( $input['client_id'] );

        if( isset( $input['client_secret'] ) )
            $new_input['client_secret'] = sanitize_text_field( $input['client_secret'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter INFUSIONSOFT API Settings Below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function client_id_callback()
    {
        printf(
            '<input type="text" id="client_id" name="Infusion_api_option[client_id]" value="%s" />',
            isset( $this->options['client_id'] ) ? esc_attr( $this->options['client_id']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function client_secret_callback()
    {
        printf(
            '<input type="text" id="client_secret" name="Infusion_api_option[client_secret]" value="%s" />',
            isset( $this->options['client_secret'] ) ? esc_attr( $this->options['client_secret']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new MySettingsPage();