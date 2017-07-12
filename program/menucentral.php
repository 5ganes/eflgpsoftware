<style>
	.menubar li ul{display:none; width:215px; margin:0; background:#007d00;}
	.menubar li:hover ul{background:#007d00;}
	.menubar li:hover ul li{border-right:none}
	.menubar li:hover ul li a:hover{background:#009f00}
	.menubar li ul li{margin:0; list-style: none;}
	.menubar li ul li:hover{ background:#009f00;}
	.menubar li ul li a{text-decoration:none; color:#fff; width:199px; border-bottom:2px solid #009f00; color:#fff}
	.menubar li ul:hover{display:block}
</style>
<ul class="menubar">
	<li><a href="reportcentral.php">Home</a></li>
    <li>
        <a href="reports.php">Reports</a>
        <ul>
        	<? $result = $program->getProgramTypes();
           	while ($row = $conn->fetchArray($result))
          	{?>
        		<li>
            		<a href="reportcentral.php?type=show&typeId=<?php echo $row['id']; ?>"><?=$row['program_name'];?></a>
            	</li>
        	<? }?>
        </ul>
    </li>
    <li>
        <a href="logoutUser.php">Logout</a>
    </li>
    <li style="border-right:none;"><a style="color:#ff4848; font-size:15px; height:1em;line-height:2.5em"><?=$userGet['name'];?></a></li>
</ul>