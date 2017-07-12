<style>
	.priceheading{width:107px; border:1px solid; font-size:13px}
	.pricedata{text-align:center; padding:2px; width:107px;}
</style>
<table class="report" width="100%" cellspacing="2" cellpadding="2" border="1" style="font-size:14px">
    <tr>
    	<th class="priceheading" style="width:145px">
            <table>
                <tr>
                    <th colspan="20" style="border:none;">जिल्लाको क्षेत्रफल ( हेक्टर )</th>
                </tr>
                <tr>
                    <th class="priceheading">जम्मा</th>
                    <th class="priceheading">खेति योग्य</th>
                    <th class="priceheading">सिंचित</th>
                    <th class="priceheading">असिंचित</th>
                    <th class="priceheading">बाँझो</th>
                    
                    <th class="priceheading">घाँसे</th>
                    <th class="priceheading">बनजंगल</th>
                    <th class="priceheading">अन्य</th>
                    
                </tr>
            </table>
        </th>
        <th class="priceheading" style="width:115px">
            <table>
                <tr>
                    <th colspan="20" style="border:none;">जम्मा</th>
                </tr>
                <tr>
                    <th class="priceheading">परिवार संख्या</th>
                    <th class="priceheading">जनसंख्या</th>
                </tr>
            </table>
        </th>
        <th class="priceheading" style="width:115px">
            <table>
                <tr>
                    <th colspan="20" style="border:none;">कृषक</th>
                </tr>
                <tr>
                    <th class="priceheading">परिवार संख्या</th>
                    <th class="priceheading">जनसंख्या</th>
                </tr>
            </table>
        </th>
        <th class="priceheading" style="width:115px">
            <table>
                <tr>
                    <th colspan="20" style="border:none;">कृषक</th>
                </tr>
                <tr>
                    <th class="priceheading">महिला संख्या</th>
                    <th class="priceheading">पुरुष संख्या</th>
                </tr>
            </table>
        </th>
        <th class="priceheading">सिचाई हुने समय</th>
    </tr>
    <? while($rec=$conn->fetchArray($record))
	{?>
        <tr>
        	<td style="" border="0">
                <table>
                    <tr>
                        <td class="pricedata"><?=$rec['totalAreaHector'];?></td>
                        <td class="pricedata"><?=$rec['agricultureAreaHector'];?></td>
                        <td class="pricedata"><?=$rec['irrigatedAreaHector'];?></td>
                        <td class="pricedata"><?=$rec['unirrigatedAreaHector'];?></td>
                        <td class="pricedata"><?=$rec['barrenAreaHector'];?></td>
                        
                        <td class="pricedata"><?=$rec['grassAreaHector'];?></td>
                        <td class="pricedata"><?=$rec['forestAreaHector'];?></td>
                        <td class="pricedata"><?=$rec['otherAreaHector'];?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="pricedata"><?=$rec['totalFamilyNumber'];?></td>
                        <td class="pricedata"><?=$rec['totalPopulation'];?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="pricedata"><?=$rec['farmerFamilyNumber'];?></td>
                        <td class="pricedata"><?=$rec['farmerPopulation'];?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="pricedata"><?=$rec['femaleNumber'];?></td>
                        <td class="pricedata"><?=$rec['maleNumber'];?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="pricedata"><? $itu=$program->getUnitById($rec['irrigationTimeUnit']); 
                        echo $itu['name'];?></td>
                    </tr>
                </table>
            </td>
        </tr>
   	<? }?>
</table>