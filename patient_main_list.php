<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "patient_main_info.php" ?>
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
$patient_main_list = new cpatient_main_list();
$Page =& $patient_main_list;

// Page init processing
$patient_main_list->Page_Init();

// Page main processing
$patient_main_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($patient_main->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var patient_main_list = new ew_Page("patient_main_list");

// page properties
patient_main_list.PageID = "list"; // page ID
var EW_PAGE_ID = patient_main_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
patient_main_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
patient_main_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
patient_main_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($patient_main->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($patient_main->Export == "" && $patient_main->SelectLimit);
	if (!$bSelectLimit)
		$rs = $patient_main_list->LoadRecordset();
	$patient_main_list->lTotalRecs = ($bSelectLimit) ? $patient_main->SelectRecordCount() : $rs->RecordCount();
	$patient_main_list->lStartRec = 1;
	if ($patient_main_list->lDisplayRecs <= 0) // Display all records
		$patient_main_list->lDisplayRecs = $patient_main_list->lTotalRecs;
	if (!($patient_main->ExportAll && $patient_main->Export <> ""))
		$patient_main_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $patient_main_list->LoadRecordset($patient_main_list->lStartRec-1, $patient_main_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: Patient Main
</span></p>
<?php $patient_main_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fpatient_mainlist" id="fpatient_mainlist" class="ewForm" action="" method="post">
<?php if ($patient_main_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$patient_main_list->lOptionCnt = 0;
	$patient_main_list->lOptionCnt++; // view
	$patient_main_list->lOptionCnt += count($patient_main_list->ListOptions->Items); // Custom list options
?>
<?php echo $patient_main->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($patient_main->PatientMainNo->Visible) { // PatientMainNo ?>
	<?php if ($patient_main->SortUrl($patient_main->PatientMainNo) == "") { ?>
		<td>Patient Main No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_main->SortUrl($patient_main->PatientMainNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Main No</td><td style="width: 10px;"><?php if ($patient_main->PatientMainNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_main->PatientMainNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_main->PatientID->Visible) { // PatientID ?>
	<?php if ($patient_main->SortUrl($patient_main->PatientID) == "") { ?>
		<td>Patient ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_main->SortUrl($patient_main->PatientID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient ID</td><td style="width: 10px;"><?php if ($patient_main->PatientID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_main->PatientID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_main->PatientName->Visible) { // PatientName ?>
	<?php if ($patient_main->SortUrl($patient_main->PatientName) == "") { ?>
		<td>Patient Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_main->SortUrl($patient_main->PatientName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Name</td><td style="width: 10px;"><?php if ($patient_main->PatientName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_main->PatientName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_main->PatientBirthDate->Visible) { // PatientBirthDate ?>
	<?php if ($patient_main->SortUrl($patient_main->PatientBirthDate) == "") { ?>
		<td>Patient Birth Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_main->SortUrl($patient_main->PatientBirthDate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Birth Date</td><td style="width: 10px;"><?php if ($patient_main->PatientBirthDate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_main->PatientBirthDate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_main->PatientSex->Visible) { // PatientSex ?>
	<?php if ($patient_main->SortUrl($patient_main->PatientSex) == "") { ?>
		<td>Patient Sex</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_main->SortUrl($patient_main->PatientSex) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Patient Sex</td><td style="width: 10px;"><?php if ($patient_main->PatientSex->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_main->PatientSex->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_main->OtherPatientID->Visible) { // OtherPatientID ?>
	<?php if ($patient_main->SortUrl($patient_main->OtherPatientID) == "") { ?>
		<td>Other Patient ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $patient_main->SortUrl($patient_main->OtherPatientID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Other Patient ID</td><td style="width: 10px;"><?php if ($patient_main->OtherPatientID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($patient_main->OtherPatientID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($patient_main->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($patient_main_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($patient_main->ExportAll && $patient_main->Export <> "") {
	$patient_main_list->lStopRec = $patient_main_list->lTotalRecs;
} else {
	$patient_main_list->lStopRec = $patient_main_list->lStartRec + $patient_main_list->lDisplayRecs - 1; // Set the last record to display
}
$patient_main_list->lRecCount = $patient_main_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$patient_main->SelectLimit && $patient_main_list->lStartRec > 1)
		$rs->Move($patient_main_list->lStartRec - 1);
}
$patient_main_list->lRowCnt = 0;
while (($patient_main->CurrentAction == "gridadd" || !$rs->EOF) &&
	$patient_main_list->lRecCount < $patient_main_list->lStopRec) {
	$patient_main_list->lRecCount++;
	if (intval($patient_main_list->lRecCount) >= intval($patient_main_list->lStartRec)) {
		$patient_main_list->lRowCnt++;

	// Init row class and style
	$patient_main->CssClass = "";
	$patient_main->CssStyle = "";
	$patient_main->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($patient_main->CurrentAction == "gridadd") {
		$patient_main_list->LoadDefaultValues(); // Load default values
	} else {
		$patient_main_list->LoadRowValues($rs); // Load row values
	}
	$patient_main->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$patient_main_list->RenderRow();
?>
	<tr<?php echo $patient_main->RowAttributes() ?>>
	<?php if ($patient_main->PatientMainNo->Visible) { // PatientMainNo ?>
		<td<?php echo $patient_main->PatientMainNo->CellAttributes() ?>>
<div<?php echo $patient_main->PatientMainNo->ViewAttributes() ?>><?php echo $patient_main->PatientMainNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_main->PatientID->Visible) { // PatientID ?>
		<td<?php echo $patient_main->PatientID->CellAttributes() ?>>
<div<?php echo $patient_main->PatientID->ViewAttributes() ?>><?php echo $patient_main->PatientID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_main->PatientName->Visible) { // PatientName ?>
		<td<?php echo $patient_main->PatientName->CellAttributes() ?>>
<div<?php echo $patient_main->PatientName->ViewAttributes() ?>><?php echo $patient_main->PatientName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_main->PatientBirthDate->Visible) { // PatientBirthDate ?>
		<td<?php echo $patient_main->PatientBirthDate->CellAttributes() ?>>
<div<?php echo $patient_main->PatientBirthDate->ViewAttributes() ?>><?php echo $patient_main->PatientBirthDate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_main->PatientSex->Visible) { // PatientSex ?>
		<td<?php echo $patient_main->PatientSex->CellAttributes() ?>>
<div<?php echo $patient_main->PatientSex->ViewAttributes() ?>><?php echo $patient_main->PatientSex->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($patient_main->OtherPatientID->Visible) { // OtherPatientID ?>
		<td<?php echo $patient_main->OtherPatientID->CellAttributes() ?>>
<div<?php echo $patient_main->OtherPatientID->ViewAttributes() ?>><?php echo $patient_main->OtherPatientID->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($patient_main->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $patient_main->ViewUrl() ?>">View</a>
</span></td>
<?php

// Custom list options
foreach ($patient_main_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($patient_main->CurrentAction <> "gridadd")
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
<?php if ($patient_main->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($patient_main->CurrentAction <> "gridadd" && $patient_main->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($patient_main_list->Pager)) $patient_main_list->Pager = new cPrevNextPager($patient_main_list->lStartRec, $patient_main_list->lDisplayRecs, $patient_main_list->lTotalRecs) ?>
<?php if ($patient_main_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($patient_main_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $patient_main_list->PageUrl() ?>start=<?php echo $patient_main_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($patient_main_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $patient_main_list->PageUrl() ?>start=<?php echo $patient_main_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $patient_main_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($patient_main_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $patient_main_list->PageUrl() ?>start=<?php echo $patient_main_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($patient_main_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $patient_main_list->PageUrl() ?>start=<?php echo $patient_main_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $patient_main_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $patient_main_list->Pager->FromIndex ?> to <?php echo $patient_main_list->Pager->ToIndex ?> of <?php echo $patient_main_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($patient_main_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($patient_main_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($patient_main->Export == "" && $patient_main->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(patient_main_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($patient_main->Export == "") { ?>
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
class cpatient_main_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'patient_main';

	// Page Object Name
	var $PageObjName = 'patient_main_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $patient_main;
		if ($patient_main->UseTokenInUrl) $PageUrl .= "t=" . $patient_main->TableVar . "&"; // add page token
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
		global $objForm, $patient_main;
		if ($patient_main->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($patient_main->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($patient_main->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cpatient_main_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["patient_main"] = new cpatient_main();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'patient_main', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $patient_main;
	$patient_main->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $patient_main->Export; // Get export parameter, used in header
	$gsExportFile = $patient_main->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $patient_main;
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
		if ($patient_main->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $patient_main->getRecordsPerPage(); // Restore from Session
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
		$patient_main->setSessionWhere($sFilter);
		$patient_main->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $patient_main;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$patient_main->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$patient_main->CurrentOrderType = @$_GET["ordertype"];
			$patient_main->UpdateSort($patient_main->PatientMainNo); // Field 
			$patient_main->UpdateSort($patient_main->PatientID); // Field 
			$patient_main->UpdateSort($patient_main->PatientName); // Field 
			$patient_main->UpdateSort($patient_main->PatientBirthDate); // Field 
			$patient_main->UpdateSort($patient_main->PatientSex); // Field 
			$patient_main->UpdateSort($patient_main->OtherPatientID); // Field 
			$patient_main->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $patient_main;
		$sOrderBy = $patient_main->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($patient_main->SqlOrderBy() <> "") {
				$sOrderBy = $patient_main->SqlOrderBy();
				$patient_main->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $patient_main;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$patient_main->setSessionOrderBy($sOrderBy);
				$patient_main->PatientMainNo->setSort("");
				$patient_main->PatientID->setSort("");
				$patient_main->PatientName->setSort("");
				$patient_main->PatientBirthDate->setSort("");
				$patient_main->PatientSex->setSort("");
				$patient_main->OtherPatientID->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$patient_main->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $patient_main;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$patient_main->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$patient_main->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $patient_main->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$patient_main->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$patient_main->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$patient_main->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $patient_main;

		// Call Recordset Selecting event
		$patient_main->Recordset_Selecting($patient_main->CurrentFilter);

		// Load list page SQL
		$sSql = $patient_main->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$patient_main->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $patient_main;
		$sFilter = $patient_main->KeyFilter();

		// Call Row Selecting event
		$patient_main->Row_Selecting($sFilter);

		// Load sql based on filter
		$patient_main->CurrentFilter = $sFilter;
		$sSql = $patient_main->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$patient_main->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $patient_main;
		$patient_main->PatientMainNo->setDbValue($rs->fields('PatientMainNo'));
		$patient_main->PatientID->setDbValue($rs->fields('PatientID'));
		$patient_main->PatientName->setDbValue($rs->fields('PatientName'));
		$patient_main->PatientBirthDate->setDbValue($rs->fields('PatientBirthDate'));
		$patient_main->PatientSex->setDbValue($rs->fields('PatientSex'));
		$patient_main->OtherPatientID->setDbValue($rs->fields('OtherPatientID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $patient_main;

		// Call Row_Rendering event
		$patient_main->Row_Rendering();

		// Common render codes for all row types
		// PatientMainNo

		$patient_main->PatientMainNo->CellCssStyle = "";
		$patient_main->PatientMainNo->CellCssClass = "";

		// PatientID
		$patient_main->PatientID->CellCssStyle = "";
		$patient_main->PatientID->CellCssClass = "";

		// PatientName
		$patient_main->PatientName->CellCssStyle = "";
		$patient_main->PatientName->CellCssClass = "";

		// PatientBirthDate
		$patient_main->PatientBirthDate->CellCssStyle = "";
		$patient_main->PatientBirthDate->CellCssClass = "";

		// PatientSex
		$patient_main->PatientSex->CellCssStyle = "";
		$patient_main->PatientSex->CellCssClass = "";

		// OtherPatientID
		$patient_main->OtherPatientID->CellCssStyle = "";
		$patient_main->OtherPatientID->CellCssClass = "";
		if ($patient_main->RowType == EW_ROWTYPE_VIEW) { // View row

			// PatientMainNo
			$patient_main->PatientMainNo->ViewValue = $patient_main->PatientMainNo->CurrentValue;
			$patient_main->PatientMainNo->CssStyle = "";
			$patient_main->PatientMainNo->CssClass = "";
			$patient_main->PatientMainNo->ViewCustomAttributes = "";

			// PatientID
			$patient_main->PatientID->ViewValue = $patient_main->PatientID->CurrentValue;
			$patient_main->PatientID->CssStyle = "";
			$patient_main->PatientID->CssClass = "";
			$patient_main->PatientID->ViewCustomAttributes = "";

			// PatientName
			$patient_main->PatientName->ViewValue = $patient_main->PatientName->CurrentValue;
			$patient_main->PatientName->CssStyle = "";
			$patient_main->PatientName->CssClass = "";
			$patient_main->PatientName->ViewCustomAttributes = "";

			// PatientBirthDate
			$patient_main->PatientBirthDate->ViewValue = $patient_main->PatientBirthDate->CurrentValue;
			$patient_main->PatientBirthDate->ViewValue = ew_FormatDateTime($patient_main->PatientBirthDate->ViewValue, 5);
			$patient_main->PatientBirthDate->CssStyle = "";
			$patient_main->PatientBirthDate->CssClass = "";
			$patient_main->PatientBirthDate->ViewCustomAttributes = "";

			// PatientSex
			$patient_main->PatientSex->ViewValue = $patient_main->PatientSex->CurrentValue;
			$patient_main->PatientSex->CssStyle = "";
			$patient_main->PatientSex->CssClass = "";
			$patient_main->PatientSex->ViewCustomAttributes = "";

			// OtherPatientID
			$patient_main->OtherPatientID->ViewValue = $patient_main->OtherPatientID->CurrentValue;
			$patient_main->OtherPatientID->CssStyle = "";
			$patient_main->OtherPatientID->CssClass = "";
			$patient_main->OtherPatientID->ViewCustomAttributes = "";

			// PatientMainNo
			$patient_main->PatientMainNo->HrefValue = "";

			// PatientID
			$patient_main->PatientID->HrefValue = "";

			// PatientName
			$patient_main->PatientName->HrefValue = "";

			// PatientBirthDate
			$patient_main->PatientBirthDate->HrefValue = "";

			// PatientSex
			$patient_main->PatientSex->HrefValue = "";

			// OtherPatientID
			$patient_main->OtherPatientID->HrefValue = "";
		}

		// Call Row Rendered event
		$patient_main->Row_Rendered();
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
