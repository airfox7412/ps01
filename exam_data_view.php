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
$exam_data_view = new cexam_data_view();
$Page =& $exam_data_view;

// Page init processing
$exam_data_view->Page_Init();

// Page main processing
$exam_data_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($exam_data->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var exam_data_view = new ew_Page("exam_data_view");

// page properties
exam_data_view.PageID = "view"; // page ID
var EW_PAGE_ID = exam_data_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
exam_data_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
exam_data_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
exam_data_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">View TABLE: Exam Data
<br><br>
<?php if ($exam_data->Export == "") { ?>
<a href="exam_data_list.php">Back to List</a>&nbsp;
<a href="<?php echo $exam_data->AddUrl() ?>">Add</a>&nbsp;
<a href="<?php echo $exam_data->EditUrl() ?>">Edit</a>&nbsp;
<a href="<?php echo $exam_data->CopyUrl() ?>">Copy</a>&nbsp;
<a href="<?php echo $exam_data->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
</span></p>
<?php $exam_data_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($exam_data->ExamDataNo->Visible) { // ExamDataNo ?>
	<tr<?php echo $exam_data->ExamDataNo->RowAttributes ?>>
		<td class="ewTableHeader">Exam Data No</td>
		<td<?php echo $exam_data->ExamDataNo->CellAttributes() ?>>
<div<?php echo $exam_data->ExamDataNo->ViewAttributes() ?>><?php echo $exam_data->ExamDataNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->AccessionNumber->Visible) { // AccessionNumber ?>
	<tr<?php echo $exam_data->AccessionNumber->RowAttributes ?>>
		<td class="ewTableHeader">Accession Number</td>
		<td<?php echo $exam_data->AccessionNumber->CellAttributes() ?>>
<div<?php echo $exam_data->AccessionNumber->ViewAttributes() ?>><?php echo $exam_data->AccessionNumber->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientMainNo->Visible) { // PatientMainNo ?>
	<tr<?php echo $exam_data->PatientMainNo->RowAttributes ?>>
		<td class="ewTableHeader">Patient Main No</td>
		<td<?php echo $exam_data->PatientMainNo->CellAttributes() ?>>
<div<?php echo $exam_data->PatientMainNo->ViewAttributes() ?>><?php echo $exam_data->PatientMainNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientID->Visible) { // PatientID ?>
	<tr<?php echo $exam_data->PatientID->RowAttributes ?>>
		<td class="ewTableHeader">Patient ID</td>
		<td<?php echo $exam_data->PatientID->CellAttributes() ?>>
<div<?php echo $exam_data->PatientID->ViewAttributes() ?>><?php echo $exam_data->PatientID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->InstitutionNo->Visible) { // InstitutionNo ?>
	<tr<?php echo $exam_data->InstitutionNo->RowAttributes ?>>
		<td class="ewTableHeader">Institution No</td>
		<td<?php echo $exam_data->InstitutionNo->CellAttributes() ?>>
<div<?php echo $exam_data->InstitutionNo->ViewAttributes() ?>><?php echo $exam_data->InstitutionNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ImageDetailNo->Visible) { // ImageDetailNo ?>
	<tr<?php echo $exam_data->ImageDetailNo->RowAttributes ?>>
		<td class="ewTableHeader">Image Detail No</td>
		<td<?php echo $exam_data->ImageDetailNo->CellAttributes() ?>>
<div<?php echo $exam_data->ImageDetailNo->ViewAttributes() ?>><?php echo $exam_data->ImageDetailNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientKindNo->Visible) { // PatientKindNo ?>
	<tr<?php echo $exam_data->PatientKindNo->RowAttributes ?>>
		<td class="ewTableHeader">Patient Kind No</td>
		<td<?php echo $exam_data->PatientKindNo->CellAttributes() ?>>
<div<?php echo $exam_data->PatientKindNo->ViewAttributes() ?>><?php echo $exam_data->PatientKindNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientSubKindNo->Visible) { // PatientSubKindNo ?>
	<tr<?php echo $exam_data->PatientSubKindNo->RowAttributes ?>>
		<td class="ewTableHeader">Patient Sub Kind No</td>
		<td<?php echo $exam_data->PatientSubKindNo->CellAttributes() ?>>
<div<?php echo $exam_data->PatientSubKindNo->ViewAttributes() ?>><?php echo $exam_data->PatientSubKindNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientTypeNo->Visible) { // PatientTypeNo ?>
	<tr<?php echo $exam_data->PatientTypeNo->RowAttributes ?>>
		<td class="ewTableHeader">Patient Type No</td>
		<td<?php echo $exam_data->PatientTypeNo->CellAttributes() ?>>
<div<?php echo $exam_data->PatientTypeNo->ViewAttributes() ?>><?php echo $exam_data->PatientTypeNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->PatientRoom->Visible) { // PatientRoom ?>
	<tr<?php echo $exam_data->PatientRoom->RowAttributes ?>>
		<td class="ewTableHeader">Patient Room</td>
		<td<?php echo $exam_data->PatientRoom->CellAttributes() ?>>
<div<?php echo $exam_data->PatientRoom->ViewAttributes() ?>><?php echo $exam_data->PatientRoom->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->DepartmentNo->Visible) { // DepartmentNo ?>
	<tr<?php echo $exam_data->DepartmentNo->RowAttributes ?>>
		<td class="ewTableHeader">Department No</td>
		<td<?php echo $exam_data->DepartmentNo->CellAttributes() ?>>
<div<?php echo $exam_data->DepartmentNo->ViewAttributes() ?>><?php echo $exam_data->DepartmentNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->DepartmentName->Visible) { // DepartmentName ?>
	<tr<?php echo $exam_data->DepartmentName->RowAttributes ?>>
		<td class="ewTableHeader">Department Name</td>
		<td<?php echo $exam_data->DepartmentName->CellAttributes() ?>>
<div<?php echo $exam_data->DepartmentName->ViewAttributes() ?>><?php echo $exam_data->DepartmentName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->Soap->Visible) { // Soap ?>
	<tr<?php echo $exam_data->Soap->RowAttributes ?>>
		<td class="ewTableHeader">Soap</td>
		<td<?php echo $exam_data->Soap->CellAttributes() ?>>
<?php if ($exam_data->Soap->HrefValue <> "") { ?>
<?php if (!is_null($exam_data->Soap->Upload->DbValue)) { ?>
<a href="<?php echo $exam_data->Soap->HrefValue ?>" target="_blank"><?php echo $exam_data->Soap->ViewValue ?></a>
<?php } elseif (!in_array($exam_data->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($exam_data->Soap->Upload->DbValue)) { ?>
<?php echo $exam_data->Soap->ViewValue ?>
<?php } elseif (!in_array($exam_data->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($exam_data->RequestDoctorID->Visible) { // RequestDoctorID ?>
	<tr<?php echo $exam_data->RequestDoctorID->RowAttributes ?>>
		<td class="ewTableHeader">Request Doctor ID</td>
		<td<?php echo $exam_data->RequestDoctorID->CellAttributes() ?>>
<div<?php echo $exam_data->RequestDoctorID->ViewAttributes() ?>><?php echo $exam_data->RequestDoctorID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->CodeValue->Visible) { // CodeValue ?>
	<tr<?php echo $exam_data->CodeValue->RowAttributes ?>>
		<td class="ewTableHeader">Code Value</td>
		<td<?php echo $exam_data->CodeValue->CellAttributes() ?>>
<div<?php echo $exam_data->CodeValue->ViewAttributes() ?>><?php echo $exam_data->CodeValue->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->SpecialExamID->Visible) { // SpecialExamID ?>
	<tr<?php echo $exam_data->SpecialExamID->RowAttributes ?>>
		<td class="ewTableHeader">Special Exam ID</td>
		<td<?php echo $exam_data->SpecialExamID->CellAttributes() ?>>
<div<?php echo $exam_data->SpecialExamID->ViewAttributes() ?>><?php echo $exam_data->SpecialExamID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->SpecialExamName->Visible) { // SpecialExamName ?>
	<tr<?php echo $exam_data->SpecialExamName->RowAttributes ?>>
		<td class="ewTableHeader">Special Exam Name</td>
		<td<?php echo $exam_data->SpecialExamName->CellAttributes() ?>>
<div<?php echo $exam_data->SpecialExamName->ViewAttributes() ?>><?php echo $exam_data->SpecialExamName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->SpecialExamDate->Visible) { // SpecialExamDate ?>
	<tr<?php echo $exam_data->SpecialExamDate->RowAttributes ?>>
		<td class="ewTableHeader">Special Exam Date</td>
		<td<?php echo $exam_data->SpecialExamDate->CellAttributes() ?>>
<div<?php echo $exam_data->SpecialExamDate->ViewAttributes() ?>><?php echo $exam_data->SpecialExamDate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ExamDate->Visible) { // ExamDate ?>
	<tr<?php echo $exam_data->ExamDate->RowAttributes ?>>
		<td class="ewTableHeader">Exam Date</td>
		<td<?php echo $exam_data->ExamDate->CellAttributes() ?>>
<div<?php echo $exam_data->ExamDate->ViewAttributes() ?>><?php echo $exam_data->ExamDate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ExamTime->Visible) { // ExamTime ?>
	<tr<?php echo $exam_data->ExamTime->RowAttributes ?>>
		<td class="ewTableHeader">Exam Time</td>
		<td<?php echo $exam_data->ExamTime->CellAttributes() ?>>
<div<?php echo $exam_data->ExamTime->ViewAttributes() ?>><?php echo $exam_data->ExamTime->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->LogDate->Visible) { // LogDate ?>
	<tr<?php echo $exam_data->LogDate->RowAttributes ?>>
		<td class="ewTableHeader">Log Date</td>
		<td<?php echo $exam_data->LogDate->CellAttributes() ?>>
<div<?php echo $exam_data->LogDate->ViewAttributes() ?>><?php echo $exam_data->LogDate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ModifyUser->Visible) { // ModifyUser ?>
	<tr<?php echo $exam_data->ModifyUser->RowAttributes ?>>
		<td class="ewTableHeader">Modify User</td>
		<td<?php echo $exam_data->ModifyUser->CellAttributes() ?>>
<div<?php echo $exam_data->ModifyUser->ViewAttributes() ?>><?php echo $exam_data->ModifyUser->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ModifyDate->Visible) { // ModifyDate ?>
	<tr<?php echo $exam_data->ModifyDate->RowAttributes ?>>
		<td class="ewTableHeader">Modify Date</td>
		<td<?php echo $exam_data->ModifyDate->CellAttributes() ?>>
<div<?php echo $exam_data->ModifyDate->ViewAttributes() ?>><?php echo $exam_data->ModifyDate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->CreatePart->Visible) { // CreatePart ?>
	<tr<?php echo $exam_data->CreatePart->RowAttributes ?>>
		<td class="ewTableHeader">Create Part</td>
		<td<?php echo $exam_data->CreatePart->CellAttributes() ?>>
<div<?php echo $exam_data->CreatePart->ViewAttributes() ?>><?php echo $exam_data->CreatePart->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->ModifyPart->Visible) { // ModifyPart ?>
	<tr<?php echo $exam_data->ModifyPart->RowAttributes ?>>
		<td class="ewTableHeader">Modify Part</td>
		<td<?php echo $exam_data->ModifyPart->CellAttributes() ?>>
<div<?php echo $exam_data->ModifyPart->ViewAttributes() ?>><?php echo $exam_data->ModifyPart->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($exam_data->Status->Visible) { // Status ?>
	<tr<?php echo $exam_data->Status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $exam_data->Status->CellAttributes() ?>>
<div<?php echo $exam_data->Status->ViewAttributes() ?>><?php echo $exam_data->Status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
class cexam_data_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'exam_data';

	// Page Object Name
	var $PageObjName = 'exam_data_view';

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
	function cexam_data_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["exam_data"] = new cexam_data();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		global $exam_data;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["ExamDataNo"] <> "") {
				$exam_data->ExamDataNo->setQueryStringValue($_GET["ExamDataNo"]);
			} else {
				$sReturnUrl = "exam_data_list.php"; // Return to list
			}

			// Get action
			$exam_data->CurrentAction = "I"; // Display form
			switch ($exam_data->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "exam_data_list.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "exam_data_list.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$exam_data->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
}
?>
