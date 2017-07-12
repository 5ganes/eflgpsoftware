<ul class="menu">
    <li>
        <p>Admin Site</p>
          <ul>
            <li><a href="index.php">Home</a></li>
              <li><a href="changepswduser.php">Change Password</a></li>
              <li><a href="logoutUser.php">Logout</a></li>
          </ul>
    </li>
    <li>
      <p>Manage Forms</p>
        <ul>
            <?php
            $prgm=$program->getProgramTypes();
            while($prgmGet=$conn->fetchArray($prgm))
            {?>
                <li>
                    <a href="index.php?page=program&groupType=<?=$prgmGet['id'];?>">
                        <b><?=$prgmGet['program_name'];?></b>
                    </a>
                </li>
            <?php }?>  
        </ul>
    </li>
    <li>
      <p>Manage Reports</p>
        <ul>
            <li><a href="reports.php"><b>Generate Report</b></a></li>
            <li><a href="bargraph.php"><b>Generate Bar Graph</b></a></li>
        </ul>
    </li>
</ul>