<?php
class ProamsaSettingsPage
{

    private $options;


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
            'Opciones Proamsa', 
            'Opciones Proamsa', 
            'manage_options', 
            'proamsa-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'proamsa_theme_options' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Proamsa</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'general_settings_group' );   
                do_settings_sections( 'proamsa-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'general_settings_group', // Option group
            'proamsa_theme_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'general_data', // ID
            'Opciones Globales', // Title
            array( $this, 'print_section_info' ), // Callback
            'proamsa-setting-admin' // Page
        );  

        add_settings_field(
            'id_feature_page', // ID
            'Pagina Destacada', // Title 
            array( $this, 'id_feature_callback' ), // Callback
            'proamsa-setting-admin', // Page
            'general_data' // Section           
        );      

          
    }

    /**
     * Sanitize each setting field as needed
     *
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

       

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print '';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_feature_callback()
    {
		echo '<select name="proamsa_theme_options[id_number]">';
		$selected = isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : '';
		
		  $pages = get_pages(); 
		  foreach ( $pages as $page ) {
			$option = '<option value="' . $page->ID  . '"'.(($selected==$page->ID )?' selected':'' ).'>';
			$option .= $page->post_title;
			$option .= '</option>';
			echo $option;
		  }
	 
		echo '</select>';
    
       
    }


}

if( is_admin() )
    $my_settings_page = new ProamsaSettingsPage();