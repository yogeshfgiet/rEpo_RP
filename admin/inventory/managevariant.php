<?php 

	include_once("../includes/header.php");
	require_once($Prefix."classes/inv.class.php");
        require_once($Prefix."classes/variant.class.php");
        $objvariant=new varient();
	$objCommon=new common();
        //echo '<pre>'; print_r($Config);
	$ModuleName = 'Variant';
	
        
        
        
        $GetVariantList=$objvariant->GetVariant();
        //echo '<pre>'; print_r($GetVariantList);die;
        $num = $objvariant->numRows();
        //echo $num;
        $pagerLink = $objPager->getPager($GetVariantList, $RecordsPerPage, $_GET['curP']);
        (count($GetVariantList) > 0) ? ($GetVariantList = $objPager->getPageRecords()) : ("");
        
        require_once("../includes/footer.php");
?>
