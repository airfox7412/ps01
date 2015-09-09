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
$institution_view = new cinstitution_view();
$Page =& $institution_view;

// Page init processing
$institution_view->Page_Init();

// Page main processing
$institution_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($institution->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var institution_view = new ew_Page("institution_view");

// page properties
institution_view.PageID = "view"; // page ID
var EW_PAGE_ID = institution_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
institution_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
institution_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
institution_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">View TABLE: Institution
<br><br>
<?php if ($institution->Export == "") { ?>
<a href="institution_list.php">Back to List</a>&nbsp;
<a href="<?php echo $institution->AddUrl() ?>">Add</a>&nbsp;
<a href="<?php echo $institution->EditUrl() ?>">Edit</a>&nbsp;
<a href="<?php echo $institution->CopyUrl() ?>">Copy</a>&nbsp;
<a href="<?php echo $institution->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
</span></p>
<?php $institution_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($institution->InstitutionNo->Visible) { // InstitutionNo ?>
	<tr<?php echo $institution->InstitutionNo->RowAttributes ?>>
		<td class="ewTableHeader">Institution No</td>
		<td<?php echo $institution->InstitutionNo->CellAttributes() ?>>
<div<?php echo $institution->InstitutionNo->ViewAttributes() ?>><?php echo $institution->InstitutionNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($institution->InstitutionName->Visible) { // InstitutionName ?>
	<tr<?php echo $institution->InstitutionName->RowAttributes ?>>
		<td class="ewTableHeader">Institution Name</td>
		<td<?php echo $institution->InstitutionName->CellAttributes() ?>>
<div<?php echo $institution->InstitutionName->ViewAttributes() ?>><?php echo $institution->InstitutionName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($institution->InstitutionNameE->Visible) { // InstitutionNameE ?>
	<tr<?php echo $institution->InstitutionNameE->RowAttributes ?>>
		<td class="ewTableHeader">Institution Name E</td>
		<td<?php echo $institution->InstitutionNameE->CellAttributes() ?>>
<div<?php echo $institution->InstitutionNameE->ViewAttributes() ?>><?php echo $institution->InstitutionNameE->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($institution->Status->Visible) { // Status ?>
	<tr<?php echo $institution->Status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $institution->Status->CellAttributes() ?>>
<div<?php echo $institution->Status->ViewAttributes() ?>><?php echo $institution->Status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($institution->Export == "") { ?>
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
class cinstitution_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'institution';

	// Page Object Name
	var $PageObjName = 'institution_view';

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
	function cinstitution_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["institution"] = new cinstitution();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		global $institution;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["InstitutionNo"] <> "") {
				$institution->InstitutionNo->setQueryStringValue($_GET["InstitutionNo"]);
			} else {
				$sReturnUrl = "institution_list.php"; // Return to list
			}

			// Get action
			$institution->CurrentAction = "I"; // Display form
			switch ($institution->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "institution_list.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "institution_list.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$institution->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $institution;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$institution->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$institution->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $institution->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$institution->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$institution->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$institution->setStartRecordNumber($this->lStartRec);
		}
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
