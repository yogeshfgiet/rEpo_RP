<div class="right-search">
            	<h3><span class="icon"></span>Search</h3>
               
	 <form action="" method="get" class="admin_r_search_form" enctype="multipart/form-data" name="form2" onSubmit="return LoaderSearch();">
              <fieldset>
                     <label>Order ID:</label>
                      <input type='text' name="OrderID"  id="OrderID" class="inputbox" value="<?= $_GET['OrderID'] ?>"> 
             	</fieldset>
                 <fieldset>  
                    <label>Order Status:</label>
                     <div class="sel-wrap">
                      <select name="OrderStatus" id="OrderStatus">
                        <option <?php if($_GET['OrderStatus'] == "") { echo "selected";}?> value="">Any</option>
                        <option value="Process" <?php if($_GET['OrderStatus'] == "Process") { echo "selected";}?>>Process</option>
                        <option value="Cancelled" <?php if($_GET['OrderStatus'] == "Cancelled") { echo "selected";}?>>Cancelled</option>
                        <option value="Completed" <?php if($_GET['OrderStatus'] == "Completed") { echo "selected";}?>>Completed</option>
                      </select>
                      </div>
                      </fieldset>
                   <fieldset>  
                    <label>Payment Status:</label>
                     <div class="sel-wrap">
                      <select name="PaymentStatus" id="PaymentStatus">
                        <option  <?php if($_GET['PaymentStatus'] == "") { echo "selected";}?> value="">Any</option>
                        <option value="4" <?php if($_GET['PaymentStatus'] == "4") { echo "selected";}?>>Pending</option>			
                        <option value="1" <?php if($_GET['PaymentStatus'] == "1") { echo "selected";}?>>Received</option>
                        <option value="2" <?php if($_GET['PaymentStatus'] == "2") { echo "selected";}?>>Refunded</option>
                        <option value="3" <?php if($_GET['PaymentStatus'] == "3") { echo "selected";}?>>Canceled</option>
                      </select>
                      </div>
                      </fieldset>
                       <fieldset>
                            <label>Customer Name:</label>
                          <input type='text' name="CustomerName"  id="CustomerName" class="inputbox" value="<?= $_GET['CustomerName'] ?>"> 
             		</fieldset>
                    <fieldset>  
                    <label>Order Period:</label>
                     <div class="sel-wrap">
                      <select name="OrderPeriod" id="OrderPeriod">
                       <option value="" <?php if($_GET['OrderPeriod'] == "") { echo "selected";}?>>Any</option>
                        <option value="24" <?php if($_GET['OrderPeriod'] == "24") { echo "selected";}?>>Last 24 hours</option>
                        <option value="72" <?php if($_GET['OrderPeriod'] == "72") { echo "selected";}?>>Last 3 days</option>
                        <option value="168" <?php if($_GET['OrderPeriod'] == "168") { echo "selected";}?>>Last week</option>
                        <option value="336" <?php if($_GET['OrderPeriod'] == "336") { echo "selected";}?>>Last 2 weeks</option>
                        <option value="744" <?php if($_GET['OrderPeriod'] == "744") { echo "selected";}?>>Last month</option>
                      </select>
                      </div>
                      </fieldset>
                     <!--<fieldset>
                         <div class="sel-wrap">
                            <select name="asc" id="asc" >
                                <option value="Desc" <?// if ($_GET['asc'] == 'Desc') echo 'selected'; ?>>Desc</option>
                                <option value="Asc" <? //if ($_GET['asc'] == 'Asc') echo 'selected'; ?>>Asc</option>
                            </select>
                             </div>
                        </fieldset>-->
                                                  
                          <fieldset>
                           <input name="search" type="submit" class="button_btn" value="Search"  />
                            </fieldset>
                 

            </form>
            </div>