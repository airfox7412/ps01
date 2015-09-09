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
$patient_detail_view = new cpatient_detail_view();
$Page =& $patient_detail_view;

// Page init processing
$patient_detail_view->Page_Init();

// Page main processing
$patient_detail_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($patient_detail->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var patient_detail_view = new ew_Page("patient_detail_view");

// page properties
patient_detail_view.PageID = "view"; // page ID
var EW_PAGE_ID = patient_detail_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
patient_detail_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
patient_detail_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
patient_detail_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">View TABLE: Patient Detail
<br><br>
<?php if ($patient_detail->Export == "") { ?>
<a href="patient_detail_list.php">Back to List</a>&nbsp;
<?php } ?>
</span></p>
<?php $patient_detail_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($patient_detail->DetailNo->Visible) { // DetailNo ?>
	<tr<?php echo $patient_detail->DetailNo->RowAttributes ?>>
		<td class="ewTableHeader">Detail No</td>
		<td<?php echo $patient_detail->DetailNo->CellAttributes() ?>>
<div<?php echo $patient_detail->DetailNo->ViewAttributes() ?>><?php echo $patient_detail->DetailNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->StudyID->Visible) { // StudyID ?>
	<tr<?php echo $patient_detail->StudyID->RowAttributes ?>>
		<td class="ewTableHeader">Study ID</td>
		<td<?php echo $patient_detail->StudyID->CellAttributes() ?>>
<div<?php echo $patient_detail->StudyID->ViewAttributes() ?>><?php echo $patient_detail->StudyID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->PatientID->Visible) { // PatientID ?>
	<tr<?php echo $patient_detail->PatientID->RowAttributes ?>>
		<td class="ewTableHeader">病歷號碼</td>
		<td<?php echo $patient_detail->PatientID->CellAttributes() ?>>
<div<?php echo $patient_detail->PatientID->ViewAttributes() ?>><?php echo $patient_detail->PatientID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->StudyDate->Visible) { // StudyDate ?>
	<tr<?php echo $patient_detail->StudyDate->RowAttributes ?>>
		<td class="ewTableHeader">檢查日期</td>
		<td<?php echo $patient_detail->StudyDate->CellAttributes() ?>>
<div<?php echo $patient_detail->StudyDate->ViewAttributes() ?>><?php echo $patient_detail->StudyDate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->ContentDate->Visible) { // ContentDate ?>
	<tr<?php echo $patient_detail->ContentDate->RowAttributes ?>>
		<td class="ewTableHeader">Content Date</td>
		<td<?php echo $patient_detail->ContentDate->CellAttributes() ?>>
<div<?php echo $patient_detail->ContentDate->ViewAttributes() ?>><?php echo $patient_detail->ContentDate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->StudyTime->Visible) { // StudyTime ?>
	<tr<?php echo $patient_detail->StudyTime->RowAttributes ?>>
		<td class="ewTableHeader">檢查時間</td>
		<td<?php echo $patient_detail->StudyTime->CellAttributes() ?>>
<div<?php echo $patient_detail->StudyTime->ViewAttributes() ?>><?php echo $patient_detail->StudyTime->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->ContentTime->Visible) { // ContentTime ?>
	<tr<?php echo $patient_detail->ContentTime->RowAttributes ?>>
		<td class="ewTableHeader">Content Time</td>
		<td<?php echo $patient_detail->ContentTime->CellAttributes() ?>>
<div<?php echo $patient_detail->ContentTime->ViewAttributes() ?>><?php echo $patient_detail->ContentTime->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->InstitutionName->Visible) { // InstitutionName ?>
	<tr<?php echo $patient_detail->InstitutionName->RowAttributes ?>>
		<td class="ewTableHeader">Institution Name</td>
		<td<?php echo $patient_detail->InstitutionName->CellAttributes() ?>>
<div<?php echo $patient_detail->InstitutionName->ViewAttributes() ?>><?php echo $patient_detail->InstitutionName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->InstitutionAddress->Visible) { // InstitutionAddress ?>
	<tr<?php echo $patient_detail->InstitutionAddress->RowAttributes ?>>
		<td class="ewTableHeader">Institution Address</td>
		<td<?php echo $patient_detail->InstitutionAddress->CellAttributes() ?>>
<div<?php echo $patient_detail->InstitutionAddress->ViewAttributes() ?>><?php echo $patient_detail->InstitutionAddress->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->InstitutionDepartmentName->Visible) { // InstitutionDepartmentName ?>
	<tr<?php echo $patient_detail->InstitutionDepartmentName->RowAttributes ?>>
		<td class="ewTableHeader">Institution Department Name</td>
		<td<?php echo $patient_detail->InstitutionDepartmentName->CellAttributes() ?>>
<div<?php echo $patient_detail->InstitutionDepartmentName->ViewAttributes() ?>><?php echo $patient_detail->InstitutionDepartmentName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->Modality->Visible) { // Modality ?>
	<tr<?php echo $patient_detail->Modality->RowAttributes ?>>
		<td class="ewTableHeader">檢查種類</td>
		<td<?php echo $patient_detail->Modality->CellAttributes() ?>>
<div<?php echo $patient_detail->Modality->ViewAttributes() ?>><?php echo $patient_detail->Modality->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->OperatorName->Visible) { // OperatorName ?>
	<tr<?php echo $patient_detail->OperatorName->RowAttributes ?>>
		<td class="ewTableHeader">Operator Name</td>
		<td<?php echo $patient_detail->OperatorName->CellAttributes() ?>>
<div<?php echo $patient_detail->OperatorName->ViewAttributes() ?>><?php echo $patient_detail->OperatorName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->Manufacturer->Visible) { // Manufacturer ?>
	<tr<?php echo $patient_detail->Manufacturer->RowAttributes ?>>
		<td class="ewTableHeader">Manufacturer</td>
		<td<?php echo $patient_detail->Manufacturer->CellAttributes() ?>>
<div<?php echo $patient_detail->Manufacturer->ViewAttributes() ?>><?php echo $patient_detail->Manufacturer->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->BodyPartExamined->Visible) { // BodyPartExamined ?>
	<tr<?php echo $patient_detail->BodyPartExamined->RowAttributes ?>>
		<td class="ewTableHeader">檢查部位</td>
		<td<?php echo $patient_detail->BodyPartExamined->CellAttributes() ?>>
<div<?php echo $patient_detail->BodyPartExamined->ViewAttributes() ?>><?php echo $patient_detail->BodyPartExamined->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->ProtocolName->Visible) { // ProtocolName ?>
	<tr<?php echo $patient_detail->ProtocolName->RowAttributes ?>>
		<td class="ewTableHeader">部位細節</td>
		<td<?php echo $patient_detail->ProtocolName->CellAttributes() ?>>
<div<?php echo $patient_detail->ProtocolName->ViewAttributes() ?>><?php echo $patient_detail->ProtocolName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->AccessionNumber->Visible) { // AccessionNumber ?>
	<tr<?php echo $patient_detail->AccessionNumber->RowAttributes ?>>
		<td class="ewTableHeader">Accession Number</td>
		<td<?php echo $patient_detail->AccessionNumber->CellAttributes() ?>>
<div<?php echo $patient_detail->AccessionNumber->ViewAttributes() ?>><?php echo $patient_detail->AccessionNumber->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->InstanceNumber->Visible) { // InstanceNumber ?>
	<tr<?php echo $patient_detail->InstanceNumber->RowAttributes ?>>
		<td class="ewTableHeader">Instance Number</td>
		<td<?php echo $patient_detail->InstanceNumber->CellAttributes() ?>>
<div<?php echo $patient_detail->InstanceNumber->ViewAttributes() ?>><?php echo $patient_detail->InstanceNumber->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->Status->Visible) { // Status ?>
	<tr<?php echo $patient_detail->Status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $patient_detail->Status->CellAttributes() ?>>
<div<?php echo $patient_detail->Status->ViewAttributes() ?>><?php echo $patient_detail->Status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
class cpatient_detail_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'patient_detail';

	// Page Object Name
	var $PageObjName = 'patient_detail_view';

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
	function cpatient_detail_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["patient_detail"] = new cpatient_detail();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'patient_detail', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $patient_detail;

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
		global $patient_detail;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["DetailNo"] <> "") {
				$patient_detail->DetailNo->setQueryStringValue($_GET["DetailNo"]);
			} else {
				$sReturnUrl = "patient_detail_list.php"; // Return to list
			}

			// Get action
			$patient_detail->CurrentAction = "I"; // Display form
			switch ($patient_detail->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "patient_detail_list.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "patient_detail_list.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$patient_detail->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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

		// ContentDate
		$patient_detail->ContentDate->CellCssStyle = "";
		$patient_detail->ContentDate->CellCssClass = "";

		// StudyTime
		$patient_detail->StudyTime->CellCssStyle = "";
		$patient_detail->StudyTime->CellCssClass = "";

		// ContentTime
		$patient_detail->ContentTime->CellCssStyle = "";
		$patient_detail->ContentTime->CellCssClass = "";

		// InstitutionName
		$patient_detail->InstitutionName->CellCssStyle = "";
		$patient_detail->InstitutionName->CellCssClass = "";

		// InstitutionAddress
		$patient_detail->InstitutionAddress->CellCssStyle = "";
		$patient_detail->InstitutionAddress->CellCssClass = "";

		// InstitutionDepartmentName
		$patient_detail->InstitutionDepartmentName->CellCssStyle = "";
		$patient_detail->InstitutionDepartmentName->CellCssClass = "";

		// Modality
		$patient_detail->Modality->CellCssStyle = "";
		$patient_detail->Modality->CellCssClass = "";

		// OperatorName
		$patient_detail->OperatorName->CellCssStyle = "";
		$patient_detail->OperatorName->CellCssClass = "";

		// Manufacturer
		$patient_detail->Manufacturer->CellCssStyle = "";
		$patient_detail->Manufacturer->CellCssClass = "";

		// BodyPartExamined
		$patient_detail->BodyPartExamined->CellCssStyle = "";
		$patient_detail->BodyPartExamined->CellCssClass = "";

		// ProtocolName
		$patient_detail->ProtocolName->CellCssStyle = "";
		$patient_detail->ProtocolName->CellCssClass = "";

		// AccessionNumber
		$patient_detail->AccessionNumber->CellCssStyle = "";
		$patient_detail->AccessionNumber->CellCssClass = "";

		// InstanceNumber
		$patient_detail->InstanceNumber->CellCssStyle = "";
		$patient_detail->InstanceNumber->CellCssClass = "";

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

			// ContentDate
			$patient_detail->ContentDate->HrefValue = "";

			// StudyTime
			$patient_detail->StudyTime->HrefValue = "";

			// ContentTime
			$patient_detail->ContentTime->HrefValue = "";

			// InstitutionName
			$patient_detail->InstitutionName->HrefValue = "";

			// InstitutionAddress
			$patient_detail->InstitutionAddress->HrefValue = "";

			// InstitutionDepartmentName
			$patient_detail->InstitutionDepartmentName->HrefValue = "";

			// Modality
			$patient_detail->Modality->HrefValue = "";

			// OperatorName
			$patient_detail->OperatorName->HrefValue = "";

			// Manufacturer
			$patient_detail->Manufacturer->HrefValue = "";

			// BodyPartExamined
			$patient_detail->BodyPartExamined->HrefValue = "";

			// ProtocolName
			$patient_detail->ProtocolName->HrefValue = "";

			// AccessionNumber
			$patient_detail->AccessionNumber->HrefValue = "";

			// InstanceNumber
			$patient_detail->InstanceNumber->HrefValue = "";

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
}
?>
