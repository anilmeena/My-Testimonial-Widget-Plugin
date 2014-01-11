<?php
/*
Plugin Name: My Testimonial Plugin
Description: A simple Testimonial plugin which also have an widget
Version: 1.0
Author: Anil Meena
License: GPL2
*/

global $wpdb;

function my_testimonial_get_the_ip() {
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	else {
		return $_SERVER["REMOTE_ADDR"];
	}
}

register_activation_hook(__FILE__,"my_testimonial_plugin_active");
register_deactivation_hook(__FILE__,"my_testimonial_plugin_deactive");

function my_testimonial_plugin_active(){
	global $wpdb;
	$testimonial_table = $wpdb->prefix . "my_testimonials";
	
	$query = "CREATE TABLE $testimonial_table (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  uname VARCHAR(60) DEFAULT '' NOT NULL,
	  name tinytext NOT NULL,
	  message text NOT NULL,
	  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	  modifydate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	  PRIMARY KEY id (id)
	);";

	require_once(ABSPATH . "wp-admin/includes/upgrade.php");
	dbDelta($query);

	$welcome_name = "Test User";
	$welcome_message = "This is a sample testimonial post.";
	$rows_affacted = $wpdb->insert($testimonial_table, array('name' => $welcome_name, 'message' => $welcome_message, 'time' => current_time('mysql')));
}

function my_testimonial_plugin_deactive(){
	global $wpdb;
	$testimonial_table = $wpdb->prefix . "my_testimonials";
	$wpdb->query("DROP TABLE IF EXISTS $testimonial_table ");
}
if ( is_admin() ){

add_action('admin_menu', 'my_testimonial_admin_menu');

function my_testimonial_admin_menu() {
add_menu_page( 'My Testimonials Settings', 'My Testimonials', 2, 'my-testimonial/my-testimonial-plugin.php', 'my_testimonial_all_post', $icon_url, 125 );
}
}

if(isset($_POST['newtest']   )){
	$uid = $_POST['my_testimonial_user_id'];
	$name = $_POST['my_testimonial_name'];
	$msg = $_POST['my_testimonial_msg'];
	my_testimonial_insert_db($uid,$name,$msg);
}
function my_testimonial_insert_db($uid,$name,$msg){
	global $wpdb;
	$testimonial_table = $wpdb->prefix . "my_testimonials";
	$rows_affacted = $wpdb->insert($testimonial_table, array('uname' => $uid, 'name' => $name, 'message' => $msg, 'time' => current_time('mysql')));
}

add_action('admin_menu','my_testimonial_edit');

if(isset($_REQUEST['edit'])){
	$testid = $_REQUEST['testid'];
}
function my_testimonial_edit(){
	add_submenu_page( 'my-testimonial/my-testimonial-plugin.php', 'Update Testimonial', 'Update Testimonial', 2, 'my-testimonial/my-testimonial-update-page.php', 'my_testimonial_update' ); 
}

function my_testimonial_update(){
	global $wpdb;
	$testimonial_table = $wpdb->prefix . "my_testimonials";
?>

<div>
<h2>Update Testimonial</h2>

<style>
td { 
    padding: 10px;
	border:none !important;
}
table { 
    border-spacing: 10px;
    border-collapse: separate;
	width: 50% !important;
}
</style>
<form action="" method="post">
Enter Post Id : <input type="text" name="postid" />
<input type="submit" name="searchpost" value="Search" />
</form>

<?php	
if(isset($_REQUEST['searchpost'])){
	$postid = $_REQUEST['postid'];
include('my-testimonial-update-form.php');
}

if(isset($_REQUEST['testupdate'])){
	$postid = $_REQUEST['postid'];
include('my-testimonial-update-form.php');
}
}

if(isset($_REQUEST['update'])){
	$postid = $_REQUEST['my_testimonial_user_id'];
	$name = $_REQUEST['my_testimonial_name'];
	$msg = $_REQUEST['my_testimonial_msg'];
	my_testimonial_update_query($postid, $name, $msg);
}

if(isset($_REQUEST['delpost'])){
	$deletepost = $_REQUEST['deletepost'];
	my_testimonial_delete_query($deletepost);
}

function my_testimonial_delete_query($deletepost){
	global $wpdb;
	$testimonial_table = $wpdb->prefix . "my_testimonials";
	$wpdb->query("DELETE FROM $testimonial_table WHERE id = '$deletepost'");
	$path = $_SERVER['SCRIPT_NAME'] . "?page=my-testimonial/my_testimonial_plugin.php";
	header("Location:$path");
	}

function my_testimonial_update_query($postid, $name, $msg){
	global $wpdb;
	$testimonial_table = $wpdb->prefix . "my_testimonials";
	$date = current_time('mysql');
	$wpdb->query("UPDATE $testimonial_table SET name = '$name', message = '$msg', modifydate = '$date' WHERE id = '$postid'"); 
	/*require_once( ABSPATH . '/wp-load.php' );
	require_once( ABSPATH . '/wp-config.php' );
	require_once( ABSPATH . '/wp-settings.php' );
	$path = get_option('siteurl') . "wp-admin/admin.php?page=my-testimonial/my_testimonial_plugin.php";
	wp_redirect( $path ); */
	exit; 	
}

add_action('admin_menu', 'my_testimonial_add_menu_page');

function my_testimonial_add_menu_page() {
	add_submenu_page( 'my-testimonial/my-testimonial-plugin.php', 'Add Testimonial', 'Add Testimonial', 2, 'my-testimonial/my-testimonial-add-page.php', 'my_testimonial_html_page' ); 
}

function my_testimonial_html_page() {
	include('my-testimonial-add-form.php');
}
?>
<?php
function my_testimonial_all_post(){
global $wpdb;
$testimonial_table = $wpdb->prefix . "my_testimonials";
include("my-testimonial-all-post.php");
}
?>

<?php
add_shortcode("My-Testimonial", 'my_testimonial_add_shortcode');

function my_testimonial_add_shortcode(){
	
	include("my-testimonial-add-form.php");
	}

add_shortcode("My-Testimonial-View", 'my_testimonial_view_shortcode');

function my_testimonial_view_shortcode(){
	global $wpdb;
	$testimonial_table = $wpdb->prefix . "my_testimonials";
	include("my-testimonial-view-shortcode.php");
	}

include('my-testimonial-scripts.php');
?>
