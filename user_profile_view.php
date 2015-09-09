<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "user_profile_info.php" ?>
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
$user_profile_view = new cuser_profile_view();
$Page =& $user_profile_view;

// Page init processing
$user_profile_view->Page_Init();

// Page main processing
$user_profile_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($user_profile->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var user_profile_view = new ew_Page("user_profile_view");

// page properties
user_profile_view.PageID = "view"; // page ID
var EW_PAGE_ID = user_profile_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
user_profile_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
user_profile_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
user_profile_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">View TABLE: User Profile
<br><br>
<?php if ($user_profile->Export == "") { ?>
<a href="user_profile_list.php">Back to List</a>&nbsp;
<a href="<?php echo $user_profile->AddUrl() ?>">Add</a>&nbsp;
<a href="<?php echo $user_profile->EditUrl() ?>">Edit</a>&nbsp;
<a href="<?php echo $user_profile->CopyUrl() ?>">Copy</a>&nbsp;
<a href="<?php echo $user_profile->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
</span></p>
<?php $user_profile_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($user_profile->UserProfileNo->Visible) { // UserProfileNo ?>
	<tr<?php echo $user_profile->UserProfileNo->RowAttributes ?>>
		<td class="ewTableHeader">User Profile No</td>
		<td<?php echo $user_profile->UserProfileNo->CellAttributes() ?>>
<div<?php echo $user_profile->UserProfileNo->ViewAttributes() ?>><?php echo $user_profile->UserProfileNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($user_profile->zUserID->Visible) { // UserID ?>
	<tr<?php echo $user_profile->zUserID->RowAttributes ?>>
		<td class="ewTableHeader">User ID</td>
		<td<?php echo $user_profile->zUserID->CellAttributes() ?>>
<div<?php echo $user_profile->zUserID->ViewAttributes() ?>><?php echo $user_profile->zUserID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($user_profile->UserUID->Visible) { // UserUID ?>
	<tr<?php echo $user_profile->UserUID->RowAttributes ?>>
		<td class="ewTableHeader">User UID</td>
		<td<?php echo $user_profile->UserUID->CellAttributes() ?>>
<div<?php echo $user_profile->UserUID->ViewAttributes() ?>><?php echo $user_profile->UserUID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($user_profile->PassWord->Visible) { // PassWord ?>
	<tr<?php echo $user_profile->PassWord->RowAttributes ?>>
		<td class="ewTableHeader">Pass Word</td>
		<td<?php echo $user_profile->PassWord->CellAttributes() ?>>
<div<?php echo $user_profile->PassWord->ViewAttributes() ?>><?php echo $user_profile->PassWord->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($user_profile->UserName->Visible) { // UserName ?>
	<tr<?php echo $user_profile->UserName->RowAttributes ?>>
		<td class="ewTableHeader">User Name</td>
		<td<?php echo $user_profile->UserName->CellAttributes() ?>>
<div<?php echo $user_profile->UserName->ViewAttributes() ?>><?php echo $user_profile->UserName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($user_profile->Level->Visible) { // Level ?>
	<tr<?php echo $user_profile->Level->RowAttributes ?>>
		<td class="ewTableHeader">Level</td>
		<td<?php echo $user_profile->Level->CellAttributes() ?>>
<div<?php echo $user_profile->Level->ViewAttributes() ?>><?php echo $user_profile->Level->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($user_profile->DepartNo->Visible) { // DepartNo ?>
	<tr<?php echo $user_profile->DepartNo->RowAttributes ?>>
		<td class="ewTableHeader">Depart No</td>
		<td<?php echo $user_profile->DepartNo->CellAttributes() ?>>
<div<?php echo $user_profile->DepartNo->ViewAttributes() ?>><?php echo $user_profile->DepartNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($user_profile->DepartNameC->Visible) { // DepartNameC ?>
	<tr<?php echo $user_profile->DepartNameC->RowAttributes ?>>
		<td class="ewTableHeader">Depart Name C</td>
		<td<?php echo $user_profile->DepartNameC->CellAttributes() ?>>
<div<?php echo $user_profile->DepartNameC->ViewAttributes() ?>><?php echo $user_profile->DepartNameC->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($user_profile->Status->Visible) { // Status ?>
	<tr<?php echo $user_profile->Status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $user_profile->Status->CellAttributes() ?>>
<div<?php echo $user_profile->Status->ViewAttributes() ?>><?php echo $user_profile->Status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($user_profile->Export == "") { ?>
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
class cuser_profile_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'user_profile';

	// Page Object Name
	var $PageObjName = 'user_profile_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $user_profile;
		if ($user_profile->UseTokenInUrl) $PageUrl .= "t=" . $user_profile->TableVar . "&"; // add page token
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
		global $objForm, $user_profile;
		if ($user_profile->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($user_profile->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($user_profile->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cuser_profile_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["user_profile"] = new cuser_profile();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'user_profile', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $user_profile;

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
		global $user_profile;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["UserProfileNo"] <> "") {
				$user_profile->UserProfileNo->setQueryStringValue($_GET["UserProfileNo"]);
			} else {
				$sReturnUrl = "user_profile_list.php"; // Return to list
			}

			// Get action
			$user_profile->CurrentAction = "I"; // Display form
			switch ($user_profile->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "user_profile_list.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "user_profile_list.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$user_profile->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $user_profile;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$user_profile->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$user_profile->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $user_profile->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$user_profile->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$user_profile->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$user_profile->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $user_profile;
		$sFilter = $user_profile->KeyFilter();

		// Call Row Selecting event
		$user_profile->Row_Selecting($sFilter);

		// Load sql based on filter
		$user_profile->CurrentFilter = $sFilter;
		$sSql = $user_profile->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$user_profile->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $user_profile;
		$user_profile->UserProfileNo->setDbValue($rs->fields('UserProfileNo'));
		$user_profile->zUserID->setDbValue($rs->fields('UserID'));
		$user_profile->UserUID->setDbValue($rs->fields('UserUID'));
		$user_profile->PassWord->setDbValue($rs->fields('PassWord'));
		$user_profile->UserName->setDbValue($rs->fields('UserName'));
		$user_profile->Level->setDbValue($rs->fields('Level'));
		$user_profile->DepartNo->setDbValue($rs->fields('DepartNo'));
		$user_profile->DepartNameC->setDbValue($rs->fields('DepartNameC'));
		$user_profile->Status->setDbValue($rs->fields('Status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $user_profile;

		// Call Row_Rendering event
		$user_profile->Row_Rendering();

		// Common render codes for all row types
		// UserProfileNo

		$user_profile->UserProfileNo->CellCssStyle = "";
		$user_profile->UserProfileNo->CellCssClass = "";

		// UserID
		$user_profile->zUserID->CellCssStyle = "";
		$user_profile->zUserID->CellCssClass = "";

		// UserUID
		$user_profile->UserUID->CellCssStyle = "";
		$user_profile->UserUID->CellCssClass = "";

		// PassWord
		$user_profile->PassWord->CellCssStyle = "";
		$user_profile->PassWord->CellCssClass = "";

		// UserName
		$user_profile->UserName->CellCssStyle = "";
		$user_profile->UserName->CellCssClass = "";

		// Level
		$user_profile->Level->CellCssStyle = "";
		$user_profile->Level->CellCssClass = "";

		// DepartNo
		$user_profile->DepartNo->CellCssStyle = "";
		$user_profile->DepartNo->CellCssClass = "";

		// DepartNameC
		$user_profile->DepartNameC->CellCssStyle = "";
		$user_profile->DepartNameC->CellCssClass = "";

		// Status
		$user_profile->Status->CellCssStyle = "";
		$user_profile->Status->CellCssClass = "";
		if ($user_profile->RowType == EW_ROWTYPE_VIEW) { // View row

			// UserProfileNo
			$user_profile->UserProfileNo->ViewValue = $user_profile->UserProfileNo->CurrentValue;
			$user_profile->UserProfileNo->CssStyle = "";
			$user_profile->UserProfileNo->CssClass = "";
			$user_profile->UserProfileNo->ViewCustomAttributes = "";

			// UserID
			$user_profile->zUserID->ViewValue = $user_profile->zUserID->CurrentValue;
			$user_profile->zUserID->CssStyle = "";
			$user_profile->zUserID->CssClass = "";
			$user_profile->zUserID->ViewCustomAttributes = "";

			// UserUID
			$user_profile->UserUID->ViewValue = $user_profile->UserUID->CurrentValue;
			$user_profile->UserUID->CssStyle = "";
			$user_profile->UserUID->CssClass = "";
			$user_profile->UserUID->ViewCustomAttributes = "";

			// PassWord
			$user_profile->PassWord->ViewValue = $user_profile->PassWord->CurrentValue;
			$user_profile->PassWord->CssStyle = "";
			$user_profile->PassWord->CssClass = "";
			$user_profile->PassWord->ViewCustomAttributes = "";

			// UserName
			$user_profile->UserName->ViewValue = $user_profile->UserName->CurrentValue;
			$user_profile->UserName->CssStyle = "";
			$user_profile->UserName->CssClass = "";
			$user_profile->UserName->ViewCustomAttributes = "";

			// Level
			$user_profile->Level->ViewValue = $user_profile->Level->CurrentValue;
			$user_profile->Level->CssStyle = "";
			$user_profile->Level->CssClass = "";
			$user_profile->Level->ViewCustomAttributes = "";

			// DepartNo
			$user_profile->DepartNo->ViewValue = $user_profile->DepartNo->CurrentValue;
			$user_profile->DepartNo->CssStyle = "";
			$user_profile->DepartNo->CssClass = "";
			$user_profile->DepartNo->ViewCustomAttributes = "";

			// DepartNameC
			$user_profile->DepartNameC->ViewValue = $user_profile->DepartNameC->CurrentValue;
			$user_profile->DepartNameC->CssStyle = "";
			$user_profile->DepartNameC->CssClass = "";
			$user_profile->DepartNameC->ViewCustomAttributes = "";

			// Status
			$user_profile->Status->ViewValue = $user_profile->Status->CurrentValue;
			$user_profile->Status->CssStyle = "";
			$user_profile->Status->CssClass = "";
			$user_profile->Status->ViewCustomAttributes = "";

			// UserProfileNo
			$user_profile->UserProfileNo->HrefValue = "";

			// UserID
			$user_profile->zUserID->HrefValue = "";

			// UserUID
			$user_profile->UserUID->HrefValue = "";

			// PassWord
			$user_profile->PassWord->HrefValue = "";

			// UserName
			$user_profile->UserName->HrefValue = "";

			// Level
			$user_profile->Level->HrefValue = "";

			// DepartNo
			$user_profile->DepartNo->HrefValue = "";

			// DepartNameC
			$user_profile->DepartNameC->HrefValue = "";

			// Status
			$user_profile->Status->HrefValue = "";
		}

		// Call Row Rendered event
		$user_profile->Row_Rendered();
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
