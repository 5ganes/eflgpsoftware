<tr>
    <td><label class="description" for="element_6">Output Indicator </label></td>
    <td>
        <input type="text" class="description" name="outputIndicator" value="<?php echo $outputIndicator; ?>">
    </td>
</tr>
<tr><td>&nbsp;</td></tr>

<tr>
    <td><label class="description" for="element_7">Unit </label></td>
    <td>
        <select name="unit" class="number" style="width:104px; height:20px;">
            <?php
            $unitt=$groups->getUnitByCategory("Output Indicator Unit");
            while($unitGet=$conn->fetchArray($unitt))
            {?>
                <option value="<?=$unitGet['id'];?>" <? if($unitGet['id']==$unit){ echo 'selected="selected"';}?>>
                    <?=$unitGet['name'];?>
                </option>  
            <?php }?>
        </select>
    </td>
</tr>
<tr><td>&nbsp;</td></tr>

<tr>
    <td><label class="description" for="element_2">Target </label></td>
    <td><input id="element_2" name="target" class="element text medium" type="text" maxlength="255" value="<?php echo $target; ?>"/> </td>
</tr>

<tr>
    <td><label class="description" for="element_3">Achievement  </label></td>
    <td><textarea id="element_3" name="achievement" class="element textarea medium"><?php echo $achievement; ?></textarea></td>
</tr>

<tr>
    <td><label class="description" for="element_4">Planned Total Budget </label></td>
    <td><input id="element_4" name="plannedBudget" class="element text medium" type="text" maxlength="255" value="<?php echo $plannedBudget; ?>"/> </td>
</tr>

<tr>
    <td><label class="description" for="element_5">EFLGP Expenditures </label></td>
    <td><input id="element_5" name="eflgpExpenditure" class="element text medium" type="text" maxlength="255" value="<?php echo $eflgpExpenditure?>"/> </td>
</tr>

<tr>
    <td><label class="description" for="element_5">Expenditures(LBs, UC and Others) </label></td>
    <td><input id="element_5" name="otherExpenditure" class="element text medium" type="text" maxlength="255" value="<?php echo $otherExpenditure?>"/> </td>
</tr>

<tr>
    <td><label class="description" for="element_3">Remarks  </label></td>
    <td><textarea id="element_3" name="remarks" class="element textarea medium"><?php echo $remarks; ?></textarea></td>
</tr>