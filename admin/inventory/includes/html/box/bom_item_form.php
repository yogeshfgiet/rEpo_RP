<?
if(empty($arryBomItem)){   
	$arryBomItem = $objConfigure->GetDefaultArrayValue('inv_item_bom');
}
			
?>
<script language="JavaScript1.2" type="text/javascript">
 //By Chetan //
  $(function(){
	
	//by chetan update 24Jan2017//
	$(document).on('click','input[name^="itemPrimary"][type="button"]:visible',function(){
		if($('#component').is(':visible'))
		{
			except = $(this).next('input');		
			if($("table.order-list input[name^='Primary'][value=1]").not(except).length > 0){ return false;}
		
		}else{
			except = $(this).next('input');	
			if($(this).closest('table').find("input[name^='Primary'][value=1]").not(except).length > 0){ return false;}
		}		
		

		if($(this).closest('td').find('input[name^="Primary"]').val()!='1' || $(this).closest('td').find('input[name^="Primary"]').val()==''){
			$(this).closest('td').find('input[name^="Primary"]').val('1');
			$(this).css('background','#aaa');//81bd82
		}else{
			$(this).closest('td').find('input[name^="Primary"]').val('');
			$(this).css('background','');
		}	
	})//End//

        $("table #component #myTable tbody").sortable({
            items: 'tr.itembg',
            helper: fixwidth,
            update: resetITemOrders
        });

    

    var fixwidth = function(e, ui) {
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    };
     });
    var resetITemOrders = function(e,ui){
        
         $("table #component #myTable tbody tr.itembg").each(function(i) {console.log($(this).find('input[name^="orderby"]').val((i+1)));
            $(this).find('input[name^="orderby"]').val((i+1));
        });
    }
    
    //End//

/*
  function SetAutoComplete(elm) {
        $(elm).autocomplete({
            source: "../jsonSku.php",
            minLength: 1
        });

    }*/



</script>
<table width="100%" id="myTable" class="order-list"  cellpadding="0" cellspacing="1">
    <thead>
        <tr align="left"  >
            <td class="heading" style="width: 20%" >SKU</td>
            <td  class="heading" style="width: 40%">Description</td>
            <td style="width: 20%" class="heading" >Qty</td>
            <td style="width: 20%" class="heading" >Action </td>
             


</tr>
</thead>
<tbody>

<?php
$ReqDisplay='';
$TotalQty = 0;
$Total_bom_cost=0;
for ($Line = 1; $Line <= $NumLine; $Line++) {
  $Count = $Line - 1;
    //$ReqDisplay = !empty($arryBomItem[$Count]['req_item']) ? ('') : ('style="display:none"');
  ///  $ConditionSelectedDrop  =$objCondition-> GetConditionDropValue($arryBomItem[$Count]["Condition"]);
    ?>
    <tr class="itembg">
       <td style="width: 25%">
            <input type="text" name="sku<?= $Line ?>" onclick="Javascript:SetAutoComplete(this);" onblur="return SearchBOMComponent(this.value, '<?= $Line ?>');" id="sku<?= $Line ?>" class="textbox"  size="20" maxlength="20"  value="<?= stripslashes($arryBomItem[$Count]["sku"]) ?>"/>&nbsp;<span id="g-search-buttonss" ><a class="fancybox fancybox.iframe" href="comItemList.php?id=<?= $Line ?>" ><img src="../images/search.png" border="0"></a></span>&nbsp;&nbsp;<a class="fancybox reqbox  fancybox.iframe" href="reqItem.php?id=<?= $Line ?>&oid=<?= $arryBomItem[$Count]['id'] ?>" id="req_link<?= $Line ?>" <?= $ReqDisplay ?>><img src="../images/tab-new.png" style="display:none;" border="0" title="Additional Items"></a>
		<!--by chetan 24Jan2017-->
		<input  style="<?php if($arryBomItem[$Count]['Primary'] ==1){ echo "padding:1px 5px 3px;background:#aaa;";}else{ echo "padding:1px 5px 3px;";  }?>" type="button" value="Primary" id="SubmitButton" class="button" name="itemPrimary<?= $Line ?>" id="itemPrimary<?= $Line ?>" >
		<input type="hidden" name="Primary<?= $Line ?>" id="Primary<?= $Line ?>" value="<?php if($arryBomItem[$Count]['Primary'] ==1){ echo "1";} ?>" readonly  /><!--End-->
            <input type="hidden" name="item_id<?= $Line ?>" id="item_id<?= $Line ?>" value="<?= stripslashes($arryBomItem[$Count]["item_id"]) ?>" readonly maxlength="20"  />

            <input type="hidden" name="id<?= $Line ?>" id="id<?= $Line ?>" value="<?php if ($_GET['edit']) echo $arryBomItem[$Count]["id"]; ?>" readonly maxlength="20"  />

            <input type="hidden" name="req_item<?= $Line ?>" id="req_item<?= $Line ?>" value="<?= stripslashes($arryBomItem[$Count]['req_item']) ?>" readonly />

            <input type="hidden" name="old_req_item<?= $Line ?>" id="old_req_item<?= $Line ?>" value="<?= stripslashes($arryBomItem[$Count]['req_item']) ?>" readonly />

            <input type="hidden" name="add_req_flag<?= $Line ?>" id="add_req_flag<?= $Line ?>" value="" readonly />
        </td>
        <!--<td> <input type="checkbox" name="Primary<?= $Line ?>" <?php if($arryBomItem[$Count]['Primary'] ==1){ echo "checked";} ?> id="Primary<?= $Line ?>" class="textbox" value="1"  /> </td>-->
        <td style="width: 40%"><input type="text" name="description<?= $Line ?>" id="description<?= $Line ?>" class="disabled" readonly style="width:300px;"  maxlength="100" onkeypress="return isAlphaKey(event);" value="<?= stripslashes($arryBomItem[$Count]["description"]) ?>"/></td>
        <td style="width: 15%"ss><input type="text" name="qty<?= $Line ?>" id="qty<?= $Line ?>" onkeypress="return isNumberKey(event);" class="textbox"  size="5"  value="<?= stripslashes($arryBomItem[$Count]["bom_qty"]) ?>"/>
        <td style="width: 20%"><?= ($Line > 1) ? ('<img src="../images/delete-161.png" id="ibtnDel">') : '' ?>

        <input type="hidden" name="orderby<?= $Line ?>" id="orderby<?= $Line ?>" class="textbox" maxlength="5" value="<?= stripslashes($arryBomItem[$Count]["orderby"]) ?>"/>






    <input type="hidden" align="right" name="amount<?= $Line ?>" id="amount<?= $Line ?>" class="disabled" readonly size="15" maxlength="10" onkeypress="return isDecimalKey(event);" style="text-align:right;" value="<?= stripslashes($arryBomItem[$Count]["total_bom_cost"]) ?>"/>
    <input type="hidden" name="price<?= $Line ?>" id="price<?= $Line ?>" class="textbox" size="15" maxlength="10" onkeypress="return isDecimalKey(event);" value="<?= stripslashes($arryBomItem[$Count]["unit_cost"]) ?>"/>

    </td>



    </tr>
    <?php
    //$TotalQty += $arryBomItem[$Count]["bom_qty"];
    $Total_bom_cost += $arryBomItem[$Count]["total_bom_cost"];
}
?>
</tbody>
<tfoot>

    <tr class="itembg">
        <td colspan="5" align="right">

            <a href="Javascript:void(0);"  id="addrow" class="add_row" style="float:left;">Add Row</a>
            <input type="hidden" name="numberLine" id="NumLine" value="<?= $NumLine ?>" readonly maxlength="20"  />
            <input type="hidden" name="DelItem" id="DelItem" value="" class="inputbox" readonly />


            <?php
            $TotalQty = $TotalQty;

            $TotalValue = $arryBOM[0]['total_cost'];
            ?>


            <?php //Totals Cost :?> <input type="hidden" align="right" name="TotalValue" id="TotalValue" class="disabled" readonly value="<?= $TotalValue ?>" size="15" style="text-align:right;"/>
            <br><br>
        </td>
    </tr>
</tfoot>
</table>
<script language="JavaScript1.2" type="text/javascript">

    $(document).ready(function () {
        $(".reqbox").fancybox({
            'width': 500
        });

    });

</script>
<?php //echo '<script>SetInnerWidth();</script>'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#addItemBackup").click(function () {
            var TotQty = $("#qty1").val();
            $(this).attr("href", "editSerial.php?id=1&total=" + TotQty);
            $('.fancybox').fancybox();
        })

    });
</script>