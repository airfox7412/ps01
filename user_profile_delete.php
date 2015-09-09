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
$user_profile_delete = new cuser_profile_delete();
$Page =& $user_profile_delete;

// Page init processing
$user_profile_delete->Page_Init();

// Page main processing
$user_profile_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var user_profile_delete = new ew_Page("user_profile_delete");

// page properties
user_profile_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = user_profile_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
user_profile_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
user_profile_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
user_profile_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $user_profile_delete->LoadRecordset();
$user_profile_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($user_profile_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$user_profile_delete->Page_Terminate("user_profile_list.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: User Profile<br><br>
<a href="<?php echo $user_profile->getReturnUrl() ?>">Go Back</a></span></p>
<?php $user_profile_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="user_profile">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($user_profile_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $user_profile->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">User Profile No</td>
		<td valign="top">User ID</td>
		<td valign="top">User UID</td>
		<td valign="top">Pass Word</td>
		<td valign="top">User Name</td>
		<td valign="top">Level</td>
		<td valign="top">Depart No</td>
		<td valign="top">Depart Name C</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$user_profile_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$user_profile_delete->lRecCnt++;

	// Set row properties
	$user_profile->CssClass = "";
	$user_profile->CssStyle = "";
	$user_profile->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$user_profile_delete->LoadRowValues($rs);

	// Render row
	$user_profile_delete->RenderRow();
?>
	<tr<?php echo $user_profile->RowAttributes() ?>>
		<td<?php echo $user_profile->UserProfileNo->CellAttributes() ?>>
<div<?php echo $user_profile->UserProfileNo->ViewAttributes() ?>><?php echo $user_profile->UserProfileNo->ListViewValue() ?></div></td>
		<td<?php echo $user_profile->zUserID->CellAttributes() ?>>
<div<?php echo $user_profile->zUserID->ViewAttributes() ?>><?php echo $user_profile->zUserID->ListViewValue() ?></div></td>
		<td<?php echo $user_profile->UserUID->CellAttributes() ?>>
<div<?php echo $user_profile->UserUID->ViewAttributes() ?>><?php echo $user_profile->UserUID->ListViewValue() ?></div></td>
		<td<?php echo $user_profile->PassWord->CellAttributes() ?>>
<div<?php echo $user_profile->PassWord->ViewAttributes() ?>><?php echo $user_profile->PassWord->ListViewValue() ?></div></td>
		<td<?php echo $user_profile->UserName->CellAttributes() ?>>
<div<?php echo $user_profile->UserName->ViewAttributes() ?>><?php echo $user_profile->UserName->ListViewValue() ?></div></td>
		<td<?php echo $user_profile->Level->CellAttributes() ?>>
<div<?php echo $user_profile->Level->ViewAttributes() ?>><?php echo $user_profile->Level->ListViewValue() ?></div></td>
		<td<?php echo $user_profile->DepartNo->CellAttributes() ?>>
<div<?php echo $user_profile->DepartNo->ViewAttributes() ?>><?php echo $user_profile->DepartNo->ListViewValue() ?></div></td>
		<td<?php echo $user_profile->DepartNameC->CellAttributes() ?>>
<div<?php echo $user_profile->DepartNameC->ViewAttributes() ?>><?php echo $user_profile->DepartNameC->ListViewValue() ?></div></td>
		<td<?php echo $user_profile->Status->CellAttributes() ?>>
<div<?php echo $user_profile->Status->ViewAttributes() ?>><?php echo $user_profile->Status->ListViewValue() ?></div></td>
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
class cuser_profile_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'user_profile';

	// Page Object Name
	var $PageObjName = 'user_profile_delete';

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
	function cuser_profile_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["user_profile"] = new cuser_profile();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $user_profile;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["UserProfileNo"] <> "") {
			$user_profile->UserProfileNo->setQueryStringValue($_GET["UserProfileNo"]);
			if (!is_numeric($user_profile->UserProfileNo->QueryStringValue))
				$this->Page_Terminate("user_profile_list.php"); // Prevent SQL injection, exit
			$sKey .= $user_profile->UserProfileNo->QueryStringValue;
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
			$this->Page_Terminate("user_profile_list.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("user_profile_list.php"); // Prevent SQL injection, return to list
			$sFilter .= "`UserProfileNo`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in user_profile class, user_profileinfo.php

		$user_profile->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$user_profile->CurrentAction = $_POST["a_delete"];
		} else {
			$user_profile->CurrentAction = "I"; // Display record
		}
		switch ($user_profile->CurrentAction) {
			case "D": // Delete
				$user_profile->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($user_profile->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $user_profile;
		$DeleteRows = TRUE;
		$sWrkFilter = $user_profile->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in user_profile class, user_profileinfo.php

		$user_profile->CurrentFilter = $sWrkFilter;
		$sSql = $user_profile->SQL();
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
				$DeleteRows = $user_profile->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['UserProfileNo'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($user_profile->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($user_profile->CancelMessage <> "") {
				$this->setMessage($user_profile->CancelMessage);
				$user_profile->CancelMessage = "";
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
				$user_profile->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $user_profile;

		// Call Recordset Selecting event
		$user_profile->Recordset_Selecting($user_profile->CurrentFilter);

		// Load list page SQL
		$sSql = $user_profile->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$user_profile->Recordset_Selected($rs);
		return $rs;
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
