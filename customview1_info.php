<?php

// PHPMaker 6 configuration for Table CustomView1
$CustomView1 = NULL; // Initialize table object

// Define table class
class cCustomView1 {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $DetailNo;
	var $PatientID;
	var $StudyDate;
	var $StudyTime;
	var $PatientName;
	var $PatientSex;
	var $Modality;
	var $ProtocolName;
	var $BodyPartExamined;
	var $StudyID;
	var $InstanceNumber;
	var $Status;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function cCustomView1() {
		$this->TableVar = "CustomView1";
		$this->TableName = "CustomView1";
		$this->DetailNo = new cField('CustomView1', 'x_DetailNo', 'DetailNo', "patient_detail.DetailNo", 19, -1, FALSE);
		$this->fields['DetailNo'] =& $this->DetailNo;
		$this->PatientID = new cField('CustomView1', 'x_PatientID', 'PatientID', "patient_detail.PatientID", 200, -1, FALSE);
		$this->fields['PatientID'] =& $this->PatientID;
		$this->StudyDate = new cField('CustomView1', 'x_StudyDate', 'StudyDate', "patient_detail.StudyDate", 133, 5, FALSE);
		$this->fields['StudyDate'] =& $this->StudyDate;
		$this->StudyTime = new cField('CustomView1', 'x_StudyTime', 'StudyTime', "patient_detail.StudyTime", 134, -1, FALSE);
		$this->fields['StudyTime'] =& $this->StudyTime;
		$this->PatientName = new cField('CustomView1', 'x_PatientName', 'PatientName', "patient_main.PatientName", 200, -1, FALSE);
		$this->fields['PatientName'] =& $this->PatientName;
		$this->PatientSex = new cField('CustomView1', 'x_PatientSex', 'PatientSex', "patient_main.PatientSex", 200, -1, FALSE);
		$this->fields['PatientSex'] =& $this->PatientSex;
		$this->Modality = new cField('CustomView1', 'x_Modality', 'Modality', "patient_detail.Modality", 200, -1, FALSE);
		$this->fields['Modality'] =& $this->Modality;
		$this->ProtocolName = new cField('CustomView1', 'x_ProtocolName', 'ProtocolName', "patient_detail.ProtocolName", 200, -1, FALSE);
		$this->fields['ProtocolName'] =& $this->ProtocolName;
		$this->BodyPartExamined = new cField('CustomView1', 'x_BodyPartExamined', 'BodyPartExamined', "patient_detail.BodyPartExamined", 200, -1, FALSE);
		$this->fields['BodyPartExamined'] =& $this->BodyPartExamined;
		$this->StudyID = new cField('CustomView1', 'x_StudyID', 'StudyID', "patient_detail.StudyID", 200, -1, FALSE);
		$this->fields['StudyID'] =& $this->StudyID;
		$this->InstanceNumber = new cField('CustomView1', 'x_InstanceNumber', 'InstanceNumber', "patient_detail.InstanceNumber", 17, -1, FALSE);
		$this->fields['InstanceNumber'] =& $this->InstanceNumber;
		$this->Status = new cField('CustomView1', 'x_Status', 'Status', "patient_detail.Status", 200, -1, FALSE);
		$this->fields['Status'] =& $this->Status;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search Highlight Name
	function HighlightName() {
		return "CustomView1_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search Keyword
	function getBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic Search Type
	function getBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search where clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE Clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session Key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlSelect() { // Select
		return "SELECT patient_detail.PatientID, patient_detail.StudyDate, patient_detail.StudyTime, patient_main.PatientName, patient_main.PatientSex, patient_detail.Status, patient_detail.ProtocolName, patient_detail.BodyPartExamined, patient_detail.Modality, patient_detail.StudyID, patient_detail.DetailNo, patient_detail.InstanceNumber FROM patient_detail Inner Join patient_main On patient_detail.PatientID = patient_main.PatientID";
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "patient_detail.PatientID";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// SQL variables
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return table sql with list page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "($sFilter) AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return record count
	function SelectRecordCount() {
		global $conn;
		$cnt = -1;
		$sFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		if ($this->SelectLimit) {
			$sSelect = $this->SelectSQL();
			if (strtoupper(substr($sSelect, 0, 13)) == "SELECT * FROM") {
				$sSelect = "SELECT COUNT(*) FROM" . substr($sSelect, 13);
				if ($rs = $conn->Execute($sSelect)) {
					if (!$rs->EOF)
						$cnt = $rs->fields[0];
					$rs->Close();
				}
			}
		}
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $sFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= (is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO patient_detail Inner Join patient_main On patient_detail.PatientID = patient_main.PatientID ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE patient_detail Inner Join patient_main On patient_detail.PatientID = patient_main.PatientID SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=" .
					(is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM patient_detail Inner Join patient_main On patient_detail.PatientID = patient_main.PatientID WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'DetailNo' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['DetailNo'], $this->DetailNo->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "patient_detail.DetailNo = @DetailNo@";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->DetailNo->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@DetailNo@", ew_AdjustSql($this->DetailNo->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return url
	function getReturnUrl() {

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] <> "") {
			return $_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL];
		} else {
			return "customview1_list.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("customview1_view.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "customview1_add.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("customview1_edit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("customview1_add.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("customview1_delete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->DetailNo->CurrentValue)) {
			$sUrl .= "DetailNo=" . urlencode($this->DetailNo->CurrentValue);
		} else {
			return "javascript:alert('Invalid Record! Key is null');";
		}
		return $sUrl;
	}

	// Sort Url
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			($fld->FldType == 205)) { // Unsortable data type
			return "";
		} else {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		}
	}

	// URL parm
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=CustomView1" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Function LoadRs
	// - Load rows based on filter
	function LoadRs($sFilter) {
		global $conn;

		// Set up filter (Sql Where Clause) and get Return Sql
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->DetailNo->setDbValue($rs->fields('DetailNo'));
		$this->PatientID->setDbValue($rs->fields('PatientID'));
		$this->StudyDate->setDbValue($rs->fields('StudyDate'));
		$this->StudyTime->setDbValue($rs->fields('StudyTime'));
		$this->PatientName->setDbValue($rs->fields('PatientName'));
		$this->PatientSex->setDbValue($rs->fields('PatientSex'));
		$this->Modality->setDbValue($rs->fields('Modality'));
		$this->ProtocolName->setDbValue($rs->fields('ProtocolName'));
		$this->BodyPartExamined->setDbValue($rs->fields('BodyPartExamined'));
		$this->StudyID->setDbValue($rs->fields('StudyID'));
		$this->InstanceNumber->setDbValue($rs->fields('InstanceNumber'));
		$this->Status->setDbValue($rs->fields('Status'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

		// DetailNo
		$this->DetailNo->ViewValue = $this->DetailNo->CurrentValue;
		$this->DetailNo->CssStyle = "";
		$this->DetailNo->CssClass = "";
		$this->DetailNo->ViewCustomAttributes = "";

		// PatientID
		$this->PatientID->ViewValue = $this->PatientID->CurrentValue;
		$this->PatientID->CssStyle = "";
		$this->PatientID->CssClass = "";
		$this->PatientID->ViewCustomAttributes = "";

		// StudyDate
		$this->StudyDate->ViewValue = $this->StudyDate->CurrentValue;
		$this->StudyDate->ViewValue = ew_FormatDateTime($this->StudyDate->ViewValue, 5);
		$this->StudyDate->CssStyle = "";
		$this->StudyDate->CssClass = "";
		$this->StudyDate->ViewCustomAttributes = "";

		// StudyTime
		$this->StudyTime->ViewValue = $this->StudyTime->CurrentValue;
		$this->StudyTime->ViewValue = ew_FormatDateTime($this->StudyTime->ViewValue, 4);
		$this->StudyTime->CssStyle = "";
		$this->StudyTime->CssClass = "";
		$this->StudyTime->ViewCustomAttributes = "";

		// PatientName
		$this->PatientName->ViewValue = $this->PatientName->CurrentValue;
		$this->PatientName->CssStyle = "";
		$this->PatientName->CssClass = "";
		$this->PatientName->ViewCustomAttributes = "";

		// PatientSex
		$this->PatientSex->ViewValue = $this->PatientSex->CurrentValue;
		$this->PatientSex->CssStyle = "";
		$this->PatientSex->CssClass = "";
		$this->PatientSex->ViewCustomAttributes = "";

		// Modality
		$this->Modality->ViewValue = $this->Modality->CurrentValue;
		$this->Modality->CssStyle = "";
		$this->Modality->CssClass = "";
		$this->Modality->ViewCustomAttributes = "";

		// ProtocolName
		$this->ProtocolName->ViewValue = $this->ProtocolName->CurrentValue;
		$this->ProtocolName->CssStyle = "";
		$this->ProtocolName->CssClass = "";
		$this->ProtocolName->ViewCustomAttributes = "";

		// BodyPartExamined
		$this->BodyPartExamined->ViewValue = $this->BodyPartExamined->CurrentValue;
		$this->BodyPartExamined->CssStyle = "";
		$this->BodyPartExamined->CssClass = "";
		$this->BodyPartExamined->ViewCustomAttributes = "";

		// StudyID
		$this->StudyID->ViewValue = $this->StudyID->CurrentValue;
		$this->StudyID->CssStyle = "";
		$this->StudyID->CssClass = "";
		$this->StudyID->ViewCustomAttributes = "";

		// InstanceNumber
		$this->InstanceNumber->ViewValue = $this->InstanceNumber->CurrentValue;
		$this->InstanceNumber->CssStyle = "";
		$this->InstanceNumber->CssClass = "";
		$this->InstanceNumber->ViewCustomAttributes = "";

		// Status
		$this->Status->ViewValue = $this->Status->CurrentValue;
		$this->Status->CssStyle = "";
		$this->Status->CssClass = "";
		$this->Status->ViewCustomAttributes = "";

		// DetailNo
		$this->DetailNo->HrefValue = "";

		// PatientID
		$this->PatientID->HrefValue = "";

		// StudyDate
		$this->StudyDate->HrefValue = "";

		// StudyTime
		$this->StudyTime->HrefValue = "";

		// PatientName
		$this->PatientName->HrefValue = "";

		// PatientSex
		$this->PatientSex->HrefValue = "";

		// Modality
		$this->Modality->HrefValue = "";

		// ProtocolName
		$this->ProtocolName->HrefValue = "";

		// BodyPartExamined
		$this->BodyPartExamined->HrefValue = "";

		// StudyID
		$this->StudyID->HrefValue = "";

		// InstanceNumber
		$this->InstanceNumber->HrefValue = "";

		// Status
		$this->Status->HrefValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $CurrentAction; // Current action
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $RowType; // Row Type
	var $CssClass; // Css class
	var $CssStyle; // Css style
	var $RowClientEvents; // Row client events

	// Row Attribute
	function RowAttributes() {
		$sAtt = "";
		if (trim($this->CssStyle) <> "") {
			$sAtt .= " style=\"" . trim($this->CssStyle) . "\"";
		}
		if (trim($this->CssClass) <> "") {
			$sAtt .= " class=\"" . trim($this->CssClass) . "\"";
		}
		if ($this->Export == "") {
			if (trim($this->RowClientEvents) <> "") {
				$sAtt .= " " . trim($this->RowClientEvents);
			}
		}
		return $sAtt;
	}

	// Field objects
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
