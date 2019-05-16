<?php  	
include_once("../includes/settings.php");
$Config['vAllRecord'] = $_SESSION['vAllRecord'];
require_once($Prefix."classes/lead.class.php");
include_once("includes/FieldArray.php");
$objLead=new lead();


/*************************/

$arryDocument=$objLead->ListDocument('',$_GET['parent_type'],$_GET['parentID'],$_GET['key'],$_GET['sortby'],$_GET['asc']);
$num=$objLead->numRows();

/*************************/

//$filename = "Documents_".date('d-m-Y').".xls";
if($_GET['flage']==1)
{
$filename = "Documents_".date('d-m-Y').".xls";	
$contanttype="application/vnd.ms-excel";

$delm="\t";
}
else if($_GET['flage']==2)
{
	$filename = "Documents_".date('d-m-Y').".csv";
	$contanttype="text/csv; charset=utf-8'";

	$delm=",";
}
else if($_GET['flage']==3)
{
	
	$filename = "Documents_".date('d-m-Y').".doc";
	$contanttype="application/vnd.ms-word";

	$delm="\t";
}


if($num>0){
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public");
	header("Content-Description: File Transfer");

	session_cache_limiter("must-revalidate");
	header("Content-Type:$contanttype");
	header('Content-Disposition: attachment; filename="' . $filename .'"');

	$header = "Title $delm Description $delm Created On $delm Status";
	
	

	$data = '';
	foreach($arryDocument as $key=>$values){

      if($values['Status'] ==1){
			  $status = 'Active';
			
		 }else{
			  $status = 'InActive';
			    
		 }
	
     

		$AddedDate = ($values['AddedDate']>0)?(date($Config['DateFormat'], strtotime($values['AddedDate']))):("");

		$line = "\"".stripslashes($values["title"])."\"".$delm."\"".stripslashes(strip_tags($values["description"]))."\"".$delm."\"".$AddedDate."\"".$delm."\"".$status."\""."\n";

		$data .= trim($line)."\n";
	}

	$data = str_replace("\r","",$data);

	print "$header\n\n$data";         

}else{
	echo "No record found.";
}
exit;
?>
