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
$patient_main_edit = new cpatient_main_edit();
$Page =& $patient_main_edit;

// Page init processing
$patient_main_edit->Page_Init();

// Page main processing
$patient_main_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var patient_main_edit = new ew_Page("patient_main_edit");

// page properties
patient_main_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = patient_main_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
patient_main_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_PatientID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Patient ID");
		elm = fobj.elements["x" + infix + "_PatientName"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Patient Name");
		elm = fobj.elements["x" + infix + "_PatientBirthDate"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Patient Birth Date");
		elm = fobj.elements["x" + infix + "_PatientSex"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Patient Sex");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
patient_main_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
patient_main_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
patient_main_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">Edit TABLE: Patient Main<br><br>
<a href="<?php echo $patient_main->getReturnUrl() ?>">Go Back</a></span></p>
<?php $patient_main_edit->ShowMessage() ?>
<form name="fpatient_mainedit" id="fpatient_mainedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return patient_main_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="patient_main">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($patient_main->PatientMainNo->Visible) { // PatientMainNo ?>
	<tr<?php echo $patient_main->PatientMainNo->RowAttributes ?>>
		<td class="ewTableHeader">Patient Main No</td>
		<td<?php echo $patient_main->PatientMainNo->CellAttributes() ?>><span id="el_PatientMainNo">
<div<?php echo $patient_main->PatientMainNo->ViewAttributes() ?>><?php echo $patient_main->PatientMainNo->EditValue ?></div><input type="hidden" name="x_PatientMainNo" id="x_PatientMainNo" value="<?php echo ew_HtmlEncode($patient_main->PatientMainNo->CurrentValue) ?>">
</span><?php echo $patient_main->PatientMainNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_main->PatientID->Visible) { // PatientID ?>
	<tr<?php echo $patient_main->PatientID->RowAttributes ?>>
		<td class="ewTableHeader">Patient ID<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $patient_main->PatientID->CellAttributes() ?>><span id="el_PatientID">
<input type="text" name="x_PatientID" id="x_PatientID" size="30" maxlength="20" value="<?php echo $patient_main->PatientID->EditValue ?>"<?php echo $patient_main->PatientID->EditAttributes() ?>>
</span><?php echo $patient_main->PatientID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_main->PatientName->Visible) { // PatientName ?>
	<tr<?php echo $patient_main->PatientName->RowAttributes ?>>
		<td class="ewTableHeader">Patient Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $patient_main->PatientName->CellAttributes() ?>><span id="el_PatientName">
<input type="text" name="x_PatientName" id="x_PatientName" size="30" maxlength="20" value="<?php echo $patient_main->PatientName->EditValue ?>"<?php echo $patient_main->PatientName->EditAttributes() ?>>
</span><?php echo $patient_main->PatientName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_main->PatientBirthDate->Visible) { // PatientBirthDate ?>
	<tr<?php echo $patient_main->PatientBirthDate->RowAttributes ?>>
		<td class="ewTableHeader">Patient Birth Date</td>
		<td<?php echo $patient_main->PatientBirthDate->CellAttributes() ?>><span id="el_PatientBirthDate">
<input type="text" name="x_PatientBirthDate" id="x_PatientBirthDate" value="<?php echo $patient_main->PatientBirthDate->EditValue ?>"<?php echo $patient_main->PatientBirthDate->EditAttributes() ?>>
</span><?php echo $patient_main->PatientBirthDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_main->PatientSex->Visible) { // PatientSex ?>
	<tr<?php echo $patient_main->PatientSex->RowAttributes ?>>
		<td class="ewTableHeader">Patient Sex<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $patient_main->PatientSex->CellAttributes() ?>><span id="el_PatientSex">
<input type="text" name="x_PatientSex" id="x_PatientSex" size="30" maxlength="10" value="<?php echo $patient_main->PatientSex->EditValue ?>"<?php echo $patient_main->PatientSex->EditAttributes() ?>>
</span><?php echo $patient_main->PatientSex->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($patient_main->OtherPatientID->Visible) { // OtherPatientID ?>
	<tr<?php echo $patient_main->OtherPatientID->RowAttributes ?>>
		<td class="ewTableHeader">Other Patient ID</td>
		<td<?php echo $patient_main->OtherPatientID->CellAttributes() ?>><span id="el_OtherPatientID">
<input type="text" name="x_OtherPatientID" id="x_OtherPatientID" size="30" maxlength="10" value="<?php echo $patient_main->OtherPatientID->EditValue ?>"<?php echo $patient_main->OtherPatientID->EditAttributes() ?>>
</span><?php echo $patient_main->OtherPatientID->CustomMsg ?></td>
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
class cpatient_main_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'patient_main';

	// Page Object Name
	var $PageObjName = 'patient_main_edit';

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
	function cpatient_main_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["patient_main"] = new cpatient_main();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $patient_main;

		// Load key from QueryString
		if (@$_GET["PatientMainNo"] <> "")
			$patient_main->PatientMainNo->setQueryStringValue($_GET["PatientMainNo"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$patient_main->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$patient_main->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$patient_main->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($patient_main->PatientMainNo->CurrentValue == "")
			$this->Page_Terminate("patient_main_list.php"); // Invalid key, return to list
		switch ($patient_main->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("patient_main_list.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$patient_main->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $patient_main->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$patient_main->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $patient_main;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $patient_main;
		$patient_main->PatientMainNo->setFormValue($objForm->GetValue("x_PatientMainNo"));
		$patient_main->PatientID->setFormValue($objForm->GetValue("x_PatientID"));
		$patient_main->PatientName->setFormValue($objForm->GetValue("x_PatientName"));
		$patient_main->PatientBirthDate->setFormValue($objForm->GetValue("x_PatientBirthDate"));
		$patient_main->PatientBirthDate->CurrentValue = ew_UnFormatDateTime($patient_main->PatientBirthDate->CurrentValue, 5);
		$patient_main->PatientSex->setFormValue($objForm->GetValue("x_PatientSex"));
		$patient_main->OtherPatientID->setFormValue($objForm->GetValue("x_OtherPatientID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $patient_main;
		$this->LoadRow();
		$patient_main->PatientMainNo->CurrentValue = $patient_main->PatientMainNo->FormValue;
		$patient_main->PatientID->CurrentValue = $patient_main->PatientID->FormValue;
		$patient_main->PatientName->CurrentValue = $patient_main->PatientName->FormValue;
		$patient_main->PatientBirthDate->CurrentValue = $patient_main->PatientBirthDate->FormValue;
		$patient_main->PatientBirthDate->CurrentValue = ew_UnFormatDateTime($patient_main->PatientBirthDate->CurrentValue, 5);
		$patient_main->PatientSex->CurrentValue = $patient_main->PatientSex->FormValue;
		$patient_main->OtherPatientID->CurrentValue = $patient_main->OtherPatientID->FormValue;
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
		} elseif ($patient_main->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// PatientMainNo
			$patient_main->PatientMainNo->EditCustomAttributes = "";
			$patient_main->PatientMainNo->EditValue = $patient_main->PatientMainNo->CurrentValue;
			$patient_main->PatientMainNo->CssStyle = "";
			$patient_main->PatientMainNo->CssClass = "";
			$patient_main->PatientMainNo->ViewCustomAttributes = "";

			// PatientID
			$patient_main->PatientID->EditCustomAttributes = "";
			$patient_main->PatientID->EditValue = ew_HtmlEncode($patient_main->PatientID->CurrentValue);

			// PatientName
			$patient_main->PatientName->EditCustomAttributes = "";
			$patient_main->PatientName->EditValue = ew_HtmlEncode($patient_main->PatientName->CurrentValue);

			// PatientBirthDate
			$patient_main->PatientBirthDate->EditCustomAttributes = "";
			$patient_main->PatientBirthDate->EditValue = ew_HtmlEncode(ew_FormatDateTime($patient_main->PatientBirthDate->CurrentValue, 5));

			// PatientSex
			$patient_main->PatientSex->EditCustomAttributes = "";
			$patient_main->PatientSex->EditValue = ew_HtmlEncode($patient_main->PatientSex->CurrentValue);

			// OtherPatientID
			$patient_main->OtherPatientID->EditCustomAttributes = "";
			$patient_main->OtherPatientID->EditValue = ew_HtmlEncode($patient_main->OtherPatientID->CurrentValue);

			// Edit refer script
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

	// Validate form
	function ValidateForm() {
		global $gsFormError, $patient_main;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($patient_main->PatientID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Patient ID";
		}
		if ($patient_main->PatientName->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Patient Name";
		}
		if (!ew_CheckDate($patient_main->PatientBirthDate->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Patient Birth Date";
		}
		if ($patient_main->PatientSex->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Patient Sex";
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
		global $conn, $Security, $patient_main;
		$sFilter = $patient_main->KeyFilter();
		$patient_main->CurrentFilter = $sFilter;
		$sSql = $patient_main->SQL();
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

			// Field PatientMainNo
			// Field PatientID

			$patient_main->PatientID->SetDbValueDef($patient_main->PatientID->CurrentValue, "");
			$rsnew['PatientID'] =& $patient_main->PatientID->DbValue;

			// Field PatientName
			$patient_main->PatientName->SetDbValueDef($patient_main->PatientName->CurrentValue, "");
			$rsnew['PatientName'] =& $patient_main->PatientName->DbValue;

			// Field PatientBirthDate
			$patient_main->PatientBirthDate->SetDbValueDef(ew_UnFormatDateTime($patient_main->PatientBirthDate->CurrentValue, 5), NULL);
			$rsnew['PatientBirthDate'] =& $patient_main->PatientBirthDate->DbValue;

			// Field PatientSex
			$patient_main->PatientSex->SetDbValueDef($patient_main->PatientSex->CurrentValue, "");
			$rsnew['PatientSex'] =& $patient_main->PatientSex->DbValue;

			// Field OtherPatientID
			$patient_main->OtherPatientID->SetDbValueDef($patient_main->OtherPatientID->CurrentValue, NULL);
			$rsnew['OtherPatientID'] =& $patient_main->OtherPatientID->DbValue;

			// Call Row Updating event
			$bUpdateRow = $patient_main->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($patient_main->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($patient_main->CancelMessage <> "") {
					$this->setMessage($patient_main->CancelMessage);
					$patient_main->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$patient_main->Row_Updated($rsold, $rsnew);
		$rs->Close();
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
