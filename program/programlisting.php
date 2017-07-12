<script type="text/javascript">
  function confirmDelete(url){
    //alert(url); return false;
    if(confirm("Are you sure want to delete?")){
      $(location).attr("href", url);
    }
    else{
      return false;
    }
  }
</script>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  	<tr>
    	<td colspan="8" class="heading2">
			&nbsp;<?php
			if ($_GET['groupType']=="select")
			{
				echo "Program List";
			}
			else
			{
				$priceType="";
				if(isset($_GET['priceType'])){ $priceType=" / ".$_GET['priceType'];}
				echo "Showing Programs of " . $program->getNameById($_GET['groupType']).$priceType;
			}
			?>
       	</td>
  	</tr>
  	<tr bgcolor="#F1F1F1">
    	<td class="tahomabold11" style="width:10px">S.No</td>
        <td class="tahomabold11" style="width:120px">Fiscal Year</td>
   	 	  <td class="tahomabold11" style="width:140px">Date</td>
        <td class="tahomabold11" style="width:90px">Publish</td>
    	<td class="tahomabold11" style="width:90px">Weight</td>
    	<td class="tahomabold11" style="width:100px">Action</td>
  	</tr>
  	<?php
	   $counter = 0;
	   $result = $program->getTableDataByTypeAndUserId($selectedGroupType,$userGet['id']);
	while ($row = $conn->fetchArray($result))
	{
		$counter++;
		?>
  		<tr <?php if ($counter % 2 == 0) { echo "bgcolor='#F7F7F7'";} ?>>
            <td valign="top" align=""><?php echo $counter; ?></td>
            <td valign="top" align=""><?=$row['fiscalYear'];?></td>
				    <? $uId=$row['userId']; ?>
            <td valign="top" align=""><?=$row['manualDate'];?></td>
            <td valign="top" align=""><?=$row['publish'];?></td>
            <td valign="top" align=""><?php echo $row['weight']; ?></td>
            <td valign="top" align="">
            	<? if(isset($_GET['priceType']))
				      {
      				  $priceType="&priceType=".$_GET['priceType'];
              }?>
              <a href="index.php?page=program&groupType=<?=$_GET['groupType']?><?=$priceType?>&id=<?php echo $row['id']; ?>">Edit</a> /      			
      			   <a href="javascript:void(0)" onClick="confirmDelete('program/manage_program.php?groupType=<?php echo $_GET['groupType'];?><?=$priceType?>&id=<?php echo $row['id']; ?>&delete')">Delete</a>
        	</td>
  		</tr>
  		
	<?php }?>
</table>