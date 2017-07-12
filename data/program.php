<?php
class Program
{
    
    function getProgramTypes()
    {
        global $conn;
        $sql = "SElECT * FROM programtype order by weight";
        $result = $conn->exec($sql);
        return $result; 
    }
    function getProgramLevel()
    {
        global $conn;
        $sql = "SElECT * FROM programlevel order by weight";
        $result = $conn->exec($sql);
        return $result; 
    }
    
    function getTypeById($id)
    {
        global $conn;
        $id=cleanQuery($id);
        $sql = "SElECT * FROM programtype where id='$id'";
        $result = $conn->exec($sql);
        $type=$conn->fetchArray($result);
        return $type;
    }
    
    function getCategories($selected)
    {
        global $conn;
        //global $times;
        
        $sql = "SElECT * FROM programtype WHERE publish='Yes'";     
        $result = $conn->exec($sql);
        while($row = $conn -> fetchArray($result))
        {
            //$spaces = $this->spaces($times);
            echo '<option value="' . $row['id'] . '"';
            if($selected == $row['id'])
                echo 'selected="selected"';
            echo 'disabled="disabled"';
            echo '>' .$row['program_name'] . '</option>';
                        
        }
    }

    function getCategoriesEnabled()
    {
        global $conn;
        //global $times;
        
        $sql = "SElECT * FROM programtype WHERE publish='Yes' order by id";     
        $result = $conn->exec($sql);
        while($row = $conn -> fetchArray($result))
        {
            //$spaces = $this->spaces($times);
            echo '<option value="' . $row['table_name'] . '"';
            echo '>' .$row['program_name'] . '</option>';
                        
        }
    }
    
    function getByParentId($parentId)
    {
        global $conn;
        
        $parentId = cleanQuery($parentId);
        
        $sql = "SElECT id FROM programtype WHERE id = '$parentId'";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getLastWeight($programId,$userId)
    {
        global $conn;
        $table=$this->getTypeById(cleanQuery($programId));
        $table=$table['table_name'];
        $sql = "SElECT weight FROM $table where userId='$userId' ORDER BY weight DESC LIMIT 1";
        $result = $conn->exec($sql);
        $numRows = $conn -> numRows($result);
        if($numRows > 0)
        {
            $row = $conn->fetchArray($result);
            return $row['weight'] + 10;
        }
        else
            return 10;
    }

    function getLastWeightByTableAndUser($table,$userId)
    {
        global $conn;
        $sql = "SElECT weight FROM $table where userId='$userId' ORDER BY weight DESC LIMIT 1";
        $result = $conn->exec($sql);
        $numRows = $conn -> numRows($result);
        if($numRows > 0)
        {
            $row = $conn->fetchArray($result);
            return $row['weight'] + 10;
        }
        else
            return 10;
    }

    function saveOutputIndicator($id,$fiscalYear,$userId,$manualDate,$outputIndicator,$unit,$target,$achievement,$plannedBudget,$eflgpExpenditure,
        $otherExpenditure,$remarks,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $outputIndicator = cleanQuery($outputIndicator);
        $unit = cleanQuery($unit);
        $target = cleanQuery($target);
        $achievement = cleanQuery($achievement);
        $plannedBudget = cleanQuery($plannedBudget);
        $eflgpExpenditure = cleanQuery($eflgpExpenditure);
        $otherExpenditure = cleanQuery($otherExpenditure);
        $remarks = cleanQuery($remarks);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_outputindicator
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            outputIndicator = '$outputIndicator',
                            unit = '$unit',
                            target = '$target',
                            achievement = '$achievement',
                            plannedBudget = '$plannedBudget',
                            eflgpExpenditure = '$eflgpExpenditure',
                            otherExpenditure = '$otherExpenditure',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_outputindicator
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            outputIndicator = '$outputIndicator',
                            unit = '$unit',
                            target = '$target',
                            achievement = '$achievement',
                            plannedBudget = '$plannedBudget',
                            eflgpExpenditure = '$eflgpExpenditure',
                            otherExpenditure = '$otherExpenditure',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    function saveDistrictInformation($id,$fiscalYear,$userId,$manualDate,$areaUnit,$totalArea,$agricultureArea,$irrigatedArea,$unirrigatedArea,$barrenArea,$irrigationTimeUnit,
    $grassArea,$forestArea,$otherArea,$totalFamilyNumber,$totalPopulation,$femaleNumber,$maleNumber,$farmerFamilyNumber,$farmerPopulation,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $areaUnit = cleanQuery($areaUnit);
        $totalArea = cleanQuery($totalArea);
        $agricultureArea = cleanQuery($agricultureArea);
        $irrigatedArea = cleanQuery($irrigatedArea);
        $unirrigatedArea = cleanQuery($unirrigatedArea);
        $barrenArea = cleanQuery($barrenArea);
        $irrigationTimeUnit = cleanQuery($irrigationTimeUnit);
        $grassArea = cleanQuery($grassArea);
        $forestArea = cleanQuery($forestArea);
        $otherArea = cleanQuery($otherArea);
        
        //converting areas into hectare
        if($areaUnit==KATHTHA){
            $totalAreaHector=$totalArea/30;$agricultureAreaHector=$agricultureArea/30;$irrigatedAreaHector=$irrigatedArea/30;
            $unirrigatedAreaHector=$unirrigatedArea/30;$barrenAreaHector=$barrenArea/30;$grassAreaHector=$grassArea/30;
            $forestAreaHector=$forestArea/30;$otherAreaHector=$otherArea/30;
        }
        else if($areaUnit==ROPANI){
            $totalAreaHector=$totalArea/19.66;$agricultureAreaHector=$agricultureArea/19.66;$irrigatedAreaHector=$irrigatedArea/19.66;
            $unirrigatedAreaHector=$unirrigatedArea/19.66;$barrenAreaHector=$barrenArea/19.66;
            $grassAreaHector=$grassArea/19.66;$forestAreaHector=$forestArea/19.66;$otherAreaHector=$otherArea/19.66;
        }
        else if($areaUnit==BIGHAA){
            $totalAreaHector=$totalArea/1.48;$agricultureAreaHector=$agricultureArea/1.48;$irrigatedAreaHector=$irrigatedArea/1.48;
            $unirrigatedAreaHector=$unirrigatedArea/1.48;$barrenAreaHector=$barrenArea/1.48;
            $grassAreaHector=$grassArea/1.48;$forestAreaHector=$forestArea/1.48;$otherAreaHector=$otherArea/1.48;
        }
        else if($areaUnit==BARGAMITAR){
            $totalAreaHector=$totalArea/10000;$agricultureAreaHector=$agricultureArea/10000;$irrigatedAreaHector=$irrigatedArea/10000;
            $unirrigatedAreaHector=$unirrigatedArea/10000;$barrenAreaHector=$barrenArea/10000;
            $grassAreaHector=$grassArea/10000;$forestAreaHector=$forestArea/10000;$otherAreaHector=$otherArea/10000;
        }
        else{
            $totalAreaHector=$totalArea;$agricultureAreaHector=$agricultureArea;$irrigatedAreaHector=$irrigatedArea;
            $unirrigatedAreaHector=$unirrigatedArea;$barrenAreaHector=$barrenArea;$grassAreaHector=$grassArea;
            $forestAreaHector=$forestArea;$otherAreaHector=$otherArea;  
        }
        
        $totalFamilyNumber = cleanQuery($totalFamilyNumber);
        $totalPopulation = cleanQuery($totalPopulation);
        $farmerFamilyNumber = cleanQuery($farmerFamilyNumber);
        $farmerPopulation = cleanQuery($farmerPopulation);
        $femaleNumber = cleanQuery($femaleNumber);
        $maleNumber = cleanQuery($maleNumber);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_districtinformation
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            areaUnit = '$areaUnit',
                            totalArea = '$totalArea',
                            totalAreaHector = '$totalAreaHector',
                            agricultureArea = '$agricultureArea',
                            agricultureAreaHector = '$agricultureAreaHector',
                            irrigatedArea = '$irrigatedArea',
                            irrigatedAreaHector = '$irrigatedAreaHector',
                            unirrigatedArea = '$unirrigatedArea',
                            unirrigatedAreaHector = '$unirrigatedAreaHector',
                            barrenArea = '$barrenArea',
                            barrenAreaHector = '$barrenAreaHector',
                            irrigationTimeUnit = '$irrigationTimeUnit',
                            grassArea = '$grassArea',
                            grassAreaHector = '$grassAreaHector',
                            forestArea = '$forestArea',
                            forestAreaHector = '$forestAreaHector',
                            otherArea = '$otherArea',
                            otherAreaHector = '$otherAreaHector',
                            totalFamilyNumber='$totalFamilyNumber',
                            totalPopulation = '$totalPopulation',
                            farmerFamilyNumber = '$farmerFamilyNumber',
                            farmerPopulation = '$farmerPopulation',
                            femaleNumber = '$femaleNumber',
                            maleNumber = '$maleNumber',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_districtinformation
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            areaUnit = '$areaUnit',
                            totalArea = '$totalArea',
                            totalAreaHector = '$totalAreaHector',
                            agricultureArea = '$agricultureArea',
                            agricultureAreaHector = '$agricultureAreaHector',
                            irrigatedArea = '$irrigatedArea',
                            irrigatedAreaHector = '$irrigatedAreaHector',
                            unirrigatedArea = '$unirrigatedArea',
                            unirrigatedAreaHector = '$unirrigatedAreaHector',
                            barrenArea = '$barrenArea',
                            barrenAreaHector = '$barrenAreaHector',
                            irrigationTimeUnit = '$irrigationTimeUnit',
                            grassArea = '$grassArea',
                            grassAreaHector = '$grassAreaHector',
                            forestArea = '$forestArea',
                            forestAreaHector = '$forestAreaHector',
                            otherArea = '$otherArea',
                            otherAreaHector = '$otherAreaHector',
                            totalFamilyNumber='$totalFamilyNumber',
                            totalPopulation = '$totalPopulation',
                            farmerFamilyNumber = '$farmerFamilyNumber',
                            farmerPopulation = '$farmerPopulation',
                            femaleNumber = '$femaleNumber',
                            maleNumber = '$maleNumber',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    function saveCrop($id,$fiscalYear,$userId,$manualDate,$cropName,$cropCode,$areaUnit,$totalArea,
        $productionUnit,$totalProduction,$farmerUnit,$farmerPrice,$marketUnit,$marketPrice,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $cropName = cleanQuery($cropName);
        $cropCode = cleanQuery($cropCode);
        $areaUnit = cleanQuery($areaUnit);
        //$irrigatedArea = cleanQuery($irrigatedArea);
        $totalArea = cleanQuery($totalArea);
        //converting areas into hectare
        if($areaUnit==KATHTHA){ $totalAreaHector=$totalArea/30; }
        else if($areaUnit==ROPANI){ $totalAreaHector=$totalArea/19.66; }
        else if($areaUnit==BIGHAA){ $totalAreaHector=$totalArea/1.48; }
        else if($areaUnit==BARGAMITAR){ $totalAreaHector=$totalArea/10000; }
        else{ $totalAreaHector=$totalArea; }
        
        $productionUnit = cleanQuery($productionUnit);
        //$irrigatedProduction = cleanQuery($irrigatedProduction);
        $totalProduction = cleanQuery($totalProduction);
        //converting production into ton
        if($productionUnit==KUNTAL){ $totalProductionTon=$totalProduction/10; }
        else if($productionUnit==KG){ $totalProductionTon=$totalProduction/1000; }
        else{ $totalProductionTon=$totalProduction; }
        
        $farmerUnit = cleanQuery($farmerUnit);
        $farmerPrice = cleanQuery($farmerPrice);
        if($farmerUnit==KUNTAL){ $farmerPriceTon=$farmerPrice/10; }
        else if($farmerUnit==KG){ $farmerPriceTon=$farmerPrice/1000; }
        else{ $farmerPriceTon=$farmerPrice; }
        
        $marketUnit = cleanQuery($marketUnit);
        $marketPrice = cleanQuery($marketPrice);
        if($marketUnit==KUNTAL){ $marketPriceTon=$marketPrice/10; }
        else if($marketUnit==KG){ $marketPriceTon=$marketPrice/1000; }
        else{ $marketPriceTon=$marketPrice; }
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_crop
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            cropName = '$cropName',
                            cropCode = '$cropCode',
                            areaUnit = '$areaUnit',
                            totalArea = '$totalArea',
                            totalAreaHector = '$totalAreaHector',
                            productionUnit = '$productionUnit',
                            totalProduction = '$totalProduction',
                            totalProductionTon = '$totalProductionTon',
                            farmerUnit = '$farmerUnit',
                            farmerPrice = '$farmerPrice',
                            farmerPriceTon = '$farmerPriceTon',
                            marketUnit = '$marketUnit',
                            marketPrice = '$marketPrice',
                            marketPriceTon = '$marketPriceTon',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_crop
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            cropName = '$cropName',
                            cropCode = '$cropCode',
                            areaUnit = '$areaUnit',
                            totalArea = '$totalArea',
                            totalAreaHector = '$totalAreaHector',
                            productionUnit = '$productionUnit',
                            totalProduction = '$totalProduction',
                            totalProductionTon = '$totalProductionTon',
                            farmerUnit = '$farmerUnit',
                            farmerPrice = '$farmerPrice',
                            farmerPriceTon = '$farmerPriceTon',
                            marketUnit = '$marketUnit',
                            marketPrice = '$marketPrice',
                            marketPriceTon = '$marketPriceTon',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    function savePocketArea($id,$fiscalYear,$userId,$manualDate,$pocketAreaName,$totalFamilyNumber,$totalPopulation,$farmerFamilyNumber,$farmerPopulation,
    $femaleNumber,$maleNumber,$firstCrop,$secondCrop,$thirdCrop,$fundamentalService,$areaUnit,$irrigatedArea,$unirrigatedArea,$productionUnit,$irrigatedProduction,
    $unirrigatedProduction,$farmerUnit,$farmerPrice,$marketUnit,$marketPrice,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $totalFamilyNumber = cleanQuery($totalFamilyNumber);
        $totalPopulation = cleanQuery($totalPopulation);
        $farmerFamilyNumber = cleanQuery($farmerFamilyNumber);
        $farmerPopulation = cleanQuery($farmerPopulation);
        $femaleNumber = cleanQuery($femaleNumber);
        $maleNumber = cleanQuery($maleNumber);
        $pocketAreaName = cleanQuery($pocketAreaName);
        $firstCrop = cleanQuery($firstCrop);
        $secondCrop = cleanQuery($secondCrop);
        $thirdCrop = cleanQuery($thirdCrop);
        $fundamentalService = cleanQuery($fundamentalService);
        $areaUnit = cleanQuery($areaUnit);
        $irrigatedArea = cleanQuery($irrigatedArea);
        $unirrigatedArea = cleanQuery($unirrigatedArea);
        //converting areas into hectare
        if($areaUnit==KATHTHA){ $irrigatedAreaHector=$irrigatedArea/30; $unirrigatedAreaHector=$unirrigatedArea/30; }
        else if($areaUnit==ROPANI){ $irrigatedAreaHector=$irrigatedArea/19.66; $unirrigatedAreaHector=$unirrigatedArea/19.66; }
        else if($areaUnit==BIGHAA){ $irrigatedAreaHector=$irrigatedArea/1.48; $unirrigatedAreaHector=$unirrigatedArea/1.48; }
        else if($areaUnit==BARGAMITAR){ $irrigatedAreaHector=$irrigatedArea/10000; $unirrigatedAreaHector=$unirrigatedArea/10000; }
        else{ $irrigatedAreaHector=$irrigatedArea; $unirrigatedAreaHector=$unirrigatedArea; }
        
        $productionUnit = cleanQuery($productionUnit);
        $irrigatedProduction = cleanQuery($irrigatedProduction);
        $unirrigatedProduction = cleanQuery($unirrigatedProduction);
        //converting production into ton
        if($productionUnit==KUNTAL){ $irrigatedProductionTon=$irrigatedProduction/10; $unirrigatedProductionTon=$unirrigatedProduction/10; }
        else if($productionUnit==KG){ $irrigatedProductionTon=$irrigatedProduction/1000;$unirrigatedProductionTon=$unirrigatedProduction/1000; }
        else{ $irrigatedProductionTon=$irrigatedProduction;$unirrigatedProductionTon=$unirrigatedProduction; }
        
        $farmerUnit = cleanQuery($farmerUnit);
        $farmerPrice = cleanQuery($farmerPrice);
        if($farmerUnit==KUNTAL){ $farmerPriceTon=$farmerPrice/10; }
        else if($farmerUnit==KG){ $farmerPriceTon=$farmerPrice/1000; }
        else{ $farmerPriceTon=$farmerPrice; }
        
        $marketUnit = cleanQuery($marketUnit);
        $marketPrice = cleanQuery($marketPrice);
        if($marketUnit==KUNTAL){ $marketPriceTon=$marketPrice/10; }
        else if($marketUnit==KG){ $marketPriceTon=$marketPrice/1000; }
        else{ $marketPriceTon=$marketPrice; }
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_pocketarea
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            pocketAreaName = '$pocketAreaName',
                            totalFamilyNumber='$totalFamilyNumber',
                            totalPopulation = '$totalPopulation',
                            farmerFamilyNumber = '$farmerFamilyNumber',
                            farmerPopulation = '$farmerPopulation',
                            femaleNumber = '$femaleNumber',
                            maleNumber = '$maleNumber',
                            firstCrop = '$firstCrop',
                            secondCrop = '$secondCrop',
                            thirdCrop = '$thirdCrop',
                            fundamentalService = '$fundamentalService',
                            areaUnit = '$areaUnit',
                            irrigatedArea = '$irrigatedArea',
                            irrigatedAreaHector = '$irrigatedAreaHector',
                            unirrigatedArea = '$unirrigatedArea',
                            unirrigatedAreaHector = '$unirrigatedAreaHector',
                            productionUnit = '$productionUnit',
                            irrigatedProduction = '$irrigatedProduction',
                            irrigatedProductionTon = '$irrigatedProductionTon',
                            unirrigatedProduction = '$unirrigatedProduction',
                            unirrigatedProductionTon = '$unirrigatedProductionTon',
                            farmerUnit = '$farmerUnit',
                            farmerPrice = '$farmerPrice',
                            farmerPriceTon = '$farmerPriceTon',
                            marketUnit = '$marketUnit',
                            marketPrice = '$marketPrice',
                            marketPriceTon = '$marketPriceTon',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_pocketarea
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            pocketAreaName = '$pocketAreaName',
                            totalFamilyNumber='$totalFamilyNumber',
                            totalPopulation = '$totalPopulation',
                            farmerFamilyNumber = '$farmerFamilyNumber',
                            farmerPopulation = '$farmerPopulation',
                            femaleNumber = '$femaleNumber',
                            maleNumber = '$maleNumber',
                            firstCrop = '$firstCrop',
                            secondCrop = '$secondCrop',
                            thirdCrop = '$thirdCrop',
                            fundamentalService = '$fundamentalService',
                            areaUnit = '$areaUnit',
                            irrigatedArea = '$irrigatedArea',
                            irrigatedAreaHector = '$irrigatedAreaHector',
                            unirrigatedArea = '$unirrigatedArea',
                            unirrigatedAreaHector = '$unirrigatedAreaHector',
                            productionUnit = '$productionUnit',
                            irrigatedProduction = '$irrigatedProduction',
                            irrigatedProductionTon = '$irrigatedProductionTon',
                            unirrigatedProduction = '$unirrigatedProduction',
                            unirrigatedProductionTon = '$unirrigatedProductionTon',
                            farmerUnit = '$farmerUnit',
                            farmerPrice = '$farmerPrice',
                            farmerPriceTon = '$farmerPriceTon',
                            marketUnit = '$marketUnit',
                            marketPrice = '$marketPrice',
                            marketPriceTon = '$marketPriceTon',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
                $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    function saveNursery($id,$fiscalYear,$userId,$manualDate,$shrotKendra,$addressVdcMunicipality,$addressWardNumber,$registration,$registeredDay,
    $registeredMonth,$registeredYear,$shrotKendraService,$plantNumber,$fruitNumber,$contactPerson,$phoneNumber,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate); //echo $manualDate; die();
        $shrotKendra = cleanQuery($shrotKendra);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $registration = cleanQuery($registration);
        $registeredDay = cleanQuery($registeredDay);
        $registeredMonth = cleanQuery($registeredMonth);
        $registeredYear = cleanQuery($registeredYear);
        $shrotKendraService = implode(",", $shrotKendraService);
        //echo $shrotKendraService; die();

        $plantNumber = cleanQuery($plantNumber);
        $fruitNumber = cleanQuery($fruitNumber);
        $contactPerson = cleanQuery($contactPerson);
        $phoneNumber = cleanQuery($phoneNumber);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_nursery
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            shrotKendra='$shrotKendra',
                            addressVdcMunicipality='$addressVdcMunicipality',
                            addressWardNumber='$addressWardNumber',
                            registration = '$registration',
                            registeredDay = '$registeredDay',
                            registeredMonth = '$registeredMonth',
                            registeredYear = '$registeredYear',
                            shrotKendraService = '$shrotKendraService',
                            plantNumber = '$plantNumber',
                            fruitNumber = '$fruitNumber',
                            contactPerson = '$contactPerson',
                            phoneNumber = '$phoneNumber',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_nursery
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            shrotKendra='$shrotKendra',
                            addressVdcMunicipality='$addressVdcMunicipality',
                            addressWardNumber='$addressWardNumber',
                            registration = '$registration',
                            registeredDay = '$registeredDay',
                            registeredMonth = '$registeredMonth',
                            registeredYear = '$registeredYear',
                            shrotKendraService = '$shrotKendraService',
                            plantNumber = '$plantNumber',
                            fruitNumber = '$fruitNumber',
                            contactPerson = '$contactPerson',
                            phoneNumber = '$phoneNumber',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    function saveCropCutting($id,$fiscalYear,$userId,$manualDate,$cropName,$cropCode,$farmerName,$sewaKendra,$addressVdcMunicipality,
    $addressWardNumber,$landType,$seedType,$productionUnit,$cropCuttingProduction,$moisturePercent,$productivity,$remarks,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate); //echo $manualDate; die();
        $cropName = cleanQuery($cropName);
        $cropCode = cleanQuery($cropCode);
        $farmerName = cleanQuery($farmerName);
        $sewaKendra = cleanQuery($sewaKendra);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $landType = cleanQuery($landType);
        $seedType = cleanQuery($seedType);
        $productionUnit = cleanQuery($productionUnit);
        $cropCuttingProduction = cleanQuery($cropCuttingProduction);
        $moisturePercent= cleanQuery($moisturePercent);
        $productivity = cleanQuery($productivity);
        $remarks = cleanQuery($remarks);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_cropcutting
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            cropName = '$cropName',
                            cropCode = '$cropCode',
                            farmerName = '$farmerName',
                            sewaKendra = '$sewaKendra',
                            addressVdcMunicipality='$addressVdcMunicipality',
                            addressWardNumber='$addressWardNumber',
                            landType = '$landType',
                            seedType = '$seedType',
                            productionUnit = '$productionUnit',
                            cropCuttingProduction = '$cropCuttingProduction',
                            moisturePercent = '$moisturePercent',
                            productivity = '$productivity',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_cropcutting
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            cropName = '$cropName',
                            cropCode = '$cropCode',
                            farmerName = '$farmerName',
                            sewaKendra = '$sewaKendra',
                            addressVdcMunicipality='$addressVdcMunicipality',
                            addressWardNumber='$addressWardNumber',
                            landType = '$landType',
                            seedType = '$seedType',
                            productionUnit = '$productionUnit',
                            cropCuttingProduction = '$cropCuttingProduction',
                            moisturePercent = '$moisturePercent',
                            productivity = '$productivity',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    function saveMonthlyReporting($id,$fiscalYear,$userId,$manualDate,$month,$cropName,$cropCode,$cropWork,$cropGrowth,$cropMaturity,$cropHarvest,
    $affectedUnit,$affectedArea,$affectFamilyNo,$productionLoss,$rainCondition,$temperature,$fertilizerSupplied,$farmingEndedAreaUnit,$farmingEndedArea,
    $cutProductionUnit,$cutProduction,$lowHighAreaUnit,$lowHighArea,$lowHighProductionUnit,$lowHighProduction,$remarks,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $month = cleanQuery($month);
        $cropName = cleanQuery($cropName);
        $cropCode = cleanQuery($cropCode);
        $cropWork = cleanQuery($cropWork);
        $cropGrowth = cleanQuery($cropGrowth);
        $cropMaturity = cleanQuery($cropMaturity);
        $cropHarvest = cleanQuery($cropHarvest);
        $affectedUnit = cleanQuery($affectedUnit);
        $affectedArea = cleanQuery($affectedArea);
        $affectFamilyNo = cleanQuery($affectFamilyNo);
        $productionLoss = cleanQuery($productionLoss);
        $rainCondition = cleanQuery($rainCondition);
        $temperature = cleanQuery($temperature);
        $fertilizerSupplied = cleanQuery($fertilizerSupplied);
        
        $farmingEndedAreaUnit = cleanQuery($farmingEndedAreaUnit);
        $farmingEndedArea = cleanQuery($farmingEndedArea);
        //converting areas into hectare
        if($farmingEndedAreaUnit==KATHTHA){ $farmingEndedAreaHector=$farmingEndedArea/30; }
        else if($farmingEndedAreaUnit==ROPANI){ $farmingEndedAreaHector=$farmingEndedArea/19.66; }
        else if($farmingEndedAreaUnit==BIGHAA){ $farmingEndedAreaHector=$farmingEndedArea/1.48; }
        else if($farmingEndedAreaUnit==BARGAMITAR){ $farmingEndedAreaHector=$farmingEndedArea/10000; }
        else{ $farmingEndedAreaHector=$farmingEndedArea; }
        
        $cutProductionUnit = cleanQuery($cutProductionUnit);    
        $cutProduction = cleanQuery($cutProduction);
        //converting production into ton
        if($cutProductionUnit==KUNTAL){ $cutProductionTon=$cutProduction/10; }
        else if($cutProductionUnit==KG){ $cutProductionTon=$cutProduction/1000; }
        else{ $cutProductionTon=$cutProduction; }
        
        $lowHighAreaUnit = cleanQuery($lowHighAreaUnit);
        $lowHighArea = cleanQuery($lowHighArea);
        
        $lowHighProductionUnit = cleanQuery($lowHighProductionUnit);
        $lowHighProduction = cleanQuery($lowHighProduction);
        
        $remarks = cleanQuery($remarks);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_monthlyreporting
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            month='$month',
                            cropName = '$cropName',
                            cropCode = '$cropCode',
                            cropWork = '$cropWork',
                            cropGrowth = '$cropGrowth',
                            cropMaturity = '$cropMaturity',
                            cropHarvest = '$cropHarvest',
                            affectedUnit = '$affectedUnit',
                            affectedArea = '$affectedArea',
                            affectFamilyNo = '$affectFamilyNo',
                            productionLoss = '$productionLoss',
                            rainCondition = '$rainCondition',
                            temperature = '$temperature',
                            fertilizerSupplied = '$fertilizerSupplied',
                            farmingEndedAreaUnit = '$farmingEndedAreaUnit',
                            farmingEndedArea = '$farmingEndedArea',
                            farmingEndedAreaHector = '$farmingEndedAreaHector',
                            cutProductionUnit = '$cutProductionUnit',
                            cutProduction = '$cutProduction',
                            cutProductionTon = '$cutProductionTon',
                            lowHighAreaUnit = '$lowHighAreaUnit',
                            lowHighArea = '$lowHighArea',
                            lowHighProductionUnit = '$lowHighProductionUnit',
                            lowHighProduction = '$lowHighProduction',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_monthlyreporting
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            month='$month',
                            cropName = '$cropName',
                            cropCode = '$cropCode',
                            cropWork = '$cropWork',
                            cropGrowth = '$cropGrowth',
                            cropMaturity = '$cropMaturity',
                            cropHarvest = '$cropHarvest',
                            affectedUnit = '$affectedUnit',
                            affectedArea = '$affectedArea',
                            affectFamilyNo = '$affectFamilyNo',
                            productionLoss = '$productionLoss',
                            rainCondition = '$rainCondition',
                            temperature = '$temperature',
                            fertilizerSupplied = '$fertilizerSupplied',
                            farmingEndedAreaUnit = '$farmingEndedAreaUnit',
                            farmingEndedArea = '$farmingEndedArea',
                            farmingEndedAreaHector = '$farmingEndedAreaHector',
                            cutProductionUnit = '$cutProductionUnit',
                            cutProduction = '$cutProduction',
                            cutProductionTon = '$cutProductionTon',
                            lowHighAreaUnit = '$lowHighAreaUnit',
                            lowHighArea = '$lowHighArea',
                            lowHighProductionUnit = '$lowHighProductionUnit',
                            lowHighProduction = '$lowHighProduction',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    //for fertilizer
    function saveFertilizer($id,$fiscalYear,$userId,$manualDate,$sellingOffice,$sellingOfficeType,$addressVdcMunicipality,$addressWardNumber,$proprietorName,$contactNumber,
    $registrationNumber,$renewStatus,$registeredYear,$sellingObject,$sellAmountUnit,$sellAmount,$sellPriceUnit,$sellPrice,$remarks,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $sellingOffice = cleanQuery($sellingOffice);
        $sellingOfficeType = cleanQuery($sellingOfficeType);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $proprietorName = cleanQuery($proprietorName);
        $contactNumber = cleanQuery($contactNumber);
        $registrationNumber = cleanQuery($registrationNumber);
        $renewStatus = cleanQuery($renewStatus);
        $registeredYear = cleanQuery($registeredYear);
        $sellingObject = implode(",", $sellingObject);
        $remarks = cleanQuery($remarks);

        $sellAmountUnit = cleanQuery($sellAmountUnit);
        $sellAmount = cleanQuery($sellAmount);
        $sellPriceUnit = cleanQuery($sellPriceUnit);
        $sellPrice = cleanQuery($sellPrice);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_fertilizer
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            sellingOffice='$sellingOffice',
                            sellingOfficeType = '$sellingOfficeType',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            proprietorName = '$proprietorName',
                            contactNumber = '$contactNumber',
                            registrationNumber = '$registrationNumber',
                            renewStatus = '$renewStatus',
                            registeredYear = '$registeredYear',
                            sellingObject = '$sellingObject',
                            sellAmountUnit = '$sellAmountUnit',
                            sellAmount = '$sellAmount',
                            sellPriceUnit = '$sellPriceUnit',
                            sellPrice = '$sellPrice',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_fertilizer
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            sellingOffice='$sellingOffice',
                            sellingOfficeType = '$sellingOfficeType',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            proprietorName = '$proprietorName',
                            contactNumber = '$contactNumber',
                            registrationNumber = '$registrationNumber',
                            renewStatus = '$renewStatus',
                            registeredYear = '$registeredYear',
                            sellingObject = '$sellingObject',
                            sellAmountUnit = '$sellAmountUnit',
                            sellAmount = '$sellAmount',
                            sellPriceUnit = '$sellPriceUnit',
                            sellPrice = '$sellPrice',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    //for agrigroups
    function saveAgrigroups($id,$fiscalYear,$userId,$manualDate,$groupName,$addressVdcMunicipality,$addressWardNumber,$establishedYear,$femaleNumber,
    $maleNumber,$groupType,$subjectiveArea,$registeredDay,$registeredMonth,$registeredYear,$registrationNumber,$meetingDay,$collectedFundPerMonth,$totalFund,$debtAmount,$groupStatus,
    $contactPerson,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $groupName = cleanQuery($groupName);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $establishedYear = cleanQuery($establishedYear);
        $femaleNumber = cleanQuery($femaleNumber);
        $maleNumber = cleanQuery($maleNumber);
        $groupType = cleanQuery($groupType);
        $subjectiveArea = cleanQuery($subjectiveArea);
        $registeredDay = cleanQuery($registeredDay);
        $registeredMonth = cleanQuery($registeredMonth);
        $registeredYear = cleanQuery($registeredYear);
        $registrationNumber = cleanQuery($registrationNumber);
        $meetingDay = cleanQuery($meetingDay);
        $collectedFundPerMonth = cleanQuery($collectedFundPerMonth);
        $totalFund = cleanQuery($totalFund);
        $debtAmount = cleanQuery($debtAmount);
        $groupStatus = cleanQuery($groupStatus);
        $contactPerson = cleanQuery($contactPerson);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_agrigroups
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            groupName='$groupName',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            establishedYear = '$establishedYear',
                            femaleNumber = '$femaleNumber',
                            maleNumber = '$maleNumber',
                            groupType = '$groupType',
                            subjectiveArea = '$subjectiveArea',
                            registeredDay = '$registeredDay',
                            registeredMonth = '$registeredMonth',
                            registeredYear = '$registeredYear',
                            registrationNumber = '$registrationNumber',
                            meetingDay = '$meetingDay',
                            collectedFundPerMonth = '$collectedFundPerMonth',
                            totalFund = '$totalFund',
                            debtAmount = '$debtAmount',
                            groupStatus = '$groupStatus',
                            contactPerson = '$contactPerson',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_agrigroups
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            groupName='$groupName',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            establishedYear = '$establishedYear',
                            femaleNumber = '$femaleNumber',
                            maleNumber = '$maleNumber',
                            groupType = '$groupType',
                            subjectiveArea = '$subjectiveArea',
                            registeredDay = '$registeredDay',
                            registeredMonth = '$registeredMonth',
                            registeredYear = '$registeredYear',
                            registrationNumber = '$registrationNumber',
                            meetingDay = '$meetingDay',
                            collectedFundPerMonth = '$collectedFundPerMonth',
                            totalFund = '$totalFund',
                            debtAmount = '$debtAmount',
                            groupStatus = '$groupStatus',
                            contactPerson = '$contactPerson',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    //for agricoop
    function saveAgricoop($id,$fiscalYear,$userId,$manualDate,$cooperativeName,$addressVdcMunicipality,$addressWardNumber,$registeredDay,$registeredMonth,
    $registeredYear,$registrationNumber,$femaleNumber,$maleNumber,$workingField,$workingVdcMunicipality,$totalFund,$debtAmount,$contactPerson,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $cooperativeName = cleanQuery($cooperativeName);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $registeredDay = cleanQuery($registeredDay);
        $registeredMonth = cleanQuery($registeredMonth);
        $registeredYear = cleanQuery($registeredYear);
        $registrationNumber = cleanQuery($registrationNumber);
        $femaleNumber = cleanQuery($femaleNumber);
        $maleNumber = cleanQuery($maleNumber);
        $workingField = cleanQuery($workingField);
        $workingVdcMunicipality = cleanQuery($workingVdcMunicipality);
        $totalFund = cleanQuery($totalFund);
        $debtAmount = cleanQuery($debtAmount);
        $contactPerson = cleanQuery($contactPerson);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_agricoop
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            cooperativeName='$cooperativeName',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            registeredDay = '$registeredDay',
                            registeredMonth = '$registeredMonth',
                            registeredYear = '$registeredYear',
                            registrationNumber = '$registrationNumber',
                            femaleNumber = '$femaleNumber',
                            maleNumber = '$maleNumber',
                            workingField = '$workingField',
                            workingVdcMunicipality = '$workingVdcMunicipality',
                            totalFund = '$totalFund',
                            debtAmount = '$debtAmount',
                            contactPerson = '$contactPerson',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_agricoop
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            cooperativeName='$cooperativeName',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            registeredDay = '$registeredDay',
                            registeredMonth = '$registeredMonth',
                            registeredYear = '$registeredYear',
                            registrationNumber = '$registrationNumber',
                            femaleNumber = '$femaleNumber',
                            maleNumber = '$maleNumber',
                            workingField = '$workingField',
                            workingVdcMunicipality = '$workingVdcMunicipality',
                            totalFund = '$totalFund',
                            debtAmount = '$debtAmount',
                            contactPerson = '$contactPerson',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    //for market
    function saveMarket($id,$fiscalYear,$userId,$manualDate,$marketName,$marketType,$marketAreaUnit,$marketArea,$establishedYear,$addressVdcMunicipality,
    $addressWardNumber,$command_vdc_mun_number,$marketDay,$governmentInvestment,$agricultureProductTradeUnit,$agricultureProductTradeQuantity,$agricultureProductTradeAmount,
    $contactPerson,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $marketName = cleanQuery($marketName);
        $marketType = cleanQuery($marketType);
        $marketAreaUnit = cleanQuery($marketAreaUnit);
        $marketArea = cleanQuery($marketArea);
        //converting area into hector
        if($marketAreaUnit==KATHTHA){ $marketAreaHector=$marketArea/30; }
        else if($marketAreaUnit==ROPANI){ $marketAreaHector=$marketArea/19.66; }
        else if($marketAreaUnit==BIGHAA){ $marketAreaHector=$marketArea/1.48; }
        else if($marketAreaUnit==BARGAMITAR){ $marketAreaHector=$marketArea/10000; }
        else{ $marketAreaHector=$marketArea; }
        
        $establishedYear = cleanQuery($establishedYear);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $command_vdc_mun_number = cleanQuery($command_vdc_mun_number);
        $marketDay = cleanQuery($marketDay);
        $governmentInvestment = cleanQuery($governmentInvestment);
        $agricultureProductTradeUnit = cleanQuery($agricultureProductTradeUnit);
        $agricultureProductTradeQuantity = cleanQuery($agricultureProductTradeQuantity);
        //converting production into ton
        if($agricultureProductTradeUnit==KUNTAL){ $agricultureProductTradeQuantityTon=$agricultureProductTradeQuantity/10; }
        else if($agricultureProductTradeUnit==KG){ $agricultureProductTradeQuantityTon=$agricultureProductTradeQuantity/1000; }
        else{ $agricultureProductTradeQuantityTon=$agricultureProductTradeQuantity; }
        
        $agricultureProductTradeAmount = cleanQuery($agricultureProductTradeAmount);
        $contactPerson = cleanQuery($contactPerson);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_market
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            marketName = '$marketName',
                            marketType = '$marketType',
                            marketAreaUnit = '$marketAreaUnit',
                            marketArea = '$marketArea',
                            marketAreaHector = '$marketAreaHector',
                            establishedYear = '$establishedYear',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            command_vdc_mun_number = '$command_vdc_mun_number',
                            marketDay = '$marketDay',
                            governmentInvestment = '$governmentInvestment',
                            agricultureProductTradeUnit = '$agricultureProductTradeUnit',
                            agricultureProductTradeQuantity = '$agricultureProductTradeQuantity',
                            agricultureProductTradeQuantityTon = '$agricultureProductTradeQuantityTon',
                            agricultureProductTradeAmount = '$agricultureProductTradeAmount',
                            contactPerson = '$contactPerson',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_market
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            marketName = '$marketName',
                            marketType = '$marketType',
                            marketAreaUnit = '$marketAreaUnit',
                            marketArea = '$marketArea',
                            marketAreaHector = '$marketAreaHector',
                            establishedYear = '$establishedYear',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            command_vdc_mun_number = '$command_vdc_mun_number',
                            marketDay = '$marketDay',
                            governmentInvestment = '$governmentInvestment',
                            agricultureProductTradeUnit = '$agricultureProductTradeUnit',
                            agricultureProductTradeQuantity = '$agricultureProductTradeQuantity',
                            agricultureProductTradeQuantityTon = '$agricultureProductTradeQuantityTon',
                            agricultureProductTradeAmount = '$agricultureProductTradeAmount',
                            contactPerson = '$contactPerson',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    //for insuranceinfo
    function saveInsuranceInfo($id,$fiscalYear,$userId,$manualDate,$insuranceHolder,$insuranceCompany,$cropName,$cropCode,$cropAreaUnit,$cropArea,$insuranceAmount,$compensation,$totalFarmer,$remarks,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $insuranceHolder = cleanQuery($insuranceHolder);
        $insuranceCompany = cleanQuery($insuranceCompany);
        $cropName = cleanQuery($cropName);
        $cropCode = cleanQuery($cropCode);
        $cropAreaUnit = cleanQuery($cropAreaUnit);
        $cropArea = cleanQuery($cropArea);
        //converting area into hector
        if($cropAreaUnit==KATHTHA){ $cropAreaHector=$cropArea/30; }
        else if($cropAreaUnit==ROPANI){ $cropAreaHector=$cropArea/19.66; }
        else if($cropAreaUnit==BIGHAA){ $cropAreaHector=$cropArea/1.48; }
        else if($cropAreaUnit==BARGAMITAR){ $cropAreaHector=$cropArea/10000; }
        else{ $cropAreaHector=$cropArea; }
        
        $insuranceAmount = cleanQuery($insuranceAmount);
        $compensation = cleanQuery($compensation);
        $totalFarmer = cleanQuery($totalFarmer);
        $remarks = cleanQuery($remarks);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_insuranceinfo
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            insuranceHolder = '$insuranceHolder',
                            insuranceCompany = '$insuranceCompany',
                            cropName = '$cropName',
                            cropCode = '$cropCode',
                            cropAreaUnit = '$cropAreaUnit',
                            cropArea = '$cropArea',
                            cropAreaHector = '$cropAreaHector',
                            insuranceAmount = '$insuranceAmount',
                            compensation = '$compensation',
                            totalFarmer = '$totalFarmer',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_insuranceinfo
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            insuranceHolder = '$insuranceHolder',
                            insuranceCompany = '$insuranceCompany',
                            cropName = '$cropName',
                            cropCode = '$cropCode',
                            cropAreaUnit = '$cropAreaUnit',
                            cropArea = '$cropArea',
                            cropAreaHector = '$cropAreaHector',
                            insuranceAmount = '$insuranceAmount',
                            compensation = '$compensation',
                            totalFarmer = '$totalFarmer',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    //for farmer identification
    function saveFarmerIdentification($id,$fiscalYear,$userId,$manualDate,$farmerName,$addressVdcMunicipality,$addressWardNumber,$farmerAge,$mainCrop,$farmerCaste,$farmerIdType,
    $publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $farmerName = cleanQuery($farmerName);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $farmerAge = cleanQuery($farmerAge);
        $mainCrop = cleanQuery($mainCrop);
        $farmerCaste = cleanQuery($farmerCaste);
        $farmerIdType = cleanQuery($farmerIdType);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_farmeridentification
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            farmerName = '$farmerName',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            farmerAge = '$farmerAge',
                            mainCrop = '$mainCrop',
                            farmerCaste = '$farmerCaste',
                            farmerIdType = '$farmerIdType',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_farmeridentification
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            farmerName = '$farmerName',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            farmerAge = '$farmerAge',
                            mainCrop = '$mainCrop',
                            farmerCaste = '$farmerCaste',
                            farmerIdType = '$farmerIdType',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    //for fishery information
    function saveFisheryInformation($id,$fiscalYear,$userId,$manualDate,$farmerName,$addressVdcMunicipality,$addressWardNumber,$lakeType,$lakeNumber,$areaUnit,
    $lakeArea,$fishSpecies,$productionUnit,$production,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $farmerName = cleanQuery($farmerName);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $lakeType = cleanQuery($lakeType);
        $lakeNumber = cleanQuery($lakeNumber);
        $areaUnit = cleanQuery($areaUnit);
        $lakeArea = cleanQuery($lakeArea);
        //converting area into hector
        if($areaUnit==KATHTHA){ $lakeAreaHector=$lakeArea/30; }
        else if($areaUnit==ROPANI){ $lakeAreaHector=$lakeArea/19.66; }
        else if($areaUnit==BIGHAA){ $lakeAreaHector=$lakeArea/1.48; }
        else if($areaUnit==BARGAMITAR){ $lakeAreaHector=$lakeArea/10000; }
        else{ $lakeAreaHector=$lakeArea; }
        
        $fishSpecies = cleanQuery($fishSpecies);

        $productionUnit = cleanQuery($productionUnit);
        $production= cleanQuery($production);
        if($productionUnit==KUNTAL){ $productionTon=$production/10; }
        else if($productionUnit==KG){ $productionTon=$production/1000; }
        else{ $productionTon=$production;}                

         $publish = cleanQuery($publish);
         $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_fisheryinformation
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            farmerName = '$farmerName',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            lakeType = '$lakeType',
                            lakeNumber = '$lakeNumber',
                            areaUnit = '$areaUnit',
                            lakeArea = '$lakeArea',
                            fishSpecies ='$fishSpecies',
                            lakeAreaHector = '$lakeAreaHector',
                                                        productionUnit = '$productionUnit',
                            production = '$production',
                            productionTon = '$productionTon',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_fisheryinformation
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            farmerName = '$farmerName',
                            addressVdcMunicipality = '$addressVdcMunicipality',
                            addressWardNumber = '$addressWardNumber',
                            lakeType = '$lakeType',
                            lakeNumber = '$lakeNumber',
                            areaUnit = '$areaUnit',
                            lakeArea = '$lakeArea',
                            fishSpecies ='$fishSpecies',
                            lakeAreaHector = '$lakeAreaHector',
                                                        productionUnit = '$productionUnit',
                            production = '$production',
                            productionTon = '$productionTon',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    //for prices
    function savePrice($id,$fiscalYear,$userId,$manualDate,$month,$marketName,$collectedDate,$collector,$commodity,$rate1,$rate2,$rate3,$rate4,$rate5,
    $average,$remarks,$publish,$weight,$priceType)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $month = cleanQuery($month);
        $marketName = cleanQuery($marketName);
        $collectedDate = cleanQuery($collectedDate);
        $collector = cleanQuery($collector);
        $commodity = cleanQuery($commodity);
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        $priceType = cleanQuery($priceType); //echo print_r($average); die();
        
        if($id > 0)
        {
            $sql = "update tbl_price
                    SET
                        fiscalYear = '$fiscalYear',
                        userId = '$userId',
                        manualDate = '$manualDate',
                        month = '$month',
                        marketName = '$marketName',
                        collectedDate = '$collectedDate',
                        collector = '$collector',
                        commodity = '$commodity',
                        publish = '$publish',
                        weight = '$weight',
                        priceType = '$priceType'
                    WHERE
                        id='$id'"; //echo $sql; die();
        }
        else
        {
            //$r1=$rate1[$i];$r2=$rate2[$i];$r3=$rate3[$i];$r4=$rate4[$i];$r5=$rate5[$i];$avg=$average[$i];$rem=$remarks[$i];
            $sql = "INSERT INTO tbl_price
                    SET
                        fiscalYear = '$fiscalYear',
                        userId = '$userId',
                        manualDate = '$manualDate',
                        month = '$month',
                        marketName = '$marketName',
                        collectedDate = '$collectedDate',
                        collector = '$collector',
                        commodity = '$commodity',
                        publish = '$publish',
                        weight = '$weight',
                        priceType = '$priceType',
                        onDate = NOW()";
                        //echo $sql; die();
        }
        $conn->exec($sql);
        if($id > 0)
        {
            $this->saveRateList($rate1,$rate2,$rate3,$rate4,$rate5,$average,$remarks,$id,"edit");
            return $conn -> affRows();
        }
        $insertId=$conn->insertId();
        $this->saveRateList($rate1,$rate2,$rate3,$rate4,$rate5,$average,$remarks,$insertId,"add");
        return $insertId;
    }
    
    function saveRateList($rate1,$rate2,$rate3,$rate4,$rate5,$average,$remarks,$parentId,$action)
    {
        if($action=="add")
        {
            for($i=0;$i<count($average);$i++)
            {
                $r1=$rate1[$i];$r2=$rate2[$i];$r3=$rate3[$i];$r4=$rate4[$i];$r5=$rate5[$i];$avg=$average[$i];$rem=$remarks[$i];
                $sql="insert into ratelist set rate1='$r1', rate2='$r2', rate3='$r3', rate4='$r4', rate5='$r5', average='$avg', remarks='$rem', 
                parentId='$parentId'";
                //echo $sql;
                mysql_query($sql);
            }
        }
        else
        {
            for($i=0;$i<count($average);$i++)
            {
                $r1=$rate1[$i];$r2=$rate2[$i];$r3=$rate3[$i];$r4=$rate4[$i];$r5=$rate5[$i];$avg=$average[$i];$rem=$remarks[$i];
                $row=mysql_fetch_array(mysql_query("select id from ratelist where parentId='$parentId' order by id asc limit $i,1"));
                $editId=$row['id'];
                $sql="update ratelist set rate1='$r1', rate2='$r2', rate3='$r3', rate4='$r4', rate5='$r5', average='$avg', remarks='$rem' where 
                id='$editId'";
                //echo $sql;
                mysql_query($sql);
            }   
        }
    }
    
    //for training
    function saveTraining($id,$fiscalYear,$userId,$manualDate,$trainingDay,$trainingMonth,$trainingYear,$trainingName,$trainingLevel,$sewakendra,$participantNumber,
    $participantName,$participantAddress,$participantGender,$participantCast,$participantAge,$maleNumber,$femaleNumber,$lowcastNumber,$indigenousNumber,
    $otherNumber,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $trainingDay = cleanQuery($trainingDay);
        $trainingMonth = cleanQuery($trainingMonth);
        $trainingYear = cleanQuery($trainingYear);
        $trainingName = cleanQuery($trainingName);
        $trainingLevel = cleanQuery($trainingLevel);
        $sewakendra = cleanQuery($sewakendra);
        $participantNumber = cleanQuery($participantNumber);
        $maleNumber = cleanQuery($maleNumber);
        $femaleNumber = cleanQuery($femaleNumber);
        $lowcastNumber = cleanQuery($lowcastNumber);
        $indigenousNumber = cleanQuery($indigenousNumber);
        $otherNumber = cleanQuery($otherNumber);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0) 
        $sql = "UPDATE tbl_training
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            trainingDay = '$trainingDay',
                            trainingMonth = '$trainingMonth',
                            trainingYear = '$trainingYear',
                            trainingName = '$trainingName',
                            trainingLevel = '$trainingLevel',
                            sewakendra = '$sewakendra',
                            participantNumber = '$participantNumber',
                            maleNumber = '$maleNumber',
                            femaleNumber = '$femaleNumber',
                            lowcastNumber = '$lowcastNumber',
                            indigenousNumber = '$indigenousNumber',
                            otherNumber = '$otherNumber',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_training
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            trainingDay = '$trainingDay',
                            trainingMonth = '$trainingMonth',
                            trainingYear = '$trainingYear',
                            trainingName = '$trainingName',
                            trainingLevel = '$trainingLevel',
                            sewakendra = '$sewakendra',
                            participantNumber = '$participantNumber',
                            maleNumber = '$maleNumber',
                            femaleNumber = '$femaleNumber',
                            lowcastNumber = '$lowcastNumber',
                            indigenousNumber = '$indigenousNumber',
                            otherNumber = '$otherNumber',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
        {
            $this->saveTrainee($participantName,$participantAddress,$participantGender,$participantCast,$participantAge,$id,"edit");
            return $conn -> affRows();
        }
        $insertId=$conn->insertId();
        $this->saveTrainee($participantName,$participantAddress,$participantGender,$participantCast,$participantAge,$insertId,"add");
        return $insertId;
    }
    
    function saveTrainee($participantName,$participantAddress,$participantGender,$participantCast,$participantAge,$parentId,$action)
    {
        for($i=0;$i<count($participantName);$i++)
        {
            $pn=$participantName[$i];$pa=$participantAddress[$i];$pg=$participantGender[$i];$pc=$participantCast[$i];$pag=$participantAge[$i];
            if($action=="add")
            {
                $sql="insert into entrylist set participantName='$pn', participantAddress='$pa', participantGender='$pg', participantCast='$pc', 
                participantAge='$pag', parentId='$parentId'";
                //echo $sql;
                mysql_query($sql);
            }
            else
            {
                $row=mysql_query("select id from entrylist where parentId='$parentId' order by id asc limit $i,1");
                $count=mysql_num_rows($row);
                if($count>0)
                {
                    $row=mysql_fetch_array($row);
                    $editId=$row['id'];
                    $sql="update entrylist set participantName='$pn', participantAddress='$pa', participantGender='$pg', participantCast='$pc', 
                    participantAge='$pag' where id='$editId'";
                    //echo $sql;
                }
                else
                {
                    $sql="insert into entrylist set participantName='$pn', participantAddress='$pa', participantGender='$pg', participantCast='$pc', 
                    participantAge='$pag', parentId='$parentId'";   
                }
                mysql_query($sql);  
            }
        }
    }
    
    //for subsidi
    function saveSubsidi($id,$fiscalYear,$userId,$manualDate,$programDay,$programMonth,$programYear,$programName,$subsidiAmount,$donationType,$donationUnit,
    $donationNumber,$name,$cast,$gender,$age,$addressVdcMunicipality,$addressWardNumber,$object,$amount,$remarks,$publish,$weight)
    {
        global $conn;
        //print_r($cast); die();
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $programDay = cleanQuery($programDay);
        $programMonth = cleanQuery($programMonth);
        $programYear = cleanQuery($programYear);
        $programName = cleanQuery($programName);
        $subsidiAmount = cleanQuery($subsidiAmount);
        $donationType = cleanQuery($donationType);
        $donationUnit = cleanQuery($donationUnit);
        $donationNumber = cleanQuery($donationNumber);
        $remarks = cleanQuery($remarks);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE tbl_subsidi
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            programDay = '$programDay',
                            programMonth = '$programMonth',
                            programYear = '$programYear',
                            programName = '$programName',
                            subsidiAmount = '$subsidiAmount',
                            donationUnit = '$donationUnit',
                            donationType = '$donationType',
                            donationNumber = '$donationNumber',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight'
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO tbl_subsidi
                        SET
                            fiscalYear = '$fiscalYear',
                            userId = '$userId',
                            manualDate = '$manualDate',
                            programDay = '$programDay',
                            programMonth = '$programMonth',
                            programYear = '$programYear',
                            programName = '$programName',
                            subsidiAmount = '$subsidiAmount',
                            donationType = '$donationType',
                            donationUnit = '$donationUnit',
                            donationNumber = '$donationNumber',
                            remarks = '$remarks',
                            publish = '$publish',
                            weight = '$weight',
                            onDate = NOW()";
        
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
        {
            //echo $id; die();
            $this->saveDonation($name,$cast,$gender,$age,$addressVdcMunicipality,$addressWardNumber,$object,$amount,$id,"edit");
            return $conn -> affRows();
        }
        $insertId=$conn->insertId();
        $this->saveDonation($name,$cast,$gender,$age,$addressVdcMunicipality,$addressWardNumber,$object,$amount,$insertId,"add");
        return $insertId;
    }
    
    function saveDonation($name,$cast,$gender,$age,$addressVdcMunicipality,$addressWardNumber,$object,$amount,$parentId,$action)
    {
        //print_r($addressWardNumber); die();
        for($i=0;$i<count($name);$i++)
        {
            //echo "ll"; die();
            $n=$name[$i];$c=$cast[$i];$g=$gender[$i];$a=$age[$i];$av=$addressVdcMunicipality[$i];$aw=$addressWardNumber[$i];$o=$object[$i];$am=$amount[$i];
            if($action=="add")
            {
                $sql="insert into donationlist set name='$n', cast='$c', gender='$g', age='$a', addressVdcMunicipality='$av', addressWardNumber='$aw', 
                object='$o', amount='$am', parentId='$parentId'";
                //echo $sql;
                mysql_query($sql);
            }
            else
            {
                $row=mysql_query("select id from donationlist where parentId='$parentId' order by id asc limit $i,1");
                $count=mysql_num_rows($row);
                if($count>0)
                {
                    $row=mysql_fetch_array($row);
                    $editId=$row['id'];
                    $sql="update donationlist set name='$n', cast='$c', gender='$g', age='$a', addressVdcMunicipality='$av', addressWardNumber='$aw', 
                    object='$o', amount='$am' where id='$editId'";
                    //echo $sql; die();
                }
                else
                {
                    $sql="insert into donationlist set name='$n', cast='$c', gender='$g', age='$a', addressVdcMunicipality='$av', addressWardNumber='$aw', 
                    object='$o', amount='$am', parentId='$parentId'";   
                }
                mysql_query($sql);  
            }
        }
    }
    
    //for crop profit
    function saveCropProfit($id,$fiscalYear,$userId,$manualDate,$addressVdcMunicipality,$addressWardNumber,$pocketSector,$sewaKendra,
            $farmerName,$farmerAge,$farmerEducation,$otherOccupation,$groupName,$landAreaUnit,$totalArea,$agricultureArea,$familyNumber,$cropId,
            $cropVarietyId,$cropAreaUnit,$irrigationUnit,$cropArea,$constructionExpense,$collectorName,$collectorPost,$commodity,
            $commodityUnit,$amount,$rate,$investment,$remarks,$current_cost,$economic_cost,$total_cost,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $pocketSector = cleanQuery($pocketSector);
        $sewaKendra = cleanQuery($sewaKendra);
        $farmerName = cleanQuery($farmerName);
        
        $farmerAge = cleanQuery($farmerAge);
        $farmerEducation = cleanQuery($farmerEducation);
        $otherOccupation = cleanQuery($otherOccupation);
        $groupName = cleanQuery($groupName);
        
        $landAreaUnit = cleanQuery($landAreaUnit);
        $totalArea = cleanQuery($totalArea);
        $agricultureArea = cleanQuery($agricultureArea);
        //converting area into hector
        if($landAreaUnit==KATHTHA){ $totalAreaHector=$totalArea/30;$agricultureAreaHector=$agricultureArea/30; }
        else if($landAreaUnit==ROPANI){ $totalAreaHector=$totalArea/19.66;$agricultureAreaHector=$agricultureArea/19.66; }
        else if($landAreaUnit==BIGHAA){ $totalAreaHector=$totalArea/1.48;$agricultureAreaHector=$agricultureArea/1.48; }
        else if($landAreaUnit==BARGAMITAR){ $totalAreaHector=$totalArea/10000;$agricultureAreaHector=$agricultureArea/10000; }
        else{ $totalAreaHector=$totalArea;$agricultureAreaHector=$agricultureArea; }
        
        $familyNumber = cleanQuery($familyNumber);
        $cropId = cleanQuery($cropId);
        $cropVarietyId = cleanQuery($cropVarietyId);
        
        $cropAreaUnit = cleanQuery($cropAreaUnit);
        $irrigationUnit = cleanQuery($irrigationUnit);
        //converting area into hector
        if($cropAreaUnit==KATHTHA){ $cropAreaHector=$cropArea/30; }
        else if($cropAreaUnit==ROPANI){ $cropAreaHector=$cropArea/19.66; }
        else if($cropAreaUnit==BIGHAA){ $cropAreaHector=$cropArea/1.48; }
        else if($cropAreaUnit==BARGAMITAR){ $cropAreaHector=$cropArea/10000; }
        else{ $cropAreaHector=$cropArea; }
        
        $constructionExpense = cleanQuery($constructionExpense);
        $collectorName = cleanQuery($collectorName);
        $collectorPost = cleanQuery($collectorPost);

        $current_cost = cleanQuery($current_cost);
        $economic_cost = cleanQuery($economic_cost);
        $total_cost = cleanQuery($total_cost);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        $priceType = cleanQuery($priceType); //echo print_r($average); die();
        
        if($id > 0)
        {
            $sql = "update tbl_cropprofit
                    SET
                        fiscalYear = '$fiscalYear',
                        userId = '$userId',
                        manualDate = '$manualDate',
                        addressVdcMunicipality = '$addressVdcMunicipality',
                        addressWardNumber = '$addressWardNumber',
                        pocketSector = '$pocketSector',
                        sewaKendra = '$sewaKendra',
                        farmerName = '$farmerName',
                        farmerAge = '$farmerAge',
                        farmerEducation = '$farmerEducation',
                        otherOccupation = '$otherOccupation',
                        groupName = '$groupName',
                        landAreaUnit = '$landAreaUnit',
                        totalArea = '$totalArea',
                        totalAreaHector = '$totalAreaHector',
                        agricultureArea = '$agricultureArea',
                        agricultureAreaHector = '$agricultureAreaHector',
                        familyNumber = '$familyNumber',
                        cropId = '$cropId',
                        cropVarietyId = '$cropVarietyId',
                        cropAreaUnit = '$cropAreaUnit',
                        irrigationUnit = '$irrigationUnit',
                        cropArea = '$cropArea',
                        cropAreaHector = '$cropAreaHector',
                        constructionExpense = '$constructionExpense',
                        collectorName = '$collectorName',
                        collectorPost = '$collectorPost',
                        current_cost = '$current_cost',
                        economic_cost = '$economic_cost',
                        total_cost = '$total_cost',
                        publish = '$publish',
                        weight = '$weight'
                    WHERE
                        id='$id'"; //echo $sql; die();
        }
        else
        {
            //$r1=$rate1[$i];$r2=$rate2[$i];$r3=$rate3[$i];$r4=$rate4[$i];$r5=$rate5[$i];$avg=$average[$i];$rem=$remarks[$i];
            $sql = "INSERT INTO tbl_cropprofit
                    SET
                        fiscalYear = '$fiscalYear',
                        userId = '$userId',
                        manualDate = '$manualDate',
                        addressVdcMunicipality = '$addressVdcMunicipality',
                        addressWardNumber = '$addressWardNumber',
                        pocketSector = '$pocketSector',
                        sewaKendra = '$sewaKendra',
                        farmerName = '$farmerName',
                        farmerAge = '$farmerAge',
                        farmerEducation = '$farmerEducation',
                        otherOccupation = '$otherOccupation',
                        groupName = '$groupName',
                        landAreaUnit = '$landAreaUnit',
                        totalArea = '$totalArea',
                        totalAreaHector = '$totalAreaHector',
                        agricultureArea = '$agricultureArea',
                        agricultureAreaHector = '$agricultureAreaHector',
                        familyNumber = '$familyNumber',
                        cropId = '$cropId',
                        cropVarietyId = '$cropVarietyId',
                        cropAreaUnit = '$cropAreaUnit',
                        irrigationUnit = '$irrigationUnit',
                        cropArea = '$cropArea',
                        cropAreaHector = '$cropAreaHector',
                        constructionExpense = '$constructionExpense',
                        collectorName = '$collectorName',
                        collectorPost = '$collectorPost',
                        current_cost = '$current_cost',
                        economic_cost = '$economic_cost',
                        total_cost = '$total_cost',
                        publish = '$publish',
                        weight = '$weight',
                        onDate = NOW()";
                        //echo $sql; die();
        }
        $conn->exec($sql);
        if($id > 0)
        {
            $this->saveCommodities($commodity,$commodityUnit,$amount,$rate,$investment,$remarks,$id,"edit");
            return $conn -> affRows();
        }
        $insertId=$conn->insertId();
        $this->saveCommodities($commodity,$commodityUnit,$amount,$rate,$investment,$remarks,$insertId,"add");
        return $insertId;
    }
    
    function saveCommodities($commodity,$commodityUnit,$amount,$rate,$investment,$remarks,$parentId,$action)
    {
        if($action=="add")
        {
            for($i=0;$i<count($commodity);$i++)
            {
                $cmdt=$commodity[$i];$cmdtu=$commodityUnit[$i];$amt=$amount[$i];$rt=$rate[$i];$invst=$investment[$i];$rem=$remarks[$i];
                $sql="insert into commodities set commodity='$cmdt', commodityUnit='$cmdtu', amount='$amt', rate='$rt', investment='$invst', remarks='$rem', 
                parentId='$parentId'";
                //echo $sql;
                mysql_query($sql);
            }
        }
        else
        {
            for($i=0;$i<count($commodity);$i++)
            {
                $cmdt=$commodity[$i];$cmdtu=$commodityUnit[$i];$amt=$amount[$i];$rt=$rate[$i];$invst=$investment[$i];$rem=$remarks[$i];
                $row=mysql_fetch_array(mysql_query("select id from commodities where parentId='$parentId' order by id asc limit $i,1"));
                $editId=$row['id'];
                $sql="update commodities set commodity='$cmdt', commodityUnit='$cmdtu', amount='$amt', rate='$rt', investment='$invst', remarks='$rem' 
                where id='$editId'";
                //echo $sql;
                mysql_query($sql);
            }   
        }
    }
    
    //for fruit profit
    function saveFruitProfit($id,$fiscalYear,$userId,$manualDate,$addressVdcMunicipality,$addressWardNumber,$pocketSector,$sewaKendra,$farmerName,$farmerAge,$farmerEducation,$otherOccupation,$groupName,$landAreaUnit,$totalArea,$agricultureArea,$familyNumber,$cropId,$cropVarietyId,$cropAreaUnit,$irrigationUnit,$cropArea,$constructionExpense,$collectorName,$collectorPost,$fruitYear,$commodity,$commodityUnit,$amount,$rate,$investment,$remarks,$current_cost,$economic_cost,$total_cost,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $pocketSector = cleanQuery($pocketSector);
        $sewaKendra = cleanQuery($sewaKendra);
        $farmerName = cleanQuery($farmerName);
        
        $farmerAge = cleanQuery($farmerAge);
        $farmerEducation = cleanQuery($farmerEducation);
        $otherOccupation = cleanQuery($otherOccupation);
        $groupName = cleanQuery($groupName);
        
        $landAreaUnit = cleanQuery($landAreaUnit);
        $totalArea = cleanQuery($totalArea);
        $agricultureArea = cleanQuery($agricultureArea);
        //converting area into hector
        if($landAreaUnit==KATHTHA){ $totalAreaHector=$totalArea/30;$agricultureAreaHector=$agricultureArea/30; }
        else if($landAreaUnit==ROPANI){ $totalAreaHector=$totalArea/19.66;$agricultureAreaHector=$agricultureArea/19.66; }
        else if($landAreaUnit==BIGHAA){ $totalAreaHector=$totalArea/1.48;$agricultureAreaHector=$agricultureArea/1.48; }
        else if($landAreaUnit==BARGAMITAR){ $totalAreaHector=$totalArea/10000;$agricultureAreaHector=$agricultureArea/10000; }
        else{ $totalAreaHector=$totalArea;$agricultureAreaHector=$agricultureArea; }
        
        $familyNumber = cleanQuery($familyNumber);
        $cropId = cleanQuery($cropId);
        $cropVarietyId = cleanQuery($cropVarietyId);
        
        $cropAreaUnit = cleanQuery($cropAreaUnit);
        $irrigationUnit = cleanQuery($irrigationUnit);
        //converting area into hector
        if($cropAreaUnit==KATHTHA){ $cropAreaHector=$cropArea/30; }
        else if($cropAreaUnit==ROPANI){ $cropAreaHector=$cropArea/19.66; }
        else if($cropAreaUnit==BIGHAA){ $cropAreaHector=$cropArea/1.48; }
        else if($cropAreaUnit==BARGAMITAR){ $cropAreaHector=$cropArea/10000; }
        else{ $cropAreaHector=$cropArea; }
        
        $constructionExpense = cleanQuery($constructionExpense);
        $collectorName = cleanQuery($collectorName);
        $collectorPost = cleanQuery($collectorPost);

        $fruitYear = cleanQuery($fruitYear);

        $current_cost = cleanQuery($current_cost);
        $economic_cost = cleanQuery($economic_cost);
        $total_cost = cleanQuery($total_cost);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        $priceType = cleanQuery($priceType); //echo print_r($average); die();
        
        if($id > 0)
        {
            $sql = "update tbl_fruitprofit
                    SET
                        fiscalYear = '$fiscalYear',
                        userId = '$userId',
                        manualDate = '$manualDate',
                        addressVdcMunicipality = '$addressVdcMunicipality',
                        addressWardNumber = '$addressWardNumber',
                        pocketSector = '$pocketSector',
                        sewaKendra = '$sewaKendra',
                        farmerName = '$farmerName',
                        farmerAge = '$farmerAge',
                        farmerEducation = '$farmerEducation',
                        otherOccupation = '$otherOccupation',
                        groupName = '$groupName',
                        landAreaUnit = '$landAreaUnit',
                        totalArea = '$totalArea',
                        totalAreaHector = '$totalAreaHector',
                        agricultureArea = '$agricultureArea',
                        agricultureAreaHector = '$agricultureAreaHector',
                        familyNumber = '$familyNumber',
                        cropId = '$cropId',
                        cropVarietyId = '$cropVarietyId',
                        cropAreaUnit = '$cropAreaUnit',
                        irrigationUnit = '$irrigationUnit',
                        cropArea = '$cropArea',
                        cropAreaHector = '$cropAreaHector',
                        constructionExpense = '$constructionExpense',
                        collectorName = '$collectorName',
                        collectorPost = '$collectorPost',
                        fruitYear = '$fruitYear',
                        current_cost = '$current_cost',
                        economic_cost = '$economic_cost',
                        total_cost = '$total_cost',
                        publish = '$publish',
                        weight = '$weight'
                    WHERE
                        id='$id'"; //echo $sql; die();
        }
        else
        {
            //$r1=$rate1[$i];$r2=$rate2[$i];$r3=$rate3[$i];$r4=$rate4[$i];$r5=$rate5[$i];$avg=$average[$i];$rem=$remarks[$i];
            $sql = "INSERT INTO tbl_fruitprofit
                    SET
                        fiscalYear = '$fiscalYear',
                        userId = '$userId',
                        manualDate = '$manualDate',
                        addressVdcMunicipality = '$addressVdcMunicipality',
                        addressWardNumber = '$addressWardNumber',
                        pocketSector = '$pocketSector',
                        sewaKendra = '$sewaKendra',
                        farmerName = '$farmerName',
                        farmerAge = '$farmerAge',
                        farmerEducation = '$farmerEducation',
                        otherOccupation = '$otherOccupation',
                        groupName = '$groupName',
                        landAreaUnit = '$landAreaUnit',
                        totalArea = '$totalArea',
                        totalAreaHector = '$totalAreaHector',
                        agricultureArea = '$agricultureArea',
                        agricultureAreaHector = '$agricultureAreaHector',
                        familyNumber = '$familyNumber',
                        cropId = '$cropId',
                        cropVarietyId = '$cropVarietyId',
                        cropAreaUnit = '$cropAreaUnit',
                        irrigationUnit = '$irrigationUnit',
                        cropArea = '$cropArea',
                        cropAreaHector = '$cropAreaHector',
                        constructionExpense = '$constructionExpense',
                        collectorName = '$collectorName',
                        collectorPost = '$collectorPost',
                        fruitYear = '$fruitYear',
                        current_cost = '$current_cost',
                        economic_cost = '$economic_cost',
                        total_cost = '$total_cost',
                        publish = '$publish',
                        weight = '$weight',
                        onDate = NOW()";
                        //echo $sql; die();
        }
        $conn->exec($sql);
        if($id > 0)
        {
            $this->saveFruitCommodities($commodity,$commodityUnit,$amount,$rate,$investment,$remarks,$id,"edit");
            return $conn -> affRows();
        }
        $insertId=$conn->insertId();
        $this->saveFruitCommodities($commodity,$commodityUnit,$amount,$rate,$investment,$remarks,$insertId,"add");
        return $insertId;
    }
    
    function saveFruitCommodities($commodity,$commodityUnit,$amount,$rate,$investment,$remarks,$parentId,$action)
    {
        if($action=="add")
        {
            for($i=0;$i<count($commodity);$i++)
            {
                $cmdt=$commodity[$i];$cmdtu=$commodityUnit[$i];$amt=$amount[$i];$rt=$rate[$i];$invst=$investment[$i];$rem=$remarks[$i];
                $sql="insert into fruitcommodities set commodity='$cmdt', commodityUnit='$cmdtu', amount='$amt', rate='$rt', investment='$invst', 
                remarks='$rem', parentId='$parentId'";
                //echo $sql;
                mysql_query($sql);
            }
        }
        else
        {
            for($i=0;$i<count($commodity);$i++)
            {
                $cmdt=$commodity[$i];$cmdtu=$commodityUnit[$i];$amt=$amount[$i];$rt=$rate[$i];$invst=$investment[$i];$rem=$remarks[$i];
                $row=mysql_fetch_array(mysql_query("select id from fruitcommodities where parentId='$parentId' order by id asc limit $i,1"));
                $editId=$row['id'];
                $sql="update fruitcommodities set commodity='$cmdt', commodityUnit='$cmdtu', amount='$amt', rate='$rt', investment='$invst', remarks='$rem' 
                where id='$editId'";
                //echo $sql;
                mysql_query($sql);
            }   
        }
    }

    //for cost profit analysis
    function saveCostProfitAnalysis($id,$fiscalYear,$userId,$manualDate,$addressVdcMunicipality,$addressWardNumber,$pocketSector,$sewaKendra,
            $farmerName,$farmerAge,$farmerEducation,$otherOccupation,$groupName,$landAreaUnit,$totalArea,$agricultureArea,$familyNumber,$cropName,
            $cropSpecies,$cropAreaUnit,$cropIrrigatedArea,$cropUnirrigatedArea,$constructionExpense,$collectorName,$collectorPost,$commodity,
            $commodityUnit,$amount,$rate,$investment,$remarks,$current_cost,$economic_cost,$total_cost,$publish,$weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $fiscalYear = cleanQuery($fiscalYear);
        $userId = cleanQuery($userId);
        $manualDate = cleanQuery($manualDate);
        $addressVdcMunicipality = cleanQuery($addressVdcMunicipality);
        $addressWardNumber = cleanQuery($addressWardNumber);
        $pocketSector = cleanQuery($pocketSector);
        $sewaKendra = cleanQuery($sewaKendra);
        $farmerName = cleanQuery($farmerName);
        
        $farmerAge = cleanQuery($farmerAge);
        $farmerEducation = cleanQuery($farmerEducation);
        $otherOccupation = cleanQuery($otherOccupation);
        $groupName = cleanQuery($groupName);
        
        $landAreaUnit = cleanQuery($landAreaUnit);
        $totalArea = cleanQuery($totalArea);
        $agricultureArea = cleanQuery($agricultureArea);
        //converting area into hector
        if($landAreaUnit==KATHTHA){ $totalAreaHector=$totalArea/30;$agricultureAreaHector=$agricultureArea/30; }
        else if($landAreaUnit==ROPANI){ $totalAreaHector=$totalArea/19.66;$agricultureAreaHector=$agricultureArea/19.66; }
        else if($landAreaUnit==BIGHAA){ $totalAreaHector=$totalArea/1.48;$agricultureAreaHector=$agricultureArea/1.48; }
        else if($landAreaUnit==BARGAMITAR){ $totalAreaHector=$totalArea/10000;$agricultureAreaHector=$agricultureArea/10000; }
        else{ $totalAreaHector=$totalArea;$agricultureAreaHector=$agricultureArea; }
        
        $familyNumber = cleanQuery($familyNumber);
        $cropName = cleanQuery($cropName);
        $cropSpecies = cleanQuery($cropSpecies);
        
        $cropAreaUnit = cleanQuery($cropAreaUnit);
        $cropIrrigatedArea = cleanQuery($cropIrrigatedArea);
        $cropUnirrigatedArea = cleanQuery($cropUnirrigatedArea);
        //converting area into hector
        if($cropAreaUnit==KATHTHA){ $cropIrrigatedAreaHector=$cropIrrigatedArea/30;$cropUnirrigatedAreaHector=$cropUnirrigatedArea/30; }
        else if($cropAreaUnit==ROPANI){ $cropIrrigatedAreaHector=$cropIrrigatedArea/19.66;$cropUnirrigatedAreaHector=$cropUnirrigatedArea/19.66; }
        else if($cropAreaUnit==BIGHAA){ $cropIrrigatedAreaHector=$cropIrrigatedArea/1.48;$cropUnirrigatedAreaHector=$cropUnirrigatedArea/1.48; }
        else if($cropAreaUnit==BARGAMITAR){ $cropIrrigatedAreaHector=$cropIrrigatedArea/10000;$cropUnirrigatedAreaHector=$cropUnirrigatedArea/10000; }
        else{ $cropIrrigatedAreaHector=$cropIrrigatedArea;$cropUnirrigatedAreaHector=$cropUnirrigatedArea; }
        
        $constructionExpense = cleanQuery($constructionExpense);
        $collectorName = cleanQuery($collectorName);
        $collectorPost = cleanQuery($collectorPost);

        $current_cost = cleanQuery($current_cost);
        $economic_cost = cleanQuery($economic_cost);
        $total_cost = cleanQuery($total_cost);
        
        $publish = cleanQuery($publish);
        $weight = cleanQuery($weight);
        $priceType = cleanQuery($priceType); //echo print_r($average); die();
        
        if($id > 0)
        {
            $sql = "update tbl_costprofitanalysis
                    SET
                        fiscalYear = '$fiscalYear',
                        userId = '$userId',
                        manualDate = '$manualDate',
                        addressVdcMunicipality = '$addressVdcMunicipality',
                        addressWardNumber = '$addressWardNumber',
                        pocketSector = '$pocketSector',
                        sewaKendra = '$sewaKendra',
                        farmerName = '$farmerName',
                        farmerAge = '$farmerAge',
                        farmerEducation = '$farmerEducation',
                        otherOccupation = '$otherOccupation',
                        groupName = '$groupName',
                        landAreaUnit = '$landAreaUnit',
                        totalArea = '$totalArea',
                        totalAreaHector = '$totalAreaHector',
                        agricultureArea = '$agricultureArea',
                        agricultureAreaHector = '$agricultureAreaHector',
                        familyNumber = '$familyNumber',
                        cropName = '$cropName',
                        cropSpecies = '$cropSpecies',
                        cropAreaUnit = '$cropAreaUnit',
                        cropIrrigatedArea = '$cropIrrigatedArea',
                        cropIrrigatedAreaHector = '$cropIrrigatedAreaHector',
                        cropUnirrigatedArea = '$cropUnirrigatedArea',
                        cropUnirrigatedAreaHector = '$cropUnirrigatedAreaHector',
                        constructionExpense = '$constructionExpense',
                        collectorName = '$collectorName',
                        collectorPost = '$collectorPost',
                        current_cost = '$current_cost',
                        economic_cost = '$economic_cost',
                        total_cost = '$total_cost',
                        publish = '$publish',
                        weight = '$weight'
                    WHERE
                        id='$id'"; //echo $sql; die();
        }
        else
        {
            //$r1=$rate1[$i];$r2=$rate2[$i];$r3=$rate3[$i];$r4=$rate4[$i];$r5=$rate5[$i];$avg=$average[$i];$rem=$remarks[$i];
            $sql = "INSERT INTO tbl_costprofitanalysis
                    SET
                        fiscalYear = '$fiscalYear',
                        userId = '$userId',
                        manualDate = '$manualDate',
                        addressVdcMunicipality = '$addressVdcMunicipality',
                        addressWardNumber = '$addressWardNumber',
                        pocketSector = '$pocketSector',
                        sewaKendra = '$sewaKendra',
                        farmerName = '$farmerName',
                        farmerAge = '$farmerAge',
                        farmerEducation = '$farmerEducation',
                        otherOccupation = '$otherOccupation',
                        groupName = '$groupName',
                        landAreaUnit = '$landAreaUnit',
                        totalArea = '$totalArea',
                        totalAreaHector = '$totalAreaHector',
                        agricultureArea = '$agricultureArea',
                        agricultureAreaHector = '$agricultureAreaHector',
                        familyNumber = '$familyNumber',
                        cropName = '$cropName',
                        cropSpecies = '$cropSpecies',
                        cropAreaUnit = '$cropAreaUnit',
                        cropIrrigatedArea = '$cropIrrigatedArea',
                        cropIrrigatedAreaHector = '$cropIrrigatedAreaHector',
                        cropUnirrigatedArea = '$cropUnirrigatedArea',
                        cropUnirrigatedAreaHector = '$cropUnirrigatedAreaHector',
                        constructionExpense = '$constructionExpense',
                        collectorName = '$collectorName',
                        collectorPost = '$collectorPost',
                        current_cost = '$current_cost',
                        economic_cost = '$economic_cost',
                        total_cost = '$total_cost',
                        publish = '$publish',
                        weight = '$weight',
                        onDate = NOW()";
                        //echo $sql; die();
        }
        $conn->exec($sql);
        if($id > 0)
        {
            $this->saveCostProfitAnalysisCommodities($commodity,$commodityUnit,$amount,$rate,$investment,$remarks,$id,"edit");
            return $conn -> affRows();
        }
        $insertId=$conn->insertId();
        $this->saveCostProfitAnalysisCommodities($commodity,$commodityUnit,$amount,$rate,$investment,$remarks,$insertId,"add");
        return $insertId;
    }
    
    function saveCostProfitAnalysisCommodities($commodity,$commodityUnit,$amount,$rate,$investment,$remarks,$parentId,$action)
    {
        if($action=="add")
        {
            for($i=0;$i<count($commodity);$i++)
            {
                $cmdt=$commodity[$i];$cmdtu=$commodityUnit[$i];$amt=$amount[$i];$rt=$rate[$i];$invst=$investment[$i];$rem=$remarks[$i];
                $sql="insert into costprofitanalysiscommodities set commodity='$cmdt', commodityUnit='$cmdtu', amount='$amt', rate='$rt', investment='$invst', remarks='$rem', 
                parentId='$parentId'";
                //echo $sql;
                mysql_query($sql);
            }
        }
        else
        {
            for($i=0;$i<count($commodity);$i++)
            {
                $cmdt=$commodity[$i];$cmdtu=$commodityUnit[$i];$amt=$amount[$i];$rt=$rate[$i];$invst=$investment[$i];$rem=$remarks[$i];
                $row=mysql_fetch_array(mysql_query("select id from costprofitanalysiscommodities where parentId='$parentId' order by id asc limit $i,1"));
                $editId=$row['id'];
                $sql="update costprofitanalysiscommodities set commodity='$cmdt', commodityUnit='$cmdtu', amount='$amt', rate='$rt', investment='$invst', remarks='$rem' 
                where id='$editId'";
                //echo $sql;
                mysql_query($sql);
            }   
        }
    }
    
    function getNameById($id)
    {
        global $conn;
        
        $sql = "SElECT program_name FROM programtype WHERE id = '$id'";
        $result = $conn->exec($sql);
        $row = $conn->fetchArray($result);
        return $row['program_name'];
    }
    
    function getByType($type)
    {
        global $conn;

        $type = cleanQuery($type);  
        $sql = "SElECT * FROM program WHERE program_type='$type' ORDER BY weight";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getTableDataByTypeAndUserId($type,$userId)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name'];  
        $sql = "SElECT * FROM $table where userId='$userId' ORDER BY weight";
        $result = $conn->exec($sql);
        return $result;
    }

    function getTableDataByFiscalYearAndUserId($fiscalYear,$userId)
    {
        global $conn;
        $fiscalYear = join("','", $fiscalYear);
        $userId = cleanQuery($userId);  
        $sql = "SElECT sum(target) as target,sum(achievement) as achievement FROM tbl_outputindicator where userId='$userId' and fiscalYear in('$fiscalYear') ORDER BY weight";
        // echo $sql; die();
        $result = $conn->exec($sql);
        // echo $conn->numRows($result); die();
        return $result;
    }
    
    function getByTypeAndId($type,$id)
    {
        global $conn;
        $type = cleanQuery($type);
        $id = cleanQuery($id);
        $sql=$this->getTypeById($type); $table=$sql['table_name'];  
        $sql = "SElECT * FROM $table where id='$id'";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getById($id)
    {
        global $conn;

        $id = cleanQuery($id);

        $sql = "SElECT * FROM program WHERE id = '$id'";
        $result = $conn->exec($sql);
        
        return $result;
    }
    
    function delete($type,$id)
    {  
        global $conn;
        $id = cleanQuery($id);
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name'];
        
        if($table=="tbl_price")
        {
            $rates=$this->getRatesByParentId($id);
            if($conn->numRows($rates)>0)
            {
                mysql_query("delete from ratelist where parentId='$id'");
            }
        }
        else if($table=="tbl_training")
        {
            $trainee=$this->getTraineeByParentId($id);
            if($conn->numRows($trainee)>0)
            {
                mysql_query("delete from entrylist where parentId='$id'");
            }   
        }
        else if($table=="tbl_subsidi")
        {
            $donation=$this->getDonationByParentId($id);
            if($conn->numRows($donation)>0)
            {
                mysql_query("delete from donationlist where parentId='$id'");
            }   
        }
        else if($table=="tbl_cropprofit")
        {
            $commodity=$this->getCommoditiesByParentId($id);
            if($conn->numRows($commodity)>0)
            {
                mysql_query("delete from commodities where parentId='$id'");
            }   
        }
        else if($table=="tbl_fruitprofit")
        {
            $commodity=$this->getFruitCommoditiesByParentId($id);
            if($conn->numRows($commodity)>0)
            {
                mysql_query("delete from fruitcommodities where parentId='$id'");
            }   
        }
        $sql = "DELETE FROM $table WHERE id = '$id'";
        $conn->exec($sql);
    }
    
    function getRatesByParentId($parentId)
    {
        global $conn;
        $id=cleanQuery($id);
        $sql="select * from ratelist where parentId='$parentId'";
        $result=$conn->exec($sql);
        return $result;
    }
    
    function getTraineeByParentId($parentId)
    {
        global $conn;
        $id=cleanQuery($id);
        $sql="select * from entrylist where parentId='$parentId'";
        $result=$conn->exec($sql);
        return $result;
    }
    
    function getDonationByParentId($parentId)
    {
        global $conn;
        $id=cleanQuery($id);
        $sql="select * from donationlist where parentId='$parentId' order by id";
        $result=$conn->exec($sql);
        return $result;
    }
    
    function getCommoditiesByParentId($parentId)
    {
        global $conn;
        $id=cleanQuery($id);
        $sql="select * from commodities where parentId='$parentId' order by id";
        $result=$conn->exec($sql);
        return $result;
    }
    
    function getFruitCommoditiesByParentId($parentId)
    {
        global $conn;
        $id=cleanQuery($id);
        $sql="select * from fruitcommodities where parentId='$parentId' order by id";
        $result=$conn->exec($sql);
        return $result;
    }
    
    function getLastWeightStatistics($district)
    {
        global $conn;
        $district = cleanQuery($district);
        
        $sql = "SElECT weight FROM statistics where district='$district' ORDER BY weight DESC LIMIT 1";
        $result = $conn->exec($sql);
        $numRows = $conn -> numRows($result);
        if($numRows > 0)
        {
            $row = $conn->fetchArray($result);
            return $row['weight'] + 10;
        }
        else
            return 10;
    }
    
    function getByIdStatistics($id)
    {
        global $conn;
        $id = cleanQuery($id);
        $sql = "SElECT * FROM statistics WHERE id = '$id'";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function saveStatistics($id, $district, $vdc_muncipality, $total_familyno, $total_population, $farmer_familyno, $farmer_population, $crop_name, $crop_code, $total_areaunit, $irrigated_area, $nonirrigated_area, $total_area, $production_unit, $production_amount, $farmer_unit, $farmer_price, $market_unit, $market_price, $productivity, $publish, $weight)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $district = cleanQuery($district);
        $vdc_muncipality = cleanQuery($vdc_muncipality);
        $total_familyno = cleanQuery($total_familyno);
        $total_population = cleanQuery($total_population);
        $farmer_familyno = cleanQuery($farmer_familyno);
        $farmer_population=cleanQuery($farmer_population);
        $crop_name=cleanQuery($crop_name);  
        $crop_code=cleanQuery($crop_code);
        $total_areaunit=cleanQuery($total_areaunit);
        $irrigated_area=cleanQuery($irrigated_area);
        $nonirrigated_area = cleanQuery($nonirrigated_area);
        $total_area = cleanQuery($total_area);
        $production_unit = cleanQuery($production_unit);
        $production_amount = cleanQuery($production_amount);
        $farmer_unit = cleanQuery($farmer_unit);
        $farmer_price = cleanQuery($farmer_price);
        $market_unit = cleanQuery($market_unit);
        $market_price = cleanQuery($market_price);
        $productivity = cleanQuery($productivity);
        $publish=cleanQuery($publish);
        $weight=cleanQuery($weight);
        
        if($id > 0)
        $sql = "UPDATE statistics
                        SET
                            district = '$district',
                            vdc_muncipality = '$vdc_muncipality',
                            total_familyno = '$total_familyno',
                            total_population = '$total_population',
                            farmer_familyno = '$farmer_familyno',
                            farmer_population = '$farmer_population',
                            crop_name = '$crop_name',
                            crop_code = '$crop_code',
                            total_areaunit = '$total_areaunit',
                            irrigated_area = '$irrigated_area',
                            nonirrigated_area = '$nonirrigated_area',
                            total_area = '$total_area',
                            production_unit = '$production_unit',
                            production_amount = '$production_amount',
                            farmer_unit =  '$farmer_unit',
                            farmer_price = '$farmer_price',
                            market_unit = '$market_price',
                            market_price = '$market_price',
                            productivity = '$productivity',
                            publish='$publish',
                            weight = '$weight'                      
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO statistics SET district = '$district', vdc_muncipality = '$vdc_muncipality',total_familyno = '$total_familyno',total_population = '$total_population', farmer_familyno = '$farmer_familyno',farmer_population = '$farmer_population',crop_name = '$crop_name',crop_code = '$crop_code',total_areaunit = '$total_areaunit',irrigated_area = '$irrigated_area',nonirrigated_area = '$nonirrigated_area',total_area = '$total_area',production_unit = '$production_unit', production_amount = '$production_amount',farmer_unit =  '$farmer_unit',farmer_price = '$farmer_price',market_unit = '$market_unit',market_price = '$market_price',productivity = '$productivity',publish='$publish',weight = '$weight'";
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    function getStatistics($district)
    {
        global $conn;
        $district = cleanQuery($district);
        //$type = cleanQuery($type);    
        $sql = "SElECT * FROM statistics where district='$district' ORDER BY weight";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function deleteStatistics($id)
    {  
        global $conn;
        $id = cleanQuery($id);
        //$result = $this->getByIdStatistics($id);
        $sql = "DELETE FROM statistics WHERE id = '$id'";
        $conn->exec($sql);
    }
    
    function getDistrictByRegion($region)
    {
        global $conn;
        
        $region = cleanQuery($region);

        $sql="select * from district where dev_region='$region'";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getByDistrict($district)
    {
        global $conn;
        
        $district = cleanQuery($district);

        $sql="select * from statistics where district='$district'";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getCropStatistics($district)
    {
        global $conn;
        $district = cleanQuery($district);
        
        $sql="select * from statistics where district='$district' order by weight";
        $result = $conn->exec($sql);
        return $result;
    }
    
    //for form upload
    function saveForm($id, $district, $name, $date)
    {
        global $conn;
        
        $id = cleanQuery($id);
        $district = cleanQuery($district);
        $name= cleanQuery($name);
        $date= cleanQuery($date);
        
        if($id > 0)
        $sql = "UPDATE form
                        SET
                            district = '$district',
                            name= '$name',
                            date= '$date'                       
                        WHERE
                            id = '$id'";
        else
        $sql = "INSERT INTO form SET district = '$district', name= '$name',date= '$date'";
        //echo $sql; die();
        $conn->exec($sql);
        if($id > 0)
            return $conn -> affRows();
        return $conn->insertId();
    }
    
    function saveFormFile($id,$district,$date)
    {
        global $conn;
        global $_FILES;
        
        if ($_FILES['form']['size'] <= 0)
            return;
        
        $id = cleanQuery($id);
        $filename = $_FILES['form']['name'];
        $filename=$district.$date.$filename; //echo $filename; die();
        $form = $filename;
        
        $f=$this->getByIdForm($id); $fGet=$conn->fetchArray($f);
        if(!empty($fGet['form']) && file_exists(CMS_FILES_DIR .$fGet['form']))
        {
            unlink(CMS_FILES_DIR .$fGet['form']);   
        }
        
        copy($_FILES['form']['tmp_name'], CMS_FILES_DIR . $form);
        
        $sql = "UPDATE form SET form = '$form' WHERE id = '$id'";
        $conn->exec($sql);
    }
    
    function getform($district)
    {
        global $conn;
        $district = cleanQuery($district);
        //$type = cleanQuery($type);    
        $sql = "SElECT * FROM form where district='$district'";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getByIdForm($id)
    {
        global $conn;
        $id = cleanQuery($id);
        $sql = "SElECT * FROM form WHERE id = '$id'";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getFormByDistrict($district)
    {
        global $conn;
        
        $district = cleanQuery($district);

        $sql="select * from form where district='$district'";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function deleteForm($id)
    {
        global $conn;
        
        $sql = "DELETE FROM form WHERE id = '$id'";
        
        $result = $conn -> exec($sql);
        return $conn -> affRows();
    }
    
    //for rate list
    function getPriceListByParentId($parentId)
    {
        global $conn;
        $parentId=cleanQuery($parentId);
        $sql = "select * from ratelist WHERE parentId = '$parentId' order by id ASC";
        $result = $conn -> exec($sql);
        return $result;
    }
    
    function getTableDataByPriceTypeAndUser($type,$priceType,$userId)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name']; //echo $priceType; die();
        $sql = "SElECT * FROM $table where priceType='$priceType' and userId='$userId' ORDER BY weight";
        $result = $conn->exec($sql);
        return $result;
    }
    
    //get trainee list by training id
    function getTraineeByTrainingId($parentId)
    {
        global $conn;
        $parentId=cleanQuery($parentId);
        $sql = "select * from entrylist WHERE parentId = '$parentId' order by id ASC";
        $result = $conn -> exec($sql);
        return $result;
    }
    
    //get district by userId
    function getDistrictByUserId($userId)
    {
        global $conn;
        $userId=cleanQuery($userId);
        $sql = "select district_name from district WHERE id in (select district from usergroups where id='$userId')";
        $result = $conn -> exec($sql);
        return $result;
    }
    
    // reports generation
    function getTableDataByTypeAndId($type,$id)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name'];  
        $sql = "SElECT * FROM $table where id='$id'"; //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    function getUnitById($id)
    {
        global $conn;
        $id = cleanQuery($id);  
        $sql = "SElECT * FROM unit where id='$id'";
        $result = $conn->fetchArray($conn->exec($sql));
        return $result;
    }
    
    //table data by type and fiscal year
    function getTableDataByTypeAndFiscalYearAndUserId($type,$fiscalYear,$userId)
    {
        global $conn;
        $type = cleanQuery($type); //echo $type; die();
        $sql=$this->getTypeById($type); $table=$sql['table_name'];  
        $sql = "SElECT * FROM $table where fiscalYear='$fiscalYear' and userId='$userId' and publish='Yes' ORDER BY weight";
        //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getTableDataByTypeAndFiscalYearAndCropListAndUserId($type,$fiscalYear,$cropName,$userId)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name']; //echo $cropName[0]; die();
        $list = explode(',',$cropName);
        $instring = "('" . implode("','", $list) . "')";
        
        //echo $instring; die();
        $sql = "SElECT * FROM $table where fiscalYear='$fiscalYear' and cropName in $instring and userId='$userId' and publish='Yes' ORDER BY weight";
        //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getTableDataByTypeAndFiscalYearAndCropListAndMonthAndUserId($type,$fiscalYear,$cropName,$month,$userId)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name']; //echo $cropName[0]; die();
        
        $list = explode(',',$cropName);
        $instring = "('" . implode("','", $list) . "')";
        
        $list = explode(',',$month);
        $instringMonth = "('" . implode("','", $list) . "')";
        
        //echo $instring; die();
        $sql = "SElECT * FROM $table where fiscalYear='$fiscalYear' and cropName in $instring and month in $instringMonth and userId='$userId' and 
        publish='Yes' ORDER BY weight";
        //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getTableDataByTypeAndFiscalYearAndPriceTypeAndMonthAndUserId($type,$fiscalYear,$priceType,$month,$userId)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name']; //echo $cropName[0]; die();
        
        $list = explode(',',$priceType);
        $instringPrice = "('" . implode("','", $list) . "')";
        
        $list = explode(',',$month);
        $instringMonth = "('" . implode("','", $list) . "')";
        
        //echo $instring; die();
        $sql = "SElECT * FROM $table where fiscalYear='$fiscalYear' and priceType in $instringPrice and month in $instringMonth and userId='$userId' and 
        publish='Yes' ORDER BY weight";
        //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getTableDataByTypeAndFiscalYearAndProgramNameAndUserId($type,$fiscalYear,$programName,$userId)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name']; //echo $cropName[0]; die();
        
        $list = explode(',',$programName);
        $instringProgram = "('" . implode("','", $list) . "')";
        
        //echo $instring; die();
        $sql = "SElECT * FROM $table where fiscalYear='$fiscalYear' and programName in $instringProgram and userId='$userId' and publish='Yes' ORDER BY 
        weight";
        //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    
    //for central report generation
    function getDistrictsByUsers()
    {
        global $conn;

        $sql="select * from district where id in (select district from usergroups) order by id";
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getDistrictById($id)
    {
        global $conn;
        $id=cleanQuery($id);
        $sql = "SElECT * FROM district where id='$id'";
        $result = $conn->exec($sql);
        $type=$conn->fetchArray($result);
        return $type;
    }
    
    function getUserByDistrictId($districtId)
    {
        global $conn;
        $districtId=cleanQuery($districtId);
        $sql = "SElECT * FROM usergroups where district='$districtId'";
        $result = $conn->exec($sql);
        $data=$conn->fetchArray($result);
        return $data;
    }
    
    //table data by type and fiscal year and district
    function getTableDataByTypeAndFiscalYearAndDistrict($type,$fiscalYear,$district)
    {
        global $conn;
        $type = cleanQuery($type); //echo $type; die();
        $sql=$this->getTypeById($type); $table=$sql['table_name'];

        $list = explode(',',$district);
        $district = "('" . implode("','", $list) . "')";
        $sql = "SElECT * FROM $table where fiscalYear='$fiscalYear' and userId in (select id from usergroups where district in $district) and publish='Yes' 
        ORDER BY weight";
        //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    function getTableDataByTypeAndFiscalYearAndCropListAndDistrict($type,$fiscalYear,$cropName,$district)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name'];;
        
        $list = explode(',',$district);
        $district = "('" . implode("','", $list) . "')";
        
        $list = explode(',',$cropName);
        $instring = "('" . implode("','", $list) . "')";
        
        //echo $instring; die();
        $sql = "SElECT * FROM $table where fiscalYear='$fiscalYear' and cropName in $instring and userId in (select id from usergroups where district 
        in $district) and publish='Yes' ORDER BY weight";
        //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    function getTableDataByTypeAndFiscalYearAndCropListAndMonthAndDistrict($type,$fiscalYear,$cropName,$month,$district)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name']; //echo $cropName[0]; die();
        
        $list = explode(',',$district);
        $district = "('" . implode("','", $list) . "')";
        
        $list = explode(',',$cropName);
        $instring = "('" . implode("','", $list) . "')";
        
        $list = explode(',',$month);
        $instringMonth = "('" . implode("','", $list) . "')";
        
        //echo $instring; die();
        $sql = "SElECT * FROM $table where fiscalYear='$fiscalYear' and cropName in $instring and month in $instringMonth and userId in (select id 
        from usergroups where district in $district) and publish='Yes' ORDER BY weight";
        //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    function getTableDataByTypeAndFiscalYearAndPriceTypeAndMonthAndDistrict($type,$fiscalYear,$priceType,$month,$district)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name']; //echo $cropName[0]; die();
        
        $list = explode(',',$district);
        $district = "('" . implode("','", $list) . "')";
        
        $list = explode(',',$priceType);
        $instringPrice = "('" . implode("','", $list) . "')";
        
        $list = explode(',',$month);
        $instringMonth = "('" . implode("','", $list) . "')";
        
        //echo $instring; die();
        $sql = "SElECT * FROM $table where fiscalYear='$fiscalYear' and priceType in $instringPrice and month in $instringMonth and userId in (select id 
        from usergroups where district in $district) and publish='Yes' ORDER BY weight";
        //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    function getTableDataByTypeAndFiscalYearAndProgramNameAndDistrict($type,$fiscalYear,$programName,$district)
    {
        global $conn;
        $type = cleanQuery($type);
        $sql=$this->getTypeById($type); $table=$sql['table_name']; //echo $cropName[0]; die();
        
        $list = explode(',',$district);
        $district = "('" . implode("','", $list) . "')";
        
        $list = explode(',',$programName);
        $instringProgram = "('" . implode("','", $list) . "')";
        
        //echo $instring; die();
        $sql = "SElECT * FROM $table where fiscalYear='$fiscalYear' and programName in $instringProgram and userId in (select id from usergroups where 
        district in $district) and publish='Yes' ORDER BY weight";
        //echo $sql; die();
        $result = $conn->exec($sql);
        return $result;
    }
    
    function getCaste()
    {
        global $conn;   
        $sql = "SElECT * FROM caste order by id";
        $result = $conn->exec($sql);
        return $result;
    }
}

?>