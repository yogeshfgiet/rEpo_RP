<?php
/**************************************************/
$EditPage = 1;
/**************************************************/
include_once("includes/header.php");
require_once("classes/cartsettings.class.php");
require_once("classes/customer.class.php");
$objCustomer = new Customer();

if (class_exists(cartsettings)) {
	$objcartsettings=new Cartsettings();
} else {
	echo "Class Not Found Error !! Cart Settings Class Not Found !";
	exit;
}

$ModuleName = 'Group Discount';
$ListUrl = "groupDiscount.php";



$listAllCustomerGroups =$objCustomer->getCustomerGroupsetting();
$arrygroupdiscount =$objcartsettings->getgroupdiscount();

if (is_object($objcartsettings)) {

	if(!empty($_POST)){
			
		$_SESSION['mess_cart'] = $ModuleName.$MSG[102];


		/********set group discount***********/
		$objcartsettings->setgroupdiscount($_POST['groupdiscount']);
			
		header("location:".$ListUrl);
		exit;
			
	}

}



require_once("includes/footer.php");


?>