<?php
 
/**************************************************/
$ThisPageName = 'addCompany.php'; if(empty($_GET["edit"]))$EditPage = 1;
$InnerPage=1;
/**************************************************/
require_once("includes/header.php");
/* * *********************************************** */

$ModuleName = "company";
$RedirectURL = "company.php?curP=".$_GET['curP'];
if(empty($_GET['tab'])) $_GET['tab']="company";

$EditUrl = "addComapny.php?edit=".$_GET["edit"]."&curP=".$_GET["curP"]."&tab=";
$ActionUrl = $EditUrl.$_GET["tab"];
$objUser=new user();
$userID = $_GET['edit']; //echo $userID;die('kk');
//$_GET['userRoleID']=3;


$arryUser=$objUser->getUser($_GET,$userID);
//print_r(unserialize($arryUser->plan_package_element));
 if(!empty($arryUser->userCompcode)) { $compcod=$arryUser->userCompcode;}

$objPackage=new package();
$arryPackage=$objPackage->getPackage($_GET,'');
	//print_r($arryPackage);
$package=array();
$packagedetail=array();
	if(!empty($arryPackage)){
		foreach($arryPackage as $arryPack){
		$package[$arryPack->pckg_id]=$arryPack->pckg_name;
                $packagedetail[$arryPack->pckg_id]=$arryPack;
		  }
	      }
               


/*if($_GET['del_id'] && !empty($_GET['del_id'])){
 $_SESSION['mess_company'] = COMPANY_REMOVED;
 $objCompany->RemoveCompany($_REQUEST['del_id']);
 header("Location:".$RedirectURL);
 }*/

#edit the Usercompany data
if (!empty($_GET["edit"])){
	$userID = $_REQUEST['edit'];
     
$arryUser = $objUser->getUser($_GET['edit'], $userID);
// print_r($arryUser);
     // echo "<pre>";print_r($arryUser);
}
//**************************Get order history(Amit Singh)****************************************
if (!empty($_GET["edit"]) && $_GET["tab"]=='paymenthistory'){
	//$userID = $_REQUEST['edit'];
     //echo $userID; 
$arryOrderHis = $objUser->getOrderHistory($userID);
//echo "<pre>";print_r($arryOrderHis);
}
//*****************************************************************/

if(!empty($_GET['active_id'])){
	$_SESSION['mess_user'] = USER_STATUS_CHANGED;
	$status = $_GET['status'];
	$data = array('status'=>$status);
	$objUser->changeUserStatus($data,$_REQUEST['active_id']);
	header("Location:".$RedirectURL);

}
if(!empty($_GET["edit"])){
 $compcod = $arryUser->userCompcode;
 $userRoleID = 3;
//$arrycompUser = $objUser->GetCompUsers($compcod,$userRoleID);
//print_r($arrycompUser);die('rajan');
}

if(isset($_POST['submit'])){
	$compcod = $arryUser->userCompcode;
    	$userRoleID = 3;
	$vari= $_POST['find'];
	$arrycompUser = $objUser->FindCompUsers($compcod,$userRoleID,$vari);
	//print_r($arrycompUser);die('rajan');
}

#Function for Random password
function randomPassword() {
	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 10; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}
//$HideModule = 'Style="display:none"';

require_once("includes/footer.php");
?>

