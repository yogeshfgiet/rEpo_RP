

<script language="JavaScript1.2" type="text/javascript">

	function ValidateSearch(SearchBy) {
		document.getElementById("prv_msg_div").style.display = 'block';
		document.getElementById("preview_div").style.display = 'none';
	}
	function filterLead(id)
	{
		location.href = "viewLead.php?customview=" + id + "&module=lead&search=Search";
		LoaderSearch();
	}

function SetFlag(LeadID,flag) {

		var SendUrl = "&action=FlagInfo&LeadID=" + escape(LeadID) + "&FlagType=" + flag + "&r=" + Math.random();

		//$("#flaginfo_"+LeadID).show();
		$("#flaginfo_"+LeadID).fadeIn(400).html('<img src ="images/ajax_loader_red_32.gif">');
		$.ajax({
			type: "GET",
			url: "ajax.php",
			data: SendUrl,
			cache: true,
			success: function(result){
//alert(result);

			$("#flaginfo_"+LeadID).html(result);

//<img class="flag_red" title="Flag" alt="Flag" src="images/email_flag.png">

			}  
		});
		return false;

}
$(document).ready(function(){

		$(".to-block").hover(
		function() { 
			$(this).find("a").show(300);
		  },
		  function() {
			 // if($(this).attr('class')!='add-edit-email')
				$(this).find("a").hide();
		
		});
                
                
                $(".flag_white").hide();
                $(".flag_red").show();
                $('.evenbg').hover(function() { 
			$(this).find(".flag_white").show();
                        //$(this).find(".flag_e").css('display','block');
		  },
		  function() {
			 
				$(this).find(".flag_white").hide();
                                //$(this).find(".flag_e").css('display','none');
                });
                $('.oddbg').hover(function() { 
			$(this).find(".flag_white").show();
                        //$(this).find(".flag_e").css('display','block');
		  },
		  function() {
			 
				 $(this).find(".flag_white").hide();
                                 //$(this).find(".flag_e").css('display','none');
                });
                
                
                
                 //By chetan 24 DEC//
                $('#highlight select#RowColor').attr('onchange','javascript:showColorRowsbyFilter(this)');
                $('#highlight select#RowColor option').each(function() {
                    $val = $(this).val();
                    $text = $(this).text();
                    $val = $val.replace('#', '');
                    $(this).val($val);
                });
                //End//
             
                
                //End jquery show/hide for Delete, Mark as Read, Mark as Unread buttons
  
// added by sanjiv
     $( "#MoveToFolder" ).change(function() {
         var ToSelect = 'leadID';
    	 var checkedFlag = 0;
    		var ids = '';
    		var TotalRecords = document.getElementById("NumField").value;
    		var RowColor = document.getElementById("MoveToFolder").value;
    	      
    		if(TotalRecords > 0 && RowColor!=''){
    				for(var i=1;i<=TotalRecords;i++){
    					if(document.getElementById(ToSelect+i).checked==true){
    						if(checkedFlag == 0){
    							checkedFlag = 1;
    						}						
    					}
    				}

    				if(checkedFlag == 0){
    					alert("You must select atleast one record.");  
    					document.getElementById("MoveToFolder").value=''; 
    	                                   
    				}else{				
    					ShowHideLoader(1,'P');
    					document.form1.submit();  
    					return true;			

    				}
    		}
         
     });



     });

//By chetan 24 DEC//
    
    var showColorRowsbyFilter = function(obj)
    {
        if(obj.value !='')
        {
            $url = window.location.href.split("&rows")[0];
            window.location.href = $url+'&rows='+obj.value;
        }
    }
     //End//
</script>
<style>
<!--
.to-block a{
  display: none;
  position: absolute;
  background: #e9e9e9;
  padding: 5px 24px;
    margin-left: -1px;
    margin-top: -5px;
    color:#005dbd;
      border: 1px solid gray;
  border-radius: 5px;
  }
  
  .flag_e:hover{
      cursor:pointer; 
      
  }
  
  
  -->

.flag_e > a {
    display: block;
    float: left;
    width: 0;
}

</style>
<?php
$processImg = '<img src="../images/processing.gif" style="display: inline-block;transform: translate(-34%,13%);"> Lowest price update for all Items (200 items per hours) is in process...';
$processDetails = $objConfig->getPID('crm','lowestPrice');



?>




<div class="had"><?= $MainModuleName ?>

<?php if(!empty($_GET['FolderId'])): foreach ($FolderList1 as $flist): 
	if($flist['FolderId']==$_GET['FolderId']) echo "<span> &raquo; ".$flist['FolderName']."</span>";
	endforeach;
	endif;
	?>   


</div>


<div class="message">

<? if (!empty($_SESSION['CRE_Update'])) {    echo $_SESSION['CRE_Update'];    unset($_SESSION['CRE_Update']);} if(isset($processDetails[0])){echo $processImg; } ?>



<? if (!empty($_SESSION['mess_lead'])) {
    echo $_SESSION['mess_lead'];
    unset($_SESSION['mess_lead']);
} ?></div>
<form action="" method="post" name="form1">
    <TABLE WIDTH="100%"   BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0 >
       
<? if($Config['Junk']==0 && $Config['flag']==0){?>


 <tr>  
            <td  valign="top" align="right">







               
                <? if ($num > 0 ) { ?>


<ul class="export_menu">
<li><a class="hide" href="#">Export Lead</a>
<ul>
<li class="excel" ><a href="export_lead.php?<?=$QueryString?>&flage=1" ><?=EXPORT_EXCEL?></a></li>
<li class="pdf" ><a href="pdfLead.php?<?=$QueryString?>" ><?=EXPORT_PDF?></a></li>
<li class="csv" ><a href="export_lead.php?<?=$QueryString?>&flage=2" ><?=EXPORT_CSV?></a></li>	
<li class="doc" ><a href="export_todoc_Lead.php?<?=$QueryString?>" ><?=EXPORT_DOC?></a></li>	
</ul>
</li>
</ul>


<!--input type="button" class="pdf_button"  name="exp" value="Export To Pdf" onclick="Javascript:window.location = 'pdfLead.php?<?=$QueryString?>';" />
<input type="button" class="export_button"  name="exp" value="Export To Excel" onclick="Javascript:window.location = 'export_lead.php?<?= $QueryString ?>';" -->

 

                    <input type="button" class="print_button"  name="exp" value="Print" onclick="Javascript:window.print();"/>
                <? } ?>

		 <input type="button" class="export_button"  name="imp" value="Import Lead" onclick="Javascript:window.location = 'importLead.php';" />

                <a class="fancybox add_quick fancybox.iframe" href="addLead.php">Quick Entry</a>
                <a href="editLead.php?module=lead" class="add" >Add Lead</a>





                
                <form action="" method="post" name="Indiamart">
                    <table width="100%"  border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td align="right">
                                <input type="hidden" id="indiamart"  name="indiamart" value="indiamart">

                                <input type="submit" id="sync_indiamart" class="search_button" name="sync_indiamart" value="Sync Lead By India Mart" >
                            </td>
                        </tr>
                    </table>
                </form>



                 <!--  <a href="importLeadIndiaMart.php?by=indiamart" class="add" >Import Lead By India Mart</a> -->
                     
<? if ($_GET['key'] != '') { ?>
                    <a class="grey_bt"  href="viewLead.php?module=<?= $_GET['module'] ?>">View All</a>
        <? } ?>




	




            </td>
        </tr>

<? }else{ //Junk Lead section ?>
 <tr>  
            <td   align="right">
 <input type="button" class="print_button"  name="exp" value="Print" onclick="Javascript:window.print();"/>


	<? if ($_GET['key'] != '') { ?>
	    <a class="grey_bt"  href="viewLead.php?module=<?= $_GET['module'] ?>">View All</a>
	<? } ?>

 </td>
        </tr>

<? }




if ($num > 0 && $ModifyLabel==1) { ?>
            <tr>
                <td align="right" height="40" valign="bottom">


<?
$ToSelect = 'leadID';
include_once("../includes/FieldArrayRow.php");
echo $RowColorDropDown;
?>

<?php if($_GET['module'] =='lead'){ ?>
<select name="MoveToFolder" id="MoveToFolder" class="textbox">
<option value="">--- Move To Folder ---</option>
<?php foreach ($FolderList1 as $FValue){?>
<option value="<?=$FValue['FolderId']?>"><?=$FValue['FolderName']?></option>
<?php }?>
<?php if(!empty($FolderList1)){?>
<option value="lead" style="color:#005dbd;">Manage Lead</option>
<?php }?>			
</select>
<?php } ?>



<input type="submit" name="MoveButton" class="button" value="<?=$MoveTitle?>" onclick="javascript: return ValidateMultiple('lead', '<?=strtolower($MoveTitle)?>', 'NumField', 'leadID');">

<? if($DeleteLabel==1){ ?>
<input type="submit" name="DeleteButton" class="button" value="Delete" onclick="javascript: return ValidateMultiple('lead', 'delete', 'NumField', 'leadID');">
<? } ?>



                </td>
            </tr>
<? } ?>


        <tr>
            <td  valign="top">



                <div id="prv_msg_div" style="display:none"><img src="images/loading.gif">&nbsp;Searching..............</div>
                <div id="preview_div">

                    <table <?= $table_bg ?>>
<? if ($_GET["customview"] == 'All') { ?>
                            <tr align="left"  >
<td class="head1" >Lead Name</td>
															<? foreach ($LeadCusFldArr as $key => $values) { ?>
																			<td width=""  class="head1" ><?= $values['fieldlabel'] ?></td>

															<? } ?>
                                <!--td width="8%"  class="head1" >Lead No</td-->
                                <!--td class="head1" >Lead Name</td-->
                                <!--td width="11%" class="head1">Company  </td-->
                                <!--td width="9%" class="head1">Lead Type  </td-->
                               
                                <!--td width="13%" class="head1" > Primary Email</td>
                                <td  class="head1" > Sales Person</td>
																	<td width="12%" class="head1">	Phone  </td>
                                <td width="5%"  align="center" class="head1" > Status</td>
                                <td width="10%" align="center" class="head1" > Lead Date</td-->
                                <td width="13%"  align="center" class="head1 head1_action" >Action</td>
                              <? if($ModifyLabel==1){ ?>  <td width="1%" class="head1" ><input type="checkbox" name="SelectAll" id="SelectAll" onclick="Javascript:SelectCheckBoxes('SelectAll', 'leadID', '<?= sizeof($arryLead) ?>');" /></td><?}?>
                            </tr>
<? } else { ?>
                            <tr align="left"  >
                                <? foreach ($arryColVal as $key => $values) { ?>
                                    <td width=""  class="head1" ><?= $values['colname'] ?></td>

    <? } ?>
                                <td width="13%"  align="center" class="head1 head1_action" >Action</td>
                                <td width="1%" class="head1" ><input type="checkbox" name="SelectAll" id="SelectAll" onclick="Javascript:SelectCheckBoxes('SelectAll', 'leadID', '<?= sizeof($arryLead) ?>');" /></td>
                            </tr>

                        <?
                        }
                        if (is_array($arryLead) && $num > 0) {
                            $flag = true;
                            $Line = 0;

                            $LeadNo = 0;
                            $LeadNo = ($_GET['curP'] - 1) * $RecordsPerPage;

                            foreach ($arryLead as $key => $values) {
                                $flag = !$flag;
                                $bgcolor = ($flag) ? ("#FAFAFA") : ("#FFFFFF");
                                $Line++;
                                $LeadNo++;

                                //if($values['ExpiryDate']<=0 || $values['Status']<=0){ $bgcolor="#000000"; }
	//code by bhoodev
		if($values['FlagType']=='Yes' ){ 
			$FlageImage='<img class="flag_red" title="Flag" alt="Flag" src="images/email_flag2.png">'; 
			$FlagType = 'Yes';
		}else{
			$FlageImage='<img class="flag_white" title="Flag" alt="Flag" src="images/email_flag.png">';
			$FlagType = 'No';
		}
        //End         
                                ?>
                                <tr align="left"  bgcolor="<?= $bgcolor ?>" <? if(!empty($values['RowColor'])){ echo 'style="background-color:'.$values['RowColor'].'"'; }?>>     
        <? if ($_GET["customview"] == 'All' || $_GET["customview"] =='' ) { ?>   
                                      <!--td><?= $LeadNo ?></td-->
                                        <td> 
                                        <?php 
                                        $leadNameee = stripslashes($values["FirstName"] . " " . stripslashes($values["LastName"]));
                                     
                                        if($leadNameee != " "){ 
                                        ?>
                                            <a href="vLead.php?view=<?php echo $values['leadID']; ?>&amp;curP=<?php echo $_GET['curP']; ?>&amp;module=<?php echo $_GET['module']; ?>" ><?= $leadNameee ?></a>		       </td>
                                      <?php  }else { echo NOT_SPECIFIED; } ?>




<td onmouseover="mouseoverfun('company','<?php echo $values['leadID']; ?>')"
					onmouseout="mouseoutfun('company','<?php echo $values['leadID']; ?>')"><span
					id="company<?php echo $values['leadID']; ?>"><?= (!empty($values['company'])) ? (stripslashes($values['company'])) : (NOT_SPECIFIED) ?></span>
					<?php if($ModifyLabel==1 && $FieldEditableArray['company']==1){ ?>
				<span class="editable_evenbg" id="field_company<?php echo $values['leadID']; ?>"></span> <span
					id="edit_company<?php echo $values['leadID']; ?>"
					style="cursor: pointer; display: none;"
					onclick="getField('c_lead','company','leadID','<?php echo $values['leadID']; ?>','<?php echo $FieldTypeArray['company']?>');"><?= $edit ?></span>
					<?php }?>
</td>
                                <!--td><?= (!empty($values['type'])) ? (stripslashes($values['type'])) : (NOT_SPECIFIED) ?></td-->
                                       

   <td	onmouseover="mouseoverfun('primary_email','<?php echo $values['leadID']; ?>');"	onmouseout="mouseoutfun('primary_email','<?php echo $values['leadID']; ?>');"><span
					id="primary_email<?php echo $values['leadID']; ?>"><?= (!empty($values['primary_email'])) ? (stripslashes($values['primary_email'])) : (NOT_SPECIFIED) ?></span>
					<?php if($ModifyLabel==1 && $FieldEditableArray['primary_email']==1){ ?>
				<span class="editable_evenbg" id="field_primary_email<?php echo $values['leadID']; ?>"></span>
				<span id="edit_primary_email<?php echo $values['leadID']; ?>"
					style="cursor: pointer; display: none;"
					onclick="getField('c_lead','primary_email','leadID','<?php echo $values['leadID']; ?>','<?php echo $FieldTypeArray['primary_email']?>');"><?= $edit ?></span>
					<?php }?></td>


   <td onmouseover="mouseoverfun('AssignTo','<?php echo $values['leadID']; ?>');"	onmouseout="mouseoutfun('AssignTo','<?php echo $values['leadID']; ?>');">
				<div id="AssignTo<?php echo $values['leadID']; ?>"><?
				if ($values['AssignType'] == 'Group') {

					$arryGrp = $objGroup->getGroup($values['GroupID'], 1);
					$AssignName = $arryGrp[0]['group_name'];

					if ($values['AssignTo'] != '') {
						$arryAssignee = $objLead->GetAssigneeUser($values['AssignTo']);
						echo $AssignName;
						echo '<br>';
						?> <? foreach ($arryAssignee as $values2) { ?> <!--img border="0" title="Manager" src="../images/manager.png"-->
				<a class="fancybox fancybox.iframe"
					href="../userInfo.php?view=<?= $values2['EmpID'] ?>"><?= $values2['UserName'] ?></a>,<br>
					<?
						}
					}
				} else if ($values['AssignTo'] != '') {

					if ($values['AssignTo'] != '') {
						$arryAssignee2 = $objLead->GetAssigneeUser($values['AssignTo']);
						$assignee = $values['AssignTo'];
					}
					$AssignName = $arryAssignee2[0]['UserName'];
					?> <? foreach ($arryAssignee2 as $values3) { ?> <!--img border="0" title="Manager" src="../images/manager.png"-->
				<a class="fancybox fancybox.iframe"
					href="../userInfo.php?view=<?= $values3['EmpID'] ?>"><?= $values3['UserName'] ?></a>,<br>
					<?
					}
				} else {
					echo NOT_SPECIFIED;
				}
				?></div>
				<?php if($ModifyLabel==1 && $FieldEditableArray['AssignTo']==1){ ?>
				<span class="editable_evenbg" id="field_AssignTo<?php echo $values['leadID']; ?>"></span> <span
					id="edit_AssignTo<?php echo $values['leadID']; ?>"
					style="cursor: pointer; display: none;"
					onclick="getField('c_lead','AssignTo','leadID','<?php echo $values['leadID']; ?>','<?php echo $FieldTypeArray['AssignTo']?>');"><?= $edit ?></span>
					<?php }?></td>

<td
					onmouseover="mouseoverfun('LandlineNumber','<?php echo $values['leadID']; ?>')"
					onmouseout="mouseoutfun('LandlineNumber','<?php echo $values['leadID']; ?>');"><?php if(!empty($values['LandlineNumber'])) { echo '<span id="LandlineNumber'.$values['leadID'].'">'.stripslashes($values['LandlineNumber']).'</span>';  ?>
				<a href="javascript:void(0);"
					onclick="call_connect('call_form','to','<?=stripslashes($values['LandlineNumber'])?>','<?=$values['leadID']?>','<?=$country_code?>','<?=$country_prefix?>','Lead')"
					class="call_icon"><span class="phone_img"></span></a> <? } else { echo '<span id="LandlineNumber'.$values['leadID'].'">'.NOT_SPECIFIED.'</span>'; } ?>
					<?php if($ModifyLabel==1 && $FieldEditableArray['LandlineNumber']==1){ ?>
				<span class="editable_evenbg" id="field_LandlineNumber<?php echo $values['leadID']; ?>"></span>
				<span id="edit_LandlineNumber<?php echo $values['leadID']; ?>"
					style="cursor: pointer; display: none;"
					onclick="getField('c_lead','LandlineNumber','leadID','<?php echo $values['leadID']; ?>','<?php echo $FieldTypeArray['LandlineNumber']?>');"><?= $edit ?></span>
					<?php }?></td>




 <!--td >
      <?php if(!empty($values['LandlineNumber'])) { echo stripslashes($values['LandlineNumber']);  ?>

          <a href="javascript:void(0);"  onclick="call_connect('call_form','to','<?=stripslashes($values['LandlineNumber'])?>','<?=$values['leadID']?>','<?=$country_code?>','<?=$country_prefix?>','Lead')" class="call_icon"><span class="phone_img"></span></a>    
     <? } else { echo NOT_SPECIFIED; } ?>
 </td-->




                                        <td align="center"
					onmouseover="mouseoverfun('lead_status','<?php echo $values['leadID']; ?>')"
					onmouseout="mouseoutfun('lead_status','<?php echo $values['leadID']; ?>');">
				<span id="lead_status<?php echo $values['leadID']; ?>"><?= $values['lead_status']; ?></span>
				<?php if($ModifyLabel==1 && $FieldEditableArray['lead_status']==1){ ?>
				<span class="editable_evenbg" id="field_lead_status<?php echo $values['leadID']; ?>"></span>
				<span id="edit_lead_status<?php echo $values['leadID']; ?>"
					style="cursor: pointer; display: none;"
					onclick="getField('c_lead','lead_status','leadID','<?php echo $values['leadID']; ?>','<?php echo $FieldTypeArray['lead_status']?>','<?php echo $SelectboxEditableArray['lead_status']['selecttbl']?>','<?php echo $SelectboxEditableArray['lead_status']['selectfield']?>','<?php echo $SelectboxEditableArray['lead_status']['selectfieldType']?>');"><?= $edit ?></span>
					<?php }?> <!------------------- Rajan Code Commented for multiple editing --------------------------- -->

				<!------------------- By Rajan 22 Dec --------------------------- -->
				<!--<select name="status" style="width: 130px" class="inputbox"
					id="status"
					onchange="ChangeStatus(this.value,<?php echo $values['leadID']; ?>)">
					<option value="">--Select Status---</option>
					<?php

					$arryVal = $objCommon->GetCrmAttribute('LeadStatus', '');
					for ($i = 0; $i < sizeof($arryVal); $i++)
					{
						$select ='';
						if($values['lead_status'] == $arryVal[$i]['attribute_value']) { $select = "selected=selected";}
						echo '<option value="'.$arryVal[$i]['attribute_value'].'" '.$select.'>'.$arryVal[$i]['attribute_value'].'</option>';
					}

					?>
				</select> --><!--------------------- End ------------------------------------>
				<!--<span class="message" id="statusup<?=$values['leadID']?>"></span> <?//= (!empty($values['lead_status'])) ? (stripslashes($values['lead_status'])) : (NOT_SPECIFIED) ?>
				--></td>

				<td align="center"><?= ($values['LeadDate'] > 0) ? (date($Config['DateFormat'], strtotime($values['LeadDate']))) : (NOT_SPECIFIED) ?>
				</td>
                                    <?
                                    } else {

                                        foreach ($arryColVal as $key => $cusValue) {
                                            	echo '<td onmouseover="mouseoverfun(\''.$cusValue['colvalue'].'\',\''.$values['leadID'].'\');"  onmouseout="mouseoutfun(\''.$cusValue['colvalue'].'\',\''.$values['leadID'].'\');" >';

						if ($cusValue['colvalue'] == 'AssignTo') {
							echo '<div id="AssignTo'.$values['leadID'].'">';

							if ($values[$cusValue['colvalue']] != '') {
								$arryAssignee = $objLead->GetAssigneeUser($values[$cusValue['colvalue']]);

								foreach ($arryAssignee as $users) {
									?>
				<a class="fancybox fancybox.iframe"
					href="../userInfo.php?view=<?= $users['EmpID'] ?>"><?= $users['UserName'] ?></a>
				,
				<?
								}
							} else {
								echo NOT_SPECIFIED;
							}
							echo '</div>';?>
							<?php if($ModifyLabel==1 && $FieldEditableArray[$cusValue['colvalue']]==1){ ?>
				<span
					class="editable_evenbg" id="field_<?php echo $cusValue['colvalue'].$values['leadID']; ?>"></span>
				<span
					id="edit_<?php echo $cusValue['colvalue'].$values['leadID']; ?>"
					style="cursor: pointer; display: none;"
					onclick="getField('c_lead','<?php echo $cusValue['colvalue'];?>','leadID','<?php echo $values['leadID']; ?>','<?php echo $FieldTypeArray[$cusValue['colvalue']]?>' ,'<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selecttbl']?>','<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selectfield']?>','<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selectfieldType']?>');"><?= $edit ?></span>
					<?php }?>


					<?php } elseif ($cusValue['colvalue'] == 'country_id') {?>

					<?= (!empty($values['CountryName'])) ? ('<span id="'.$cusValue['colvalue'].$values['leadID'].'">'.stripslashes($values['CountryName']).'</span>') : ('<span id="'.$cusValue['colvalue'].$values['leadID'].'">'.NOT_SPECIFIED.'</span>') ?>
					<?php if($ModifyLabel==1 && $FieldEditableArray[$cusValue['colvalue']]==1){ ?>
				<span
					class="editable_evenbg" id="field_<?php echo $cusValue['colvalue'].$values['leadID']; ?>"></span>
				<span
					id="edit_<?php echo $cusValue['colvalue'].$values['leadID']; ?>"
					style="cursor: pointer; display: none;"
					onclick="getField('c_lead','<?php echo $cusValue['colvalue'];?>','leadID','<?php echo $values['leadID']; ?>','<?php echo $FieldTypeArray[$cusValue['colvalue']]?>' ,'<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selecttbl']?>','<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selectfield']?>','<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selectfieldType']?>');"><?= $edit ?></span>
					<?php }?>
					<?} elseif ($cusValue['colvalue'] == 'state_id') {?>

					<?= (!empty($values['StateName'])) ? ('<span id="'.$cusValue['colvalue'].$values['leadID'].'">'.stripslashes($values['StateName']).'</span>') : ('<span id="'.$cusValue['colvalue'].$values['leadID'].'">'.NOT_SPECIFIED.'</span>') ?>
					<?php if($ModifyLabel==1 && $FieldEditableArray[$cusValue['colvalue']]==1){ ?>
				<span
					class="editable_evenbg" id="field_<?php echo $cusValue['colvalue'].$values['leadID']; ?>"></span>
				<span
					id="edit_<?php echo $cusValue['colvalue'].$values['leadID']; ?>"
					style="cursor: pointer;"
					onclick="getField('c_lead','<?php echo $cusValue['colvalue'];?>','leadID','<?php echo $values['leadID']; ?>','<?php echo $FieldTypeArray[$cusValue['colvalue']]?>' ,'<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selecttbl']?>','<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selectfield']?>','<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selectfieldType']?>');"><?= $edit ?></span>
					<?php }?>
					<? } elseif ($cusValue['colvalue'] == 'city_id') {?>

					<?= (!empty($values['CityName'])) ? ('<span id="'.$cusValue['colvalue'].$values['leadID'].'">'.stripslashes($values['CityName']).'</span>') : ('<span id="'.$cusValue['colvalue'].$values['leadID'].'">'.NOT_SPECIFIED.'</span>') ?>
					<?php if($ModifyLabel==1 && $FieldEditableArray[$cusValue['colvalue']]==1){ ?>
				<span
					class="editable_evenbg" id="field_<?php echo $cusValue['colvalue'].$values['leadID']; ?>"></span>
				<span
					id="edit_<?php echo $cusValue['colvalue'].$values['leadID']; ?>"
					style="cursor: pointer; display: none;"
					onclick="getField('c_lead','<?php echo $cusValue['colvalue'];?>','leadID','<?php echo $values['leadID']; ?>','<?php echo $FieldTypeArray[$cusValue['colvalue']]?>' ,'<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selecttbl']?>','<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selectfield']?>','<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selectfieldType']?>');"><?= $edit ?></span>
					<?php }?>

					<? } else if($cusValue['colvalue'] == 'UpdatedDate' || $cusValue['colvalue'] == 'JoiningDate' || $cusValue['colvalue'] == 'LeadDate') {
				
				if($values[$cusValue['colvalue']]>0)
				echo '<span id="'.$cusValue['colvalue'].$values['leadID'].'">'.date($Config['DateFormat'] , strtotime($values[$cusValue['colvalue']])).'</span>';

                        }else {
                                            ?>

                    <?= (!empty($values[$cusValue['colvalue']])) ? ('<span id="'.$cusValue['colvalue'].$values['leadID'].'">'.stripslashes($values[$cusValue['colvalue']]).'</span>') : ('<span id="'.$cusValue['colvalue'].$values['leadID'].'">'.NOT_SPECIFIED.'</span>') ?> 
                <?
                }?>
		<?php if($ModifyLabel==1 && $FieldEditableArray[$cusValue['colvalue']]==1){ ?>
				<span
					class="editable_evenbg" id="field_<?php echo $cusValue['colvalue'].$values['leadID']; ?>"></span>
				<span
					id="edit_<?php echo $cusValue['colvalue'].$values['leadID']; ?>"
					style="cursor: pointer; display: none;"
					onclick="getField('c_lead','<?php echo $cusValue['colvalue'];?>','leadID','<?php echo $values['leadID']; ?>','<?php echo $FieldTypeArray[$cusValue['colvalue']]?>' ,'<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selecttbl']?>','<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selectfield']?>','<?php echo $SelectboxEditableArray[$cusValue['colvalue']]['selectfieldType']?>');"><?= $edit ?></span>
					<?php }?>
               <?php echo '</td>';
            }
        }
        ?>

                                <td  align="center" class="head1_inner">

<? if($ModifyLabel==1){ ?>
    <span id="flagemail_<?php echo $values["leadID"] ?>" class="flag_e" style="float:left;"><a href="" onclick="return SetFlag('<?=$values['leadID']?>','<?=$FlagType?>');" id="flaginfo_<?=$values['leadID']?>""><?=$FlageImage?></a> &nbsp;</span>
<a class="fancybox fancybox.iframe" href="editConvertForm.php?view=<?=$values['leadID']?>" id="convert">
								<img border="0" onmouseout="hideddrivetip()" style="padding: 0 2px;width: 17px;" onmouseover="ddrivetip('<center>Convert Lead</center>', 90,'')" src="images/convert.png">
<? } ?>




<!--img src="images/convert.jpg" style="padding: 0 2px;width: 17px;" alt="" title="Conver Lead"-->
</a>
<!-- code by bhoodev
<a href="" onclick="return SetFlag('<?=$values['leadID']?>','<?=$FlagType?>');" id="flaginfo_<?=$values['leadID']?>" ><?=$FlageImage?></a>End--><a href="vLead.php?view=<?php echo $values['leadID']; ?>&amp;curP=<?php echo $_GET['curP']; ?>&amp;module=<?php echo $_GET['module']; ?>" ><?= $view ?></a>


<? if($ModifyLabel==1){ ?>
<a href="editLead.php?edit=<?php echo $values['leadID']; ?>&amp;module=<?php echo $_GET['module']; ?>&amp;curP=<?php echo $_GET['curP']; ?>&amp;tab=Lead" ><?= $edit ?></a>

<a href="editLead.php?del_id=<?php echo $values['leadID']; ?>&amp;module=<?php echo $_GET['module']; ?>&amp;curP=<?php echo $_GET['curP']; ?>" onclick="return confirmDialog(this, '<?= $ModuleName ?>')"  ><?= $delete ?></a>  



<a class="fancybox com fancybox.iframe"  href="vLead.php?view=<?php echo $values['leadID']; ?>&module=<?php echo $_GET['module']; ?>&curP=<?php echo $_GET['curP']; ?>&tab=Comments&popLead=1" ><?=$comment?></a>
<? } ?>
 </td>
                               

<? if($ModifyLabel==1){ ?>
 <td ><input type="checkbox" name="leadID[]" id="leadID<?= $Line ?>" value="<?= $values['leadID'] ?>" /></td>
<?}?>
                                </tr>
                                    <?php } // foreach end //?>

<?php } else { ?>
                            <tr align="center" >
                                <td  colspan="11" class="no_record">No record found. </td>
                            </tr>
<?php } ?>

                        <tr >  <td  colspan="11" >Total Record(s) : &nbsp;<?php echo $num; ?>      <?php if (count($arryLead) > 0) { ?>
                                    &nbsp;&nbsp;&nbsp;     Page(s) :&nbsp; <?php echo $pagerLink;
}
?></td>
                        </tr>
                    </table>

                </div> 
<? if (sizeof($arryLead)) { ?>
                    <table width="100%" align="center" cellpadding="3" cellspacing="0" style="display:none">
                        <tr align="center" > 
                            <td height="30" align="left" ><input type="button" name="DeleteButton" class="button"  value="Delete" onclick="javascript: ValidateMultipleAction('<?= $ModuleName ?>', 'delete', '<?= $Line ?>', 'leadID', 'editLead.php?curP=<?= $_GET['curP'] ?>&opt=<?= $_GET['opt'] ?>');">
                                <input type="button" name="ActiveButton" class="button"  value="Active" onclick="javascript: ValidateMultipleAction('<?= $ModuleName ?>', 'active', '<?= $Line ?>', 'leadID', 'editLead.php?curP=<?= $_GET['curP'] ?>&opt=<?= $_GET['opt'] ?>');" />
                                <input type="button" name="InActiveButton" class="button"  value="InActive" onclick="javascript: ValidateMultipleAction('<?= $ModuleName ?>', 'inactive', '<?= $Line ?>', 'leadID', 'editLead.php?curP=<?= $_GET['curP'] ?>&opt=<?= $_GET['opt'] ?>');" /></td>
                        </tr>
                    </table>
<? } ?>  

                <input type="hidden" name="CurrentPage" id="CurrentPage" value="<?php echo $_GET['curP']; ?>">
                <input type="hidden" name="opt" id="opt" value="<?php echo $ModuleName; ?>">

                <input type="hidden" name="NumField" id="NumField" value="<?= sizeof($arryLead) ?>">
		<input type="hidden" name="opentd" class="inputbox" id="opentd" value="">
            </td>
        </tr>
    </table>
</form>

<script language="JavaScript1.2" type="text/javascript">

$(document).ready(function() {
		$("#convert").fancybox({
			'width'         : 700
		 });

});
//By Rajan 22 dec //

function ChangeStatus(val,leadID){
$("#statusup"+leadID).fadeIn(400).html('<img width="10px" height="10px" src ="images/ajax_loader_red_32.gif">');
		var SendUrl = "&action=changeStatus&status="+val+"&leadID="+leadID;
		$.ajax({
			type: "GET",
			url: "ajax.php",
			data: SendUrl,
			success: function (responseText) {
			//alert(responseText);
			   if(responseText){//location.reload(true);
//$("#statusup").val() ="Done";
$("#statusup"+leadID).html('Status Updated');
setTimeout(function() { $("#statusup"+leadID).hide(); }, 1000);
}
			}

		   });
		
	}

//   End  //


var interval;
processCheck = function (){ 
     $.ajax({
        url : "ajax.php",
        type: "GET",
        data : { action: 'processCheck', taskmsg: 'addLead' },
        success: function(data)
        {    
            data = $.parseJSON(data);
            
             if(data.msgStsus=='2') { 
                $(".message").html('<img src="../images/processing.gif" style="display: inline-block;transform: translate(-34%,13%);"> India Mart Lead syncing is in process...');
                $('#sync_indiamart').prop('disabled', true);
                $("#sync_indiamart").css('background-color','#9AAB9C');
             }else if(data.msgStsus=='1') { 
                 $(".message").html('India Mart Lead syncing has been completed.');
                 $('#sync_indiamart').prop('disabled', false);
                 $("#sync_indiamart").css('background-color','#d40503');
             }

             if(data.status=='0'){
                 $('#sync_indiamart').prop('disabled', false);
                clearInterval(interval);
                return false;
             }
             
        },
        error: function( data ){
            $('#sync_indiamart').prop('disabled', false);
            clearInterval(interval);
            return false;
        }
     });
    
}



$( window ).load(function() {
    setTimeout(function(){
        processCheck();
    },100);
    interval = setInterval(processCheck,6000);
});






</script>
