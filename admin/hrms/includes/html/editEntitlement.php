
<SCRIPT LANGUAGE=JAVASCRIPT>
function ShowEmpList()
{
	if(!ValidateForSelect(document.getElementById("JobType"), "Job Type")){
		return false;
	}else{
		ShowHideLoader(1,'F');
		location.href= 'editEntitlement.php?t='+document.getElementById("JobType").value;
	}
}

function SelectAllRecord()
{	
	for(i=1; i<=document.form1.Line.value; i++){
		document.getElementById("EmpID"+i).checked=true;
	}

}

function SelectNoneRecords()
{
	for(i=1; i<=document.form1.Line.value; i++){
		document.getElementById("EmpID"+i).checked=false;
	}
}



function ValidateForm(frm)
{

	if(document.getElementById("JobType") != null){
		if(!ValidateForSelect(frm.JobType, "JobType")){
			return false;
		}
	}

	var i=0;
	var flag=0;

	if(document.getElementById("EntID").value<=0){
		if(frm.Line.value > 1){
			for(i=1; i<=frm.Line.value; i++){
				if(document.getElementById("EmpID"+i).checked==true){
					flag=1;	break;
				}else{
					flag=0;
				}
			}
		}else{		
			if(document.getElementById("EmpID1").checked==true) flag=1;
				else flag=0;
		}	
		
		if(flag==0){
			alert('Please check atleast one employee.'); 
			return false;
		}
	}




	if(document.getElementById("EntID").value>0){
		var NumLeaveType = '';
	}else{
		var NumLeaveType = document.getElementById("NumLeaveType").value;
		var DayFlag = 0;
		for(i=1; i<=NumLeaveType; i++){
			if(document.getElementById("Days"+i).value != ''){
				DayFlag = 1; break;
			}
		}

		if(DayFlag==0){
			alert('Please enter day value for entitlement.'); 
			document.getElementById("Days1").focus();
			return false;
		}

	}
	
	
	ShowHideLoader(1,'S');
	return true;
	
	
	
	/*

	if(  ValidateForSelect(frm.LeaveType, "Leave Type")
		&& ValidateMandNumField2(frm.Days,"Days",1,50)
	){
		
		if(document.getElementById("EntID").value>0){
			var Url = "isRecordExists.php?EntitlementEmpID="+escape(document.getElementById("EmpID").value)+"&LeaveType="+document.getElementById("LeaveType").value+"&editID="+document.getElementById("EntID").value;
		
			SendExistRequest(Url,"EmpID","Leave Entitlement");
			return false;
		}else{
			ShowHideLoader(1,'S');
			return true;
		}
	}else{
		return false;	
	}*/
	
}



</SCRIPT>
  <div><a href="<?=$RedirectUrl?>" class="back">Back</a></div>
<div class="had"><?=$MainModuleName?> &raquo; <span>
<? 
$MemberTitle = (!empty($_GET['edit']))?(" Edit ") :(" Add ");
echo $MemberTitle.$ModuleName;
?>
</span>
</div>
<TABLE WIDTH="100%"   BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0 >
	  <form name="form1" action="" method="post" onSubmit="return ValidateForm(this);" enctype="multipart/form-data">
		
		<tr>
		  <td align="center" >
		  <table width="100%"  border="0" cellpadding="0" cellspacing="0" >
            
               
                <tr>
                  <td align="center" valign="top" >
				  
				  <table width="100%" border="0" cellpadding="5" cellspacing="1" class="borderall" >
                  
   <tr style="display:none">
                      <td  align="right"   class="blackbold" > 
					 Leave Period :
					  </td>
                      <td  align="left" valign="top">
<? if(!empty($LeaveStart) && !empty($LeaveEnd)){ ?>

					<? echo date($Config['DateFormat'], strtotime($LeaveStart))." - ".date($Config['DateFormat'], strtotime($LeaveEnd)); ?>

 	<input type="hidden" name="LeaveStart" id="LeaveStart" value="<?=$LeaveStart?>">   
 	<input type="hidden" name="LeaveEnd" id="LeaveEnd" value="<?=$LeaveEnd?>">   

<? }else{
	//$HideSibmit=1;
	//echo NOT_SPECIFIED;
	} ?>

					  </td>
                    </tr>                



			<?  if(empty($arryEntitlement[0]['EmpID'])){	?>
					<tr >
				<td  align="right"   class="blackbold" width="<?=$Width?>">Job Type :<span class="red">*</span></td>
				<td align="left">

				<select name="JobType" class="inputbox" id="JobType" onChange="Javascript:ShowEmpList();">
				  <option value="">--- Select ---</option>
				  <? for($i=0;$i<sizeof($arryJobType);$i++) {?>
				  <option value="<?=stripslashes($arryJobType[$i]['attribute_value'])?>" <?  if(stripslashes($arryJobType[$i]['attribute_value'])==$_GET['t']){echo "selected";}?>>
				 <?=stripslashes($arryJobType[$i]['attribute_value'])?>
				  </option>
				  <? } ?>
				</select>

				 	</td>
			  </tr>						
				<? 
					if(empty($_GET['t'])){ $HideSibmit = 1; $EmpDisplay = 'style="display:none"';}
				
				} ?>







                    <tr <?=$EmpDisplay?>>
                      <td  align="right" valign="top" class="blackbold"> 
					  Employee :<span class="red">*</span> </td>
                      <td   align="left" valign="top">

					<? 	if($_GET['edit'] >0){	?>

						<a class="fancybox fancybox.iframe" href="empInfo.php?view=<?=$arryEntitlement[0]['EmpID']?>"> <?=stripslashes($arryEntitlement[0]['UserName'])?></a> 
						<br><?=stripslashes($arryEntitlement[0]['JobTitle']).' - '.stripslashes($arryEntitlement[0]['Department'])?>
						<br>Job Type: <?=stripslashes($arryEntitlement[0]['JobType'])?>
						
						<input type="hidden" name="EmpID" id="EmpID" value="<?=$arryEntitlement[0]['EmpID']?>">
					<? }else if(sizeof($arryEmployee)>0){ 
						
							if(sizeof($arryEmployee)>1) { $DivStyle = 'style="height:20px;overflow-y:auto "';} 
					 ?>
				
<div id="PermissionValue" style="width:580px; height:180px; overflow:auto">  
<table width="100%"  border="0" cellspacing=0 cellpadding=2>
				  <tr> 
				  	<?   
				  		$flag = 0;
					   if(sizeof($arryEmployee)>0) {					   
					  for($i=0;$i<sizeof($arryEmployee);$i++) { 
					  
					  	if ($flag % 2 == 0) {
							echo "</tr><tr>";
						}
						
						$Line = $flag+1;
					   ?>
                       
                          <td align="left"  valign="top" width="320" height="20">
	 <input type="checkbox" name="EmpID[]" id="EmpID<?=$Line?>" value="<?=$arryEmployee[$i]['EmpID'];?>">&nbsp;
	 
	 <a class="fancybox fancybox.iframe" href="empInfo.php?view=<?=$arryEmployee[$i]['EmpID']?>"><?=stripslashes($arryEmployee[$i]['UserName']);?></a> [<?=stripslashes($arryEmployee[$i]['JobTitle']);?>]							</td>
						 <?
						  $flag++;
						  } 
						  ?>
                        </tr>
						
                        <? }  ?>
                     
</table>
<input type="hidden" name="Line" id="Line" value="<? echo sizeof($arryEmployee);?>">
</Div>	
<?  if(sizeof($arryEmployee)>1) {	?>
    <div align="right">
	<a href="javascript:SelectAllRecord();">Select All</a> | <a href="javascript:SelectNoneRecords();" >Select None</a>
	</div>	
<? } ?>					
					
					
					
					<? }else{ 
						$HideSibmit = 1;
						echo NO_EMPLOYEE_EXIST;
					 } ?>
					  </td>
                    </tr>

				
			<? if($HideSibmit!=1){ 
				
				
				
				if($_GET['edit'] >0){
				
				?>		
			 
			 <tr <?=$EmpDisplay?>>
				<td  align="right"   class="blackbold">Leave Type :</td>
				<td align="left">
				<B><?=$arryEntitlement[0]['LeaveType']?></B>
				</td>
			  </tr>	
			  
			    <tr <?=$EmpDisplay?>>
                      <td align="right" valign="middle"  class="blackbold">Days :</td>
                      <td align="left" >
<input id="Days" name="Days"  class="textbox" size="3" value="<?=$arryEntitlement[0]['Days']?>"  type="text" maxlength="5" onkeypress="return isDecimalKey(event);"> 

                       </td>
                    </tr>
			  	

				<? 
				}else{
				
					for($i=0;$i<sizeof($arryLeaveType);$i++) {					
						$LeaveType = stripslashes($arryLeaveType[$i]['attribute_value']);
						$LineDays = $i+1;
					?>
					<tr <?=$EmpDisplay?>>
					  <td align="right" valign="middle"  class="blackbold"><?=$LeaveType?> :</td>
					  <td align="left" >
					<input id="Days<?=$LineDays?>" name="Days[]"  class="textbox" size="3" value=""  type="text" maxlength="5" onkeypress="return isDecimalKey(event);"> Days

					   </td>
					</tr>
					<? } 
				   
				   }
				}
				 ?>  
			
			
			
			
                   
                   
                  </table>
				  
				  
				  </td>
                </tr>
				
          
          </table>
		  
		  
		  </td>
	    </tr>
		<tr>
				<td align="center" valign="top"><br>
			<? if($_GET['edit'] >0 ) $ButtonTitle = 'Update'; else $ButtonTitle =  'Submit';?>

	<input type="hidden" name="EntID" id="EntID" value="<?=$_GET['edit']?>">  

	<input type="hidden" name="NumLeaveType" id="NumLeaveType" value="<?=sizeof($arryLeaveType)?>">  


	<? if($HideSibmit!=1){ ?>

	<input name="Submit" type="submit" class="button" id="SubmitButton" value=" <?=$ButtonTitle?> " />&nbsp;
	
	<? } ?>
		  
				  
				  
				  </td>
		  </tr>
	    </form>
</TABLE>