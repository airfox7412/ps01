<?php
// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the contact form HTML
	$output = "<div style='display:none'>
	<div class='contact-top'></div>
		<div class='contact-content'>
		<h1 class='contact-title'>填寫主述資料</h1>
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<form action='#' style='display:none'>
			<label for='contact-name'>姓名</label>
			<input type='text' id='contact-name' class='contact-input' name='name' tabindex='1001' />
			<label for='contact-sex'>性別</label>
			<input type='text' id='contact-email' class='contact-input' name='sex' tabindex='1002' />";
	$output .= "
			<label for='contact-badypart'>部位</label>
			<input type='text' id='contact-badypart' class='contact-input' name='bodypart' value='' tabindex='1003' />";
	$output .= "
			<label for='contact-patientHistory'>主述說明</label>
			<textarea id='contact-patientHistory' class='contact-input' name='patientHistory' cols='40' rows='4' tabindex='1004'></textarea>
			<br/>";
	$output .= "
			<label>&nbsp;</label>
			<button type='submit' class='contact-send contact-button' tabindex='1006'>儲存</button>
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>取消</button>
		</form>
		</div>
	</div>";

	echo $output;
}
else if ($action == "send") {
	// Send the email
	$name = isset($_POST["name"]) ? $_POST["name"] : "";
	$sex = isset($_POST["sex"]) ? $_POST["sex"] : "";
	$bodypart = isset($_POST["bodypart"]) ? $_POST["bodypart"] : $bodypart;
	$patientHistory = isset($_POST["patientHistory"]) ? $_POST["patientHistory"] : "";

}
exit;
?>