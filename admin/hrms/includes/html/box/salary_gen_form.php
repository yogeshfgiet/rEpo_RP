<SCRIPT LANGUAGE=JAVASCRIPT>
function ShowLeaveAmount(amount)
{
	var LeaveHTML = '';
	if(parseInt(amount)>0){
		LeaveHTML += "<b>Total Amount to Deduct for Leave: "+amount+"</b>";
	}
	document.getElementById("LeaveAmountSpan").innerHTML = LeaveHTML;

}

</SCRIPT>


<table width="100%"  border="0" cellpadding="0" cellspacing="0" >
	<form name="form1" action="" method="post" onSubmit="return ValidateForm(this);" enctype="multipart/form-data">		   
			   
			 <?	 if($ShowList==1){ ?>  
			 
		
	
	<tr>
		 <td class="had2" style="text-align:center">Salary for the period of <?=date('F, Y', strtotime($_GET['y'].'-'.$_GET['m'].'-01'))?></td>
	</tr>
			 
	<tr>
	  <td align="center" valign="top"  >
		 <? include("includes/html/box/emp_box.php");
	
		if(!empty($arryEmployeeDt[0]['WorkingHourStart']) && !empty($arryEmployeeDt[0]['WorkingHourEnd'])){
			$WorkingHour = $objTime->GetTimeDifference($arryEmployeeDt[0]['WorkingHourStart'],$arryEmployeeDt[0]['WorkingHourEnd'],1);
		}
	
	
	?>
	  </td>
	</tr>			 
	<tr>
	  <td align="center" valign="top"  >
		 <? include("includes/html/box/leave_box.php"); ?>
	  </td>
	</tr>		 
			 
	 <tr>
                  <td align="center" height="30"  >
				  <div id="msg_div" class="redmsg"></div>
				  </td>
		</tr>
		



 <tr>
   <td align="center" valign="top"  >

				  
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="borderall" >
	<tr>
		 <td colspan="2" align="left" class="head">Salary Details</td>
	</tr> 	
	
	<tr>
		  <td align="right" width="45%" class="blackbold">CTC :</td>
		  <td align="left" >
		
	<input id="CTC" name="CTC" class="disabled" readonly value="<?=$arrySalary[0]['CTC']?>"  type="text" size="15" > 
	 <?=$Config['Currency']?> 
	 

		   </td>
		</tr>
	
	
<? 
$NumDayMonth = date('t', strtotime($_GET['y'].'-'.$_GET['m'].'-01'));


$AllField = ''; $Total = 0; $Deduction = 0; $Retirals=0; $OtherAddition=0;
foreach($arryPayCategory as $key=>$values_cat){
	$arryHead = $objPayroll->getHead('',$values_cat['catID'],$catEmp,1);
	if(sizeof($arryHead)>0 || $values_cat['catGrade']=="D"){


	if($values_cat['Status']==1){
		$TotalLabel .= $values_cat['catGrade'].' + ';
		$OnField = 'class="disabled" readonly=""';
	}else{
		$OnField = 'class="textbox" onblur="Javascript:SetFormValues(\'1\');" onkeypress="return isDecimalKey(event);Javascript:ClearMsg();" ';
	}
?>			
	 <tr>
		 <td colspan="2" align="left" class="head2"><?=stripslashes($values_cat['catName'])?></td>
	</tr>     

	<? 	
	$SubTotal = 0; 
	foreach($arryHead as $key=>$values){
	
		$FieldName = 'Field'.$values['headID'];
		
		if($values['Default']==1){
			$BasicField = $FieldName;
			//$BasicSalary = round($arrySalaryDb[1],2);
		}
		
		
		$AmtPer = ($values['HeadType']=="Percentage")?($values['Percentage']):($values['Amount']);
		
		$AllField .= $FieldName.','.$values['HeadType'].','.$AmtPer.','.stripslashes($values['heading']).','.$values_cat['catGrade'].'#';
		
		
		
		$FieldValue = round($arrySalaryDb[$values['headID']],2);
		$SubTotal+=$FieldValue;
		
		if($values_cat['catGrade']=="C"){ 
			$Retirals+=$FieldValue; 
		}
		if(($values_cat['catGrade']=="D" || $values_cat['catGrade']=="E" ) && empty($_GET['edit'])){ 
			$FieldValue = ($values['HeadType']=="Percentage")?(($BasicSalary*$values['Percentage'])/100):($values['Amount']);
			$FieldValue = round($FieldValue,2);
			$SubTotal += $FieldValue;
		}



	 ?>	
		
		  
	<tr>
		  <td align="right" width="45%" class="blackbold"><?=stripslashes($values['heading'])?> <?=stripslashes($values['subheading'])?> :<?=$Mand?></td>
		  <td align="left" >

	<input id="<?=$FieldName?>" name="<?=$FieldName?>"  value="<?=$FieldValue?>"  type="text" maxlength="10" size="15"   <?=$OnField?> >  
	 <?=$Config['Currency']?>  
	
		   </td>
		</tr>		
	<? } ?>	
	
	
	
	<? if($values_cat['catGrade']=="D"){
	
		$SubTotal += $arrySalary[0]['LeaveDeduction'];
		
		
	 ?>


	 <? if($arryCurrentLocation[0]['Advance']==1){ 	 
		 $AdvanceAmount = ($arrySalary[0]['Advance']!=$TotalAdvanceAmount)?($TotalAdvanceAmount):($arrySalary[0]['Advance']);
		 if($AdvanceAmount>0){
		 $SubTotal += $AdvanceAmount;
	 ?>
	 <tr>
		  <td align="right" class="blackbold">Advance : </td>
		  <td align="left" >
	<input id="Advance" name="Advance"  value="<?=round($AdvanceAmount,2)?>"  type="text" maxlength="10" size="15" onkeypress="return isDecimalKey(event);Javascript:ClearMsg();" class="disabled" readonly=""  onblur="Javascript:SetFormValues('1');"> 
	 <?=$Config['Currency']?>  


			&nbsp;&nbsp;&nbsp;<a class="fancybox action_bt fancybox.iframe" href="empAdvance.php?emp=<?=$_GET['emp']?>&y=<?=$_GET['y']?>&m=<?=$_GET['m']?>">Advance Summary</a>

			<? #echo (!empty($TotalAdvanceAmount))?("Total Advance: ".round($TotalAdvanceAmount,2)):(" "); ?>

			<input type="hidden" name="AdvanceData" id="AdvanceData" value="<?=$AdvanceData?>">

		   </td>
		</tr>
	<? } }?>

	 <? if($arryCurrentLocation[0]['Loan']==1){ 	 
		 $LoanAmount = ($arrySalary[0]['Loan']!=$TotalLoanAmount)?($TotalLoanAmount):($arrySalary[0]['Loan']);
		 if($LoanAmount>0){
		 $SubTotal +=  $LoanAmount; 
		 ?>
		<tr>
		  <td align="right" class="blackbold">Loan : </td>
		  <td align="left" >
	<input id="Loan" name="Loan"  value="<?=round($LoanAmount,2)?>"  type="text" maxlength="10" size="15" onkeypress="return isDecimalKey(event);Javascript:ClearMsg();" class="disabled" readonly="" onblur="Javascript:SetFormValues('1');"> 
	 <?=$Config['Currency']?> 

			&nbsp;&nbsp;&nbsp;<a class="fancybox action_bt fancybox.iframe" href="empLoan.php?emp=<?=$_GET['emp']?>&y=<?=$_GET['y']?>&m=<?=$_GET['m']?>">Loan Summary</a> 

			<? #echo (!empty($TotalLoanAmount))?("Total Loan: ".round($TotalLoanAmount,2)):(" "); ?>
			<input type="hidden" name="LoanData" id="LoanData" value="<?=$LoanData?>">

		   </td>
		</tr>
	<? }} ?>





	<? if($LeaveTakenMonth>0){?>
	<tr>
		  <td align="right" class="blackbold" valign="top">Leave To Deduct : </td>
		  <td align="left" valign="top">
		  
		  <? echo '<div class="select-wrap"><select name="LeaveDeducted" id="LeaveDeducted" class="textbox" onchange="Javascript:SetFormValues(\'1\');">';
			  for($i=0;$i<=$LeaveTakenMonth;$i=$i+0.5){
				  $sel = ($arrySalary[0]['LeaveDeducted']==$i)?('selected'):('');
				echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
			}
			echo '</select></div>';
			?>		  
		    
		   </td>
		</tr>
		<?}?>
	<tr>
		  <td align="right" class="blackbold" valign="top">Leave Deduction : </td>
		  <td align="left" valign="top">
		  <? if(empty($arrySalary[0]['LeaveDeduction'])) $arrySalary[0]['LeaveDeduction']=0;?>
		  	<div id="LeaveAmountSpan" style="float:right"></div>
	<input id="LeaveDeduction" name="LeaveDeduction"  value="<?=$arrySalary[0]['LeaveDeduction']?>"  type="text" maxlength="10" size="15" onkeypress="return isDecimalKey(event);Javascript:ClearMsg();" class="disabled" readonly="" onblur="Javascript:SetFormValues('1');"> 
	 <?=$Config['Currency']?> 
		   </td>
		</tr>
	


	<? } 
	
	
	
	$SubTotal = round($SubTotal,2);
	?>	
	
	
	<tr>
		 <td align="right"  class="blackbold" ><strong>SUB TOTAL - <?=$values_cat['catGrade']?> :</strong></td>
		 <td align="left" ><input id="SubTotal<?=$values_cat['catGrade']?>" name="SubTotal<?=$values_cat['catGrade']?>" class="disabled" readonly="" value="<?=$SubTotal?>"  type="text"  size="15"   > 
	 <?=$Config['Currency']?> </td>
	</tr>   
		
 <? 
 	if($values_cat['Status']==1){ 
		$LastActiveSubTotal = $SubTotal; //Get Retirals Subtotal
		$Total+=$SubTotal;
	}else{
		if($values_cat['catGrade']=='D'){
			$Deduction+=$SubTotal; 
		}else if($values_cat['catGrade']=='E'){
			$OtherAddition+=$SubTotal; 
		}
	}
 
 	
 
	} 
 
 } 
 
  
 	$AllField = rtrim($AllField,"#");
 	$TotalLabel = rtrim($TotalLabel," + ");
 
 





 
 	//$Total = round($Total);  //$Total = $arrySalary[0]['Gross'];
	$TotalPM = $Total;  //round($Total/12);	
	$NetPM = $Total - $Retirals;  //$NetPM = $arrySalary[0]['NetSalary']; //round(($Total - $Retirals)/12);
	
	$CurrentPM = $NetPM;
	$CurrentPM = ($NetPM + round($OtherAddition,2) )- round($Deduction);






	$PerDaySalary = round($NetPM/$NumDayMonth);
    $PerHourSalary =  round($PerDaySalary / $WorkingHour, 2);
	
		
	/*******************/
	$ShortLeaveAmountToDeduct=0;
	
	if($ShortLeaveExtra>0){
		$ShortLeaveAmountToDeduct = $ShortLeaveExtra*$PerDaySalary;
	}

	if($LeaveTakenMonth>0){
		$LeaveAmountToDeduct = $LeaveTakenMonth*$PerDaySalary;
		echo '<script>Javascript:ShowLeaveAmount('.round($LeaveAmountToDeduct).');</script>';
	}


 ?>		                  
      





	<tr>
		 <td  colspan="2" height="5" ></td>
	</tr>


	<!--tr>
		 <td  colspan="2" class="head2">Others</td>
	</tr>

	<tr>
		  <td align="right" class="blackbold">Arrear : </td>
		  <td align="left" >
		  <? $CurrentPM += round($arrySalary[0]['Arrear']); ?>
	<input id="Arrear" name="Arrear"  value="<?=round($arrySalary[0]['Arrear'])?>"  type="text" maxlength="10" size="15" onkeypress="return isDecimalKey(event);Javascript:ClearMsg();" class="textbox" onblur="Javascript:SetFormValues('1');"> 
	 <?=$Config['Currency']?> 
		   </td>
		</tr-->


	 <? if($TotalOvertimeHour>0){
		  $TotalOvertime = $PerHourSalary*$TotalHoursRate;
		  $Overtime = ($arrySalary[0]['Overtime']!=$TotalOvertime)?($TotalOvertime):($arrySalary[0]['Overtime']);

		  $CurrentPM += round($Overtime);
	 ?>
		<tr>
		  <td align="right" class="blackbold">Overtime : </td>
		  <td align="left" >
	<input id="Overtime" name="Overtime"  value="<?=round($Overtime)?>"  type="text" maxlength="10" size="15" onkeypress="return isDecimalKey(event);Javascript:ClearMsg();" class="disabled" readonly="" onblur="Javascript:SetFormValues('1');"> 
	 <?=$Config['Currency']?> 

		<? echo '&nbsp;&nbsp;&nbsp;<strong>Total Overtime Hours : '.GetHourMinute($TotalOvertimeHour).'</strong>'; 
		
		   #echo '<br>&nbsp;&nbsp;&nbsp;['.$PerHourSalary.' '.$Config['Currency'].' Per Hour]';
		?>

		   </td>
		</tr>
	


	<? }
	
	if($TotalBonus>0 || $arrySalary[0]['Bonus']>0){
		  $Bonus = ($arrySalary[0]['Bonus']>0)?($arrySalary[0]['Bonus']):($TotalBonus);
		  $CurrentPM += round($Bonus);
	 ?>
		<tr>
		  <td align="right" class="blackbold">Bonus : </td>
		  <td align="left" >
	<input id="Bonus" name="Bonus"  value="<?=round($Bonus)?>"  type="text" maxlength="10" size="15" onkeypress="return isDecimalKey(event);Javascript:ClearMsg();" class="disabled" readonly="" onblur="Javascript:SetFormValues('1');"> 
	 <?=$Config['Currency']?> 

	<input type="hidden" name="BonusIDs" id="BonusIDs" value="<?=$BonusIDs?>">

		   </td>
		</tr>
	<? } 


	if($TotalCommission>0 || $arrySalary[0]['Commission']>0){
		  $Commission = ($arrySalary[0]['Commission']>0)?($arrySalary[0]['Commission']):($TotalCommission);
		  $CurrentPM += round($Commission);
	 ?>
		<tr>
		  <td align="right" class="blackbold">Sales Commission : </td>
		  <td align="left" >
	<input id="Commission" name="Commission"  value="<?=round($Commission,2)?>"  type="text" maxlength="10" size="15" onkeypress="return isDecimalKey(event);Javascript:ClearMsg();" class="disabled" readonly="" onblur="Javascript:SetFormValues('1');"> 
	 <?=$Config['Currency']?> 



&nbsp;&nbsp;&nbsp;<a class="fancybox action_bt fancybox.iframe" href="../finance/payReport.php?pop=1&s=<?=$_GET['emp']?>&f=<?=$FromDate?>&t=<?=$ToDate?>">Sales Report</a>



		   </td>
		</tr>
	<? }

	?>



	

	<tr>
		 <td  colspan="2" height="5" ></td>
	</tr>
	      
		<tr>
		 <td align="right"  class="head"  ><strong>GROSS (<?=$TotalLabel?>) :</strong></td>
		 <td align="left" class="head redmsg"> <span id="TotalDiv"><? if($Total>0) echo number_format($Total);  else echo '0'; ?></span> <?=$Config['Currency']?> 
		 
		
		  </td>
	</tr>    	
		<tr>
		 <td  colspan="2" height="5" ></td>
	</tr>
		<tr>
		 <td align="right"  class="head"  ><strong>GROSS APPROX  PM :</strong></td>
		 <td align="left" class="head redmsg"> <span id="TotalPmDiv"><? if($TotalPM>0) echo number_format($TotalPM);  else echo '0'; ?></span> <?=$Config['Currency']?>
		 
		 <input type="hidden" name="Gross" id="Gross" value="<?=$TotalPM?>" >
		   </td>
	</tr>     
	<tr>
		 <td  colspan="2" height="5" ></td>
	</tr>
	
	
	<tr>
		 <td align="right"  class="head"  ><strong>NET SALARY PM :</strong></td>
		 <td align="left" class="head redmsg"> <span id="NetDiv">
		 <? 
		 
		 if($NetPM>0) echo number_format($NetPM);  else echo '0'; ?></span> <?=$Config['Currency']?>
		 
		 <input type="hidden" name="NetSalary" id="NetSalary" value="<?=round($NetPM)?>" >
		 <input type="hidden" name="PerDaySalary" id="PerDaySalary" value="<?=$PerDaySalary?>" >

&nbsp;&nbsp;&nbsp;
<span class="normal">
<?	echo '['.$PerDaySalary.' '.$Config['Currency'].' Per Day]'; ?>
</span>




		   </td>
	</tr> 
	<tr>
		 <td  colspan="2" height="5" ></td>
	</tr>
	<tr>
		 <td align="right"  class="head"  ><strong>CURRENT MONTH SALARY :</strong></td>
		 <td align="left" class="head redmsg"> <span id="CurrentDiv"><? if($CurrentPM>0) echo number_format($CurrentPM);  else echo '0'; ?></span> <?=$Config['Currency']?>
		 
		 <input type="hidden" name="CurrentSalary" id="CurrentSalary" value="<?=round($CurrentPM)?>" >
		   </td>
	</tr> 
	
	
	 	  
		           
                  </table>
		  
				  
				  </td>
                </tr>
				
				<tr>
				<td align="center" valign="top" >
			<? if($_GET['edit'] >0 ) $ButtonTitle = 'Update'; else $ButtonTitle =  'Submit';?>

	<input type="hidden" name="payID" id="payID" value="<?=$_GET['edit']?>">  
	<input type="hidden" name="EmpID" id="EmpID" value="<?=$_GET['emp']?>">
	<input type="hidden" name="catEmp" id="catEmp" value="<?=$catEmp?>">

	<input name="Submit" type="submit" class="button" id="SubmitButton" value=" <?=$ButtonTitle?> " />

&nbsp;
<input type="hidden" name="BasicField" id="BasicField" value="<?=$BasicField?>" >

	<input type="hidden" name="Year" id="Year" value="<?=$_GET['y']?>">  
	<input type="hidden" name="Month" id="Month" value="<?=$_GET['m']?>">

	<input type="hidden" name="LeaveTaken" id="LeaveTaken" value="<?=$LeaveTakenMonth?>">  

<input type="hidden" name="CompIDs" id="CompIDs" value="<?=$CompIDs?>">



				  </td>
		  </tr>
		  
		  
		  
<? } ?> 	
		
		
			</form>	
          
 </table>

<SCRIPT LANGUAGE=JAVASCRIPT>
var allField = '<?=$AllField?>';
function SetFormValues(opt){
	ClearMsg();
	var FieldName,FieldValue,FieldValueTemp,HeadType,AmtPer,FieldLabel,catGrade,SubTotalA=0,SubTotalB=0,SubTotalC=0,SubTotalD=0,
		SubTotalE=0,Total=0,LeaveDeduction=0,Advance=0,Loan=0,LeaveDeducted=0,PerDaySalary=0;
	var BasicFieldName = document.getElementById("BasicField").value; 
	var BasicSalary = Trim(document.getElementById(BasicFieldName)).value;
	var arrField = allField.split("#");
	if(BasicSalary!='' && !isNaN(BasicSalary)){
		
		for(var i = 1; i < arrField.length; i++) {
			var arrField2 = arrField[i].split(",");
			FieldName = arrField2[0];
			HeadType = arrField2[1];
			AmtPer = arrField2[2];
			FieldLabel = arrField2[3];
			catGrade = arrField2[4];
			
			FieldValue=0;
			
			if(catGrade=="D" || catGrade=="E"){			
				if(opt==1){
					FieldValueTemp = parseFloat(document.getElementById(FieldName).value);
					if(FieldValueTemp!='' && !isNaN(FieldValueTemp)){
						FieldValue = FieldValueTemp;
					}
				}else{
					if(HeadType=='Percentage'){
						FieldValue = (BasicSalary*AmtPer)/100;
					}else{
						FieldValue = AmtPer;
					}
				}			
				if(catGrade=="D"){ SubTotalD += FieldValue; }
				if(catGrade=="E"){ SubTotalE += FieldValue; }
				document.getElementById(FieldName).value = FieldValue;				
			}
			
			
			
		}
		
		

		
		if(document.getElementById("SubTotalD") != null){

			/*************************/
			if(document.getElementById("LeaveDeducted") != null){
				var LeaveDeducted = parseFloat(document.getElementById("LeaveDeducted").value);
				var PerDaySalary = parseFloat(document.getElementById("PerDaySalary").value);
				LeaveDeduction = LeaveDeducted*PerDaySalary;
				document.getElementById("LeaveDeduction").value = Math.round(LeaveDeduction,2);
			}
			/*************************/
			if(document.getElementById("LeaveDeduction") != null){
				LeaveDeduction = parseFloat(document.getElementById("LeaveDeduction").value);
				if(LeaveDeduction!='' && !isNaN(LeaveDeduction)){
					SubTotalD += LeaveDeduction;
				}else{
					LeaveDeduction=0;
				}
				document.getElementById("LeaveDeduction").value = LeaveDeduction;
			}
			/*************************/
			if(document.getElementById("Advance") != null){
				Advance = parseFloat(document.getElementById("Advance").value);
				if(Advance!='' && !isNaN(Advance)){
					//Advance = Math.round(Advance);
					SubTotalD += Advance;
				}else{
					Advance=0;
				}
				document.getElementById("Advance").value = Advance;
			}
			/*************************/
			if(document.getElementById("Loan") != null){
				Loan = parseFloat(document.getElementById("Loan").value);
				if(Loan!='' && !isNaN(Loan)){
					//Loan = Math.round(Loan);
					SubTotalD += Loan;
				}else{
					Loan=0;
				}
				document.getElementById("Loan").value = Loan;
			}
			/*************************/

			document.getElementById("SubTotalD").value = Math.round(SubTotalD,2);
		}	
			
			
		

		if(document.getElementById("CurrentDiv") != null){
			NetSalary = document.getElementById("NetSalary").value;
		    	var CurrentSalary = NetSalary - Math.round(SubTotalD); 

			if(document.getElementById("SubTotalE") != null){
				document.getElementById("SubTotalE").value = Math.round(SubTotalE,2);
				CurrentSalary = CurrentSalary + Math.round(document.getElementById("SubTotalE").value);
			}

			if(document.getElementById("Arrear") != null){
				CurrentSalary = CurrentSalary + Math.round(document.getElementById("Arrear").value);
			}

			if(document.getElementById("Overtime") != null){
				CurrentSalary = CurrentSalary + Math.round(document.getElementById("Overtime").value);
			}
			if(document.getElementById("Bonus") != null){
				CurrentSalary = CurrentSalary + Math.round(document.getElementById("Bonus").value);
			}
			if(document.getElementById("Commission") != null){
				CurrentSalary = CurrentSalary + Math.round(document.getElementById("Commission").value);
			}
			
			document.getElementById("CurrentDiv").innerHTML = number_format(CurrentSalary) ;
			document.getElementById("CurrentSalary").value = CurrentSalary;
		}
		
		
	}
	
	
}




function ValidateForm(frm)
{
	ClearMsg();
	var FieldName,FieldLabel,catGrade;
	var BasicFieldName = document.getElementById("BasicField").value; 
	var BasicSalary = Trim(document.getElementById(BasicFieldName)).value;
	
	var arrField = allField.split("#");
	
	if(BasicSalary!='' && !isNaN(BasicSalary)){
		for(var i = 1; i < arrField.length; i++) {
			var arrField2 = arrField[i].split(",");
			FieldName = arrField2[0];
			FieldLabel = arrField2[3];
			catGrade = arrField2[4];
			if(catGrade=="D"){
				if(!ValidateOptDecimalField(document.getElementById(FieldName),FieldLabel)){
					return false;
				}
			}
		}	
		
		ShowHideLoader(1,'S');

		return true;
				
	}
	
	
}


</SCRIPT>