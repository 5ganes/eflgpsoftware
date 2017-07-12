<tr>
    <td><span class="title">महिना</span> :</td>
    <td>
        <? $unit=$program->getUnitById($row['month']); echo $unit['name'];?>
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
    <td><strong class="title">बाली स्थिती</strong> :</td>
    <td>
    	<div class="inputleft" style="width:38%">
            <div>बाली लगाउने कार्य भैरहेको(%)</div>
            <div>
                <?=$row['cropWork'];?>
            </div>
		</div>        
    	<div class="inputleft inputright" style="width:40%">
        	<div>बाली बढने अवस्था(%)</div>
            <div>
            	<?=$row['cropGrowth'];?>
            </div>
      		<div style="clear:both"></div>
       	</div>
        <div class="inputleft inputright" style="width:38%; margin-left:0">
        	<div style="width:72%">बालीको फूल लाग्ने अवस्था(%)</div>
            <div>
            	<?=$row['cropMaturity'];?>
            </div>
            <div style="clear:both"></div>
      	</div>
        
        <div class="inputleft inputright" style="width:40%">
        	<div>बाली कटानी भैरहेको(%)</div>
            <div>
            	<?=$row['cropHarvest'];?>
            </div>
            <div style="clear:both"></div>
      	</div>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><strong class="title">दैवि प्रकोपको असर</strong> :</td>
    <td>
    	<div class="inputleft" style="width:38%">
            <div>दैवि प्रकोपको किसिम</div>
            <div>
                <? $unit=$program->getUnitById($row['affectedUnit']); echo $unit['name'];?>
            </div>
		</div>        
    	<div class="inputleft inputright" style="width:40%">
        	<div>प्रभावित क्षेत्रफल(%)</div>
            <div>
            	<?=$row['affectedArea'];?>
            </div>
      		<div style="clear:both"></div>
       	</div>
        <div class="inputleft inputright" style="width:38%; margin-left:0">
        	<div style="width:72%">प्रभावित परिवार संख्या</div>
            <div>
            	<?=$row['affectFamilyNo'];?>
            </div>
            <div style="clear:both"></div>
      	</div>
        
        <div class="inputleft inputright" style="width:40%">
        	<div>उत्पादनमा क्षती(मे.टन)</div>
            <div>
            	<?=$row['productionLoss'];?>
            </div>
            <div style="clear:both"></div>
      	</div>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><span class="title">बर्षा स्थिती</span> :</td>
    <td>
        <? $unit=$program->getUnitById($row['rainCondition']); echo $unit['name'];?>
    </td>
</tr>
<tr>
    <td><span class="title">तापक्रम</span> :</td>
    <td>
        <? $unit=$program->getUnitById($row['temperature']); echo $unit['name'];?>
    </td>
</tr>
<tr>
    <td><span class="title">रासायनिक मलको आपुर्ति</span> :</td>
    <td>
        <? $unit=$program->getUnitById($row['fertilizerSupplied']); echo $unit['name'];?>
    </td>
</tr>
<tr>
    <td><span class="title">बाली लगाउन समाप्त भएको क्षेत्रफल</span> :</td>
    <td>
        <?=$row['farmingEndedArea'];?> Ton
    </td>
</tr>
<tr>
    <td><span class="title">फूलफुल्ने अवस्था भए आशातित र कटानी भई सकेको भए वास्तविक</span> :</td>
    <td>
        <?=$row['cutProduction'];?> Hector
    </td>
</tr>
<tr>
    <td><span class="title">गतबर्षको दाजोमा क्षेत्रफल</span> :</td>
    <td>
        <?=$row['lowHighArea'];?> Ton <? $unit=$program->getUnitById($row['lowHighAreaUnit']); echo $unit['name'];?>
    </td>
</tr>
<tr>
    <td><span class="title">कैफियत</span> :</td>
    <td>
        <?=$row['remarks'];?>
    </td>
</tr>
