<!--Amit Singh-->
<script type="text/javascript" src="js/password_strength.js"></script>
<?php if(empty($_GET['edit']))
{ ?>
    <style>
        #pswd-info-wrap, #pswd-retype-info-wrap {
            right: 296px !important;
            top: 368px !important;
        }
    </style>
<?php }else{?>
    <style>
        #pswd-info-wrap, #pswd-retype-info-wrap {
            right: 355px !important;
            top: 253px !important;
        }
    </style>
<?php }?>
<script language="JavaScript1.2" type="text/javascript">
    
    function validateEmployee(frm)
    {

        var DataExist = 0;

        if (document.getElementById("Uid").value > 0)
        {

            /*
             if(!isPassword(frm.Password))
             {
             return false;
             }*/
            if (!ValidateMandRange(frm.newPassword, "Password", 5, 15))
            {
                return false;
            }
            if (!ValidateForPasswordConfirm(frm.newPassword, frm.ConfirmPassword)) {
                return false;
            }
            //****************Amit Singh*******************/
            var isvaldd = $('#isvalidate').val();
            //alert(isvaldd);
            if (isvaldd != '1') {
                alert("Please Enter Valid Password.");
                return false;
            }
            //*********************************************/

        }


        if (ValidateForSimpleBlank(frm.FirstName, "First Name")
                && ValidateForSimpleBlank(frm.LastName, "Last Name")
                && ValidateRadioButtons(frm.Gender, "Gender")



                && ValidateForSimpleBlank(frm.Designation, "Designation")


                && ValidateForSimpleBlank(uEmail, "Email")
                && isEmail(frm.uEmail)
                )
        {


            if (document.getElementById("Uid").value <= 0)
            {

                if (!ValidateForSimpleBlank(frm.uPassword, "Password"))
                {
                    return false;
                }

                /*
                 if(!isPassword(frm.Password)){
                 return false;
                 }*/
                if (!ValidateMandRange(frm.uPassword, "Password", 5, 15))
                {
                    return false;
                }
                if (!ValidateForPasswordConfirm(frm.uPassword, frm.ConfirmPassword)) {
                    return false;
                }
                
                 //****************Amit Singh*******************/
            var isvaldd = $('#isvalidate').val();
            //alert(isvaldd);
            if (isvaldd != '1') {
                alert("Please Enter Valid Password.");
                return false;
            }
            //*********************************************/

            }









            /**********************
             DataExist = CheckExistingData("isRecordExists.php", "&Type=User&Email="+escape(document.getElementById("uEmail").value)+"&Uid="+document.getElementById("Uid").value, "Email","Email Address");
             
             if(DataExist==1)return false;
             /**********************/


            var Url = "isRecordExists.php?Type=User&uEmail=" + escape(document.getElementById("uEmail").value) + "&Uid=" + document.getElementById("Uid").value;
            SendExistRequest(Url, "uEmail", "Email Address");

            return false;

        }

        else
        {
            return false;
        }




    }
</script>
<div ><a href="<?= $RedirectUrl ?>" class="back">Back</a></div>
<div class="had">
    Manage User    <span> &raquo;
        <? 
        if(!empty($_GET['edit']))
        {
        echo "Edit ".$ModuleName;
        }
        else
        {
        echo "Add ".$ModuleName;
        }
        ?>

    </span>
</div>
<div class="message" align="center"><? if(!empty($_SESSION['mess_user'])) {echo $_SESSION['mess_user']; unset($_SESSION['mess_user']); }?></div>

<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
    <form name="form1" action=""  method="post" onSubmit="return validateEmployee(this);" enctype="multipart/form-data">

        <? if(($_GET["tab"]=="user" ||  $_GET["curP"]=="1" || $_GET["tab"]=="personal") && ($_GET["tab"]!="account" && $_GET["tab"]!="role"))
        { ?>

        <tr>
            <td  align="center" valign="top" >


                <table width="100%" border="0" cellpadding="5" cellspacing="0" class="borderall">
                    <tr>
                        <td colspan="4" align="left" class="head">User Details</td>
                    </tr>


                    <tr>
                        <td  align="right"   class="blackbold" width="20%"> First Name  :<span class="red">*</span> </td>
                        <td   align="left" width="40%">
                            <input name="FirstName" type="text" class="inputbox" id="FirstName" value="<?php echo stripslashes($arryUser[0]['FirstName']); ?>"  maxlength="50" onkeypress="return isCharKey(event);"/>            </td>
                    </tr><tr>
                        <td  align="right"   class="blackbold" width="15%"> Last Name  :<span class="red">*</span> </td>
                        <td   align="left" >
                            <input name="LastName" type="text" class="inputbox" id="LastName" value="<?php echo stripslashes($arryUser[0]['LastName']); ?>"  maxlength="50" onkeypress="return isCharKey(event);"/>            </td>


                    </tr><tr>
                        <td  align="right"  class="blackbold" >Gender :<span class="red">*</span> </td>
                        <td   align="left" >


                            <input type="radio" name="Gender" id="Gender" value="Male" <?= ($arryUser[0]['Gender'] == "Male") ? ("checked") : (""); ?>/>
                            Male&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="Gender" id="Gender" value="Female"  <?= ($arryUser[0]['Gender'] == "Female") ? ("checked") : (""); ?>  />
                            Female		 </td>
                    </tr>

                    <tr>
                        <td  align="right"  class="blackbold"> Designation  :<span class="red">*</span> </td>
                        <td   align="left" >
                            <input name="Designation" type="text" class="inputbox" id="Designation" value="<?php echo stripslashes($arryUser[0]['Designation']); ?>"  maxlength="50" onkeypress="return isCharKey(event);"/> 

                        </td>


                    </tr>	  



                    <tr>
                        <td  align="right"   class="blackbold" > Email :<span class="red">*</span> </td>
                        <td   align="left" colspan="3"><input name="uEmail" type="text" class="inputbox" id="uEmail" value="<?php echo $arryUser[0]['uEmail']; ?>"  maxlength="80" onKeyPress="Javascript:ClearAvail('MsgSpan_Email');" onBlur="Javascript:CheckAvail('MsgSpan_Email', 'User', '<?= $_GET['edit'] ?>');"/>

                            <span id="MsgSpan_Email"></span>		</td>
                    </tr>

                    <? if(empty($_GET['edit']))
                    { ?>
                    <tr>
                        <td  align="right"   class="blackbold">Password :<span class="red">*</span> </td>
                        <td   align="left" colspan="3" class="blacknormal">
                            <input name="uPassword" type="Password" class="inputbox" id="Password" value=""  maxlength="15" autocomplete="off"  />          
                            <span class="passmsg"><?= PASSWORD_LIMIT ?></span>
                            <?php require_once("password_strength_html.php"); ?>
                        </td>
                    </tr>		 
                    <tr>
                        <td  align="right"   class="blackbold">Confirm Password :<span class="red">*</span> </td>
                        <td   align="left" colspan="3"><input name="ConfirmPassword" type="Password" class="inputbox" id="ConfirmPassword" value=""  maxlength="15" autocomplete="off"/> </td>
                    </tr>
                    <? } ?>



                    <tr>
                        <td  align="right"   class="blackbold" 
                             >Status  : </td>
                        <td   align="left"  >
                            <? 
                            $ActiveChecked = 'checked';$InActiveChecked ='';
                            if($_GET['edit'] > 0)
                            {
                            if($arryUser[0]['status'] == 1) {$ActiveChecked = ' checked'; $InActiveChecked ='';}
                            if($arryUser[0]['status'] == 0) {$ActiveChecked = ''; $InActiveChecked = ' checked';}
                            }
                            ?>
                            <input type="radio" name="Status" id="Status" value="1" <?= $ActiveChecked ?> />
                            Active&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="Status" id="Status" value="0" <?= $InActiveChecked ?> />
                            InActive </td>
                    </tr>

                </table>	

            </td>
        </tr>


        <? } ?>

        <? if($_GET["tab"]=="account")
        { ?>
        <tr>
            <td  align="center" valign="top" >
                <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="borderall">
                    <tr>
                        <td colspan="4" align="left" class="head"><?= $SubHeading ?></td>
                    </tr>




                    <tr>
                        <td  align="right"   class="blackbold" width="33%">Password : </td>
                        <td   align="left" width="67%" class="blacknormal">
                            <input name="newPassword" type="Password" class="inputbox" id="Password" value=""  maxlength="15" autocomplete="off"/> 
                            <span class="passmsg"><?= PASSWORD_LIMIT ?></span>
                            <?php require_once("password_strength_html.php"); ?>



                        </td>
                    </tr>		 
                    <tr>
                        <td  align="right" width="33%"  class="blackbold">Confirm Password : </td>
                        <td   align="left" width="67%"><input name="ConfirmPassword" type="Password" class="inputbox" id="ConfirmPassword" value=""  maxlength="15" autocomplete="off"/> </td>
                    </tr>	







                </table>
            </td>
        </tr>
        <? } ?>	


        <? if($_GET["tab"]=="role")
        { ?>

        <table  width="100%" border="0" cellpadding="5" cellspacing="0" class="borderall">
            <tr align="left">
                <td colspan="4" align="left" class="head">Role/Permissions</td>
            </tr>	

            <tr>
                <td   align="right" valign="bottom" colspan="2">




                </td>
            </tr> 


            <tr >
                <td align="right" valign="top"  class="blackbold"><div id="PermissionTitle"></div></td>
                <td align="left">



                    <div id="PermissionValueNew" >

                        <table width="100%" cellspacing=0 cellpadding=2 style="background-color:#EFEFEF"  ><tr>
                                <td ><strong>Module Name</strong></td>
                                <td width="22%"><label><input type="checkbox" name="ViewAll" id="ViewAll" onclick="javascript:SelectDeselect('ViewAll', 'ViewLabel');"  /><strong>View</strong></label></td>
                                <td width="22%"><label><input type="checkbox" name="ModifyAll" id="ModifyAll" onclick="javascript:SelectDeselect('ModifyAll', 'ModifyLabel');"  /><strong>Modify</strong></label></td>




                            </tr></table> 
                        <? 
                        $Line=0;
                        echo '<div id="accordion" >';
                        //foreach($arryDepartment as $key=>$valuesDept)
                        //{

                        $arrayMainModules = $objUser->getMainModulesUser($arryUser[0]['Uid'],0);


                        if(sizeof($arrayMainModules)>0)
                        {


                        //echo '<h2>'.$valuesDept['Department'].'</h2>';

                        echo '<table width="100%" cellspacing=0 cellpadding=0>';
                        foreach($arrayMainModules as $key=>$valuesMod)
                        {
                        $Line++; 
                        $arrysubmenu=$objUser->getMainModulesUser($arryUser[0]['Uid'],$valuesMod['ModuleID']);
                        //$objUser->GetHeaderSubmenuMenusBySuperadmin($valuesMod['ModuleID']);	

                        //echo print_r($arrysubmenu[]);

                        echo '<tr>

                        <td height="30">'.stripslashes($valuesMod['Module']).'</td> ';

                        //echo $valuesMod['ViewLabel'];exit;
                        //if(sizeof($arrysubmenu)<=0)
                        //{

                        ?>


                        <td width="22%">
                            <input type="checkbox" name="ViewLabel<?= $Line ?>" id="ViewLabel<?= $Line ?>" value="<?= $valuesMod['ModuleID'] ?>" <? if(!empty($valuesMod['ViewLabel']) && !empty($_GET['edit'])) echo " checked"; ?> /></td>								


                        <td width="22%">			
                            <input type="checkbox" name="ModifyLabel<?= $Line ?>" id="ModifyLabel<?= $Line ?>" value="<?= $valuesMod['ModuleID'] ?>" <? if(!empty($valuesMod['ModifyLabel']) && !empty($_GET['edit'])) echo " checked"; ?> /></td>											



                        <?


                        //}

                        echo '</tr>';
                        foreach($arrysubmenu as $key1=>$valuessubmeu)
                        {

                        $Line++; 
                        echo '<tr>

                        <td height="30">&nbsp;&nbsp;&nbsp;-&nbsp;'.stripslashes($valuessubmeu['Module']).'</td> ';
                        //echo "<pre>"; print_r($arrysubmenu);
                        ?>


                        <td >
                            <input type="checkbox" name="ViewLabel<?= $Line ?>" id="ViewLabel<?= $Line ?>" value="<?= $valuessubmeu['ModuleID'] ?>" <? if(!empty($valuessubmeu['ViewLabel']) && !empty($_GET['edit'])) echo " checked"; ?> /></td>								


                        <td>			
                            <input type="checkbox" name="ModifyLabel<?= $Line ?>" id="ModifyLabel<?= $Line ?>" value="<?= $valuessubmeu['ModuleID'] ?>" <? if(!empty($valuessubmeu['ModifyLabel']) && !empty($_GET['edit'])) echo " checked"; ?> /></td>											




                        <?

                        echo '</tr>';
                        }




                        /*if ($Line % 2 == 0) {
                        echo "</tr><tr>";
                        }*/

                        //}
                        } //end arrayAllModules


                        echo '</table>';

                        }  //end if arrayAllModules

                        //}  //end arryDepartment 
                        echo '</div>';   

                        ?>





                        <input type="hidden" name="Line" id="Line" value="<?= $Line ?>" />



                    </div>
                </td>
            </tr> 

            <tr>
                <td colspan=2> 

                    <table  width="100%" border="0" cellpadding="5" cellspacing="0" >
                        <tr align="left">
                            <td colspan="4" align="left" ></td>
                        </tr>	

                        <tr>
                            <td   align="right" valign="bottom" colspan="2">




                            </td>
                        </tr> 


                        <tr >
                            <td align="right" valign="top"  class="blackbold"><div id="PermissionTitle"></div></td>
                            <td align="left">



                                <div id="PermissionValueNew" >

                                    <table width="100%" cellspacing=0 cellpadding=2 style="background-color:#ffffff" class="borderall" >
                                        <tr>
                                            <td width="30%" class="head"><strong>Restricted Company</strong></td>
                                            <td width="30%" class="head"><strong>Companyid</strong></td>
                                            <td class="head"><label><input type="checkbox" name="checkAll" id="checkAll" onclick="javascript:SelectDeselectCmp('checkAll', 'inercheck');"  /><strong>Select All</strong></label></td>

                                            <? 


                                            //echo "<pre>";
                                            //echo $arryUser[0]['Uid'];
                                            // echo "<br>";

                                            $arrayCompanydata= $objUser->GetCompany($arryUser[0]['Uid']);
                                            //print_r($arrayCompanydata);
                                            //$arrayCompanyid= $objUser->GetCompanyBYUser($arryUser[0]['Uid']);

                                            $Linen=0;

                                            if(sizeof($arrayCompanydata)>0)
                                            {


                                            // print_r($arrayCompanydata);
                                            foreach($arrayCompanydata as $key=>$comvalues)
                                            {
                                            $Linen++;

                                            echo '<tr>

                                            <td >'.stripslashes($comvalues['CompanyName']).'</td>
                                            <td>'.stripslashes($comvalues['CmpID']).'</td> ';




                                            ?>


                                            <td >
                                                <input type="checkbox" name="inercheck[]" id="inercheck<?= $Linen ?>" value="<?= $comvalues['CmpID'] ?>" <? if(!empty($comvalues['CheckedID']) && !empty($_GET['edit'])) echo " checked"; ?>/></td>								






                                            <?


                                            echo '</tr>';


                                            ?>




                                            <?


                                            } 


                                            echo '</table>';

                                            }  


                                            echo '</div>';   

                                            ?>

 <input type="hidden" name="Linen" id="Linen" value="<?= $Linen ?>" />


                                            </div>
                                            </td>
                                        </tr> 
                                    </table>


                            </td>



                        </tr>



                    </table>


                    <? } ?>

            <tr>  

                <td  align="left" valign="top">

                    <table  width="100%" border="0" cellpadding="5" cellspacing="0">
                        <tr>
                            <td width="33%"> </td><td width="37%" align="left">  


                                <div id="SubmitDiv" style="display:none1" align="left">

                                    <? if($_GET['edit']>0) $ButtonTitle = 'Update '; else $ButtonTitle =  ' Submit ';?>

                                    <input name="Submit" type="submit" class="button" id="SubmitButton" value=" <?= $ButtonTitle ?> "  />

                                    <input type="hidden" name="Uid" id="Uid" value="<?= $_GET['edit'] ?>" />
                                    <input type="hidden" name="Uid" id="Uid"  value="<?= $arryUser[0]['Uid'] ?>" />	

                                </div></td>
                            <td width="30%"></td></tr> </table>
                </td>
            </tr>
    </form>
</table>

<SCRIPT LANGUAGE=JAVASCRIPT>

    function SelectAllRecord()
    {
        for (i = 1; i <= document.form1.Line.value; i++) {
            document.getElementById("Modules" + i).checked = true;
        }

    }

    function SelectNoneRecords()
    {
        for (i = 1; i <= document.form1.Line.value; i++) {
            document.getElementById("Modules" + i).checked = false;
        }
    }

    function SelectDeselect(AllCheck, InnerCheck)
    {
	
        var Checked = false;
        if (document.getElementById(AllCheck).checked) {
            Checked = true;
        }
        for (i = 1; i <= document.form1.Line.value; i++) {
            document.getElementById(InnerCheck + i).checked = Checked;
        }

    }

function SelectDeselectCmp(AllCheck, InnerCheck)
    {
	
        var Checked = false;
        if (document.getElementById(AllCheck).checked) {
            Checked = true;
        }
        for (i = 1; i <= document.form1.Linen.value; i++) {
            document.getElementById(InnerCheck + i).checked = Checked;
        }

    }
   
</SCRIPT>
