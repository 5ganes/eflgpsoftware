<?php
  session_start();
  if(!isset($_SESSION['userId']))
  {
    header("Location: programlogin.php");
    exit();
  }
  include("report/constants.php");
  // if($_SESSION['userType']!=USERDISTRICT)
  // {
  //  header("location:reportcentral.php");
  // }
  include('clientobjectsProgram.php'); 
  $sess=$_SESSION['userId']; $user=mysql_query("select * from usergroups where id='$sess'");
  $userGet=mysql_fetch_array($user);

  if(isset($_POST['btnChangePswdSubmit'])){
      $errMsg = "";
      $opsw = trim($_POST['old_psw']);
      $npsw = trim($_POST['new_psw']);
      $cnpsw = trim($_POST['conf_new_psw']);

      if(empty($opsw)){
          $errMsg .= "<li>Please, supply your old password</li>";
      }
      elseif(isset($_SESSION['userId'])){
          if(!$users -> validateFrontPassword($_SESSION['userId'],$opsw)){
              $errMsg .= "<li>Please, supply your valid old password</li>";
          }
      }
      if(empty($npsw)){
          $errMsg .= "<li>Please, supply your new password</li>";
      }
      if(empty($cnpsw)){
        $errMsg .= "<li>Please, confirm your new password</li>";
      }
      if($npsw != $cnpsw){
          $errMsg .= "<li>Please, supply matching confirm password</li>";
      }
      if(isset($_SESSION['userId'])){
          if(empty($errMsg)){
              $chPsw = $users -> updateFrontPassword($_SESSION['userId'],$npsw);
              if($chPsw){
                  header("Location: changepswduser.php?msg=Password updated successfully");
                  exit();
              }
          }
      }
  }

?>
<!DOCTYPE html>
<html>
<head>
  <title>
      EFLGP - <?php echo $title;?>
  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/view.js"></script>

    <!--for date picker-->
    <script type="text/javascript" src="datepicker/jquery.js"></script>
    <script type="text/javascript" src="datepicker/nepali.datepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="datepicker/nepali.datepicker.css" />
    <script>
      $(document).ready(function(){
        $('.nepali-calendar').nepaliDatePicker();
        $('.collectedDate').nepaliDatePicker();
      });
    </script>
    <!--end date picker-->
    
</head>
<body>
<div class="wrapper">
  <header class="header">
      <div class="header-top">
        <div class="logo">
          <img src="images/logo.png" width="120" height="">
        </div>
         <div class="col-md-8 center-text" style="line-height: 20px;margin-top: -1%;">          
              <h4>Government of Nepal</h4>
              <h5>Ministry of Federal Affairs and Local Development</h5>
              <h3>Environment Friendly Local Governance Program</h3>
          </div>
              <div class="col-md-2 flag" align="right">
          <img src="images/flagrr.gif" width="60">
        </div>
      </div>
    </header>