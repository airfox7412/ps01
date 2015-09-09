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
$patient_main_delete = new cpatient_main_delete();
$Page =& $patient_main_delete;

// Page init processing
$patient_main_delete->Page_Init();

// Page main processing
$patient_main_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var patient_main_delete = new ew_Page("patient_main_delete");

// page properties
patient_main_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = patient_main_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
patient_main_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
patient_main_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
patient_main_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
$rs = $patient_main_delete->LoadRecordset();
$patient_main_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($patient_main_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$patient_main_delete->Page_Terminate("patient_main_list.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: Patient Main<br><br>
<a href="<?php echo $patient_main->getReturnUrl() ?>">Go Back</a></span></p>
<?php $patient_main_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="patient_main">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($patient_main_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $patient_main->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Patient Main No</td>
		<td valign="top">Patient ID</td>
		<td valign="top">Patient Name</td>
		<td valign="top">Patient Birth Date</td>
		<td valign="top">Patient Sex</td>
		<td valign="top">Other Patient ID</td>
	</tr>
	</thead>
	<tbody>
<?php
$patient_main_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$patient_main_delete->lRecCnt++;

	// Set row properties
	$patient_main->CssClass = "";
	$patient_main->CssStyle = "";
	$patient_main->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$patient_main_delete->LoadRowValues($rs);

	// Render row
	$patient_main_delete->RenderRow();
?>
	<tr<?php echo $patient_main->RowAttributes() ?>>
		<td<?php echo $patient_main->PatientMainNo->CellAttributes() ?>>
<div<?php echo $patient_main->PatientMainNo->ViewAttributes() ?>><?php echo $patient_main->PatientMainNo->ListViewValue() ?></div></td>
		<td<?php echo $patient_main->PatientID->CellAttributes() ?>>
<div<?php echo $patient_main->PatientID->ViewAttributes() ?>><?php echo $patient_main->PatientID->ListViewValue() ?></div></td>
		<td<?php echo $patient_main->PatientName->CellAttributes() ?>>
<div<?php echo $patient_main->PatientName->ViewAttributes() ?>><?php echo $patient_main->PatientName->ListViewValue() ?></div></td>
		<td<?php echo $patient_main->PatientBirthDate->CellAttributes() ?>>
<div<?php echo $patient_main->PatientBirthDate->ViewAttributes() ?>><?php echo $patient_main->PatientBirthDate->ListViewValue() ?></div></td>
		<td<?php echo $patient_main->PatientSex->CellAttributes() ?>>
<div<?php echo $patient_main->PatientSex->ViewAttributes() ?>><?php echo $patient_main->PatientSex->ListViewValue() ?></div></td>
		<td<?php echo $patient_main->OtherPatientID->CellAttributes() ?>>
<div<?php echo $patient_main->OtherPatientID->ViewAttributes() ?>><?php echo $patient_main->OtherPatientID->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="Confirm Delete">
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
class cpatient_main_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'patient_main';

	// Page Object Name
	var $PageObjName = 'patient_main_delete';

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
	function cpatient_main_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["patient_main"] = new cpatient_main();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $patient_main;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["PatientMainNo"] <> "") {
			$patient_main->PatientMainNo->setQueryStringValue($_GET["PatientMainNo"]);
			if (!is_numeric($patient_main->PatientMainNo->QueryStringValue))
				$this->Page_Terminate("patient_main_list.php"); // Prevent SQL injection, exit
			$sKey .= $patient_main->PatientMainNo->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("patient_main_list.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("patient_main_list.php"); // Prevent SQL injection, return to list
			$sFilter .= "`PatientMainNo`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in patient_main class, patient_maininfo.php

		$patient_main->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$patient_main->CurrentAction = $_POST["a_delete"];
		} else {
			$patient_main->CurrentAction = "I"; // Display record
		}
		switch ($patient_main->CurrentAction) {
			case "D": // Delete
				$patient_main->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($patient_main->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $patient_main;
		$DeleteRows = TRUE;
		$sWrkFilter = $patient_main->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in patient_main class, patient_maininfo.php

		$patient_main->CurrentFilter = $sWrkFilter;
		$sSql = $patient_main->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage("No records found"); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs) $rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $patient_main->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['PatientMainNo'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($patient_main->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($patient_main->CancelMessage <> "") {
				$this->setMessage($patient_main->CancelMessage);
				$patient_main->CancelMessage = "";
			} else {
				$this->setMessage("Delete cancelled");
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call recordset deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$patient_main->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
}
?>
