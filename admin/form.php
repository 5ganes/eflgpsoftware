<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
 header("Location: login.php");
 exit();
}	

if($_GET['type']=="del")
{
	$id=$_GET['id'];
	$program -> deleteForm($id);
	header("Location: form.php?msg=Form deleted successfully");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo ADMIN_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
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

                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                    <td class="heading2">&nbsp;Form File Details</td>

                    </tr>

                    <tr>

                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">

                          <tr bgcolor="#F1F1F1" class="tahomabold11">
                            <td width="1">&nbsp;</td>
                            <td><strong>SN</strong></td>
                            <td><strong>Report</strong></td>
                            <td><strong>File Name</strong></td>
                            <td width="85"><strong>Sender</strong></td>
                            <td width="70"><strong>Date</strong></td>
                            <td width="120"><strong>Action</strong></td>
                          </tr>
													<?php
													$counter = 0;
													$pagename = "form.php?";
													$sql = "SELECT * FROM form ORDER BY id DESC, date Desc";
													$limit = 40;
													include("../includes/paging.php");
													while($row = $conn -> fetchArray($result))
													{
													?>
                          <tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                            <td valign="top">&nbsp;</td>
                            <td valign="top"><?= ++$counter; ?></td>
                            <td valign="top"><?= $row['name'] ?></td>
                            <td valign="top"><?= $row['form'];?></td>
                            <td valign="top">
                            	<? $district=$row['district']; $s=mysql_query("select * from usergroups where district='$district'"); 
								$sGet=mysql_fetch_array($s); echo $sGet['name']; ?>
                            </td>
                            <td valign="top"><?=$row['date'];?>	
                           	</td>
                           
                            <td valign="top">

														[<a href="../<?=CMS_FILES_DIR.$row['form']; ?>">Download</a>]
														[<a href="#" onClick="javascript: if(confirm('This will permanently delete report details from database. Continue?')){ document.location='form.php?type=del&id=<?php echo $row['id']; ?>'; }">Delete</a>]														</td>

                          </tr>

                          <?

													}

													?>

                        </table>

												<?php include("../includes/paging_show.php"); ?>

												</td>

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