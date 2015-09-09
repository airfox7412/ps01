<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "institution_info.php" ?>
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
$institution_add = new cinstitution_add();
$Page =& $institution_add;

// Page init processing
$institution_add->Page_Init();

// Page main processing
$institution_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var institution_add = new ew_Page("institution_add");

// page properties
institution_add.PageID = "add"; // page ID
var EW_PAGE_ID = institution_add.PageID; // for backward compatibility

// extend page with ValidateForm function
institution_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_InstitutionNo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Institution No");
		elm = fobj.elements["x" + infix + "_InstitutionNo"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Institution No");
		elm = fobj.elements["x" + infix + "_InstitutionName"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Institution Name");
		elm = fobj.elements["x" + infix + "_Status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Status");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
institution_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
institution_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
institution_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">Add to TABLE: Institution<br><br>
<a href="<?php echo $institution->getReturnUrl() ?>">Go Back</a></span></p>
<?php $institution_add->ShowMessage() ?>
<form name="finstitutionadd" id="finstitutionadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return institution_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="institution">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($institution->InstitutionNo->Visible) { // InstitutionNo ?>
	<tr<?php echo $institution->InstitutionNo->RowAttributes ?>>
		<td class="ewTableHeader">Institution No<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $institution->InstitutionNo->CellAttributes() ?>><span id="el_InstitutionNo">
<input type="text" name="x_InstitutionNo" id="x_InstitutionNo" size="30" value="<?php echo $institution->InstitutionNo->EditValue ?>"<?php echo $institution->InstitutionNo->EditAttributes() ?>>
</span><?php echo $institution->InstitutionNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($institution->InstitutionName->Visible) { // InstitutionName ?>
	<tr<?php echo $institution->InstitutionName->RowAttributes ?>>
		<td class="ewTableHeader">Institution Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $institution->InstitutionName->CellAttributes() ?>><span id="el_InstitutionName">
<input type="text" name="x_InstitutionName" id="x_InstitutionName" size="30" maxlength="64" value="<?php echo $institution->InstitutionName->EditValue ?>"<?php echo $institution->InstitutionName->EditAttributes() ?>>
</span><?php echo $institution->InstitutionName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($institution->InstitutionNameE->Visible) { // InstitutionNameE ?>
	<tr<?php echo $institution->InstitutionNameE->RowAttributes ?>>
		<td class="ewTableHeader">Institution Name E</td>
		<td<?php echo $institution->InstitutionNameE->CellAttributes() ?>><span id="el_InstitutionNameE">
<input type="text" name="x_InstitutionNameE" id="x_InstitutionNameE" size="30" maxlength="64" value="<?php echo $institution->InstitutionNameE->EditValue ?>"<?php echo $institution->InstitutionNameE->EditAttributes() ?>>
</span><?php echo $institution->InstitutionNameE->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($institution->Status->Visible) { // Status ?>
	<tr<?php echo $institution->Status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $institution->Status->CellAttributes() ?>><span id="el_Status">
<input type="text" name="x_Status" id="x_Status" size="30" maxlength="1" value="<?php echo $institution->Status->EditValue ?>"<?php echo $institution->Status->EditAttributes() ?>>
</span><?php echo $institution->Status->CustomMsg ?></td>
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
class cinstitution_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'institution';

	// Page Object Name
	var $PageObjName = 'institution_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $institution;
		if ($institution->UseTokenInUrl) $PageUrl .= "t=" . $institution->TableVar . "&"; // add page token
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
		global $objForm, $institution;
		if ($institution->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($institution->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($institution->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cinstitution_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["institution"] = new cinstitution();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'institution', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $institution;

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
		global $objForm, $gsFormError, $institution;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["InstitutionNo"] != "") {
		  $institution->InstitutionNo->setQueryStringValue($_GET["InstitutionNo"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $institution->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$institution->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $institution->CurrentAction = "C"; // Copy Record
		  } else {
		    $institution->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($institution->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("institution_list.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$institution->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $institution->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$institution->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $institution;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $institution;
		$institution->InstitutionNo->CurrentValue = 0;
		$institution->Status->CurrentValue = "N";
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $institution;
		$institution->InstitutionNo->setFormValue($objForm->GetValue("x_InstitutionNo"));
		$institution->InstitutionName->setFormValue($objForm->GetValue("x_InstitutionName"));
		$institution->InstitutionNameE->setFormValue($objForm->GetValue("x_InstitutionNameE"));
		$institution->Status->setFormValue($objForm->GetValue("x_Status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $institution;
		$institution->InstitutionNo->CurrentValue = $institution->InstitutionNo->FormValue;
		$institution->InstitutionName->CurrentValue = $institution->InstitutionName->FormValue;
		$institution->InstitutionNameE->CurrentValue = $institution->InstitutionNameE->FormValue;
		$institution->Status->CurrentValue = $institution->Status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $institution;
		$sFilter = $institution->KeyFilter();

		// Call Row Selecting event
		$institution->Row_Selecting($sFilter);

		// Load sql based on filter
		$institution->CurrentFilter = $sFilter;
		$sSql = $institution->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$institution->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $institution;
		$institution->InstitutionNo->setDbValue($rs->fields('InstitutionNo'));
		$institution->InstitutionName->setDbValue($rs->fields('InstitutionName'));
		$institution->InstitutionNameE->setDbValue($rs->fields('InstitutionNameE'));
		$institution->Status->setDbValue($rs->fields('Status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $institution;

		// Call Row_Rendering event
		$institution->Row_Rendering();

		// Common render codes for all row types
		// InstitutionNo

		$institution->InstitutionNo->CellCssStyle = "";
		$institution->InstitutionNo->CellCssClass = "";

		// InstitutionName
		$institution->InstitutionName->CellCssStyle = "";
		$institution->InstitutionName->CellCssClass = "";

		// InstitutionNameE
		$institution->InstitutionNameE->CellCssStyle = "";
		$institution->InstitutionNameE->CellCssClass = "";

		// Status
		$institution->Status->CellCssStyle = "";
		$institution->Status->CellCssClass = "";
		if ($institution->RowType == EW_ROWTYPE_VIEW) { // View row

			// InstitutionNo
			$institution->InstitutionNo->ViewValue = $institution->InstitutionNo->CurrentValue;
			$institution->InstitutionNo->CssStyle = "";
			$institution->InstitutionNo->CssClass = "";
			$institution->InstitutionNo->ViewCustomAttributes = "";

			// InstitutionName
			$institution->InstitutionName->ViewValue = $institution->InstitutionName->CurrentValue;
			$institution->InstitutionName->CssStyle = "";
			$institution->InstitutionName->CssClass = "";
			$institution->InstitutionName->ViewCustomAttributes = "";

			// InstitutionNameE
			$institution->InstitutionNameE->ViewValue = $institution->InstitutionNameE->CurrentValue;
			$institution->InstitutionNameE->CssStyle = "";
			$institution->InstitutionNameE->CssClass = "";
			$institution->InstitutionNameE->ViewCustomAttributes = "";

			// Status
			$institution->Status->ViewValue = $institution->Status->CurrentValue;
			$institution->Status->CssStyle = "";
			$institution->Status->CssClass = "";
			$institution->Status->ViewCustomAttributes = "";

			// InstitutionNo
			$institution->InstitutionNo->HrefValue = "";

			// InstitutionName
			$institution->InstitutionName->HrefValue = "";

			// InstitutionNameE
			$institution->InstitutionNameE->HrefValue = "";

			// Status
			$institution->Status->HrefValue = "";
		} elseif ($institution->RowType == EW_ROWTYPE_ADD) { // Add row

			// InstitutionNo
			$institution->InstitutionNo->EditCustomAttributes = "";
			$institution->InstitutionNo->EditValue = ew_HtmlEncode($institution->InstitutionNo->CurrentValue);

			// InstitutionName
			$institution->InstitutionName->EditCustomAttributes = "";
			$institution->InstitutionName->EditValue = ew_HtmlEncode($institution->InstitutionName->CurrentValue);

			// InstitutionNameE
			$institution->InstitutionNameE->EditCustomAttributes = "";
			$institution->InstitutionNameE->EditValue = ew_HtmlEncode($institution->InstitutionNameE->CurrentValue);

			// Status
			$institution->Status->EditCustomAttributes = "";
			$institution->Status->EditValue = ew_HtmlEncode($institution->Status->CurrentValue);
		}

		// Call Row Rendered event
		$institution->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $institution;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($institution->InstitutionNo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Institution No";
		}
		if (!ew_CheckInteger($institution->InstitutionNo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Institution No";
		}
		if ($institution->InstitutionName->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Institution Name";
		}
		if ($institution->Status->FormValue == "") {
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
		global $conn, $Security, $institution;

		// Check if key value entered
		if ($institution->InstitutionNo->CurrentValue == "") {
			$this->setMessage("Invalid key value");
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $institution->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $institution->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, "Duplicate primary key: '%f'");
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Field InstitutionNo
		$institution->InstitutionNo->SetDbValueDef($institution->InstitutionNo->CurrentValue, 0);
		$rsnew['InstitutionNo'] =& $institution->InstitutionNo->DbValue;

		// Field InstitutionName
		$institution->InstitutionName->SetDbValueDef($institution->InstitutionName->CurrentValue, "");
		$rsnew['InstitutionName'] =& $institution->InstitutionName->DbValue;

		// Field InstitutionNameE
		$institution->InstitutionNameE->SetDbValueDef($institution->InstitutionNameE->CurrentValue, NULL);
		$rsnew['InstitutionNameE'] =& $institution->InstitutionNameE->DbValue;

		// Field Status
		$institution->Status->SetDbValueDef($institution->Status->CurrentValue, "");
		$rsnew['Status'] =& $institution->Status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $institution->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($institution->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($institution->CancelMessage <> "") {
				$this->setMessage($institution->CancelMessage);
				$institution->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$institution->Row_Inserted($rsnew);
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
