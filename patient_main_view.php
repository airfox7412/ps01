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
$patient_main_view = new cpatient_main_view();
$Page =& $patient_main_view;

// Page init processing
$patient_main_view->Page_Init();

// Page main processing
$patient_main_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($patient_main->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var patient_main_view = new ew_Page("patient_main_view");

// page properties
patient_main_view.PageID = "view"; // page ID
var EW_PAGE_ID = patient_main_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
patient_main_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
patient_main_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
patient_main_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">View TABLE: Patient Main
<br><br>
<?php if ($patient_main->Export == "") { ?>
<a href="patient_main_list.php">Back to List</a>&nbsp;
<?php } ?>
</span></p>
<?php $patient_main_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($patient_main->PatientMainNo->Visible) { // PatientMainNo ?>
	<tr<?php echo $patient_main->PatientMainNo->RowAttributes ?>>
		<td class="ewTableHeader">Patient Main No</td>
		<td<?php echo $patient_main->PatientMainNo->CellAttributes() ?>>
<div<?php echo $patient_main->PatientMainNo->ViewAttributes() ?>><?php echo $patient_main->PatientMainNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_main->PatientID->Visible) { // PatientID ?>
	<tr<?php echo $patient_main->PatientID->RowAttributes ?>>
		<td class="ewTableHeader">Patient ID</td>
		<td<?php echo $patient_main->PatientID->CellAttributes() ?>>
<div<?php echo $patient_main->PatientID->ViewAttributes() ?>><?php echo $patient_main->PatientID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_main->PatientName->Visible) { // PatientName ?>
	<tr<?php echo $patient_main->PatientName->RowAttributes ?>>
		<td class="ewTableHeader">Patient Name</td>
		<td<?php echo $patient_main->PatientName->CellAttributes() ?>>
<div<?php echo $patient_main->PatientName->ViewAttributes() ?>><?php echo $patient_main->PatientName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_main->PatientBirthDate->Visible) { // PatientBirthDate ?>
	<tr<?php echo $patient_main->PatientBirthDate->RowAttributes ?>>
		<td class="ewTableHeader">Patient Birth Date</td>
		<td<?php echo $patient_main->PatientBirthDate->CellAttributes() ?>>
<div<?php echo $patient_main->PatientBirthDate->ViewAttributes() ?>><?php echo $patient_main->PatientBirthDate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_main->PatientSex->Visible) { // PatientSex ?>
	<tr<?php echo $patient_main->PatientSex->RowAttributes ?>>
		<td class="ewTableHeader">Patient Sex</td>
		<td<?php echo $patient_main->PatientSex->CellAttributes() ?>>
<div<?php echo $patient_main->PatientSex->ViewAttributes() ?>><?php echo $patient_main->PatientSex->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_main->OtherPatientID->Visible) { // OtherPatientID ?>
	<tr<?php echo $patient_main->OtherPatientID->RowAttributes ?>>
		<td class="ewTableHeader">Other Patient ID</td>
		<td<?php echo $patient_main->OtherPatientID->CellAttributes() ?>>
<div<?php echo $patient_main->OtherPatientID->ViewAttributes() ?>><?php echo $patient_main->OtherPatientID->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
class cpatient_main_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'patient_main';

	// Page Object Name
	var $PageObjName = 'patient_main_view';

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
	function cpatient_main_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["patient_main"] = new cpatient_main();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'patient_main', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $patient_main;

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
	var $lRecCnt;

	//
	// Page main processing
	//
	function Page_Main() {
		global $patient_main;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["PatientMainNo"] <> "") {
				$patient_main->PatientMainNo->setQueryStringValue($_GET["PatientMainNo"]);
			} else {
				$sReturnUrl = "patient_main_list.php"; // Return to list
			}

			// Get action
			$patient_main->CurrentAction = "I"; // Display form
			switch ($patient_main->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "patient_main_list.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "patient_main_list.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$patient_main->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
}
?>
