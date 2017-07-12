<tr>
    <td><span class="title">वाली </span> :</td>
    <td>
        <div class="inputleft" style="width:57%">
            <div style="width:44%">वालीको नाम</div>
            <div style="width:180px"><?=$row['cropName'];?></div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><span class="title">क्षेत्रफल </span> :</td>
    <td>
        <div class="inputleft">
            <div>सिंचित</div>
            <div><?=$row['irrigatedArea'];?> Hector</div>
            <div style="clear:both"></div>
        </div>
        <div class="inputleft inputright">
            <div>असिंचित</div>
            <div><?=$row['unirrigatedArea'];?> Hector</div>
            <div style="clear:both"></div>
        </div>
		<div class="inputleft inputright">
            <div>जम्मा</div>
            <div><?=$row['totalArea'];?> Hector</div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><span class="title">उत्पादन </span> :</td>
    <td>
        <div class="inputleft">
            <div>सिंचित</div>
            <div><?=$row['irrigatedProduction'];?> Ton</div>
            <div style="clear:both"></div>
        </div>
        <div class="inputleft inputright">
            <div>असिंचित</div>
            <div><?=$row['unirrigatedProduction'];?> Ton</div>
            <div style="clear:both"></div>
        </div>
        <div class="inputleft inputright">
            <div>जम्मा</div>
            <div><?=$row['totalProduction'];?> Ton</div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><span class="title">कृषकतह मुल्य</span> :</td>
    <td>
        <div class="inputleft">
            <div>एकाई</div>
            <div>
				<? $unit=$program->getUnitById($row['farmerUnit']); echo $unit['name'];?>
           	</div>
            <div style="clear:both"></div>
        </div>
        <div class="inputleft inputright">
            <div>मुल्य</div>
            <div>Rs. <?=$row['farmerPrice'];?></div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><span class="title">बजार मुल्य</span> :</td>
    <td>
        <div class="inputleft">
            <div>एकाई</div>
            <div>
				<? $unit=$program->getUnitById($row['marketUnit']); echo $unit['name'];?>
           	</div>
            <div style="clear:both"></div>
        </div>
        <div class="inputleft inputright">
            <div>मुल्य</div>
            <div>Rs. <?=$row['marketPrice'];?></div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </td>
</tr>