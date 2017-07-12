<style>
	.number{border: 1px solid gray;color: #000000;font-family: Verdana,Arial,Helvetica,sans-serif;font-size: 11px;padding: 2px;width:78px;}
	.inputleft{ float:left; width:35%; margin-bottom:3px;}
	.inputright{width:25%;margin-left:5%}
	.inputleft div:first-child{ float:left; width:72%;}
	.inputleft div:nth-child(2){float:left;}
	.inputright div:first-child{ float:left; width:55%;}
	.fronttitle{font-size:11px; color:red;}
	.error{float:none; font-size:9px; color:red; text-align:center}
	.entry{border: 1px solid #00c400;color: #a60000;font-size: 13px;font-weight: bold;padding: 2px 15px; cursor:pointer}
	.entry:hover{ color:#000}
	.padding{padding:0 8px; padding-left:20px}
	.paddingwidth{ width:80px; margin:4px 7px}
	.remarks{width:140px; margin:4px 7px}
	.profitheading{ width:80px}
	.title{ font-weight:bold;}
	
</style>
<?
$sql=$program->getTypeById($_GET['typeId']); $table=$sql['table_name'];
include("report/".$table.".php");
?>