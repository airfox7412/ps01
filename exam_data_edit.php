<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "exam_data_info.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$exam_data_edit = new cexam_data_edit();
$Page =& $exam_data_edit;

// Page init processing
$exam_data_edit->Page_Init();

// Page main processing
$exam_data_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var exam_data_edit = new ew_Page("exam_data_edit");

// page properties
exam_data_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = exam_data_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
exam_data_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_ExamDataNo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Exam Data No");
		elm = fobj.elements["x" + infix + "_ExamDataNo"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Exam Data No");
		elm = fobj.elements["x" + infix + "_PatientMainNo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Patient Main No");
		elm = fobj.elements["x" + infix + "_PatientMainNo"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Patient Main No");
		elm = fobj.elements["x" + infix + "_InstitutionNo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Institution No");
		elm = fobj.elements["x" + infix + "_InstitutionNo"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Institution No");
		elm = fobj.elements["x" + infix + "_ImageDetailNo"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Image Detail No");
		elm = fobj.elements["x" + infix + "_PatientKindNo"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Patient Kind No");
		elm = fobj.elements["x" + infix + "_PatientSubKindNo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Patient Sub Kind No");
		elm = fobj.elements["x" + infix + "_PatientSubKindNo"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Patient Sub Kind No");
		elm = fobj.elements["x" + infix + "_PatientTypeNo"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Patient Type No");
		elm = fobj.elements["x" + infix + "_DepartmentNo"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Department No");
		elm = fobj.elements["x" + infix + "_Soap"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_SpecialExamDate"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Special Exam Date");
		elm = fobj.elements["x" + infix + "_ExamDate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Exam Date");
		elm = fobj.elements["x" + infix + "_ExamDate"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Exam Date");
		elm = fobj.elements["x" + infix + "_ExamTime"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Exam Time");
		elm = fobj.elements["x" + infix + "_ExamTime"];
		if (elm && !ew_CheckTime(elm.value))
			return ew_OnError(this, elm, "Incorrect time (hh:mm:ss) - Exam Time");
		elm = fobj.elements["x" + infix + "_LogDate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Log Date");
		elm = fobj.elements["x" + infix + "_LogDate"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Log Date");
		elm = fobj.elements["x" + infix + "_ModifyDate"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Modify Date");
		elm = fobj.elements["x" + infix + "_CreatePart"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Create Part");
		elm = fobj.elements["x" + infix + "_ModifyPart"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Modify Part");
		elm = fobj.elements["x" + infix + "_Status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Status");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
exam_data_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
exam_data_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
exam_data_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Edit TABLE: Exam Data<br><br>
<a href="<?php echo $exam_data->getReturnUrl() ?>">Go Back</a></span></p>
<?php $exam_data_edit->ShowMessage() ?>
<form name="fexam_dataedit" id="fexam_dataedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return exam_data_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="exam_data">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($exam_data->ExamDataNo->Visible) { // ExamDataNo ?>
	<tr<?php echo $exam_data->ExamDataNo->RowAttributes ?>>
		<td class="ewTableHeader">Exam Data No<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $exam_data->ExamDataNo->CellAttributes() ?>><span id="el_ExamDataNo">
<div<?php echo $exam_data->ExamDataNo->ViewAttributes() ?>><?php echo $exam_data->ExamDataNo->EditValue ?></div><input type="hidden" name="x_ExamDataNo" id="x_ExamDataNo" value="<?php echo ew_HtmlEncode($exam_data->ExamDataNo->CurrentValue) ?>">
</span><?php echo $exam_data->ExamDataNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->AccessionNumber->Visible) { // AccessionNumber ?>
	<tr<?php echo $exam_data->AccessionNumber->RowAttributes ?>>
		<td class="ewTableHeader">Accession Number</td>
		<td<?php echo $exam_data->AccessionNumber->CellAttributes() ?>><span id="el_AccessionNumber">
<input type="text" name="x_AccessionNumber" id="x_AccessionNumber" size="30" maxlength="64" value="<?php echo $exam_data->AccessionNumber->EditValue ?>"<?php echo $exam_data->AccessionNumber->EditAttributes() ?>>
</span><?php echo $exam_data->AccessionNumber->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientMainNo->Visible) { // PatientMainNo ?>
	<tr<?php echo $exam_data->PatientMainNo->RowAttributes ?>>
		<td class="ewTableHeader">Patient Main No<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $exam_data->PatientMainNo->CellAttributes() ?>><span id="el_PatientMainNo">
<input type="text" name="x_PatientMainNo" id="x_PatientMainNo" size="30" value="<?php echo $exam_data->PatientMainNo->EditValue ?>"<?php echo $exam_data->PatientMainNo->EditAttributes() ?>>
</span><?php echo $exam_data->PatientMainNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientID->Visible) { // PatientID ?>
	<tr<?php echo $exam_data->PatientID->RowAttributes ?>>
		<td class="ewTableHeader">Patient ID</td>
		<td<?php echo $exam_data->PatientID->CellAttributes() ?>><span id="el_PatientID">
<input type="text" name="x_PatientID" id="x_PatientID" size="30" maxlength="64" value="<?php echo $exam_data->PatientID->EditValue ?>"<?php echo $exam_data->PatientID->EditAttributes() ?>>
</span><?php echo $exam_data->PatientID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->InstitutionNo->Visible) { // InstitutionNo ?>
	<tr<?php echo $exam_data->InstitutionNo->RowAttributes ?>>
		<td class="ewTableHeader">Institution No<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $exam_data->InstitutionNo->CellAttributes() ?>><span id="el_InstitutionNo">
<input type="text" name="x_InstitutionNo" id="x_InstitutionNo" size="30" value="<?php echo $exam_data->InstitutionNo->EditValue ?>"<?php echo $exam_data->InstitutionNo->EditAttributes() ?>>
</span><?php echo $exam_data->InstitutionNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ImageDetailNo->Visible) { // ImageDetailNo ?>
	<tr<?php echo $exam_data->ImageDetailNo->RowAttributes ?>>
		<td class="ewTableHeader">Image Detail No</td>
		<td<?php echo $exam_data->ImageDetailNo->CellAttributes() ?>><span id="el_ImageDetailNo">
<input type="text" name="x_ImageDetailNo" id="x_ImageDetailNo" size="30" value="<?php echo $exam_data->ImageDetailNo->EditValue ?>"<?php echo $exam_data->ImageDetailNo->EditAttributes() ?>>
</span><?php echo $exam_data->ImageDetailNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientKindNo->Visible) { // PatientKindNo ?>
	<tr<?php echo $exam_data->PatientKindNo->RowAttributes ?>>
		<td class="ewTableHeader">Patient Kind No</td>
		<td<?php echo $exam_data->PatientKindNo->CellAttributes() ?>><span id="el_PatientKindNo">
<input type="text" name="x_PatientKindNo" id="x_PatientKindNo" size="30" value="<?php echo $exam_data->PatientKindNo->EditValue ?>"<?php echo $exam_data->PatientKindNo->EditAttributes() ?>>
</span><?php echo $exam_data->PatientKindNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientSubKindNo->Visible) { // PatientSubKindNo ?>
	<tr<?php echo $exam_data->PatientSubKindNo->RowAttributes ?>>
		<td class="ewTableHeader">Patient Sub Kind No<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $exam_data->PatientSubKindNo->CellAttributes() ?>><span id="el_PatientSubKindNo">
<input type="text" name="x_PatientSubKindNo" id="x_PatientSubKindNo" size="30" value="<?php echo $exam_data->PatientSubKindNo->EditValue ?>"<?php echo $exam_data->PatientSubKindNo->EditAttributes() ?>>
</span><?php echo $exam_data->PatientSubKindNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientTypeNo->Visible) { // PatientTypeNo ?>
	<tr<?php echo $exam_data->PatientTypeNo->RowAttributes ?>>
		<td class="ewTableHeader">Patient Type No</td>
		<td<?php echo $exam_data->PatientTypeNo->CellAttributes() ?>><span id="el_PatientTypeNo">
<input type="text" name="x_PatientTypeNo" id="x_PatientTypeNo" size="30" value="<?php echo $exam_data->PatientTypeNo->EditValue ?>"<?php echo $exam_data->PatientTypeNo->EditAttributes() ?>>
</span><?php echo $exam_data->PatientTypeNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientRoom->Visible) { // PatientRoom ?>
	<tr<?php echo $exam_data->PatientRoom->RowAttributes ?>>
		<td class="ewTableHeader">Patient Room</td>
		<td<?php echo $exam_data->PatientRoom->CellAttributes() ?>><span id="el_PatientRoom">
<input type="text" name="x_PatientRoom" id="x_PatientRoom" size="30" maxlength="10" value="<?php echo $exam_data->PatientRoom->EditValue ?>"<?php echo $exam_data->PatientRoom->EditAttributes() ?>>
</span><?php echo $exam_data->PatientRoom->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->DepartmentNo->Visible) { // DepartmentNo ?>
	<tr<?php echo $exam_data->DepartmentNo->RowAttributes ?>>
		<td class="ewTableHeader">Department No</td>
		<td<?php echo $exam_data->DepartmentNo->CellAttributes() ?>><span id="el_DepartmentNo">
<input type="text" name="x_DepartmentNo" id="x_DepartmentNo" size="30" value="<?php echo $exam_data->DepartmentNo->EditValue ?>"<?php echo $exam_data->DepartmentNo->EditAttributes() ?>>
</span><?php echo $exam_data->DepartmentNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->DepartmentName->Visible) { // DepartmentName ?>
	<tr<?php echo $exam_data->DepartmentName->RowAttributes ?>>
		<td class="ewTableHeader">Department Name</td>
		<td<?php echo $exam_data->DepartmentName->CellAttributes() ?>><span id="el_DepartmentName">
<input type="text" name="x_DepartmentName" id="x_DepartmentName" size="30" maxlength="128" value="<?php echo $exam_data->DepartmentName->EditValue ?>"<?php echo $exam_data->DepartmentName->EditAttributes() ?>>
</span><?php echo $exam_data->DepartmentName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->Soap->Visible) { // Soap ?>
	<tr<?php echo $exam_data->Soap->RowAttributes ?>>
		<td class="ewTableHeader">Soap</td>
		<td<?php echo $exam_data->Soap->CellAttributes() ?>><span id="el_Soap">
<div id="old_x_Soap">
<?php if ($exam_data->Soap->HrefValue <> "") { ?>
<?php if (!is_null($exam_data->Soap->Upload->DbValue)) { ?>
<a href="<?php echo $exam_data->Soap->HrefValue ?>" target="_blank"><?php echo $exam_data->Soap->EditValue ?></a>
<?php } elseif (!in_array($exam_data->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($exam_data->Soap->Upload->DbValue)) { ?>
<?php echo $exam_data->Soap->EditValue ?>
<?php } elseif (!in_array($exam_data->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_Soap">
<?php if (!is_null($exam_data->Soap->Upload->DbValue)) { ?>
<input type="radio" name="a_Soap" id="a_Soap" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a_Soap" id="a_Soap" value="2">Remove&nbsp;
<input type="radio" name="a_Soap" id="a_Soap" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a_Soap" id="a_Soap" value="3">
<?php } ?>
<input type="file" name="x_Soap" id="x_Soap" size="30" onchange="if (this.form.a_Soap[2]) this.form.a_Soap[2].checked=true;"<?php echo $exam_data->Soap->EditAttributes() ?>>
</div>
</span><?php echo $exam_data->Soap->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->RequestDoctorID->Visible) { // RequestDoctorID ?>
	<tr<?php echo $exam_data->RequestDoctorID->RowAttributes ?>>
		<td class="ewTableHeader">Request Doctor ID</td>
		<td<?php echo $exam_data->RequestDoctorID->CellAttributes() ?>><span id="el_RequestDoctorID">
<input type="text" name="x_RequestDoctorID" id="x_RequestDoctorID" size="30" maxlength="10" value="<?php echo $exam_data->RequestDoctorID->EditValue ?>"<?php echo $exam_data->RequestDoctorID->EditAttributes() ?>>
</span><?php echo $exam_data->RequestDoctorID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->CodeValue->Visible) { // CodeValue ?>
	<tr<?php echo $exam_data->CodeValue->RowAttributes ?>>
		<td class="ewTableHeader">Code Value</td>
		<td<?php echo $exam_data->CodeValue->CellAttributes() ?>><span id="el_CodeValue">
<input type="text" name="x_CodeValue" id="x_CodeValue" size="30" maxlength="8" value="<?php echo $exam_data->CodeValue->EditValue ?>"<?php echo $exam_data->CodeValue->EditAttributes() ?>>
</span><?php echo $exam_data->CodeValue->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->SpecialExamID->Visible) { // SpecialExamID ?>
	<tr<?php echo $exam_data->SpecialExamID->RowAttributes ?>>
		<td class="ewTableHeader">Special Exam ID</td>
		<td<?php echo $exam_data->SpecialExamID->CellAttributes() ?>><span id="el_SpecialExamID">
<input type="text" name="x_SpecialExamID" id="x_SpecialExamID" size="30" maxlength="255" value="<?php echo $exam_data->SpecialExamID->EditValue ?>"<?php echo $exam_data->SpecialExamID->EditAttributes() ?>>
</span><?php echo $exam_data->SpecialExamID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->SpecialExamName->Visible) { // SpecialExamName ?>
	<tr<?php echo $exam_data->SpecialExamName->RowAttributes ?>>
		<td class="ewTableHeader">Special Exam Name</td>
		<td<?php echo $exam_data->SpecialExamName->CellAttributes() ?>><span id="el_SpecialExamName">
<input type="text" name="x_SpecialExamName" id="x_SpecialExamName" size="30" maxlength="255" value="<?php echo $exam_data->SpecialExamName->EditValue ?>"<?php echo $exam_data->SpecialExamName->EditAttributes() ?>>
</span><?php echo $exam_data->SpecialExamName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->SpecialExamDate->Visible) { // SpecialExamDate ?>
	<tr<?php echo $exam_data->SpecialExamDate->RowAttributes ?>>
		<td class="ewTableHeader">Special Exam Date</td>
		<td<?php echo $exam_data->SpecialExamDate->CellAttributes() ?>><span id="el_SpecialExamDate">
<input type="text" name="x_SpecialExamDate" id="x_SpecialExamDate" value="<?php echo $exam_data->SpecialExamDate->EditValue ?>"<?php echo $exam_data->SpecialExamDate->EditAttributes() ?>>
</span><?php echo $exam_data->SpecialExamDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ExamDate->Visible) { // ExamDate ?>
	<tr<?php echo $exam_data->ExamDate->RowAttributes ?>>
		<td class="ewTableHeader">Exam Date<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $exam_data->ExamDate->CellAttributes() ?>><span id="el_ExamDate">
<input type="text" name="x_ExamDate" id="x_ExamDate" value="<?php echo $exam_data->ExamDate->EditValue ?>"<?php echo $exam_data->ExamDate->EditAttributes() ?>>
</span><?php echo $exam_data->ExamDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ExamTime->Visible) { // ExamTime ?>
	<tr<?php echo $exam_data->ExamTime->RowAttributes ?>>
		<td class="ewTableHeader">Exam Time<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $exam_data->ExamTime->CellAttributes() ?>><span id="el_ExamTime">
<input type="text" name="x_ExamTime" id="x_ExamTime" size="30" value="<?php echo $exam_data->ExamTime->EditValue ?>"<?php echo $exam_data->ExamTime->EditAttributes() ?>>
</span><?php echo $exam_data->ExamTime->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->LogDate->Visible) { // LogDate ?>
	<tr<?php echo $exam_data->LogDate->RowAttributes ?>>
		<td class="ewTableHeader">Log Date<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $exam_data->LogDate->CellAttributes() ?>><span id="el_LogDate">
<input type="text" name="x_LogDate" id="x_LogDate" value="<?php echo $exam_data->LogDate->EditValue ?>"<?php echo $exam_data->LogDate->EditAttributes() ?>>
</span><?php echo $exam_data->LogDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ModifyUser->Visible) { // ModifyUser ?>
	<tr<?php echo $exam_data->ModifyUser->RowAttributes ?>>
		<td class="ewTableHeader">Modify User</td>
		<td<?php echo $exam_data->ModifyUser->CellAttributes() ?>><span id="el_ModifyUser">
<input type="text" name="x_ModifyUser" id="x_ModifyUser" size="30" maxlength="20" value="<?php echo $exam_data->ModifyUser->EditValue ?>"<?php echo $exam_data->ModifyUser->EditAttributes() ?>>
</span><?php echo $exam_data->ModifyUser->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ModifyDate->Visible) { // ModifyDate ?>
	<tr<?php echo $exam_data->ModifyDate->RowAttributes ?>>
		<td class="ewTableHeader">Modify Date</td>
		<td<?php echo $exam_data->ModifyDate->CellAttributes() ?>><span id="el_ModifyDate">
<input type="text" name="x_ModifyDate" id="x_ModifyDate" value="<?php echo $exam_data->ModifyDate->EditValue ?>"<?php echo $exam_data->ModifyDate->EditAttributes() ?>>
</span><?php echo $exam_data->ModifyDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->CreatePart->Visible) { // CreatePart ?>
	<tr<?php echo $exam_data->CreatePart->RowAttributes ?>>
		<td class="ewTableHeader">Create Part<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $exam_data->CreatePart->CellAttributes() ?>><span id="el_CreatePart">
<input type="text" name="x_CreatePart" id="x_CreatePart" size="30" maxlength="255" value="<?php echo $exam_data->CreatePart->EditValue ?>"<?php echo $exam_data->CreatePart->EditAttributes() ?>>
</span><?php echo $exam_data->CreatePart->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ModifyPart->Visible) { // ModifyPart ?>
	<tr<?php echo $exam_data->ModifyPart->RowAttributes ?>>
		<td class="ewTableHeader">Modify Part<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $exam_data->ModifyPart->CellAttributes() ?>><span id="el_ModifyPart">
<input type="text" name="x_ModifyPart" id="x_ModifyPart" size="30" maxlength="255" value="<?php echo $exam_data->ModifyPart->EditValue ?>"<?php echo $exam_data->ModifyPart->EditAttributes() ?>>
</span><?php echo $exam_data->ModifyPart->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($exam_data->Status->Visible) { // Status ?>
	<tr<?php echo $exam_data->Status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $exam_data->Status->CellAttributes() ?>><span id="el_Status">
<input type="text" name="x_Status" id="x_Status" size="30" maxlength="1" value="<?php echo $exam_data->Status->EditValue ?>"<?php echo $exam_data->Status->EditAttributes() ?>>
</span><?php echo $exam_data->Status->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="   Edit   ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cexam_data_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'exam_data';

	// Page Object Name
	var $PageObjName = 'exam_data_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $exam_data;
		if ($exam_data->UseTokenInUrl) $PageUrl .= "t=" . $exam_data->TableVar . "&"; // add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show Message
	function ShowMessage() {
		if ($this->getMessage() <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $this->getMessage() . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate Page request
	function IsPageRequest() {
		global $objForm, $exam_data;
		if ($exam_data->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($exam_data->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($exam_data->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cexam_data_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["exam_data"] = new cexam_data();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'exam_data', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $exam_data;

		// Global page loading event (in userfn6.php)
		Page_Loading();

		// Page load event, used in current page
		$this->Page_Load();
	}

	//
	//  Page_Terminate
	//  - called when exit page
	//  - if URL specified, redirect to the URL
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page unload event, used in current page
		$this->Page_Unload();

		// Global page unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close Connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			ob_end_clean();
			header("Location: $url");
		}
		exit();
	}

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $exam_data;

		// Load key from QueryString
		if (@$_GET["ExamDataNo"] <> "")
			$exam_data->ExamDataNo->setQueryStringValue($_GET["ExamDataNo"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$exam_data->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$exam_data->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$exam_data->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($exam_data->ExamDataNo->CurrentValue == "")
			$this->Page_Terminate("exam_data_list.php"); // Invalid key, return to list
		switch ($exam_data->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("exam_data_list.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$exam_data->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $exam_data->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$exam_data->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $exam_data;

		// Get upload data
			if ($exam_data->Soap->Upload->UploadFile()) {

				// No action required
			} else {
				echo $exam_data->Soap->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $exam_data;
		$exam_data->ExamDataNo->setFormValue($objForm->GetValue("x_ExamDataNo"));
		$exam_data->AccessionNumber->setFormValue($objForm->GetValue("x_AccessionNumber"));
		$exam_data->PatientMainNo->setFormValue($objForm->GetValue("x_PatientMainNo"));
		$exam_data->PatientID->setFormValue($objForm->GetValue("x_PatientID"));
		$exam_data->InstitutionNo->setFormValue($objForm->GetValue("x_InstitutionNo"));
		$exam_data->ImageDetailNo->setFormValue($objForm->GetValue("x_ImageDetailNo"));
		$exam_data->PatientKindNo->setFormValue($objForm->GetValue("x_PatientKindNo"));
		$exam_data->PatientSubKindNo->setFormValue($objForm->GetValue("x_PatientSubKindNo"));
		$exam_data->PatientTypeNo->setFormValue($objForm->GetValue("x_PatientTypeNo"));
		$exam_data->PatientRoom->setFormValue($objForm->GetValue("x_PatientRoom"));
		$exam_data->DepartmentNo->setFormValue($objForm->GetValue("x_DepartmentNo"));
		$exam_data->DepartmentName->setFormValue($objForm->GetValue("x_DepartmentName"));
		$exam_data->RequestDoctorID->setFormValue($objForm->GetValue("x_RequestDoctorID"));
		$exam_data->CodeValue->setFormValue($objForm->GetValue("x_CodeValue"));
		$exam_data->SpecialExamID->setFormValue($objForm->GetValue("x_SpecialExamID"));
		$exam_data->SpecialExamName->setFormValue($objForm->GetValue("x_SpecialExamName"));
		$exam_data->SpecialExamDate->setFormValue($objForm->GetValue("x_SpecialExamDate"));
		$exam_data->SpecialExamDate->CurrentValue = ew_UnFormatDateTime($exam_data->SpecialExamDate->CurrentValue, 5);
		$exam_data->ExamDate->setFormValue($objForm->GetValue("x_ExamDate"));
		$exam_data->ExamDate->CurrentValue = ew_UnFormatDateTime($exam_data->ExamDate->CurrentValue, 5);
		$exam_data->ExamTime->setFormValue($objForm->GetValue("x_ExamTime"));
		$exam_data->LogDate->setFormValue($objForm->GetValue("x_LogDate"));
		$exam_data->LogDate->CurrentValue = ew_UnFormatDateTime($exam_data->LogDate->CurrentValue, 5);
		$exam_data->ModifyUser->setFormValue($objForm->GetValue("x_ModifyUser"));
		$exam_data->ModifyDate->setFormValue($objForm->GetValue("x_ModifyDate"));
		$exam_data->ModifyDate->CurrentValue = ew_UnFormatDateTime($exam_data->ModifyDate->CurrentValue, 5);
		$exam_data->CreatePart->setFormValue($objForm->GetValue("x_CreatePart"));
		$exam_data->ModifyPart->setFormValue($objForm->GetValue("x_ModifyPart"));
		$exam_data->Status->setFormValue($objForm->GetValue("x_Status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $exam_data;
		$this->LoadRow();
		$exam_data->ExamDataNo->CurrentValue = $exam_data->ExamDataNo->FormValue;
		$exam_data->AccessionNumber->CurrentValue = $exam_data->AccessionNumber->FormValue;
		$exam_data->PatientMainNo->CurrentValue = $exam_data->PatientMainNo->FormValue;
		$exam_data->PatientID->CurrentValue = $exam_data->PatientID->FormValue;
		$exam_data->InstitutionNo->CurrentValue = $exam_data->InstitutionNo->FormValue;
		$exam_data->ImageDetailNo->CurrentValue = $exam_data->ImageDetailNo->FormValue;
		$exam_data->PatientKindNo->CurrentValue = $exam_data->PatientKindNo->FormValue;
		$exam_data->PatientSubKindNo->CurrentValue = $exam_data->PatientSubKindNo->FormValue;
		$exam_data->PatientTypeNo->CurrentValue = $exam_data->PatientTypeNo->FormValue;
		$exam_data->PatientRoom->CurrentValue = $exam_data->PatientRoom->FormValue;
		$exam_data->DepartmentNo->CurrentValue = $exam_data->DepartmentNo->FormValue;
		$exam_data->DepartmentName->CurrentValue = $exam_data->DepartmentName->FormValue;
		$exam_data->RequestDoctorID->CurrentValue = $exam_data->RequestDoctorID->FormValue;
		$exam_data->CodeValue->CurrentValue = $exam_data->CodeValue->FormValue;
		$exam_data->SpecialExamID->CurrentValue = $exam_data->SpecialExamID->FormValue;
		$exam_data->SpecialExamName->CurrentValue = $exam_data->SpecialExamName->FormValue;
		$exam_data->SpecialExamDate->CurrentValue = $exam_data->SpecialExamDate->FormValue;
		$exam_data->SpecialExamDate->CurrentValue = ew_UnFormatDateTime($exam_data->SpecialExamDate->CurrentValue, 5);
		$exam_data->ExamDate->CurrentValue = $exam_data->ExamDate->FormValue;
		$exam_data->ExamDate->CurrentValue = ew_UnFormatDateTime($exam_data->ExamDate->CurrentValue, 5);
		$exam_data->ExamTime->CurrentValue = $exam_data->ExamTime->FormValue;
		$exam_data->LogDate->CurrentValue = $exam_data->LogDate->FormValue;
		$exam_data->LogDate->CurrentValue = ew_UnFormatDateTime($exam_data->LogDate->CurrentValue, 5);
		$exam_data->ModifyUser->CurrentValue = $exam_data->ModifyUser->FormValue;
		$exam_data->ModifyDate->CurrentValue = $exam_data->ModifyDate->FormValue;
		$exam_data->ModifyDate->CurrentValue = ew_UnFormatDateTime($exam_data->ModifyDate->CurrentValue, 5);
		$exam_data->CreatePart->CurrentValue = $exam_data->CreatePart->FormValue;
		$exam_data->ModifyPart->CurrentValue = $exam_data->ModifyPart->FormValue;
		$exam_data->Status->CurrentValue = $exam_data->Status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $exam_data;
		$sFilter = $exam_data->KeyFilter();

		// Call Row Selecting event
		$exam_data->Row_Selecting($sFilter);

		// Load sql based on filter
		$exam_data->CurrentFilter = $sFilter;
		$sSql = $exam_data->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$exam_data->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $exam_data;
		$exam_data->ExamDataNo->setDbValue($rs->fields('ExamDataNo'));
		$exam_data->AccessionNumber->setDbValue($rs->fields('AccessionNumber'));
		$exam_data->PatientMainNo->setDbValue($rs->fields('PatientMainNo'));
		$exam_data->PatientID->setDbValue($rs->fields('PatientID'));
		$exam_data->InstitutionNo->setDbValue($rs->fields('InstitutionNo'));
		$exam_data->ImageDetailNo->setDbValue($rs->fields('ImageDetailNo'));
		$exam_data->PatientKindNo->setDbValue($rs->fields('PatientKindNo'));
		$exam_data->PatientSubKindNo->setDbValue($rs->fields('PatientSubKindNo'));
		$exam_data->PatientTypeNo->setDbValue($rs->fields('PatientTypeNo'));
		$exam_data->PatientRoom->setDbValue($rs->fields('PatientRoom'));
		$exam_data->DepartmentNo->setDbValue($rs->fields('DepartmentNo'));
		$exam_data->DepartmentName->setDbValue($rs->fields('DepartmentName'));
		$exam_data->Soap->Upload->DbValue = $rs->fields('Soap');
		$exam_data->RequestDoctorID->setDbValue($rs->fields('RequestDoctorID'));
		$exam_data->CodeValue->setDbValue($rs->fields('CodeValue'));
		$exam_data->SpecialExamID->setDbValue($rs->fields('SpecialExamID'));
		$exam_data->SpecialExamName->setDbValue($rs->fields('SpecialExamName'));
		$exam_data->SpecialExamDate->setDbValue($rs->fields('SpecialExamDate'));
		$exam_data->ExamDate->setDbValue($rs->fields('ExamDate'));
		$exam_data->ExamTime->setDbValue($rs->fields('ExamTime'));
		$exam_data->LogDate->setDbValue($rs->fields('LogDate'));
		$exam_data->ModifyUser->setDbValue($rs->fields('ModifyUser'));
		$exam_data->ModifyDate->setDbValue($rs->fields('ModifyDate'));
		$exam_data->CreatePart->setDbValue($rs->fields('CreatePart'));
		$exam_data->ModifyPart->setDbValue($rs->fields('ModifyPart'));
		$exam_data->Status->setDbValue($rs->fields('Status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $exam_data;

		// Call Row_Rendering event
		$exam_data->Row_Rendering();

		// Common render codes for all row types
		// ExamDataNo

		$exam_data->ExamDataNo->CellCssStyle = "";
		$exam_data->ExamDataNo->CellCssClass = "";

		// AccessionNumber
		$exam_data->AccessionNumber->CellCssStyle = "";
		$exam_data->AccessionNumber->CellCssClass = "";

		// PatientMainNo
		$exam_data->PatientMainNo->CellCssStyle = "";
		$exam_data->PatientMainNo->CellCssClass = "";

		// PatientID
		$exam_data->PatientID->CellCssStyle = "";
		$exam_data->PatientID->CellCssClass = "";

		// InstitutionNo
		$exam_data->InstitutionNo->CellCssStyle = "";
		$exam_data->InstitutionNo->CellCssClass = "";

		// ImageDetailNo
		$exam_data->ImageDetailNo->CellCssStyle = "";
		$exam_data->ImageDetailNo->CellCssClass = "";

		// PatientKindNo
		$exam_data->PatientKindNo->CellCssStyle = "";
		$exam_data->PatientKindNo->CellCssClass = "";

		// PatientSubKindNo
		$exam_data->PatientSubKindNo->CellCssStyle = "";
		$exam_data->PatientSubKindNo->CellCssClass = "";

		// PatientTypeNo
		$exam_data->PatientTypeNo->CellCssStyle = "";
		$exam_data->PatientTypeNo->CellCssClass = "";

		// PatientRoom
		$exam_data->PatientRoom->CellCssStyle = "";
		$exam_data->PatientRoom->CellCssClass = "";

		// DepartmentNo
		$exam_data->DepartmentNo->CellCssStyle = "";
		$exam_data->DepartmentNo->CellCssClass = "";

		// DepartmentName
		$exam_data->DepartmentName->CellCssStyle = "";
		$exam_data->DepartmentName->CellCssClass = "";

		// Soap
		$exam_data->Soap->CellCssStyle = "";
		$exam_data->Soap->CellCssClass = "";

		// RequestDoctorID
		$exam_data->RequestDoctorID->CellCssStyle = "";
		$exam_data->RequestDoctorID->CellCssClass = "";

		// CodeValue
		$exam_data->CodeValue->CellCssStyle = "";
		$exam_data->CodeValue->CellCssClass = "";

		// SpecialExamID
		$exam_data->SpecialExamID->CellCssStyle = "";
		$exam_data->SpecialExamID->CellCssClass = "";

		// SpecialExamName
		$exam_data->SpecialExamName->CellCssStyle = "";
		$exam_data->SpecialExamName->CellCssClass = "";

		// SpecialExamDate
		$exam_data->SpecialExamDate->CellCssStyle = "";
		$exam_data->SpecialExamDate->CellCssClass = "";

		// ExamDate
		$exam_data->ExamDate->CellCssStyle = "";
		$exam_data->ExamDate->CellCssClass = "";

		// ExamTime
		$exam_data->ExamTime->CellCssStyle = "";
		$exam_data->ExamTime->CellCssClass = "";

		// LogDate
		$exam_data->LogDate->CellCssStyle = "";
		$exam_data->LogDate->CellCssClass = "";

		// ModifyUser
		$exam_data->ModifyUser->CellCssStyle = "";
		$exam_data->ModifyUser->CellCssClass = "";

		// ModifyDate
		$exam_data->ModifyDate->CellCssStyle = "";
		$exam_data->ModifyDate->CellCssClass = "";

		// CreatePart
		$exam_data->CreatePart->CellCssStyle = "";
		$exam_data->CreatePart->CellCssClass = "";

		// ModifyPart
		$exam_data->ModifyPart->CellCssStyle = "";
		$exam_data->ModifyPart->CellCssClass = "";

		// Status
		$exam_data->Status->CellCssStyle = "";
		$exam_data->Status->CellCssClass = "";
		if ($exam_data->RowType == EW_ROWTYPE_VIEW) { // View row

			// ExamDataNo
			$exam_data->ExamDataNo->ViewValue = $exam_data->ExamDataNo->CurrentValue;
			$exam_data->ExamDataNo->CssStyle = "";
			$exam_data->ExamDataNo->CssClass = "";
			$exam_data->ExamDataNo->ViewCustomAttributes = "";

			// AccessionNumber
			$exam_data->AccessionNumber->ViewValue = $exam_data->AccessionNumber->CurrentValue;
			$exam_data->AccessionNumber->CssStyle = "";
			$exam_data->AccessionNumber->CssClass = "";
			$exam_data->AccessionNumber->ViewCustomAttributes = "";

			// PatientMainNo
			$exam_data->PatientMainNo->ViewValue = $exam_data->PatientMainNo->CurrentValue;
			$exam_data->PatientMainNo->CssStyle = "";
			$exam_data->PatientMainNo->CssClass = "";
			$exam_data->PatientMainNo->ViewCustomAttributes = "";

			// PatientID
			$exam_data->PatientID->ViewValue = $exam_data->PatientID->CurrentValue;
			$exam_data->PatientID->CssStyle = "";
			$exam_data->PatientID->CssClass = "";
			$exam_data->PatientID->ViewCustomAttributes = "";

			// InstitutionNo
			$exam_data->InstitutionNo->ViewValue = $exam_data->InstitutionNo->CurrentValue;
			$exam_data->InstitutionNo->CssStyle = "";
			$exam_data->InstitutionNo->CssClass = "";
			$exam_data->InstitutionNo->ViewCustomAttributes = "";

			// ImageDetailNo
			$exam_data->ImageDetailNo->ViewValue = $exam_data->ImageDetailNo->CurrentValue;
			$exam_data->ImageDetailNo->CssStyle = "";
			$exam_data->ImageDetailNo->CssClass = "";
			$exam_data->ImageDetailNo->ViewCustomAttributes = "";

			// PatientKindNo
			$exam_data->PatientKindNo->ViewValue = $exam_data->PatientKindNo->CurrentValue;
			$exam_data->PatientKindNo->CssStyle = "";
			$exam_data->PatientKindNo->CssClass = "";
			$exam_data->PatientKindNo->ViewCustomAttributes = "";

			// PatientSubKindNo
			$exam_data->PatientSubKindNo->ViewValue = $exam_data->PatientSubKindNo->CurrentValue;
			$exam_data->PatientSubKindNo->CssStyle = "";
			$exam_data->PatientSubKindNo->CssClass = "";
			$exam_data->PatientSubKindNo->ViewCustomAttributes = "";

			// PatientTypeNo
			$exam_data->PatientTypeNo->ViewValue = $exam_data->PatientTypeNo->CurrentValue;
			$exam_data->PatientTypeNo->CssStyle = "";
			$exam_data->PatientTypeNo->CssClass = "";
			$exam_data->PatientTypeNo->ViewCustomAttributes = "";

			// PatientRoom
			$exam_data->PatientRoom->ViewValue = $exam_data->PatientRoom->CurrentValue;
			$exam_data->PatientRoom->CssStyle = "";
			$exam_data->PatientRoom->CssClass = "";
			$exam_data->PatientRoom->ViewCustomAttributes = "";

			// DepartmentNo
			$exam_data->DepartmentNo->ViewValue = $exam_data->DepartmentNo->CurrentValue;
			$exam_data->DepartmentNo->CssStyle = "";
			$exam_data->DepartmentNo->CssClass = "";
			$exam_data->DepartmentNo->ViewCustomAttributes = "";

			// DepartmentName
			$exam_data->DepartmentName->ViewValue = $exam_data->DepartmentName->CurrentValue;
			$exam_data->DepartmentName->CssStyle = "";
			$exam_data->DepartmentName->CssClass = "";
			$exam_data->DepartmentName->ViewCustomAttributes = "";

			// Soap
			if (!is_null($exam_data->Soap->Upload->DbValue)) {
				$exam_data->Soap->ViewValue = "Soap";
			} else {
				$exam_data->Soap->ViewValue = "";
			}
			$exam_data->Soap->CssStyle = "";
			$exam_data->Soap->CssClass = "";
			$exam_data->Soap->ViewCustomAttributes = "";

			// RequestDoctorID
			$exam_data->RequestDoctorID->ViewValue = $exam_data->RequestDoctorID->CurrentValue;
			$exam_data->RequestDoctorID->CssStyle = "";
			$exam_data->RequestDoctorID->CssClass = "";
			$exam_data->RequestDoctorID->ViewCustomAttributes = "";

			// CodeValue
			$exam_data->CodeValue->ViewValue = $exam_data->CodeValue->CurrentValue;
			$exam_data->CodeValue->CssStyle = "";
			$exam_data->CodeValue->CssClass = "";
			$exam_data->CodeValue->ViewCustomAttributes = "";

			// SpecialExamID
			$exam_data->SpecialExamID->ViewValue = $exam_data->SpecialExamID->CurrentValue;
			$exam_data->SpecialExamID->CssStyle = "";
			$exam_data->SpecialExamID->CssClass = "";
			$exam_data->SpecialExamID->ViewCustomAttributes = "";

			// SpecialExamName
			$exam_data->SpecialExamName->ViewValue = $exam_data->SpecialExamName->CurrentValue;
			$exam_data->SpecialExamName->CssStyle = "";
			$exam_data->SpecialExamName->CssClass = "";
			$exam_data->SpecialExamName->ViewCustomAttributes = "";

			// SpecialExamDate
			$exam_data->SpecialExamDate->ViewValue = $exam_data->SpecialExamDate->CurrentValue;
			$exam_data->SpecialExamDate->ViewValue = ew_FormatDateTime($exam_data->SpecialExamDate->ViewValue, 5);
			$exam_data->SpecialExamDate->CssStyle = "";
			$exam_data->SpecialExamDate->CssClass = "";
			$exam_data->SpecialExamDate->ViewCustomAttributes = "";

			// ExamDate
			$exam_data->ExamDate->ViewValue = $exam_data->ExamDate->CurrentValue;
			$exam_data->ExamDate->ViewValue = ew_FormatDateTime($exam_data->ExamDate->ViewValue, 5);
			$exam_data->ExamDate->CssStyle = "";
			$exam_data->ExamDate->CssClass = "";
			$exam_data->ExamDate->ViewCustomAttributes = "";

			// ExamTime
			$exam_data->ExamTime->ViewValue = $exam_data->ExamTime->CurrentValue;
			$exam_data->ExamTime->ViewValue = ew_FormatDateTime($exam_data->ExamTime->ViewValue, 4);
			$exam_data->ExamTime->CssStyle = "";
			$exam_data->ExamTime->CssClass = "";
			$exam_data->ExamTime->ViewCustomAttributes = "";

			// LogDate
			$exam_data->LogDate->ViewValue = $exam_data->LogDate->CurrentValue;
			$exam_data->LogDate->ViewValue = ew_FormatDateTime($exam_data->LogDate->ViewValue, 5);
			$exam_data->LogDate->CssStyle = "";
			$exam_data->LogDate->CssClass = "";
			$exam_data->LogDate->ViewCustomAttributes = "";

			// ModifyUser
			$exam_data->ModifyUser->ViewValue = $exam_data->ModifyUser->CurrentValue;
			$exam_data->ModifyUser->CssStyle = "";
			$exam_data->ModifyUser->CssClass = "";
			$exam_data->ModifyUser->ViewCustomAttributes = "";

			// ModifyDate
			$exam_data->ModifyDate->ViewValue = $exam_data->ModifyDate->CurrentValue;
			$exam_data->ModifyDate->ViewValue = ew_FormatDateTime($exam_data->ModifyDate->ViewValue, 5);
			$exam_data->ModifyDate->CssStyle = "";
			$exam_data->ModifyDate->CssClass = "";
			$exam_data->ModifyDate->ViewCustomAttributes = "";

			// CreatePart
			$exam_data->CreatePart->ViewValue = $exam_data->CreatePart->CurrentValue;
			$exam_data->CreatePart->CssStyle = "";
			$exam_data->CreatePart->CssClass = "";
			$exam_data->CreatePart->ViewCustomAttributes = "";

			// ModifyPart
			$exam_data->ModifyPart->ViewValue = $exam_data->ModifyPart->CurrentValue;
			$exam_data->ModifyPart->CssStyle = "";
			$exam_data->ModifyPart->CssClass = "";
			$exam_data->ModifyPart->ViewCustomAttributes = "";

			// Status
			$exam_data->Status->ViewValue = $exam_data->Status->CurrentValue;
			$exam_data->Status->CssStyle = "";
			$exam_data->Status->CssClass = "";
			$exam_data->Status->ViewCustomAttributes = "";

			// ExamDataNo
			$exam_data->ExamDataNo->HrefValue = "";

			// AccessionNumber
			$exam_data->AccessionNumber->HrefValue = "";

			// PatientMainNo
			$exam_data->PatientMainNo->HrefValue = "";

			// PatientID
			$exam_data->PatientID->HrefValue = "";

			// InstitutionNo
			$exam_data->InstitutionNo->HrefValue = "";

			// ImageDetailNo
			$exam_data->ImageDetailNo->HrefValue = "";

			// PatientKindNo
			$exam_data->PatientKindNo->HrefValue = "";

			// PatientSubKindNo
			$exam_data->PatientSubKindNo->HrefValue = "";

			// PatientTypeNo
			$exam_data->PatientTypeNo->HrefValue = "";

			// PatientRoom
			$exam_data->PatientRoom->HrefValue = "";

			// DepartmentNo
			$exam_data->DepartmentNo->HrefValue = "";

			// DepartmentName
			$exam_data->DepartmentName->HrefValue = "";

			// Soap
			if (!is_null($exam_data->Soap->Upload->DbValue)) {
				$exam_data->Soap->HrefValue = "exam_data_soap__bv.php?ExamDataNo=" . $exam_data->ExamDataNo->CurrentValue;
				if ($exam_data->Export <> "") $exam_data->Soap->HrefValue = ew_ConvertFullUrl($exam_data->Soap->HrefValue);
			} else {
				$exam_data->Soap->HrefValue = "";
			}

			// RequestDoctorID
			$exam_data->RequestDoctorID->HrefValue = "";

			// CodeValue
			$exam_data->CodeValue->HrefValue = "";

			// SpecialExamID
			$exam_data->SpecialExamID->HrefValue = "";

			// SpecialExamName
			$exam_data->SpecialExamName->HrefValue = "";

			// SpecialExamDate
			$exam_data->SpecialExamDate->HrefValue = "";

			// ExamDate
			$exam_data->ExamDate->HrefValue = "";

			// ExamTime
			$exam_data->ExamTime->HrefValue = "";

			// LogDate
			$exam_data->LogDate->HrefValue = "";

			// ModifyUser
			$exam_data->ModifyUser->HrefValue = "";

			// ModifyDate
			$exam_data->ModifyDate->HrefValue = "";

			// CreatePart
			$exam_data->CreatePart->HrefValue = "";

			// ModifyPart
			$exam_data->ModifyPart->HrefValue = "";

			// Status
			$exam_data->Status->HrefValue = "";
		} elseif ($exam_data->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// ExamDataNo
			$exam_data->ExamDataNo->EditCustomAttributes = "";
			$exam_data->ExamDataNo->EditValue = $exam_data->ExamDataNo->CurrentValue;
			$exam_data->ExamDataNo->CssStyle = "";
			$exam_data->ExamDataNo->CssClass = "";
			$exam_data->ExamDataNo->ViewCustomAttributes = "";

			// AccessionNumber
			$exam_data->AccessionNumber->EditCustomAttributes = "";
			$exam_data->AccessionNumber->EditValue = ew_HtmlEncode($exam_data->AccessionNumber->CurrentValue);

			// PatientMainNo
			$exam_data->PatientMainNo->EditCustomAttributes = "";
			$exam_data->PatientMainNo->EditValue = ew_HtmlEncode($exam_data->PatientMainNo->CurrentValue);

			// PatientID
			$exam_data->PatientID->EditCustomAttributes = "";
			$exam_data->PatientID->EditValue = ew_HtmlEncode($exam_data->PatientID->CurrentValue);

			// InstitutionNo
			$exam_data->InstitutionNo->EditCustomAttributes = "";
			$exam_data->InstitutionNo->EditValue = ew_HtmlEncode($exam_data->InstitutionNo->CurrentValue);

			// ImageDetailNo
			$exam_data->ImageDetailNo->EditCustomAttributes = "";
			$exam_data->ImageDetailNo->EditValue = ew_HtmlEncode($exam_data->ImageDetailNo->CurrentValue);

			// PatientKindNo
			$exam_data->PatientKindNo->EditCustomAttributes = "";
			$exam_data->PatientKindNo->EditValue = ew_HtmlEncode($exam_data->PatientKindNo->CurrentValue);

			// PatientSubKindNo
			$exam_data->PatientSubKindNo->EditCustomAttributes = "";
			$exam_data->PatientSubKindNo->EditValue = ew_HtmlEncode($exam_data->PatientSubKindNo->CurrentValue);

			// PatientTypeNo
			$exam_data->PatientTypeNo->EditCustomAttributes = "";
			$exam_data->PatientTypeNo->EditValue = ew_HtmlEncode($exam_data->PatientTypeNo->CurrentValue);

			// PatientRoom
			$exam_data->PatientRoom->EditCustomAttributes = "";
			$exam_data->PatientRoom->EditValue = ew_HtmlEncode($exam_data->PatientRoom->CurrentValue);

			// DepartmentNo
			$exam_data->DepartmentNo->EditCustomAttributes = "";
			$exam_data->DepartmentNo->EditValue = ew_HtmlEncode($exam_data->DepartmentNo->CurrentValue);

			// DepartmentName
			$exam_data->DepartmentName->EditCustomAttributes = "";
			$exam_data->DepartmentName->EditValue = ew_HtmlEncode($exam_data->DepartmentName->CurrentValue);

			// Soap
			$exam_data->Soap->EditCustomAttributes = "";
			if (!is_null($exam_data->Soap->Upload->DbValue)) {
				$exam_data->Soap->EditValue = "Soap";
			} else {
				$exam_data->Soap->EditValue = "";
			}

			// RequestDoctorID
			$exam_data->RequestDoctorID->EditCustomAttributes = "";
			$exam_data->RequestDoctorID->EditValue = ew_HtmlEncode($exam_data->RequestDoctorID->CurrentValue);

			// CodeValue
			$exam_data->CodeValue->EditCustomAttributes = "";
			$exam_data->CodeValue->EditValue = ew_HtmlEncode($exam_data->CodeValue->CurrentValue);

			// SpecialExamID
			$exam_data->SpecialExamID->EditCustomAttributes = "";
			$exam_data->SpecialExamID->EditValue = ew_HtmlEncode($exam_data->SpecialExamID->CurrentValue);

			// SpecialExamName
			$exam_data->SpecialExamName->EditCustomAttributes = "";
			$exam_data->SpecialExamName->EditValue = ew_HtmlEncode($exam_data->SpecialExamName->CurrentValue);

			// SpecialExamDate
			$exam_data->SpecialExamDate->EditCustomAttributes = "";
			$exam_data->SpecialExamDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($exam_data->SpecialExamDate->CurrentValue, 5));

			// ExamDate
			$exam_data->ExamDate->EditCustomAttributes = "";
			$exam_data->ExamDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($exam_data->ExamDate->CurrentValue, 5));

			// ExamTime
			$exam_data->ExamTime->EditCustomAttributes = "";
			$exam_data->ExamTime->EditValue = ew_HtmlEncode(ew_FormatDateTime($exam_data->ExamTime->CurrentValue, 4));

			// LogDate
			$exam_data->LogDate->EditCustomAttributes = "";
			$exam_data->LogDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($exam_data->LogDate->CurrentValue, 5));

			// ModifyUser
			$exam_data->ModifyUser->EditCustomAttributes = "";
			$exam_data->ModifyUser->EditValue = ew_HtmlEncode($exam_data->ModifyUser->CurrentValue);

			// ModifyDate
			$exam_data->ModifyDate->EditCustomAttributes = "";
			$exam_data->ModifyDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($exam_data->ModifyDate->CurrentValue, 5));

			// CreatePart
			$exam_data->CreatePart->EditCustomAttributes = "";
			$exam_data->CreatePart->EditValue = ew_HtmlEncode($exam_data->CreatePart->CurrentValue);

			// ModifyPart
			$exam_data->ModifyPart->EditCustomAttributes = "";
			$exam_data->ModifyPart->EditValue = ew_HtmlEncode($exam_data->ModifyPart->CurrentValue);

			// Status
			$exam_data->Status->EditCustomAttributes = "";
			$exam_data->Status->EditValue = ew_HtmlEncode($exam_data->Status->CurrentValue);

			// Edit refer script
			// ExamDataNo

			$exam_data->ExamDataNo->HrefValue = "";

			// AccessionNumber
			$exam_data->AccessionNumber->HrefValue = "";

			// PatientMainNo
			$exam_data->PatientMainNo->HrefValue = "";

			// PatientID
			$exam_data->PatientID->HrefValue = "";

			// InstitutionNo
			$exam_data->InstitutionNo->HrefValue = "";

			// ImageDetailNo
			$exam_data->ImageDetailNo->HrefValue = "";

			// PatientKindNo
			$exam_data->PatientKindNo->HrefValue = "";

			// PatientSubKindNo
			$exam_data->PatientSubKindNo->HrefValue = "";

			// PatientTypeNo
			$exam_data->PatientTypeNo->HrefValue = "";

			// PatientRoom
			$exam_data->PatientRoom->HrefValue = "";

			// DepartmentNo
			$exam_data->DepartmentNo->HrefValue = "";

			// DepartmentName
			$exam_data->DepartmentName->HrefValue = "";

			// Soap
			if (!is_null($exam_data->Soap->Upload->DbValue)) {
				$exam_data->Soap->HrefValue = "exam_data_soap__bv.php?ExamDataNo=" . $exam_data->ExamDataNo->CurrentValue;
				if ($exam_data->Export <> "") $exam_data->Soap->HrefValue = ew_ConvertFullUrl($exam_data->Soap->HrefValue);
			} else {
				$exam_data->Soap->HrefValue = "";
			}

			// RequestDoctorID
			$exam_data->RequestDoctorID->HrefValue = "";

			// CodeValue
			$exam_data->CodeValue->HrefValue = "";

			// SpecialExamID
			$exam_data->SpecialExamID->HrefValue = "";

			// SpecialExamName
			$exam_data->SpecialExamName->HrefValue = "";

			// SpecialExamDate
			$exam_data->SpecialExamDate->HrefValue = "";

			// ExamDate
			$exam_data->ExamDate->HrefValue = "";

			// ExamTime
			$exam_data->ExamTime->HrefValue = "";

			// LogDate
			$exam_data->LogDate->HrefValue = "";

			// ModifyUser
			$exam_data->ModifyUser->HrefValue = "";

			// ModifyDate
			$exam_data->ModifyDate->HrefValue = "";

			// CreatePart
			$exam_data->CreatePart->HrefValue = "";

			// ModifyPart
			$exam_data->ModifyPart->HrefValue = "";

			// Status
			$exam_data->Status->HrefValue = "";
		}

		// Call Row Rendered event
		$exam_data->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $exam_data;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($exam_data->Soap->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($exam_data->Soap->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($exam_data->Soap->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($exam_data->ExamDataNo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Exam Data No";
		}
		if (!ew_CheckInteger($exam_data->ExamDataNo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Exam Data No";
		}
		if ($exam_data->PatientMainNo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Patient Main No";
		}
		if (!ew_CheckInteger($exam_data->PatientMainNo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Patient Main No";
		}
		if ($exam_data->InstitutionNo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Institution No";
		}
		if (!ew_CheckInteger($exam_data->InstitutionNo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Institution No";
		}
		if (!ew_CheckInteger($exam_data->ImageDetailNo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Image Detail No";
		}
		if (!ew_CheckInteger($exam_data->PatientKindNo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Patient Kind No";
		}
		if ($exam_data->PatientSubKindNo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Patient Sub Kind No";
		}
		if (!ew_CheckInteger($exam_data->PatientSubKindNo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Patient Sub Kind No";
		}
		if (!ew_CheckInteger($exam_data->PatientTypeNo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Patient Type No";
		}
		if (!ew_CheckInteger($exam_data->DepartmentNo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Department No";
		}
		if (!ew_CheckDate($exam_data->SpecialExamDate->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Special Exam Date";
		}
		if ($exam_data->ExamDate->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Exam Date";
		}
		if (!ew_CheckDate($exam_data->ExamDate->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Exam Date";
		}
		if ($exam_data->ExamTime->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Exam Time";
		}
		if (!ew_CheckTime($exam_data->ExamTime->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect time (hh:mm:ss) - Exam Time";
		}
		if ($exam_data->LogDate->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Log Date";
		}
		if (!ew_CheckDate($exam_data->LogDate->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Log Date";
		}
		if (!ew_CheckDate($exam_data->ModifyDate->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Modify Date";
		}
		if ($exam_data->CreatePart->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Create Part";
		}
		if ($exam_data->ModifyPart->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Modify Part";
		}
		if ($exam_data->Status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Status";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $exam_data;
		$sFilter = $exam_data->KeyFilter();
		$exam_data->CurrentFilter = $sFilter;
		$sSql = $exam_data->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field ExamDataNo
			// Field AccessionNumber

			$exam_data->AccessionNumber->SetDbValueDef($exam_data->AccessionNumber->CurrentValue, NULL);
			$rsnew['AccessionNumber'] =& $exam_data->AccessionNumber->DbValue;

			// Field PatientMainNo
			$exam_data->PatientMainNo->SetDbValueDef($exam_data->PatientMainNo->CurrentValue, 0);
			$rsnew['PatientMainNo'] =& $exam_data->PatientMainNo->DbValue;

			// Field PatientID
			$exam_data->PatientID->SetDbValueDef($exam_data->PatientID->CurrentValue, NULL);
			$rsnew['PatientID'] =& $exam_data->PatientID->DbValue;

			// Field InstitutionNo
			$exam_data->InstitutionNo->SetDbValueDef($exam_data->InstitutionNo->CurrentValue, 0);
			$rsnew['InstitutionNo'] =& $exam_data->InstitutionNo->DbValue;

			// Field ImageDetailNo
			$exam_data->ImageDetailNo->SetDbValueDef($exam_data->ImageDetailNo->CurrentValue, NULL);
			$rsnew['ImageDetailNo'] =& $exam_data->ImageDetailNo->DbValue;

			// Field PatientKindNo
			$exam_data->PatientKindNo->SetDbValueDef($exam_data->PatientKindNo->CurrentValue, NULL);
			$rsnew['PatientKindNo'] =& $exam_data->PatientKindNo->DbValue;

			// Field PatientSubKindNo
			$exam_data->PatientSubKindNo->SetDbValueDef($exam_data->PatientSubKindNo->CurrentValue, 0);
			$rsnew['PatientSubKindNo'] =& $exam_data->PatientSubKindNo->DbValue;

			// Field PatientTypeNo
			$exam_data->PatientTypeNo->SetDbValueDef($exam_data->PatientTypeNo->CurrentValue, NULL);
			$rsnew['PatientTypeNo'] =& $exam_data->PatientTypeNo->DbValue;

			// Field PatientRoom
			$exam_data->PatientRoom->SetDbValueDef($exam_data->PatientRoom->CurrentValue, NULL);
			$rsnew['PatientRoom'] =& $exam_data->PatientRoom->DbValue;

			// Field DepartmentNo
			$exam_data->DepartmentNo->SetDbValueDef($exam_data->DepartmentNo->CurrentValue, NULL);
			$rsnew['DepartmentNo'] =& $exam_data->DepartmentNo->DbValue;

			// Field DepartmentName
			$exam_data->DepartmentName->SetDbValueDef($exam_data->DepartmentName->CurrentValue, NULL);
			$rsnew['DepartmentName'] =& $exam_data->DepartmentName->DbValue;

			// Field Soap
			$exam_data->Soap->Upload->SaveToSession(); // Save file value to Session
			if ($exam_data->Soap->Upload->Action == "2" || $exam_data->Soap->Upload->Action == "3") { // Update/Remove
			if (is_null($exam_data->Soap->Upload->Value)) {
				$rsnew['Soap'] = NULL;	
			} else {
				$rsnew['Soap'] = $exam_data->Soap->Upload->Value;
			}
			}

			// Field RequestDoctorID
			$exam_data->RequestDoctorID->SetDbValueDef($exam_data->RequestDoctorID->CurrentValue, NULL);
			$rsnew['RequestDoctorID'] =& $exam_data->RequestDoctorID->DbValue;

			// Field CodeValue
			$exam_data->CodeValue->SetDbValueDef($exam_data->CodeValue->CurrentValue, NULL);
			$rsnew['CodeValue'] =& $exam_data->CodeValue->DbValue;

			// Field SpecialExamID
			$exam_data->SpecialExamID->SetDbValueDef($exam_data->SpecialExamID->CurrentValue, NULL);
			$rsnew['SpecialExamID'] =& $exam_data->SpecialExamID->DbValue;

			// Field SpecialExamName
			$exam_data->SpecialExamName->SetDbValueDef($exam_data->SpecialExamName->CurrentValue, NULL);
			$rsnew['SpecialExamName'] =& $exam_data->SpecialExamName->DbValue;

			// Field SpecialExamDate
			$exam_data->SpecialExamDate->SetDbValueDef(ew_UnFormatDateTime($exam_data->SpecialExamDate->CurrentValue, 5), NULL);
			$rsnew['SpecialExamDate'] =& $exam_data->SpecialExamDate->DbValue;

			// Field ExamDate
			$exam_data->ExamDate->SetDbValueDef(ew_UnFormatDateTime($exam_data->ExamDate->CurrentValue, 5), ew_CurrentDate());
			$rsnew['ExamDate'] =& $exam_data->ExamDate->DbValue;

			// Field ExamTime
			$exam_data->ExamTime->SetDbValueDef(ew_FormatDateTime($exam_data->ExamTime->CurrentValue, 4), ew_CurrentTime());
			$rsnew['ExamTime'] =& $exam_data->ExamTime->DbValue;

			// Field LogDate
			$exam_data->LogDate->SetDbValueDef(ew_UnFormatDateTime($exam_data->LogDate->CurrentValue, 5), ew_CurrentDate());
			$rsnew['LogDate'] =& $exam_data->LogDate->DbValue;

			// Field ModifyUser
			$exam_data->ModifyUser->SetDbValueDef($exam_data->ModifyUser->CurrentValue, NULL);
			$rsnew['ModifyUser'] =& $exam_data->ModifyUser->DbValue;

			// Field ModifyDate
			$exam_data->ModifyDate->SetDbValueDef(ew_UnFormatDateTime($exam_data->ModifyDate->CurrentValue, 5), NULL);
			$rsnew['ModifyDate'] =& $exam_data->ModifyDate->DbValue;

			// Field CreatePart
			$exam_data->CreatePart->SetDbValueDef($exam_data->CreatePart->CurrentValue, "");
			$rsnew['CreatePart'] =& $exam_data->CreatePart->DbValue;

			// Field ModifyPart
			$exam_data->ModifyPart->SetDbValueDef($exam_data->ModifyPart->CurrentValue, "");
			$rsnew['ModifyPart'] =& $exam_data->ModifyPart->DbValue;

			// Field Status
			$exam_data->Status->SetDbValueDef($exam_data->Status->CurrentValue, "");
			$rsnew['Status'] =& $exam_data->Status->DbValue;

			// Call Row Updating event
			$bUpdateRow = $exam_data->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field Soap
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($exam_data->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($exam_data->CancelMessage <> "") {
					$this->setMessage($exam_data->CancelMessage);
					$exam_data->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$exam_data->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field Soap
		$exam_data->Soap->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
