<?php

// PHPMaker 6 configuration for Table exam_data
$exam_data = NULL; // Initialize table object

// Define table class
class cexam_data {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $ExamDataNo;
	var $AccessionNumber;
	var $PatientMainNo;
	var $PatientID;
	var $InstitutionNo;
	var $ImageDetailNo;
	var $PatientKindNo;
	var $PatientSubKindNo;
	var $PatientTypeNo;
	var $PatientRoom;
	var $DepartmentNo;
	var $DepartmentName;
	var $Soap;
	var $RequestDoctorID;
	var $CodeValue;
	var $SpecialExamID;
	var $SpecialExamName;
	var $SpecialExamDate;
	var $ExamDate;
	var $ExamTime;
	var $LogDate;
	var $ModifyUser;
	var $ModifyDate;
	var $CreatePart;
	var $ModifyPart;
	var $Status;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function cexam_data() {
		$this->TableVar = "exam_data";
		$this->TableName = "exam_data";
		$this->SelectLimit = TRUE;
		$this->ExamDataNo = new cField('exam_data', 'x_ExamDataNo', 'ExamDataNo', "`ExamDataNo`", 20, -1, FALSE);
		$this->fields['ExamDataNo'] =& $this->ExamDataNo;
		$this->AccessionNumber = new cField('exam_data', 'x_AccessionNumber', 'AccessionNumber', "`AccessionNumber`", 200, -1, FALSE);
		$this->fields['AccessionNumber'] =& $this->AccessionNumber;
		$this->PatientMainNo = new cField('exam_data', 'x_PatientMainNo', 'PatientMainNo', "`PatientMainNo`", 20, -1, FALSE);
		$this->fields['PatientMainNo'] =& $this->PatientMainNo;
		$this->PatientID = new cField('exam_data', 'x_PatientID', 'PatientID', "`PatientID`", 200, -1, FALSE);
		$this->fields['PatientID'] =& $this->PatientID;
		$this->InstitutionNo = new cField('exam_data', 'x_InstitutionNo', 'InstitutionNo', "`InstitutionNo`", 3, -1, FALSE);
		$this->fields['InstitutionNo'] =& $this->InstitutionNo;
		$this->ImageDetailNo = new cField('exam_data', 'x_ImageDetailNo', 'ImageDetailNo', "`ImageDetailNo`", 20, -1, FALSE);
		$this->fields['ImageDetailNo'] =& $this->ImageDetailNo;
		$this->PatientKindNo = new cField('exam_data', 'x_PatientKindNo', 'PatientKindNo', "`PatientKindNo`", 3, -1, FALSE);
		$this->fields['PatientKindNo'] =& $this->PatientKindNo;
		$this->PatientSubKindNo = new cField('exam_data', 'x_PatientSubKindNo', 'PatientSubKindNo', "`PatientSubKindNo`", 3, -1, FALSE);
		$this->fields['PatientSubKindNo'] =& $this->PatientSubKindNo;
		$this->PatientTypeNo = new cField('exam_data', 'x_PatientTypeNo', 'PatientTypeNo', "`PatientTypeNo`", 3, -1, FALSE);
		$this->fields['PatientTypeNo'] =& $this->PatientTypeNo;
		$this->PatientRoom = new cField('exam_data', 'x_PatientRoom', 'PatientRoom', "`PatientRoom`", 200, -1, FALSE);
		$this->fields['PatientRoom'] =& $this->PatientRoom;
		$this->DepartmentNo = new cField('exam_data', 'x_DepartmentNo', 'DepartmentNo', "`DepartmentNo`", 3, -1, FALSE);
		$this->fields['DepartmentNo'] =& $this->DepartmentNo;
		$this->DepartmentName = new cField('exam_data', 'x_DepartmentName', 'DepartmentName', "`DepartmentName`", 200, -1, FALSE);
		$this->fields['DepartmentName'] =& $this->DepartmentName;
		$this->Soap = new cField('exam_data', 'x_Soap', 'Soap', "`Soap`", 205, -1, TRUE);
		$this->fields['Soap'] =& $this->Soap;
		$this->RequestDoctorID = new cField('exam_data', 'x_RequestDoctorID', 'RequestDoctorID', "`RequestDoctorID`", 200, -1, FALSE);
		$this->fields['RequestDoctorID'] =& $this->RequestDoctorID;
		$this->CodeValue = new cField('exam_data', 'x_CodeValue', 'CodeValue', "`CodeValue`", 200, -1, FALSE);
		$this->fields['CodeValue'] =& $this->CodeValue;
		$this->SpecialExamID = new cField('exam_data', 'x_SpecialExamID', 'SpecialExamID', "`SpecialExamID`", 200, -1, FALSE);
		$this->fields['SpecialExamID'] =& $this->SpecialExamID;
		$this->SpecialExamName = new cField('exam_data', 'x_SpecialExamName', 'SpecialExamName', "`SpecialExamName`", 200, -1, FALSE);
		$this->fields['SpecialExamName'] =& $this->SpecialExamName;
		$this->SpecialExamDate = new cField('exam_data', 'x_SpecialExamDate', 'SpecialExamDate', "`SpecialExamDate`", 135, 5, FALSE);
		$this->fields['SpecialExamDate'] =& $this->SpecialExamDate;
		$this->ExamDate = new cField('exam_data', 'x_ExamDate', 'ExamDate', "`ExamDate`", 133, 5, FALSE);
		$this->fields['ExamDate'] =& $this->ExamDate;
		$this->ExamTime = new cField('exam_data', 'x_ExamTime', 'ExamTime', "`ExamTime`", 134, -1, FALSE);
		$this->fields['ExamTime'] =& $this->ExamTime;
		$this->LogDate = new cField('exam_data', 'x_LogDate', 'LogDate', "`LogDate`", 135, 5, FALSE);
		$this->fields['LogDate'] =& $this->LogDate;
		$this->ModifyUser = new cField('exam_data', 'x_ModifyUser', 'ModifyUser', "`ModifyUser`", 200, -1, FALSE);
		$this->fields['ModifyUser'] =& $this->ModifyUser;
		$this->ModifyDate = new cField('exam_data', 'x_ModifyDate', 'ModifyDate', "`ModifyDate`", 135, 5, FALSE);
		$this->fields['ModifyDate'] =& $this->ModifyDate;
		$this->CreatePart = new cField('exam_data', 'x_CreatePart', 'CreatePart', "`CreatePart`", 200, -1, FALSE);
		$this->fields['CreatePart'] =& $this->CreatePart;
		$this->ModifyPart = new cField('exam_data', 'x_ModifyPart', 'ModifyPart', "`ModifyPart`", 200, -1, FALSE);
		$this->fields['ModifyPart'] =& $this->ModifyPart;
		$this->Status = new cField('exam_data', 'x_Status', 'Status', "`Status`", 200, -1, FALSE);
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
		return "exam_data_Highlight";
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
		return "SELECT * FROM `exam_data`";
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "";
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
		return "INSERT INTO `exam_data` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `exam_data` SET ";
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
		$SQL = "DELETE FROM `exam_data` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'ExamDataNo' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['ExamDataNo'], $this->ExamDataNo->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`ExamDataNo` = @ExamDataNo@";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->ExamDataNo->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@ExamDataNo@", ew_AdjustSql($this->ExamDataNo->CurrentValue), $sKeyFilter); // Replace key value
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
			return "exam_data_list.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("exam_data_view.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "exam_data_add.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("exam_data_edit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("exam_data_add.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("exam_data_delete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->ExamDataNo->CurrentValue)) {
			$sUrl .= "ExamDataNo=" . urlencode($this->ExamDataNo->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=exam_data" : "";
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
		$this->ExamDataNo->setDbValue($rs->fields('ExamDataNo'));
		$this->AccessionNumber->setDbValue($rs->fields('AccessionNumber'));
		$this->PatientMainNo->setDbValue($rs->fields('PatientMainNo'));
		$this->PatientID->setDbValue($rs->fields('PatientID'));
		$this->InstitutionNo->setDbValue($rs->fields('InstitutionNo'));
		$this->ImageDetailNo->setDbValue($rs->fields('ImageDetailNo'));
		$this->PatientKindNo->setDbValue($rs->fields('PatientKindNo'));
		$this->PatientSubKindNo->setDbValue($rs->fields('PatientSubKindNo'));
		$this->PatientTypeNo->setDbValue($rs->fields('PatientTypeNo'));
		$this->PatientRoom->setDbValue($rs->fields('PatientRoom'));
		$this->DepartmentNo->setDbValue($rs->fields('DepartmentNo'));
		$this->DepartmentName->setDbValue($rs->fields('DepartmentName'));
		$this->Soap->Upload->DbValue = $rs->fields('Soap');
		$this->RequestDoctorID->setDbValue($rs->fields('RequestDoctorID'));
		$this->CodeValue->setDbValue($rs->fields('CodeValue'));
		$this->SpecialExamID->setDbValue($rs->fields('SpecialExamID'));
		$this->SpecialExamName->setDbValue($rs->fields('SpecialExamName'));
		$this->SpecialExamDate->setDbValue($rs->fields('SpecialExamDate'));
		$this->ExamDate->setDbValue($rs->fields('ExamDate'));
		$this->ExamTime->setDbValue($rs->fields('ExamTime'));
		$this->LogDate->setDbValue($rs->fields('LogDate'));
		$this->ModifyUser->setDbValue($rs->fields('ModifyUser'));
		$this->ModifyDate->setDbValue($rs->fields('ModifyDate'));
		$this->CreatePart->setDbValue($rs->fields('CreatePart'));
		$this->ModifyPart->setDbValue($rs->fields('ModifyPart'));
		$this->Status->setDbValue($rs->fields('Status'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

		// ExamDataNo
		$this->ExamDataNo->ViewValue = $this->ExamDataNo->CurrentValue;
		$this->ExamDataNo->CssStyle = "";
		$this->ExamDataNo->CssClass = "";
		$this->ExamDataNo->ViewCustomAttributes = "";

		// AccessionNumber
		$this->AccessionNumber->ViewValue = $this->AccessionNumber->CurrentValue;
		$this->AccessionNumber->CssStyle = "";
		$this->AccessionNumber->CssClass = "";
		$this->AccessionNumber->ViewCustomAttributes = "";

		// PatientMainNo
		$this->PatientMainNo->ViewValue = $this->PatientMainNo->CurrentValue;
		$this->PatientMainNo->CssStyle = "";
		$this->PatientMainNo->CssClass = "";
		$this->PatientMainNo->ViewCustomAttributes = "";

		// PatientID
		$this->PatientID->ViewValue = $this->PatientID->CurrentValue;
		$this->PatientID->CssStyle = "";
		$this->PatientID->CssClass = "";
		$this->PatientID->ViewCustomAttributes = "";

		// InstitutionNo
		$this->InstitutionNo->ViewValue = $this->InstitutionNo->CurrentValue;
		$this->InstitutionNo->CssStyle = "";
		$this->InstitutionNo->CssClass = "";
		$this->InstitutionNo->ViewCustomAttributes = "";

		// ImageDetailNo
		$this->ImageDetailNo->ViewValue = $this->ImageDetailNo->CurrentValue;
		$this->ImageDetailNo->CssStyle = "";
		$this->ImageDetailNo->CssClass = "";
		$this->ImageDetailNo->ViewCustomAttributes = "";

		// PatientKindNo
		$this->PatientKindNo->ViewValue = $this->PatientKindNo->CurrentValue;
		$this->PatientKindNo->CssStyle = "";
		$this->PatientKindNo->CssClass = "";
		$this->PatientKindNo->ViewCustomAttributes = "";

		// PatientSubKindNo
		$this->PatientSubKindNo->ViewValue = $this->PatientSubKindNo->CurrentValue;
		$this->PatientSubKindNo->CssStyle = "";
		$this->PatientSubKindNo->CssClass = "";
		$this->PatientSubKindNo->ViewCustomAttributes = "";

		// PatientTypeNo
		$this->PatientTypeNo->ViewValue = $this->PatientTypeNo->CurrentValue;
		$this->PatientTypeNo->CssStyle = "";
		$this->PatientTypeNo->CssClass = "";
		$this->PatientTypeNo->ViewCustomAttributes = "";

		// PatientRoom
		$this->PatientRoom->ViewValue = $this->PatientRoom->CurrentValue;
		$this->PatientRoom->CssStyle = "";
		$this->PatientRoom->CssClass = "";
		$this->PatientRoom->ViewCustomAttributes = "";

		// DepartmentNo
		$this->DepartmentNo->ViewValue = $this->DepartmentNo->CurrentValue;
		$this->DepartmentNo->CssStyle = "";
		$this->DepartmentNo->CssClass = "";
		$this->DepartmentNo->ViewCustomAttributes = "";

		// DepartmentName
		$this->DepartmentName->ViewValue = $this->DepartmentName->CurrentValue;
		$this->DepartmentName->CssStyle = "";
		$this->DepartmentName->CssClass = "";
		$this->DepartmentName->ViewCustomAttributes = "";

		// RequestDoctorID
		$this->RequestDoctorID->ViewValue = $this->RequestDoctorID->CurrentValue;
		$this->RequestDoctorID->CssStyle = "";
		$this->RequestDoctorID->CssClass = "";
		$this->RequestDoctorID->ViewCustomAttributes = "";

		// CodeValue
		$this->CodeValue->ViewValue = $this->CodeValue->CurrentValue;
		$this->CodeValue->CssStyle = "";
		$this->CodeValue->CssClass = "";
		$this->CodeValue->ViewCustomAttributes = "";

		// SpecialExamID
		$this->SpecialExamID->ViewValue = $this->SpecialExamID->CurrentValue;
		$this->SpecialExamID->CssStyle = "";
		$this->SpecialExamID->CssClass = "";
		$this->SpecialExamID->ViewCustomAttributes = "";

		// SpecialExamName
		$this->SpecialExamName->ViewValue = $this->SpecialExamName->CurrentValue;
		$this->SpecialExamName->CssStyle = "";
		$this->SpecialExamName->CssClass = "";
		$this->SpecialExamName->ViewCustomAttributes = "";

		// SpecialExamDate
		$this->SpecialExamDate->ViewValue = $this->SpecialExamDate->CurrentValue;
		$this->SpecialExamDate->ViewValue = ew_FormatDateTime($this->SpecialExamDate->ViewValue, 5);
		$this->SpecialExamDate->CssStyle = "";
		$this->SpecialExamDate->CssClass = "";
		$this->SpecialExamDate->ViewCustomAttributes = "";

		// ExamDate
		$this->ExamDate->ViewValue = $this->ExamDate->CurrentValue;
		$this->ExamDate->ViewValue = ew_FormatDateTime($this->ExamDate->ViewValue, 5);
		$this->ExamDate->CssStyle = "";
		$this->ExamDate->CssClass = "";
		$this->ExamDate->ViewCustomAttributes = "";

		// ExamTime
		$this->ExamTime->ViewValue = $this->ExamTime->CurrentValue;
		$this->ExamTime->ViewValue = ew_FormatDateTime($this->ExamTime->ViewValue, 4);
		$this->ExamTime->CssStyle = "";
		$this->ExamTime->CssClass = "";
		$this->ExamTime->ViewCustomAttributes = "";

		// LogDate
		$this->LogDate->ViewValue = $this->LogDate->CurrentValue;
		$this->LogDate->ViewValue = ew_FormatDateTime($this->LogDate->ViewValue, 5);
		$this->LogDate->CssStyle = "";
		$this->LogDate->CssClass = "";
		$this->LogDate->ViewCustomAttributes = "";

		// ModifyUser
		$this->ModifyUser->ViewValue = $this->ModifyUser->CurrentValue;
		$this->ModifyUser->CssStyle = "";
		$this->ModifyUser->CssClass = "";
		$this->ModifyUser->ViewCustomAttributes = "";

		// ModifyDate
		$this->ModifyDate->ViewValue = $this->ModifyDate->CurrentValue;
		$this->ModifyDate->ViewValue = ew_FormatDateTime($this->ModifyDate->ViewValue, 5);
		$this->ModifyDate->CssStyle = "";
		$this->ModifyDate->CssClass = "";
		$this->ModifyDate->ViewCustomAttributes = "";

		// CreatePart
		$this->CreatePart->ViewValue = $this->CreatePart->CurrentValue;
		$this->CreatePart->CssStyle = "";
		$this->CreatePart->CssClass = "";
		$this->CreatePart->ViewCustomAttributes = "";

		// ModifyPart
		$this->ModifyPart->ViewValue = $this->ModifyPart->CurrentValue;
		$this->ModifyPart->CssStyle = "";
		$this->ModifyPart->CssClass = "";
		$this->ModifyPart->ViewCustomAttributes = "";

		// Status
		$this->Status->ViewValue = $this->Status->CurrentValue;
		$this->Status->CssStyle = "";
		$this->Status->CssClass = "";
		$this->Status->ViewCustomAttributes = "";

		// ExamDataNo
		$this->ExamDataNo->HrefValue = "";

		// AccessionNumber
		$this->AccessionNumber->HrefValue = "";

		// PatientMainNo
		$this->PatientMainNo->HrefValue = "";

		// PatientID
		$this->PatientID->HrefValue = "";

		// InstitutionNo
		$this->InstitutionNo->HrefValue = "";

		// ImageDetailNo
		$this->ImageDetailNo->HrefValue = "";

		// PatientKindNo
		$this->PatientKindNo->HrefValue = "";

		// PatientSubKindNo
		$this->PatientSubKindNo->HrefValue = "";

		// PatientTypeNo
		$this->PatientTypeNo->HrefValue = "";

		// PatientRoom
		$this->PatientRoom->HrefValue = "";

		// DepartmentNo
		$this->DepartmentNo->HrefValue = "";

		// DepartmentName
		$this->DepartmentName->HrefValue = "";

		// RequestDoctorID
		$this->RequestDoctorID->HrefValue = "";

		// CodeValue
		$this->CodeValue->HrefValue = "";

		// SpecialExamID
		$this->SpecialExamID->HrefValue = "";

		// SpecialExamName
		$this->SpecialExamName->HrefValue = "";

		// SpecialExamDate
		$this->SpecialExamDate->HrefValue = "";

		// ExamDate
		$this->ExamDate->HrefValue = "";

		// ExamTime
		$this->ExamTime->HrefValue = "";

		// LogDate
		$this->LogDate->HrefValue = "";

		// ModifyUser
		$this->ModifyUser->HrefValue = "";

		// ModifyDate
		$this->ModifyDate->HrefValue = "";

		// CreatePart
		$this->CreatePart->HrefValue = "";

		// ModifyPart
		$this->ModifyPart->HrefValue = "";

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
