<?php
	/**************************************************/
	$ThisPageName = 'viewTaxClass.php'; $EditPage = 1;
	/**************************************************/
 	include_once("../includes/header.php");

	require_once($Prefix."classes/cartsettings.class.php");
	
	(!$_GET['curP'])?($_GET['curP']=1):(""); // current page number
                           if (class_exists(cartsettings)) {
	  	$objcartsettings=new Cartsettings();
	} else {
  		echo "Class Not Found Error !! Cart Settings Class Not Found !";
		exit;
  	}
                 $TaxClassId = isset($_GET['edit'])?$_GET['edit']:"";	
                  if ($TaxClassId && !empty($TaxClassId)) {$ModuleTitle = "Edit Tax Class";}else{$ModuleTitle = "Add Tax Class";}
                        $ModuleName = 'Tax Class';
                        $ListTitle  = 'Tax Classes';
                        $ListUrl    = "viewTaxClass.php?curP=".$_GET['curP'];
                       
                
                    if ($TaxClassId && !empty($TaxClassId)) 
                    {
                        $arryTaxClass = $objcartsettings->getTaxClassById($TaxClassId);
                    }

			
		 	 
                  if(!empty($_GET['active_id'])){
		$_SESSION['mess_taxclass'] = $ModuleName.STATUS;
		$objcartsettings->changeTaxClassStatus($_GET['active_id']);
		header("location:".$ListUrl);
	 }
	

	 if(!empty($_GET['del_id'])){
             
                                $_SESSION['mess_taxclass'] = $ModuleName.REMOVED;
                                $objcartsettings->deleteTaxClass($_GET['del_id']);
                                header("location:".$ListUrl);
                                exit;
	}
		


 	if (is_object($objcartsettings)) {	
		 
		 if ($_POST) { CleanPost();
		
                                            if (!empty($TaxClassId)) {
                                                    $_SESSION['mess_taxclass'] = $ModuleName.UPDATED;
                                                    $objcartsettings->updateTaxClass($_POST);
                                                    header("location:".$ListUrl);
                                            } else {		
                                                    $_SESSION['mess_taxclass'] = $ModuleName.ADDED;
                                                    $lastShipId = $objcartsettings->addTaxClass($_POST);	
                                                   header("location:".$ListUrl);
                                            }

                                            exit;
			
		}
		

	
	
		
		if($arryTaxClass[0]['Status'] == "No"){
			$TaxClassStatus = "No";
		}else{
			$TaxClassStatus = "Yes";
		}
                
                              
}



 require_once("../includes/footer.php"); 
 
 
 ?>