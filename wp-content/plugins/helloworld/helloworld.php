<?php
/**
 * Plugin Name: Hello World 
 * Plugin URI: localhost 
 * Description: Đây là plugin đầu tiên mà tôi viết dành riêng cho WordPress, chỉ để học tập mà thôi. 
 * Version: 1.0 
 * Author: Hoang Neul 
 * Author URI: 
 * License: GPLv2 or later 
 * prefix : wps
 */


 //=========================create table in db=========================
/* register_activation_hook(__FILE__ , 'wps_login'); // gắn hàm vào quá trình kích hoạt 1 plug in mới
 function wps_login_table(){
     global $wpdb; // 
     $wps_table_name = $wpdb->prefix . 'wps_login_table';

     if($wpdb->getVar('SHOW TABLE LIKE "'. $wps_table_name . '"') !=  $wps_table_name ){
         $sql = 'CREATE TABLE ' . $wps_table_name . '( id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                                        username VARCHAR(32) NOT NULL,
                                                        password VARCHAR(32) NOT NULL,
                                                        age VARCHAR(32) NOT NULL,
                                                        phone VARCHAR(32) NOT NULL,
                                                        address VARCHAR(32) NOT NULL,
                                                        e-mail VARCHAR(32) NOT NULL) CHARSET= utf8';
        require_once ABSPATH .  '/wp-admin/includes/upgrade.php';
        dbDelta($sql);    
     }
 } */

// =========================wp_footer hook=========================
/*
add_action('wp_footer' , 'wps_footer_content',1);
add_action('wp_footer' , 'wps_footer_content2',2);
function wps_footer_content(){
    echo    'Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Labore autem, fugiat repellat minima ipsum sint accusantium ad debitis alias impedit.';
}
function wps_footer_content2(){
    echo    'HelloWorld.';
}
*/

//=========================add css js=========================
// add_action('wp_head', 'wps_add_new_css');
// function wps_add_new_css(){
//     $wps_cssurl  = plugins_url('/css/wps_style.css');
//     echo  '<link rel="stylesheet" href="'. $wps_cssurl . '" type="text/css" media="all">';
// }

//=========================check is_page=========================
// add_action('wp_footer', 'wps_check_page');
// function wps_check_page(){
//     echo 'page: '. is_page();
// }


//=========================abs=========================
//=========================abs=========================
//=========================abs=========================
//=========================abs=========================
//=========================abs=========================
//=========================abs=========================
//=========================abs=========================
//=========================abs=========================
//=========================abs=========================
?>