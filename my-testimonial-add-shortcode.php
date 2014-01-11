<?php
if ( is_user_logged_in() ) {
	$current_user = wp_get_current_user();
	
    /*echo 'Welcome: ' . $current_user->user_login . '<br />';
    echo 'User email: ' . $current_user->user_email . '<br />';
    echo 'User first name: ' . $current_user->user_firstname . '<br />';
    echo 'User last name: ' . $current_user->user_lastname . '<br />';
    echo 'User display name: ' . $current_user->display_name . '<br />';
    echo 'User ID: ' . $current_user->ID . '<br />';*/
?>
<div>
<h2>Add Testimonial</h2>

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

<form method="post" action="<?php $request_url = $_SERVER["PHP_SELF"].'?page=add-testimonial-info';?>">
<input name="my_testimonial_user_id" type="text" id="my_testimonial_user_id"
value="" required/>
<table style="border: 2px solid;">
<tr valign="top">
<th valign="middle" style="text-align:justify;" scope="row">Name : </th>
<td style="">
<input name="my_testimonial_name" type="text" id="my_testimonial_name"
value="" required/>
</td>
</tr>
<tr valign="top">
<th valign="middle" style="text-align:justify;" scope="row">Message : </th>
<td style="">
<textarea name="my_testimonial_msg" type="text" id="my_testimonial_msg" required>
</textarea></td>
</tr>
<tr><td colspan="2" style="text-align:	center">
<input style="margin-top:20px;" type="submit" name="submit" value="<?php _e('Save Changes') ?>" />
</td></tr>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="hello_world_data" />



</form>
</div>
<?php } else {
    echo 'Welcome, visitor!<br>';
	echo "You have to login for add testimonial.";
}
