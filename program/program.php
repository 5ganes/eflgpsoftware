<?php
    session_start();
    if(!isset($_SESSION['userId']))
    {
      header("Location: ../programlogin.php");
      exit();
    }
    include("../report/constants.php");
    if($_SESSION['userType']!=USERDISTRICT)
    {
      header("location:../reportcentral.php");
    }
    
    $showSaveForm = false;
    $showListing = false;

    if (isset($_GET['id']))
    {
      $groupResult = $program->getByTypeAndId($_GET['groupType'],$_GET['id']);
      $groupRow = $conn->fetchArray($groupResult);
      extract($groupRow);
      //$selectedGroupType = $groupRow['parentId'];
      $showSaveForm = true;
      $showListing = true;
    }
    if (isset($_GET['groupType']) and $_GET['groupType']!="select")
    {
      $selectedGroupType = $_GET['groupType'];
      $showSaveForm = true;
      $showListing = true;
    }
?>
<div class="master">
    <div class="prtitle">
        <?php 
            $addLink = "index.php?page=program";
            $formLink = "manage_program.php";
            if (isset($_GET['groupType']))
            {
                $addLink .= "&groupType=" . $_GET['groupType'];
              $formLink .= "?groupType=" . $_GET['groupType'];
            }
            if(isset($_GET['priceType']))
            {
                $addLink .= "&priceType=" . $_GET['priceType']; 
            }
        ?>
        <div>
            <a href="<?php echo $addLink ?>"><span style="float: right;padding: 0.1% 2.2%;border: 1px solid;font-size: 12px;;">Add New</span></a>
            <div style="clear: both;"></div>
        </div>
        <div style="font-size: 20px;">
            Manage Forms <?="/ ".$program->getNameById($_GET['groupType']);?>
            <?php if(isset($_GET['msg'])){ ?>
                <span style="float: right;color:red;font-size: 14px; margin-top: 1%;"><?php echo $_GET['msg'];?></span>
            <?php }?>
        </div>
    </div>
    <div>
        <form class="fiscal_from" method="post" action="program.php">  
            <table>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td><label class="description" for="element_8">Form Category :</label></td>
                    <td style="width: 210px;">
                        <select name="groupType" onChange="changeTypeProgram(this);" class="list1">
                            <?php $program -> getCategories($selectedGroupType); ?>
                        </select>
                    </td>
                </tr>
            </table>
        </form>
        <br>
        <?php
        if($showSaveForm)
        {?>
            <?php $prType=$program->getTypeById($selectedGroupType);?>
            <form class="fiscal_from" action="program/<?php echo $formLink; ?>" method="post" enctype="multipart/form-data" onSubmit="return validate(this,'<?=$prType['table_name'];?>');">
                <?php
                if (isset($_GET['id']))
                {?>
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <?php }?>
                <table>
                    <tr>
                        <td><label class="description" for="element_8">Fiscal Year </label></td>
                        <td>
                            <select name="fiscalYear" style="width:100px; padding:2px;">
                              <?php
                                for($year=2070;$year<=date("y")+2056;$year++)
                                { 
                                    $check=$year."/".($year+1);?>
                                    <option value="<? echo $check;?>" 
                                        <?php if($check==$fiscalYear){ echo 'selected="selected"';}?>>
                                        <?php echo $check;?>
                                    </option>    
                                <?php }?>
                            </select>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>         

                    <tr>
                        <td><strong>Date : </strong></td>
                        <td>
                            <input type="text" name="manualDate" value="<?php echo $manualDate; ?>" 
                            id="nepaliDate" class="nepali-calendar text" required />
                        </td>
                    </tr>
                    <input type="hidden" name="tableName" value="<?=$prType['table_name'];?>" />
                    <input type="hidden" name="userId" value="<?=$userGet['id'];?>" />
                    <tr><td>&nbsp;</td></tr>

                    <?php
                        $file="forms/".$prType['table_name'].".php"; //echo $file; die();
                        include($file);
                    ?>

                    <tr>
                        <td><strong>Publish : </strong></td>
                        <td>
                            <input type="radio" name="publish" value="Yes" checked="checked" /> Yes 
                            <input type="radio" name="publish" value="No" 
                            <? if($publish=="No"){ echo 'checked="checked"'; }?> /> No
                        </td>
                    </tr>
                    

                    <tr>
                        <td><strong>Weight : </strong></td>
                        <?php
                        if (!isset($weight))
                        {
                            $weight = $program -> getLastWeight($_GET['groupType'],$userGet['id']);
                            
                        } ?>
                        <td>
                            <input type="text" value="<?php echo $weight ?>" name="weight" class="number">
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                  
                    <tr>
                        <td colspan="2">
                          <input  class="submit_button" type="submit" name="save" value="Submit" />
                          <input  class="submit_button" type="reset" name="Reset" value="Reset" />
                        </td>
                    </tr>
                </table>
            </form>
        <?php }?>

        <?php
        if(isset($_GET['groupType']) and $_GET['groupType']!="select")
        {?>
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td bgcolor="#FFFFFF">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td valign="top">
                                <?php
                                    include("programlisting.php");
                                ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        <?php }?>
    </div>
</div>