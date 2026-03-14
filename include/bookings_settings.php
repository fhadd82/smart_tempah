<?php
$tdatabookings = array();
$tdatabookings[".searchableFields"] = array();
$tdatabookings[".ShortName"] = "bookings";
$tdatabookings[".OwnerID"] = "id";
$tdatabookings[".OriginalTable"] = "bookings";


$tdatabookings[".pagesByType"] = my_json_decode( "{}" );
$tdatabookings[".originalPagesByType"] = $tdatabookings[".pagesByType"];
$tdatabookings[".pages"] = types2pages( my_json_decode( "{}" ) );
$tdatabookings[".originalPages"] = $tdatabookings[".pages"];
$tdatabookings[".defaultPages"] = my_json_decode( "{}" );
$tdatabookings[".originalDefaultPages"] = $tdatabookings[".defaultPages"];

//	field labels
$fieldLabelsbookings = array();
$fieldToolTipsbookings = array();
$pageTitlesbookings = array();
$placeHoldersbookings = array();

if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsbookings["English"] = array();
	$fieldToolTipsbookings["English"] = array();
	$placeHoldersbookings["English"] = array();
	$pageTitlesbookings["English"] = array();
	$fieldLabelsbookings["English"]["id"] = "Id";
	$fieldToolTipsbookings["English"]["id"] = "";
	$placeHoldersbookings["English"]["id"] = "";
	$fieldLabelsbookings["English"]["user_id"] = "User Id";
	$fieldToolTipsbookings["English"]["user_id"] = "";
	$placeHoldersbookings["English"]["user_id"] = "";
	$fieldLabelsbookings["English"]["hall_id"] = "Hall Id";
	$fieldToolTipsbookings["English"]["hall_id"] = "";
	$placeHoldersbookings["English"]["hall_id"] = "";
	$fieldLabelsbookings["English"]["purpose"] = "Purpose";
	$fieldToolTipsbookings["English"]["purpose"] = "";
	$placeHoldersbookings["English"]["purpose"] = "";
	$fieldLabelsbookings["English"]["start_datetime"] = "Start Datetime";
	$fieldToolTipsbookings["English"]["start_datetime"] = "";
	$placeHoldersbookings["English"]["start_datetime"] = "";
	$fieldLabelsbookings["English"]["end_datetime"] = "End Datetime";
	$fieldToolTipsbookings["English"]["end_datetime"] = "";
	$placeHoldersbookings["English"]["end_datetime"] = "";
	$fieldLabelsbookings["English"]["approval_status"] = "Approval Status";
	$fieldToolTipsbookings["English"]["approval_status"] = "";
	$placeHoldersbookings["English"]["approval_status"] = "";
	$fieldLabelsbookings["English"]["supervisor_remarks"] = "Supervisor Remarks";
	$fieldToolTipsbookings["English"]["supervisor_remarks"] = "";
	$placeHoldersbookings["English"]["supervisor_remarks"] = "";
	$fieldLabelsbookings["English"]["created_at"] = "Created At";
	$fieldToolTipsbookings["English"]["created_at"] = "";
	$placeHoldersbookings["English"]["created_at"] = "";
	$fieldLabelsbookings["English"]["booking_id"] = "Booking Id";
	$fieldToolTipsbookings["English"]["booking_id"] = "";
	$placeHoldersbookings["English"]["booking_id"] = "";
	if (count($fieldToolTipsbookings["English"]))
		$tdatabookings[".isUseToolTips"] = true;
}


	$tdatabookings[".NCSearch"] = true;



$tdatabookings[".shortTableName"] = "bookings";
$tdatabookings[".nSecOptions"] = 0;

$tdatabookings[".mainTableOwnerID"] = "id";
$tdatabookings[".entityType"] = 0;
$tdatabookings[".connId"] = "reservation_at_localhost";


$tdatabookings[".strOriginalTableName"] = "bookings";

		 



$tdatabookings[".showAddInPopup"] = false;

$tdatabookings[".showEditInPopup"] = false;

$tdatabookings[".showViewInPopup"] = false;

$tdatabookings[".listAjax"] = false;
//	temporary
//$tdatabookings[".listAjax"] = false;

	$tdatabookings[".audit"] = true;

	$tdatabookings[".locking"] = false;


$pages = $tdatabookings[".defaultPages"];

if( $pages[PAGE_EDIT] ) {
	$tdatabookings[".edit"] = true;
	$tdatabookings[".afterEditAction"] = 1;
	$tdatabookings[".closePopupAfterEdit"] = 1;
	$tdatabookings[".afterEditActionDetTable"] = "";
}

if( $pages[PAGE_ADD] ) {
$tdatabookings[".add"] = true;
$tdatabookings[".afterAddAction"] = 1;
$tdatabookings[".closePopupAfterAdd"] = 1;
$tdatabookings[".afterAddActionDetTable"] = "";
}

if( $pages[PAGE_LIST] ) {
	$tdatabookings[".list"] = true;
}



$tdatabookings[".strSortControlSettingsJSON"] = "";




if( $pages[PAGE_VIEW] ) {
$tdatabookings[".view"] = true;
}

if( $pages[PAGE_IMPORT] ) {
$tdatabookings[".import"] = true;
}

if( $pages[PAGE_EXPORT] ) {
$tdatabookings[".exportTo"] = true;
}

if( $pages[PAGE_PRINT] ) {
$tdatabookings[".printFriendly"] = true;
}



$tdatabookings[".showSimpleSearchOptions"] = true; // temp fix #13449

// Allow Show/Hide Fields in GRID
$tdatabookings[".allowShowHideFields"] = true; // temp fix #13449
//

// Allow Fields Reordering in GRID
$tdatabookings[".allowFieldsReordering"] = true; // temp fix #13449
//

$tdatabookings[".isUseAjaxSuggest"] = true;





$tdatabookings[".ajaxCodeSnippetAdded"] = false;

$tdatabookings[".buttonsAdded"] = false;

$tdatabookings[".addPageEvents"] = false;

// use timepicker for search panel
$tdatabookings[".isUseTimeForSearch"] = false;


$tdatabookings[".badgeColor"] = "9ACD32";


$tdatabookings[".allSearchFields"] = array();
$tdatabookings[".filterFields"] = array();
$tdatabookings[".requiredSearchFields"] = array();

$tdatabookings[".googleLikeFields"] = array();
$tdatabookings[".googleLikeFields"][] = "id";
$tdatabookings[".googleLikeFields"][] = "user_id";
$tdatabookings[".googleLikeFields"][] = "hall_id";
$tdatabookings[".googleLikeFields"][] = "purpose";
$tdatabookings[".googleLikeFields"][] = "start_datetime";
$tdatabookings[".googleLikeFields"][] = "end_datetime";
$tdatabookings[".googleLikeFields"][] = "approval_status";
$tdatabookings[".googleLikeFields"][] = "supervisor_remarks";
$tdatabookings[".googleLikeFields"][] = "created_at";
$tdatabookings[".googleLikeFields"][] = "booking_id";



$tdatabookings[".tableType"] = "list";

$tdatabookings[".printerPageOrientation"] = 0;
$tdatabookings[".nPrinterPageScale"] = 100;

$tdatabookings[".nPrinterSplitRecords"] = 40;

$tdatabookings[".geocodingEnabled"] = false;










$tdatabookings[".pageSize"] = 20;

$tdatabookings[".warnLeavingPages"] = true;



$tstrOrderBy = "";
$tdatabookings[".strOrderBy"] = $tstrOrderBy;

$tdatabookings[".orderindexes"] = array();


$tdatabookings[".sqlHead"] = "SELECT id,  	user_id,  	hall_id,  	purpose,  	start_datetime,  	end_datetime,  	approval_status,  	supervisor_remarks,  	created_at,  	booking_id";
$tdatabookings[".sqlFrom"] = "FROM bookings";
$tdatabookings[".sqlWhereExpr"] = "";
$tdatabookings[".sqlTail"] = "";










//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatabookings[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatabookings[".arrGroupsPerPage"] = $arrGPP;

$tdatabookings[".highlightSearchResults"] = true;

$tableKeysbookings = array();
$tableKeysbookings[] = "id";
$tdatabookings[".Keys"] = $tableKeysbookings;


$tdatabookings[".hideMobileList"] = array();




//	id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "id";
	$fdata["GoodName"] = "id";
	$fdata["ownerTable"] = "bookings";
	$fdata["Label"] = GetFieldLabel("bookings","id");
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


	$tdatabookings["id"] = $fdata;
		$tdatabookings[".searchableFields"][] = "id";
//	user_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "user_id";
	$fdata["GoodName"] = "user_id";
	$fdata["ownerTable"] = "bookings";
	$fdata["Label"] = GetFieldLabel("bookings","user_id");
	$fdata["FieldType"] = 3;


	
	
										

		$fdata["strField"] = "user_id";

		$fdata["sourceSingle"] = "user_id";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "user_id";

	
	
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


	$tdatabookings["user_id"] = $fdata;
		$tdatabookings[".searchableFields"][] = "user_id";
//	hall_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "hall_id";
	$fdata["GoodName"] = "hall_id";
	$fdata["ownerTable"] = "bookings";
	$fdata["Label"] = GetFieldLabel("bookings","hall_id");
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
			$edata["EditParams"].= " maxlength=11";

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


	$tdatabookings["hall_id"] = $fdata;
		$tdatabookings[".searchableFields"][] = "hall_id";
//	purpose
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "purpose";
	$fdata["GoodName"] = "purpose";
	$fdata["ownerTable"] = "bookings";
	$fdata["Label"] = GetFieldLabel("bookings","purpose");
	$fdata["FieldType"] = 200;


	
	
										

		$fdata["strField"] = "purpose";

		$fdata["sourceSingle"] = "purpose";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "purpose";

	
	
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


	$tdatabookings["purpose"] = $fdata;
		$tdatabookings[".searchableFields"][] = "purpose";
//	start_datetime
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "start_datetime";
	$fdata["GoodName"] = "start_datetime";
	$fdata["ownerTable"] = "bookings";
	$fdata["Label"] = GetFieldLabel("bookings","start_datetime");
	$fdata["FieldType"] = 135;


	
	
										

		$fdata["strField"] = "start_datetime";

		$fdata["sourceSingle"] = "start_datetime";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "start_datetime";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "Short Date");

	
	
	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Date");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
		$edata["DateEditType"] = 13;
	$edata["InitialYearFactor"] = 100;
	$edata["LastYearFactor"] = 10;

	
	
	
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
		$fdata["defaultSearchOption"] = "Equals";

			// the default search options list
				$fdata["searchOptionsList"] = array("Equals", "More than", "Less than", "Between", EMPTY_SEARCH, NOT_EMPTY );
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


	$tdatabookings["start_datetime"] = $fdata;
		$tdatabookings[".searchableFields"][] = "start_datetime";
//	end_datetime
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "end_datetime";
	$fdata["GoodName"] = "end_datetime";
	$fdata["ownerTable"] = "bookings";
	$fdata["Label"] = GetFieldLabel("bookings","end_datetime");
	$fdata["FieldType"] = 135;


	
	
										

		$fdata["strField"] = "end_datetime";

		$fdata["sourceSingle"] = "end_datetime";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "end_datetime";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "Short Date");

	
	
	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Date");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
		$edata["DateEditType"] = 13;
	$edata["InitialYearFactor"] = 100;
	$edata["LastYearFactor"] = 10;

	
	
	
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
		$fdata["defaultSearchOption"] = "Equals";

			// the default search options list
				$fdata["searchOptionsList"] = array("Equals", "More than", "Less than", "Between", EMPTY_SEARCH, NOT_EMPTY );
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


	$tdatabookings["end_datetime"] = $fdata;
		$tdatabookings[".searchableFields"][] = "end_datetime";
//	approval_status
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "approval_status";
	$fdata["GoodName"] = "approval_status";
	$fdata["ownerTable"] = "bookings";
	$fdata["Label"] = GetFieldLabel("bookings","approval_status");
	$fdata["FieldType"] = 200;


	
	
										

		$fdata["strField"] = "approval_status";

		$fdata["sourceSingle"] = "approval_status";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "approval_status";

	
	
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


	$tdatabookings["approval_status"] = $fdata;
		$tdatabookings[".searchableFields"][] = "approval_status";
//	supervisor_remarks
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "supervisor_remarks";
	$fdata["GoodName"] = "supervisor_remarks";
	$fdata["ownerTable"] = "bookings";
	$fdata["Label"] = GetFieldLabel("bookings","supervisor_remarks");
	$fdata["FieldType"] = 201;


	
	
										

		$fdata["strField"] = "supervisor_remarks";

		$fdata["sourceSingle"] = "supervisor_remarks";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "supervisor_remarks";

	
	
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

	$edata = array("EditFormat" => "Text area");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 0;

	
	
	
				$edata["nRows"] = 100;
			$edata["nCols"] = 200;

	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
//	End validation

		$edata["CreateThumbnail"] = true;
	$edata["StrThumbnail"] = "th";
			$edata["ThumbnailSize"] = 600;

			
	
	
	
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


	$tdatabookings["supervisor_remarks"] = $fdata;
		$tdatabookings[".searchableFields"][] = "supervisor_remarks";
//	created_at
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "created_at";
	$fdata["GoodName"] = "created_at";
	$fdata["ownerTable"] = "bookings";
	$fdata["Label"] = GetFieldLabel("bookings","created_at");
	$fdata["FieldType"] = 135;


	
	
										

		$fdata["strField"] = "created_at";

		$fdata["sourceSingle"] = "created_at";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "created_at";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "Short Date");

	
	
	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Date");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
		$edata["DateEditType"] = 13;
	$edata["InitialYearFactor"] = 100;
	$edata["LastYearFactor"] = 10;

	
	
	
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
		$fdata["defaultSearchOption"] = "Equals";

			// the default search options list
				$fdata["searchOptionsList"] = array("Equals", "More than", "Less than", "Between", EMPTY_SEARCH, NOT_EMPTY );
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


	$tdatabookings["created_at"] = $fdata;
		$tdatabookings[".searchableFields"][] = "created_at";
//	booking_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "booking_id";
	$fdata["GoodName"] = "booking_id";
	$fdata["ownerTable"] = "bookings";
	$fdata["Label"] = GetFieldLabel("bookings","booking_id");
	$fdata["FieldType"] = 200;


	
	
										

		$fdata["strField"] = "booking_id";

		$fdata["sourceSingle"] = "booking_id";

	
		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "booking_id";

	
	
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


	$tdatabookings["booking_id"] = $fdata;
		$tdatabookings[".searchableFields"][] = "booking_id";


$tables_data["bookings"]=&$tdatabookings;
$field_labels["bookings"] = &$fieldLabelsbookings;
$fieldToolTips["bookings"] = &$fieldToolTipsbookings;
$placeHolders["bookings"] = &$placeHoldersbookings;
$page_titles["bookings"] = &$pageTitlesbookings;


changeTextControlsToDate( "bookings" );

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)

//if !@TABLE.bReportCrossTab

$detailsTablesData["bookings"] = array();
//endif

// tables which are master tables for current table (detail)
$masterTablesData["bookings"] = array();



// -----------------end  prepare master-details data arrays ------------------------------//



require_once(getabspath("classes/sql.php"));











function createSqlQuery_bookings()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id,  	user_id,  	hall_id,  	purpose,  	start_datetime,  	end_datetime,  	approval_status,  	supervisor_remarks,  	created_at,  	booking_id";
$proto0["m_strFrom"] = "FROM bookings";
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
	"m_strTable" => "bookings",
	"m_srcTableName" => "bookings"
));

$proto6["m_sql"] = "id";
$proto6["m_srcTableName"] = "bookings";
$proto6["m_expr"]=$obj;
$proto6["m_alias"] = "";
$obj = new SQLFieldListItem($proto6);

$proto0["m_fieldlist"][]=$obj;
						$proto8=array();
			$obj = new SQLField(array(
	"m_strName" => "user_id",
	"m_strTable" => "bookings",
	"m_srcTableName" => "bookings"
));

$proto8["m_sql"] = "user_id";
$proto8["m_srcTableName"] = "bookings";
$proto8["m_expr"]=$obj;
$proto8["m_alias"] = "";
$obj = new SQLFieldListItem($proto8);

$proto0["m_fieldlist"][]=$obj;
						$proto10=array();
			$obj = new SQLField(array(
	"m_strName" => "hall_id",
	"m_strTable" => "bookings",
	"m_srcTableName" => "bookings"
));

$proto10["m_sql"] = "hall_id";
$proto10["m_srcTableName"] = "bookings";
$proto10["m_expr"]=$obj;
$proto10["m_alias"] = "";
$obj = new SQLFieldListItem($proto10);

$proto0["m_fieldlist"][]=$obj;
						$proto12=array();
			$obj = new SQLField(array(
	"m_strName" => "purpose",
	"m_strTable" => "bookings",
	"m_srcTableName" => "bookings"
));

$proto12["m_sql"] = "purpose";
$proto12["m_srcTableName"] = "bookings";
$proto12["m_expr"]=$obj;
$proto12["m_alias"] = "";
$obj = new SQLFieldListItem($proto12);

$proto0["m_fieldlist"][]=$obj;
						$proto14=array();
			$obj = new SQLField(array(
	"m_strName" => "start_datetime",
	"m_strTable" => "bookings",
	"m_srcTableName" => "bookings"
));

$proto14["m_sql"] = "start_datetime";
$proto14["m_srcTableName"] = "bookings";
$proto14["m_expr"]=$obj;
$proto14["m_alias"] = "";
$obj = new SQLFieldListItem($proto14);

$proto0["m_fieldlist"][]=$obj;
						$proto16=array();
			$obj = new SQLField(array(
	"m_strName" => "end_datetime",
	"m_strTable" => "bookings",
	"m_srcTableName" => "bookings"
));

$proto16["m_sql"] = "end_datetime";
$proto16["m_srcTableName"] = "bookings";
$proto16["m_expr"]=$obj;
$proto16["m_alias"] = "";
$obj = new SQLFieldListItem($proto16);

$proto0["m_fieldlist"][]=$obj;
						$proto18=array();
			$obj = new SQLField(array(
	"m_strName" => "approval_status",
	"m_strTable" => "bookings",
	"m_srcTableName" => "bookings"
));

$proto18["m_sql"] = "approval_status";
$proto18["m_srcTableName"] = "bookings";
$proto18["m_expr"]=$obj;
$proto18["m_alias"] = "";
$obj = new SQLFieldListItem($proto18);

$proto0["m_fieldlist"][]=$obj;
						$proto20=array();
			$obj = new SQLField(array(
	"m_strName" => "supervisor_remarks",
	"m_strTable" => "bookings",
	"m_srcTableName" => "bookings"
));

$proto20["m_sql"] = "supervisor_remarks";
$proto20["m_srcTableName"] = "bookings";
$proto20["m_expr"]=$obj;
$proto20["m_alias"] = "";
$obj = new SQLFieldListItem($proto20);

$proto0["m_fieldlist"][]=$obj;
						$proto22=array();
			$obj = new SQLField(array(
	"m_strName" => "created_at",
	"m_strTable" => "bookings",
	"m_srcTableName" => "bookings"
));

$proto22["m_sql"] = "created_at";
$proto22["m_srcTableName"] = "bookings";
$proto22["m_expr"]=$obj;
$proto22["m_alias"] = "";
$obj = new SQLFieldListItem($proto22);

$proto0["m_fieldlist"][]=$obj;
						$proto24=array();
			$obj = new SQLField(array(
	"m_strName" => "booking_id",
	"m_strTable" => "bookings",
	"m_srcTableName" => "bookings"
));

$proto24["m_sql"] = "booking_id";
$proto24["m_srcTableName"] = "bookings";
$proto24["m_expr"]=$obj;
$proto24["m_alias"] = "";
$obj = new SQLFieldListItem($proto24);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto26=array();
$proto26["m_link"] = "SQLL_MAIN";
			$proto27=array();
$proto27["m_strName"] = "bookings";
$proto27["m_srcTableName"] = "bookings";
$proto27["m_columns"] = array();
$proto27["m_columns"][] = "id";
$proto27["m_columns"][] = "user_id";
$proto27["m_columns"][] = "hall_id";
$proto27["m_columns"][] = "purpose";
$proto27["m_columns"][] = "start_datetime";
$proto27["m_columns"][] = "end_datetime";
$proto27["m_columns"][] = "approval_status";
$proto27["m_columns"][] = "supervisor_remarks";
$proto27["m_columns"][] = "created_at";
$proto27["m_columns"][] = "booking_id";
$obj = new SQLTable($proto27);

$proto26["m_table"] = $obj;
$proto26["m_sql"] = "bookings";
$proto26["m_alias"] = "";
$proto26["m_srcTableName"] = "bookings";
$proto28=array();
$proto28["m_sql"] = "";
$proto28["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto28["m_column"]=$obj;
$proto28["m_contained"] = array();
$proto28["m_strCase"] = "";
$proto28["m_havingmode"] = false;
$proto28["m_inBrackets"] = false;
$proto28["m_useAlias"] = false;
$obj = new SQLLogicalExpr($proto28);

$proto26["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto26);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$proto0["m_srcTableName"]="bookings";		
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_bookings = createSqlQuery_bookings();


	
					
;

										

$tdatabookings[".sqlquery"] = $queryData_bookings;



$tdatabookings[".hasEvents"] = false;

?>