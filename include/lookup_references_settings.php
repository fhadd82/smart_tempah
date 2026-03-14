<?php
$tdatalookup_references = array();
$tdatalookup_references[".searchableFields"] = array();
$tdatalookup_references[".ShortName"] = "lookup_references";
$tdatalookup_references[".OwnerID"] = "";
$tdatalookup_references[".OriginalTable"] = "lookup_references";


$tdatalookup_references[".pagesByType"] = my_json_decode( "{}" );
$tdatalookup_references[".originalPagesByType"] = $tdatalookup_references[".pagesByType"];
$tdatalookup_references[".pages"] = types2pages( my_json_decode( "{}" ) );
$tdatalookup_references[".originalPages"] = $tdatalookup_references[".pages"];
$tdatalookup_references[".defaultPages"] = my_json_decode( "{}" );
$tdatalookup_references[".originalDefaultPages"] = $tdatalookup_references[".defaultPages"];

//	field labels
$fieldLabelslookup_references = array();
$fieldToolTipslookup_references = array();
$pageTitleslookup_references = array();
$placeHolderslookup_references = array();

if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslookup_references["English"] = array();
	$fieldToolTipslookup_references["English"] = array();
	$placeHolderslookup_references["English"] = array();
	$pageTitleslookup_references["English"] = array();
	$fieldLabelslookup_references["English"]["id"] = "Id";
	$fieldToolTipslookup_references["English"]["id"] = "";
	$placeHolderslookup_references["English"]["id"] = "";
	$fieldLabelslookup_references["English"]["category"] = "Category";
	$fieldToolTipslookup_references["English"]["category"] = "";
	$placeHolderslookup_references["English"]["category"] = "";
	$fieldLabelslookup_references["English"]["value"] = "Value";
	$fieldToolTipslookup_references["English"]["value"] = "";
	$placeHolderslookup_references["English"]["value"] = "";
	if (count($fieldToolTipslookup_references["English"]))
		$tdatalookup_references[".isUseToolTips"] = true;
}


	$tdatalookup_references[".NCSearch"] = true;



$tdatalookup_references[".shortTableName"] = "lookup_references";
$tdatalookup_references[".nSecOptions"] = 0;

$tdatalookup_references[".mainTableOwnerID"] = "";
$tdatalookup_references[".entityType"] = 0;
$tdatalookup_references[".connId"] = "reservation_at_localhost";


$tdatalookup_references[".strOriginalTableName"] = "lookup_references";

		 



$tdatalookup_references[".showAddInPopup"] = false;

$tdatalookup_references[".showEditInPopup"] = false;

$tdatalookup_references[".showViewInPopup"] = false;

$tdatalookup_references[".listAjax"] = false;
//	temporary
//$tdatalookup_references[".listAjax"] = false;

	$tdatalookup_references[".audit"] = true;

	$tdatalookup_references[".locking"] = false;


$pages = $tdatalookup_references[".defaultPages"];

if( $pages[PAGE_EDIT] ) {
	$tdatalookup_references[".edit"] = true;
	$tdatalookup_references[".afterEditAction"] = 1;
	$tdatalookup_references[".closePopupAfterEdit"] = 1;
	$tdatalookup_references[".afterEditActionDetTable"] = "";
}

if( $pages[PAGE_ADD] ) {
$tdatalookup_references[".add"] = true;
$tdatalookup_references[".afterAddAction"] = 1;
$tdatalookup_references[".closePopupAfterAdd"] = 1;
$tdatalookup_references[".afterAddActionDetTable"] = "";
}

if( $pages[PAGE_LIST] ) {
	$tdatalookup_references[".list"] = true;
}



$tdatalookup_references[".strSortControlSettingsJSON"] = "";




if( $pages[PAGE_VIEW] ) {
$tdatalookup_references[".view"] = true;
}

if( $pages[PAGE_IMPORT] ) {
$tdatalookup_references[".import"] = true;
}

if( $pages[PAGE_EXPORT] ) {
$tdatalookup_references[".exportTo"] = true;
}

if( $pages[PAGE_PRINT] ) {
$tdatalookup_references[".printFriendly"] = true;
}



$tdatalookup_references[".showSimpleSearchOptions"] = true; // temp fix #13449

// Allow Show/Hide Fields in GRID
$tdatalookup_references[".allowShowHideFields"] = true; // temp fix #13449
//

// Allow Fields Reordering in GRID
$tdatalookup_references[".allowFieldsReordering"] = true; // temp fix #13449
//

$tdatalookup_references[".isUseAjaxSuggest"] = true;





$tdatalookup_references[".ajaxCodeSnippetAdded"] = false;

$tdatalookup_references[".buttonsAdded"] = false;

$tdatalookup_references[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalookup_references[".isUseTimeForSearch"] = false;


$tdatalookup_references[".badgeColor"] = "1E90FF";


$tdatalookup_references[".allSearchFields"] = array();
$tdatalookup_references[".filterFields"] = array();
$tdatalookup_references[".requiredSearchFields"] = array();

$tdatalookup_references[".googleLikeFields"] = array();
$tdatalookup_references[".googleLikeFields"][] = "id";
$tdatalookup_references[".googleLikeFields"][] = "category";
$tdatalookup_references[".googleLikeFields"][] = "value";



$tdatalookup_references[".tableType"] = "list";

$tdatalookup_references[".printerPageOrientation"] = 0;
$tdatalookup_references[".nPrinterPageScale"] = 100;

$tdatalookup_references[".nPrinterSplitRecords"] = 40;

$tdatalookup_references[".geocodingEnabled"] = false;










$tdatalookup_references[".pageSize"] = 20;

$tdatalookup_references[".warnLeavingPages"] = true;



$tstrOrderBy = "";
$tdatalookup_references[".strOrderBy"] = $tstrOrderBy;

$tdatalookup_references[".orderindexes"] = array();


$tdatalookup_references[".sqlHead"] = "SELECT id,  	category,  	`value`";
$tdatalookup_references[".sqlFrom"] = "FROM lookup_references";
$tdatalookup_references[".sqlWhereExpr"] = "";
$tdatalookup_references[".sqlTail"] = "";










//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalookup_references[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalookup_references[".arrGroupsPerPage"] = $arrGPP;

$tdatalookup_references[".highlightSearchResults"] = true;

$tableKeyslookup_references = array();
$tableKeyslookup_references[] = "id";
$tdatalookup_references[".Keys"] = $tableKeyslookup_references;


$tdatalookup_references[".hideMobileList"] = array();




//	id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "id";
	$fdata["GoodName"] = "id";
	$fdata["ownerTable"] = "lookup_references";
	$fdata["Label"] = GetFieldLabel("lookup_references","id");
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


	$tdatalookup_references["id"] = $fdata;
		$tdatalookup_references[".searchableFields"][] = "id";
//	category
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "category";
	$fdata["GoodName"] = "category";
	$fdata["ownerTable"] = "lookup_references";
	$fdata["Label"] = GetFieldLabel("lookup_references","category");
	$fdata["FieldType"] = 200;


	
	
										

		$fdata["strField"] = "category";

		$fdata["sourceSingle"] = "category";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "category";

	
	
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


	$tdatalookup_references["category"] = $fdata;
		$tdatalookup_references[".searchableFields"][] = "category";
//	value
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "value";
	$fdata["GoodName"] = "value";
	$fdata["ownerTable"] = "lookup_references";
	$fdata["Label"] = GetFieldLabel("lookup_references","value");
	$fdata["FieldType"] = 200;


	
	
										

		$fdata["strField"] = "value";

		$fdata["sourceSingle"] = "value";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "`value`";

	
	
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


	$tdatalookup_references["value"] = $fdata;
		$tdatalookup_references[".searchableFields"][] = "value";


$tables_data["lookup_references"]=&$tdatalookup_references;
$field_labels["lookup_references"] = &$fieldLabelslookup_references;
$fieldToolTips["lookup_references"] = &$fieldToolTipslookup_references;
$placeHolders["lookup_references"] = &$placeHolderslookup_references;
$page_titles["lookup_references"] = &$pageTitleslookup_references;


changeTextControlsToDate( "lookup_references" );

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)

//if !@TABLE.bReportCrossTab

$detailsTablesData["lookup_references"] = array();
//endif

// tables which are master tables for current table (detail)
$masterTablesData["lookup_references"] = array();



// -----------------end  prepare master-details data arrays ------------------------------//



require_once(getabspath("classes/sql.php"));











function createSqlQuery_lookup_references()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id,  	category,  	`value`";
$proto0["m_strFrom"] = "FROM lookup_references";
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
	"m_strTable" => "lookup_references",
	"m_srcTableName" => "lookup_references"
));

$proto6["m_sql"] = "id";
$proto6["m_srcTableName"] = "lookup_references";
$proto6["m_expr"]=$obj;
$proto6["m_alias"] = "";
$obj = new SQLFieldListItem($proto6);

$proto0["m_fieldlist"][]=$obj;
						$proto8=array();
			$obj = new SQLField(array(
	"m_strName" => "category",
	"m_strTable" => "lookup_references",
	"m_srcTableName" => "lookup_references"
));

$proto8["m_sql"] = "category";
$proto8["m_srcTableName"] = "lookup_references";
$proto8["m_expr"]=$obj;
$proto8["m_alias"] = "";
$obj = new SQLFieldListItem($proto8);

$proto0["m_fieldlist"][]=$obj;
						$proto10=array();
			$obj = new SQLField(array(
	"m_strName" => "value",
	"m_strTable" => "lookup_references",
	"m_srcTableName" => "lookup_references"
));

$proto10["m_sql"] = "`value`";
$proto10["m_srcTableName"] = "lookup_references";
$proto10["m_expr"]=$obj;
$proto10["m_alias"] = "";
$obj = new SQLFieldListItem($proto10);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto12=array();
$proto12["m_link"] = "SQLL_MAIN";
			$proto13=array();
$proto13["m_strName"] = "lookup_references";
$proto13["m_srcTableName"] = "lookup_references";
$proto13["m_columns"] = array();
$proto13["m_columns"][] = "id";
$proto13["m_columns"][] = "category";
$proto13["m_columns"][] = "value";
$obj = new SQLTable($proto13);

$proto12["m_table"] = $obj;
$proto12["m_sql"] = "lookup_references";
$proto12["m_alias"] = "";
$proto12["m_srcTableName"] = "lookup_references";
$proto14=array();
$proto14["m_sql"] = "";
$proto14["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto14["m_column"]=$obj;
$proto14["m_contained"] = array();
$proto14["m_strCase"] = "";
$proto14["m_havingmode"] = false;
$proto14["m_inBrackets"] = false;
$proto14["m_useAlias"] = false;
$obj = new SQLLogicalExpr($proto14);

$proto12["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto12);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$proto0["m_srcTableName"]="lookup_references";		
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_lookup_references = createSqlQuery_lookup_references();


	
					
;

			

$tdatalookup_references[".sqlquery"] = $queryData_lookup_references;



$tdatalookup_references[".hasEvents"] = false;

?>