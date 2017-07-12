<?
$row=$program->getTableDataByTypeAndId($_GET['typeId'],$_GET['programId']);
?>
<tr>
  <td class="bgborder">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td bgcolor="#FFFFFF">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="print">
            
            <tr>
            <td>
            <table class="report" width="100%" border="0" cellspacing="5" cellpadding="2">
              <tr>
                <td width="190"><span class="title">आर्थिक वर्ष</span> :</td>
                <td><?=$row['fiscalYear']?></td>
              </tr>
              <tr>
                <td><span class="title">जिल्ला</span> :</td>
                <td>
				  <? $uId=$row['userId']; 
				  $district=$conn->fetchArray(mysql_query("select district_name from district where id in (select district from usergroups where id='$uId')"));
			   	  echo $district['district_name']; ?>
              	</td>
              </tr>
              <tr>
                <td><span class="title">मिती</span> :</td>
                <td><?=$row['manualDate']?></td>
              </tr>
              
              <? include("report/programdata.php");?>
              
            </table>
            </td>
          </tr>
        </table>
        
        <table>
          <tr>
            <td>
               <a href="reports.php?type=show&typeId=<?=$_GET['typeId'];?>&programId=<?=$_GET['programId']?>#stop" onclick="printContent('print')">Print</a> 
               / <a href="csv.php?id=<?=$_GET['programId'];?>" target="_blank">Export to Excel</a>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  </td>
</tr>
<tr>
  <td height="10"></td>
</tr>