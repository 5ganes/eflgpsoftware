<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
 header("Location: login.php");
 exit();
}
if(isset($_POST['id']))
	$id = $_POST['id'];
elseif(isset($_GET['id']))
	$id = $_GET['id'];
else
	$id = 0;
	
$weight = $groups -> getUnitLastWeight();

if($_GET['type'] == "edit")
{
	//echo "dfd"; 
	$idd=$_GET['id']; //echo $idd;
	$result = mysql_query("select * from unit where id='$idd'");
	$editRow=mysql_fetch_array($result);
	extract($editRow);
}
if($_POST['type'] == "Save")
{
	//$id=$_POST['id'];
	extract($_POST);
	//echo $id;
	$vall="";
	if(empty($name))
		$errMsg .= "<li>Please enter Unit Name</li>";

	if(empty($errMsg))
	{
		$pid = $groups -> saveUnit($id, $name, $category, $publish, $weight);
		if($id > 0)
			$pid = $id;
		if($id>0)
			header("Location: unit.php?type=edit&id=$id&msg=Unit details updated successfully");
		else
			header("Location: unit.php?msg=Unit details saved successfully");
		exit();
	}		
}

if($_GET['type'] == "tooglePublish")
{
	$id = $_GET['id'];
	$changeTo = $_GET['changeTo'];
	
	$sql = "UPDATE unit SET publish='$changeTo' WHERE id='$id'";
	$conn->exec($sql);
	header("location: unit.php?&msg=Unit Show/Hide status toogled successfully.");
}

if($_GET['type']=="del")
{
		$delid=$_GET['id'];
		mysql_query("delete from unit where id='$delid'");
		//header("Location : unit.php?&msg=product deleted successfully.");?>
    	<script> document.location='unit.php?&msg=Unit deleted successfully.' </script>    
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo ADMIN_TITLE; ?></title>
<link href="../css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FF0000
}
-->
</style>
<script type="text/javascript" src="../js/cms.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
<table width="<?php echo ADMIN_PAGE_WIDTH; ?>" border="0" align="center" cellpadding="0"
	cellspacing="5" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2"><?php include("header.php"); ?></td>
  </tr>
  <tr>
    <td width="<?php echo ADMIN_LEFT_WIDTH; ?>" valign="top"><?php include("leftnav.php"); ?></td>
    <td width="<?php echo ADMIN_BODY_WIDTH; ?>" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#fff"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading2">&nbsp; Manage Unit
                        <div style="float: right;">
                          <?
							$addNewLink = "unit.php";
						  ?>
                          <a href="<?= $addNewLink?>" class="headLink">Add New</a></div></td>
                    </tr>
                    <tr>
                      <td>
                      <form action="<?= $_REQUEST['uri']?>" method="post" enctype="multipart/form-data">
                      <table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <?php if(!empty($errMsg)){ ?>
                          <tr align="left">
                            <td colspan="3" class="err_msg"><?php echo $errMsg; ?></td>
                          </tr>
                          <?php } ?>                          
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> Unit Name : <span class="asterisk">*</span></strong></td>
                              <td><label for="name"></label>
                                <input name="name" type="text" class="text" value="<?=$name?>" /></td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> Category : <span class="asterisk">*</span></strong></td>
                              <td><label for="category"></label>
                              	<select name="category" class="text">
                                	<option value="Output Indicator Unit">Output Indicator Unit</option>
                                </select>
                              </td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Publish :</strong></td>
                              <td>
                              	<label>
                                  <input name="publish" type="radio" id="featured_0" value="No" checked="checked" />
                                  No</label>
                                <label>
                                  <input type="radio" name="publish" value="Yes" id="featured_1" <? if($publish == 'Yes') echo 'checked="checked"';?> />
                                  Yes</label>
                              </td>
                            </tr>
                            
                            <tr><td></td></tr>
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> Weight : <span class="asterisk">*</span></strong></td>
                              <td><label for="title"></label>
                                <input name="weight" type="text" class="text" id="title" value="<?=$weight?>" /></td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td>
                              	<input name="type" type="submit" class="button" id="button" value="Save" />
                              	<?php if($_GET['type'] == "edit"){ ?>
                              	<input type="hidden" value="<?= $id?>" name="id" id="id" />
                                <?php }else{ ?>                                
                                <input name="reset" type="reset" class="button" id="button2" value="Clear" />
                                <?php } ?>
                                </td>
                            </tr> 
                            <tr><td>&nbsp;</td></tr>                       
                        </table>
                        </form></td>
                    </tr>
                  </table></td>
              </tr>
              <tr height="5"><td></td></tr>
        	<tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading2">&nbsp;Program Level Lists</td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">
                          <tr bgcolor="#F1F1F1" class="tahomabold11">
                            <td width="1">&nbsp;</td>
                           	<td style="width:25px">SN</td>
                            <td style="width:100px"> Unit Name </td>
                            <td style="width:150px">Category</td>
                            <td style="width:100px">Show</td>
                            <td style="width:100px">Weight</td>
                            <td style="width:150px"><strong>Action</strong></td>
                          </tr>
                          <?php
							$counter = 0;
							$pagename = "unit.php?";
							$sql = "SELECT * FROM unit";
							$sql .= " ORDER BY weight";
							//echo $sql;
							$limit = 50;
							include("paging.php"); $fuck=1;
							while($row = $conn -> fetchArray($result))
							{?>
                          		<tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top"><?= $fuck; $fuck++; ?></td>
                                 
                                    <td valign="top"><?=$row['name'];?></td>
                                    <td valign="top"><?=$row['category'];?></td>
                                 	<td valign="top">
										<?
									$changeTo = 'Yes';
									if ($row['publish'] == 'Yes')
										$changeTo = 'No';
									?>
                              		(<a href="unit.php?type=tooglePublish&id=<?= $row['id']?>&changeTo=<?=$changeTo;?>"><?=$row['publish'];?></a>)
                                  	</td>
                                    
                                    <td valign="top"><?=$row['weight'];?></td>
                            		<td valign="top"> [ <a href="unit.php?type=edit&id=<?= $row['id']?>">Edit</a> | <a href="#" onClick="javascript: if(confirm('This will permanently remove this Unit from database. Continue?')){ document.location='unit.php?type=del&id=<?php echo $row['id']; ?>'; }">Delete</a> ]</td>
                          </tr>
                          <?
													}
													?>
                        </table>
                      <?php include("paging_show.php"); ?></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>	
               
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php include("footer.php"); ?></td>
  </tr>
</table>
</body>
</html>