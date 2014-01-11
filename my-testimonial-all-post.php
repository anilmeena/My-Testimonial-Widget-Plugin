<?php
if ( is_user_logged_in() ) {
	$current_user = wp_get_current_user();
	$uname = $current_user->user_login;
	?>
    <div>
<h2>All Testimonials</h2>

<?php
/*if(is_super_admin( $user_id )) {
	$current_user = wp_get_current_user();*/
if($uname == 'admin'){
//$where = "";
$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM $testimonial_table", $post_id));
}
else{
//$where = "where uname='$uname'";
$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM $testimonial_table where uname='$uname'", $post_id));
}
//$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM $testimonial_table" . $where, $post_id));
/*}
else{
$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM $testimonial_table where id = '$uid'", $post_id));
 }*/

//print_r($result);
echo "<table border=''>";
echo "	<tr>
			<th>Post Id</th>
			<th>Name</th>
			<th>Message</th>
			<th>Publish Date</th>
			<th>Modify Date</th>
			<th>Actions</th>
		</tr>
	";
foreach($result as $key => $value)
{
	//$path = $_SERVER['REQUEST_URI'];
	$path = $_SERVER['SCRIPT_NAME'] . "?page=my-testimonial/my-testimonial-update-page.php";
	$postid = $value->id;
	$uname = $value->name;
	$msg = $value->message;
	$postdate = $value->time;
	$modifydate = $value->modifydate;
	$plugins_url = $path ; 
	echo "	<tr>
			<td>" . $postid . "</td>
			<td>" . $uname . "</td>
			<td>" . $msg . "</td>
			<td>" . $postdate . "</td>
			<td>" . $modifydate . "</td>
			<td><form action=\"$path\" method='post' style='float:left;'><input type='hidden' name='postid' value=\"$postid\"><input type='submit' name='testupdate' value='Update'></form><form style='float:right' action=''><input type='hidden' name='deletepost' value=\"$postid\"><input type='submit' name='delpost' value='Delete'></form></td>
		</tr>
	";
}
echo "</table>";
?>

</div>
<?php } 
include('my-testimonial-widget.php');
?>
