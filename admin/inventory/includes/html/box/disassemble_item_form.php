

<script language="JavaScript1.2" type="text/javascript">

    $(document).ready(function() {
        var counter = 2;
        //var TaxRateOption = $("#TaxRateOption").val();

        $("#addrow").on("click", function() {
            /*var counter = $('#myTable tr').length - 2;*/

            counter = parseInt($("#NumLine").val()) + 1;

            //setInterval(function() {
               // var number = 1 + Math.floor(Math.random() * 6);
                //$('#NumLine').val(number);
            //}, 10);

            //alert(counter);

            var newRow = $("<tr class='itembg'>");
            var cols = "";

            //cols += '<td><input type="text" class="textbox" name="sku' + counter + '"/></td>';


            cols += '<td><img src="../images/delete.png" id="ibtnDel">&nbsp;<input type="text" name="sku' + counter + '" id="sku' + counter + '" class="disabled" readonly size="10" maxlength="10"  />&nbsp;<a class="fancybox  fancybox.iframe" href="DisItemList.php?id=' + counter + '" ><img src="../images/view.gif" border="0"></a>&nbsp;&nbsp;<a class="fancybox reqbox fancybox.iframe" id="req_link' + counter + '" href="reqItem.php?id=' + counter + '" style="display:none"><img src="../images/tab-new.png" style="display:none;" border="0" title="Additional Items" ></a><input type="hidden" name="item_id' + counter + '" id="item_id' + counter + '" readonly maxlength="20"  /><input type="hidden" name="req_item' + counter + '" id="req_item' + counter + '" readonly /><input type="hidden" name="old_req_item' + counter + '" id="old_req_item' + counter + '" readonly /><input type="hidden" name="add_req_flag' + counter + '" id="add_req_flag' + counter + '" readonly /></td><td><select name="Condition'+counter+'" id="Condition'+counter+'" class="textbox" style="width:120px;"><option value="">Select Condition</option><?=$ConditionDrop?></select></td><td><input type="text" name="description' + counter + '" id="description' + counter + '" class="disabled" readonly style="width:200px;"  maxlength="50" onkeypress="return isAlphaKey(event);" /></td><td><input type="hidden" name="valuationType' + counter + '" id="valuationType' + counter + '" class="disabled" readonly  size="5"/><input type="text" name="qty' + counter + '" id="qty' + counter + '" class="textbox"  size="5"/><br><span id="editType' + counter + '"></span><span style="display:none;" id="serial' + counter + '"><a class="fancybox slnoclass fancybox.iframe" href="AddDisSerial.php?id=' + counter + '&SerialType=adjust" id="addItem"><img src="../images/tab-new.png"  title="Serial number">&nbsp;Add S.N.</a></span><input  name="serial_value' + counter + '" id="serial_value' + counter + '"  value="" type="hidden"   class="textbox" size="10"   /><input type="hidden" name="serialPrice' + counter + '" id="serialPrice' + counter + '" value="" readonly   /><input  name="serialdesc' + counter + '" id="serialdesc' + counter + '"  value="" type="hidden"   class="textbox" size="10"  /><input  name="Comp_Serialized' + counter + '" id="Comp_Serialized' + counter + '"  value="" type="hidden"   class="textbox" size="10"  maxlength="30" /></td><td><input type="text" name="price' + counter + '"  id="price' + counter + '" class="textbox" size="15" maxlength="10" onkeypress="return isDecimalKey(event);"/></td><td align="right"><input type="text" name="amount' + counter + '" id="amount' + counter + '" class="disabled" readonly size="15" maxlength="10" onkeypress="return isDecimalKey(event);" style="text-align:right;"/></td>';



            newRow.append(cols);
            //if (counter == 4) $('#addrow').attr('disabled', true).prop('value', "You've reached the limit");
            $("table.order-list").append(newRow);
            $("#NumLine").val(counter);
            counter++;
        });

        $("table.order-list").on("blur", 'input[name^="price"],input[name^="WastageQty"]', function(event) {
            calculateRow($(this).closest("tr"));
            calculateGrandTotal();
        });

 $("table.order-list").on("focus",'input[name^="sku"]', function (event) {
			
			var add_req_flag = $(this).closest("tr").find('input[name^="add_req_flag"]').val();
			if(add_req_flag == 0){
			  addRequiredItem($(this).closest("tr"));
			}		
			
			
			
			
			
		});



        $("table.order-list").on("blur", 'input[name^="qty"]', function(event) {

            calculateRow($(this).closest("tr"));
            calculateGrandTotal();
        });
        $("table.order-list").on("click", "#ibtnDel", function(event) {

            /********Edited by pk **********/
            var row = $(this).closest("tr");
            var id = row.find('input[name^="id"]').val();
            if (id > 0) {
                var DelItemVal = $("#DelItem").val();
                if (DelItemVal != '')
                    DelItemVal = DelItemVal + ',';
                $("#DelItem").val(DelItemVal + id);
            }
            /*****************************/
            $(this).closest("tr").remove();
            calculateGrandTotal();

        });

        $("table.order-list").on("click", "#addItem", function(event) {

            /********Edited by pk **********/
            var row = $(this).closest("tr");
            var qty = row.find('input[name^="qty"]').val();
            var Wastageqty = row.find('input[name^="Wastageqty"]').val();
            var serial_sku = row.find('input[name^="sku"]').val();
            var serial_value_sel = row.find('input[name^="serial_value"]').val();
            if (qty > 0) {
                var linkhref = $(this).attr("href") + '&total=' + qty + '&Wastageqty=' + Wastageqty + '&sku=' + serial_sku+'&serial_value_sel='+serial_value_sel;
                $(this).attr("href", linkhref);
            }
            /*****************************/

        });


    });

    function calculateRow(row) {

        var price = +row.find('input[name^="price"]').val();
        var qty = +row.find('input[name^="qty"]').val();

        var totalQ = qty;
        var SubTotal = price * totalQ;
//alert(totalQ);


        row.find('input[name^="amount"]').val(SubTotal.toFixed(2));
    }

    function calculateGrandTotal() {
        var subtotal = 0, TotalValue = 0;
        var TotalQty = 0;
        //var Currency = $("#Currency").val();

        $("table.order-list").find('input[name^="amount"]').each(function() {
            subtotal += +$(this).val();
        });
        $("table.order-list").find('input[name^="qty"]').each(function() {
            TotalQty += +$(this).val();
        });
        $("#TotalQty").val(TotalQty.toFixed(2));
        $("#TotalValue").val(subtotal.toFixed(2));

        subtotal += +$("#Freight").val();

        //$("#TotalAmount").val(subtotal.toFixed(2));
    }

function addRequiredItem(row) { 
			
			var req_item = row.find('input[name^="req_item"]').val();
			//alert(req_item);
			//var no_req_item = row.find('input[name^="no_req_item"]').val();
			if(req_item != ''){
				var req_itm_sp = req_item.split("#");	
				var req_item_length = req_itm_sp.length;
			}	
	
			<!--FOR ITEM DELETE CODE -->
			var old_req_item = row.find('input[name^="old_req_item"]').val();
              
			if(old_req_item != ''){
				var old_req_itm_sp = old_req_item.split("#");	
				var lenOldReqItem = old_req_itm_sp.length;
			}
			
			var NumLineOld =  parseInt($("#NumLine").val());

		   if(lenOldReqItem > 0){

			for(var f = 0; f<lenOldReqItem; f++){
				var oldreqItem = old_req_itm_sp[f];
				var old_req_itm_sp_pipe = oldreqItem.split("|");
			  for(var a = 1; a<=NumLineOld; a++){
				if(document.getElementById("sku"+a) != null){
                                            
					if(document.getElementById("sku"+a).value == old_req_itm_sp_pipe[1])
						{
                                                     
                                                      var rowTR =  $("#sku"+a).closest("tr");
                                                      var skutemp = rowTR.find('input[name^="sku"]').val();
                                                     // alert(old_req_itm_sp_pipe[1]+"=="+skutemp);
                                                      
                                                      	var id = rowTR.find('input[name^="id"]').val(); 
                                                        if(id>0){
                                                                var DelItemVal = $("#DelItem").val();
                                                                if(DelItemVal!='') DelItemVal = DelItemVal+',';
                                                                $("#DelItem").val(DelItemVal+id);
                                                        }
                                                        /*****************************/
                                                        rowTR.remove();
                                                       			
							 
                                                }
						

				   }	
			  }
			}		
	          }

		<!--END ITEM DELETE CODE-->

		<!--FOR ITEM ADD CODE -->
 		 //alert(req_item_length);
		if(req_item_length > 0){
			for(var r = 1; r<=req_item_length; r++){
				$("#addrow").click();
			}

			var NumLine =  parseInt($("#NumLine").val());

					
			for(var s = 0; s < req_item_length; s++){
				var reqItem = req_itm_sp[s];
				var req_itm_sp_pipe = reqItem.split("|");
				

				for(var m = 1; m<=NumLine; m++){
				if(document.getElementById("sku"+m) != null){
					if(document.getElementById("sku"+m).value == "")
						{
							document.getElementById("item_id"+m).value = req_itm_sp_pipe[0];
							document.getElementById("sku"+m).value = req_itm_sp_pipe[1];
							document.getElementById("description"+m).value = req_itm_sp_pipe[2];
							document.getElementById("qty"+m).value = req_itm_sp_pipe[3];
							//document.getElementById("on_hand"+m).value = req_itm_sp_pipe[4];
							
							document.getElementById("price"+m).value = '0.00';
                                                        //document.getElementById("price"+m).disabled=true;
                                                        //document.getElementById("price"+m).setAttribute("class", "disabled");
                                                        //class="disabled"
							break;	
                                                }		

				   }	
				}		
			}

		}	
			
		<!--END ITEM ADD CODE-->
		        
		row.find('input[name^="add_req_flag"]').val('1');		

			
		}

function getItemCondionQty(Sku,SelID,Condi){
	
	
	
	if(Sku!='')
	{			
	    ShowHideLoader('1', 'P');    
	    SendUrl = 'action=getItemCondionQty&Sku='+Sku+'&Condi='+Condi;
	    $.ajax({
		    type: "GET",
		    url: "../sales/ajax.php",
		    data: SendUrl,
		    dataType : "JSON",
		    success: function(responseText){                                               
			//document.getElementById("on_hand" + SelID).value =responseText["condition_qty"];  
if(responseText["AvgCost"]>0){
          $('#price'+SelID).val(responseText["AvgCost"]);             
	    }else{

$('#price'+SelID).val('0.00');
}
	
			ShowHideLoader('2', 'P');    
		                                
		}
	    }); 
	}	
}

</script>



<table width="100%" id="myTable" class="order-list"  cellpadding="0" cellspacing="1">
    <thead>
        <tr align="left"  >
            <td width="19%" class="heading" >&nbsp;&nbsp;&nbsp;SKU</td>
<td   width="15%" class="heading" >Condition</td>
            <td   width="15%" class="heading" >Description</td>
            <!--td width="12%" class="heading" >Valuation Type</td-->
            <td width="12%" class="heading" >Qty</td>
            <!--td width="12%" class="heading" >Wastage Qty</td-->
            <td width="12%"  class="heading" >Unit Cost</td>
            <td width="12%"  class="heading" align="right" >Total Cost</td>	
        </tr>
    </thead>
    <tbody>
        <?
        $TotalQty = $Total_bom_cost=0;
        for ($Line = 1; $Line <= $NumLine; $Line++) {
            $Count = $Line - 1;
            $arryItem = $objItem->GetItems($arryBomItem[$Count]['item_id'], '', '', '');


if($_GET['bc']!=''){

$arryBomItem[$Count]['id'] ='';
}
            if ($loadAssemble == 1) {
                $orderQty = $arryBomItem[$Count]['bom_qty'];
            } else {
                $orderQty = $arryBomItem[$Count]['qty'];
            }
$ConditionSelectedDrop  =$objCondition-> GetConditionDropValue($arryBomItem[$Count]["Condition"]);
$ReqDisplay = !empty($arryItem[$Count]['req_item'])?(''):('style="display:none"');

if(empty($arrySaleItem[$Count]['id'])) $arrySaleItem[$Count]['id']='';
if(empty($arrySaleItem[$Count]['req_item'])) $arrySaleItem[$Count]['req_item']='';
if(empty($arrySaleItem[$Count]['no_req_item'])) $arrySaleItem[$Count]['no_req_item']='';
if(empty($arryBomItem[$Count]["serial_value"]))  $arryBomItem[$Count]["serial_value"]='';
if(empty($arryBomItem[$Count]["serialPrice"]))  $arryBomItem[$Count]["serialPrice"]='';
if(empty($arryBomItem[$Count]["serialdesc"]))  $arryBomItem[$Count]["serialdesc"]='';
if(empty($arryBomItem[$Count]["bom_qty"]))  $arryBomItem[$Count]["bom_qty"]='';


            ?>
            <tr class="itembg">
                <td><?= ($Line >= 1) ? ('<img src="../images/delete.png" id="ibtnDel">') : ("&nbsp;&nbsp;&nbsp;") ?>
                    <input type="text" name="sku<?= $Line ?>" id="sku<?= $Line ?>" class="disabled" readonly size="10" maxlength="10"  value="<?= stripslashes($arryItem[0]['Sku']) ?>"/>&nbsp;<a class="fancybox fancybox.iframe" href="DisItemList.php?id=<?= $Line ?>" ><img src="../images/view.gif" border="0"></a><a class="fancybox reqbox  fancybox.iframe" href="reqItem.php?id=<?=$Line?>&oid=<?=$arrySaleItem[$Count]['id']?>" id="req_link<?=$Line?>" <?=$ReqDisplay?>><img src="../images/tab-new.png" style="display:none;" border="0" title="Additional Items"></a>
                    <input type="hidden" name="item_id<?= $Line ?>" id="item_id<?= $Line ?>" value="<?= stripslashes($arryItem[0]['ItemID']) ?>" readonly maxlength="20"  />
                    <input type="hidden" name="id<?= $Line ?>" id="id<?= $Line ?>" value="<?= stripslashes($arryBomItem[$Count]['id']) ?>" readonly maxlength="20"  />
<input type="hidden" name="id<?=$Line?>" id="id<?=$Line?>" value="<?=stripslashes($arryBomItem[$Count]['id'])?>" readonly maxlength="20"  />
<input type="hidden" name="req_item<?=$Line?>" id="req_item<?=$Line?>" value="<?=stripslashes($arrySaleItem[$Count]['req_item'])?>" readonly />
                 <!--<input type="hidden" name="no_req_item<?=$Line?>" id="no_req_item<?=$Line?>" value="<?=stripslashes($arrySaleItem[$Count]['no_req_item'])?>" readonly />-->

                 <input type="hidden" name="old_req_item<?=$Line?>" id="old_req_item<?=$Line?>" value="<?=stripslashes($arrySaleItem[$Count]['req_item'])?>" readonly />

                 <input type="hidden" name="add_req_flag<?=$Line?>" id="add_req_flag<?=$Line?>" value="" readonly />
                </td>
<td><select name="Condition<?=$Line?>" id="Condition<?=$Line?>" onchange="getItemCondionQty('<?=stripslashes($arryItem[0]['Sku'])?>','<?=$Line?>',this.value)" class="textbox" style="width:120px;display:<?=$TaxShowHide?>"><option value="">Select Condition</option><?=$ConditionSelectedDrop?></select></td>
                <td><input type="text" class="disabled" readonly name="description<?= $Line ?>" id="description<?= $Line ?>" class="textbox" style="width:200px;"  maxlength="50" onkeypress="return isAlphaKey(event);" value="<?= stripslashes($arryItem[0]['description']) ?>"/></td>

                

                <td>

<input type="hidden" name="valuationType<?= $Line ?>"  readonly id="valuationType<?= $Line ?>" class="disabled" size="5" maxlength="10" onkeypress="return isNumberKey(event);" value="<?= stripslashes($arryItem[0]['evaluationType']) ?>"/>
<input type="text" class="textbox" onkeypress="return isNumberKey(event);"   name="qty<?= $Line ?>" id="qty<?= $Line ?>" class="textbox"  size="5"  value="<?= $orderQty ?>"/><input type="hidden" class="disabled" readonly name="bomqty<?= $Line ?>" id="bomqty<?= $Line ?>" class="textbox"  size="5"  value="<?= stripslashes($arryBomItem[$Count]["bom_qty"]) ?>"/>

                    <span style="display:none;"  id="serial<?= $Line ?>"><a  class="fancybox slnoclass fancybox.iframe" href="AddDisSerial.php?id=<?= $Line ?>&SerialType=adjust"id="addItem"><img src="../images/tab-new.png"  title="Serial number">&nbsp;Add S.N.</a></span>


                    <span id="editType<?= $Line ?>">

                        <? if ($arryItem[0]['evaluationType'] == 'Serialized' || $arryItem[0]['evaluationType'] == 'Serialized Average') { ?>
                            <br>
                            <a  class="fancybox slnoclass fancybox.iframe" href="AddDisSerial.php?id=<?= $Line ?>&SerialType=adjust"id="addItem"><img src="../images/tab-new.png"  title="Serial number">&nbsp;Add S.N.</a>
                            <?
                        } 
                        ?>
                    </span>
                    <input type="hidden" name="serial_value<?= $Line ?>" id="serial_value<?= $Line ?>" value="<?= stripslashes($arryBomItem[$Count]["serial_value"]) ?>" readonly maxlength="20"  />
<input type="hidden" name="serialPrice<?= $Line ?>" id="serialPrice<?= $Line ?>" value="<?= stripslashes($arryBomItem[$Count]["serialPrice"]) ?>" readonly   />
 <input type="hidden" name="serialdesc<?= $Line ?>" id="serialdesc<?= $Line ?>" value="<?= stripslashes($arryBomItem[$Count]["serialdesc"]) ?>" readonly   />


                    <input  name="Comp_Serialized<?= $Line ?>" id="Comp_Serialized<?= $Line ?>"  value="<?= $arryItem[0]['evaluationType'] ?>" type="hidden"   class="textbox" size="10"  maxlength="30" />
                </td>

                <td style="display:none;"><input type="text" class="disabled" readonly name="WastageQty<?= $Line ?>" id="WastageQty<?= $Line ?>" class="textbox" size="5" maxlength="6" onkeypress="return isNumberKey(event);" value="<?= stripslashes($arryBomItem[$Count]["wastageQty"]) ?>"/></td>

                <td><input type="text" class="textbox"  name="price<?= $Line ?>" id="price<?= $Line ?>" class="textbox" size="15" maxlength="10" onkeypress="return isDecimalKey(event);" value="<?= stripslashes($arryBomItem[$Count]["unit_cost"]) ?>"/></td>
                <td align="right"><input type="text" class="disabled" readonly align="right" name="amount<?= $Line ?>" id="amount<?= $Line ?>" class="disabled" readonly size="15" maxlength="10" onkeypress="return isDecimalKey(event);" style="text-align:right;" value="<?= stripslashes($arryBomItem[$Count]["total_bom_cost"]) ?>"/></td>


            </tr>
            <?
            //$TotalQty += $arryBomItem[$Count]["bom_qty"];
            $Total_bom_cost += $arryBomItem[$Count]["total_bom_cost"];
        }
        ?>
    </tbody>
    <tfoot>

        <tr class="itembg">
            <td colspan="8" align="right">

                <a href="Javascript:void(0);"  id="addrow" class="add_row" style="float:left">Add Row</a>
                <input type="hidden" name="NumLine" id="NumLine" value="<?= $NumLine ?>" readonly maxlength="20"  />
                <input type="hidden" name="DelItem" id="DelItem" value="" class="inputbox" readonly />


                <?
                $TotalQty = $TotalQty;

                $TotalValue = $Total_bom_cost;
                ?>


                Total Cost : <input type="text" align="right" name="TotalValue" id="TotalValue" class="disabled" readonly value="<?= $Total_bom_cost ?>" size="15" style="text-align:right;"/>
                <br><br>
            </td>
        </tr>
    </tfoot>
</table>

<? //echo '<script>SetInnerWidth();</script>';    ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#addItemBackup").click(function() {
            var TotQty = $("#qty1").val();
            $(this).attr("href", "AddDisSerial.php?id=1&total=" + TotQty);
            $('.fancybox').fancybox();
        })

    });


    $(document).ready(function() {


        $("#addItem").fancybox({
            'width': 450
        });



    });

</script>