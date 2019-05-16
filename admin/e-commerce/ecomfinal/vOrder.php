<?php
/**************************************************/
$ThisPageName = 'viewOrder.php';
/**************************************************/
include_once("includes/header.php");

require_once("classes/orders.class.php");
require_once("classes/variant.class.php");



(!$_GET['curP'])?($_GET['curP']=1):(""); //current page number
if (class_exists(orders)) {
	$objOrder=new orders();
} else {
	echo "Class Not Found Error !! Order Class Not Found !";
	exit;
}

$ModuleName = 'Order';
$ListTitle  = 'Orders';
$ListUrl    = "viewOrder.php?curP=".$_GET['curP'];
$Oid = isset($_REQUEST['view'])?$_REQUEST['view']:"";
$Cid = isset($_REQUEST['cid'])?$_REQUEST['cid']:"";
 
if ($Oid && !empty($Oid))
{
	$arryOrderIfo = $objOrder->getOrdererInfo($Oid);
	$arryOrderProduct = $objOrder->getOrderedProductById($Oid);
	$arryShippingStatus = $objOrder->getShippingStatus();
}

if(!empty($_POST))
{
	 
	$_SESSION['mess_order'] = $ModuleName.UPDATED;
	$objOrder->saveOrderStatus($_POST);
	header("location:".$ListUrl);
	exit;
}

require_once("includes/footer.php");


?>