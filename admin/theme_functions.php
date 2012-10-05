<?php

function wonderfullstores_shorten_string($string, $amount)
{
	if(strlen($string) > $amount)
	{
		$string = trim(substr($string, 0, $amount))." ...";
	}
	return $string;
}

add_action('admin_menu', 'themeoptions_admin_add_page');

add_action('admin_enqueue_scripts', 'themeoptions_admin_enqueue_scripts');
function themeoptions_admin_enqueue_scripts()
{

	wp_enqueue_style('jPicker-1.1.6.min.css', plugins_url('admin/css/jPicker-1.1.6.min.css',dirname(__FILE__)), false, '1.0');		
	wp_enqueue_script('jquery');
	wp_enqueue_script('jpicker-1.1.6.min.js', plugins_url('admin/js/jpicker-1.1.6.min.js',dirname(__FILE__)), array('jquery'), '1.1.6');
	wp_localize_script('jpicker-1.1.6.min.js', 'themenitro_images', array('dir' => plugins_url('admin/images/',dirname(__FILE__))));

}

//specify which function to be called to create plugin settings
add_action('admin_init', 'themeoptions_admin_init');

//add the options page for the plugin
function themeoptions_admin_add_page()
{
	add_menu_page('Theme Options', 'Theme Options', 'manage_options', 'themeoptions', 'themeoptions_options_page');
}

// function ws_activate(){
	
	// require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	// global $wpdb;
	// $table_campagin = $wpdb->prefix . "ws_campaign";
	// $sql = "CREATE TABLE if not exists $table_campagin (
          // id mediumint(9) NOT NULL AUTO_INCREMENT,
          // created_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          // username VARCHAR(55) NOT NULL,
		  // nama_lengkap VARCHAR(50) NOT NULL,
		  // alamat VARCHAR(100) NOT NULL,
          // kota VARCHAR(100) DEFAULT '' NOT NULL,
		  // kode_pos VARCHAR(50) DEFAULT '' NOT NULL,
		  // negara VARCHAR(50) DEFAULT '' NOT NULL,
		  // telepon VARCHAR(50) DEFAULT '' NOT NULL,
		  // fax VARCHAR(50) DEFAULT '' NOT NULL,
		  // email VARCHAR(100) NOT NULL,
		  // password VARCHAR(50) NOT NULL,
          // UNIQUE KEY id (id)
          // );";
   // dbDelta($sql);
// }
// register_activation_hook(__FILE__,'ws_activate');

// function ws_deactivate(){
	// require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	// global $wpdb;
	// $table_campagin = $wpdb->prefix . "ws_campaign";
	// $sqlebook = "DROP TABLE if exists $table_campagin";
	// $wpdb->query($sqlebook);
// }
// register_deactivation_hook(__FILE__,'ws_deactivate');

//render the options page
function themeoptions_options_page()
{
	?>
		<div class="wrap">
			<?php
				screen_icon('themes');
				$tab = isset( $_GET['tab'] ) ? $_GET['tab'] : "themeoptions_generalsetting_options";
			?>

			<h2 class="nav-tab-wrapper">

			<a class="nav-tab <?php if($tab == "themeoptions_generalsetting_options") echo "nav-tab-active"; ?>" href="?page=themeoptions&tab=themeoptions_generalsetting_options">General Setting</a>
<a class="nav-tab <?php if($tab == "themeoptions_seosetting_options") echo "nav-tab-active"; ?>" href="?page=themeoptions&tab=themeoptions_seosetting_options">SEO Setting</a>
<a class="nav-tab <?php if($tab == "wonderfullstores_aws_options") echo "nav-tab-active"; ?>" href="?page=themeoptions&tab=wonderfullstores_aws_options">API Setting</a>
<a class="nav-tab <?php if($tab == "wonderfullstores_aws_settings") echo "nav-tab-active"; ?>" href="?page=themeoptions&tab=wonderfullstores_aws_settings">Create Post</a>

				
			</h2>
			<form action="options.php" enctype="multipart/form-data" method="post">
			<?php
				settings_fields($tab);
				do_settings_sections($tab);

				$submitbutton = true;
				if($tab == "wonderfullstores_aws_settings") submit_button('Generate Post');
				if($tab == "wonderfullstores_aws_options") $submitbutton = true;
				if($tab == "themeoptions_seosetting_options") $submitbutton = true;
				if($tab == "themeoptions_generalsetting_options") $submitbutton = true;
				//if($tab == "profitlibrary_editcontent_options" && (!isset($_GET['cmd']))) $submitbutton = false;
				//if($tab == "profitlibrary_affiliates_options" && (!isset($_GET['cmd']))) $submitbutton = false;
				if($submitbutton && $tab == "wonderfullstores_aws_options" || $tab == "themeoptions_seosetting_options" || $tab == "themeoptions_generalsetting_options") submit_button();

			?>
			</form>
		</div>
	<?php
}

//create plugin settings
function themeoptions_admin_init()
{

		register_setting('themeoptions_generalsetting_options', 'themeoptions_generalsetting_options','themeoptions_generalsetting_options_validate');
	add_settings_section('themeoptions_generalsetting_options', 'Settings', 'themeoptions_generalsetting_options_section_text', 'themeoptions_generalsetting_options');
	add_settings_field('themeoptions_logoupload_option', 'Logo_upload', 'themeoptions_logoupload_option', 'themeoptions_generalsetting_options', 'themeoptions_generalsetting_options');
	add_settings_field('themeoptions_backgroundcolor_option', 'Background Color', 'themeoptions_backgroundcolor_option', 'themeoptions_generalsetting_options', 'themeoptions_generalsetting_options');
	add_settings_field('themeoptions_addtionalcolorskin_option', 'Addtional Color Skin', 'themeoptions_addtionalcolorskin_option', 'themeoptions_generalsetting_options', 'themeoptions_generalsetting_options');
	add_settings_field('themeoptions_facebookurl_option', 'Facebook Url', 'themeoptions_facebookurl_option', 'themeoptions_generalsetting_options', 'themeoptions_generalsetting_options');
	add_settings_field('themeoptions_twitterurl_option', 'Twitter url', 'themeoptions_twitterurl_option', 'themeoptions_generalsetting_options', 'themeoptions_generalsetting_options');
	add_settings_field('themeoptions_linkedinurl_option', 'Linkedinurl', 'themeoptions_linkedinurl_option', 'themeoptions_generalsetting_options', 'themeoptions_generalsetting_options');
	add_settings_field('themeoptions_welcometitle_option', 'Welcome Title', 'themeoptions_welcometitle_option', 'themeoptions_generalsetting_options', 'themeoptions_generalsetting_options');
	add_settings_field('themeoptions_welcomedescription_option', 'Welcome Description', 'themeoptions_welcomedescription_option', 'themeoptions_generalsetting_options', 'themeoptions_generalsetting_options');

		register_setting('themeoptions_seosetting_options', 'themeoptions_seosetting_options','themeoptions_seosetting_options_validate');
	add_settings_section('themeoptions_seosetting_options', 'Settings', 'themeoptions_seosetting_options_section_text', 'themeoptions_seosetting_options');
	add_settings_field('themeoptions_metakeywords_option', 'Meta Keywords', 'themeoptions_metakeywords_option', 'themeoptions_seosetting_options', 'themeoptions_seosetting_options');
	add_settings_field('themeoptions_metatag_option', 'Meta Tag', 'themeoptions_metatag_option', 'themeoptions_seosetting_options', 'themeoptions_seosetting_options');
	add_settings_field('themeoptions_metadescrtiption_option', 'Meta Descrtiption', 'themeoptions_metadescrtiption_option', 'themeoptions_seosetting_options', 'themeoptions_seosetting_options');

		register_setting('wonderfullstores_aws_options', 'wonderfullstores_aws_options','wonderfullstores_aws_options_validate');
	add_settings_section('wonderfullstores_aws_options', 'AWS Affiliates', 'wonderfullstores_aws_text', 'wonderfullstores_aws_options');
	add_settings_field('wonderfullstores_access_key', 'Access Key', 'wonderfullstores_access_key', 'wonderfullstores_aws_options', 'wonderfullstores_aws_options');
	add_settings_field('wonderfullstores_secret_key', 'Secret Key', 'wonderfullstores_secret_key', 'wonderfullstores_aws_options', 'wonderfullstores_aws_options');
	add_settings_field('wonderfullstores_associate_key', 'Associate Key', 'wonderfullstores_associate_key', 'wonderfullstores_aws_options', 'wonderfullstores_aws_options');
	
		register_setting('wonderfullstores_aws_settings', 'wonderfullstores_aws_settings', 'wonderfullstores_aws_settings_validate');
	add_settings_section('wonderfullstores_aws_settings', 'Settings', 'wonderfullstores_aws_settings_text', 'wonderfullstores_aws_settings');
	add_settings_field('wonderfullstores_aws_keyword', 'Keyword', 'wonderfullstores_aws_keyword', 'wonderfullstores_aws_settings', 'wonderfullstores_aws_settings');
	add_settings_field('wonderfullstores_aws_category', 'Category Search', 'wonderfullstores_aws_category', 'wonderfullstores_aws_settings', 'wonderfullstores_aws_settings');
	//add_settings_field('wonderfullstores_aws_country', 'Amazon Region', 'wonderfullstores_aws_country', 'wonderfullstores_aws_settings', 'wonderfullstores_aws_settings');
	add_settings_field('wonderfullstores_aws_poststatus', 'Post Status', 'wonderfullstores_aws_poststatus', 'wonderfullstores_aws_settings', 'wonderfullstores_aws_settings');
	add_settings_field('wonderfullstores_product_display', 'Post To Create', 'wonderfullstores_product_display', 'wonderfullstores_aws_settings', 'wonderfullstores_aws_settings');
	add_settings_field('wonderfullstores_post_category', 'Post Category', 'wonderfullstores_post_category', 'wonderfullstores_aws_settings', 'wonderfullstores_aws_settings');
	
	
}
// function set_featured_image($post_id,$filename) {
	// $wp_filetype = wp_check_filetype(basename($filename), null );
	// $attachment = array(
		// 'post_mime_type' => $wp_filetype['type'],
		// 'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
		// 'post_content' => '',
		// 'post_status' => 'inherit'
	// );
	// $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
	// // you must first include the image.php file
	// // for the function wp_generate_attachment_metadata() to work
	// require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	// $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	// if (wp_update_attachment_metadata( $attach_id,  $attach_data )) {
		// // set as featured image
		// return update_post_meta($post_id, '_thumbnail_id', $attach_id);
	// }
// }

//require_once('amazon_api_class.php');
require_once('wonderfullstores_aws_settings.php');

?>