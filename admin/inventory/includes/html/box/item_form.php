<script language="JavaScript1.2" type="text/javascript">
function Getcheckbox(opt)
{	
	if(opt==1){
		document.getElementById("GetGen").value='';
	}
var Model1= document.getElementById("Line").value;
var ModelId='';	
for(i=1; i<=Model1; i++)
{
	if(document.getElementById("Model"+i).checked){
	  	ModelId = ModelId + document.getElementById("Model"+i).value+',';	  
	}		
}

var Gennn= document.getElementById("GetGen").value;

var SendUrl = 'ajax.php?action=Generation&ModelId='+ModelId+'&GenVal='+Gennn+'&r='+Math.random();;

document.getElementById("PermissionValue1").innerHTML = '';
httpObj.open("GET", SendUrl, true);
httpObj.onreadystatechange = function GenRecieve()
{
if (httpObj.readyState == 4)
	{
	//alert(httpObj.responseText);
		
			document.getElementById("PermissionValue1").innerHTML  = httpObj.responseText;
	}
	};
	httpObj.send(null);


}
function CheckGeneration()
{
var jk='';
var Gen= document.getElementById("Generationid").value;
//alert(Gen);
	
for(j=0; j<=Gen; j++)
{
if(document.getElementById("Generation"+j).checked)
		{
	jk += document.getElementById("Generation"+j).value+',';
	//alert(jk);
	  
	    }
else
{
	//jk +=jk+j
	///alert(jk);
}
//alert(jk);
document.getElementById("Generation_type").value  =jk;		
}
//document.getElementById("Generation_type").value  =jk;
}

function SelectAllCheckBox()
{
	var Hgen= document.getElementById("GenIdH").value;
var Model1= document.getElementById("Line").value;
var ModelId='';		
for(i=1; i<=Model1; i++)
{
	if(document.getElementById("Model"+i).checked){
	  	ModelId = ModelId + document.getElementById("Model"+i).value+',';	  
	}		
}


var SendUrl = 'ajax.php?action=Generation&ModelId='+ModelId+'&r='+Math.random();;
	 
	 document.getElementById("PermissionValue1").innerHTML = '';
	httpObj.open("GET", SendUrl, true);
	httpObj.onreadystatechange = function GenRecieve(){
	if (httpObj.readyState == 4)
		{
		//alert(httpObj.responseText);
			
			document.getElementById("PermissionValue1").innerHTML  = httpObj.responseText;
		}
		};
		httpObj.send(null);
	
}

		function validateItem(frm)
		{
			var ManageBOM=document.getElementById("ManageBOM").value;
			//alert(ManageBOM);

		if( ValidateForSelect(frm.non_inventory,"Inventory")
		&& ValidateForSimpleBlank(frm.Sku,"SKU Code")
		&& ValidateForSimpleBlank(frm.description, "Item Description")
		//&& ValidateForSelect(frm.CategoryID,"Category")
		
		)
			{

		if(document.getElementById("non_inventory").value == 'yes')
			{
           //if(!ValidateForSelect(frm.CategoryID,"Category"))
             //  {
              
			// return false;
		       // }
			

      if(ManageBOM==1)
        {
        
			if(!ValidateForSelect(frm.itemType,"Item Type")){
			  return false;
			}
			//if(!ValidateForSelect(frm.procurement_method,"Procurement Method")){
			  //return false;
			//}
			
			
		}
			}
		if(!ValidateOptionalUpload(frm.Image,"Image")){
			  return false;
			}

		var Url = "isRecordExists.php?Sku="+escape(document.getElementById("Sku").value)+"&editID="+document.getElementById("ItemID").value+"&Type=Inventory";
		//alert(Url);

		SendExistRequest(Url,"Sku", "SKU Code "+document.getElementById("Sku").value);
		//SendExistRequest(Url,'Item Sku '+document.getElementById("Sku").value);

		return false;


		}else{
		return false;	
		}	


		}

function SelectAllRecord()
{	
	for(i=1; i<=document.form1.Line.value; i++){
		document.getElementById("Model"+i).checked=true;
	}
	SelectAllCheckBox();
}

function SelectNoneRecords()
{
	for(i=1; i<=document.form1.Line.value; i++){
		document.getElementById("Model"+i).checked=false;
	}
	
	SelectAllCheckBox();
}
function SelectAllRcrd()
{	
	for(i=1; i<=document.form1.Line2.value; i++){
		document.getElementById("WID"+i).checked=true;
	}

}

function SelectNoneRcrds()
{
	for(i=1; i<=document.form1.Line2.value; i++){
		document.getElementById("WID"+i).checked=false;
	}
}

$(document).ready(function() {
	$('#non_inventory').on('change', function() {	 
		if(this.value == 'No'){
			$('#non_inv').hide();
                         $('#CatSpan').hide();
		}else{
			$('#non_inv').show();
                        $('#CatSpan').show();
		}
	});


	$('#ReorderLevel').on('change', function() { 
		if(this.value != ''){
			$('#showReorder').show();
        $('#showreordertext').show();
		}else{
			$('#showReorder').hide();
$('#showreordertext').hide();
		}
	});



});

function SetTrackInventory(){
	if(document.getElementById("non_inventory").value == 'No'){
		$('#non_inv').hide();
	}else{
		$('#non_inv').show();
	}
}
$('#MN').click(function()
		{
		   if ($(this).is(':checked'))
		   {
		      $('#GenIdH').show();
		     // $('#id_of_5th_td').hide();
		      //$('#id_of_3th_td').html('to present');
		   }
		   else
		   {
		      $('#GenIdH').hide();
		     // $('#id_of_5th_td').show();
		     // $('#id_of_3th_td').html('to');
		   }
		});

function Getbox(mod,line){
//alert(line);

if (document.getElementById("Model"+line).checked == true) {
//alert(line);
    document.getElementById("Gen_"+mod).style.display = 'block';
}else{
document.getElementById("Gen_"+mod).style.display = 'none';
}

}



</script>
<? if($_SESSION['SelectOneItem'] == 1){ 

$dis = 'style="display:none"';
}else{

$dis ='';
}

?>
<table width="100%"   border="0" align="center" cellpadding="0" cellspacing="0" >
		<tr>
		<td  align="center" valign="top">

		<form name="form1" id="productBasicInfoForm" action=""  method="post" onSubmit="return validateItem(this);"  enctype="multipart/form-data">
		<tr>
		<td align="center" valign="top" >
		<table width="100%" border="0" cellpadding="3" cellspacing="1"  class="borderall">

		<tr>
		<td colspan="2"  align="left" class="head">Basic Information <span align="right"><a class="fancybox fancybox.iframe add" href="ItemListCopy.php?link=editItem.php" >Copy Item</a></span></td>
		</tr>
		<tr <?=$dis?>>
		<td  align="right"  class="blackbold" > Inventory Item:<span class="red">*</span> </td>
		<td   align="left">
<? if($Config['TrackInventory']=='0'){ ?>
<input name="non_inventory" class="disabled" size="5" id="non_inventory" value="No" readonly>
<? }else{ ?>
	<select name="non_inventory" class="inputbox" id="non_inventory">
	<option value="">-Select-</option>
	<option value="yes" <? if($Config['TrackInventory']=='1'){ echo "selected"; }?>>Yes</option>
	<option value="No" <? if($Config['TrackInventory']=='0'){ echo "selected"; }?>>No</option>
	</select>
<? } ?>


		</td>
		</tr> 
<tr <?=$dis?>>
	<td  align="right"  class="blackbold" >Exclusive Items :</td>
	<td   align="left">

	<select name="is_exclusive" class="inputbox" id="is_exclusive" onchange="getCustomerstr(this.value);">
	<option value="No" <? if($arryProduct[0]['is_exclusive']=='No'){ echo "selected"; }?>>No</option>	
	<option value="Yes" <? if($arryProduct[0]['is_exclusive']=='Yes'){ echo "selected"; }?>>Yes</option>
	
	</select>
	<div style="display:none;" id="CustTR"><a class="fancybox fancybox.iframe" href="CustomerList.php" >Assign Customers</a></div>

	<input type="hidden" name="CustomerID" class="inputbox" id="CustomerID"/>



	</td>
	</tr>         
		<tr>
		<td  align="right"  width="38%"  class="blackbold" > SKU  :<span class="red">*</span>   </td>
		<td   align="left">

		<input name="Sku" type="text" class="inputbox" style="text-transform:uppercase"  id="Sku" value="<? echo stripslashes($arryProduct[0]['Sku']); ?>" maxlength="30" onKeyPress="Javascript:ClearAvail('MsgSpan_Display'); return AvoidSpace(event); " onBlur="Javascript:CheckAvailField('MsgSpan_Display','Sku','<?=$_GET['edit']?>'); "/>

		<span id="MsgSpan_Display"></span>
		<!--<input  name="Sku" id="Sku" onkeypress="return isAlphaKey(event);" value="<? echo stripslashes($arryProduct[0]['Sku']); ?>" type="text" class="inputbox"  maxlength="30" />	--> </td>
		</tr>

		<tr>
		<td  align="right"   class="blackbold" >Item Description :<span class="red">*</span>   </td>
		<td   align="left">
		<input  type="text" name="description" class="inputbox" id="description" value="<? echo stripslashes($arryProduct[0]['description']); ?>" style="width:421px;" maxlength="200" />	 </td>
		</tr>

		<tr >
	<td  align="right"   class="blackbold" >Category /SubCategory :</span> </td>
	<td  align="left">

	<select name="CategoryID" id="CategoryID" class="inputbox" ">
	<option value="">Select Category</option>
	<?php
	$objCategory->getCategories(0, 0, $_GET['CatID']);
	?>
	</select>


	</td>
	</tr>

<tr <?=$dis?>>
<td  colspan="2"  align="right" >
<div id="non_inv" >
<table width="100%"   border="0" cellpadding="0" cellspacing="0">
<?php if($arrySection['Model']==1)
    	{ ?>  
		<tr>
		<td  align="right" width="38%"   class="blackbold" valign="top" >Model : </td>
		<td   align="left">
		
<div id="PermissionValue" style="width:450px; height:300px; overflow:auto">  
<table width="100%"  border="0" cellspacing=0 cellpadding=2>
	<tr> 
		<?   $flag = 0;
		if(sizeof($arryModel)>0) 
		{					   
			for($i=0;$i<sizeof($arryModel);$i++) { 

			if ($flag % 3 == 0)
			 {
			echo "</tr><tr>";
			}

			$Line = $flag+1;
			$class = explode(",",$arryProduct[0]['Model']);
			?>

			<td align="left"  valign="top" width="220" height="20">
				<input type="checkbox" onchange="Getbox(this.value,<?=$Line?>);"  name="Model[]" id="Model<?=$Line?>" <? if(in_array($arryModel[$i]['id'], $class)){ echo "checked"; } ?> value="<?=$arryModel[$i]['id'];?>">&nbsp;
<? $ArrGetGen = $objItem->GetGenrationBasedOnModel($arryModel[$i]['id']);

//print_r($ArrGetGen);?>

				<span  onmouseout="hideddrivetip()"  onmouseover="ddrivetip('<center><?=$ArrGetGen[0]['Generation']?></center>', 200,'')"><?=stripslashes($arryModel[$i]['Model']);?></span> 

&nbsp;&nbsp;&nbsp;<div id="Gen_<?=$arryModel[$i]['id']?>" style="display:none; border: 1px solid gray; width: 100px;">&nbsp;&nbsp;&nbsp;Generation:
<?php $GenArry = explode(",",$ArrGetGen[0]['Generation']); 

//print_r($GenArry);
for($g=0;$g<sizeof($GenArry);$g++) {?>

<div align="left" style="border-top: 1px solid gray; width: 81px;padding: 10px;"><input type="checkbox"   name="Gen_<?=$arryModel[$i]['id']?>[]" id="Gen<?=$arryModel[$i]['id']?>"  value="<?=$GenArry[$g];?>">&nbsp;<?=$GenArry[$g];?></div>

<? }?>
</div>

			</td>
			<?
				$flag++;
			} ?>

			<input type="hidden" name="Line" id="Line" value="<? echo sizeof($arryModel);?>">





		<? }else{ 
			$HideSibmit = 1;
			echo "<td>No Model Exists.</td>";
		}
		?>
	</tr>


</table>
</div>


		</td>
		</tr>
		 
	<?  if(sizeof($arryModel)>1) {	?>
	<!--tr>
		<td></td>
		<td align="right"><a style = "color:white"  class= "button" href="javascript:SelectAllRecord();">Select All</a>  <a style = "color:white" class= "button" href="javascript:SelectNoneRecords();">Select None</a>
	`		</td>
	</tr-->
	<? } ?>
<? } ?>
<?php if($arrySection['Model']==1)
    	{ ?>  
	<!--tr>
		<td  align="right" width="38%"  id="GenIdH"   class="blackbold" valign="top" >Generation : </td>
		<td   align="left">
		
<div id="PermissionValue1" style="width:380px; height:50px; overflow:auto"> </div>
	<input type="hidden" name="Generation_type" id="Generation_type" value="<?=stripslashes($arryProduct[0]['Generation']);?>" />
	<input type="hidden" name="GetGen" id="GetGen" value="<?=stripslashes($arryProduct[0]['Generation']);?>">

		</td>
		</tr-->
<? } ?>

<!--tr>
	<td  align="right"   class="blackbold" >Condition /SubCondition :<span class="red">*</span> </td>
	<td  align="left">

	<select name="Condition" id="Condition" class="inputbox">
	<option value="">Select Condition</option>
	<?php
	$objCondition->getConditions(0, 0, $arryProduct[0]['Condition']);
	?>
	</select>


	</td>
	</tr-->


		<!--tr>
		<td  align="right"   class="blackbold" width="23%" >Condition :<span class="red">*</span> </td>
		<td   align="left">
		<select name="Condition" id="Condition" class="inputbox">
		<option value="">Select Condition</option>
		<? for($i=0;$i<sizeof($arryCondition);$i++) {?>
		<option value="<?=$arryCondition[$i]['attribute_value']?>" <?  if($arryCondition[$i]['attribute_value']==$arryProduct[0]['Condition']){echo "selected";}?>><?=$arryCondition[$i]['attribute_value']?></option> 
		<? } ?> 								 
		</select>
		</td>
		</tr>
		<tr>
		<td  align="right"   class="blackbold" >Extended

		:  </td>
		<td   align="left">
		<select name="Extended" id="Extended" class="inputbox">
		<option value="">Select Extended

		</option>
		<? for($i=0;$i<sizeof($arryExtended);$i++) {?>
		<option value="<?=$arryExtended[$i]['attribute_value']?>" <?  if($arryExtended[$i]['attribute_value']==$arryProduct[0]['Extended']){echo "selected";}?>>
		<?=$arryExtended[$i]['attribute_value']?>
		</option>
		<? } ?>   
		</select>
		</td>
		</tr>
		</tr-->
		
		<tr <?=$dis?>>
		<td  align="right"   class="blackbold" width="38%" >Manufacture: </td>
		<td   align="left">
		<input type="hidden" name="ManageBOM" id="ManageBOM" value="<? echo $arryMainmenuSection['Manage BOM']?>">
		<select name="Manufacture" id="Manufacture" class="inputbox">
		<option value="">Select Manufacture

		</option>
			<? for($i=0;$i<sizeof($arryManufacture);$i++) {?>
			<option value="<?=$arryManufacture[$i]['attribute_value']?>" <?  if($arryManufacture[$i]['attribute_value']==$arryProduct[0]['Manufacture']){echo "selected";}?>>
			<?=$arryManufacture[$i]['attribute_value']?>
			</option>
			<? } ?>   
		</select>
		</td>
		</tr>
		<?php if($arryMainmenuSection['Manage BOM']==1)
    	{ ?> 
    	 
		<tr <?=$dis?>>
		<td  align="right"   class="blackbold" >Item Type :<?php if($arryMainmenuSection['Manage BOM']==1)
    	{ ?> <span class="red">*</span> <?php }?>  </td>
		<td   align="left">
		<select name="itemType" id="itemType" class="inputbox">
		<option value="">Select Item Type</option>
		<? for($i=0;$i<sizeof($arryItemType);$i++) {?>
		<option value="<?=$arryItemType[$i]['attribute_value']?>" <?  if($arryItemType[$i]['attribute_value']==$arryProduct[0]['itemType']){echo "selected";}?>>
					<?=$arryItemType[$i]['attribute_value']?>
					</option>
				<? } ?>   
		</select>
		</td>
		</tr>
<? } ?>
		<tr style="display:none;">
		<td  align="right"   class="blackbold" >Item Serial Number :  </td>
		<td   align="left">
		<input  name="item_serial_number" id="item_serial_number" value="<? if(!empty($arryProduct[0]['item_serial_number']))echo stripslashes($arryProduct[0]['item_serial_number']); ?>" type="text" class="inputbox"  size="30" maxlength="100" />	 </td>
		</tr>
		<tr style="display:none;">
		<td  align="right"   class="blackbold" >Procurement Method :<span class="red">*</span>   </td>
		<td   align="left">

		<?=$dropList?>
		<!--<select name="procurement_method" id="procurement_method" class="inputbox">
		   <option value="">Select Procurement Method</option>
			<? for($i=0;$i<sizeof($arryProcurement);$i++) {?>
				<option value="<?=$arryProcurement[$i]['attribute_value']?>" <?  if($arryProcurement[$i]['attribute_value']==$arryProduct[0]['procurement_method']){echo "selected";}?>>
				<?=$arryProcurement[$i]['attribute_value']?>
				</option>
			<? } ?>

		</select>-->
		</td>
		</tr>
<?php if($arryMainmenuSection['Manage BOM']==1){?>
<!--tr>
		<td  align="right"   class="blackbold" >Valuation Method :<?php if($arryMainmenuSection['Manage BOM']==1)
    	{ ?> <span class="red">*</span> <?php }?>  </td>
		<td   align="left">
		<select name="evaluationType" id="evaluationType" class="inputbox">
		<option value="">Select Valuation</option>
				   <? for($i=0;$i<sizeof($arryEvaluationType);$i++) {?>
					<option value="<?=$arryEvaluationType[$i]['attribute_value']?>" <?  if($arryEvaluationType[$i]['attribute_value']==$arryProduct[0]['evaluationType']){echo "selected";}?>>
					<?=$arryEvaluationType[$i]['attribute_value']?>
					</option>
				<? } ?> 
		</select>
		</td>
		</tr-->
<? } ?>  

		<tr <?=$dis?>>
		<td  align="right"   class="blackbold" >Unit Measure: </td>
		<td   align="left">
		<!--<input  name="UnitMeasure" id="UnitMeasure" value="<? echo stripslashes($arryProduct[0]['UnitMeasure']); ?>" type="text" class="inputbox"  size="30" maxlength="100" />-->	
	
	
	   <select name="UnitMeasure" id="UnitMeasure" class="inputbox">
		              <option value="">Select Unit Measure</option>
					<? for($i=0;$i<sizeof($arryUnit);$i++) {?>
					<option value="<?=$arryUnit[$i]['attribute_value']?>" <?  if($arryUnit[$i]['attribute_value']==$arryProduct[0]['UnitMeasure']){echo "selected";}?>>
					<?=$arryUnit[$i]['attribute_value']?>
					</option>
				<? } ?>   
		</select>
			</td>
		</tr>
<tr <?=$dis?>>
		<td  align="right"   class="blackbold">Reorder Level : </td>
		<td  align="left">
		<!--input  name="ReorderLevel" id="ReorderLevel" value="<? echo stripslashes($arryProduct[0]['ReorderLevel']); ?>" type="text" class="inputbox"  size="30" maxlength="40" /-->	

<select name="ReorderLevel" id="ReorderLevel"onchange="showtr(this.value)" class="inputbox">
		<option value="">Select Reorder Method</option>
		<? for($i=0;$i<sizeof($arryReorder);$i++) {?>
		<option value="<?=$arryReorder[$i]['attribute_value']?>" <?  if($arryReorder[$i]['attribute_value']==$arryProduct[0]['ReorderLevel']){echo "selected";}?>><?=$arryReorder[$i]['attribute_value']?></option> 
		<? } ?> 								 
		</select>

<span id="showreordertext" style="display:none;"><input  name="Reorderlabelbox" id="Reorderlabelbox" value="<? echo stripslashes($arryProduct[0]['Reorderlabelbox']); ?>" type="text" class="inputbox"  size="30" maxlength="100" /></span>

</td>
		</tr>

<tr id="showReorder" style="display:none;">
		<td  align="right"  valign="top"  class="blackbold" width="23%" >Condition : </td>
		<td   align="left">
		<select name="Condition[]" id="Condition" multiple="multiple" size="10" class="inputbox" style="width:200px">
		<?=$ConditionDrop?>							 
		</select>
		</td>
		</tr>
<!--tr style="display:none;">
	<td colspan="2" align="right" >
<div id="showReorder" style="display:none;">
<table width="100%"   border="0" cellpadding="0" cellspacing="0" >
	<tr>
	<td  align="right"  width="38%"  class="blackbold">Min Stock Alert Level : </td>
	<td align="left">
	<input  name="min_stock_alert_level" id="min_stock_alert_level" value="<? echo stripslashes($arryProduct[0]['min_stock_alert_level']); ?>" type="text" class="inputbox"   maxlength="40" />	</td>
	</tr>

	<tr>
	<td  align="right"   class="blackbold">Max Stock Alert Level : </td>
	<td align="left">
	<input  name="max_stock_alert_level" id="max_stock_alert_level" value="<? echo stripslashes($arryProduct[0]['max_stock_alert_level']); ?>" type="text" class="inputbox"   maxlength="40" />	</td>
	</tr>
</table>
</div>
</td>
		</tr-->
<!--tr>
               <td  align="right" class="blackbold">Taxable  :</td>
               <td   align="left">

<input type="checkbox" name="Taxable" id="Taxable" value="Yes" checked>
       
               </td>
</tr-->

		
		
</table></div>
</td>
</tr>


<tr>
		<td  align="right"   class="blackbold" >Purchase Tax Rate :  </td>
		<td   align="left">
				 

<select name="purchase_tax_rate" id="purchase_tax_rate" class="inputbox">
<option value="Yes"<? if($ItemPurchaseTax == 'yes'){ echo 'selected';}?> >Yes </option>
<option value="No" <? if($ItemPurchaseTax == 'no'){ echo 'selected';}?>>No</option>
	
	

	</select>
		</td>
		</tr>


<tr>
		<td  align="right"   class="blackbold" >Sale Tax Rate :  </td>
		<td   align="left">


		<select name="sale_tax_rate" id="sale_tax_rate" class="inputbox">

<option value="Yes" <? if($ItemSaleTax == 'yes'){ echo 'selected';}?>>Yes </option>
<option value="No" <? if($ItemSaleTax == 'no'){ echo 'selected';}?>>No</option>
		
		</select>
		</td>
		</tr>
		<tr>
		<td align="right"   class="blackbold">Status  </td>
		<td  align="left"><span class="blacknormal">
		<?
		$ActiveChecked = ' checked';
		if ($_GET['edit'] > 0) {
		if ($arryProduct[0]['Status'] == 1) {
		$ActiveChecked = ' checked';
		$InActiveChecked = '';
		}
		if ($arryProduct[0]['Status'] == 0) {
		$ActiveChecked = '';
		$InActiveChecked = ' checked';
		}
		}
		?>
		<input type="radio" name="Status" id="Status" value="1" <?= $ActiveChecked ?>>Active&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio" name="Status" id="Status" value="0" <?= $InActiveChecked ?>>InActive    </span></td>
		</tr> 


		<tr>
		<td colspan="2" align="left" class="head">Image </td>
		</tr>   

		<tr style="display:none;">
		<td   align="right"  class="blackbold" >Item Alias :</td>
		<td   ><input name="item_alias" type="text" class="inputbox" id="item_alias" value="<? echo $arryProduct[0]['item_alias']; ?>"  size="10" maxlength="10"></td>
		</tr>
		<tr style="display:none4545;">
		<td  height="70" align="right" valign="top"   class="blackbold"> Item Image </td>
		<td  height="50" align="left" valign="top" >

		<table width="100%" border="0" cellspacing="0" cellpadding="0"  >
		<tr>
		<td width="51%" class="blacknormal" valign="top"><input name="Image" type="file" class="inputbox" id="Image" size="25" onkeypress="javascript: return false;" onkeydown="javascript: return false;" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
		<br>
		<?= $MSG[201] ?>	</td>
		<td width="49%">
		<? if ($arryProduct[0]['Image'] != '' && file_exists('upload/items/images/' . $arryProduct[0]['Image'])) { ?>
		<a  href="Javascript:OpenNewPopUp('showimage.php?img=upload/items/images/<? echo $arryProduct[0][Image]; ?>', 150, 100, 'yes' );"><? echo '<img src="resizeimage.php?w=100&h=100&img=upload/items/images/' . $arryProduct[0]['Image'] . '" border=0  >'; ?></a>	
		<? } ?>	
		</td>
		</tr>
		</table>	</td>
		</tr>




		</table>
		</td></tr>
<?if(!empty($_GET['bc'])){?>		

<tr>
	<td colspan="2">
<table width="100%" border="0" cellpadding="3" cellspacing="1"  class="borderall">
<tr>
	<td colspan="2" align="left" class="head">Dimensions </td>
	</tr>
	<tr style="display:none;">
	<td align="right"  class="blackbold" >Pack Size :</td>
	<td align="left"  class="blacknormal"><input  name="pack_size" id="pack_size" value="<? echo stripslashes($arryProduct[0]['pack_size']); ?>" type="text"  class="textbox"  size="10" maxlength="10" /> 
<input type="hidden" name="CopyItemID" id="CopyItemID" value="<? echo $_GET['bc']; ?>" /></td>
	
        </tr>

	<tr>
	<td align="right"  class="blackbold" width="45%" >Weight</td>
	<td align="left"  class="blacknormal"><input  name="weight" id="weight" value="<? echo stripslashes($arryProduct[0]['weight']); ?>" type="text"  class="textbox"  size="10" maxlength="10" /> 
        <select name="wtUnit" class="textbox" id="wtUnit"  >

	<option value="Lbs"  <?php if ($arryProduct[0]['wt_Unit'] == "Lbs") { echo " selected"; }
?>>&nbsp;Lbs&nbsp;</option>
	<option value="Kg" <?php if ($arryProduct[0]['wt_Unit']== "Kg") { echo " selected"; }?>>&nbsp;Kg&nbsp;</option>
        
        
        
        
	</select> 
        
        </td>
       
        

	</tr>

	<tr>
	<td align="right"  class="blackbold">Length:</td>
	<td align="left"  class="blacknormal"><input  name="width" id="width" value="<? echo stripslashes($arryProduct[0]['width']); ?>" type="text"  class="textbox"  size="10" maxlength="10" /> 
        
          <select name="lnUnit" class="textbox" id="lnUnit" >

	<option value="Inch"  <?php if ($arryProduct[0]['ln_Unit'] == "Inch") { echo " selected"; }
?>>Inch</option>
	<option value="Cm"  <?php if ($arryProduct[0]['ln_Unit'] == "Cm") { echo " selected"; }
?>>Cm</option>
	</select>   
            </td>
        </tr>

	<tr>
	<td align="right"  class="blackbold">Width:</td>
	<td align="left"  class="blacknormal"><input  name="height" id="height" value="<? echo stripslashes($arryProduct[0]['height']); ?>" type="text"  class="textbox"  size="10" maxlength="10" /> 
       
              <select name="wdUnit" class="textbox" id="wdUnit" >

	<option value="Inch"  <?php if ($arryProduct[0]['wd_Unit'] == "Inch") { echo " selected"; }
?>>Inch</option>
	<option value="Cm"  <?php if ($arryProduct[0]['wd_Unit'] == "Cm") { echo " selected"; }
?>>Cm</option>
	</select> 
        </td>
	</tr>

	<tr>
	<td align="right"  class="blackbold">Height:</td>
	<td align="left"  class="blacknormal"><input  name="depth" id="depth" value="<? echo stripslashes($arryProduct[0]['depth']); ?>" type="text"  class="textbox"  size="10" maxlength="10" /> 
       
              <select name="htUnit" class="textbox" id="htUnit" >

	<option value="Inch"  <?php if ($arryProduct[0]['ht_Unit'] == "Inch") { echo " selected"; }
?>>Inch</option>
	<option value="Cm"  <?php if ($arryProduct[0]['ht_Unit'] == "Cm") { echo " selected"; }
?>>Cm</option>
	</select> 
        </td>
	</tr>
</table>
</td></tr>

<tr><td>
<table width="100%" border="0" cellpadding="3" cellspacing="1"  class="borderall">
<tr>
	<td colspan="2" align="left" class="head">Required Items </td>
</tr>	
<tr>
	<td colspan="2" align="left">
<? 
$ItemID = $_GET['bc'];
include("includes/html/box/required_items.php");
?>
</td>
</tr>
</table>
</td></tr>

</td></tr>
<? }?>
		<tr><td height="54" align="center">
		<br>
		<?php
		if ($_GET['edit'] > 0)
		$ButtonTitle = 'Update'; else
		$ButtonTitle = 'Submit';

		$PostedByID = (!empty($arryProduct[0]['PostedByID'])?($arryProduct[0]['PostedByID']):("1"));
		 

		if (sizeof($arryCategory) <= 0)
		$DisabledButton = 'disabled';
		?>
		<input name="Submit" type="submit" class="button" id="SubmitButton" value=" <?= $ButtonTitle ?> "   />
		<input type="hidden" name="ItemID" id="ItemID" value="<? echo $_GET['edit']; ?>" />
		<input type="hidden" name="MaxProductImage" id="MaxProductImage" value="<? echo $MaxProductImage; ?>" />
		<input type="hidden" name="OldStatus" id="OldStatus" value="<?= $arryProduct[0]['Status'] ?>" >
		<input type="hidden" name="NumLanguages" id="NumLanguages" value="<?= $NumLanguages ?>" />
		<input type="reset" name="Reset" value="Reset" class="button" /></td>
		</tr>

		</form>


		</table></td>
		</tr>

		</table>
<script language="JavaScript1.2" type="text/javascript">
SetTrackInventory();
</script>
<script language="JavaScript1.2" type="text/javascript">
 Getcheckbox(0);
//SelectGeneration();
</script>
