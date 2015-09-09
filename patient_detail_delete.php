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
$patient_detail_delete = new cpatient_detail_delete();
$Page =& $patient_detail_delete;

// Page init processing
$patient_detail_delete->Page_Init();

// Page main processing
$patient_detail_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var patient_detail_delete = new ew_Page("patient_detail_delete");

// page properties
patient_detail_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = patient_detail_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
patient_detail_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
patient_detail_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
patient_detail_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $patient_detail_delete->LoadRecordset();
$patient_detail_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($patient_detail_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$patient_detail_delete->Page_Terminate("patient_detail_list.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: Patient Detail<br><br>
<a href="<?php echo $patient_detail->getReturnUrl() ?>">Go Back</a></span></p>
<?php $patient_detail_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="patient_detail">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($patient_detail_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $patient_detail->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Detail No</td>
		<td valign="top">Study ID</td>
		<td valign="top">Patient ID</td>
		<td valign="top">Study Date</td>
		<td valign="top">Content Date</td>
		<td valign="top">Study Time</td>
		<td valign="top">Content Time</td>
		<td valign="top">Modality</td>
		<td valign="top">Body Part Examined</td>
		<td valign="top">Protocol Name</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$patient_detail_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$patient_detail_delete->lRecCnt++;

	// Set row properties
	$patient_detail->CssClass = "";
	$patient_detail->CssStyle = "";
	$patient_detail->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$patient_detail_delete->LoadRowValues($rs);

	// Render row
	$patient_detail_delete->RenderRow();
?>
	<tr<?php echo $patient_detail->RowAttributes() ?>>
		<td<?php echo $patient_detail->DetailNo->CellAttributes() ?>>
<div<?php echo $patient_detail->DetailNo->ViewAttributes() ?>><?php echo $patient_detail->DetailNo->ListViewValue() ?></div></td>
		<td<?php echo $patient_detail->StudyID->CellAttributes() ?>>
<div<?php echo $patient_detail->StudyID->ViewAttributes() ?>><?php echo $patient_detail->StudyID->ListViewValue() ?></div></td>
		<td<?php echo $patient_detail->PatientID->CellAttributes() ?>>
<div<?php echo $patient_detail->PatientID->ViewAttributes() ?>><?php echo $patient_detail->PatientID->ListViewValue() ?></div></td>
		<td<?php echo $patient_detail->StudyDate->CellAttributes() ?>>
<div<?php echo $patient_detail->StudyDate->ViewAttributes() ?>><?php echo $patient_detail->StudyDate->ListViewValue() ?></div></td>
		<td<?php echo $patient_detail->ContentDate->CellAttributes() ?>>
<div<?php echo $patient_detail->ContentDate->ViewAttributes() ?>><?php echo $patient_detail->ContentDate->ListViewValue() ?></div></td>
		<td<?php echo $patient_detail->StudyTime->CellAttributes() ?>>
<div<?php echo $patient_detail->StudyTime->ViewAttributes() ?>><?php echo $patient_detail->StudyTime->ListViewValue() ?></div></td>
		<td<?php echo $patient_detail->ContentTime->CellAttributes() ?>>
<div<?php echo $patient_detail->ContentTime->ViewAttributes() ?>><?php echo $patient_detail->ContentTime->ListViewValue() ?></div></td>
		<td<?php echo $patient_detail->Modality->CellAttributes() ?>>
<div<?php echo $patient_detail->Modality->ViewAttributes() ?>><?php echo $patient_detail->Modality->ListViewValue() ?></div></td>
		<td<?php echo $patient_detail->BodyPartExamined->CellAttributes() ?>>
<div<?php echo $patient_detail->BodyPartExamined->ViewAttributes() ?>><?php echo $patient_detail->BodyPartExamined->ListViewValue() ?></div></td>
		<td<?php echo $patient_detail->ProtocolName->CellAttributes() ?>>
<div<?php echo $patient_detail->ProtocolName->ViewAttributes() ?>><?php echo $patient_detail->ProtocolName->ListViewValue() ?></div></td>
		<td<?php echo $patient_detail->Status->CellAttributes() ?>>
<div<?php echo $patient_detail->Status->ViewAttributes() ?>><?php echo $patient_detail->Status->ListViewValue() ?></div></td>
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
class cpatient_detail_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'patient_detail';

	// Page Object Name
	var $PageObjName = 'patient_detail_delete';

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
	function cpatient_detail_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["patient_detail"] = new cpatient_detail();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $patient_detail;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["DetailNo"] <> "") {
			$patient_detail->DetailNo->setQueryStringValue($_GET["DetailNo"]);
			if (!is_numeric($patient_detail->DetailNo->QueryStringValue))
				$this->Page_Terminate("patient_detail_list.php"); // Prevent SQL injection, exit
			$sKey .= $patient_detail->DetailNo->QueryStringValue;
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
			$this->Page_Terminate("patient_detail_list.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("patient_detail_list.php"); // Prevent SQL injection, return to list
			$sFilter .= "`DetailNo`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in patient_detail class, patient_detailinfo.php

		$patient_detail->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$patient_detail->CurrentAction = $_POST["a_delete"];
		} else {
			$patient_detail->CurrentAction = "I"; // Display record
		}
		switch ($patient_detail->CurrentAction) {
			case "D": // Delete
				$patient_detail->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($patient_detail->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $patient_detail;
		$DeleteRows = TRUE;
		$sWrkFilter = $patient_detail->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in patient_detail class, patient_detailinfo.php

		$patient_detail->CurrentFilter = $sWrkFilter;
		$sSql = $patient_detail->SQL();
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
				$DeleteRows = $patient_detail->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['DetailNo'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($patient_detail->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($patient_detail->CancelMessage <> "") {
				$this->setMessage($patient_detail->CancelMessage);
				$patient_detail->CancelMessage = "";
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
				$patient_detail->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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

		// ContentDate
		$patient_detail->ContentDate->CellCssStyle = "";
		$patient_detail->ContentDate->CellCssClass = "";

		// StudyTime
		$patient_detail->StudyTime->CellCssStyle = "";
		$patient_detail->StudyTime->CellCssClass = "";

		// ContentTime
		$patient_detail->ContentTime->CellCssStyle = "";
		$patient_detail->ContentTime->CellCssClass = "";

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

			// ContentDate
			$patient_detail->ContentDate->HrefValue = "";

			// StudyTime
			$patient_detail->StudyTime->HrefValue = "";

			// ContentTime
			$patient_detail->ContentTime->HrefValue = "";

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
}
?>
