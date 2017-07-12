<?php 
  if($_GET['page']) $title = $_GET['page']; else $title = 'Home';
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
          <?php
          if(isset($_GET['page'])){
              $page=$_GET['page'].".php";
              include("program/".$page);  
          }
          else{
            include("program/programhome.php");
          }
        ?>
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
