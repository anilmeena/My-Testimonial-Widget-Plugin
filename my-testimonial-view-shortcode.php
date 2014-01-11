<div>
<h2>Latest Testimonials</h2>

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
<?php
$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM $testimonial_table", $post_id));
?>
<table style="border: 2px solid;">
<?php
foreach($result as $key => $value)
{ ?>
<tr valign="top">
<th valign="middle" style="text-align:justify;" scope="row">Name : </th>
<td>
<?php echo $value->name; ?>
</td>
</tr>
<tr valign="top">
<th valign="middle" style="text-align:justify;" scope="row">Message : </th>
<td>
<?php echo $value->message; ?></td>
</tr>
<?php } ?>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="hello_world_data" />

</div>
