<?php
                /**************************************************/
	$ThisPageName = 'viewProduct.php'; $EditPage = 1; $HideNavigation = 1;
	/**************************************************/
	require_once("../includes/header.php");
	require_once($Prefix."classes/product.class.php");
	require_once($Prefix."classes/category.class.php");
	require_once($Prefix."classes/region.class.php");
	require_once($Prefix."classes/manufacturer.class.php");
        require_once($Prefix."classes/cartsettings.class.php");
	require_once($Prefix."classes/function.class.php");
	$objFunction=new functions();
	$objCategory=new category();
	$objRegion=new region();
	$objManufacturer = new Manufacturer();
	$objcartsettings=new Cartsettings();
	$objProduct=new product();

	$arryManufacturer = $objManufacturer->getManufacturer('',1,'','','');
	$arryTaxClasses =$objcartsettings->getClasses(); 
	$listAllCategory =  $objCategory->ListAllCategories();

	$RedirectURL = "viewProduct.php?curP=".$_GET['curP']."";
	$ModuleName  = "Add Product";
	
	
        

 
		 if ($_POST) {
                     
					$checkSku = $objProduct->checkProductSku($_POST['ProductSku']);
					if (count($checkSku) > 0) {
							$_SESSION['mess_product'] = "Product Sku is already exists.";
							//exit;
					} else {
						$_SESSION['mess_product'] = 'Product'.ADDED;
					    $ImageId = $objProduct->AddProduct($_POST);
					}
					
				

				if($_FILES['Image']['name'] != ''){
				
				$FileArray = $objFunction->CheckUploadedFile($_FILES['Image'],"Image");
				if(empty($FileArray['ErrorMsg'])){
						$ImageExtension = GetExtension($_FILES['Image']['name']);
						if(empty($_POST['ProductSku'])){
				                   $ProductSku = 'sku000'.$ImageId;
						   $imageName = $ProductSku.".".$ImageExtension;	
			                       }else{
						   $imageName = $_POST['ProductSku'].".".$ImageExtension;	
						 }

						$MainDir = $Prefix."upload/products/images/".$_SESSION['CmpID']."/";                         
							if (!is_dir($MainDir)) {
								mkdir($MainDir);
								chmod($MainDir,0777);
							}
						
						$ImageDestination = $MainDir.$imageName; 

						//$ImageDestination = $Prefix."upload/products/images/".$imageName;

						if(@move_uploaded_file($_FILES['Image']['tmp_name'], $ImageDestination)){
							$objProduct->UpdateImage($imageName,$ImageId);
						}
					}else{
						$ErrorMsg = $FileArray['ErrorMsg'];
					}
					if(!empty($ErrorMsg)){
						if(!empty($_SESSION['mess_product'])) $ErrorPrefix = '<br><br>';
						$_SESSION['mess_product'] .= $ErrorPrefix.$ErrorMsg;
					}
				}
				
				echo '<script>window.parent.location.href="'.$RedirectURL.'";</script>';
				exit;
		
		}
		
 	$arryProduct = $objConfigure->GetDefaultArrayValue('e_products'); 
	
	require_once("../includes/footer.php"); 
	
?>
