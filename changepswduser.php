<?php
  $title = 'Change Password';
  require 'header.php'; ?>
  <nav class="main-nav" role="navigation">
      <?php require 'menu.php' ?>
  </nav>

  <section>
    <div class="container_div">
      <div class="side-bar">
          <?php require 'sidebar.php'; ?>
      </div><!--//side-navigation-bar-->

    <div class="main">
      <div class="main_container">
          <style type="text/css"></style>
          <div class="prtitle">
              <div style="font-size: 20px;">
                  Change Password
                  <?php if(isset($_GET['msg'])){ ?>
                      <span style="float: right;color:red;font-size: 14px; margin-top: 1%;"><?php echo $_GET['msg'];?></span>
                  <?php }?>
              </div>
          </div>
          <div class="change_form">
              <br>
              <form method="post" action="changepswduser.php">
                  <table>
                      <?php if(!empty($errMsg)){ ?> 
                          <tr align="left">
                            <td colspan="3" class="warning"><?php echo $errMsg; ?></td>
                          </tr>
                          <tr><td>&nbsp;</td></tr>
                      <?php } ?>
                      <tr>
                        <td><label>Enter Old Password:</label></td>
                        <td><input type="password" name="old_psw" required></td>
                      </tr>
                      <tr><td>&nbsp;</td></tr>

                      <tr>
                        <td><label> Enter New Password:</label></td>
                        <td><input type="password" name="new_psw" required></td>
                      </tr>
                      <tr><td>&nbsp;</td></tr>

                      <tr>
                        <td><label> Confirm New Password:</label></td>
                        <td><input type="password" name="conf_new_psw" required></td>
                      </tr>
                      <tr><td>&nbsp;</td></tr>

                      <tr>
                        <td><input type="submit" name="btnChangePswdSubmit" value="Change"></td>
                      </tr>
                  </table>
              </form>
          </div>
      </div>
    </div><!--//main-->
    <div style="clear:both"></div>

  </div> <!--//container_div    -->
    
  </section>

  <footer>
      <?php require 'footer.php' ?>
  </footer>
</div>
  

</body>
</html>
