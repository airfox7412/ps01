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
$institution_delete = new cinstitution_delete();
$Page =& $institution_delete;

// Page init processing
$institution_delete->Page_Init();

// Page main processing
$institution_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var institution_delete = new ew_Page("institution_delete");

// page properties
institution_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = institution_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
institution_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
institution_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
institution_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $institution_delete->LoadRecordset();
$institution_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($institution_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$institution_delete->Page_Terminate("institution_list.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: Institution<br><br>
<a href="<?php echo $institution->getReturnUrl() ?>">Go Back</a></span></p>
<?php $institution_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="institution">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($institution_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $institution->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Institution No</td>
		<td valign="top">Institution Name</td>
		<td valign="top">Institution Name E</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$institution_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$institution_delete->lRecCnt++;

	// Set row properties
	$institution->CssClass = "";
	$institution->CssStyle = "";
	$institution->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$institution_delete->LoadRowValues($rs);

	// Render row
	$institution_delete->RenderRow();
?>
	<tr<?php echo $institution->RowAttributes() ?>>
		<td<?php echo $institution->InstitutionNo->CellAttributes() ?>>
<div<?php echo $institution->InstitutionNo->ViewAttributes() ?>><?php echo $institution->InstitutionNo->ListViewValue() ?></div></td>
		<td<?php echo $institution->InstitutionName->CellAttributes() ?>>
<div<?php echo $institution->InstitutionName->ViewAttributes() ?>><?php echo $institution->InstitutionName->ListViewValue() ?></div></td>
		<td<?php echo $institution->InstitutionNameE->CellAttributes() ?>>
<div<?php echo $institution->InstitutionNameE->ViewAttributes() ?>><?php echo $institution->InstitutionNameE->ListViewValue() ?></div></td>
		<td<?php echo $institution->Status->CellAttributes() ?>>
<div<?php echo $institution->Status->ViewAttributes() ?>><?php echo $institution->Status->ListViewValue() ?></div></td>
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
class cinstitution_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'institution';

	// Page Object Name
	var $PageObjName = 'institution_delete';

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
	function cinstitution_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["institution"] = new cinstitution();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $institution;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["InstitutionNo"] <> "") {
			$institution->InstitutionNo->setQueryStringValue($_GET["InstitutionNo"]);
			if (!is_numeric($institution->InstitutionNo->QueryStringValue))
				$this->Page_Terminate("institution_list.php"); // Prevent SQL injection, exit
			$sKey .= $institution->InstitutionNo->QueryStringValue;
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
			$this->Page_Terminate("institution_list.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("institution_list.php"); // Prevent SQL injection, return to list
			$sFilter .= "`InstitutionNo`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in institution class, institutioninfo.php

		$institution->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$institution->CurrentAction = $_POST["a_delete"];
		} else {
			$institution->CurrentAction = "I"; // Display record
		}
		switch ($institution->CurrentAction) {
			case "D": // Delete
				$institution->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($institution->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $institution;
		$DeleteRows = TRUE;
		$sWrkFilter = $institution->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in institution class, institutioninfo.php

		$institution->CurrentFilter = $sWrkFilter;
		$sSql = $institution->SQL();
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
				$DeleteRows = $institution->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['InstitutionNo'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($institution->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($institution->CancelMessage <> "") {
				$this->setMessage($institution->CancelMessage);
				$institution->CancelMessage = "";
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
				$institution->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $institution;

		// Call Recordset Selecting event
		$institution->Recordset_Selecting($institution->CurrentFilter);

		// Load list page SQL
		$sSql = $institution->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$institution->Recordset_Selected($rs);
		return $rs;
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
		}

		// Call Row Rendered event
		$institution->Row_Rendered();
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
