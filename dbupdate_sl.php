<?php  
session_start(); 
require_once("includes/config.php"); 
require_once("includes/function.php");

 
(empty($_SESSION['sqdcfgw5986']))?($_SESSION['sqdcfgw5986']=""):("");
(empty($_GET['secqcode']))?($_GET['secqcode']=""):("");
(empty($_GET['t']))?($_GET['t']=""):("");
$Config['DbName']='';

/*
if(empty($_SESSION['sqdcfgw5986']) or md5($_SESSION['sqdcfgw5986'])!='2e5bda28ac98653b0c5ec52b9906845a'){
	header('location: dbsl.php');
	exit;
}*/

if(empty($_SESSION['sqdcfgw5986'])){
	header('location: dbsl.php');
	exit;
}


$Base = md5($_GET['secqcode']); 

if($Base=='fb5b5c786518d3143f62bfa0b2b8ee70'){


if(!empty($_GET['dbs'])) $Config['DbName'] = $_GET['dbs'];


$link=mysql_connect ($Config['DbHost'],mydecrypt($Config['DbUser']),mydecrypt($Config['DbPassword']),TRUE);
if(!$link){die("Could not connect to MySQL");}
mysql_select_db($Config['DbName'],$link) or die ("could not open db".mysql_error());

#echo 'MySql Connected.<br><br>';

if(!empty($_POST["sql"])){
	echo $_POST["sql"].'<br><br>';

	$q=mysql_query("select CmpID,DisplayName from company ",$link) or die (mysql_error());
	$DbCompanies='';
	while($row = mysql_fetch_array($q)) {
		$CmpDatabase = $Config['DbName']."_".$row['DisplayName'];
		mysql_select_db($CmpDatabase) or die ("could not open db : ".mysql_error());		

		#$q2=mysql_query($_POST["sql"]) or die (mysql_error());
		$q2=mysql_query($_POST["sql"]);
		$DbCompanies .= $row['DisplayName'].', '; 
	}	
	
	echo "Query has been executed successfully for DisplayName : ".$DbCompanies."<br><br>";
	

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> New Document </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
 </HEAD>

 <BODY>




  <form name="form1" action="" method="post">
  <textarea name="sql" style="width:400px; height:200px;"></textarea>
  <br>
  <input type="submit" name="go" value="Go">
  </form>
 </BODY>
</HTML>

<? } ?>