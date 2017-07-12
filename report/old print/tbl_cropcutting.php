<tr>
    <td><span class="title">सेवा केन्द्रको नाम</span> :</td>
    <td>
        <?=$row['sewaKendra'];?>
    </td>
</tr>
<tr>
    <td><span class="title">वाली </span> :</td>
    <td>
        <div class="inputleft" style="width:57%">
            <div style="width:44%">वालीको नाम</div>
            <div style="width:180px"><?=$row['cropName'];?></div>
            <div style="clear:both"></div>
        </div>
        <div class="inputleft inputright">
            <div>वालीको कोड</div>
            <div><?=$row['cropCode'];?></div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><span class="title">कृषकको नाम थर</span> :</td>
    <td>
        <?=$row['farmerName'];?>
    </td>
</tr>
<tr>
    <td><span class="title">ठेगाना</span> :</td>
    <td>
        <div class="inputleft">
            <div>गा.वि.स./न. पा.</div>
            <div><?=$row['addressVdcMunicipality'];?></div>
            <div style="clear:both"></div>
        </div>
        <div class="inputleft inputright">
            <div>वडा नं.</div>
            <div><?=$row['addressWardNumber'];?></div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><span class="title">जग्गाको किसिम</span> :</td>
    <td>
      	<? $unit=$program->getUnitById($row['landType']); echo $unit['name'];?>
    </td>
</tr>
<tr>
    <td><span class="title">वीउको किसिम</span> :</td>
    <td>
        <? $unit=$program->getUnitById($row['seedType']); echo $unit['name'];?>
    </td>
</tr>
<tr>
    <td><span class="title">वाली कटानी क्षेत्रफल(Hector)</span>:</td>
    <td>
        <div class="inputleft">
            <div>एकाई</div>
            <div><? $unit=$program->getUnitById($row['areaUnit']); echo $unit['name'];?></div>
            <div style="clear:both"></div>
        </div>
        <div class="inputleft inputright">
            <div>क्षेत्रफल</div>
            <div><?=$row['cropCuttingArea'];?></div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><span class="title">कैफियत</span> :</td>
    <td>
        <?=$row['remarks'];?>
    </td>
</tr>