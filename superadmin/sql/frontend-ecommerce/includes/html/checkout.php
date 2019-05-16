<!--main container -->
<?php //print_r($_SESSION);?>
<script language="javascript" src="../includes/checkout.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="container cart">
  <div class="row">
    <div class="col-lg-12">
      <div class="panel-group" id="accordion">
      
        <div class="panel panel-default login-panel">
          <div class="panel-heading">
            <h4 class="panel-title">
            <a class="tab-click accordion-toggle"> STEP 1: CHECKOUT OPTIONS </a>         
            <a class="accordion-toggle hide" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> STEP 1: CHECKOUT OPTIONS </a> </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse <?php if(empty($_SESSION['Cid']) AND empty($_SESSION['guestId'])) echo 'in';?>">
            <div class="panel-body">
              <div class="row">
                <div class="col-6 col-lg-5"> 
                  <!-- FORM -->
                  <form>
                    <fieldset>
                      <legend>Sign in</legend>
                      <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="text" class="form-control l-email" id="exampleInputEmail" placeholder="Enter email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control l-password" id="exampleInputPassword" placeholder="Password">
                      </div>
                     <!--  <div class="checkbox">
                        <label>
                          <input type="checkbox">
                          Check me out </label>
                      </div>-->
                      <a href="javascript:void(0)" class="btn btn-default e-login loader-near">Login</a>
                      <div class="e-loader hide"></div>
                     <!--  <button type="submit" class="btn btn-default">Submit</button>-->
                    </fieldset>
                  </form>
                  <!-- /FORM --> 
                  
                </div>
                <div class="col-6 col-lg-5 col-offset-1"> 
                  <!-- FORM -->
                  <form>
                    <fieldset>
                      <legend>New Users</legend>
                      <a href="#createaccount" role="button" class="btn btn-success btn-lg new-registration" data-toggle="modal" >New Registration</a>
                     
                      <a class="btn btn-success btn-lg guestlogin loader-near" href="javascript:void(0)">Start Guest Checkout</a>
                       <div class="e-loader hide"></div>
                    </fieldset>
                  </form>
                  <!-- /FORM --> 
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <div class="panel panel-default billing-panel">
          <div class="panel-heading">
            <h4 class="panel-title"> 
             <a class="accordion-toggle tab-click" > STEP 2: ACCOUNT &amp; BILLING DETAILS </a>
            <a class="accordion-toggle hide" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> STEP 2: ACCOUNT &amp; BILLING DETAILS </a> </h4>
          </div>
          <div id="collapseTwo" class="panel-collapse collapse <?php if(!empty($_SESSION['Cid']) OR !empty($_SESSION['guestId'])) echo 'in';?>">
            <div class="panel-body">
              <div class="row">
                <div class="col-12 col-lg-12"> 
                  
                  <?php if(!empty($_SESSION['Cid']) || !empty($_SESSION['guestId'])) { ?>
                  <!-- FORM -->
                  <form>
                    <fieldset>
                      <legend>Enter your billing details</legend>
                      <div class="form-group">
                        <label for="FirstName">First Name</label>
                        <input type="text" value="<?=$arryCustomer[0]['FirstName']?>" class="form-control b-fname" name="FirstName" id="FirstName" maxlength="24" placeholder="Enter First Name">
                        <!-- <input type="text" class="form-control" id="FirstName" placeholder="Enter First Name">-->
                      </div>
                      <div class="form-group">
                        <label for="LastName">Last Name</label>
                         <input type="text" value="<?=$arryCustomer[0]['LastName']?>" class="form-control b-lname" name="LastName" id="LastName" maxlength="24" placeholder="Enter Last Name">
                        <!-- <input type="text" class="form-control" id="LastName" placeholder="Enter Last Name">-->
                        
                      </div>
                      <div class="form-group">
                        <label for="Company">Company</label>                       
                         <input type="text" value="<?=$arryCustomer[0]['Company']?>" name="Company" id="Company" maxlength="36" class="form-control b-company" placeholder="Enter Company">
                       </div>
                      <div class="form-group">
                        <label for="Adress1">Adress 1</label>
                        <input type="text" value="<?=$arryCustomer[0]['Address1']?>" name="Address1" id="Address1" maxlength="36"  class="form-control b-address1" placeholder="Enter Address 1">
                      
                      </div>
                      <div class="form-group">
                        <label for="Adress2">Adress 2</label>
                           <input type="text" value="<?=$arryCustomer[0]['Address2']?>" name="Address2" id="Address2" maxlength="36"  class="form-control b-address2" placeholder="Enter Address 2">
                       </div>                    
                      <div class="form-group">
                        <label for="CountrySelect">Country</label>
                        <div class="sel-wrap-friont1">
		                     <?php
		                    if (!empty($arryCustomer[0]['Country'])) 
		                        $CountrySelected = $arryCustomer[0]['Country'];
		                    else 
		                        $CountrySelected = 106;
		                     ?>
                        <select name="Country" class="inputbox form-control b-country" id="country_id"  onChange="Javascript: StateListSend();">
                            <? for ($i = 0; $i < sizeof($arryCountry); $i++) { ?>
                                <option value="<?= $arryCountry[$i]['country_id'] ?>" <? if ($arryCountry[$i]['country_id'] == $CountrySelected) {
                                echo "selected";
                            } ?>>
                                <?= $arryCountry[$i]['name'] ?>
                                </option>
                                <? } ?>
               			 </select>  
                      </div>
                      </div>
                      
                      
                  	<div class="field required form-group">
                   		 <label><?=STATE?> : <span class="red">*</span></label>
                   		 <div class="sel-wrap-friont1" id="state_td"></div>
                  	</div>
                  <div class="field required form-group" id="StateBillOther_Div">
                    <label><div id="StateTitleDiv"><?=OTHER_STATE?> : <span class="red">*</span></div></label>
                      <div id="StateValueDiv"><input name="OtherState" type="text" class="inputbox form-control b-o-state" id="OtherState" value="<?php echo $arryCustomer[0]['OtherState']; ?>"  maxlength="30" /> </div>  
                  </div>
                   <div class="field required form-group" id="CityBill_Div">
                       <label><div id="MainCityTitleDiv"> <?=CITY?> : <span class="red">*</span></div></label>
                       <div id="city_td" class="sel-wrap-friont1"></div>
                  </div>
                   <div class="field required form-group" id="CityBillOther_Div">
                   	 <label><div id="CityTitleDiv"><?=OTHER_CITY?> : <span class="red">*</span></div></label>
                      <div id="CityValueDiv">
                          <input name="OtherCity" type="text" class="inputbox form-control b-o-city" id="OtherCity" value="<?php echo $arryCustomer[0]['OtherCity']; ?>"  maxlength="30" />  
                      </div>
                  </div>
                   <div class="form-group">
                        <label for="PostCode">Post Code</label>
                        <input type="text" value="<?=$arryCustomer[0]['ZipCode']?>" placeholder="Enter Post Code" name="ZipCode" maxlength="24" id="ZipCode" class="form-control b-zip">
                    </div>
                    <div class="field form-group required">
                    	<label><?=PHONE_NUMBER?> : <span class="red">*</span></label>
                      <input type="text" value="<?=$arryCustomer[0]['Phone']?>" placeholder="Enter Phone Number" class="inputbox form-control b-phone" name="Phone" onkeyup="keyup(this);" maxlength="24" id="Phone">
                  </div>
                  <div class="field form-group required">
                    <label><?=EMAIL_ADDRESS?> : <span class="red">*</span></label>
                      <input type="text" value="<?=$arryCustomer[0]['Email']?>" name="Email" id="Email" placeholder="Enter Email Number" class="inputbox form-control b-email">
                  </div>
                  <div class="field required date form-group">
                      <script type="text/javascript">
                            jQuery(function() {
                            	jQuery('#DelivaryDate').datepicker(
                                           {
                                           yearRange: '<?=date("Y")?>:<?=date("Y")+5?>',
                                           dateFormat: 'dd-mm-yy',                
                                           changeMonth: true,
                                           minDate : "+1D",
                                           changeYear: true

                                           }
                                   );
                            });
                        </script>
                    <label><?=DELIVERY_DATE?> : </label>
                    <div><input type="text" value="<?=$_SESSION['DelivaryDate']?>" maxlength="20" name="DelivaryDate"  id="DelivaryDate">
                        <img  src="../images/cal.png" style="margin: 2px 2px 2px -22px;vertical-align: text-bottom;" alt="..." title="...">
                        </div>
                     <div style="padding-top:5px;clear: both;">
                    </div>
                    </div>
                                 
	                <div class="form-group">	                	
		                  <div class="col-sm-12">
		                    <label class="radio-inline">
		                      <input type="radio" class="ship-bill-address" value="same" name="ship_bill" checked>
		                       Ship to this address</label>
		                    <input type="radio" class="ship-bill-address" value="other" name="ship_bill">
		                      Ship to different address</label>
		                  </div>
	                </div>  
	                <div class="bottom">
	                <input type="hidden" value="<?php echo $arryCustomer[0]['Country']; ?>" id="billcountry_id" name="billcountry_id">
                    <input type="hidden" value="<?php echo $arryCustomer[0]['State']; ?>" id="main_state_id" name="main_state_id">		
                    <input type="hidden" name="main_city_id" id="main_city_id"  value="<?php echo $arryCustomer[0]['City']; ?>" />
	                 <a href="javascript:void(0)" class="btn btn-info e-billing-action loader-near">Continue</a>
	                  <div class="e-loader hide"></div>
                </div>    
                     
                    </fieldset>
                  </form>
                  <!-- /FORM --> 
                 <?php }?>
                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <div class="panel panel-default shipping-panel">
          <div class="panel-heading">
            <h4 class="panel-title">
             <a class="accordion-toggle tab-click"> STEP 3: SHIPPING DETAILS </a> 
             <a class="accordion-toggle hide" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"> STEP 3: SHIPPING DETAILS </a> 
             </h4>
          </div>
          <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="row">
                <div class="col-12 col-lg-12"> 
                  <!-- FORM -->
                  <form>
                    <fieldset>
                        <?php 
                        $sfname=$slname='';
                       
                        if($arryCustomer[0]['ShippingName']){
                             $sname=explode(' ' ,$arryCustomer[0]['ShippingName'],2);
                            $sfname=$sname[0];
                            $slname=!empty($sname[1])?$sname[1]:'';
                        }?>
                      <legend>Enter your Shipping details</legend>
                      <?php
                       /********Connecting to main database*********/
                $Config['DbName'] = $Config['DbMain'];
                $objConfig->dbName = $Config['DbName'];
                $objConfig->connect();
            /*******************************************/
                      foreach($addresses as $address) {
                      
                      
                    if(!empty($address['State'])) {
                                  $arryState = $objRegion->getStateName($address['State']);
                                  $StateName = stripslashes($arryState[0]["name"]);
                          }else if(!empty($address['OtherState'])){
                                   $StateName = stripslashes($address['OtherState']);
                          }

                          if(!empty($address['City'])) {
                                  $arryCity = $objRegion->getCityName($address['City']);
                                  $CityName = stripslashes($arryCity[0]["name"]);
                          }else if(!empty($address['OtherCity'])){
                                   $CityName = stripslashes($address['OtherCity']);
                          }
                      
                      ?>
                  <div class="option clearfix">
                      <input type="radio" value="<?=$address['Csid']?>" <?php if($_SESSION['shipping_address_id'] == $address['Csid']){echo "checked";}?> class="ShippingAddress"  name="shipping_address_id">
                    <p style="margin-left: 28px;"><?=ucfirst($address['Name'])?>, 
                    <?=ucfirst($address['Address1'])?>, <?=ucfirst($address['Address2'])?>,
                    <br>
                    <?=ucfirst($CityName)?>, <?=ucfirst($StateName)?>, <?=$address['Zip']?><br>
                                    <?php
                                     if($address['Country']>0){
                                                    $arryCountryName = $objRegion->GetCountryName($address['Country']);
                                                    $CountryName = stripslashes($arryCountryName[0]["name"]);
                                            }
                                    ?>
                                    <?=$CountryName?></p>
                  </div>
                   <?php } ?>
                      
                  <?php      /********Connecting to main database*********/
               $Config['DbName'] = $_SESSION['CmpDatabase'];
                $objConfig->dbName = $Config['DbName'];
                $objConfig->connect();
            /*******************************************/
                ?>
                      
                     <div class="form-group">
                      <input type="radio" value="new"  name="shipping_address_id" class="toggle-new-shipping" <?php if($_SESSION['shipping_address_id'] == "new" || empty($_SESSION['shipping_address_id'])){echo "checked";}?> id="shipping_address_id">
                        <?=ENTER_NEW_ADDRESS?>
                        </div>
                     <div id="div_new_shipping_address">
                     <div class="form-group field first required" style="width: 367px;">
                      <label><?=ADDRESS_TYPE?> : <span class="red">*</span></label>  
                      <div style="">
                       <input type="radio" name="AddressType" <?php if($_SESSION['AddressType'] == "Residential"){?> checked <?php }?> id="AddressType" value="Residential">Residential
                      </div>
                     <div style="float: right;margin: -20px;">
                     <input type="radio" name="AddressType" id="AddressType" <?php if($_SESSION['AddressType'] == "Business"){?> checked <?php }?> value="Business">Business
                     </div>
                      

                    </div>
                      <div class="form-group">
                        <label for="FirstName">First Name</label>
                           <input type="text" class="form-control c-fname" value="<?=$sfname?>" placeholder="Enter First Name" name="ShippingName" id="ShippingName" maxlength="24">
                       
                      </div>
                      <div class="form-group">
                        <label for="LastName">Last Name</label>
                           <input type="text" class="form-control c-lname" value="<?php echo $slname;?>" placeholder="Enter Last Name" name="ShippingLName" id="ShippingLName" maxlength="24">
                      
                      </div>
                      <div class="form-group">
                        <label for="Company">Company</label>
                          <input type="text" value="<?=$arryCustomer[0]['ShippingCompany']?>" class="form-control c-company" placeholder="Enter Company" name="ShippingCompany" id="ShippingCompany" maxlength="36">

                      </div>
                      <div class="form-group">
                        <label for="Adress1">Adress 1</label>
                        <input type="text" value="<?=$arryCustomer[0]['ShippingAddress1']?>" class="form-control c-address1" placeholder="Enter Adress 1" name="ShippingAddress1" id="ShippingAddress1" maxlength="36">

                      </div>
                      <div class="form-group">
                        <label for="Adress2">Adress 2</label>
                         <input type="text" value="<?=$arryCustomer[0]['ShippingAddress1']?>" class="form-control c-address2" placeholder="Enter Adress 2" name="ShippingAddress2" id="ShippingAddress2" maxlength="36">
                        
                      </div>
                      
                       <div class="form-group field required" id="shipping_country">
                      <label><?=COUNTRY?> : <span class="red">*</span></label>
                      <div class="sel-wrap-friont">
                          
                            <?php
                    if ($arryCustomer[0]['ShippingCountry'] != '') {
                        $CountrySelected = $arryCustomer[0]['ShippingCountry'];
                    } else {
                        $CountrySelected = $Config['country_id'];
                    }
                     ?>
                        <select name="country_id_shipp" class="inputbox form-control" id="country_id_shipp"  onChange="Javascript: StateListSendCheckout();">
                            <? for ($i = 0; $i < sizeof($arryCountry); $i++) { ?>
                                <option value="<?= $arryCountry[$i]['country_id'] ?>" <? if ($arryCountry[$i]['country_id'] == $CountrySelected) {
                                echo "selected";
                            } ?>>
                                <?= $arryCountry[$i]['name'] ?>
                                </option>
                                <? } ?>
                           </select>  
                       
                        </div>
                    </div>
                      <div class="form-group field required">
                      <label><?=STATE?> : <span class="red">*</span></label>
                      <div class="sel-wrap-friont" id="state_td_shipp">
                        </div>
                    </div>
                    <div class="field form-group required" id="StateShippOther_Div">
                      <label><div id="StateTitleDiv_shipp"><?=OTHER_STATE;?> : <span class="red">*</span></div></label>                      
                        <div id="StateValueDiv_shipp"><input name="OtherState_shipp" type="text" class="inputbox form-control c-o-state" id="OtherState_shipp" value="<?=$arryCustomer[0]['OtherState_shipp']?>"  maxlength="30" /> </div>
                       
                    </div>
                      
                  <div class="field form-group required">
                      <label><div id="MainCityTitleDiv_shipp"> <?=CITY?> : <span class="red">*</span></div></label>
                       <div id="city_td_shipp" class="sel-wrap-friont"></div>
                    </div>
                    
                     <div class="field form-group required" id="CityShippOther_Div">
                      <label><div id="CityTitleDiv_shipp"><?=OTHER_CITY?> : <span class="red">*</span></div></label>
                      <div id="CityValueDiv_shipp"><input name="OtherCity_shipp" type="text" class="inputbox form-control c-o-city" id="OtherCity_shipp" value="<?=$arryCustomer[0]['OtherCity_shipp']?>"  maxlength="30" />  </div>
                    </div>
                    
                     <div class="field form-group">
                      <label><?=ZIP_CODE?> : <span class="red">*</span></label>
                        <input type="text" value="<?=$arryCustomer[0]['ShippingZip']?>" name="ShippingZip"  class="inputbox form-control c-zip" id="ShippingZip" maxlength="48">
                    </div>
                    <div class="field form-group required">
                      <label><?=PHONE_NUMBER?> : <span class="red">*</span></label>
                        <input type="text" value="<?=$arryCustomer[0]['ShippingPhone']?>" maxlength="20" name="ShippingPhone" class="inputbox form-control c-phone"  onkeyup="keyup(this);" id="ShippingPhone">
                       
                    </div>
                     <?php if(empty($_SESSION["guestId"])){?>  
                    <div class="field form-group">
                        <input type="checkbox" value="Yes" name="add_to_address_book" id="add_to_address_book">
                      <p style="margin-top: -18px; margin-left: 24px;"><?=ADD_THIS_NEW_ADDRESS?></p>
                    </div>
                    <?php }?>
                     </div>       
                     <input type="hidden" value="<?=$arryCustomer[0]['ShippingState']?>" id="main_state_id_shipp" name="main_state_id_shipp">		
                     <input type="hidden" name="main_city_id_shipp" id="main_city_id_shipp"  value="<?=$arryCustomer[0]['ShippingCity']?>" />
                      <a href="javascript:void(0)" class="btn btn-info e-shipping-action loader-near">Continue</a>  
                       <div class="e-loader hide"></div>                 
                    </fieldset>
                     
                  </form>
                  <!-- /FORM --> 
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="panel panel-default shipping-method-panel">
          <div class="panel-heading">
            <h4 class="panel-title">
             <a class="accordion-toggle tab-click"> STEP 4: SHIPPING METHOD </a> 
             <a class="accordion-toggle hide" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"> STEP 4: SHIPPING METHOD </a> </h4>
          </div>
          <div id="collapseFour" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="row">
                <div class="col-12 col-lg-12">
                  <form class="shipping-method-form">
                    <fieldset>
                      <legend>CHOOSE SHIPPING METHOD</legend>
                      <div class="all-shipping-method">
                      
                      </div>
                     <a href="javascript:void(0)" class="btn btn-info e-shipping-method-action loader-near">Continue</a>     
                      <div class="e-loader hide"></div>
                     
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default payment-method-panel">
          <div class="panel-heading">
            <h4 class="panel-title">
             <a class="accordion-toggle tab-click" > STEP 5: PAYMENT METHOD </a>
             <a class="accordion-toggle hide" data-toggle="collapse" data-parent="#accordion" href="#collapseFive"> STEP 5: PAYMENT METHOD </a> </h4>
          </div>
          <div id="collapseFive" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="row">
                <div class="col-12 col-lg-12">
                  <form>
                    <fieldset>
                      <legend>CHOOSE PAYMENT METHOD</legend>
                      <div class="all-payment-method">
                    
                      </div>
                      <div class="payment-option">
                      
                      
                      </div>
                      
                      <a href="javascript:void(0)" class="btn btn-info confirm-action loader-near">Continue</a> 
                       <div class="e-loader hide"></div>  
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default confirm-panel">
          <div class="panel-heading">
            <h4 class="panel-title">
             <a class="accordion-toggle tab-click"> STEP 6: CONFIRM ORDER </a>
             <a class="accordion-toggle hide" data-toggle="collapse" data-parent="#accordion" href="#collapseSix"> STEP 6: CONFIRM ORDER </a> </h4>
          </div>
          <div id="collapseSix" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="row">
                <div class="col-12 col-lg-12 table-confirm">
               
                </div>
                 <a href="javascript:void(0)" class="btn btn-info e-payment-method-action loader-near">Order Confirm</a> 
                  <div class="e-loader hide"></div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 
  <SCRIPT LANGUAGE=JAVASCRIPT>
  jQuery(document).ready(function(){
	
	  });
  var step=1,currentstep=1;
  <?php if(!empty($_SESSION['Cid'])) { ?>
    StateListSend();
    <?php } ?>
    StateListSendCheckout();         
    </SCRIPT>