<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "patient_detail_info.php" ?>
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
$patient_detail_list = new cpatient_detail_list();
$Page =& $patient_detail_list;

// Page init processing
$patient_detail_list->Page_Init();

// Page main processing
$patient_detail_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($patient_detail->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var patient_detail_list = new ew_Page("patient_detail_list");

// page properties
patient_detail_list.PageID = "list"; // page ID
var EW_PAGE_ID = patient_detail_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
patient_detail_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
patient_detail_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
patient_detail_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($patient_detail->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($patient_detail->Export == "" && $patient_detail->SelectLimit);
	if (!$bSelectLimit)
		$rs = $patient_detail_list->LoadRecordset();
	$patient_detail_list->lTotalRecs = ($bSelectLimit) ? $patient_detail->SelectRecordCount() : $rs->RecordCount();
	$patient_detail_list->lStartRec = 1;
	if ($patient_detail_list->lDisplayRecs <= 0) // Display all records
		$patient_detail_list->lDisplayRecs = $patient_detail_list->lTotalRecs;
	if (!($patient_detail->ExportAll && $patient_detail->Export <> ""))
		$patient_detail_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $patient_detail_list->LoadRecordset($patient_detail_list->lStartRec-1, $patient_detail_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: Patient Detail
</span></p>
<?php $patient_detail_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fpatient_detaillist" id="fpatient_detaillist" class="ewForm" action="" method="post">
<?php if ($patient_detail_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$patient_detail_list->lOptionCnt = 0;
	$patient_detail_list->lOptionCnt++; // view
	$patient_detail_list->lOptionCnt += count($patient_detail_list->ListOptions->Items); // Custom list options
?>
<?php echo $patient_detail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($patient_detail->DetailNo->Visible) { // DetailNo ?>
	<?php if ($patient_detail->SortUrl($patient_detail->DetailNo) == "") { ?>
		<td>Detail No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_detail->SortUrl($patient_detail->DetailNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Detail No</td><td style="width: 10px;"><?php if ($patient_detail->DetailNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_detail->DetailNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_detail->StudyID->Visible) { // StudyID ?>
	<?php if ($patient_detail->SortUrl($patient_detail->StudyID) == "") { ?>
		<td>Study ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_detail->SortUrl($patient_detail->StudyID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Study ID</td><td style="width: 10px;"><?php if ($patient_detail->StudyID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_detail->StudyID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_detail->PatientID->Visible) { // PatientID ?>
	<?php if ($patient_detail->SortUrl($patient_detail->PatientID) == "") { ?>
		<td>病歷號碼</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_detail->SortUrl($patient_detail->PatientID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>病歷號碼</td><td style="width: 10px;"><?php if ($patient_detail->PatientID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_detail->PatientID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_detail->StudyDate->Visible) { // StudyDate ?>
	<?php if ($patient_detail->SortUrl($patient_detail->StudyDate) == "") { ?>
		<td>檢查日期</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_detail->SortUrl($patient_detail->StudyDate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>檢查日期</td><td style="width: 10px;"><?php if ($patient_detail->StudyDate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_detail->StudyDate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_detail->StudyTime->Visible) { // StudyTime ?>
	<?php if ($patient_detail->SortUrl($patient_detail->StudyTime) == "") { ?>
		<td>檢查時間</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_detail->SortUrl($patient_detail->StudyTime) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>檢查時間</td><td style="width: 10px;"><?php if ($patient_detail->StudyTime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_detail->StudyTime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_detail->Modality->Visible) { // Modality ?>
	<?php if ($patient_detail->SortUrl($patient_detail->Modality) == "") { ?>
		<td>檢查種類</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_detail->SortUrl($patient_detail->Modality) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>檢查種類</td><td style="width: 10px;"><?php if ($patient_detail->Modality->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_detail->Modality->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_detail->BodyPartExamined->Visible) { // BodyPartExamined ?>
	<?php if ($patient_detail->SortUrl($patient_detail->BodyPartExamined) == "") { ?>
		<td>檢查部位</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_detail->SortUrl($patient_detail->BodyPartExamined) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>檢查部位</td><td style="width: 10px;"><?php if ($patient_detail->BodyPartExamined->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_detail->BodyPartExamined->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_detail->ProtocolName->Visible) { // ProtocolName ?>
	<?php if ($patient_detail->SortUrl($patient_detail->ProtocolName) == "") { ?>
		<td>部位細節</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_detail->SortUrl($patient_detail->ProtocolName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>部位細節</td><td style="width: 10px;"><?php if ($patient_detail->ProtocolName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_detail->ProtocolName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_detail->Status->Visible) { // Status ?>
	<?php if ($patient_detail->SortUrl($patient_detail->Status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_detail->SortUrl($patient_detail->Status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($patient_detail->Status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_detail->Status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_detail->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($patient_detail_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($patient_detail->ExportAll && $patient_detail->Export <> "") {
	$patient_detail_list->lStopRec = $patient_detail_list->lTotalRecs;
} else {
	$patient_detail_list->lStopRec = $patient_detail_list->lStartRec + $patient_detail_list->lDisplayRecs - 1; // Set the last record to display
}
$patient_detail_list->lRecCount = $patient_detail_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$patient_detail->SelectLimit && $patient_detail_list->lStartRec > 1)
		$rs->Move($patient_detail_list->lStartRec - 1);
}
$patient_detail_list->lRowCnt = 0;
while (($patient_detail->CurrentAction == "gridadd" || !$rs->EOF) &&
	$patient_detail_list->lRecCount < $patient_detail_list->lStopRec) {
	$patient_detail_list->lRecCount++;
	if (intval($patient_detail_list->lRecCount) >= intval($patient_detail_list->lStartRec)) {
		$patient_detail_list->lRowCnt++;

	// Init row class and style
	$patient_detail->CssClass = "";
	$patient_detail->CssStyle = "";
	$patient_detail->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($patient_detail->CurrentAction == "gridadd") {
		$patient_detail_list->LoadDefaultValues(); // Load default values
	} else {
		$patient_detail_list->LoadRowValues($rs); // Load row values
	}
	$patient_detail->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$patient_detail_list->RenderRow();
?>
	<tr<?php echo $patient_detail->RowAttributes() ?>>
	<?php if ($patient_detail->DetailNo->Visible) { // DetailNo ?>
		<td<?php echo $patient_detail->DetailNo->CellAttributes() ?>>
<div<?php echo $patient_detail->DetailNo->ViewAttributes() ?>><?php echo $patient_detail->DetailNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_detail->StudyID->Visible) { // StudyID ?>
		<td<?php echo $patient_detail->StudyID->CellAttributes() ?>>
<div<?php echo $patient_detail->StudyID->ViewAttributes() ?>><?php echo $patient_detail->StudyID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_detail->PatientID->Visible) { // PatientID ?>
		<td<?php echo $patient_detail->PatientID->CellAttributes() ?>>
<div<?php echo $patient_detail->PatientID->ViewAttributes() ?>><?php echo $patient_detail->PatientID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_detail->StudyDate->Visible) { // StudyDate ?>
		<td<?php echo $patient_detail->StudyDate->CellAttributes() ?>>
<div<?php echo $patient_detail->StudyDate->ViewAttributes() ?>><?php echo $patient_detail->StudyDate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_detail->StudyTime->Visible) { // StudyTime ?>
		<td<?php echo $patient_detail->StudyTime->CellAttributes() ?>>
<div<?php echo $patient_detail->StudyTime->ViewAttributes() ?>><?php echo $patient_detail->StudyTime->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_detail->Modality->Visible) { // Modality ?>
		<td<?php echo $patient_detail->Modality->CellAttributes() ?>>
<div<?php echo $patient_detail->Modality->ViewAttributes() ?>><?php echo $patient_detail->Modality->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_detail->BodyPartExamined->Visible) { // BodyPartExamined ?>
		<td<?php echo $patient_detail->BodyPartExamined->CellAttributes() ?>>
<div<?php echo $patient_detail->BodyPartExamined->ViewAttributes() ?>><?php echo $patient_detail->BodyPartExamined->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_detail->ProtocolName->Visible) { // ProtocolName ?>
		<td<?php echo $patient_detail->ProtocolName->CellAttributes() ?>>
<div<?php echo $patient_detail->ProtocolName->ViewAttributes() ?>><?php echo $patient_detail->ProtocolName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_detail->Status->Visible) { // Status ?>
		<td<?php echo $patient_detail->Status->CellAttributes() ?>>
<div<?php echo $patient_detail->Status->ViewAttributes() ?>><?php echo $patient_detail->Status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($patient_detail->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $patient_detail->ViewUrl() ?>">View</a>
</span></td>
<?php

// Custom list options
foreach ($patient_detail_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($patient_detail->CurrentAction <> "gridadd")
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
<?php if ($patient_detail->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($patient_detail->CurrentAction <> "gridadd" && $patient_detail->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($patient_detail_list->Pager)) $patient_detail_list->Pager = new cPrevNextPager($patient_detail_list->lStartRec, $patient_detail_list->lDisplayRecs, $patient_detail_list->lTotalRecs) ?>
<?php if ($patient_detail_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($patient_detail_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $patient_detail_list->PageUrl() ?>start=<?php echo $patient_detail_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($patient_detail_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $patient_detail_list->PageUrl() ?>start=<?php echo $patient_detail_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $patient_detail_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($patient_detail_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $patient_detail_list->PageUrl() ?>start=<?php echo $patient_detail_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($patient_detail_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $patient_detail_list->PageUrl() ?>start=<?php echo $patient_detail_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $patient_detail_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $patient_detail_list->Pager->FromIndex ?> to <?php echo $patient_detail_list->Pager->ToIndex ?> of <?php echo $patient_detail_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($patient_detail_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($patient_detail_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($patient_detail->Export == "" && $patient_detail->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(patient_detail_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($patient_detail->Export == "") { ?>
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
class cpatient_detail_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'patient_detail';

	// Page Object Name
	var $PageObjName = 'patient_detail_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $patient_detail;
		if ($patient_detail->UseTokenInUrl) $PageUrl .= "t=" . $patient_detail->TableVar . "&"; // add page token
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
		global $objForm, $patient_detail;
		if ($patient_detail->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($patient_detail->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($patient_detail->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cpatient_detail_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["patient_detail"] = new cpatient_detail();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'patient_detail', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $patient_detail;
	$patient_detail->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $patient_detail->Export; // Get export parameter, used in header
	$gsExportFile = $patient_detail->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $patient_detail;
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

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($patient_detail->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $patient_detail->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$patient_detail->setSessionWhere($sFilter);
		$patient_detail->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $patient_detail;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$patient_detail->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$patient_detail->CurrentOrderType = @$_GET["ordertype"];
			$patient_detail->UpdateSort($patient_detail->DetailNo); // Field 
			$patient_detail->UpdateSort($patient_detail->StudyID); // Field 
			$patient_detail->UpdateSort($patient_detail->PatientID); // Field 
			$patient_detail->UpdateSort($patient_detail->StudyDate); // Field 
			$patient_detail->UpdateSort($patient_detail->StudyTime); // Field 
			$patient_detail->UpdateSort($patient_detail->Modality); // Field 
			$patient_detail->UpdateSort($patient_detail->BodyPartExamined); // Field 
			$patient_detail->UpdateSort($patient_detail->ProtocolName); // Field 
			$patient_detail->UpdateSort($patient_detail->Status); // Field 
			$patient_detail->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $patient_detail;
		$sOrderBy = $patient_detail->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($patient_detail->SqlOrderBy() <> "") {
				$sOrderBy = $patient_detail->SqlOrderBy();
				$patient_detail->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $patient_detail;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$patient_detail->setSessionOrderBy($sOrderBy);
				$patient_detail->DetailNo->setSort("");
				$patient_detail->StudyID->setSort("");
				$patient_detail->PatientID->setSort("");
				$patient_detail->StudyDate->setSort("");
				$patient_detail->StudyTime->setSort("");
				$patient_detail->Modality->setSort("");
				$patient_detail->BodyPartExamined->setSort("");
				$patient_detail->ProtocolName->setSort("");
				$patient_detail->Status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$patient_detail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $patient_detail;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$patient_detail->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$patient_detail->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $patient_detail->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$patient_detail->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$patient_detail->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$patient_detail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $patient_detail;

		// Call Recordset Selecting event
		$patient_detail->Recordset_Selecting($patient_detail->CurrentFilter);

		// Load list page SQL
		$sSql = $patient_detail->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$patient_detail->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $patient_detail;
		$sFilter = $patient_detail->KeyFilter();

		// Call Row Selecting event
		$patient_detail->Row_Selecting($sFilter);

		// Load sql based on filter
		$patient_detail->CurrentFilter = $sFilter;
		$sSql = $patient_detail->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$patient_detail->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $patient_detail;
		$patient_detail->DetailNo->setDbValue($rs->fields('DetailNo'));
		$patient_detail->StudyID->setDbValue($rs->fields('StudyID'));
		$patient_detail->PatientID->setDbValue($rs->fields('PatientID'));
		$patient_detail->StudyDate->setDbValue($rs->fields('StudyDate'));
		$patient_detail->ContentDate->setDbValue($rs->fields('ContentDate'));
		$patient_detail->StudyTime->setDbValue($rs->fields('StudyTime'));
		$patient_detail->ContentTime->setDbValue($rs->fields('ContentTime'));
		$patient_detail->InstitutionName->setDbValue($rs->fields('InstitutionName'));
		$patient_detail->InstitutionAddress->setDbValue($rs->fields('InstitutionAddress'));
		$patient_detail->InstitutionDepartmentName->setDbValue($rs->fields('InstitutionDepartmentName'));
		$patient_detail->Modality->setDbValue($rs->fields('Modality'));
		$patient_detail->OperatorName->setDbValue($rs->fields('OperatorName'));
		$patient_detail->Manufacturer->setDbValue($rs->fields('Manufacturer'));
		$patient_detail->BodyPartExamined->setDbValue($rs->fields('BodyPartExamined'));
		$patient_detail->ProtocolName->setDbValue($rs->fields('ProtocolName'));
		$patient_detail->AccessionNumber->setDbValue($rs->fields('AccessionNumber'));
		$patient_detail->InstanceNumber->setDbValue($rs->fields('InstanceNumber'));
		$patient_detail->Status->setDbValue($rs->fields('Status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $patient_detail;

		// Call Row_Rendering event
		$patient_detail->Row_Rendering();

		// Common render codes for all row types
		// DetailNo

		$patient_detail->DetailNo->CellCssStyle = "";
		$patient_detail->DetailNo->CellCssClass = "";

		// StudyID
		$patient_detail->StudyID->CellCssStyle = "";
		$patient_detail->StudyID->CellCssClass = "";

		// PatientID
		$patient_detail->PatientID->CellCssStyle = "";
		$patient_detail->PatientID->CellCssClass = "";

		// StudyDate
		$patient_detail->StudyDate->CellCssStyle = "";
		$patient_detail->StudyDate->CellCssClass = "";

		// StudyTime
		$patient_detail->StudyTime->CellCssStyle = "";
		$patient_detail->StudyTime->CellCssClass = "";

		// Modality
		$patient_detail->Modality->CellCssStyle = "";
		$patient_detail->Modality->CellCssClass = "";

		// BodyPartExamined
		$patient_detail->BodyPartExamined->CellCssStyle = "";
		$patient_detail->BodyPartExamined->CellCssClass = "";

		// ProtocolName
		$patient_detail->ProtocolName->CellCssStyle = "";
		$patient_detail->ProtocolName->CellCssClass = "";

		// Status
		$patient_detail->Status->CellCssStyle = "";
		$patient_detail->Status->CellCssClass = "";
		if ($patient_detail->RowType == EW_ROWTYPE_VIEW) { // View row

			// DetailNo
			$patient_detail->DetailNo->ViewValue = $patient_detail->DetailNo->CurrentValue;
			$patient_detail->DetailNo->CssStyle = "";
			$patient_detail->DetailNo->CssClass = "";
			$patient_detail->DetailNo->ViewCustomAttributes = "";

			// StudyID
			$patient_detail->StudyID->ViewValue = $patient_detail->StudyID->CurrentValue;
			$patient_detail->StudyID->CssStyle = "";
			$patient_detail->StudyID->CssClass = "";
			$patient_detail->StudyID->ViewCustomAttributes = "";

			// PatientID
			$patient_detail->PatientID->ViewValue = $patient_detail->PatientID->CurrentValue;
			$patient_detail->PatientID->CssStyle = "";
			$patient_detail->PatientID->CssClass = "";
			$patient_detail->PatientID->ViewCustomAttributes = "";

			// StudyDate
			$patient_detail->StudyDate->ViewValue = $patient_detail->StudyDate->CurrentValue;
			$patient_detail->StudyDate->ViewValue = ew_FormatDateTime($patient_detail->StudyDate->ViewValue, 5);
			$patient_detail->StudyDate->CssStyle = "";
			$patient_detail->StudyDate->CssClass = "";
			$patient_detail->StudyDate->ViewCustomAttributes = "";

			// ContentDate
			$patient_detail->ContentDate->ViewValue = $patient_detail->ContentDate->CurrentValue;
			$patient_detail->ContentDate->ViewValue = ew_FormatDateTime($patient_detail->ContentDate->ViewValue, 5);
			$patient_detail->ContentDate->CssStyle = "";
			$patient_detail->ContentDate->CssClass = "";
			$patient_detail->ContentDate->ViewCustomAttributes = "";

			// StudyTime
			$patient_detail->StudyTime->ViewValue = $patient_detail->StudyTime->CurrentValue;
			$patient_detail->StudyTime->ViewValue = ew_FormatDateTime($patient_detail->StudyTime->ViewValue, 4);
			$patient_detail->StudyTime->CssStyle = "";
			$patient_detail->StudyTime->CssClass = "";
			$patient_detail->StudyTime->ViewCustomAttributes = "";

			// ContentTime
			$patient_detail->ContentTime->ViewValue = $patient_detail->ContentTime->CurrentValue;
			$patient_detail->ContentTime->ViewValue = ew_FormatDateTime($patient_detail->ContentTime->ViewValue, 4);
			$patient_detail->ContentTime->CssStyle = "";
			$patient_detail->ContentTime->CssClass = "";
			$patient_detail->ContentTime->ViewCustomAttributes = "";

			// InstitutionName
			$patient_detail->InstitutionName->ViewValue = $patient_detail->InstitutionName->CurrentValue;
			$patient_detail->InstitutionName->CssStyle = "";
			$patient_detail->InstitutionName->CssClass = "";
			$patient_detail->InstitutionName->ViewCustomAttributes = "";

			// InstitutionAddress
			$patient_detail->InstitutionAddress->ViewValue = $patient_detail->InstitutionAddress->CurrentValue;
			$patient_detail->InstitutionAddress->CssStyle = "";
			$patient_detail->InstitutionAddress->CssClass = "";
			$patient_detail->InstitutionAddress->ViewCustomAttributes = "";

			// InstitutionDepartmentName
			$patient_detail->InstitutionDepartmentName->ViewValue = $patient_detail->InstitutionDepartmentName->CurrentValue;
			$patient_detail->InstitutionDepartmentName->CssStyle = "";
			$patient_detail->InstitutionDepartmentName->CssClass = "";
			$patient_detail->InstitutionDepartmentName->ViewCustomAttributes = "";

			// Modality
			$patient_detail->Modality->ViewValue = $patient_detail->Modality->CurrentValue;
			$patient_detail->Modality->CssStyle = "";
			$patient_detail->Modality->CssClass = "";
			$patient_detail->Modality->ViewCustomAttributes = "";

			// OperatorName
			$patient_detail->OperatorName->ViewValue = $patient_detail->OperatorName->CurrentValue;
			$patient_detail->OperatorName->CssStyle = "";
			$patient_detail->OperatorName->CssClass = "";
			$patient_detail->OperatorName->ViewCustomAttributes = "";

			// Manufacturer
			$patient_detail->Manufacturer->ViewValue = $patient_detail->Manufacturer->CurrentValue;
			$patient_detail->Manufacturer->CssStyle = "";
			$patient_detail->Manufacturer->CssClass = "";
			$patient_detail->Manufacturer->ViewCustomAttributes = "";

			// BodyPartExamined
			$patient_detail->BodyPartExamined->ViewValue = $patient_detail->BodyPartExamined->CurrentValue;
			$patient_detail->BodyPartExamined->CssStyle = "";
			$patient_detail->BodyPartExamined->CssClass = "";
			$patient_detail->BodyPartExamined->ViewCustomAttributes = "";

			// ProtocolName
			$patient_detail->ProtocolName->ViewValue = $patient_detail->ProtocolName->CurrentValue;
			$patient_detail->ProtocolName->CssStyle = "";
			$patient_detail->ProtocolName->CssClass = "";
			$patient_detail->ProtocolName->ViewCustomAttributes = "";

			// AccessionNumber
			$patient_detail->AccessionNumber->ViewValue = $patient_detail->AccessionNumber->CurrentValue;
			$patient_detail->AccessionNumber->CssStyle = "";
			$patient_detail->AccessionNumber->CssClass = "";
			$patient_detail->AccessionNumber->ViewCustomAttributes = "";

			// InstanceNumber
			$patient_detail->InstanceNumber->ViewValue = $patient_detail->InstanceNumber->CurrentValue;
			$patient_detail->InstanceNumber->CssStyle = "";
			$patient_detail->InstanceNumber->CssClass = "";
			$patient_detail->InstanceNumber->ViewCustomAttributes = "";

			// Status
			$patient_detail->Status->ViewValue = $patient_detail->Status->CurrentValue;
			$patient_detail->Status->CssStyle = "";
			$patient_detail->Status->CssClass = "";
			$patient_detail->Status->ViewCustomAttributes = "";

			// DetailNo
			$patient_detail->DetailNo->HrefValue = "";

			// StudyID
			$patient_detail->StudyID->HrefValue = "";

			// PatientID
			$patient_detail->PatientID->HrefValue = "";

			// StudyDate
			$patient_detail->StudyDate->HrefValue = "";

			// StudyTime
			$patient_detail->StudyTime->HrefValue = "";

			// Modality
			$patient_detail->Modality->HrefValue = "";

			// BodyPartExamined
			$patient_detail->BodyPartExamined->HrefValue = "";

			// ProtocolName
			$patient_detail->ProtocolName->HrefValue = "";

			// Status
			$patient_detail->Status->HrefValue = "";
		}

		// Call Row Rendered event
		$patient_detail->Row_Rendered();
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
