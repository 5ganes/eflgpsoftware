<?php
    $title = 'Bar Graph';
    require 'header.php'; 
?>
<style type="text/css">
    .bar{font-size: 14px;}
    .bar div{float: left; padding: 1%;font-weight: bold;width: 25%;}
    .generate{padding: 0.5% 2%;background: rgb(67, 109, 132);color: white;margin: 0.6% 0 0px 8%;}
    .generate:hover{background: rgb(67, 86, 125);}
</style>

<!-- dropdown multiple select css and javascript -->
    <link rel="stylesheet" type="text/css" href="dropdownmultipleselect/style.css">
    <script type="text/javascript" src="dropdownmultipleselect/script.js"></script>
<!-- dropdown multiple select css and javascript ends -->

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
                            &nbsp;Bar Graph 
                        </span>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>
                        <form method="post" action="bargraph.php" class="bar" id="myForm">
                            <div>
                                <span id="fiscalYear">Select Fiscal Years</span>
                                <div id="box" style="width:200px; padding:2px;">
                                    <ul style="margin: 0;padding: 0">
                                        <li id="checkall"> Check All </li>
                                        <?php
                                        for($year=2070;$year<=date("y")+2056;$year++){ 
                                            $check=$year."/".($year+1);?>
                                            <li><input type="checkbox" name="fiscalYear[]" value="<?php echo $check;?>"> &nbsp; <?php echo $check;?></li>
                                        <?php }?>
                                    </ul>
                                </div>

                                <!-- <select name="fiscalYear[]" style="width:200px; height: 200px; padding:2px;" multiple required>
                                    <?php
                                    for($year=2070;$year<=date("y")+2056;$year++){ 
                                        $check=$year."/".($year+1);?>
                                        <option value="<? echo $check;?>" 
                                            <?php if($check==$fiscalYear){ echo 'selected="selected"';}?>>
                                            <?php echo $check;?>
                                        </option>    
                                    <?php }?>
                                </select> -->
                            </div>
                            <div style="clear: both"></div>
                            <input class="generate" type="submit" name="report" value="Generate Report">
                        </form>
                    </td>
                </tr>
                <script src="chartjs/dist/Chart.bundle.js"></script>
                <script src="chartjs/samples/utils.js"></script>
                <style> canvas {-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;} </style>
                  <tr><td><canvas id="canvas"></canvas></td></tr>
                  <?php
                    if(isset($_POST['report'])){
                      // print_r($_POST['fiscalYear']); die();
                        $result=$program->getTableDataByFiscalYearAndUserId($_POST['fiscalYear'],$userGet['id']);
                        for($i=0;$i<count($result)/2;$i++){
                          $target[]=$result[$i.'t'];
                          $achievement[]=$result[$i.'a'];
                        }
                        // print_r($target); print_r($achievement); die();
                        $target[]=0; $achievement[]=0;
                        $target=json_encode($target);
                        $achievement=json_encode($achievement);
                        
                        ?>
                        <script type="text/javascript">
                            execute('<?php echo json_encode($_POST);?>','<?php echo $target;?>','<?php echo $achievement;?>');
                            function execute(post, target, achievement){
                                var json=JSON.parse(post);
                                // console.log(json);
                                var jsontarget=JSON.parse(target);
                                // console.log(jsontarget);
                                var jsonachievement=JSON.parse(achievement);
                                // console.log(jsonachievement);

                                var levels='';
                                levels=json["fiscalYear"];
                                var color = Chart.helpers.color;
                                var barChartData = {
                                    labels: levels,
                                    datasets: [{
                                        label: 'Target Total [ Rs ]',
                                        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                                        borderColor: window.chartColors.red,
                                        borderWidth: 1,
                                        data: jsontarget
                                    }, {
                                        label: 'Achievement Total [ Rs ]',
                                        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                                        borderColor: window.chartColors.blue,
                                        borderWidth: 1,
                                        data: jsonachievement
                                    }]

                                };
                                window.onload = function() {
                                    var title =' [ ';
                                    title+= 'Target '+' vs Achevement';
                                    title+=' ]';

                                    var ctx = document.getElementById("canvas").getContext("2d");
                                    window.myBar = new Chart(ctx, {
                                        type: 'bar',
                                        data: barChartData,
                                        options: {
                                            responsive: true,
                                            legend: {
                                                position: 'top',
                                            },
                                            title: {
                                                display: true,
                                                text: 'Report Bar Chart'+title
                                            }
                                        }
                                    });

                                };
                            }
                        </script>
                    <?php }
                  ?>
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