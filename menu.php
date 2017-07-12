<div class="">       
    <div class="navbar-header">
        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button><!--//nav-toggle-->
    </div>  
    <div class="navbar-collapse collapse" id="navbar-collapse">
      <ul class="nav navbar-nav">
          <li class="nav-item"><a href="index.php">Home</a></li>
          <li class="nav-item">
              <a href="#">Generate Report</a>
              <ul>
                  <?php $result = $program->getProgramTypes();
                  while ($row = $conn->fetchArray($result))
                  {?>
                      <li><a href=reports.php?type=show&typeId=<?php echo $row['id']; ?>""><?=$row['program_name'];?></a></li>
                  <?php }?>
              </ul>
          </li>
      </ul>
      <!--//nav-->
    </div><!--//navabr-collapse-->
</div><!--//container-->