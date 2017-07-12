<style>
	.priceheading{width:107px; border:1px solid; font-size:13px}
	.pricedata{text-align:center; padding:2px; width:107px;}
</style>
<table class="report" width="100%" cellspacing="2" cellpadding="2" border="1" style="font-size:14px">
    <tr>
        <th class="priceheading" style="width:5px">SN</th>
    	<th class="priceheading" style="width:180px">Uploaded Date</th>
        <th class="priceheading" style="width:240px">Output Indicator</th>
        <th class="priceheading" style="width:140px">Unit</th>
        <th class="priceheading" style="width:100px">Target(Rs)</th>
        <th class="priceheading" style="width:130px">Achievement(Rs)</th>
        <th class="priceheading" style="width:220px">Planned Total Budget(Rs)</th>
        <th class="priceheading" style="width:155px">EFLGP Expenditures(Rs)</th>
        <th class="priceheading" style="width:300px">Expenditures(LBs, UC and Others)(Rs)</th>
        <th class="priceheading" style="width:500px">Remarks</th>
    </tr>
    <?php $sn = 1;
    while($rec=$conn->fetchArray($record))
	{?>
        <tr>
            <td border="0" class="pricedata"><?=$sn++;?></td>
            <td border="0" class="pricedata"><?=$rec['manualDate'];?></td>
            <td border="0" class="pricedata"><?=$rec['outputIndicator'];?></td>
            <td border="0" class="pricedata"><? $unt=$program->getUnitById($rec['unit']); echo $unt['name'];?></td>
            <td border="0" class="pricedata"><?=$rec['target'];?></td>
            <td border="0" class="pricedata"><?=$rec['achievement'];?></td>
            <td border="0" class="pricedata"><?=$rec['plannedBudget'];?></td>
            <td border="0" class="pricedata"><?=$rec['eflgpExpenditure'];?></td>
            <td border="0" class="pricedata"><?=$rec['otherExpenditure'];?></td>
            <td border="0" class="pricedata"><?=$rec['remarks'];?></td>
        </tr>
    <? }?> 
</table>