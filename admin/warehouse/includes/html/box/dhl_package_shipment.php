<table width="100%" border="0" align="center" cellpadding="0"
	cellspacing="0">

	<tbody>
		<tr>
			<td align="center" valign="top">

			<table width="100%" border="0" cellpadding="5" cellspacing="0"
				class="borderall">
				<tbody>



					<tr>
						<td colspan="2" align="left" class="head">Shipping Carrier Details</td>
					</tr>



					<tr>
						<td align="right" class="blackbold">Packages Type:<span
							class="red">*</span></td>
						<td align="left"><select name="packageType" size="1"
							id="packageType" class="inputbox">
							<option value="">--Select--</option>
							
							<?php 
							foreach($arrayPackage as $arrayPac){?>
							<option value="<?php echo $arrayPac['service_value'];?>"
							<?=($packageType==$arrayPac['service_value'])?('selected'):('')?>><?=$arrayPac['service_type'];?>
							
					</option>
							
							<?php } ?>
							

						</select></td>
					</tr>




<tr>
<td align="right" class="blackbold">Service Type:<span class="red">*</span></td>
<td align="left">
 <select name="Service" size="1"
	id="Service" class="inputbox">
	<option value="">--Select--</option>
	<?php 
	foreach($arrayService as $ServiceVal){?>
	<option value="<?php echo $ServiceVal['service_value'];?>"
	<?=($Service==$ServiceVal['service_value'])?('selected'):('')?>><?=$ServiceVal['service_type'];?>
	
</option>
	
	<?php } ?>

</select></td>
</tr>



					<tr>
						<td align="right" class="blackbold">Special Service:</td>
						<td align="left"><select name="specialService" size="1"
							id="specialService" class="inputbox">
							<option value="">--Select--</option>
							
							<?php 
							foreach($arraySpecialService as $SpecialService){?>
							<option value="<?php echo $SpecialService['special_service_value'];?>"
							<?=($specialService==$SpecialService['special_service_value'])?('selected'):('')?>><?=$SpecialService['special_service_name'];?>
							
					</option>
							
							<?php } ?>
							

						</select></td>
					</tr>




					<tr>
						<td align="right" class="blackbold">Account Type :<span
							class="red">*</span></td>
						<td align="left"><select name="AccountType" class="inputbox"
							id="AccountType" onchange="masterDetail()">
							<option value="">Select</option>
							<option value="1"
							<?php if($_POST['AccountType']=='1'){ echo "selected='selected'";}?>>Customer</option>
							<option value="2"
							<?php if($_POST['AccountType']=='2'){ echo "selected='selected'";}?>>Shipper</option>
							<option value="3"
							<?php if($_POST['AccountType']=='3'){ echo "selected='selected'";}?>>Third
							Party</option>
						</select></td>
					</tr>



					<tr>
						<td align="right" class="blackbold">Account Number :<span
							class="red">*</span></td>
						<td align="left"><input name="AccountNumber" type="text"
							class="inputbox" id="AccountNumber"
							value="<?=$AccountNumber?>"
							maxlength="50"  ></td>
					</tr>



					<tr>
						<td align="right" class="blackbold">Master Zipcode:<span
							class="red">*</span></td>
						<td align="left"><input name="SourceZipcode" type="text"
							id="SourceZipcode"
							value="<?=$SourceZipcode?>"
							maxlength="30" onkeypress="return isDecimalKey(event);" readonly
							class="disabled_inputbox"></td>
					</tr>


					<tr>
						<td align="right" class="blackbold">Destination Zipcode:<span
							class="red">*</span></td>
						<td align="left"><input name="DestinationZipcode" type="text"
							id="DestinationZipcode" class="inputbox"
							value="<?=$DestinationZipcode?>"
							maxlength="30" onkeypress="return isDecimalKey(event);" 
							></td>
					</tr>


					<tr>
						<td align="right" width="45%" class="blackbold">No Of Packages:<span
							class="red">*</span></td>
						<td align="left"><select name="NoOfPackages" class="inputbox"
							id="NoOfPackages" onchange="addRows();">
							<option value="">-----select-----</option>
							<?php
							for($i=1;$i<=25;$i++){?>
					<option value="<?=$i?>"<?=($NoOfPackages==$i)?('selected'):('')?>><?=$i?></option>
							<?php } ?>
						</select></td>
					</tr>
					
					
					<tr>
						<td align="right" class="blackbold">Insure Amount:</td>
						<td align="left"><input name="InsureAmount" type="text"
							class="textbox" size="10" id="InsureAmount" value="<?=$InsureAmount?>"
							maxlength="10" onkeypress="return isDecimalKey(event);"> 
						
						<input
						type="text" value="<?=$Currency?>" style="width:30px;border:none" maxlenght="10" readonly="" class="textbox"
						id="InsureCurrency" name="InsureCurrency">
					     </td>
					</tr>
					
					
					<tr style="display:none;">
						<td align="right" class="blackbold">Custom/Declared Value:</td>
						<td align="left"><input name="DeclaredValue" type="text"
							class="textbox" size="10" id="DeclaredValue" value="<?=$DeclaredValue?>"
							maxlength="10" onkeypress="return isDecimalKey(event);"> 
						
						<input
						type="text" value="<?=$Currency?>" style="width:30px;border:none" maxlenght="10" readonly="" class="textbox"
						id="DeclaredCurrency" name="DeclaredCurrency">
					     </td>
					</tr>
					
					
					
					<tr>

						<td align="right" class="blackbold">Shipmaster Label:</td>
						<td align="left"><input type="checkbox" name="fedexLabel"
							value="Yes" <?=($fedexLabel=='Yes')?('checked'):('')?>></td>
					</tr>


					<tr>

						<td align="right" class="blackbold"></td>
						<td align="left"><input name="fdAccount" type="hidden"
							id="fdAccount"
							value="<?= $arryApiACDetails[0]["api_account_number"];?>"></td>
					</tr>

				</tbody>
			</table>


			</td>
		</tr>

		<input name="Action" type="hidden" id="Action"
			value="<?php echo $_GET['sp'];?>">

	</tbody>


</table>


<table width="86%" cellpadding="0" cellspacing="1" id="wline">

	<thead>
		<tr align="left">
			<td class="heading" style="padding-left: 33px;">Weight</td>
			<td class="heading" style="padding-left: 33px;">WUnit</td>
			<td class="heading" style="padding-left: 33px;">Length</td>
			<td class="heading" style="padding-left: 33px;">Width</td>
			<td class="heading" style="padding-left: 33px;">Height</td>
			<td class="heading" style="padding-left: 33px;">DUnit</td>

		</tr>


	</thead>
	<input type="hidden" name="NumLine" id="NumLine" value=""
		maxlength="20" />
</table>

<table width="41%" id="myTable" class="order-list" cellpadding="0"
	cellspacing="1">


	<tbody>

	</tbody>
	<tfoot>


		<tr class='itembg11111111111'>
			<td colspan="11" align="right"></td>

		</tr>

		<tr class="itembg">
			<td><input type="text" class="textbox" id="Weight1" name="Weight1"
				value="1" size="10" maxlength="10"
				onkeypress="return isDecimalKey(event);"></td>
			<td><select class="textbox" id="wtUnit1" name="wtUnit1">
				<option value="LB">Lbs</option>
				<option value="KG">Kg</option>
			</select></td>
			<td><input type="text" class="textbox" id="Length1" name="Length1"
				value="1" size="10" maxlength="10"
				onkeypress="return isDecimalKey(event);"></td>
			<td><input type="text" onkeypress="return isNumberKey(event);"
				maxlength="6" size="5" class="textbox" value="1" id="Width1"
				name="Width1"></td>
			<td><input type="text" class="textbox" id="Height1" name="Height1"
				value="1" size="10" maxlength="10"
				onkeypress="return isDecimalKey(event);"></td>
			<td><select class="textbox" id="htUnit1" name="htUnit1">
				<option value="IN">Inch</option>
				<option value="CM">Cm</option>
			</select></td>
		</tr>



	</tfoot>

</table>


<table>

	<tr>
		<td align="center"><input name="Submit" type="submit" class="button"
			id="SubmitButton" value="Submit"></td>
			
		     <td align="center"><input name="Preview" type="submit" class="button"
			id="Preview" value="Rate Quote"></td>
			
	</tr>

</table>