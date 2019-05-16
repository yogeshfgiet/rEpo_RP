<?php 

    /**************************************************/
    $ThisPageName = 'headerMenu.php'; $EditPage = 1; 
    /**************************************************/

	include_once("includes/header.php");

require_once("../classes/superAdminCms.class.php");
require_once("../classes/class.validation.php");
	$supercms=new supercms(); 
                       
  	              $pageDta=$supercms->showPage();
  	
                 $id = isset($_REQUEST['edit'])?$_REQUEST['edit']:"";
               
                  if ($id && !empty($id)) {$ModuleTitle = "Edit Page";}else{$ModuleTitle = "Add Page";}
                        $ModuleName = 'Menu';
                        $ListTitle  = 'Pages';
                        $ListUrl    = "headerMenu.php?curP=".$_GET['curP'];
                       
               
                    if (!empty($id)) 
                    {
                      
                           $arryPage = $supercms->getHeaderMenyBySlug($id);
                    }
                    
                    
                   $arryPageChk=array();
                    if (!empty($id)) 
                    {
                      
                           $arr = $supercms->getHeaderMenyBySlug($id);
                           foreach($arr as $arryPagData){
                           	array_push($arryPageChk,$arryPagData['page_id']);
                           }
                    }
                    

			
		 	 
                  if(!empty($_GET['active_id'])){
		$_SESSION['mess_header_menu'] = HEADER_MENU_STATUS_CHANGED;
		$supercms->changeSocialStatus($_REQUEST['active_id']);
		header("location:".$ListUrl);
	 }
	

	                     if(!empty($_GET['del_id'])){
             
                               $_SESSION['mess_header_menu'] = HEADER_MENU_REMOVED;
                                $supercms->deleteHeaderMenu($_GET['del_id']);
                                header("location:".$ListUrl);
                                exit;
	                        }
	

 	if (is_object($supercms)) {	
		 
		 if (!empty($_POST)) {
		 	CleanPost();
     $data=array();

	$data=$_POST;
					
	$errors=array();
	$validatedata=array(	
		'page_id'=>array(array('rule'=>'notempty','message'=>'Please Enter The Page Name')),
		'slug'=>array(array('rule'=>'notempty','message'=>'Please Enter The Slug'))
		)	;
		$objVali->requestvalue=$data;
		$errors  =	$objVali->validate($validatedata);
	
		 if(empty($errors)){
		 	
		 	       if (!empty($id)) {
                                                    $_SESSION['mess_header_menu'] = HEADER_MENU_UPDATED;
                                                     $supercms->deleteHeaderMenu($_GET['edit']);
		 	                                     if(!empty($_POST['page_id'])){
                                                     $saveData=array();
                                                     $saveData['type']= 'page';
                                                     $saveData['slug']= $_POST['slug'];
                                                   
                                                    	foreach ($_POST['page_id'] as $result){
                                                    		$saveData['page_id']=$result;
                                                    		
                                                    		$_SESSION['mess_header_menu'] = HEADER_MENU_UPDATED;
                                                    		$lastShipId = $supercms->addMenu($saveData);	
                                                    	}
                                                    }
                                                    //$supercms->updateHeaderMenue($_POST);
                                                    header("location:".$ListUrl);
                                            } else {
                                            	
							   
                                                    $_SESSION['mess_header_menu'] = HEADER_MENU_ADDED;
                                                    if(!empty($_POST['page_id'])){
                                                     $saveData=array();
                                                     $saveData['type']= 'page';
                                                     $saveData['slug']= $_POST['slug'];
                                                   
                                                    	foreach ($_POST['page_id'] as $result){
                                                    		$saveData['page_id']=$result;
                                                    		
                                                    		$lastShipId = $supercms->addMenu($saveData);	
                                                    	}
                                                    }
                                                    
                                                   header("location:".$ListUrl);
                                            }

                                            exit;
		}
	
		}

                
                              
}
	

	
		
	require_once("includes/footer.php"); 	 
?>

