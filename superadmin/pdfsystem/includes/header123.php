<?php
ini_set('display_error',1);
require_once("settings.php");
if ($HideNavigation == 1) {
    $midStyle = 'style="padding:0"';
    $innermidNum = '55';
}
 CleanGet();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <TITLE><?= $Config['SiteName'] ?> &raquo; Chat System Management Panel</TITLE>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
        <link href="../../<?= $Config['AdminCSS'] ?>" rel="stylesheet" type="text/css">
            <link href="../../<?= $Config['AdminCSS2'] ?>" rel="stylesheet" type="text/css">

                <?php if($Config['Online']==1){ ?>
                <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
                    <?php } ?>

                    <link rel="stylesheet" type="text/css" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />


                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('.fancybox').fancybox();
                        });
                    </script>
                    <link rel="stylesheet" href="../fancybox/jquery_calender/jquery-ui.css" />
                    <link rel="stylesheet" href="../../css/sitemanagement.css" />
                    <link rel="stylesheet" href="../fancybox/timepicker/jquery.timepicker.css" />

                    <script type="text/JavaScript">
                        var GlobalSiteUrl = '<?= $Config[Url] ?>';
                    </script>

                 
                    </HEAD>

                    <body>

                        <div class="wrapper">

                            <?php

                            if ($LoginPage != 1) {
                                ValidateSuperAdminSession($ThisPage);

                                if ($arrayConfig[0]['SiteLogo'] != '' && file_exists('../../images/' . $arrayConfig[0]['SiteLogo'])) {
                                    $SiteLogo = '../../resizeimage.php?w=150&h=150&img=images/' . $arrayConfig[0]['SiteLogo'];
                                } else {
                                    $SiteLogo = '../../images/logo.png';
                                }

                                ?>


                                <?php if ($HideNavigation != 1) { ?>
                                    <div id="main_table_nav" align="center">

                                        <div class="header-container">
                                            <div class="logo" id="logo"><a href="index.php"><img src="<?= $SiteLogo ?>" border="0" alt="<?= $Config['SiteName'] ?>" title="<?= $Config['SiteName'] ?>"/></a></div>
                                            <?= (!empty($CurrentDepartment) ? ('<div class="crm">' . $CurrentDepartment . '</div>') : ('')) ?>
                                            <div class="top-right-nav">
                                                <ul>
                                                    <li class="welcome">Welcome <span><?= $_SESSION['UserName'] ?>!</span></li>
                                                    <? if($_SESSION['AdminType']=="admin") {?><li class="chpassword"><a href="changePassword.php"><span>Change Password</span></a></li><? } ?>
                                                    <li class="logout"><a href="logout.php"><span>Log Out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <?php require_once("includes/menu.php"); ?>
                                        <?php
                                        //require_once("submenu.php");
                                        ?>	

                                    </div>

                                <?php } ?>

                                <div id="main_table_list" class="main-container clearfix">
                                    <div id="mid" class="main" <?= $midStyle ?>>
                                        <? 	//require_once("left.php"); ?>
                                        <?php  if($InnerPage==1){ 
                                        echo '<div class="mid-continent'.$innermidNum.'" id="inner_mid"  style="width:85%;">';
                                        } ?>
                                       <div id="load_div" align="center"><img src="images/loading.gif">&nbsp;Loading.......</div>
                                    <?php } ?>
                                    <?php
                                    $Config['DbHost'] =  $Config['chatdbhost'];
                                    $Config['DbUser'] =  $Config['chatdbuser'];     //'root';   
                                    $Config['DbPassword'] = $Config['chatdbpassword'];    //'ERP2014!';	
                                    $Config['DbName'] =  $Config['chatdbname'];
                                    ini_set('display_errors',1);
                                   // $objplan->db_connect() ; 
                                    $objplan = new plan();
                                    //$objplan->
                                $objplan->dbuser = $Config['DbUser'];
                                $objplan->dbpassword =   $Config['DbPassword'];
                                $objplan->dbname = $Config['DbName'];
                                $objplan->dbhost =  $Config['DbHost'];
                                $objplan->db_connect();
                                $objplan->getPlanelement();

                                    ?>


