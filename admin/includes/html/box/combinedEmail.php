<?
require_once($Prefix."classes/email.class.php");
$objImportEmail=new email(); 

(!$_GET['curP'])?($_GET['curP']=1):(""); 

//echo $EmailForInbox; exit;
if($EmailForInbox!='') $arryEmailsList=$objImportEmail->ListCombinedEmails($EmailForInbox);

        
$numEmail=$objImportEmail->numRows();
$pagerLink = $objPager->getPager($arryEmailsList, $RecordsPerPage, $_GET['curP']);
(count($arryEmailsList) > 0) ? ($arryEmailsList = $objPager->getPageRecords()) : ("");

?>

<script language="JavaScript1.2" type="text/javascript">
   
    $(document).ready(function() {
            //$('.fancybox').fancybox();
        $(".fancybox").fancybox({
            type: 'iframe',
            afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
                parent.location.reload(true);
            }
        });
        });
</script>
<!--div class="had">Inbox/Sent Emails</div-->
<div class="message" align="center"><? if (!empty($_SESSION['mess_contact'])) {
    echo $_SESSION['mess_contact'];
    unset($_SESSION['mess_contact']);
} ?></div>
<style>
<!--
.evenbg:HOVER,.oddbg:HOVER{  background-color: #efefef;}
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
-->
</style>

<TABLE WIDTH="100%"   BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0 >


    
    <tr>
        <td  valign="top">


            <div class="message" align="center">
               <?php 
               
                 
               
                 if(!empty($_SESSION['TrashCanMsg']))
                 {
                     echo $_SESSION['TrashCanMsg'];
                 }
                  
                 unset($_SESSION['TrashCanMsg']);
               ?>
                
            </div>
            <form action="" method="post" name="form1">
                <!--tr>
                                <td align="right" height="40" valign="bottom">
                                    <input type="submit" name="DeleteButton" class="button" value="Delete" onclick="javascript: return ValidateMultiple('Email', 'delete', 'NumField', 'emailID');">
                                </td>
                            </tr-->
                <div id="prv_msg_div" style="display:none"><img src="<?= $MainPrefix ?>images/loading.gif">&nbsp;Searching..............</div>
                <div id="preview_div">

                    <table <?= $table_bg ?>>
                            

                            <tr align="left"  >
                             <!-- <td width="0%" class="head1" ><input type="checkbox" name="SelectAll" id="SelectAll" onclick="Javascript:SelectCheckBoxes('SelectAll','AddID','');" /></td>-->
                                <!--td width="10%"  class="head1" >Contact ID</td-->
                                <td width="8%"  class="head1" >Type </td>
                                <td width="8%"  class="head1" >From</td>
                                <td width="8%"  class="head1" >To</td>
                                <td width="26%"  align="" class="head1" >Subject</td>
                                <td width="2%"  align="center" class="head1" ></td>
                                <td width="10%"  align="center"  class="head1 head1_action" >Date</td>
                                <!--td width="1%" class="head1" ><input type="checkbox" name="SelectAll" id="SelectAll" onclick="Javascript:SelectCheckBoxes('SelectAll', 'emailID', '<?= sizeof($arryEmailsList) ?>');" /></td-->
                            </tr>

                        <?php
                        
                        if (is_array($arryEmailsList) && $numEmail > 0) {
                            $flag = true;
                            $Line = 0;
                            
                            
                            foreach ($arryEmailsList as $key => $values) {
                                $flag = !$flag;
                                $bgcolor = ($flag) ? ("#FAFAFA") : ("#FFFFFF");
                                $Line++;
                                //$values['Status']=0;
                                $boldtext ='';
				if($values['Status']==1) $boldtext = "font-weight:bold;";

                                //if($values['ExpiryDate']<=0 || $values['Status']<=0){ $bgcolor="#000000"; }
                                ?>
                                <tr align="left" >
                                    
                                    <?php if($values['MailType']=='Inbox')
                                    {
                                        $type_text="Inbox";
                                        $from_to_text='From';
                                        $from_emails=$values['From_Email'];
                                    }
                                    if($values['MailType']=='Sent')
                                    {
                                        $type_text="Sent";
                                        $from_to_text='To';
                                        $to_emails=$values['Recipient'];
                                        $from_emails=$values['From_Email'];
                                    }
                                    ?>
                                      <td width="8%" class="red" ><?=$type_text?></td>
                                      <td width="8%"  >
                                       <?php //if($values['MailType']=='Inbox')
                                      // {
                                         echo $from_emails;   
                                       //}   
                                         ?> 
                                      </td>
                                        
                                      <td style="<?=$boldtext?>">
                                      <?php if($values['MailType']=='Sent')
                                       {
                                         echo "<span class=to-block>".$to_emails."</span>";  
                                       }   
                                         ?>
                                       </td>
                                      
                                      

                                      <td align="" >
                                          <?php if($_GET['fromm']=='finance')
                                          {
                                           ?>
                                          
                                           <a class="fancybox fancybox.iframe" href="../crm/combinedviewEmail.php?ViewId=<?php echo $values["autoId"] ?>&type=<?=$type_text?>&emailId=<?=$EmailForInbox?>">
                                             <?php
                                          }else {?>
                                          <a class="fancybox fancybox.iframe" href="combinedviewEmail.php?ViewId=<?php echo $values["autoId"] ?>&type=<?=$type_text?>&emailId=<?=$EmailForInbox?>">
                                          <?php } ?>
                                      <?php echo "<font style='".$boldtext."'>".stripslashes($values["Subject"])."</font> :-";
                                              if($countt_data=str_word_count($values["EmailContent"]) > 5)
                                              {    
                                               //echo (substr(stripslashes($values["EmailContent"]),0,10)).'....';
                                                  
                                                  for($j=0;$j>=5;$j++)
                                                  {
                                                      $content.=$countt_data[$j].' ';   
                                                  }
                                                  echo $content." ....";
                                              }
                                              else {
                                                  
                                                  echo stripslashes($values["EmailContent"])." ....";
                                              }
                                              
                                              ?>
                                          
                                          </a>   
                                      </td>
                                      <td align="center">
                                            
                                        <?php
                                        
                                          $select_attach="select count(AutoId) as CountAttach from importemailattachments where EmailRefId='".$values['autoId']."'";
                                          $data=mysql_fetch_array(mysql_query($select_attach));
                                          if($data[CountAttach] > 0)
                                          {
                                           echo "<img src='".$MainPrefix."../images/attachment_icon.png'>";
                                          }
                                         ?>
                                      </td>
                                        
        
                                <td  align="center" class="head1_inner" >
                                     <?php $values["ImportedDate"]; 
                                    
                                    echo date("F j, Y, g:i a",strtotime($values["composedDate"]));

                                     ?>
                                  </td>
                                  <!--td><input type="checkbox" name="emailID[]" id="emailID<?=$Line?>" value="<?=$values["autoId"]?>"></td-->
                                </tr>
                            <?php } // foreach end //?>

<?php } else { ?>
                            <tr align="center" >
                                <td  colspan="8" class="no_record"><?= NO_RECORD ?></td>
                            </tr>
<?php } ?>

                        <tr >  <td  colspan="8" >Total Record(s) : &nbsp;<?php echo $numEmail; ?>
      <?php if (count($arryEmailsList) > 0) { ?>
                                    &nbsp;&nbsp;&nbsp;     Page(s) :&nbsp; <?php echo $pagerLink;
}
?>
                            
                            </td>
                        </tr>
                    </table>

                </div> 
                <? if (sizeof($arryEmailsList)) { ?>
                    <table width="100%" align="center" cellpadding="3" cellspacing="0" style="display:none">
                        <tr align="center" > 
                            <td height="30" align="left" ><input type="button" name="DeleteButton" class="button"  value="Delete" onclick="javascript: ValidateMultipleAction('<?= $ModuleName ?>', 'delete', '<?= $Line ?>', 'AddID', 'editContact.php?curP=<?= $_GET[curP] ?>&opt=<?= $_GET[opt] ?>');">
                                <input type="button" name="ActiveButton" class="button"  value="Active" onclick="javascript: ValidateMultipleAction('<?= $ModuleName ?>', 'active', '<?= $Line ?>', 'AddID', 'editContact.php?curP=<?= $_GET[curP] ?>&opt=<?= $_GET[opt] ?>');" />
                                <input type="button" name="InActiveButton" class="button"  value="InActive" onclick="javascript: ValidateMultipleAction('<?= $ModuleName ?>', 'inactive', '<?= $Line ?>', 'AddID', 'editContact.php?curP=<?= $_GET[curP] ?>&opt=<?= $_GET[opt] ?>');" /></td>
                        </tr>
                    </table>
<? } ?>  

                <input type="hidden" name="CurrentPage" id="CurrentPage" value="<?php echo $_GET['curP']; ?>">
                <input type="hidden" name="opt" id="opt" value="<?php echo $ModuleName; ?>">
                <input type="hidden" name="NumField" id="NumField" value="<?= sizeof($arryEmailsList) ?>">

            </form>
        </td>
    </tr>
</table>


<script>
 function ValidateMultiple(moduleName,actionToPerform,NumFieldName,ToSelect){
     
        
		var checkedFlag = 0;
		var ids = '';
		TotalRecords = document.getElementById(NumFieldName).value;
                
                
		if(TotalRecords > 0){
				for(var i=1;i<=TotalRecords;i++){
					if(document.getElementById(ToSelect+i).checked==true){
						if(checkedFlag == 0){
							checkedFlag = 1;
						}
						ids += document.getElementById(ToSelect+i).value+',';
					}
				}
                                
                                

				if(checkedFlag == 0){
					alert("You must select atleast one "+moduleName+" to "+actionToPerform+".");
                                        
				}else{
					if(actionToPerform=="delete"){
							if(confirm("This will go to Trashcan folder. Continue ??")){
								ShowHideLoader(1,'P');
								return true;
							}else{
								return false;
							}
					}else{
						ShowHideLoader(1,'P');
						return true;
					}

				}
		}
		return false;
			
}

</script>