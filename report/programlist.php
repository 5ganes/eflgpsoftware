<style>
	.inputleft{ float:left; width:17%; margin-bottom:3px;}
</style>
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

  .main table td{width: 0px !important}

</style>

<tr>
	<td class="bgborder">
		<table width="100%" border="0" cellspacing="1" cellpadding="0">
			<tr>
		<td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			
			<tr>
			  <td>
			  
              <!-- reporting-->
         	  <table width="100%" cellspacing="0" cellpadding="2" border="0" style="font-size:11px;">
              	<tr>
               		<td>
                    	<table width="98%" cellspacing="6" cellpadding="2" border="0" style="margin:1%;font-size: 14px;">
                             <form method="post" action="" id="myForm" onsubmit="sumoSelect();">
                             
                                 <tr>
                                    <td><strong>आर्थिक वर्ष छान्नुहोस्: </strong></td>
                                    <td>
                                        <div class="inputleft" style="width:17%">
                                            <select name="fiscalYear" style="width:100px; padding:2px;">
                                                <?
                                                for($year=2050;$year<=date("y")+2056;$year++)
                                                { 	$check=$year."/".($year+1);?>
                                                    <option value="<? echo $check;?>"><? echo $check;?></option>		
                                                <? }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="inputleft" style="margin-left:3%">
                                            <input type="submit" name="search" class="number" value="Search Records" />
                                        </div>
                                        <div style="clear:both"></div>
                                    </td>
                                </tr>
                             
                            </form>                           
                   		</table>
                 	</td>
              	</tr>
       		  </table>
			  <!--end reporting-->
              
              </td>
			</tr>
		  </table></td>
	  </tr>
		</table>
	</td>
</tr>

<?
if(isset($_POST['search']))
{?>
<tr>
    <td class="heading2">
        <span style="color:#fff">
            &nbsp; 
            <?
                $prName=$program->getTypeById($_GET['typeId']);
                echo $prName['program_name']." List";
            ?>
        </span>
    </td>
</tr>
<tr>
	<td class="bgborder">
		<table width="100%" border="0" cellspacing="1" cellpadding="0">
			<tr>
		<td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			
			<tr>
			  <td>
			  <table width="100%"  border="0" cellpadding="4" cellspacing="0" style="font-size: 13px;line-height: 23px;">
				 
				  <tr bgcolor="#F1F1F1">
  					<td class="tahomabold11" style="width:100px">S.No</td>
  					<td class="tahomabold11" style="text-align:left">Fiscal Year</td>
  					<td class="tahomabold11" style="width:250px">Uploaded Date</td>
  					<td class="tahomabold11">Action</td>
  				</tr>
				  
				  <?php
				  $counter = 0;
				  // $district=$program->getDistrictByUserId($_SESSION['userId']);
				  // $district=$conn->fetchArray($district);
				  extract($_POST);
				  if($prName['table_name']=="tbl_crop" or $prName['table_name']=="tbl_cropcutting")
				  {
						//echo $cropName; die();
						$table=$program->getTableDataByTypeAndFiscalYearAndCropListAndUserId($_GET['typeId'],$fiscalYear,$cropName,$userGet['id']);  
				  }
				  else if($prName['table_name']=="tbl_monthlyreporting")
				  {
					 $table=$program->getTableDataByTypeAndFiscalYearAndCropListAndMonthAndUserId($_GET['typeId'],$fiscalYear,$cropName,$month,$userGet['id']);  
				  }
				  else if($prName['table_name']=="tbl_price")
				  {
				   $table=$program->getTableDataByTypeAndFiscalYearAndPriceTypeAndMonthAndUserId($_GET['typeId'],$fiscalYear,$priceType,$month,$userGet['id']);  
				  }
				  else if($prName['table_name']=="tbl_subsidi")
				  {
						$table=$program->getTableDataByTypeAndFiscalYearAndProgramNameAndUserId($_GET['typeId'],$fiscalYear,$programName,$userGet['id']);  
				  }
				  else
				  {
				  		$table=$program->getTableDataByTypeAndFiscalYearAndUserId($_GET['typeId'],$fiscalYear,$userGet['id']);
				  }
				  while ($row = $conn->fetchArray($table))
				  {
					$counter++;
					?>
					<tr <?php if ($counter % 2 == 0) { echo "bgcolor='#F7F7F7'";} ?>>
						<td valign="top" align="left"><?php echo $counter; ?></td>
						<td valign="top" align="left"><?=$row['fiscalYear'];?></td>
						<td valign="top" align="left"><? echo $row['manualDate'];?></td>
						<td valign="top" align="left">
						   <a href="report/districtprint.php?typeId=<?=$_GET['typeId']?>&programId=<?php echo $row['id'];?>&userId=<?=$userGet['id']?>" 
                           target="_blank">Print Single</a> 
						</td>
					</tr>
				  <? }?>
					
			  </table>
			  </td>
			</tr>
		  </table></td>
	  </tr>
		</table>
	</td>
</tr>

<? if($prName['table_name']!="tbl_price" and $prName['table_name']!="tbl_training" and $prName['table_name']!="tbl_subsidi" and 
$prName['table_name']!="tbl_cropprofit" and $prName['table_name']!="tbl_fruitprofit")
{?>
    <tr>
        <td>
            <table>
                <tr><td>&nbsp;</td></tr>
                
                <tr>
                	<?
					$link='report/districtprint.php?typeId='.$_GET['typeId'].'&userId='.$userGet['id'].'&fiscalYear='.$fiscalYear;
					$excel='excel.php?typeId='.$_GET['typeId'].'&userId='.$userGet['id'].'&fiscalYear='.$fiscalYear;
					if($prName['table_name']=="tbl_crop" or $prName['table_name']=="tbl_cropcutting")
					{
						$fInput='<input type="hidden" name="cropName" value="'.$cropName.'" />';
					}
					if($prName['table_name']=="tbl_monthlyreporting")
					{
						$fInput='<input type="hidden" name="cropName" value="'.$cropName.'" />';
						$fInput=$fInput.'<input type="hidden" name="month" value="'.$month.'" />';
					}
					if($prName['table_name']=="tbl_price")
					{
						$fInput='<input type="hidden" name="priceType" value="'.$priceType.'" />';
						$fInput=$fInput.'<input type="hidden" name="month" value="'.$month.'" />';
					}
					if($prName['table_name']=="tbl_subsidi")
					{
						$fInput='<input type="hidden" name="programName" value="'.$programName.'" />';
					}
					?>
                    <td>
                        <form action="<?=$link?>" method="post">
							<?=$fInput;?> 
                            <input class="printexcel" type="submit" name="print" value="Print All Records" formtarget="_blank" />
                       	</form>
                    </td>
                    <td>
                    	<form action="<?=$excel?>" method="post">
							<?=$fInput;?> 
                            <input class="printexcel" type="submit" name="print" value="Export to Excel" />
                       	</form>
                  	</td>
                </tr>
            </table>
        </td>
    </tr>
<? }?>

<? }?>