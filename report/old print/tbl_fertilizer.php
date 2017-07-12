<tr>
    <td><span class="title">विक्रि केन्द्रको नाम</span> :</td>
    <td>
        <?=$row['sellingOffice'];?>
    </td>
</tr>
<tr>
    <td><span class="title">विक्रि केन्द्रको किसिम</span> :</td>
    <td>
        <? $unit=$program->getUnitById($row['sellingOfficeType']); echo $unit['name'];?>
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
    <td><span class="title">प्रोपाइटरको नाम</span> :</td>
    <td>
        <?=$row['proprietorName'];?>
    </td>
</tr>
<tr>
    <td><span class="title">सम्पर्क नं.</span> :</td>
    <td>
        <?=$row['contactNumber'];?>
    </td>
</tr>
<tr>
    <td><span class="title">दर्ता नं.</span> :</td>
    <td>
      	<?=$row['registrationNumber'];?>
    </td>
</tr>
<tr>
    <td><span class="title">दर्ता भएको वर्ष</span> :</td>
    <td>
      	<?=$row['registeredYear'];?>
    </td>
</tr>
<tr>
    <td><span class="title">विक्रि हुने बस्तु</span> :</td>
    <td>
      	<?=$row['sellingObject'];?>
    </td>
</tr>
<tr>
    <td><span class="title">कैफियत</span> :</td>
    <td>
      	<?=$row['remarks'];?>
    </td>
</tr>