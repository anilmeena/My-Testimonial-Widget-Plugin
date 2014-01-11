<?php
if ( is_user_logged_in() ) {
	$current_user = wp_get_current_user();
	$uname = $current_user->user_login;
	?>
<?php
global $wpdb;
	$testimonial_table = $wpdb->prefix . "my_testimonials";
	$postid = $_REQUEST['postid'];
	
	if($uname == 'admin'){
	//$where = "";
	$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM $testimonial_table where id='$postid'", $post_id));
	}
	else{
	//$where = "where uname='$uname'";
	$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM $testimonial_table where id='$postid' AND uname='$uname'", $post_id));
	}
	
 	
	?>
<form method="post" action="">
<table style="border: 2px solid;">
<tr valign="top">
<th valign="middle" style="text-align:justify;" scope="row">Name : </th>
<td style="">
<?php foreach($result as $key => $value){ ?>
<input name="my_testimonial_user_id" type="hidden" id="my_testimonial_user_id"
value="<?php echo $value->id; ?>" required/>
<input name="my_testimonial_name" type="text" id="my_testimonial_name"
value="<?php echo $value->name; ?>" required/>
</td>
</tr>
<tr valign="top">
<th valign="middle" style="text-align:justify;" scope="row">Message : </th>
<td style="">
<textarea name="my_testimonial_msg" type="text" id="my_testimonial_msg" required><?php echo $value->message; ?>
</textarea><?php } ?>
</td>
</tr>
<tr><td colspan="2" style="text-align:	center">

<input style="margin-top:20px;" type="submit" name="update" value="<?php _e('Update') ?>" />
</td></tr>
</table>

<input type="hidden" name="action" value="update" />
</form>
</div>
<?php } ?>
