<?php
//
// CheezCap - Cheezburger Custom Administration Panel
// (c) 2008 - 2010 Cheezburger Network (Pet Holdings, Inc.)
// LOL: http://cheezburger.com
// Source: http://code.google.com/p/cheezcap/
// Authors: Kyall Barrows, Toby McKes, Stefan Rusek, Scott Porad
// License: GNU General Public License, version 2 (GPL), http://www.gnu.org/licenses/gpl-2.0.html
//
require_once('get-pro.php');
require_once('page-meta-box.php');
require_once('post-meta-box.php');
require_once('cc-upload.php');
require_once('library.php');
require_once('config.php');

$cap = new autoconfig();

if (!defined('LOADED_CONFIG'))
{
    add_action('admin_menu', 'cap_add_admin');
    define('LOADED_CONFIG', 1);
}

function cap_add_admin() 
{
    global $themename;
	
	if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) 
	{
		$options = cap_get_options();
		$action = '';
		if (isset($_REQUEST["action"]) && !empty($_REQUEST["action"])) $action = $_REQUEST["action"];
		$method = false;
        $done = false;
        $data = new ImportData();
        switch ($action)
        {
        case 'save':
			$method = 'Update';
            break;

        case 'Reset':
 			global $wpdb;
			$options = $wpdb->get_results("SELECT * FROM wp_options ORDER BY option_name");
			foreach((array) $options as $option) :
	  			$option->option_name = esc_attr($option->option_name);
	  			if(substr($option->option_name, 0, 4)=='cap_') {
	    			delete_option($option->option_name);     
	  			}
      		endforeach;
			$method = false;
            break;

        case 'Export':
            $method = 'Export';
            $done = 'cap_serialize_export';
            break;

        case 'Import':
            $method = 'Import';
            $data = unserialize(file_get_contents($_FILES["file"]["tmp_name"]));
            break;
        }

        if ($method)
        {
            foreach ($options as $group) 
			{
				foreach($group->options as $option)
                {
                    call_user_func(array($option, $method), $data);
				}
            }
            if ($done)
                call_user_func($done, $data);
        }
	}
	
	$pgName = $themename . " Settings";
	add_menu_page($pgName, $pgName, 'manage_options', basename(__FILE__), 'top_level_settings');
	
}

?>
