<tr>
    <td><span class="title">स्रोत केन्द्र/नर्सरीको नाम</span> :</td>
    <td>
        <?=$row['shrotKendra'];?>
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
    <td><span class="title">दर्ता भएको/नभएको</span> :</td>
    <td>
        <div class="inputleft">
            <? $unit=$program->getUnitById($row['registration']); echo $unit['name'];?>
        </div>
        <? if($unit['name']=="Registered")
		{?>
        	<div class="inputleft inputright" style="width:37%">
            	<div>दर्ता मिती</div>
            	<div><?=$row['registeredDay'];?>/<?=$row['registeredMonth'];?>/<?=$row['registeredYear'];?></div>
            	<div style="clear:both"></div>
        	</div>
        <? }?>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><span class="title">स्रोत केन्द्रवाट प्रवाह हुने वस्तु तथा सेवा</span> :</td>
    <td>
        <?=$row['shrotKendraService'];?>
    </td>
</tr>
<tr>
    <td><span class="title">सम्पर्क व्यक्ति</span> :</td>
    <td>
        <?=$row['contactPerson'];?>
    </td>
</tr>
<tr>
    <td><span class="title">फोन नं.</span> :</td>
    <td>
        <?=$row['phoneNumber'];?>
    </td>
</tr>