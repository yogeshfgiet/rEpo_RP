<?php 
 	include_once("../includes/header.php");
	require_once($Prefix."classes/bom.class.php");
	require_once($Prefix."classes/category.class.php");
	include_once("includes/FieldArray.php");	
	$objBom=new bom();
	$objCategory=new category();

	

	 $arryAssemble = $objBom->ListDisassemble('',$_GET['key'],$_GET['sortby'],$_GET['asc'],$_GET['Status']);
         
         
	 $num=$objBom->numRows();
       
	 $pagerLink=$objPager->getPager($arryAssemble,$RecordsPerPage,$_GET['curP']);
	(count($arryAssemble)>0)?($arryAssemble=$objPager->getPageRecords()):(""); 
	 
         // $listAllCategory =  $objCategory->ListAllCategories();
	
		  

  require_once("../includes/footer.php");

?>