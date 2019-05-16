<style>
    .wrap {
        padding: 40px;
        text-align: center;
    }
    hr {
        clear: both;
        margin-top: 40px;
        margin-bottom: 40px;
        border: 0;
        border-top: 1px solid #aaaaaa;
    }
    h1 {
        font-size: 30px;
        margin-bottom: 40px;
    }
    p {
        margin-bottom: 20px;
    }
    .btn {
        background: #428bca;
        border: #357ebd solid 1px;
        border-radius: 3px;
        color: #fff;
        display: inline-block;
        font-size: 14px;
        padding: 8px 15px;
        text-decoration: none;
        text-align: center;
        min-width: 60px;
        position: relative;
        transition: color .1s ease;
        /* top: 40em;*/
    }
    .btn:hover {
        background: #357ebd;
    }
    .btn.btn-big {
        font-size: 18px;
        padding: 15px 20px;
        min-width: 100px;
    }
    .btn-close {
        color: #aaaaaa;
        font-size: 30px;
        text-decoration: none;
        position: absolute;
        right: 5px;
        top: 0;
    }
    .btn-close:hover {
        color: #919191;
    }
    .modal:before {
        content: "";
        display: none;
        background: rgba(0, 0, 0, 0.6);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 10;
    }
    .modal:target:before {
        display: block;
    }
    .modal:target .modal-dialog {
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        transform: translate(0, 0);
        top: 20%;
    }
    .modal-dialog {
        background: #fefefe;
        border: #333333 solid 1px;
        border-radius: 5px;
        margin-left: -200px;
        position: fixed;
        left: 50%;
        top: -100%;
        z-index: 11;
        width: 360px;
        -webkit-transform: translate(0, -500%);
        -ms-transform: translate(0, -500%);
        transform: translate(0, -500%);
        -webkit-transition: -webkit-transform 0.3s ease-out;
        -moz-transition: -moz-transform 0.3s ease-out;
        -o-transition: -o-transform 0.3s ease-out;
        transition: transform 0.3s ease-out;
    }
    .modal-body {
        padding: 20px;
    }
    .modal-header,
    .modal-footer {
        padding: 10px 20px;
    }
    .modal-header {
        border-bottom: #eeeeee solid 1px;
    }
    .modal-header h2 {
        font-size: 20px;
    }
    .modal-footer {
        border-top: #eeeeee solid 1px;
        text-align: right;
    }
    /*ADDED TO STOP SCROLLING TO TOP*/
    #close {
        display: none;
    }
    .inputbox {
        display: block;
        width: 100px;
    }
    a.edit {
        float: left;
        text-decoration: none;
        width: 105px;
    }
    .loading {
        color: red;
        display: block;
        float: left;
        padding: 3px;
    }
    input.inputbox {
        display: inline-block;
    }
    .searchBox > form {
        float: left;
    }
    .clearSearch {
        background: none repeat scroll 0 0 #3498db;
        color: #ffffff !important;
        font-family: Arial;
        font-size: 15px !important;
        padding: 0 6px;
        text-decoration: none;
    }

    .clearSearch:hover {
        background: #3cb0fd;
        text-decoration: none;
    }
    #messageDiv {
    color: red;
    font-size: 16px;
    font-weight: bold;
}
.inputbox.password {
    width: 90%;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="modal" id="modal-one" aria-hidden="true">
    <form id="changePasswordForm" method="post" >
        <div class="modal-dialog">
            <div class="modal-header">
                <h2>Change Password</h2>
                <a href="#close" class="btn-close" aria-hidden="true">Close ×</a> <!--CHANGED TO "#close"-->
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                <p><label>New Password</label><input type="text" name="password" id="password" class="inputbox" style="float: right;"></p>
                <p><label>Confirm Password</label><input type="text" name="confirmPassword" id="confirmPassword" class="inputbox" style="float: right;"></p>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn">Update Password!</button>
            </div>
        </div>
    </form>
</div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<div class="had">Manage Company</div>


<div class="mid-continent" id="inner_mid" style="text-align: center; margin-left: 10%; width: 80%;">	
   <div class="message" align="center"><? if(!empty($_SESSION['mess_msg'])) {echo $_SESSION['mess_msg']; unset($_SESSION['mess_msg']); }?></div> <TABLE WIDTH="100%" BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0>
        <tr>
            <td align="right"><? if( $_REQUEST['key']!='') {?> <input type="button" 	class="view_button" name="view" value="View All"
                                                                 onclick="Javascript:window.location = 'company.php';" /> <? }?> <? if($_SESSION['AdminType']=="admin"){?>
                ,<!--<a href="addCompany.php" class="add">Add Company</a>--> <? }?></td>
        </tr>
        <tr>
<div><a href="index.php" class="back">Back</a></div>
            <div id="messageDiv" style="display: none"><img
                            src="images/loading.gif">&nbsp;</div>
            <td valign="top">



                <div id="prv_msg_div" style="display: none"><img
                        src="images/loading.gif">&nbsp;Searching..............</div>
                
                <div id="preview_div">
                        <!----------------------------    search ------------------- -->

                        <!-------------------------- end Search  ------------------------------>

                        <div class="searchBox" >
                            <?php if (!empty( $_REQUEST['type'])) { ?>
                                <a class="clearSearch" style="float: right;" href="company.php" >Clear Search</a>
                            <?php } ?>
                            <label>Search By</label>
                            <select id="searchBy" >
                                <option value="none" >select</option>
                                <option value="nameSearch" >Name</option>
                                <option value="emailSearch" >Email</option>
                                <option value="expiryDateSearch" >Expiry Date</option>
                                <option value="createdDateSearch" >Created Date</option>

                            </select>

                            <table>
                                <tr id="nameSearch" class="filterByTr" style="display: none" >
                                    <td>
                                        <fieldset>
                                            <form action="" name="form1" class="searchForm" >
                                                <label>Search by name</label>
                                                <input type="text" class="inputbox keyword" name="keyword">
                                                <input type="hidden" readonly="readonly" class="inputbox" name="type" value="byName">
                                                <input type="submit" class="button" name="searchButton" value="Search">
                                            </form>
                                        </fieldset></td>
                                </tr>
                                <tr id="emailSearch" class="filterByTr" style="display: none" >
                                    <td>
                                        <fieldset>
                                            <form action=""  name="form2" class="searchForm"  >
                                                <label>Search by email</label>
                                                <input type="text" class="inputbox keyword" name="keyword">
                                                <input type="hidden" readonly="readonly"class="inputbox" name="type" value="byEmail">
                                                <input type="submit" class="button" name="searchButton" value="Search">
                                            </form>
                                        </fieldset></td>
                                </tr>
                                <tr id="expiryDateSearch" class="filterByTr" style="display: none" >
                                    <td>
                                        <fieldset>
                                            <form action="" name="form3" class="searchForm"  >
                                                <label>Search by expiry date</label>
                                                <input type="text" class="datepicker inputbox keyword" readonly="true"  name="keyword">
                                                <input type="hidden" readonly="readonly" class="inputbox" name="type" value="byExpiryDate">
                                                <input type="submit" class="button" name="searchButton" value="Search">
                                            </form>
                                        </fieldset></td>
                                </tr>
                                <tr id="createdDateSearch" class="filterByTr" style="display: none" >
                                    <td>
                                        <fieldset>
                                            <form action=""  name="form4" class="searchForm"  >
                                                <label>Search by created date</label>
                                                <input type="text" class="datepicker inputbox keyword" readonly="true" name="keyword">
                                                <input type="hidden" readonly="readonly" class="inputbox" name="type" value="byCreatedDate">
                                                <input type="submit" class="button" name="searchButton" value="Search">
                                            </form>
                                        </fieldset></td>
                                </tr>
                            </table>
                            </form>
                        </div>
                        <table <?= $table_bg ?>>

                            <tr align="left">
                                    <!-- <td width="0%" class="head1" ><input type="checkbox" name="SelectAll" id="SelectAll" onclick="Javascript:SelectCheckBoxes('SelectAll','CmpID','<?= sizeof($arryCompany) ?>');" /></td>-->
                                <!--td width="5%" class="head1">SN</td-->
                                <td width="15%" class="head1">Company Code</td>
                                <td width="15%" class="head1">Company Name</td>
                                
                                <td width="15%" class="head1">Telephone</td>
                                <td class="head1" width="8%">Email</td>
                                <td width="8%" class="head1">Package</td>
                                <td width="8%" class="head1">Registered Date</td>
                                <td width="8%" class="head1">Expiry Date</td>                           
                                <td width="6%" align="center" class="head1">Status</td>                              
                                <td width="6%" align="center" class="head1">Action</td>
                            </tr>

                            <?php
                            $deleteUser = '<img src="' . $Config['Url'] . 'admin/images/delete.png" border="0"  onMouseover="ddrivetip(\'<center>Confirm Delete</center>\', 90,\'\')"; onMouseout="hideddrivetip()" >';

                            $changepwd = '<img src="' . $Config['Url'] . 'admin/images/change_password.png" border="0" >';

                            if (is_array($arryUser) && $num > 0) {
                                $flag = true;
                                $Line = 0;
                                $sn = 0;
                                foreach ($arryUser as $key => $values) {
                                
                                    $values = get_object_vars($values);
                                    $flag = !$flag;
                                    #$bgcolor=($flag)?("#FDFBFB"):("");
                                    $Line++;
                                    $plandata=unserialize($values["plandata"]);
                                   //echo '<pre>';print_r($plandata);
                                    
                                    ?>
                                    <tr align="left" bgcolor="<?= $bgcolor ?>" data-id="<?= $values['id'] ?>"  data-status="<?= $values['status']; ?>" data-cmpstatus="<?= $values["createCompany"]?>" >
                                            <!--<td ><input type="checkbox" name="CmpID[]" id="CmpID<?= $Line ?>" value="<?= $values['CmpID'] ?>" /></td>-->
                                        <!--td ><?//= ++$sn; ?></td-->
                                        <td height="50"><strong><?= $values["company_code"]; ?></strong></td>
                                        
                                        <td height="50"> <a href="editCompany.php?edit=<?=$values['id']?>&curP=<?=$_REQUEST['curP']?>" ><?php echo $values["firstName"];?> </a></td>
                                      
                                        
<!--                                        <td height="50"><strong><?php //echo '<a href="addCompany.php">' . $values["firstName"] . " " . $values["lastName"] . '</a>'; ?></strong></td>-->
                                        
                                        <td><?= $values["phone"]; ?></td>
                                        <td><?php echo '<a href="mailto:' . $values['username'] . '">' . $values['username'] . '</a>'; ?></td>
                                        <td><?= $plandata["name"] ?></td>
                                         <td><?php
                                            $data = new DateTime($values["recordInsertedDate"]);
                                            echo $data->format('d-M-Y');
                                            ?></td>
                                        <td><?php
                                        	if( $values["expiredDate"]!=''){
                                            $data = new DateTime($values["expiredDate"]);
                                            echo $data->format('d-M-Y');}
                                            else{
                                            echo 'N/A';}
                                            ?></td>

                                      

                                        <td align="center"><?php
				if ($values['status'] == 1 &&  $values["createCompany"]=='COMPLETED'  ) {
					$status = 'Active';
				} else {
					$status = 'InActive';
				}
				echo '<a href="company.php?compcode='. $values["company_code"].'&active_id=' . $values["id"] . '&status=' . $values["status"] . '&curP=' .  $_REQUEST["curP"] . '&compStatus=' .  $values["createCompany"] . '" class="' . $status . '">' . $status . '</a>';?>
				</td>
                                        <td align="center">
                                            <a onclick="changePassword(this);" class="edit changePassword" >Change Password</a>
                                            <input type="password" class="inputbox password" placeholder="Enter password" style="display: none">
                                            <a class="button submit" style="display: none;" >Submit</a>
                                            <span class="back loading" style="display: none;">Please Wait</span>
                                        </td>

                                    </tr>
                                <?php } // foreach end //     ?>

                            <?php } else { ?>
                                <tr align="center">
                                    <td colspan="9" class="no_record">No record found.</td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td colspan="9">Total Record(s) : &nbsp;<?php echo $num; ?> <?php if (count($arryUser) > 0) { ?>
                                        &nbsp;&nbsp;&nbsp; Page(s) :&nbsp; <?php
                                        echo $pagerLink;
                                    }
                                    ?></td>
                            </tr>
                        </table>

                    </div>
                    <? if(sizeof($arryUser)){ ?>
                    <table width="100%" align="center" cellpadding="3" cellspacing="0"
                           style="display: none">
                        <tr align="center">
                            <td height="30" align="left"><input type="button"
                                                                name="DeleteButton" class="button" value="Delete"
                                                                onclick="javascript: ValidateMultipleAction('<?= $ModuleName ?>', 'delete', '<?= $Line ?>', 'userID', 'addCompany.php?curP=<?= $_GET[curP] ?>&opt=<?= $_GET[opt] ?>');">
                                <input type="button" name="ActiveButton" class="button"
                                       value="Active"
                                       onclick="javascript: ValidateMultipleAction('<?= $ModuleName ?>', 'active', '<?= $Line ?>', 'userID', 'addCompany.php?curP=<?= $_GET[curP] ?>&opt=<?= $_GET[opt] ?>');" />
                                <input type="button" name="InActiveButton" class="button"
                                       value="InActive"
                                       onclick="javascript: ValidateMultipleAction('<?= $ModuleName ?>', 'inactive', '<?= $Line ?>', 'userID', 'addCompany.php?curP=<?= $_GET[curP] ?>&opt=<?= $_GET[opt] ?>');" /></td>
                        </tr>
                    </table>
                    <? } ?> <input type="hidden" name="CurrentPage" id="CurrentPage"
                                   value="<?php echo $_GET['curP']; ?>"> <input type="hidden" name="opt"
                                   id="opt" value="<?php echo $ModuleName; ?>">
                    </td>
                    </tr>
                    </table>
                </div>
                <script>
                    function changeStatus(thisOb) {
                        var thisObj = $(thisOb);
                        var id = $(thisObj).parents("tr").attr("data-id");
                        var status = $(thisObj).parents("tr").attr("data-status");
                        var companyCreate = $(thisObj).parents("tr").attr("data-cmpstatus");
alert(companyCreate);return false;
if(companyCreate =='PENDING'){
$("#messageDiv").show().html('yoyt');

return false;
}

                        var newStatus = '';
                        var newStatusText = '';
                        $(thisObj).html("Please Wait...");
                        $.ajax({
                            url: "http://75.112.188.125/pdfviewer_.<?php echo $values["company_code"]?>/public/authenticate/changestatus",
                            type: "POST",
                            data: {id: id, status: status, key: '62e759a21c3297341f9c0824598b7d22'},
                        }).done(function (result) {
                            if (result.status != '') {
                                if (status == '1') {
                                    newStatus = 0;
                                    newStatusText = 'InActive';
                                } else {
                                    newStatus = 1;
                                    newStatusText = 'Active';
                                }
                                $(thisObj).html(newStatusText);
                                $(thisObj).attr('class', newStatusText);
                                $(thisObj).parents("tr").attr("data-status", newStatus)
                            }
                        });
                    }
                    function changePassword(thisOb) {
                        var thisObj = $(thisOb);
                        $(thisObj).hide();
                        $(thisObj).parent("td").find(".inputbox").show()
                        $(thisObj).parent("td").find(".button").show()
                    }
                    $(".submit").click(function () {
                        var id = $(this).parents("tr").attr("data-id");
                        var password = $(this).parent("td").find(".password").val();
                        $(this).parent("td").find(".password").val(''); //delete typed password
                        if (password == '') {
                            alert("Please Enter Password");
                            return false;
                        }
                        $(this).parents("td").find(".button").hide();
                        $(this).parents("td").find(".password").hide();
                        $("#messageDiv").show().html("Please Wait");
                        var thisObj = $(this);

                        $.ajax({
                            url: "http://75.112.188.125/pdfviewer_<?php echo $values["company_code"]?>/public/authenticate/changepassword",
                            type: "POST",
                            data: {id: id, password: password, key: '62e759a21c3297341f9c0824598b7d22'},
                        }).done(function (result) {
                            $(thisObj).parents("td").find(".changePassword").show();
                            $("#messageDiv").show().html(result.msg);

                        });
                    });
                    $("#searchBy").change(function () {
                        var showId = $("#searchBy").val();
                        $(".filterByTr").hide();
                        $("#" + showId).show();
                    });
                    $(".searchForm").submit(function (e) {
                        var keyword = $(this).find(".keyword").val();
                        if (keyword == '') {
                            alert("Please enter search keyword");
                            e.preventDefault();
                        }
                    });
                </script>
                <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                <script>
                    $(function () {
                        $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
                    });
                </script>