<?php

add_action("admin_menu" , "rfy_settings");


function rfy_settings() {
	
	//$icon_url =  plugins_url( '/assets/fp_logo_small.png' , __FILE__ );
	add_menu_page( "RFY", "Recommended for You", "manage_options", RFY_SLUG, "rfy_settings_page" ); 
	
}

function rfy_settings_page() {

	rfy_update_values();
	$rfy_settings = get_option("rfy_settings");
	?>

	<div class="wrap">		
		
		<h2>Recommended for You </h2>

		<hr>

		<form method="post" id="rfy__frm">
			
			<table class="form-table">
	
				<tr>
			
					<th scope="row"><label for="ptf_app_id">Enabled:</label></th>
			
					<td>
						<input type="radio" name="rfy_enable" id="rfy_enable_yes" value="yes" <?php checked($rfy_settings["enabled"] , "yes"); ?> ><label for="rfy_enable_yes">Yes</label> <br>
						<input type="radio" name="rfy_enable" id="rfy_enable_no"  value="no" <?php checked($rfy_settings["enabled"] , "no"); ?>><label for="rfy_enable_no">No</label> 
					</td>
					
				</tr>
				<tr>
			
					<th scope="row"><label for="ptf_app_id">Show Close Button:</label></th>
			
					<td>
						<input type="radio" name="rfy_enable_btn" id="rfy_enable_btn_yes" value="yes" <?php checked($rfy_settings["enabled_btn"] , "yes"); ?> ><label for="rfy_enable_btn_yes">Yes</label> <br>
						<input type="radio" name="rfy_enable_btn" id="rfy_enable_btn_no"  value="no" <?php checked($rfy_settings["enabled_btn"] , "no"); ?>><label for="rfy_enable_btn_no">No</label> 
					</td>
					
				</tr>
				<tr>
				  	<th scope="row"> <input name="rfy_submit_update" type="submit" class="button button-primary " /></th>
				</tr>  

			</table>

		</form>

	</div>
	<?php	
}


function rfy_update_values() {

	global $rfy_settings;

	if(isset($_POST["rfy_submit_update"])) {

		$rfy_enable = $_POST["rfy_enable"];
		$rfy_enable_btn = $_POST["rfy_enable_btn"];

		$rfy_settings["enabled"] = $rfy_enable;
		$rfy_settings["enabled_btn"] = $rfy_enable_btn;

		update_option("rfy_settings" , $rfy_settings);
	}

}