<tr>
    <td><span class="title">समूह को नाम</span> :</td>
    <td>
        <?=$row['groupName'];?>
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
    <td><span class="title">समूहको गठन भएको वर्ष</span> :</td>
    <td>
        <? $unit=$program->getUnitById($row['establishedYear']); echo $unit['name'];?>
    </td>
</tr>
<tr>
    <td><span class="title">समूहको सदस्य संख्या</span> :</td>
    <td>
        <div class="inputleft">
            <div>महिला</div>
            <div><?=$row['femaleNumber'];?></div>
            <div style="clear:both"></div>
        </div>
        <div class="inputleft inputright">
            <div>पुरुष</div>
            <div><?=$row['maleNumber'];?></div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </td>
</tr>
<tr>
    <td><span class="title">दर्ता मिति</span> :</td>
    <td>
        <?=$row['registeredDay']."/".$row['registeredMonth']."/".$row['registeredYear'];?>
    </td>
</tr>
<tr>
    <td><span class="title">दर्ता नं.</span> :</td>
    <td>
      	<?=$row['registrationNumber'];?>
    </td>
</tr>
<tr>
    <td><span class="title">नियमित वैठक वस्ने दिन</span> :</td>
    <td>
      	<?=$row['meetingDay'];?>
    </td>
</tr>
<tr>
    <td><span class="title">कोष संकलन(प्रति महिना)</span> :</td>
    <td>
      	Rs. <?=$row['collectedFundPerMonth'];?>
    </td>
</tr>
<tr>
    <td><span class="title">हाल सम्मको जम्मा कोष</span> :</td>
    <td>
      	Rs. <?=$row['totalFund'];?>
    </td>
</tr>
<tr>
    <td><span class="title">कोष परिचालन(ऋण प्रवाह)</span> :</td>
    <td>
      	Rs. <?=$row['debtAmount'];?>
    </td>
</tr>
<tr>
    <td><span class="title">समूहको अवस्था</span> :</td>
    <td>
      	<? $unit=$program->getUnitById($row['groupStatus']); echo $unit['name'];?>
    </td>
</tr>
<tr>
    <td><span class="title">सम्पर्क व्यक्ति/फोन नं</span> :</td>
    <td>
      	<?=$row['contactPerson'];?>
    </td>
</tr>