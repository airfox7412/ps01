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
$patient_detail_add = new cpatient_detail_add();
$Page =& $patient_detail_add;

// Page init processing
$patient_detail_add->Page_Init();

// Page main processing
$patient_detail_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var patient_detail_add = new ew_Page("patient_detail_add");

// page properties
patient_detail_add.PageID = "add"; // page ID
var EW_PAGE_ID = patient_detail_add.PageID; // for backward compatibility

// extend page with ValidateForm function
patient_detail_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_StudyID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Study ID");
		elm = fobj.elements["x" + infix + "_PatientID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Patient ID");
		elm = fobj.elements["x" + infix + "_StudyDate"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Study Date");
		elm = fobj.elements["x" + infix + "_ContentDate"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Content Date");
		elm = fobj.elements["x" + infix + "_StudyTime"];
		if (elm && !ew_CheckTime(elm.value))
			return ew_OnError(this, elm, "Incorrect time (hh:mm:ss) - Study Time");
		elm = fobj.elements["x" + infix + "_ContentTime"];
		if (elm && !ew_CheckTime(elm.value))
			return ew_OnError(this, elm, "Incorrect time (hh:mm:ss) - Content Time");
		elm = fobj.elements["x" + infix + "_InstanceNumber"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Instance Number");
		elm = fobj.elements["x" + infix + "_Status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Status");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
patient_detail_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
patient_detail_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
patient_detail_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">Add to TABLE: Patient Detail<br><br>
<a href="<?php echo $patient_detail->getReturnUrl() ?>">Go Back</a></span></p>
<?php $patient_detail_add->ShowMessage() ?>
<form name="fpatient_detailadd" id="fpatient_detailadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return patient_detail_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="patient_detail">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($patient_detail->StudyID->Visible) { // StudyID ?>
	<tr<?php echo $patient_detail->StudyID->RowAttributes ?>>
		<td class="ewTableHeader">Study ID<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $patient_detail->StudyID->CellAttributes() ?>><span id="el_StudyID">
<input type="text" name="x_StudyID" id="x_StudyID" size="30" maxlength="15" value="<?php echo $patient_detail->StudyID->EditValue ?>"<?php echo $patient_detail->StudyID->EditAttributes() ?>>
</span><?php echo $patient_detail->StudyID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->PatientID->Visible) { // PatientID ?>
	<tr<?php echo $patient_detail->PatientID->RowAttributes ?>>
		<td class="ewTableHeader">Patient ID<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $patient_detail->PatientID->CellAttributes() ?>><span id="el_PatientID">
<input type="text" name="x_PatientID" id="x_PatientID" size="30" maxlength="20" value="<?php echo $patient_detail->PatientID->EditValue ?>"<?php echo $patient_detail->PatientID->EditAttributes() ?>>
</span><?php echo $patient_detail->PatientID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->StudyDate->Visible) { // StudyDate ?>
	<tr<?php echo $patient_detail->StudyDate->RowAttributes ?>>
		<td class="ewTableHeader">Study Date</td>
		<td<?php echo $patient_detail->StudyDate->CellAttributes() ?>><span id="el_StudyDate">
<input type="text" name="x_StudyDate" id="x_StudyDate" value="<?php echo $patient_detail->StudyDate->EditValue ?>"<?php echo $patient_detail->StudyDate->EditAttributes() ?>>
</span><?php echo $patient_detail->StudyDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->ContentDate->Visible) { // ContentDate ?>
	<tr<?php echo $patient_detail->ContentDate->RowAttributes ?>>
		<td class="ewTableHeader">Content Date</td>
		<td<?php echo $patient_detail->ContentDate->CellAttributes() ?>><span id="el_ContentDate">
<input type="text" name="x_ContentDate" id="x_ContentDate" value="<?php echo $patient_detail->ContentDate->EditValue ?>"<?php echo $patient_detail->ContentDate->EditAttributes() ?>>
</span><?php echo $patient_detail->ContentDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->StudyTime->Visible) { // StudyTime ?>
	<tr<?php echo $patient_detail->StudyTime->RowAttributes ?>>
		<td class="ewTableHeader">Study Time</td>
		<td<?php echo $patient_detail->StudyTime->CellAttributes() ?>><span id="el_StudyTime">
<input type="text" name="x_StudyTime" id="x_StudyTime" size="30" value="<?php echo $patient_detail->StudyTime->EditValue ?>"<?php echo $patient_detail->StudyTime->EditAttributes() ?>>
</span><?php echo $patient_detail->StudyTime->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->ContentTime->Visible) { // ContentTime ?>
	<tr<?php echo $patient_detail->ContentTime->RowAttributes ?>>
		<td class="ewTableHeader">Content Time</td>
		<td<?php echo $patient_detail->ContentTime->CellAttributes() ?>><span id="el_ContentTime">
<input type="text" name="x_ContentTime" id="x_ContentTime" size="30" value="<?php echo $patient_detail->ContentTime->EditValue ?>"<?php echo $patient_detail->ContentTime->EditAttributes() ?>>
</span><?php echo $patient_detail->ContentTime->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->InstitutionName->Visible) { // InstitutionName ?>
	<tr<?php echo $patient_detail->InstitutionName->RowAttributes ?>>
		<td class="ewTableHeader">Institution Name</td>
		<td<?php echo $patient_detail->InstitutionName->CellAttributes() ?>><span id="el_InstitutionName">
<input type="text" name="x_InstitutionName" id="x_InstitutionName" size="30" maxlength="30" value="<?php echo $patient_detail->InstitutionName->EditValue ?>"<?php echo $patient_detail->InstitutionName->EditAttributes() ?>>
</span><?php echo $patient_detail->InstitutionName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->InstitutionAddress->Visible) { // InstitutionAddress ?>
	<tr<?php echo $patient_detail->InstitutionAddress->RowAttributes ?>>
		<td class="ewTableHeader">Institution Address</td>
		<td<?php echo $patient_detail->InstitutionAddress->CellAttributes() ?>><span id="el_InstitutionAddress">
<input type="text" name="x_InstitutionAddress" id="x_InstitutionAddress" size="30" maxlength="50" value="<?php echo $patient_detail->InstitutionAddress->EditValue ?>"<?php echo $patient_detail->InstitutionAddress->EditAttributes() ?>>
</span><?php echo $patient_detail->InstitutionAddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->InstitutionDepartmentName->Visible) { // InstitutionDepartmentName ?>
	<tr<?php echo $patient_detail->InstitutionDepartmentName->RowAttributes ?>>
		<td class="ewTableHeader">Institution Department Name</td>
		<td<?php echo $patient_detail->InstitutionDepartmentName->CellAttributes() ?>><span id="el_InstitutionDepartmentName">
<input type="text" name="x_InstitutionDepartmentName" id="x_InstitutionDepartmentName" size="30" maxlength="20" value="<?php echo $patient_detail->InstitutionDepartmentName->EditValue ?>"<?php echo $patient_detail->InstitutionDepartmentName->EditAttributes() ?>>
</span><?php echo $patient_detail->InstitutionDepartmentName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->Modality->Visible) { // Modality ?>
	<tr<?php echo $patient_detail->Modality->RowAttributes ?>>
		<td class="ewTableHeader">Modality</td>
		<td<?php echo $patient_detail->Modality->CellAttributes() ?>><span id="el_Modality">
<input type="text" name="x_Modality" id="x_Modality" size="30" maxlength="10" value="<?php echo $patient_detail->Modality->EditValue ?>"<?php echo $patient_detail->Modality->EditAttributes() ?>>
</span><?php echo $patient_detail->Modality->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->OperatorName->Visible) { // OperatorName ?>
	<tr<?php echo $patient_detail->OperatorName->RowAttributes ?>>
		<td class="ewTableHeader">Operator Name</td>
		<td<?php echo $patient_detail->OperatorName->CellAttributes() ?>><span id="el_OperatorName">
<input type="text" name="x_OperatorName" id="x_OperatorName" size="30" maxlength="20" value="<?php echo $patient_detail->OperatorName->EditValue ?>"<?php echo $patient_detail->OperatorName->EditAttributes() ?>>
</span><?php echo $patient_detail->OperatorName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->Manufacturer->Visible) { // Manufacturer ?>
	<tr<?php echo $patient_detail->Manufacturer->RowAttributes ?>>
		<td class="ewTableHeader">Manufacturer</td>
		<td<?php echo $patient_detail->Manufacturer->CellAttributes() ?>><span id="el_Manufacturer">
<input type="text" name="x_Manufacturer" id="x_Manufacturer" size="30" maxlength="50" value="<?php echo $patient_detail->Manufacturer->EditValue ?>"<?php echo $patient_detail->Manufacturer->EditAttributes() ?>>
</span><?php echo $patient_detail->Manufacturer->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->BodyPartExamined->Visible) { // BodyPartExamined ?>
	<tr<?php echo $patient_detail->BodyPartExamined->RowAttributes ?>>
		<td class="ewTableHeader">Body Part Examined</td>
		<td<?php echo $patient_detail->BodyPartExamined->CellAttributes() ?>><span id="el_BodyPartExamined">
<input type="text" name="x_BodyPartExamined" id="x_BodyPartExamined" size="30" maxlength="50" value="<?php echo $patient_detail->BodyPartExamined->EditValue ?>"<?php echo $patient_detail->BodyPartExamined->EditAttributes() ?>>
</span><?php echo $patient_detail->BodyPartExamined->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->ProtocolName->Visible) { // ProtocolName ?>
	<tr<?php echo $patient_detail->ProtocolName->RowAttributes ?>>
		<td class="ewTableHeader">Protocol Name</td>
		<td<?php echo $patient_detail->ProtocolName->CellAttributes() ?>><span id="el_ProtocolName">
<input type="text" name="x_ProtocolName" id="x_ProtocolName" size="30" maxlength="50" value="<?php echo $patient_detail->ProtocolName->EditValue ?>"<?php echo $patient_detail->ProtocolName->EditAttributes() ?>>
</span><?php echo $patient_detail->ProtocolName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->AccessionNumber->Visible) { // AccessionNumber ?>
	<tr<?php echo $patient_detail->AccessionNumber->RowAttributes ?>>
		<td class="ewTableHeader">Accession Number</td>
		<td<?php echo $patient_detail->AccessionNumber->CellAttributes() ?>><span id="el_AccessionNumber">
<input type="text" name="x_AccessionNumber" id="x_AccessionNumber" size="30" maxlength="30" value="<?php echo $patient_detail->AccessionNumber->EditValue ?>"<?php echo $patient_detail->AccessionNumber->EditAttributes() ?>>
</span><?php echo $patient_detail->AccessionNumber->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->InstanceNumber->Visible) { // InstanceNumber ?>
	<tr<?php echo $patient_detail->InstanceNumber->RowAttributes ?>>
		<td class="ewTableHeader">Instance Number</td>
		<td<?php echo $patient_detail->InstanceNumber->CellAttributes() ?>><span id="el_InstanceNumber">
<input type="text" name="x_InstanceNumber" id="x_InstanceNumber" size="30" value="<?php echo $patient_detail->InstanceNumber->EditValue ?>"<?php echo $patient_detail->InstanceNumber->EditAttributes() ?>>
</span><?php echo $patient_detail->InstanceNumber->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_detail->Status->Visible) { // Status ?>
	<tr<?php echo $patient_detail->Status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $patient_detail->Status->CellAttributes() ?>><span id="el_Status">
<input type="text" name="x_Status" id="x_Status" size="30" maxlength="1" value="<?php echo $patient_detail->Status->EditValue ?>"<?php echo $patient_detail->Status->EditAttributes() ?>>
</span><?php echo $patient_detail->Status->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="    Add    ">
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
class cpatient_detail_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'patient_detail';

	// Page Object Name
	var $PageObjName = 'patient_detail_add';

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
	function cpatient_detail_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["patient_detail"] = new cpatient_detail();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $patient_detail;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["DetailNo"] != "") {
		  $patient_detail->DetailNo->setQueryStringValue($_GET["DetailNo"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $patient_detail->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$patient_detail->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $patient_detail->CurrentAction = "C"; // Copy Record
		  } else {
		    $patient_detail->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($patient_detail->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("patient_detail_list.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$patient_detail->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $patient_detail->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$patient_detail->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $patient_detail;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $patient_detail;
		$patient_detail->Status->CurrentValue = "N";
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $patient_detail;
		$patient_detail->StudyID->setFormValue($objForm->GetValue("x_StudyID"));
		$patient_detail->PatientID->setFormValue($objForm->GetValue("x_PatientID"));
		$patient_detail->StudyDate->setFormValue($objForm->GetValue("x_StudyDate"));
		$patient_detail->StudyDate->CurrentValue = ew_UnFormatDateTime($patient_detail->StudyDate->CurrentValue, 5);
		$patient_detail->ContentDate->setFormValue($objForm->GetValue("x_ContentDate"));
		$patient_detail->ContentDate->CurrentValue = ew_UnFormatDateTime($patient_detail->ContentDate->CurrentValue, 5);
		$patient_detail->StudyTime->setFormValue($objForm->GetValue("x_StudyTime"));
		$patient_detail->ContentTime->setFormValue($objForm->GetValue("x_ContentTime"));
		$patient_detail->InstitutionName->setFormValue($objForm->GetValue("x_InstitutionName"));
		$patient_detail->InstitutionAddress->setFormValue($objForm->GetValue("x_InstitutionAddress"));
		$patient_detail->InstitutionDepartmentName->setFormValue($objForm->GetValue("x_InstitutionDepartmentName"));
		$patient_detail->Modality->setFormValue($objForm->GetValue("x_Modality"));
		$patient_detail->OperatorName->setFormValue($objForm->GetValue("x_OperatorName"));
		$patient_detail->Manufacturer->setFormValue($objForm->GetValue("x_Manufacturer"));
		$patient_detail->BodyPartExamined->setFormValue($objForm->GetValue("x_BodyPartExamined"));
		$patient_detail->ProtocolName->setFormValue($objForm->GetValue("x_ProtocolName"));
		$patient_detail->AccessionNumber->setFormValue($objForm->GetValue("x_AccessionNumber"));
		$patient_detail->InstanceNumber->setFormValue($objForm->GetValue("x_InstanceNumber"));
		$patient_detail->Status->setFormValue($objForm->GetValue("x_Status"));
		$patient_detail->DetailNo->setFormValue($objForm->GetValue("x_DetailNo"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $patient_detail;
		$patient_detail->DetailNo->CurrentValue = $patient_detail->DetailNo->FormValue;
		$patient_detail->StudyID->CurrentValue = $patient_detail->StudyID->FormValue;
		$patient_detail->PatientID->CurrentValue = $patient_detail->PatientID->FormValue;
		$patient_detail->StudyDate->CurrentValue = $patient_detail->StudyDate->FormValue;
		$patient_detail->StudyDate->CurrentValue = ew_UnFormatDateTime($patient_detail->StudyDate->CurrentValue, 5);
		$patient_detail->ContentDate->CurrentValue = $patient_detail->ContentDate->FormValue;
		$patient_detail->ContentDate->CurrentValue = ew_UnFormatDateTime($patient_detail->ContentDate->CurrentValue, 5);
		$patient_detail->StudyTime->CurrentValue = $patient_detail->StudyTime->FormValue;
		$patient_detail->ContentTime->CurrentValue = $patient_detail->ContentTime->FormValue;
		$patient_detail->InstitutionName->CurrentValue = $patient_detail->InstitutionName->FormValue;
		$patient_detail->InstitutionAddress->CurrentValue = $patient_detail->InstitutionAddress->FormValue;
		$patient_detail->InstitutionDepartmentName->CurrentValue = $patient_detail->InstitutionDepartmentName->FormValue;
		$patient_detail->Modality->CurrentValue = $patient_detail->Modality->FormValue;
		$patient_detail->OperatorName->CurrentValue = $patient_detail->OperatorName->FormValue;
		$patient_detail->Manufacturer->CurrentValue = $patient_detail->Manufacturer->FormValue;
		$patient_detail->BodyPartExamined->CurrentValue = $patient_detail->BodyPartExamined->FormValue;
		$patient_detail->ProtocolName->CurrentValue = $patient_detail->ProtocolName->FormValue;
		$patient_detail->AccessionNumber->CurrentValue = $patient_detail->AccessionNumber->FormValue;
		$patient_detail->InstanceNumber->CurrentValue = $patient_detail->InstanceNumber->FormValue;
		$patient_detail->Status->CurrentValue = $patient_detail->Status->FormValue;
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
		} elseif ($patient_detail->RowType == EW_ROWTYPE_ADD) { // Add row

			// StudyID
			$patient_detail->StudyID->EditCustomAttributes = "";
			$patient_detail->StudyID->EditValue = ew_HtmlEncode($patient_detail->StudyID->CurrentValue);

			// PatientID
			$patient_detail->PatientID->EditCustomAttributes = "";
			$patient_detail->PatientID->EditValue = ew_HtmlEncode($patient_detail->PatientID->CurrentValue);

			// StudyDate
			$patient_detail->StudyDate->EditCustomAttributes = "";
			$patient_detail->StudyDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($patient_detail->StudyDate->CurrentValue, 5));

			// ContentDate
			$patient_detail->ContentDate->EditCustomAttributes = "";
			$patient_detail->ContentDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($patient_detail->ContentDate->CurrentValue, 5));

			// StudyTime
			$patient_detail->StudyTime->EditCustomAttributes = "";
			$patient_detail->StudyTime->EditValue = ew_HtmlEncode(ew_FormatDateTime($patient_detail->StudyTime->CurrentValue, 4));

			// ContentTime
			$patient_detail->ContentTime->EditCustomAttributes = "";
			$patient_detail->ContentTime->EditValue = ew_HtmlEncode(ew_FormatDateTime($patient_detail->ContentTime->CurrentValue, 4));

			// InstitutionName
			$patient_detail->InstitutionName->EditCustomAttributes = "";
			$patient_detail->InstitutionName->EditValue = ew_HtmlEncode($patient_detail->InstitutionName->CurrentValue);

			// InstitutionAddress
			$patient_detail->InstitutionAddress->EditCustomAttributes = "";
			$patient_detail->InstitutionAddress->EditValue = ew_HtmlEncode($patient_detail->InstitutionAddress->CurrentValue);

			// InstitutionDepartmentName
			$patient_detail->InstitutionDepartmentName->EditCustomAttributes = "";
			$patient_detail->InstitutionDepartmentName->EditValue = ew_HtmlEncode($patient_detail->InstitutionDepartmentName->CurrentValue);

			// Modality
			$patient_detail->Modality->EditCustomAttributes = "";
			$patient_detail->Modality->EditValue = ew_HtmlEncode($patient_detail->Modality->CurrentValue);

			// OperatorName
			$patient_detail->OperatorName->EditCustomAttributes = "";
			$patient_detail->OperatorName->EditValue = ew_HtmlEncode($patient_detail->OperatorName->CurrentValue);

			// Manufacturer
			$patient_detail->Manufacturer->EditCustomAttributes = "";
			$patient_detail->Manufacturer->EditValue = ew_HtmlEncode($patient_detail->Manufacturer->CurrentValue);

			// BodyPartExamined
			$patient_detail->BodyPartExamined->EditCustomAttributes = "";
			$patient_detail->BodyPartExamined->EditValue = ew_HtmlEncode($patient_detail->BodyPartExamined->CurrentValue);

			// ProtocolName
			$patient_detail->ProtocolName->EditCustomAttributes = "";
			$patient_detail->ProtocolName->EditValue = ew_HtmlEncode($patient_detail->ProtocolName->CurrentValue);

			// AccessionNumber
			$patient_detail->AccessionNumber->EditCustomAttributes = "";
			$patient_detail->AccessionNumber->EditValue = ew_HtmlEncode($patient_detail->AccessionNumber->CurrentValue);

			// InstanceNumber
			$patient_detail->InstanceNumber->EditCustomAttributes = "";
			$patient_detail->InstanceNumber->EditValue = ew_HtmlEncode($patient_detail->InstanceNumber->CurrentValue);

			// Status
			$patient_detail->Status->EditCustomAttributes = "";
			$patient_detail->Status->EditValue = ew_HtmlEncode($patient_detail->Status->CurrentValue);
		}

		// Call Row Rendered event
		$patient_detail->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $patient_detail;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($patient_detail->StudyID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Study ID";
		}
		if ($patient_detail->PatientID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Patient ID";
		}
		if (!ew_CheckDate($patient_detail->StudyDate->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Study Date";
		}
		if (!ew_CheckDate($patient_detail->ContentDate->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Content Date";
		}
		if (!ew_CheckTime($patient_detail->StudyTime->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect time (hh:mm:ss) - Study Time";
		}
		if (!ew_CheckTime($patient_detail->ContentTime->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect time (hh:mm:ss) - Content Time";
		}
		if (!ew_CheckInteger($patient_detail->InstanceNumber->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Instance Number";
		}
		if ($patient_detail->Status->FormValue == "") {
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

	// Add record
	function AddRow() {
		global $conn, $Security, $patient_detail;
		$rsnew = array();

		// Field StudyID
		$patient_detail->StudyID->SetDbValueDef($patient_detail->StudyID->CurrentValue, "");
		$rsnew['StudyID'] =& $patient_detail->StudyID->DbValue;

		// Field PatientID
		$patient_detail->PatientID->SetDbValueDef($patient_detail->PatientID->CurrentValue, "");
		$rsnew['PatientID'] =& $patient_detail->PatientID->DbValue;

		// Field StudyDate
		$patient_detail->StudyDate->SetDbValueDef(ew_UnFormatDateTime($patient_detail->StudyDate->CurrentValue, 5), NULL);
		$rsnew['StudyDate'] =& $patient_detail->StudyDate->DbValue;

		// Field ContentDate
		$patient_detail->ContentDate->SetDbValueDef(ew_UnFormatDateTime($patient_detail->ContentDate->CurrentValue, 5), NULL);
		$rsnew['ContentDate'] =& $patient_detail->ContentDate->DbValue;

		// Field StudyTime
		$patient_detail->StudyTime->SetDbValueDef(ew_FormatDateTime($patient_detail->StudyTime->CurrentValue, 4), NULL);
		$rsnew['StudyTime'] =& $patient_detail->StudyTime->DbValue;

		// Field ContentTime
		$patient_detail->ContentTime->SetDbValueDef(ew_FormatDateTime($patient_detail->ContentTime->CurrentValue, 4), NULL);
		$rsnew['ContentTime'] =& $patient_detail->ContentTime->DbValue;

		// Field InstitutionName
		$patient_detail->InstitutionName->SetDbValueDef($patient_detail->InstitutionName->CurrentValue, NULL);
		$rsnew['InstitutionName'] =& $patient_detail->InstitutionName->DbValue;

		// Field InstitutionAddress
		$patient_detail->InstitutionAddress->SetDbValueDef($patient_detail->InstitutionAddress->CurrentValue, NULL);
		$rsnew['InstitutionAddress'] =& $patient_detail->InstitutionAddress->DbValue;

		// Field InstitutionDepartmentName
		$patient_detail->InstitutionDepartmentName->SetDbValueDef($patient_detail->InstitutionDepartmentName->CurrentValue, NULL);
		$rsnew['InstitutionDepartmentName'] =& $patient_detail->InstitutionDepartmentName->DbValue;

		// Field Modality
		$patient_detail->Modality->SetDbValueDef($patient_detail->Modality->CurrentValue, NULL);
		$rsnew['Modality'] =& $patient_detail->Modality->DbValue;

		// Field OperatorName
		$patient_detail->OperatorName->SetDbValueDef($patient_detail->OperatorName->CurrentValue, NULL);
		$rsnew['OperatorName'] =& $patient_detail->OperatorName->DbValue;

		// Field Manufacturer
		$patient_detail->Manufacturer->SetDbValueDef($patient_detail->Manufacturer->CurrentValue, NULL);
		$rsnew['Manufacturer'] =& $patient_detail->Manufacturer->DbValue;

		// Field BodyPartExamined
		$patient_detail->BodyPartExamined->SetDbValueDef($patient_detail->BodyPartExamined->CurrentValue, NULL);
		$rsnew['BodyPartExamined'] =& $patient_detail->BodyPartExamined->DbValue;

		// Field ProtocolName
		$patient_detail->ProtocolName->SetDbValueDef($patient_detail->ProtocolName->CurrentValue, NULL);
		$rsnew['ProtocolName'] =& $patient_detail->ProtocolName->DbValue;

		// Field AccessionNumber
		$patient_detail->AccessionNumber->SetDbValueDef($patient_detail->AccessionNumber->CurrentValue, NULL);
		$rsnew['AccessionNumber'] =& $patient_detail->AccessionNumber->DbValue;

		// Field InstanceNumber
		$patient_detail->InstanceNumber->SetDbValueDef($patient_detail->InstanceNumber->CurrentValue, NULL);
		$rsnew['InstanceNumber'] =& $patient_detail->InstanceNumber->DbValue;

		// Field Status
		$patient_detail->Status->SetDbValueDef($patient_detail->Status->CurrentValue, "");
		$rsnew['Status'] =& $patient_detail->Status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $patient_detail->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($patient_detail->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($patient_detail->CancelMessage <> "") {
				$this->setMessage($patient_detail->CancelMessage);
				$patient_detail->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$patient_detail->DetailNo->setDbValue($conn->Insert_ID());
			$rsnew['DetailNo'] =& $patient_detail->DetailNo->DbValue;

			// Call Row Inserted event
			$patient_detail->Row_Inserted($rsnew);
		}
		return $AddRow;
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
