<?php
    $title = 'Reports';
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
            <table width="100%" border="0" cellpadding="2" cellspacing="0" style="font-size:11px;">
                <tr>
                    <td class="heading2">
                        <span style="color:#fff">
                            &nbsp;Manage Form Reports 
                            <?
                            if(isset($_GET['typeId']) and !isset($_GET['programId']))
                            {
                                $prName=$program->getTypeById($_GET['typeId']);
                                echo "/ ".$prName['program_name'];
                            }
                            ?>
                        </span>
                    </td>
                </tr>
                
                <?
                if(isset($_GET['programId']))
                {
                    include("report/programprint.php");    
                }?>
                
                <?
                if(isset($_GET['typeId']))
                {
                    include("report/programlist.php");
                }
                else
                {
                    include("report/typelist.php");
                }?>
            </table>
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