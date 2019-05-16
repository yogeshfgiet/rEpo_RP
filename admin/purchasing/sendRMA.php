<?php 
	$HideNavigation = 1;
	/**************************************************/
	$ThisPageName = 'viewRma.php';
	/**************************************************/
	include_once("../includes/header.php");
	require_once($Prefix."classes/purchase.class.php");
 	require_once($Prefix."classes/email.class.php");
    $objImportEmail=new email();
	(empty($_GET['po']))?($_GET['po']=""):("");
	$objPurchase=new purchase();
	if(!empty($_SESSION['AdminID'])) {
		//PR($arryCompany);
		$footerSingnature='';
		$listSignatureArry=$objConfig->GetEmailSignature();
		/*if($_SESSION['AdminType']=='employee'){
		$arryEmployee = $objEmployee->GetEmployee($_SESSION['AdminID'],'');
		$footerSingnature=$arryEmployee[0]['empSignature'];
		}else if($_SESSION['AdminType']=='admin'){
			$footerSingnature=$arryCompany[0]['empSignature'];
		}*/
		$footerSingnature=$listSignatureArry[0]['Content'];
	}
 
	(!$_GET['module'])?($_GET['module']='Quote'):(""); 
	$module = $_GET['module'];
	$ModuleName = "Purchase ".$_GET['module'];
	$ModuleDepName="PurchaseRMA";
	$RedirectURL = "viewRma.php?curP=".$_GET['curP'];

	$ModuleIDTitle = "RMA Number"; $ModuleID = "QuoteID"; $PrefixPO = "RMA";  $NotExist = NOT_EXIST_ORDER; $MailSend = PO_ORDER_SEND; $TemplateID=78;
	
	/************/
	

	$TemplateContent = $objConfigure->GetTemplateContent($TemplateID, 1);
	if(empty($TemplateContent[0]['Status'])) {
		$ErrorMSG = str_replace("[MODULE]",$_GET['module'],EMAIL_TEMPLATE_INACTIVE);	 
		
	}
	/************/	


	if(!empty($_POST["ToEmail"]) && !empty($_GET["view"])){

		if($_POST["ToEmail"][0]=="Other"){
			$_POST["ToEmail"] = $_POST["OtherEmail"];
		}else{
			$_POST["ToEmail"] = implode(",", $_POST["ToEmail"]); 
			$_POST["ToEmail"] = str_replace(",Other","",$_POST["ToEmail"]);
		}
		 
		$_POST['OrderID'] = $_GET["view"];
		/***********/
		$AttachFlag = 1; $_GET['o'] = $_GET["view"];
        $arryPurchase = $objPurchase->GetPurchase($_GET['view'],'',$module);
				
			//print_r($arryPurchase[0]['Module']); die;	
		//include_once("pdfPO.php");
 		$time=time();
		#$file_path='upload/pdf/'.$_SESSION['CmpID'].'/'.$ModuleDepName.'-'.stripslashes($arryPurchase[0]['ReturnID']).'.pdf'; 


		$PdfFolder = $Config['P_Rma']; 
		$PdfDir = $Config['FilePreviewDir'].$PdfFolder;
		//$file_path= $PdfDir.$ModuleDepName.'-'.stripslashes($arryPurchase[0]['ReturnID']).'.pdf';
        //$ConvetFilename=$ModuleDepName.'-'.stripslashes($arryPurchase[0]['ReturnID']).''.$time.'.pdf';

		//updated for dynamic template attachment in mail on 25Apr2018 by chetan//	
		if(isset($_POST['tempidd']) && $_POST['tempidd']!=''){
			$file_name = $ModuleDepName.'-'.stripslashes($arryPurchase[0]['ReturnID']).'-temp'.$_POST['tempidd'].'.pdf';			 
			$file_path = $PdfDir.$file_name;
			$ConvetFilename = $ModuleDepName . '-' . stripslashes($arryPurchase[0]['ReturnID']) . '-temp'.$_POST['tempidd']. $time . '.pdf';
		}else{
			$file_name =$ModuleDepName.'-'.stripslashes($arryPurchase[0]['ReturnID']).'.pdf';
			$file_path = $PdfDir.$file_name;
			$ConvetFilename = $ModuleDepName . '-' . stripslashes($arryPurchase[0]['ReturnID']) . '' . $time . '.pdf';
		}
	  	//End//

		if($Config['ObjectStorage']=="1"){
			copy($Config['OsUploadUrl'].$Config['OsDir']."/".$PdfFolder.$file_name, $file_path);
		}

		$_POST['Attachment'] = $file_path;

		/***********/	

		/****************/
		if(empty($arryCompany[0]['Department']) || substr_count($arryCompany[0]['Department'],5)==1){
		        $newDefaultEmail=$objConfigure->GetEmailListId($_SESSION["AdminID"],$_SESSION["CmpID"]);
		        if(!empty($newDefaultEmail[0]["EmailId"])){
				$Config["AdminEmail"]= $newDefaultEmail[0]["EmailId"];
				$_POST['DefaultEmailConfig']=1;
				if($_SESSION['AdminType']!='admin'){
					$OwnerEmailId=$_SESSION['EmpEmail'];
				}else{
					$OwnerEmailId=$_SESSION['AdminEmail'];
				}                    
				$output_dir = "../crm/upload/emailattachment/";
				$output_dir=$output_dir.$OwnerEmailId."/";
				$_POST['OwnerEmailId']=$OwnerEmailId;
				$_POST['output_dir']=$output_dir;
				$_POST['ConvetFilename']=$ConvetFilename;
				
			}
		}		
                /*********end ******/
			
		$_POST['footerSingnature']=$footerSingnature;
		$objPurchase->sendOrderToSupplier($_POST);
		if($Config['ObjectStorage']=="1"){
			unlink($file_path);
		}
		$_SESSION['mess_purchase'] = $MailSend;	
		echo '<script>window.parent.location.href="'.$RedirectURL.'";</script>';
		exit;				
	}




	$OtherEmailHide  = '';
	$OtherSelected = '';
	if(!empty($_GET['view']) || !empty($_GET['po'])){
		$arryPurchase = $objPurchase->GetPurchase($_GET['view'],$_GET['po'],$module);	 
				 
		$OrderID   = $arryPurchase[0]['OrderID'];		 
		if($OrderID>0){
			$numEmail=0;$arrayEmail='';

			$arryPurchaseItem = $objPurchase->GetPurchaseItem($OrderID);
			$NumLine = sizeof($arryPurchaseItem);
			
     			/****start code for get tempalte name for dynamic pdf by sachin***/
			$_GET['ModuleName']	=	$ModuleDepName;
			$_GET['Module']		=	$ModuleDepName;//.$_GET['module']; ////updated on 25Apr2018 by chetan//
			$_GET['ModuleId']	=	$_GET['view'];
			$GetPFdTempalteNameArray=$objConfig->GetSalesPdfTemplate($_GET);
			//added on 25Apr2018 by chetan for default dynamic template//	
			$_GET['setDefautTem']='1';
			$GetDefPFdTempNameArray = $objConfig->GetSalesPdfTemplate($_GET);
			//End//
			/****end code for get tempalte name for dynamic pdf by sachin***/


			/*************/
			$MainEmail = stripslashes($arryPurchase[0]['VendorEmail']);
			$arrayContact = $objPurchase->GetPurchageContactInformation($arryPurchase[0]['SuppID']);
			if(!empty($MainEmail)) $arrayEmail[] = $MainEmail;
			if(!empty($arrayContact[0]['Email'])){
				foreach($arrayContact as $values){
			 		$arrayEmail[] = $values['Email'];
				}   
			}  
			if(!empty($arrayEmail[0])){     
				$arrayEmail = array_unique($arrayEmail);
				sort($arrayEmail); 			
				$numEmail = sizeof($arrayEmail);
			}
			if($numEmail>0){
				$OtherEmailHide = 'style="display:none"';
				$ToEmailHide = '';
				$OtherSelected = '';
			}else{
				$ToEmailHide = ';display:none;';
				$OtherSelected = ' selected';
				$OtherEmailHide='';
			}
			/*************/


		}else{
			$ErrorMSG = $NotExist;
		}
	}else{
		header("Location:".$RedirectURL);
		exit;
	}
				
	

	require_once("../includes/footer.php"); 	 
?>

