<tr>
    <td><span class="title">वजारको नाम</span> :</td>
    <td>
        <?=$row['marketName'];?>
    </td>
</tr>
<tr>
    <td><span class="title">बजारको प्रकार</span> :</td>
    <td>
        <? $unit=$program->getUnitById($row['marketType']); echo $unit['name'];?>
    </td>
</tr>
<tr>
    <td><span class="title">बजार क्षेत्रफल</span> :</td>
    <td>
        <?=$row['marketArea'];?> Hector
    </td>
</tr>
<tr>
    <td><span class="title">संञ्चालन शुरु भएको बर्ष</span> :</td>
    <td>
        <?=$row['establishedYear'];?>
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
    <td><span class="title">बजार लाग्ने दिन(हप्तामा)</span> :</td>
    <td>
        <?=$row['marketDay'];?> दिन
    </td>
</tr>
<tr>
    <td><span class="title">बजार निमार्णमा सरकारी लगानी</span> :</td>
    <td>
      	Rs. <?=$row['governmentInvestment'];?>
    </td>
</tr>
<tr>
    <td><span class="title">बार्षिक कृषि उपजको कारोवार</span> :</td>
    <td>
      	<?=$row['agricultureProductTradeQuantity'];?> Metric Ton
    </td>
</tr>
<tr>
    <td><span class="title">बार्षिक कृषि उपजको कारोवार रकम</span> :</td>
    <td>
      	Rs. <?=$row['agricultureProductTradeAmount'];?>
    </td>
</tr>
<tr>
    <td><span class="title">सम्पर्क व्यक्ति/फोन नं</span> :</td>
    <td>
      	<?=$row['contactPerson'];?>
    </td>
</tr>