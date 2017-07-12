<?
session_start();
if(!isset($_SESSION['userId']))
{
	header("Location: ../programlogin.php");
	exit();
}
include('../clientobjectsProgram.php');
$typeId=$_GET['typeId']; $programId=$_GET['programId'];
if(isset($typeId) and isset($programId))
{
	$rec=$conn->fetchArray($program->getTableDataByTypeAndId($typeId,$programId));
	$fiscalYear=$rec['fiscalYear'];
}
else if(isset($typeId) and !isset($programId))
{
	$fiscalYear=$_GET['fiscalYear'];
	
}

?>
<style>
	body{ margin:0; padding:0; font-size:13px;}
	.container{width:100%; padding:0; border:1px solid; margin:0 auto}
	.header{height:100px; border:1px solid; background:#CCC;}
	.main{border:1px solid; line-height:1.9em}
	.footer{height:100px; border:1px solid; background:#CCC;padding: 1%;}
	.sitename{ line-height:0.5em; margin-top:0%}
	.sitename h1, .sitename h2, .sitename h3, .sitename h4{ margin:11px}
	.sitename h1{font-size: 16px;}
	.sitename h2{font-size: 14px; font-weight:normal}
	.sitename h3{font-size: 13px; font-weight:normal}
	.sitename h4{font-size: 14px;}
	.print{color:red;padding:5px 10px; text-decoration:none; background:#000;}
	.print:hover{color:white}
	th{font-size:13px;}
	.sitename h2{font-size: 16px; font-weight: bold;}
	.sitename h1{font-weight: normal;}
	.sitename h2:last-child{font-size: 18px;}
</style>
<html>
<head>
	<? $title=$program->getTypeById($typeId);?>
	<title>Report - <?=$title['program_name'];?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--printing-->
	<script>
		function printContent(el){
			//document.getElementById(e1).style="font-size:15px";
			var restorepage = document.body.innerHTML;
			var printcontent = document.getElementById(el).innerHTML;
			document.body.innerHTML = printcontent;
			window.print();
			document.body.innerHTML = restorepage;
		}
	</script>
	<!--end printing-->
</head>
<body>
	<div class="container" id="container">
    	<div class="header">
        	<div class="sitename" style="float:left">
        		<h1>Government of Nepal</h1>
                <h2>Ministry of Federal Affairs and Local Development</h2>
                <h2>Environment Friendly Local Governance Program</h2>
          	</div>
            
            <div class="sitename" style="float:right; text-align:right">
        		<? $uId=$_SESSION['userId']; //echo $uId;
				  //$district=$conn->fetchArray(mysql_query("select district_name from district where id in (select district from usergroups where id='$uId')"));
			   	?>
                <h1><?=$title['program_name'];?></h1>
                <h4>Fiscal Year : <?=$fiscalYear;?></h4>
                <!-- <h4>Uploaded Date : <?php echo $rec['onDate']; ?></h4> -->
            </div>
            <div style="clear:both"></div>
     	</div>
        <div class="main">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
            	<tr>
            		<td>
                    	<?php
						if(isset($typeId) and isset($programId))
							$record=$program->getTableDataByTypeAndId($typeId,$programId);
						else if(isset($typeId) and !isset($programId)){
							$record=$program->getTableDataByTypeAndFiscalYearAndUserId($typeId,$fiscalYear,$_GET['userId']);
						}?>
                    	<?php include($title['table_name']."dp.php");?>
            		</td>
          		</tr>
        	</table>
        </div>
        <div class="footer">
        	<div class="sitename">
            	<h4 style="margin:5% 1% 0">Copyright @MRSMP. Powered By: Team Krishighar</h4>
            </div>
        </div>
    </div>
	<div style="font-size: 22px;font-weight: bold;margin: 10px auto;width: 100%;">
    	<a href="#container" class="print" onClick="printContent('container')">Print</a>
    </div>
</body>