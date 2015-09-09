<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "customview1_info.php" ?>
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
$CustomView1_list = new cCustomView1_list();
$Page =& $CustomView1_list;

// Page init processing
$CustomView1_list->Page_Init();

// Page main processing
$CustomView1_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($CustomView1->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var CustomView1_list = new ew_Page("CustomView1_list");

// page properties
CustomView1_list.PageID = "list"; // page ID
var EW_PAGE_ID = CustomView1_list.PageID; // for backward compatibility

// extend page with validate function for search
CustomView1_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_StudyDate"];
	if (elm && !ew_CheckDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Study Date");

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	for (var i=0;i<fobj.elements.length;i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
CustomView1_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
CustomView1_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
CustomView1_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<?php } ?>
<?php
	$bSelectLimit = ($CustomView1->Export == "" && $CustomView1->SelectLimit);
	if (!$bSelectLimit)
		$rs = $CustomView1_list->LoadRecordset();
	$CustomView1_list->lTotalRecs = ($bSelectLimit) ? $CustomView1->SelectRecordCount() : $rs->RecordCount();
	$CustomView1_list->lStartRec = 1;
	if ($CustomView1_list->lDisplayRecs <= 0) // Display all records
		$CustomView1_list->lDisplayRecs = $CustomView1_list->lTotalRecs;
	if (!($CustomView1->ExportAll && $CustomView1->Export <> ""))
		$CustomView1_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $CustomView1_list->LoadRecordset($CustomView1_list->lStartRec-1, $CustomView1_list->lDisplayRecs);
?>
<?php if ($CustomView1->Export == "" && $CustomView1->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(CustomView1_list);" style="text-decoration: none;"><img id="CustomView1_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="CustomView1_list_SearchPanel">
<form name="fCustomView1listsrch" id="fCustomView1listsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return CustomView1_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="CustomView1">
<?php
if ($gsSearchError == "")
	$CustomView1_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$CustomView1->RowType = EW_ROWTYPE_SEARCH;

// Render row
$CustomView1_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Study Date</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_StudyDate" id="z_StudyDate" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_StudyDate" id="x_StudyDate" value="<?php echo $CustomView1->StudyDate->EditValue ?>"<?php echo $CustomView1->StudyDate->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_StudyDate" name="cal_x_StudyDate" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_StudyDate", // ID of the input field
	ifFormat : "%Y/%m/%d", // the date format
	button : "cal_x_StudyDate" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
        <td><input type="Submit" name="Submit" id="Submit" value="Search (*)"></td>
        <td><input type="button" name="showall" value="Show all" onclick="window.location='customView1_list.php?cmd=reset';"></td>        <td><input type="button" name="showpatient" value="Á`ªí" onclick="window.location='customView1_list1.php';"></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $CustomView1_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fCustomView1list" id="fCustomView1list" class="ewForm" action="" method="post">
<?php if ($CustomView1_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$CustomView1_list->lOptionCnt = 0;
	$CustomView1_list->lOptionCnt++; // view
	$CustomView1_list->lOptionCnt += count($CustomView1_list->ListOptions->Items); // Custom list options
?>
<?php echo $CustomView1->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($CustomView1->DetailNo->Visible) { // DetailNo ?>
	<?php if ($CustomView1->SortUrl($CustomView1->DetailNo) == "") { ?>
		<td>Detail No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->DetailNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Detail No</td><td style="width: 10px;"><?php if ($CustomView1->DetailNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->DetailNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->PatientID->Visible) { // PatientID ?>
	<?php if ($CustomView1->SortUrl($CustomView1->PatientID) == "") { ?>
		<td>Patient ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->PatientID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient ID&nbsp;(*)</td><td style="width: 10px;"><?php if ($CustomView1->PatientID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->PatientID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->StudyDate->Visible) { // StudyDate ?>
	<?php if ($CustomView1->SortUrl($CustomView1->StudyDate) == "") { ?>
		<td>Study Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->StudyDate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Study Date</td><td style="width: 10px;"><?php if ($CustomView1->StudyDate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->StudyDate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->StudyTime->Visible) { // StudyTime ?>
	<?php if ($CustomView1->SortUrl($CustomView1->StudyTime) == "") { ?>
		<td>Study Time</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->StudyTime) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Study Time</td><td style="width: 10px;"><?php if ($CustomView1->StudyTime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->StudyTime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->PatientName->Visible) { // PatientName ?>
	<?php if ($CustomView1->SortUrl($CustomView1->PatientName) == "") { ?>
		<td>Patient Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->PatientName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Name&nbsp;(*)</td><td style="width: 10px;"><?php if ($CustomView1->PatientName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->PatientName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->PatientSex->Visible) { // PatientSex ?>
	<?php if ($CustomView1->SortUrl($CustomView1->PatientSex) == "") { ?>
		<td>Patient Sex</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->PatientSex) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Sex&nbsp;(*)</td><td style="width: 10px;"><?php if ($CustomView1->PatientSex->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->PatientSex->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->Modality->Visible) { // Modality ?>
	<?php if ($CustomView1->SortUrl($CustomView1->Modality) == "") { ?>
		<td>Modality</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->Modality) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Modality&nbsp;(*)</td><td style="width: 10px;"><?php if ($CustomView1->Modality->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->Modality->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->ProtocolName->Visible) { // ProtocolName ?>
	<?php if ($CustomView1->SortUrl($CustomView1->ProtocolName) == "") { ?>
		<td>Protocol Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->ProtocolName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Protocol Name&nbsp;(*)</td><td style="width: 10px;"><?php if ($CustomView1->ProtocolName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->ProtocolName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->BodyPartExamined->Visible) { // BodyPartExamined ?>
	<?php if ($CustomView1->SortUrl($CustomView1->BodyPartExamined) == "") { ?>
		<td>Body Part Examined</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->BodyPartExamined) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Body Part Examined&nbsp;(*)</td><td style="width: 10px;"><?php if ($CustomView1->BodyPartExamined->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->BodyPartExamined->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->StudyID->Visible) { // StudyID ?>
	<?php if ($CustomView1->SortUrl($CustomView1->StudyID) == "") { ?>
		<td>Study ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->StudyID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Study ID&nbsp;(*)</td><td style="width: 10px;"><?php if ($CustomView1->StudyID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->StudyID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->InstanceNumber->Visible) { // InstanceNumber ?>
	<?php if ($CustomView1->SortUrl($CustomView1->InstanceNumber) == "") { ?>
		<td>Instance Number</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->InstanceNumber) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Instance Number</td><td style="width: 10px;"><?php if ($CustomView1->InstanceNumber->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->InstanceNumber->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->Status->Visible) { // Status ?>
	<?php if ($CustomView1->SortUrl($CustomView1->Status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->Status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status&nbsp;(*)</td><td style="width: 10px;"><?php if ($CustomView1->Status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->Status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($CustomView1->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($CustomView1_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($CustomView1->ExportAll && $CustomView1->Export <> "") {
	$CustomView1_list->lStopRec = $CustomView1_list->lTotalRecs;
} else {
	$CustomView1_list->lStopRec = $CustomView1_list->lStartRec + $CustomView1_list->lDisplayRecs - 1; // Set the last record to display
}
$CustomView1_list->lRecCount = $CustomView1_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$CustomView1->SelectLimit && $CustomView1_list->lStartRec > 1)
		$rs->Move($CustomView1_list->lStartRec - 1);
}
$CustomView1_list->lRowCnt = 0;
while (($CustomView1->CurrentAction == "gridadd" || !$rs->EOF) &&
	$CustomView1_list->lRecCount < $CustomView1_list->lStopRec) {
	$CustomView1_list->lRecCount++;
	if (intval($CustomView1_list->lRecCount) >= intval($CustomView1_list->lStartRec)) {
		$CustomView1_list->lRowCnt++;

	// Init row class and style
	$CustomView1->CssClass = "";
	$CustomView1->CssStyle = "";
	$CustomView1->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($CustomView1->CurrentAction == "gridadd") {
		$CustomView1_list->LoadDefaultValues(); // Load default values
	} else {
		$CustomView1_list->LoadRowValues($rs); // Load row values
	}
	$CustomView1->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$CustomView1_list->RenderRow();
?>
	<tr<?php echo $CustomView1->RowAttributes() ?>>
	<?php if ($CustomView1->DetailNo->Visible) { // DetailNo ?>
		<td<?php echo $CustomView1->DetailNo->CellAttributes() ?>>
<div<?php echo $CustomView1->DetailNo->ViewAttributes() ?>><?php echo $CustomView1->DetailNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->PatientID->Visible) { // PatientID ?>
		<td<?php echo $CustomView1->PatientID->CellAttributes() ?>>
<div<?php echo $CustomView1->PatientID->ViewAttributes() ?>><?php echo $CustomView1->PatientID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->StudyDate->Visible) { // StudyDate ?>
		<td<?php echo $CustomView1->StudyDate->CellAttributes() ?>>
<div<?php echo $CustomView1->StudyDate->ViewAttributes() ?>><?php echo $CustomView1->StudyDate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->StudyTime->Visible) { // StudyTime ?>
		<td<?php echo $CustomView1->StudyTime->CellAttributes() ?>>
<div<?php echo $CustomView1->StudyTime->ViewAttributes() ?>><?php echo $CustomView1->StudyTime->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->PatientName->Visible) { // PatientName ?>
		<td<?php echo $CustomView1->PatientName->CellAttributes() ?>>
<div<?php echo $CustomView1->PatientName->ViewAttributes() ?>><?php echo $CustomView1->PatientName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->PatientSex->Visible) { // PatientSex ?>
		<td<?php echo $CustomView1->PatientSex->CellAttributes() ?>>
<div<?php echo $CustomView1->PatientSex->ViewAttributes() ?>><?php echo $CustomView1->PatientSex->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->Modality->Visible) { // Modality ?>
		<td<?php echo $CustomView1->Modality->CellAttributes() ?>>
<div<?php echo $CustomView1->Modality->ViewAttributes() ?>><?php echo $CustomView1->Modality->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->ProtocolName->Visible) { // ProtocolName ?>
		<td<?php echo $CustomView1->ProtocolName->CellAttributes() ?>>
<div<?php echo $CustomView1->ProtocolName->ViewAttributes() ?>><?php echo $CustomView1->ProtocolName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->BodyPartExamined->Visible) { // BodyPartExamined ?>
		<td<?php echo $CustomView1->BodyPartExamined->CellAttributes() ?>>
<div<?php echo $CustomView1->BodyPartExamined->ViewAttributes() ?>><?php echo $CustomView1->BodyPartExamined->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->StudyID->Visible) { // StudyID ?>
		<td<?php echo $CustomView1->StudyID->CellAttributes() ?>>
<div<?php echo $CustomView1->StudyID->ViewAttributes() ?>><?php echo $CustomView1->StudyID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->InstanceNumber->Visible) { // InstanceNumber ?>
		<td<?php echo $CustomView1->InstanceNumber->CellAttributes() ?>>
<div<?php echo $CustomView1->InstanceNumber->ViewAttributes() ?>><?php echo $CustomView1->InstanceNumber->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($CustomView1->Status->Visible) { // Status ?>
		<td<?php echo $CustomView1->Status->CellAttributes() ?>>
<div<?php echo $CustomView1->Status->ViewAttributes() ?>><?php echo $CustomView1->Status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($CustomView1->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="customview1_view.php?sdate=<?php echo $CustomView1->StudyDate->ListViewValue() ?>&sid=<?php echo $CustomView1->StudyID->ListViewValue() ?>">View</a>
</span></td>
<?php

// Custom list options
foreach ($CustomView1_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($CustomView1->CurrentAction <> "gridadd")
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
<?php if ($CustomView1->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($CustomView1->CurrentAction <> "gridadd" && $CustomView1->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($CustomView1_list->Pager)) $CustomView1_list->Pager = new cPrevNextPager($CustomView1_list->lStartRec, $CustomView1_list->lDisplayRecs, $CustomView1_list->lTotalRecs) ?>
<?php if ($CustomView1_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($CustomView1_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $CustomView1_list->PageUrl() ?>start=<?php echo $CustomView1_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($CustomView1_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $CustomView1_list->PageUrl() ?>start=<?php echo $CustomView1_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $CustomView1_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($CustomView1_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $CustomView1_list->PageUrl() ?>start=<?php echo $CustomView1_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($CustomView1_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $CustomView1_list->PageUrl() ?>start=<?php echo $CustomView1_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $CustomView1_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $CustomView1_list->Pager->FromIndex ?> to <?php echo $CustomView1_list->Pager->ToIndex ?> of <?php echo $CustomView1_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($CustomView1_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($CustomView1_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
	</body>
</html>
<?php

//
// Page Class
//
class cCustomView1_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'CustomView1';

	// Page Object Name
	var $PageObjName = 'CustomView1_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $CustomView1;
		if ($CustomView1->UseTokenInUrl) $PageUrl .= "t=" . $CustomView1->TableVar . "&"; // add page token
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
		global $objForm, $CustomView1;
		if ($CustomView1->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($CustomView1->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($CustomView1->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cCustomView1_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["CustomView1"] = new cCustomView1();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'CustomView1', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $CustomView1;
	$CustomView1->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $CustomView1->Export; // Get export parameter, used in header
	$gsExportFile = $CustomView1->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $CustomView1;
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

			// Get search criteria for advanced search
			$this->LoadSearchValues(); // Get search values
			if ($this->ValidateSearch()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			} else {
				$this->setMessage($gsSearchError);
			}

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($CustomView1->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $CustomView1->getRecordsPerPage(); // Restore from Session
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
		$CustomView1->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$CustomView1->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$CustomView1->setStartRecordNumber($this->lStartRec);
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
		$CustomView1->setSessionWhere($sFilter);
		$CustomView1->CurrentFilter = "";
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $CustomView1;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $CustomView1->DetailNo, FALSE); // Field DetailNo
		$this->BuildSearchSql($sWhere, $CustomView1->PatientID, FALSE); // Field PatientID
		$this->BuildSearchSql($sWhere, $CustomView1->StudyDate, FALSE); // Field StudyDate
		$this->BuildSearchSql($sWhere, $CustomView1->StudyTime, FALSE); // Field StudyTime
		$this->BuildSearchSql($sWhere, $CustomView1->PatientName, FALSE); // Field PatientName
		$this->BuildSearchSql($sWhere, $CustomView1->PatientSex, FALSE); // Field PatientSex
		$this->BuildSearchSql($sWhere, $CustomView1->Modality, FALSE); // Field Modality
		$this->BuildSearchSql($sWhere, $CustomView1->ProtocolName, FALSE); // Field ProtocolName
		$this->BuildSearchSql($sWhere, $CustomView1->BodyPartExamined, FALSE); // Field BodyPartExamined
		$this->BuildSearchSql($sWhere, $CustomView1->StudyID, FALSE); // Field StudyID
		$this->BuildSearchSql($sWhere, $CustomView1->InstanceNumber, FALSE); // Field InstanceNumber
		$this->BuildSearchSql($sWhere, $CustomView1->Status, FALSE); // Field Status

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($CustomView1->DetailNo); // Field DetailNo
			$this->SetSearchParm($CustomView1->PatientID); // Field PatientID
			$this->SetSearchParm($CustomView1->StudyDate); // Field StudyDate
			$this->SetSearchParm($CustomView1->StudyTime); // Field StudyTime
			$this->SetSearchParm($CustomView1->PatientName); // Field PatientName
			$this->SetSearchParm($CustomView1->PatientSex); // Field PatientSex
			$this->SetSearchParm($CustomView1->Modality); // Field Modality
			$this->SetSearchParm($CustomView1->ProtocolName); // Field ProtocolName
			$this->SetSearchParm($CustomView1->BodyPartExamined); // Field BodyPartExamined
			$this->SetSearchParm($CustomView1->StudyID); // Field StudyID
			$this->SetSearchParm($CustomView1->InstanceNumber); // Field InstanceNumber
			$this->SetSearchParm($CustomView1->Status); // Field Status
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $CustomView1;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$CustomView1->setAdvancedSearch("x_$FldParm", $FldVal);
		$CustomView1->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$CustomView1->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$CustomView1->setAdvancedSearch("y_$FldParm", $FldVal2);
		$CustomView1->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $CustomView1;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $CustomView1->PatientID->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $CustomView1->PatientName->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $CustomView1->PatientSex->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $CustomView1->Modality->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $CustomView1->ProtocolName->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $CustomView1->BodyPartExamined->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $CustomView1->StudyID->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $CustomView1->Status->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $CustomView1;
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
			$CustomView1->setBasicSearchKeyword($sSearchKeyword);
			$CustomView1->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $CustomView1;
		$this->sSrchWhere = "";
		$CustomView1->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $CustomView1;
		$CustomView1->setBasicSearchKeyword("");
		$CustomView1->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $CustomView1;
		$CustomView1->setAdvancedSearch("x_DetailNo", "");
		$CustomView1->setAdvancedSearch("x_PatientID", "");
		$CustomView1->setAdvancedSearch("x_StudyDate", "");
		$CustomView1->setAdvancedSearch("x_StudyTime", "");
		$CustomView1->setAdvancedSearch("x_PatientName", "");
		$CustomView1->setAdvancedSearch("x_PatientSex", "");
		$CustomView1->setAdvancedSearch("x_Modality", "");
		$CustomView1->setAdvancedSearch("x_ProtocolName", "");
		$CustomView1->setAdvancedSearch("x_BodyPartExamined", "");
		$CustomView1->setAdvancedSearch("x_StudyID", "");
		$CustomView1->setAdvancedSearch("x_InstanceNumber", "");
		$CustomView1->setAdvancedSearch("x_Status", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $CustomView1;
		$this->sSrchWhere = $CustomView1->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $CustomView1;
		 $CustomView1->DetailNo->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_DetailNo");
		 $CustomView1->PatientID->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_PatientID");
		 $CustomView1->StudyDate->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_StudyDate");
		 $CustomView1->StudyTime->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_StudyTime");
		 $CustomView1->PatientName->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_PatientName");
		 $CustomView1->PatientSex->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_PatientSex");
		 $CustomView1->Modality->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_Modality");
		 $CustomView1->ProtocolName->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_ProtocolName");
		 $CustomView1->BodyPartExamined->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_BodyPartExamined");
		 $CustomView1->StudyID->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_StudyID");
		 $CustomView1->InstanceNumber->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_InstanceNumber");
		 $CustomView1->Status->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_Status");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $CustomView1;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$CustomView1->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$CustomView1->CurrentOrderType = @$_GET["ordertype"];
			$CustomView1->UpdateSort($CustomView1->DetailNo); // Field 
			$CustomView1->UpdateSort($CustomView1->PatientID); // Field 
			$CustomView1->UpdateSort($CustomView1->StudyDate); // Field 
			$CustomView1->UpdateSort($CustomView1->StudyTime); // Field 
			$CustomView1->UpdateSort($CustomView1->PatientName); // Field 
			$CustomView1->UpdateSort($CustomView1->PatientSex); // Field 
			$CustomView1->UpdateSort($CustomView1->Modality); // Field 
			$CustomView1->UpdateSort($CustomView1->ProtocolName); // Field 
			$CustomView1->UpdateSort($CustomView1->BodyPartExamined); // Field 
			$CustomView1->UpdateSort($CustomView1->StudyID); // Field 
			$CustomView1->UpdateSort($CustomView1->InstanceNumber); // Field 
			$CustomView1->UpdateSort($CustomView1->Status); // Field 
			$CustomView1->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $CustomView1;
		$sOrderBy = $CustomView1->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($CustomView1->SqlOrderBy() <> "") {
				$sOrderBy = $CustomView1->SqlOrderBy();
				$CustomView1->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $CustomView1;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$CustomView1->setSessionOrderBy($sOrderBy);
				$CustomView1->DetailNo->setSort("");
				$CustomView1->PatientID->setSort("");
				$CustomView1->StudyDate->setSort("");
				$CustomView1->StudyTime->setSort("");
				$CustomView1->PatientName->setSort("");
				$CustomView1->PatientSex->setSort("");
				$CustomView1->Modality->setSort("");
				$CustomView1->ProtocolName->setSort("");
				$CustomView1->BodyPartExamined->setSort("");
				$CustomView1->StudyID->setSort("");
				$CustomView1->InstanceNumber->setSort("");
				$CustomView1->Status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$CustomView1->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $CustomView1;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$CustomView1->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$CustomView1->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $CustomView1->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$CustomView1->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$CustomView1->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$CustomView1->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $CustomView1;

		// Load search values
		// DetailNo

		$CustomView1->DetailNo->AdvancedSearch->SearchValue = @$_GET["x_DetailNo"];
		$CustomView1->DetailNo->AdvancedSearch->SearchOperator = @$_GET["z_DetailNo"];

		// PatientID
		$CustomView1->PatientID->AdvancedSearch->SearchValue = @$_GET["x_PatientID"];
		$CustomView1->PatientID->AdvancedSearch->SearchOperator = @$_GET["z_PatientID"];

		// StudyDate
		$CustomView1->StudyDate->AdvancedSearch->SearchValue = @$_GET["x_StudyDate"];
		$CustomView1->StudyDate->AdvancedSearch->SearchOperator = @$_GET["z_StudyDate"];

		// StudyTime
		$CustomView1->StudyTime->AdvancedSearch->SearchValue = @$_GET["x_StudyTime"];
		$CustomView1->StudyTime->AdvancedSearch->SearchOperator = @$_GET["z_StudyTime"];

		// PatientName
		$CustomView1->PatientName->AdvancedSearch->SearchValue = @$_GET["x_PatientName"];
		$CustomView1->PatientName->AdvancedSearch->SearchOperator = @$_GET["z_PatientName"];

		// PatientSex
		$CustomView1->PatientSex->AdvancedSearch->SearchValue = @$_GET["x_PatientSex"];
		$CustomView1->PatientSex->AdvancedSearch->SearchOperator = @$_GET["z_PatientSex"];

		// Modality
		$CustomView1->Modality->AdvancedSearch->SearchValue = @$_GET["x_Modality"];
		$CustomView1->Modality->AdvancedSearch->SearchOperator = @$_GET["z_Modality"];

		// ProtocolName
		$CustomView1->ProtocolName->AdvancedSearch->SearchValue = @$_GET["x_ProtocolName"];
		$CustomView1->ProtocolName->AdvancedSearch->SearchOperator = @$_GET["z_ProtocolName"];

		// BodyPartExamined
		$CustomView1->BodyPartExamined->AdvancedSearch->SearchValue = @$_GET["x_BodyPartExamined"];
		$CustomView1->BodyPartExamined->AdvancedSearch->SearchOperator = @$_GET["z_BodyPartExamined"];

		// StudyID
		$CustomView1->StudyID->AdvancedSearch->SearchValue = @$_GET["x_StudyID"];
		$CustomView1->StudyID->AdvancedSearch->SearchOperator = @$_GET["z_StudyID"];

		// InstanceNumber
		$CustomView1->InstanceNumber->AdvancedSearch->SearchValue = @$_GET["x_InstanceNumber"];
		$CustomView1->InstanceNumber->AdvancedSearch->SearchOperator = @$_GET["z_InstanceNumber"];

		// Status
		$CustomView1->Status->AdvancedSearch->SearchValue = @$_GET["x_Status"];
		$CustomView1->Status->AdvancedSearch->SearchOperator = @$_GET["z_Status"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $CustomView1;

		// Call Recordset Selecting event
		$CustomView1->Recordset_Selecting($CustomView1->CurrentFilter);

		// Load list page SQL
		$sSql = $CustomView1->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';
		//echo $sSql;
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$CustomView1->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $CustomView1;
		$sFilter = $CustomView1->KeyFilter();

		// Call Row Selecting event
		$CustomView1->Row_Selecting($sFilter);

		// Load sql based on filter
		$CustomView1->CurrentFilter = $sFilter;
		$sSql = $CustomView1->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$CustomView1->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $CustomView1;
		$CustomView1->DetailNo->setDbValue($rs->fields('DetailNo'));
		$CustomView1->PatientID->setDbValue($rs->fields('PatientID'));
		$CustomView1->StudyDate->setDbValue($rs->fields('StudyDate'));
		$CustomView1->StudyTime->setDbValue($rs->fields('StudyTime'));
		$CustomView1->PatientName->setDbValue($rs->fields('PatientName'));
		$CustomView1->PatientSex->setDbValue($rs->fields('PatientSex'));
		$CustomView1->Modality->setDbValue($rs->fields('Modality'));
		$CustomView1->ProtocolName->setDbValue($rs->fields('ProtocolName'));
		$CustomView1->BodyPartExamined->setDbValue($rs->fields('BodyPartExamined'));
		$CustomView1->StudyID->setDbValue($rs->fields('StudyID'));
		$CustomView1->InstanceNumber->setDbValue($rs->fields('InstanceNumber'));
		$CustomView1->Status->setDbValue($rs->fields('Status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $CustomView1;

		// Call Row_Rendering event
		$CustomView1->Row_Rendering();

		// Common render codes for all row types
		// DetailNo

		$CustomView1->DetailNo->CellCssStyle = "";
		$CustomView1->DetailNo->CellCssClass = "";

		// PatientID
		$CustomView1->PatientID->CellCssStyle = "";
		$CustomView1->PatientID->CellCssClass = "";

		// StudyDate
		$CustomView1->StudyDate->CellCssStyle = "";
		$CustomView1->StudyDate->CellCssClass = "";

		// StudyTime
		$CustomView1->StudyTime->CellCssStyle = "";
		$CustomView1->StudyTime->CellCssClass = "";

		// PatientName
		$CustomView1->PatientName->CellCssStyle = "";
		$CustomView1->PatientName->CellCssClass = "";

		// PatientSex
		$CustomView1->PatientSex->CellCssStyle = "";
		$CustomView1->PatientSex->CellCssClass = "";

		// Modality
		$CustomView1->Modality->CellCssStyle = "";
		$CustomView1->Modality->CellCssClass = "";

		// ProtocolName
		$CustomView1->ProtocolName->CellCssStyle = "";
		$CustomView1->ProtocolName->CellCssClass = "";

		// BodyPartExamined
		$CustomView1->BodyPartExamined->CellCssStyle = "";
		$CustomView1->BodyPartExamined->CellCssClass = "";

		// StudyID
		$CustomView1->StudyID->CellCssStyle = "";
		$CustomView1->StudyID->CellCssClass = "";

		// InstanceNumber
		$CustomView1->InstanceNumber->CellCssStyle = "";
		$CustomView1->InstanceNumber->CellCssClass = "";

		// Status
		$CustomView1->Status->CellCssStyle = "";
		$CustomView1->Status->CellCssClass = "";
		if ($CustomView1->RowType == EW_ROWTYPE_VIEW) { // View row

			// DetailNo
			$CustomView1->DetailNo->ViewValue = $CustomView1->DetailNo->CurrentValue;
			$CustomView1->DetailNo->CssStyle = "";
			$CustomView1->DetailNo->CssClass = "";
			$CustomView1->DetailNo->ViewCustomAttributes = "";

			// PatientID
			$CustomView1->PatientID->ViewValue = $CustomView1->PatientID->CurrentValue;
			$CustomView1->PatientID->CssStyle = "";
			$CustomView1->PatientID->CssClass = "";
			$CustomView1->PatientID->ViewCustomAttributes = "";

			// StudyDate
			$CustomView1->StudyDate->ViewValue = $CustomView1->StudyDate->CurrentValue;
			$CustomView1->StudyDate->ViewValue = ew_FormatDateTime($CustomView1->StudyDate->ViewValue, 5);
			$CustomView1->StudyDate->CssStyle = "";
			$CustomView1->StudyDate->CssClass = "";
			$CustomView1->StudyDate->ViewCustomAttributes = "";

			// StudyTime
			$CustomView1->StudyTime->ViewValue = $CustomView1->StudyTime->CurrentValue;
			$CustomView1->StudyTime->ViewValue = ew_FormatDateTime($CustomView1->StudyTime->ViewValue, 4);
			$CustomView1->StudyTime->CssStyle = "";
			$CustomView1->StudyTime->CssClass = "";
			$CustomView1->StudyTime->ViewCustomAttributes = "";

			// PatientName
			$CustomView1->PatientName->ViewValue = $CustomView1->PatientName->CurrentValue;
			$CustomView1->PatientName->CssStyle = "";
			$CustomView1->PatientName->CssClass = "";
			$CustomView1->PatientName->ViewCustomAttributes = "";

			// PatientSex
			$CustomView1->PatientSex->ViewValue = $CustomView1->PatientSex->CurrentValue;
			$CustomView1->PatientSex->CssStyle = "";
			$CustomView1->PatientSex->CssClass = "";
			$CustomView1->PatientSex->ViewCustomAttributes = "";

			// Modality
			$CustomView1->Modality->ViewValue = $CustomView1->Modality->CurrentValue;
			$CustomView1->Modality->CssStyle = "";
			$CustomView1->Modality->CssClass = "";
			$CustomView1->Modality->ViewCustomAttributes = "";

			// ProtocolName
			$CustomView1->ProtocolName->ViewValue = $CustomView1->ProtocolName->CurrentValue;
			$CustomView1->ProtocolName->CssStyle = "";
			$CustomView1->ProtocolName->CssClass = "";
			$CustomView1->ProtocolName->ViewCustomAttributes = "";

			// BodyPartExamined
			$CustomView1->BodyPartExamined->ViewValue = $CustomView1->BodyPartExamined->CurrentValue;
			$CustomView1->BodyPartExamined->CssStyle = "";
			$CustomView1->BodyPartExamined->CssClass = "";
			$CustomView1->BodyPartExamined->ViewCustomAttributes = "";

			// StudyID
			$CustomView1->StudyID->ViewValue = $CustomView1->StudyID->CurrentValue;
			$CustomView1->StudyID->CssStyle = "";
			$CustomView1->StudyID->CssClass = "";
			$CustomView1->StudyID->ViewCustomAttributes = "";

			// InstanceNumber
			$CustomView1->InstanceNumber->ViewValue = $CustomView1->InstanceNumber->CurrentValue;
			$CustomView1->InstanceNumber->CssStyle = "";
			$CustomView1->InstanceNumber->CssClass = "";
			$CustomView1->InstanceNumber->ViewCustomAttributes = "";

			// Status
			$CustomView1->Status->ViewValue = $CustomView1->Status->CurrentValue;
			$CustomView1->Status->CssStyle = "";
			$CustomView1->Status->CssClass = "";
			$CustomView1->Status->ViewCustomAttributes = "";

			// DetailNo
			$CustomView1->DetailNo->HrefValue = "";

			// PatientID
			$CustomView1->PatientID->HrefValue = "";

			// StudyDate
			$CustomView1->StudyDate->HrefValue = "";

			// StudyTime
			$CustomView1->StudyTime->HrefValue = "";

			// PatientName
			$CustomView1->PatientName->HrefValue = "";

			// PatientSex
			$CustomView1->PatientSex->HrefValue = "";

			// Modality
			$CustomView1->Modality->HrefValue = "";

			// ProtocolName
			$CustomView1->ProtocolName->HrefValue = "";

			// BodyPartExamined
			$CustomView1->BodyPartExamined->HrefValue = "";

			// StudyID
			$CustomView1->StudyID->HrefValue = "";

			// InstanceNumber
			$CustomView1->InstanceNumber->HrefValue = "";

			// Status
			$CustomView1->Status->HrefValue = "";
		} elseif ($CustomView1->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// DetailNo
			$CustomView1->DetailNo->EditCustomAttributes = "";
			$CustomView1->DetailNo->EditValue = ew_HtmlEncode($CustomView1->DetailNo->AdvancedSearch->SearchValue);

			// PatientID
			$CustomView1->PatientID->EditCustomAttributes = "";
			$CustomView1->PatientID->EditValue = ew_HtmlEncode($CustomView1->PatientID->AdvancedSearch->SearchValue);

			// StudyDate
			$CustomView1->StudyDate->EditCustomAttributes = "";
			$CustomView1->StudyDate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($CustomView1->StudyDate->AdvancedSearch->SearchValue, 5), 5));

			// StudyTime
			$CustomView1->StudyTime->EditCustomAttributes = "";
			$CustomView1->StudyTime->EditValue = ew_HtmlEncode(ew_FormatDateTime($CustomView1->StudyTime->AdvancedSearch->SearchValue, 4));

			// PatientName
			$CustomView1->PatientName->EditCustomAttributes = "";
			$CustomView1->PatientName->EditValue = ew_HtmlEncode($CustomView1->PatientName->AdvancedSearch->SearchValue);

			// PatientSex
			$CustomView1->PatientSex->EditCustomAttributes = "";
			$CustomView1->PatientSex->EditValue = ew_HtmlEncode($CustomView1->PatientSex->AdvancedSearch->SearchValue);

			// Modality
			$CustomView1->Modality->EditCustomAttributes = "";
			$CustomView1->Modality->EditValue = ew_HtmlEncode($CustomView1->Modality->AdvancedSearch->SearchValue);

			// ProtocolName
			$CustomView1->ProtocolName->EditCustomAttributes = "";
			$CustomView1->ProtocolName->EditValue = ew_HtmlEncode($CustomView1->ProtocolName->AdvancedSearch->SearchValue);

			// BodyPartExamined
			$CustomView1->BodyPartExamined->EditCustomAttributes = "";
			$CustomView1->BodyPartExamined->EditValue = ew_HtmlEncode($CustomView1->BodyPartExamined->AdvancedSearch->SearchValue);

			// StudyID
			$CustomView1->StudyID->EditCustomAttributes = "";
			$CustomView1->StudyID->EditValue = ew_HtmlEncode($CustomView1->StudyID->AdvancedSearch->SearchValue);

			// InstanceNumber
			$CustomView1->InstanceNumber->EditCustomAttributes = "";
			$CustomView1->InstanceNumber->EditValue = ew_HtmlEncode($CustomView1->InstanceNumber->AdvancedSearch->SearchValue);

			// Status
			$CustomView1->Status->EditCustomAttributes = "";
			$CustomView1->Status->EditValue = ew_HtmlEncode($CustomView1->Status->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$CustomView1->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $CustomView1;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckDate($CustomView1->StudyDate->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = yyyy/mm/dd - Study Date";
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $CustomView1;
		$CustomView1->DetailNo->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_DetailNo");
		$CustomView1->PatientID->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_PatientID");
		$CustomView1->StudyDate->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_StudyDate");
		$CustomView1->StudyTime->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_StudyTime");
		$CustomView1->PatientName->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_PatientName");
		$CustomView1->PatientSex->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_PatientSex");
		$CustomView1->Modality->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_Modality");
		$CustomView1->ProtocolName->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_ProtocolName");
		$CustomView1->BodyPartExamined->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_BodyPartExamined");
		$CustomView1->StudyID->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_StudyID");
		$CustomView1->InstanceNumber->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_InstanceNumber");
		$CustomView1->Status->AdvancedSearch->SearchValue = $CustomView1->getAdvancedSearch("x_Status");
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
