<?php
$folderPath = '../';
require_once("includes/settings.php");
//$HideNavigation=1;
//$mData=getHeaderMenu('header');
?>

<?php
if($HideNavigation==1){?>
<style>
#mainContainer {
	display: none;
}

#footer {
	display: none;
}
</style>

<?php } ?>

<?php

$rsAccountLimit=$objRes->resellerAccountLimit($_SESSION['CrmRsID']);
$PaymentMethodCR = trim(strtolower($rsAccountLimit[0]['PaymentMethod']));

//$rsOrderedAmount=$objRes->resellerOrderAmount($_SESSION['CrmRsID']);
$DebitAmount=$rsAccountLimit[0]['AccountLimit']-$rsOrderedAmount[0]['TotalAmount'];
if($DebitAmount<0) $DebitAmount=0;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1"/>
<link rel="shortcut icon" href="<?php echo $Config['Url'] ?>eznetcrm/img/favicon.ico" type="image/x-icon"/>
<title>Reseller | eZNetCRM</title>

<script type="text/javascript" src="<?=$Prefix?>fancybox/lib/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?=$Prefix?>fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?=$Prefix?>fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<script type="text/javascript">
    $(document).ready(function() {
            $('.fancybox').fancybox();
    });
</script>

<link rel="stylesheet" href="<?=$Prefix?>fancybox/jquery_calender/jquery-ui.css" />
<link rel="stylesheet" href="<?=$Prefix?>css/sitemanagement.css" />
<script src="<?=$Prefix?>fancybox/jquery_calender/jquery-ui.js"></script>

<link rel="stylesheet" href="<?=$Prefix?>fancybox/timepicker/jquery.timepicker.css" />
<script src="<?=$Prefix?>fancybox/timepicker/jquery.timepicker.js"></script>

<script type="text/JavaScript">
    var GlobalSiteUrl = '<?=$Config[Url]?>';
</script>

<script language="javascript" src="<?=$Prefix?>includes/validate.js"></script>
<script language="javascript" src="<?=$Prefix?>includes/global.js"></script>
<script language="javascript" src="<?=$Prefix?>includes/ajax.js"></script>
<script language="javascript" src="<?=$Prefix?>includes/tooltip.js"></script>


<?php
/*

<script type="text/javascript" src="js/jquery.once.js"></script>
<script type="text/javascript" src="js/drupal.js"></script>
<script type="text/javascript" src="js/scroll_to_top.js"></script>
<?php */ ?>

<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/script.js"></script>


<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/print.css" rel="stylesheet" type="text/css">

<link href="css/scroll_to_top.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/system.base.css" rel="stylesheet" type="text/css">
<link href="css/system.menus.css" rel="stylesheet" type="text/css">
<link href="css/system.theme.css" rel="stylesheet" type="text/css">


<link href="css/admin.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?=$Prefix?>fancybox/timepicker/jquery.timepicker.css" />
<script src="<?=$Prefix?>fancybox/timepicker/jquery.timepicker.js"></script>

<script type="text/javascript">
var GlobalSiteUrl = '<?php echo $Config['Url']?>';
	$(document).ready(function() { 
		$('.fancybox').fancybox();
	});
</script>


<script language="javascript1.2" type="text/javascript">
function ShowHideLoader(opt,DivID){

}
</script>

<style>
.tabs {
	display: block;
}

#page-title {
	color: #333;
	font-size: 32px;
	font-weight: 300;
	margin: 50px 0 0;
	padding: 0 0 30px;
	text-align: left;
}

#superfish-1>li {
	float: left;
}
</style>

</head>
    
<body class="html front not-logged-in no-sidebars page-node page-node- page-node-14 node-type-page responsive-menus-load-processed">
<div id="skip-link"><a href="#main-content" class="element-invisible element-focusable">Skip to main content</a></div>
<div id="wrapper">
    <div id="mainContainer"><?php if(!$FancyBox){?>
        <header id="headerArea">
            <div class="wrap clearfix">

                <div class="logo">
                    <a href="<?=$MainPrefix?>index.php" title="Home" rel="home"
                        alt="eZnet CRM logo" id="logo"> <img src="<?=$MainPrefix?>img/logo.png"
                        alt="eZnet CRM logo" title="eZnet CRM logo"/> </a></div>
                    <?php include('user_menu.php');?> <?php if(!empty($_SESSION['CrmRsID'])){?>

                    <nav class="menuArea">

                    <ul class="menu sf-menu sf-main-menu sf-horizontal sf-style-none sf-total-items-5 sf-parent-items-0 sf-single-items-5 superfish-processed sf-js-enabled sf-shadow"
                        id="superfish-1">

                        <li id="menu-218-1"><a href="viewCompany.php">Manage Company</a></li>
                        <li id="menu-218-1"><a href="priceSignup.php">Create Company</a></li>
                        <li id="menu-218-1"><a href="upgradePackages.php">Upgrade Packages</a></li>
                        <li id="menu-218-1"><a href="orderHistory.php">Order History</a></li>
                    </ul>
                    </nav> <?php }?>
            </div>
        </header>

        <div class="top-cont1">
            <?php if(!empty($_SESSION['CrmRsID'])){?>
            <div class="cr-cl">
                <div class="credit-button">Credit Limit: <?php $acLmt=$rsAccountLimit[0]['AccountLimit'];
                    if($acLmt<0 || $acLmt==''){
                            $acLmt=0;
                    }
                    echo '$'.$acLmt;?>
                </div>
                <div class="credit-button">Purchased: <?php 
                    $rsOrderd=$rsOrderedAmount[0]['TotalAmount'];

                    if($rsOrderd<0 || $rsOrderd==''){
                            $rsOrderd=0;
                    }
                    echo '$'.$rsOrderd;?>
                </div>
                <div class="credit-button">Available: <?php echo '$'.$DebitAmount;?></div>
            </div>
        </div>
<?php }}?>