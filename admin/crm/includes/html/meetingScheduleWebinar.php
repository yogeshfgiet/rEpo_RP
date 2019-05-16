<?php  if(empty($_GET['view']) && empty($HideNavigation)){  ?>
<a class="back" href="<?=$RedirectURL?>">Back</a>

<div class="had">
Zoom Webinars   &raquo; <span>
	<? 	echo (!empty($_GET['edit']))?("Edit Webinar") :("Schedule a Webinar"); ?>
		</span>
</div>
<?php } ?>
<div class="message" align="center"> <?
    if (!empty($_SESSION['mess_meeting'])) {
        echo $_SESSION['mess_meeting'];
        unset($_SESSION['mess_meeting']);
    }
?></div>
<script type="text/javascript">
$(document).ready(function(){
	$('input:radio[name="type"]').change(
	function(){
	        if ($(this).is(':checked') && $(this).val() == '1') {
		        $(".meetschedule").hide('slow');
	        }else{
	        	$(".meetschedule").show('slow');
	        }
	 });

	 $('#password_check').change(function() {
	        if($(this).is(":checked")) {
	        	$("#password").show('slow');
	        }else{
	        	 $("#password").hide('slow');
		    }
	                
	    });

	 $('#copyData').click(function () {
         var rext = $('#invite_email').val();
         parent.$('#description').val(rext);
         parent.$('#ReferenceID').val($('#ReferenceID').val());
         parent.$.fancybox.close();
     });
});
</script>
<?php 
$pwd = 'display: none;';
if($Webinar[0]['password_check']) $pwd = 'display:block;';

$type = '';
if($Webinar[0]['type']==1) $type = 'display:none';
?>

<?php if(!isset($_GET['copyClip'])){?>
<div id="AddUser" style="min-height: 400px;">
		<form name="form3" action=""  method="post" onSubmit="" >
		<table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" class="borderall">
			<input type="hidden" name="user_id" value="<?=($Webinar[0]['user_id'])?$Webinar[0]['user_id']:$user_id?>" />
			<input type="hidden" name="webinar_id" value="<?=$Webinar[0]['webinar_id']?>" />
			<input type="hidden" name="redirectURL" value ="<?=$_SERVER['HTTP_REFERER']?>">
			<tr>
				 <td colspan="4" align="left" class="head"><? if(!empty($_GET['view'])) { echo 'Webinar Information'; } else { echo (!empty($_GET['edit']))?("Edit Webinar") :("Schedule a Webinar");} ?>

					<?php if(!empty($_GET['view']) && $Webinar[0]['approval_type']) { ?>
				 <a href="meetingWebinarRegistrationList.php?view=<?=$Webinar[0]['webinar_id']?>" style="float:right; font-size: 15px;" class="fancybox fancybox.iframe">View Registrations</a>
				 <?php }?>

				</td>
			</tr>
			
		<?php if(!empty($Webinar[0]['webinar_id'])){ 
				$result1 = substr_replace($Webinar[0]['webinar_id'], "-", 3, 0);
			?>	
			<tr>
				 <td align="right"   class="blackbold" width="20%">Webinar ID:</td>
				 <td   align="left" width="40%">
				 <b><?=substr_replace($result1, "-", 7, 0)?></b>
				 </td>
			</tr>
			<?php }?>
			<tr>
				 <td align="right"   class="blackbold" width="20%">Topic:</td>
				 <td   align="left" width="40%">
				 <input id="topic" name="topic" class="inputbox" value="<?=$Webinar[0]['topic']?>" style="width: 226px;" required>
				 </td>
			</tr>
			
			<tr>
				 <td align="right"   class="blackbold" width="20%">Description (Optional):</td>
				 <td   align="left" width="40%">
				<textarea id="agenda" name="agenda" class="inputbox" style="width: 226px;" placeholder="Enter your webinar description"><?=$Webinar[0]['agenda']?></textarea>
				 </td>
			</tr>
			
		    <tr class="meetschedule" style="<?=$type?>">
				 <td align="right"   class="blackbold" width="20%">When:</td>
				 <td   align="left" width="40%">
				 <? if( $Webinar[0]['original_start_time']>0) $Webinar[0]['start_time'] = $Webinar[0]['original_start_time'] ;?>
				 <? $WebinarDate = ($Webinar[0]['start_time'] > 0) ? date('Y-m-d', strtotime($Webinar[0]['start_time'])): date('Y-m-d',strtotime($Config['TodayDate'])); ?>	
                                               <script type="text/javascript">                   
                                                     $(function() {
	                                                  $("#start_time").datepicker({
                                                        showOn: "both",
                                                        dateFormat: 'yy-mm-dd',
                                                        minDate: "-0D",
                                                        maxDate: null,
                                                        changeMonth: true,
                                                        changeYear: true
                                                                });
                                                              });
                                                  </script>	
              <input type="text" id="start_time" name="start_date" class="datebox" value="<?= $WebinarDate ?>">
              <?php $hour = date('g', strtotime($Webinar[0]['start_time']));
              		$min = date('i', strtotime($Webinar[0]['start_time']));
              		$ampm = date('a', strtotime($Webinar[0]['start_time']));
              		$st1 = $hour.':'.$min;
              		
              		if(!isset($_GET['edit']) && !isset($_GET['view'])){ 
              			$hour = date('g', strtotime($Config['TodayDate']));
              			$st1 = ($hour+1) .':00';
              			
              			$ampm = date('a', strtotime($Config['TodayDate']));
              		}
              ?>
	             &nbsp; <select class="inputbox" name="start_time1" id="duration" style="width: 64px;">
			        	<option value="12:00" <?=($st1=='12:00')?'selected':'';?> >12:00</option>
			        	<option value="12:30" <?=($st1=='12:30')?'selected':'';?> >12:30</option>
			        	<option value="1:00" <?=($st1=='1:00')?'selected':'';?> >1:00</option>
			        	<option value="1:30" <?=($st1=='1:30')?'selected':'';?> >1:30</option>
			        	<option value="2:00" <?=($st1=='2:00')?'selected':'';?> >2:00</option>
			        	<option value="2:30" <?=($st1=='2:30')?'selected':'';?> >2:30</option>
			        	<option value="3:00" <?=($st1=='3:00')?'selected':'';?> >3:00</option>
			        	<option value="3:30" <?=($st1=='3:30')?'selected':'';?> >3:30</option>
			        	<option value="4:00" <?=($st1=='4:00')?'selected':'';?> >4:00</option>
			        	<option value="4:30" <?=($st1=='4:30')?'selected':'';?> >4:30</option>
			        	<option value="5:00" <?=($st1=='5:00')?'selected':'';?> >5:00</option>
			        	<option value="5:30" <?=($st1=='5:30')?'selected':'';?> >5:30</option>
			        	<option value="6:00" <?=($st1=='6:00')?'selected':'';?> >6:00</option>
			        	<option value="6:30" <?=($st1=='6:30')?'selected':'';?> >6:30</option>
			        	<option value="7:00" <?=($st1=='7:00')?'selected':'';?> >7:00</option>
			        	<option value="7:30" <?=($st1=='7:30')?'selected':'';?> >7:30</option>
			        	<option value="8:00" <?=($st1=='8:00')?'selected':'';?> >8:00</option>
			        	<option value="8:30" <?=($st1=='8:30')?'selected':'';?> >8:30</option>
			        	<option value="9:00" <?=($st1=='9:00')?'selected':'';?> >9:00</option>
			        	<option value="9:30" <?=($st1=='9:30')?'selected':'';?> >9:30</option>
			        	<option value="10:00" <?=($st1=='10:00')?'selected':'';?> >10:00</option>
			        	<option value="10:30" <?=($st1=='10:30')?'selected':'';?> >10:30</option>
			        	<option value="11:00" <?=($st1=='11:00')?'selected':'';?> >11:00</option>
			        	<option value="11:30" <?=($st1=='11:30')?'selected':'';?> >11:30</option>
			        </select>
              <select class="inputbox" name="start_half" id="duration" style="width: 64px;">
		        	<option value="AM" <?=($ampm=='am')?'selected':'';?> >AM</option>
		        	<option value="PM" <?=($ampm=='pm')?'selected':'';?> >PM</option>
		        </select>
				 </td>
			</tr>
			
			 <tr class="meetschedule" style="<?=$type?>">
				 <td align="right"   class="blackbold" width="20%">Duration:</td>
				 <td   align="left" width="40%">
				<select class="inputbox" name="hour" id="duration" style="width: 64px;" >
		        	<?php 
				       for ($i=0; $i<=24; $i++){
				       	$t = ($i==1)?'selected':'';
				       	$t = ($Webinar[0]['duration']>0 && $i==floor($Webinar[0]['duration']/60))?'selected':$t;
				         echo "<option value='".$i."' $t>" . $i ."</option>";
				       }
    				?>
		        </select> hr 
		        <select class="inputbox" name="minute" id="duration" style="width: 64px;" >
		        	<option value="0" <?=(($Webinar[0]['duration'] % 60)==0)?'selected':'';?>>0</option>
		        	<option value="15" <?=(($Webinar[0]['duration'] % 60)==15)?'selected':'';?>>15</option>
		        	<option value="30" <?=(($Webinar[0]['duration'] % 60)==30)?'selected':'';?>>30</option>
		        	<option value="45" <?=(($Webinar[0]['duration'] % 60)==45)?'selected':'';?>>45</option>									
		        </select> min 
				 </td>
			</tr>
			
			<tr class="meetschedule" style="<?=$type?>">
				 <td align="right"   class="blackbold" width="20%">Time Zone:</td>
				 <td   align="left" width="40%">
				<select class="inputbox" name="timezone" id="timezone" style="width: 265px;">
		        	<?php 
				       foreach ($objMeeting->meetingTimeZone() as $index=> $value){
				       	$tz = ($index==$Webinar[0]['timezone'])?'selected':'';
				       	if(empty($tz) && $index==$MeetingUser[0]['timezone']) $tz = 'selected';
				         echo "<option value='".$index."' $tz >" . $value ."</option>";
				       }
    				?>
		        </select> 
				 </td>
			</tr>
			<!--  
			<tr>
				 <td align="left"   class="blackbold" width="20%"></td>
				 <td   align="left" width="40%">
				 <input type="checkbox" id="option_enforce_login" name="option_enforce_login" value="1"> 
				 Only signed-in users can join this meeting 
				 </td>
			</tr>
			-->
			
			<tr>
				 <td align="right" class="blackbold" width="20%">Registration:</td>
				 <td align="left" width="40%">
					 <input type="checkbox" id="approval_type" name="approval_type" value="0" <?=($Webinar[0]['approval_type']=='0')?'checked':'';?> >
					 Required
				 </td>
			</tr>
			
			<tr>
				 <td align="right" class="blackbold" width="20%">Host Video:</td>
				 <td align="left" width="40%">
					 <input type="radio" id="option_host_video" name="option_host_video" class="" value="1" <?=($Webinar[0]['option_host_video']==1 || !isset($Webinar[0]['option_host_video']))?'checked':'';?> > on 
					 <input type="radio" id="option_host_video1" name="option_host_video" class="" value="0" <?=(isset($Webinar[0]['option_host_video']) && $Webinar[0]['option_host_video']==0)?'checked':'';?>> off <br>
				 </td>
			</tr>
			
			<tr>
				 <td align="right" class="blackbold" width="20%">Participants Video:</td>
				 <td   align="left" width="40%">
				 <input type="radio" id="option_panelist_video" name="option_panelist_video" class="" value="1" <?=($Webinar[0]['option_panelist_video']==1 || !isset($Webinar[0]['option_panelist_video']))?'checked':'';?>> on 
				 <input type="radio" id="option_panelist_video1" name="option_panelist_video" class="" value="0" <?=(isset($Webinar[0]['option_panelist_video']) && $Webinar[0]['option_panelist_video']==0)?'checked':'';?>> off <br> 
				 </td>
			</tr>
			
			<tr>
				 <td align="right" class="blackbold" width="20%">Audio Options:</td>
				 <td   align="left" width="40%">
				 <input type="radio" id="option_panelist_video" name="option_audio" class="" value="telephony" <?=($Webinar[0]['option_audio']=='telephony')?'checked':'';?> > Telephony Only 
				 <input type="radio" id="option_panelist_video1" name="option_audio" class="" value="voip" <?=($Webinar[0]['option_audio']=='voip')?'checked':'';?>> Voip Only
				 <input type="radio" id="option_panelist_video" name="option_audio" class="" value="both" <?=($Webinar[0]['option_audio']=='both' || !isset($Webinar[0]['option_audio']))?'checked':'';?>> Both <br> 
				 </td>
			</tr>
			
			<tr>
				 <td align="right" class="blackbold" width="20%">Webinar Options:</td>
				 <td   align="left" width="40%">
				 <input type="checkbox" id="password_check" name="password_check" value="1" <?=($Webinar[0]['password_check'])?'checked':'';?> >
				 Require Webinar password <br/>
				 <input style="<?=$pwd?>" id="password" class="inputbox" name="password" value="<?=$Webinar[0]['password']?>">
				 </td>
			</tr>
			
			<tr>
				 <td align="right" class="blackbold" width="20%"></td>
				 <td   align="left" width="40%">
				 <input type="checkbox" id="option_practice_session" name="option_practice_session" value="1" <?=($Webinar[0]['option_practice_session'])?'checked':'';?> >
				 Enable Practice Session
				 </td>
			</tr>
			
			<tr>
				 <td align="right" class="blackbold" width="20%"></td>
				 <td   align="left" width="40%">
				 <input type="checkbox" id="option_enforce_login" name="option_enforce_login" value="1" <?=($Webinar[0]['option_enforce_login'])?'checked':'';?> >
				 Only signed-in users can join this meeting
				 </td>
			</tr>
			<tr>
				 <td align="right" class="blackbold" width="20%">Panelists: </td>
				 <td   align="left" width="40%">
					<div id="itemRows">
							 <?php if(!empty($Webinar[0]['panelists'])){ 
						 		$panelists = json_decode($Webinar[0]['panelists']);
						 		$pn=0;
						 		foreach ($panelists as $panelist){
						 			$pn++;
						 			?>
						 			<p id="rowNum555<?=$pn?>">
						 				<input type="text" name="panelist_name[]" class="inputbox" placeholder="Name" value="<?=$panelist->name?>"> 
						 				<input type="email" name="panelist_email[]" class="inputbox" placeholder="Email" value="<?=$panelist->email?>"> 
						 				<a onclick="removeRow(555<?=$pn?>);" href="Javascript:void(0);"><img src="../images/delete.png" id="ibtnDel" title="Delete"></a>
						 			</p>
						 			
						 		<?}
						 }
						 if(!isset($_GET['view'])){ ?>
						<input type="text" name="panelist_name[]" class="inputbox" placeholder="Name" /> 
						<input type="email" name="panelist_email[]" class="inputbox" placeholder="Email" />
						<a onclick="addRow(this.form);" class="add_row" value="Add row" href="Javascript:void(0);" style="display: inline-block;margin-bottom: 10px;"/>Add Panelist</a>
						<?php }?>
					</div>
				 </td>
			</tr>
			
			<?php if(!empty($Webinar[0]['join_url']) && !empty($_GET['view'])){ 
				$result1 = substr_replace($Webinar[0]['join_url'], "-", 3, 0);
			?>	
			<tr>
				 <td align="right"   class="blackbold" width="20%">Join URL:</td>
				 <td   align="left" width="40%">
				 <?=$Webinar[0]['join_url']?>
				 </td>
			</tr>
			<?php }?>
			
			<?php  if(empty($_GET['view'])){  ?>
		    <tr>
		        <td   align="center" width="40%" colspan="2">
		        	<br/>
					<input name="saveWebinar" type="submit" class="button" id="saveWebinar" value="Save" /> 
				</td>
				<?php } ?>
		    </tr>
		</table>
		</form>
	</div>
	
	<?php }else if(isset($_GET['copyClip'])) {
		$Webinar = $objMeeting->findWebinarByWebinarsColumn('id',$_GET['lastID']);
		$result1 = substr_replace($Webinar[0]['webinar_id'], " ", 3, 0);
		?>
		<div style="min-height: 420px;">
		<div style="padding: 5px 110px;font-size: 18px;">Copy Webinar Invitation</div>
		<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="borderall">
		<input type="hidden" name="ReferenceID" id="ReferenceID"  value="<?=$_GET['lastID']?>" />
		<tr><td></td></tr>
		<tr><td align="center" width="40%">
		<textarea class="disabled" readonly="readonly" id="invite_email" cols="80" rows="20">
Hi there, &#10;
<?=$_SESSION['UserName']?> is inviting you to a scheduled Zoom Webinar.&#10; 			
Topic: <?=$Webinar[0]['topic'].'&#10'?>
Time: <?=date($Config['DateFormat'].' '.$Config['TimeFormat'], strtotime($Webinar[0]['start_time'])).'  '.$Webinar[0]['timezone'].'&#10;'?>
&#10;Please click the link below to join the webinar: <?=$Webinar[0]['join_url'].'&#10'?>
	<?php if($Webinar[0]['password']){ ?>Password: <?php echo $Webinar[0]['password']; }?>
&#10;Or iPhone one-tap (US Toll):  +16465588656,845978175# or +14086380968,845978175#
&#10;Or Telephone:
    Dial: +1 646 558 8656 (US Toll) or +1 408 638 0968 (US Toll)
    Webinar ID: <?=substr_replace($result1, " ", 7, 0)?>
&#10;&#10;International numbers available: https://zoom.us/zoomconference?m=-Dwj0reF6wvyyCutvK8GSyNMar78REQd</textarea>
		</td></tr>
		
		<tr><td align="center" style="padding: 5px">
		Select, copy and paste invitation inside description field.Select All
		</td></tr>
		
		</table>
		<div style="margin: 10px 107px;">
			<button class="button" id="copyData">Select All</button>
		</div>
		</div>
		<?php } ?>
		
		
		
		
		
		
<script type="text/javascript">
var rowNum = 0;
function addRow(frm) { 
rowNum ++;
var row = '<p id="rowNum'+rowNum+'"><input type="text" name="panelist_name[]" class="inputbox" placeholder="Name" value=""> <input type="email" name="panelist_email[]" class="inputbox" placeholder="Email" value=""> <a onclick="removeRow('+rowNum+');" href="Javascript:void(0);"><img src="../images/delete.png" id="ibtnDel" title="Delete"></a></p>';
jQuery('#itemRows').append(row);
}

function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
	}

</script>	