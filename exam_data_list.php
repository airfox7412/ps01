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
$exam_data_list = new cexam_data_list();
$Page =& $exam_data_list;

// Page init processing
$exam_data_list->Page_Init();

// Page main processing
$exam_data_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($exam_data->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var exam_data_list = new ew_Page("exam_data_list");

// page properties
exam_data_list.PageID = "list"; // page ID
var EW_PAGE_ID = exam_data_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
exam_data_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
exam_data_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
exam_data_list.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<?php if ($exam_data->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($exam_data->Export == "" && $exam_data->SelectLimit);
	if (!$bSelectLimit)
		$rs = $exam_data_list->LoadRecordset();
	$exam_data_list->lTotalRecs = ($bSelectLimit) ? $exam_data->SelectRecordCount() : $rs->RecordCount();
	$exam_data_list->lStartRec = 1;
	if ($exam_data_list->lDisplayRecs <= 0) // Display all records
		$exam_data_list->lDisplayRecs = $exam_data_list->lTotalRecs;
	if (!($exam_data->ExportAll && $exam_data->Export <> ""))
		$exam_data_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $exam_data_list->LoadRecordset($exam_data_list->lStartRec-1, $exam_data_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: Exam Data
</span></p>
<?php if ($exam_data->Export == "" && $exam_data->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(exam_data_list);" style="text-decoration: none;"><img id="exam_data_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="exam_data_list_SearchPanel">
<form name="fexam_datalistsrch" id="fexam_datalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="exam_data">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($exam_data->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $exam_data_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($exam_data->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($exam_data->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($exam_data->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $exam_data_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fexam_datalist" id="fexam_datalist" class="ewForm" action="" method="post">
<?php if ($exam_data_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$exam_data_list->lOptionCnt = 0;
	$exam_data_list->lOptionCnt++; // view
	$exam_data_list->lOptionCnt++; // edit
	$exam_data_list->lOptionCnt++; // copy
	$exam_data_list->lOptionCnt++; // Delete
	$exam_data_list->lOptionCnt += count($exam_data_list->ListOptions->Items); // Custom list options
?>
<?php echo $exam_data->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($exam_data->ExamDataNo->Visible) { // ExamDataNo ?>
	<?php if ($exam_data->SortUrl($exam_data->ExamDataNo) == "") { ?>
		<td>Exam Data No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->ExamDataNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Exam Data No</td><td style="width: 10px;"><?php if ($exam_data->ExamDataNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->ExamDataNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->AccessionNumber->Visible) { // AccessionNumber ?>
	<?php if ($exam_data->SortUrl($exam_data->AccessionNumber) == "") { ?>
		<td>Accession Number</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->AccessionNumber) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Accession Number&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->AccessionNumber->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->AccessionNumber->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->PatientMainNo->Visible) { // PatientMainNo ?>
	<?php if ($exam_data->SortUrl($exam_data->PatientMainNo) == "") { ?>
		<td>Patient Main No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->PatientMainNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Main No</td><td style="width: 10px;"><?php if ($exam_data->PatientMainNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->PatientMainNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->PatientID->Visible) { // PatientID ?>
	<?php if ($exam_data->SortUrl($exam_data->PatientID) == "") { ?>
		<td>Patient ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->PatientID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient ID&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->PatientID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->PatientID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->InstitutionNo->Visible) { // InstitutionNo ?>
	<?php if ($exam_data->SortUrl($exam_data->InstitutionNo) == "") { ?>
		<td>Institution No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->InstitutionNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Institution No</td><td style="width: 10px;"><?php if ($exam_data->InstitutionNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->InstitutionNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->ImageDetailNo->Visible) { // ImageDetailNo ?>
	<?php if ($exam_data->SortUrl($exam_data->ImageDetailNo) == "") { ?>
		<td>Image Detail No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->ImageDetailNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Image Detail No</td><td style="width: 10px;"><?php if ($exam_data->ImageDetailNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->ImageDetailNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->PatientKindNo->Visible) { // PatientKindNo ?>
	<?php if ($exam_data->SortUrl($exam_data->PatientKindNo) == "") { ?>
		<td>Patient Kind No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->PatientKindNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Kind No</td><td style="width: 10px;"><?php if ($exam_data->PatientKindNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->PatientKindNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->PatientSubKindNo->Visible) { // PatientSubKindNo ?>
	<?php if ($exam_data->SortUrl($exam_data->PatientSubKindNo) == "") { ?>
		<td>Patient Sub Kind No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->PatientSubKindNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Sub Kind No</td><td style="width: 10px;"><?php if ($exam_data->PatientSubKindNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->PatientSubKindNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->PatientTypeNo->Visible) { // PatientTypeNo ?>
	<?php if ($exam_data->SortUrl($exam_data->PatientTypeNo) == "") { ?>
		<td>Patient Type No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->PatientTypeNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Type No</td><td style="width: 10px;"><?php if ($exam_data->PatientTypeNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->PatientTypeNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->PatientRoom->Visible) { // PatientRoom ?>
	<?php if ($exam_data->SortUrl($exam_data->PatientRoom) == "") { ?>
		<td>Patient Room</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->PatientRoom) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Room&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->PatientRoom->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->PatientRoom->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->DepartmentNo->Visible) { // DepartmentNo ?>
	<?php if ($exam_data->SortUrl($exam_data->DepartmentNo) == "") { ?>
		<td>Department No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->DepartmentNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Department No</td><td style="width: 10px;"><?php if ($exam_data->DepartmentNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->DepartmentNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($exam_data->SortUrl($exam_data->DepartmentName) == "") { ?>
		<td>Department Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->DepartmentName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Department Name&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->DepartmentName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->DepartmentName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->RequestDoctorID->Visible) { // RequestDoctorID ?>
	<?php if ($exam_data->SortUrl($exam_data->RequestDoctorID) == "") { ?>
		<td>Request Doctor ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->RequestDoctorID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Request Doctor ID&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->RequestDoctorID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->RequestDoctorID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->CodeValue->Visible) { // CodeValue ?>
	<?php if ($exam_data->SortUrl($exam_data->CodeValue) == "") { ?>
		<td>Code Value</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->CodeValue) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Code Value&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->CodeValue->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->CodeValue->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->SpecialExamID->Visible) { // SpecialExamID ?>
	<?php if ($exam_data->SortUrl($exam_data->SpecialExamID) == "") { ?>
		<td>Special Exam ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->SpecialExamID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Special Exam ID&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->SpecialExamID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->SpecialExamID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->SpecialExamName->Visible) { // SpecialExamName ?>
	<?php if ($exam_data->SortUrl($exam_data->SpecialExamName) == "") { ?>
		<td>Special Exam Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->SpecialExamName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Special Exam Name&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->SpecialExamName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->SpecialExamName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->SpecialExamDate->Visible) { // SpecialExamDate ?>
	<?php if ($exam_data->SortUrl($exam_data->SpecialExamDate) == "") { ?>
		<td>Special Exam Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->SpecialExamDate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Special Exam Date</td><td style="width: 10px;"><?php if ($exam_data->SpecialExamDate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->SpecialExamDate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->ExamDate->Visible) { // ExamDate ?>
	<?php if ($exam_data->SortUrl($exam_data->ExamDate) == "") { ?>
		<td>Exam Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->ExamDate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Exam Date</td><td style="width: 10px;"><?php if ($exam_data->ExamDate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->ExamDate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->ExamTime->Visible) { // ExamTime ?>
	<?php if ($exam_data->SortUrl($exam_data->ExamTime) == "") { ?>
		<td>Exam Time</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->ExamTime) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Exam Time</td><td style="width: 10px;"><?php if ($exam_data->ExamTime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->ExamTime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->LogDate->Visible) { // LogDate ?>
	<?php if ($exam_data->SortUrl($exam_data->LogDate) == "") { ?>
		<td>Log Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->LogDate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Log Date</td><td style="width: 10px;"><?php if ($exam_data->LogDate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->LogDate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->ModifyUser->Visible) { // ModifyUser ?>
	<?php if ($exam_data->SortUrl($exam_data->ModifyUser) == "") { ?>
		<td>Modify User</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->ModifyUser) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Modify User&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->ModifyUser->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->ModifyUser->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->ModifyDate->Visible) { // ModifyDate ?>
	<?php if ($exam_data->SortUrl($exam_data->ModifyDate) == "") { ?>
		<td>Modify Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->ModifyDate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Modify Date</td><td style="width: 10px;"><?php if ($exam_data->ModifyDate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->ModifyDate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->CreatePart->Visible) { // CreatePart ?>
	<?php if ($exam_data->SortUrl($exam_data->CreatePart) == "") { ?>
		<td>Create Part</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->CreatePart) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Create Part&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->CreatePart->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->CreatePart->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->ModifyPart->Visible) { // ModifyPart ?>
	<?php if ($exam_data->SortUrl($exam_data->ModifyPart) == "") { ?>
		<td>Modify Part</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->ModifyPart) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Modify Part&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->ModifyPart->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->ModifyPart->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->Status->Visible) { // Status ?>
	<?php if ($exam_data->SortUrl($exam_data->Status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $exam_data->SortUrl($exam_data->Status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status&nbsp;(*)</td><td style="width: 10px;"><?php if ($exam_data->Status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($exam_data->Status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($exam_data->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($exam_data_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($exam_data->ExportAll && $exam_data->Export <> "") {
	$exam_data_list->lStopRec = $exam_data_list->lTotalRecs;
} else {
	$exam_data_list->lStopRec = $exam_data_list->lStartRec + $exam_data_list->lDisplayRecs - 1; // Set the last record to display
}
$exam_data_list->lRecCount = $exam_data_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$exam_data->SelectLimit && $exam_data_list->lStartRec > 1)
		$rs->Move($exam_data_list->lStartRec - 1);
}
$exam_data_list->lRowCnt = 0;
while (($exam_data->CurrentAction == "gridadd" || !$rs->EOF) &&
	$exam_data_list->lRecCount < $exam_data_list->lStopRec) {
	$exam_data_list->lRecCount++;
	if (intval($exam_data_list->lRecCount) >= intval($exam_data_list->lStartRec)) {
		$exam_data_list->lRowCnt++;

	// Init row class and style
	$exam_data->CssClass = "";
	$exam_data->CssStyle = "";
	$exam_data->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($exam_data->CurrentAction == "gridadd") {
		$exam_data_list->LoadDefaultValues(); // Load default values
	} else {
		$exam_data_list->LoadRowValues($rs); // Load row values
	}
	$exam_data->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$exam_data_list->RenderRow();
?>
	<tr<?php echo $exam_data->RowAttributes() ?>>
	<?php if ($exam_data->ExamDataNo->Visible) { // ExamDataNo ?>
		<td<?php echo $exam_data->ExamDataNo->CellAttributes() ?>>
<div<?php echo $exam_data->ExamDataNo->ViewAttributes() ?>><?php echo $exam_data->ExamDataNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->AccessionNumber->Visible) { // AccessionNumber ?>
		<td<?php echo $exam_data->AccessionNumber->CellAttributes() ?>>
<div<?php echo $exam_data->AccessionNumber->ViewAttributes() ?>><?php echo $exam_data->AccessionNumber->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->PatientMainNo->Visible) { // PatientMainNo ?>
		<td<?php echo $exam_data->PatientMainNo->CellAttributes() ?>>
<div<?php echo $exam_data->PatientMainNo->ViewAttributes() ?>><?php echo $exam_data->PatientMainNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->PatientID->Visible) { // PatientID ?>
		<td<?php echo $exam_data->PatientID->CellAttributes() ?>>
<div<?php echo $exam_data->PatientID->ViewAttributes() ?>><?php echo $exam_data->PatientID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->InstitutionNo->Visible) { // InstitutionNo ?>
		<td<?php echo $exam_data->InstitutionNo->CellAttributes() ?>>
<div<?php echo $exam_data->InstitutionNo->ViewAttributes() ?>><?php echo $exam_data->InstitutionNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->ImageDetailNo->Visible) { // ImageDetailNo ?>
		<td<?php echo $exam_data->ImageDetailNo->CellAttributes() ?>>
<div<?php echo $exam_data->ImageDetailNo->ViewAttributes() ?>><?php echo $exam_data->ImageDetailNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->PatientKindNo->Visible) { // PatientKindNo ?>
		<td<?php echo $exam_data->PatientKindNo->CellAttributes() ?>>
<div<?php echo $exam_data->PatientKindNo->ViewAttributes() ?>><?php echo $exam_data->PatientKindNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->PatientSubKindNo->Visible) { // PatientSubKindNo ?>
		<td<?php echo $exam_data->PatientSubKindNo->CellAttributes() ?>>
<div<?php echo $exam_data->PatientSubKindNo->ViewAttributes() ?>><?php echo $exam_data->PatientSubKindNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->PatientTypeNo->Visible) { // PatientTypeNo ?>
		<td<?php echo $exam_data->PatientTypeNo->CellAttributes() ?>>
<div<?php echo $exam_data->PatientTypeNo->ViewAttributes() ?>><?php echo $exam_data->PatientTypeNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->PatientRoom->Visible) { // PatientRoom ?>
		<td<?php echo $exam_data->PatientRoom->CellAttributes() ?>>
<div<?php echo $exam_data->PatientRoom->ViewAttributes() ?>><?php echo $exam_data->PatientRoom->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->DepartmentNo->Visible) { // DepartmentNo ?>
		<td<?php echo $exam_data->DepartmentNo->CellAttributes() ?>>
<div<?php echo $exam_data->DepartmentNo->ViewAttributes() ?>><?php echo $exam_data->DepartmentNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->DepartmentName->Visible) { // DepartmentName ?>
		<td<?php echo $exam_data->DepartmentName->CellAttributes() ?>>
<div<?php echo $exam_data->DepartmentName->ViewAttributes() ?>><?php echo $exam_data->DepartmentName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->RequestDoctorID->Visible) { // RequestDoctorID ?>
		<td<?php echo $exam_data->RequestDoctorID->CellAttributes() ?>>
<div<?php echo $exam_data->RequestDoctorID->ViewAttributes() ?>><?php echo $exam_data->RequestDoctorID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->CodeValue->Visible) { // CodeValue ?>
		<td<?php echo $exam_data->CodeValue->CellAttributes() ?>>
<div<?php echo $exam_data->CodeValue->ViewAttributes() ?>><?php echo $exam_data->CodeValue->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->SpecialExamID->Visible) { // SpecialExamID ?>
		<td<?php echo $exam_data->SpecialExamID->CellAttributes() ?>>
<div<?php echo $exam_data->SpecialExamID->ViewAttributes() ?>><?php echo $exam_data->SpecialExamID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->SpecialExamName->Visible) { // SpecialExamName ?>
		<td<?php echo $exam_data->SpecialExamName->CellAttributes() ?>>
<div<?php echo $exam_data->SpecialExamName->ViewAttributes() ?>><?php echo $exam_data->SpecialExamName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->SpecialExamDate->Visible) { // SpecialExamDate ?>
		<td<?php echo $exam_data->SpecialExamDate->CellAttributes() ?>>
<div<?php echo $exam_data->SpecialExamDate->ViewAttributes() ?>><?php echo $exam_data->SpecialExamDate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->ExamDate->Visible) { // ExamDate ?>
		<td<?php echo $exam_data->ExamDate->CellAttributes() ?>>
<div<?php echo $exam_data->ExamDate->ViewAttributes() ?>><?php echo $exam_data->ExamDate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->ExamTime->Visible) { // ExamTime ?>
		<td<?php echo $exam_data->ExamTime->CellAttributes() ?>>
<div<?php echo $exam_data->ExamTime->ViewAttributes() ?>><?php echo $exam_data->ExamTime->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->LogDate->Visible) { // LogDate ?>
		<td<?php echo $exam_data->LogDate->CellAttributes() ?>>
<div<?php echo $exam_data->LogDate->ViewAttributes() ?>><?php echo $exam_data->LogDate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->ModifyUser->Visible) { // ModifyUser ?>
		<td<?php echo $exam_data->ModifyUser->CellAttributes() ?>>
<div<?php echo $exam_data->ModifyUser->ViewAttributes() ?>><?php echo $exam_data->ModifyUser->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->ModifyDate->Visible) { // ModifyDate ?>
		<td<?php echo $exam_data->ModifyDate->CellAttributes() ?>>
<div<?php echo $exam_data->ModifyDate->ViewAttributes() ?>><?php echo $exam_data->ModifyDate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->CreatePart->Visible) { // CreatePart ?>
		<td<?php echo $exam_data->CreatePart->CellAttributes() ?>>
<div<?php echo $exam_data->CreatePart->ViewAttributes() ?>><?php echo $exam_data->CreatePart->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->ModifyPart->Visible) { // ModifyPart ?>
		<td<?php echo $exam_data->ModifyPart->CellAttributes() ?>>
<div<?php echo $exam_data->ModifyPart->ViewAttributes() ?>><?php echo $exam_data->ModifyPart->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($exam_data->Status->Visible) { // Status ?>
		<td<?php echo $exam_data->Status->CellAttributes() ?>>
<div<?php echo $exam_data->Status->ViewAttributes() ?>><?php echo $exam_data->Status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($exam_data->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $exam_data->ViewUrl() ?>">View</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $exam_data->EditUrl() ?>">Edit</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $exam_data->CopyUrl() ?>">Copy</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $exam_data->DeleteUrl() ?>">Delete</a>
</span></td>
<?php

// Custom list options
foreach ($exam_data_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($exam_data->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($exam_data->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($exam_data->CurrentAction <> "gridadd" && $exam_data->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($exam_data_list->Pager)) $exam_data_list->Pager = new cPrevNextPager($exam_data_list->lStartRec, $exam_data_list->lDisplayRecs, $exam_data_list->lTotalRecs) ?>
<?php if ($exam_data_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($exam_data_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $exam_data_list->PageUrl() ?>start=<?php echo $exam_data_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($exam_data_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $exam_data_list->PageUrl() ?>start=<?php echo $exam_data_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $exam_data_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($exam_data_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $exam_data_list->PageUrl() ?>start=<?php echo $exam_data_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($exam_data_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $exam_data_list->PageUrl() ?>start=<?php echo $exam_data_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $exam_data_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $exam_data_list->Pager->FromIndex ?> to <?php echo $exam_data_list->Pager->ToIndex ?> of <?php echo $exam_data_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($exam_data_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($exam_data_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<a href="<?php echo $exam_data->AddUrl() ?>">Add</a>&nbsp;&nbsp;
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($exam_data->Export == "" && $exam_data->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(exam_data_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($exam_data->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cexam_data_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'exam_data';

	// Page Object Name
	var $PageObjName = 'exam_data_list';

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
	function cexam_data_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["exam_data"] = new cexam_data();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'exam_data', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $exam_data;
	$exam_data->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $exam_data->Export; // Get export parameter, used in header
	$gsExportFile = $exam_data->TableVar; // Get export file, used in header

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
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $sSrchWhere;
	var $lRecCnt;
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex;
	var $lOptionCnt;
	var $lRecPerRow;
	var $lColCnt;
	var $sDeleteConfirmMsg; // Delete confirm message
	var $sDbMasterFilter;
	var $sDbDetailFilter;
	var $bMasterRecordExists;	
	var $ListOptions;
	var $sMultiSelectKey;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $Security, $exam_data;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause

		// Master/Detail
		$this->sDbMasterFilter = ""; // Master filter
		$this->sDbDetailFilter = ""; // Detail filter
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($exam_data->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $exam_data->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchAdvanced)" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchBasic)" : $sSrchBasic;

		// Call Recordset_Searching event
		$exam_data->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$exam_data->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$exam_data->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$exam_data->setSessionWhere($sFilter);
		$exam_data->CurrentFilter = "";
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $exam_data;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $exam_data->AccessionNumber->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->PatientID->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->PatientRoom->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->DepartmentName->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->RequestDoctorID->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->CodeValue->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->SpecialExamID->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->SpecialExamName->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->ModifyUser->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->CreatePart->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->ModifyPart->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $exam_data->Status->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $exam_data;
		$sSearchStr = "";
		$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
		$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$exam_data->setBasicSearchKeyword($sSearchKeyword);
			$exam_data->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $exam_data;
		$this->sSrchWhere = "";
		$exam_data->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $exam_data;
		$exam_data->setBasicSearchKeyword("");
		$exam_data->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $exam_data;
		$this->sSrchWhere = $exam_data->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $exam_data;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$exam_data->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$exam_data->CurrentOrderType = @$_GET["ordertype"];
			$exam_data->UpdateSort($exam_data->ExamDataNo); // Field 
			$exam_data->UpdateSort($exam_data->AccessionNumber); // Field 
			$exam_data->UpdateSort($exam_data->PatientMainNo); // Field 
			$exam_data->UpdateSort($exam_data->PatientID); // Field 
			$exam_data->UpdateSort($exam_data->InstitutionNo); // Field 
			$exam_data->UpdateSort($exam_data->ImageDetailNo); // Field 
			$exam_data->UpdateSort($exam_data->PatientKindNo); // Field 
			$exam_data->UpdateSort($exam_data->PatientSubKindNo); // Field 
			$exam_data->UpdateSort($exam_data->PatientTypeNo); // Field 
			$exam_data->UpdateSort($exam_data->PatientRoom); // Field 
			$exam_data->UpdateSort($exam_data->DepartmentNo); // Field 
			$exam_data->UpdateSort($exam_data->DepartmentName); // Field 
			$exam_data->UpdateSort($exam_data->RequestDoctorID); // Field 
			$exam_data->UpdateSort($exam_data->CodeValue); // Field 
			$exam_data->UpdateSort($exam_data->SpecialExamID); // Field 
			$exam_data->UpdateSort($exam_data->SpecialExamName); // Field 
			$exam_data->UpdateSort($exam_data->SpecialExamDate); // Field 
			$exam_data->UpdateSort($exam_data->ExamDate); // Field 
			$exam_data->UpdateSort($exam_data->ExamTime); // Field 
			$exam_data->UpdateSort($exam_data->LogDate); // Field 
			$exam_data->UpdateSort($exam_data->ModifyUser); // Field 
			$exam_data->UpdateSort($exam_data->ModifyDate); // Field 
			$exam_data->UpdateSort($exam_data->CreatePart); // Field 
			$exam_data->UpdateSort($exam_data->ModifyPart); // Field 
			$exam_data->UpdateSort($exam_data->Status); // Field 
			$exam_data->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $exam_data;
		$sOrderBy = $exam_data->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($exam_data->SqlOrderBy() <> "") {
				$sOrderBy = $exam_data->SqlOrderBy();
				$exam_data->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $exam_data;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$exam_data->setSessionOrderBy($sOrderBy);
				$exam_data->ExamDataNo->setSort("");
				$exam_data->AccessionNumber->setSort("");
				$exam_data->PatientMainNo->setSort("");
				$exam_data->PatientID->setSort("");
				$exam_data->InstitutionNo->setSort("");
				$exam_data->ImageDetailNo->setSort("");
				$exam_data->PatientKindNo->setSort("");
				$exam_data->PatientSubKindNo->setSort("");
				$exam_data->PatientTypeNo->setSort("");
				$exam_data->PatientRoom->setSort("");
				$exam_data->DepartmentNo->setSort("");
				$exam_data->DepartmentName->setSort("");
				$exam_data->RequestDoctorID->setSort("");
				$exam_data->CodeValue->setSort("");
				$exam_data->SpecialExamID->setSort("");
				$exam_data->SpecialExamName->setSort("");
				$exam_data->SpecialExamDate->setSort("");
				$exam_data->ExamDate->setSort("");
				$exam_data->ExamTime->setSort("");
				$exam_data->LogDate->setSort("");
				$exam_data->ModifyUser->setSort("");
				$exam_data->ModifyDate->setSort("");
				$exam_data->CreatePart->setSort("");
				$exam_data->ModifyPart->setSort("");
				$exam_data->Status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$exam_data->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $exam_data;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$exam_data->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$exam_data->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $exam_data->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$exam_data->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$exam_data->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$exam_data->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $exam_data;

		// Call Recordset Selecting event
		$exam_data->Recordset_Selecting($exam_data->CurrentFilter);

		// Load list page SQL
		$sSql = $exam_data->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$exam_data->Recordset_Selected($rs);
		return $rs;
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
