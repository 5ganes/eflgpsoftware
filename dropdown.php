<style>
	.inputleft{ float:left; width:17%; margin-bottom:3px;}
</style>
<script type="text/javascript" src="datepicker/jquery.js"></script>
<script src="sumoselect/jquery.sumoselect.js"></script>
<link href="sumoselect/sumoselect.css" rel="stylesheet" />
<script type="text/javascript">
	$(document).ready(function () {
		window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 1 });
		window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
		window.testSelAll = $('.testSelAll').SumoSelect({okCancelInMulti:true, selectAll:true });
		window.testSelAll2 = $('.testSelAll2').SumoSelect({selectAll:true });

		window.Search = $('.search-box').SumoSelect({ csvDispCount: 1, search: true, searchText:'Enter here.' });
		window.searchSelAll = $('.search-box-sel-all').SumoSelect({ csvDispCount: 1, selectAll:true, search: true, searchText:'Enter here.', 
		okCancelInMulti:true });
	});
</script>

<script>
	function sumoSelect()
	{
		var cropName = [];
		var month = [];
		var priceType = [];
		var programName = [];
		$('.crop').find('.selected').each(function(){
			cropName.push($(this).attr('data-val'));
		});
		$('.month').find('.selected').each(function(){
			month.push($(this).attr('data-val'));
		});
		$('.price').find('.selected').each(function(){
			priceType.push($(this).attr('data-val'));
		});
		$('.program').find('.selected').each(function(){
			programName.push($(this).attr('data-val'));
		});
		cropName=cropName.toString();
		month=month.toString();
		priceType=priceType.toString();
		programName=programName.toString();
		
		$('<input />').attr('type', 'hidden')
          .attr('name', "cropName")
          .attr('value', cropName)
          .appendTo('#myForm');
	    
		$('<input />').attr('type', 'hidden')
          .attr('name', "month")
          .attr('value', month)
          .appendTo('#myForm');
		
		$('<input />').attr('type', 'hidden')
          .attr('name', "priceType")
          .attr('value', priceType)
          .appendTo('#myForm');
		
		$('<input />').attr('type', 'hidden')
          .attr('name', "programName")
          .attr('value', programName)
          .appendTo('#myForm');
		
		//alert(month); return false;
		return true;
	}
</script>
<style>
	#program p{ width:188px;}
	.price p{ width:170px;}
	#month p{width:100px;}
	
	.printexcel{font-size:12px; margin-left:5px; color:red; cursor:pointer; font-weight:bold; padding:1px 12px; border:1px solid}
        .printexcel:hover{color:#000}
</style>


<form method="post" action="" id="myForm" onsubmit="sumoSelect();">
		<div class="inputleft crop" style="width:53%; height:24px;">
      	<select multiple="multiple" placeholder="Crops" class="testSelAll2" 
          onchange="console.log($(this).children(':selected').length)" required>
         			<option value="<?=$crpGet['name'];?>">one</option>
              <option value="<?=$crpGet['name'];?>">two</option>
              <option value="<?=$crpGet['name'];?>">three</option>
              <option value="<?=$crpGet['name'];?>">four</option>
              <option value="<?=$crpGet['name'];?>">five</option>
              <option value="<?=$crpGet['name'];?>">Six</option>
          </select>
      </div>
      <div class="inputleft" style="margin-left:3%">
          <input type="submit" name="search" class="number" value="Search Records" />
      </div>
      <div style="clear:both"></div>
</form>