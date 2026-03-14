<?php
$tdatahalls = array();
$tdatahalls[".searchableFields"] = array();
$tdatahalls[".ShortName"] = "halls";
$tdatahalls[".OwnerID"] = "";
$tdatahalls[".OriginalTable"] = "halls";


$tdatahalls[".pagesByType"] = my_json_decode( "{}" );
$tdatahalls[".originalPagesByType"] = $tdatahalls[".pagesByType"];
$tdatahalls[".pages"] = types2pages( my_json_decode( "{}" ) );
$tdatahalls[".originalPages"] = $tdatahalls[".pages"];
$tdatahalls[".defaultPages"] = my_json_decode( "{}" );
$tdatahalls[".originalDefaultPages"] = $tdatahalls[".defaultPages"];

//	field labels
$fieldLabelshalls = array();
$fieldToolTipshalls = array();
$pageTitleshalls = array();
$placeHoldershalls = array();

if(mlang_getcurrentlang()=="English")
{
	$fieldLabelshalls["English"] = array();
	$fieldToolTipshalls["English"] = array();
	$placeHoldershalls["English"] = array();
	$pageTitleshalls["English"] = array();
	$fieldLabelshalls["English"]["id"] = "Id";
	$fieldToolTipshalls["English"]["id"] = "";
	$placeHoldershalls["English"]["id"] = "";
	$fieldLabelshalls["English"]["hall_id"] = "Hall Id";
	$fieldToolTipshalls["English"]["hall_id"] = "";
	$placeHoldershalls["English"]["hall_id"] = "";
	$fieldLabelshalls["English"]["hall_name"] = "Hall Name";
	$fieldToolTipshalls["English"]["hall_name"] = "";
	$placeHoldershalls["English"]["hall_name"] = "";
	$fieldLabelshalls["English"]["capacity"] = "Capacity";
	$fieldToolTipshalls["English"]["capacity"] = "";
	$placeHoldershalls["English"]["capacity"] = "";
	$fieldLabelshalls["English"]["location"] = "Location";
	$fieldToolTipshalls["English"]["location"] = "";
	$placeHoldershalls["English"]["location"] = "";
	$fieldLabelshalls["English"]["status"] = "Status";
	$fieldToolTipshalls["English"]["status"] = "";
	$placeHoldershalls["English"]["status"] = "";
	if (count($fieldToolTipshalls["English"]))
		$tdatahalls[".isUseToolTips"] = true;
}


	$tdatahalls[".NCSearch"] = true;



$tdatahalls[".shortTableName"] = "halls";
$tdatahalls[".nSecOptions"] = 0;

$tdatahalls[".mainTableOwnerID"] = "";
$tdatahalls[".entityType"] = 0;
$tdatahalls[".connId"] = "reservation_at_localhost";


$tdatahalls[".strOriginalTableName"] = "halls";

		 



$tdatahalls[".showAddInPopup"] = false;

$tdatahalls[".showEditInPopup"] = false;

$tdatahalls[".showViewInPopup"] = false;

$tdatahalls[".listAjax"] = false;
//	temporary
//$tdatahalls[".listAjax"] = false;

	$tdatahalls[".audit"] = true;

	$tdatahalls[".locking"] = false;


$pages = $tdatahalls[".defaultPages"];

if( $pages[PAGE_EDIT] ) {
	$tdatahalls[".edit"] = true;
	$tdatahalls[".afterEditAction"] = 1;
	$tdatahalls[".closePopupAfterEdit"] = 1;
	$tdatahalls[".afterEditActionDetTable"] = "";
}

if( $pages[PAGE_ADD] ) {
$tdatahalls[".add"] = true;
$tdatahalls[".afterAddAction"] = 1;
$tdatahalls[".closePopupAfterAdd"] = 1;
$tdatahalls[".afterAddActionDetTable"] = "";
}

if( $pages[PAGE_LIST] ) {
	$tdatahalls[".list"] = true;
}



$tdatahalls[".strSortControlSettingsJSON"] = "";




if( $pages[PAGE_VIEW] ) {
$tdatahalls[".view"] = true;
}

if( $pages[PAGE_IMPORT] ) {
$tdatahalls[".import"] = true;
}

if( $pages[PAGE_EXPORT] ) {
$tdatahalls[".exportTo"] = true;
}

if( $pages[PAGE_PRINT] ) {
$tdatahalls[".printFriendly"] = true;
}



$tdatahalls[".showSimpleSearchOptions"] = true; // temp fix #13449

// Allow Show/Hide Fields in GRID
$tdatahalls[".allowShowHideFields"] = true; // temp fix #13449
//

// Allow Fields Reordering in GRID
$tdatahalls[".allowFieldsReordering"] = true; // temp fix #13449
//

$tdatahalls[".isUseAjaxSuggest"] = true;





$tdatahalls[".ajaxCodeSnippetAdded"] = false;

$tdatahalls[".buttonsAdded"] = false;

$tdatahalls[".addPageEvents"] = false;

// use timepicker for search panel
$tdatahalls[".isUseTimeForSearch"] = false;


$tdatahalls[".badgeColor"] = "1E90FF";


$tdatahalls[".allSearchFields"] = array();
$tdatahalls[".filterFields"] = array();
$tdatahalls[".requiredSearchFields"] = array();

$tdatahalls[".googleLikeFields"] = array();
$tdatahalls[".googleLikeFields"][] = "id";
$tdatahalls[".googleLikeFields"][] = "hall_id";
$tdatahalls[".googleLikeFields"][] = "hall_name";
$tdatahalls[".googleLikeFields"][] = "capacity";
$tdatahalls[".googleLikeFields"][] = "location";
$tdatahalls[".googleLikeFields"][] = "status";



$tdatahalls[".tableType"] = "list";

$tdatahalls[".printerPageOrientation"] = 0;
$tdatahalls[".nPrinterPageScale"] = 100;

$tdatahalls[".nPrinterSplitRecords"] = 40;

$tdatahalls[".geocodingEnabled"] = false;










$tdatahalls[".pageSize"] = 20;

$tdatahalls[".warnLeavingPages"] = true;



$tstrOrderBy = "";
$tdatahalls[".strOrderBy"] = $tstrOrderBy;

$tdatahalls[".orderindexes"] = array();


$tdatahalls[".sqlHead"] = "SELECT id,  	hall_id,  	hall_name,  	capacity,  	location,  	status";
$tdatahalls[".sqlFrom"] = "FROM halls";
$tdatahalls[".sqlWhereExpr"] = "";
$tdatahalls[".sqlTail"] = "";










//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatahalls[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatahalls[".arrGroupsPerPage"] = $arrGPP;

$tdatahalls[".highlightSearchResults"] = true;

$tableKeyshalls = array();
$tableKeyshalls[] = "id";
$tdatahalls[".Keys"] = $tableKeyshalls;


$tdatahalls[".hideMobileList"] = array();




//	id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "id";
	$fdata["GoodName"] = "id";
	$fdata["ownerTable"] = "halls";
	$fdata["Label"] = GetFieldLabel("halls","id");
	$fdata["FieldType"] = 3;


		$fdata["AutoInc"] = true;

	
										

		$fdata["strField"] = "id";

		$fdata["sourceSingle"] = "id";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "id";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Text field");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



		$edata["IsRequired"] = true;

	
	
	
			$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
		
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
		
	
//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = false;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Contains";

			// the default search options list
				$fdata["searchOptionsList"] = array("Contains", "Equals", "Starts with", "More than", "Less than", "Between", "Empty", NOT_EMPTY);
// the end of search options settings


//Filters settings
	$fdata["filterTotals"] = 0;
		$fdata["filterMultiSelect"] = 0;
			$fdata["filterFormat"] = "Values list";
		$fdata["showCollapsed"] = false;

		$fdata["sortValueType"] = 0;
		$fdata["numberOfVisibleItems"] = 10;

		$fdata["filterBy"] = 0;

	

	
	
//end of Filters settings


	$tdatahalls["id"] = $fdata;
		$tdatahalls[".searchableFields"][] = "id";
//	hall_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "hall_id";
	$fdata["GoodName"] = "hall_id";
	$fdata["ownerTable"] = "halls";
	$fdata["Label"] = GetFieldLabel("halls","hall_id");
	$fdata["FieldType"] = 200;


	
	
										

		$fdata["strField"] = "hall_id";

		$fdata["sourceSingle"] = "hall_id";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "hall_id";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Text field");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";

		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = false;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Contains";

			// the default search options list
				$fdata["searchOptionsList"] = array("Contains", "Equals", "Starts with", "More than", "Less than", "Between", "Empty", NOT_EMPTY);
// the end of search options settings


//Filters settings
	$fdata["filterTotals"] = 0;
		$fdata["filterMultiSelect"] = 0;
			$fdata["filterFormat"] = "Values list";
		$fdata["showCollapsed"] = false;

		$fdata["sortValueType"] = 0;
		$fdata["numberOfVisibleItems"] = 10;

		$fdata["filterBy"] = 0;

	

	
	
//end of Filters settings


	$tdatahalls["hall_id"] = $fdata;
		$tdatahalls[".searchableFields"][] = "hall_id";
//	hall_name
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "hall_name";
	$fdata["GoodName"] = "hall_name";
	$fdata["ownerTable"] = "halls";
	$fdata["Label"] = GetFieldLabel("halls","hall_name");
	$fdata["FieldType"] = 200;


	
	
										

		$fdata["strField"] = "hall_name";

		$fdata["sourceSingle"] = "hall_name";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "hall_name";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Text field");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";

		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = false;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Contains";

			// the default search options list
				$fdata["searchOptionsList"] = array("Contains", "Equals", "Starts with", "More than", "Less than", "Between", "Empty", NOT_EMPTY);
// the end of search options settings


//Filters settings
	$fdata["filterTotals"] = 0;
		$fdata["filterMultiSelect"] = 0;
			$fdata["filterFormat"] = "Values list";
		$fdata["showCollapsed"] = false;

		$fdata["sortValueType"] = 0;
		$fdata["numberOfVisibleItems"] = 10;

		$fdata["filterBy"] = 0;

	

	
	
//end of Filters settings


	$tdatahalls["hall_name"] = $fdata;
		$tdatahalls[".searchableFields"][] = "hall_name";
//	capacity
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "capacity";
	$fdata["GoodName"] = "capacity";
	$fdata["ownerTable"] = "halls";
	$fdata["Label"] = GetFieldLabel("halls","capacity");
	$fdata["FieldType"] = 3;


	
	
										

		$fdata["strField"] = "capacity";

		$fdata["sourceSingle"] = "capacity";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "capacity";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Text field");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
		
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");
							
	
//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = false;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Contains";

			// the default search options list
				$fdata["searchOptionsList"] = array("Contains", "Equals", "Starts with", "More than", "Less than", "Between", "Empty", NOT_EMPTY);
// the end of search options settings


//Filters settings
	$fdata["filterTotals"] = 0;
		$fdata["filterMultiSelect"] = 0;
			$fdata["filterFormat"] = "Values list";
		$fdata["showCollapsed"] = false;

		$fdata["sortValueType"] = 0;
		$fdata["numberOfVisibleItems"] = 10;

		$fdata["filterBy"] = 0;

	

	
	
//end of Filters settings


	$tdatahalls["capacity"] = $fdata;
		$tdatahalls[".searchableFields"][] = "capacity";
//	location
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "location";
	$fdata["GoodName"] = "location";
	$fdata["ownerTable"] = "halls";
	$fdata["Label"] = GetFieldLabel("halls","location");
	$fdata["FieldType"] = 200;


	
	
										

		$fdata["strField"] = "location";

		$fdata["sourceSingle"] = "location";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "location";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Text field");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";

		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = false;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Contains";

			// the default search options list
				$fdata["searchOptionsList"] = array("Contains", "Equals", "Starts with", "More than", "Less than", "Between", "Empty", NOT_EMPTY);
// the end of search options settings


//Filters settings
	$fdata["filterTotals"] = 0;
		$fdata["filterMultiSelect"] = 0;
			$fdata["filterFormat"] = "Values list";
		$fdata["showCollapsed"] = false;

		$fdata["sortValueType"] = 0;
		$fdata["numberOfVisibleItems"] = 10;

		$fdata["filterBy"] = 0;

	

	
	
//end of Filters settings


	$tdatahalls["location"] = $fdata;
		$tdatahalls[".searchableFields"][] = "location";
//	status
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "status";
	$fdata["GoodName"] = "status";
	$fdata["ownerTable"] = "halls";
	$fdata["Label"] = GetFieldLabel("halls","status");
	$fdata["FieldType"] = 200;


	
	
										

		$fdata["strField"] = "status";

		$fdata["sourceSingle"] = "status";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "status";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Text field");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";

		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = false;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Contains";

			// the default search options list
				$fdata["searchOptionsList"] = array("Contains", "Equals", "Starts with", "More than", "Less than", "Between", "Empty", NOT_EMPTY);
// the end of search options settings


//Filters settings
	$fdata["filterTotals"] = 0;
		$fdata["filterMultiSelect"] = 0;
			$fdata["filterFormat"] = "Values list";
		$fdata["showCollapsed"] = false;

		$fdata["sortValueType"] = 0;
		$fdata["numberOfVisibleItems"] = 10;

		$fdata["filterBy"] = 0;

	

	
	
//end of Filters settings


	$tdatahalls["status"] = $fdata;
		$tdatahalls[".searchableFields"][] = "status";


$tables_data["halls"]=&$tdatahalls;
$field_labels["halls"] = &$fieldLabelshalls;
$fieldToolTips["halls"] = &$fieldToolTipshalls;
$placeHolders["halls"] = &$placeHoldershalls;
$page_titles["halls"] = &$pageTitleshalls;


changeTextControlsToDate( "halls" );

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)

//if !@TABLE.bReportCrossTab

$detailsTablesData["halls"] = array();
//endif

// tables which are master tables for current table (detail)
$masterTablesData["halls"] = array();



// -----------------end  prepare master-details data arrays ------------------------------//



require_once(getabspath("classes/sql.php"));











function createSqlQuery_halls()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id,  	hall_id,  	hall_name,  	capacity,  	location,  	status";
$proto0["m_strFrom"] = "FROM halls";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
	
					
;
						$proto0["cipherer"] = null;
$proto2=array();
$proto2["m_sql"] = "";
$proto2["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto2["m_column"]=$obj;
$proto2["m_contained"] = array();
$proto2["m_strCase"] = "";
$proto2["m_havingmode"] = false;
$proto2["m_inBrackets"] = false;
$proto2["m_useAlias"] = false;
$obj = new SQLLogicalExpr($proto2);

$proto0["m_where"] = $obj;
$proto4=array();
$proto4["m_sql"] = "";
$proto4["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto4["m_column"]=$obj;
$proto4["m_contained"] = array();
$proto4["m_strCase"] = "";
$proto4["m_havingmode"] = false;
$proto4["m_inBrackets"] = false;
$proto4["m_useAlias"] = false;
$obj = new SQLLogicalExpr($proto4);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto6=array();
			$obj = new SQLField(array(
	"m_strName" => "id",
	"m_strTable" => "halls",
	"m_srcTableName" => "halls"
));

$proto6["m_sql"] = "id";
$proto6["m_srcTableName"] = "halls";
$proto6["m_expr"]=$obj;
$proto6["m_alias"] = "";
$obj = new SQLFieldListItem($proto6);

$proto0["m_fieldlist"][]=$obj;
						$proto8=array();
			$obj = new SQLField(array(
	"m_strName" => "hall_id",
	"m_strTable" => "halls",
	"m_srcTableName" => "halls"
));

$proto8["m_sql"] = "hall_id";
$proto8["m_srcTableName"] = "halls";
$proto8["m_expr"]=$obj;
$proto8["m_alias"] = "";
$obj = new SQLFieldListItem($proto8);

$proto0["m_fieldlist"][]=$obj;
						$proto10=array();
			$obj = new SQLField(array(
	"m_strName" => "hall_name",
	"m_strTable" => "halls",
	"m_srcTableName" => "halls"
));

$proto10["m_sql"] = "hall_name";
$proto10["m_srcTableName"] = "halls";
$proto10["m_expr"]=$obj;
$proto10["m_alias"] = "";
$obj = new SQLFieldListItem($proto10);

$proto0["m_fieldlist"][]=$obj;
						$proto12=array();
			$obj = new SQLField(array(
	"m_strName" => "capacity",
	"m_strTable" => "halls",
	"m_srcTableName" => "halls"
));

$proto12["m_sql"] = "capacity";
$proto12["m_srcTableName"] = "halls";
$proto12["m_expr"]=$obj;
$proto12["m_alias"] = "";
$obj = new SQLFieldListItem($proto12);

$proto0["m_fieldlist"][]=$obj;
						$proto14=array();
			$obj = new SQLField(array(
	"m_strName" => "location",
	"m_strTable" => "halls",
	"m_srcTableName" => "halls"
));

$proto14["m_sql"] = "location";
$proto14["m_srcTableName"] = "halls";
$proto14["m_expr"]=$obj;
$proto14["m_alias"] = "";
$obj = new SQLFieldListItem($proto14);

$proto0["m_fieldlist"][]=$obj;
						$proto16=array();
			$obj = new SQLField(array(
	"m_strName" => "status",
	"m_strTable" => "halls",
	"m_srcTableName" => "halls"
));

$proto16["m_sql"] = "status";
$proto16["m_srcTableName"] = "halls";
$proto16["m_expr"]=$obj;
$proto16["m_alias"] = "";
$obj = new SQLFieldListItem($proto16);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto18=array();
$proto18["m_link"] = "SQLL_MAIN";
			$proto19=array();
$proto19["m_strName"] = "halls";
$proto19["m_srcTableName"] = "halls";
$proto19["m_columns"] = array();
$proto19["m_columns"][] = "id";
$proto19["m_columns"][] = "hall_id";
$proto19["m_columns"][] = "hall_name";
$proto19["m_columns"][] = "capacity";
$proto19["m_columns"][] = "location";
$proto19["m_columns"][] = "status";
$obj = new SQLTable($proto19);

$proto18["m_table"] = $obj;
$proto18["m_sql"] = "halls";
$proto18["m_alias"] = "";
$proto18["m_srcTableName"] = "halls";
$proto20=array();
$proto20["m_sql"] = "";
$proto20["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto20["m_column"]=$obj;
$proto20["m_contained"] = array();
$proto20["m_strCase"] = "";
$proto20["m_havingmode"] = false;
$proto20["m_inBrackets"] = false;
$proto20["m_useAlias"] = false;
$obj = new SQLLogicalExpr($proto20);

$proto18["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto18);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$proto0["m_srcTableName"]="halls";		
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_halls = createSqlQuery_halls();


	
					
;

						

$tdatahalls[".sqlquery"] = $queryData_halls;



$tdatahalls[".hasEvents"] = false;

?>