<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/adminmall\view\good\ajax_spec_select.html";i:1514211964;}*/ ?>
<style type="text/css">
    td[rowspan]{
        vertical-align:middle !important;
    }
    .read{
        border: none;
    }
</style>

<table class="table table-bordered" id="goods_spec_table1">                                
    <?php if(is_array($specList) || $specList instanceof \think\Collection || $specList instanceof \think\Paginator): if( count($specList)==0 ) : echo "" ;else: foreach($specList as $k=>$vo): ?>
    <tr>
        <td><?php echo $vo['attr_name']; ?>:</td>
        <td>                            
            <?php if(is_array($vo['spec_item']) || $vo['spec_item'] instanceof \think\Collection || $vo['spec_item'] instanceof \think\Paginator): if( count($vo['spec_item'])==0 ) : echo "" ;else: foreach($vo['spec_item'] as $k2=>$vo2): ?>                           
                <button type="button" data-spec_id="<?php echo $vo['id']; ?>" data-item_id='<?php echo $vo2; ?>' class="btn 
                <?php if(isset($items_value) && in_array(trim($vo2),$items_value))                         
                    echo 'btn-success'; 
                 else 
                    echo 'btn-default'; ?>
                " >
                    <?php echo $vo2; ?>
                </button>                                                        
                &nbsp;&nbsp;&nbsp;            
            <?php endforeach; endif; else: echo "" ;endif; ?>         
        </td>
    </tr>                                    
    <?php endforeach; endif; else: echo "" ;endif; ?>    
</table>
<div id="goods_spec_table2"> <!--ajax 返回 规格对应的库存--> </div>

<script>
        
    
   // 按钮切换 class
   $("#ajax_spec_data button").click(function(){
	   if($(this).hasClass('btn-success'))
	   {
		   $(this).removeClass('btn-success');
		   $(this).addClass('btn-default');		   
	   }
	   else
	   {
		   $(this).removeClass('btn-default');
		   $(this).addClass('btn-success');		   
	   }
	   ajaxGetSpecInput();	  	   	 
});
	

/**
*  点击商品规格触发下面输入框显示
*/
function ajaxGetSpecInput()
{
//	  var spec_arr = {1:[1,2]};// 用户选择的规格数组 	  
//	  spec_arr[2] = [3,4]; 
	  var spec_arr = {};// 用户选择的规格数组
      var bool=false; 	  	  
	// 选中了哪些属性	  
	$("#goods_spec_table1  button").each(function(){
	    if($(this).hasClass('btn-success'))	
		{
			var spec_id = $(this).data('spec_id');
			var item_id = $(this).data('item_id');
			if(!spec_arr.hasOwnProperty(spec_id))
				spec_arr[spec_id] = [];
		    spec_arr[spec_id].push(item_id);
			// console.log(spec_arr);
            bool=true;
		}		
	});
        if(bool)
		    ajaxGetSpecInput2(spec_arr); // 显示下面的输入框
        else
            $("#goods_spec_table2").html('')
	
}
	
	
/**
* 根据用户选择的不同规格选项 
* 返回 不同的输入框选项
*/
function ajaxGetSpecInput2(spec_arr)
{		

    var good_id = $("input[name='good_id']").val();
	$.ajax({
			type:'POST',
			data:{'spec_arr':spec_arr},
			url:"/index.php/adminmall/Good/ajaxGetSpecInput/good_id/"+good_id,
			success:function(data){                            
				   $("#goods_spec_table2").html('');
				   $("#goods_spec_table2").append(data);
				   hbdyg();  // 合并单元格
                   $('.price').parent('td').removeAttr('rowspan').show();
                   $('.kucun').parent('td').removeAttr('rowspan').show();
			}
	});
}
	
 // 合并单元格
 function hbdyg() {
            var tab = document.getElementById("spec_input_tab"); //要合并的tableID
            var maxCol = 3, val, count, start;  //maxCol：合并单元格作用到多少列  
            if (tab != null) {
                for (var col = maxCol - 1; col >= 0; col--) {
                    count = 1;
                    val = "";
                    for (var i = 0; i < tab.rows.length; i++) {
                        if (val == tab.rows[i].cells[col].innerHTML) {
                            count++;
                        } else {
                            if (count > 1) { //合并
                                start = i - count;
                                tab.rows[start].cells[col].rowSpan = count;
                                for (var j = start + 1; j < i; j++) {
                                    tab.rows[j].cells[col].style.display = "none";
                                }
                                count = 1;
                            }
                            val = tab.rows[i].cells[col].innerHTML;
                        }
                    }
                    if (count > 1) { //合并，最后几行相同的情况下
                        start = i - count;
                        tab.rows[start].cells[col].rowSpan = count;
                        for (var j = start + 1; j < i; j++) {
                            tab.rows[j].cells[col].style.display = "none";
                        }
                    }
                }
            }
        }
</script> 