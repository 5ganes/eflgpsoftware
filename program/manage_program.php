<?php
include("../admin/init.php");
/*if(!isset($_SESSION['sessUserId']))//User authentication
{
 	header("Location: login.php");
 	exit();
}*/
//header('Content-Type: text/html; charset=utf-8');

if (isset($_POST['save']))
{
	// die('sdfsdf');
	extract($_POST);
 	if (isset($_POST['id']))
 	{
  		//edit contents
  		if($_POST['tableName']=="tbl_outputindicator")
		{
			$newId = $program->saveOutputIndicator($id,$fiscalYear,$userId,$manualDate,$outputIndicator,$unit,$target,$achievement,
			$plannedBudget,$eflgpExpenditure,$otherExpenditure,$remarks,$publish,$weight);
		}	
		elseif($_POST['tableName']=="tbl_districtinformation")
		{
			$program->saveDistrictInformation($id,$fiscalYear,$userId,$manualDate,$areaUnit,$totalArea,$agricultureArea,$irrigatedArea,
				$unirrigatedArea,$barrenArea,$irrigationTimeUnit,$grassArea,$forestArea,$otherArea,$totalFamilyNumber,$totalPopulation,$femaleNumber,$maleNumber,
				$farmerFamilyNumber,$farmerPopulation,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_crop")
		{
			$program->saveCrop($id,$fiscalYear,$userId,$manualDate,$cropName,$cropCode,$areaUnit,$totalArea,$productionUnit,$totalProduction,$farmerUnit,$farmerPrice,$marketUnit,$marketPrice,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_pocketarea")
		{
			$program->savePocketArea($id,$fiscalYear,$userId,$manualDate,$pocketAreaName,$totalFamilyNumber,$totalPopulation,$farmerFamilyNumber,
			$farmerPopulation,$femaleNumber,$maleNumber,$firstCrop,$secondCrop,$thirdCrop,$fundamentalService,$areaUnit,$irrigatedArea,$unirrigatedArea,$productionUnit,
			$irrigatedProduction,$unirrigatedProduction,$farmerUnit,$farmerPrice,$marketUnit,$marketPrice,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_nursery")
		{
			$shrotKendraService=$_POST['sks'];
			$program->saveNursery($id,$fiscalYear,$userId,$manualDate,$shrotKendra,$addressVdcMunicipality,$addressWardNumber,$registration,$registeredDay,
			$$registeredMonth,$registeredYear,$shrotKendraService,$plantNumber,$fruitNumber,$contactPerson,$phoneNumber,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_cropcutting")
		{
			$program->saveCropCutting($id,$fiscalYear,$userId,$manualDate,$cropName,$cropCode,$farmerName,$sewaKendra,
				$addressVdcMunicipality,$addressWardNumber,$landType,$seedType,$productionUnit,$cropCuttingProduction,$moisturePercent,$productivity,$remarks,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_monthlyreporting")
		{
				
			$newId = $program->saveMonthlyReporting($id,$fiscalYear,$userId,$manualDate,$month,$cropName,$cropCode,$cropWork,$cropGrowth,$cropMaturity,
			$cropHarvest,$affectedUnit,$affectedArea,$affectFamilyNo,$productionLoss,$rainCondition,$temperature,$fertilizerSupplied,$farmingEndedAreaUnit,
			$farmingEndedArea,$cutProductionUnit,$cutProduction,$lowHighAreaUnit,$lowHighArea,$lowHighProductionUnit,$lowHighProduction,$remarks,$publish,
			$weight);
		}
		elseif($_POST['tableName']=="tbl_fertilizer")
		{
			$sellingObject=$_POST['sobj'];
			$newId = $program->saveFertilizer($id,$fiscalYear,$userId,$manualDate,$sellingOffice,$sellingOfficeType,$addressVdcMunicipality,$addressWardNumber,
			$proprietorName,$contactNumber,$registrationNumber,$renewStatus,$registeredYear,$sellingObject,$sellAmountUnit,$sellAmount,$sellPriceUnit,$sellPrice,$remarks,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_agrigroups")
		{
			$newId = $program->saveAgrigroups($id,$fiscalYear,$userId,$manualDate,$groupName,$addressVdcMunicipality,$addressWardNumber,$establishedYear,
			$femaleNumber,$maleNumber,$groupType,$subjectiveArea,$registeredDay,$registeredMonth,$registeredYear,$registrationNumber,$meetingDay,$collectedFundPerMonth,$totalFund,
			$debtAmount,$groupStatus,$contactPerson,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_agricoop")
		{
			$newId = $program->saveAgricoop($id,$fiscalYear,$userId,$manualDate,$cooperativeName,$addressVdcMunicipality,$addressWardNumber,$registeredDay,
			$registeredMonth,$registeredYear,$registrationNumber,$femaleNumber,$maleNumber,$workingField,$workingVdcMunicipality,$totalFund,$debtAmount,
			$contactPerson,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_market")
		{
			$newId = $program->saveMarket($id,$fiscalYear,$userId,$manualDate,$marketName,$marketType,$marketAreaUnit,$marketArea,$establishedYear,
			$addressVdcMunicipality,$addressWardNumber,$command_vdc_mun_number,$marketDay,$governmentInvestment,$agricultureProductTradeUnit,$agricultureProductTradeQuantity,
			$agricultureProductTradeAmount,$contactPerson,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_insuranceinfo")
		{
			$newId = $program->saveInsuranceInfo($id,$fiscalYear,$userId,$manualDate,$insuranceHolder,$insuranceCompany,$cropName,$cropCode,$cropAreaUnit,$cropArea,$insuranceAmount,$compensation,$totalFarmer,
			$remarks,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_farmeridentification")
		{
			$newId = $program->saveFarmerIdentification($id,$fiscalYear,$userId,$manualDate,$farmerName,$addressVdcMunicipality,$addressWardNumber,
			$farmerAge,$mainCrop,$farmerCaste,$farmerIdType,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_fisheryinformation")
		{
			$newId = $program->saveFisheryInformation($id,$fiscalYear,$userId,$manualDate,$farmerName,$addressVdcMunicipality,$addressWardNumber,$lakeType,
			$lakeNumber,$areaUnit,$lakeArea,$fishSpecies,$productionUnit,$production,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_price")
		{
			$rate1=$_POST['r1'];$rate2=$_POST['r2'];$rate3=$_POST['r3'];$rate4=$_POST['r4'];$rate5=$_POST['r5'];
			$average=$_POST['average'];$remarks=$_POST['remarks']; //echo print_r($remarks); die();
			$newId = $program->savePrice($id,$fiscalYear,$userId,$manualDate,$month,$marketName,$collectedDate,$collector,$commodity,$rate1,$rate2,$rate3,
			$rate4,$rate5,$average,$remarks,$publish,$weight,$priceType);
		}
		elseif($_POST['tableName']=="tbl_training")
		{
			//echo $participantNumber; die();
			$participantName=$_POST['participantName'];$participantAddress=$_POST['participantAddress'];
			$participantGender=$_POST['participantGender'];$participantCast=$_POST['participantCast'];$participantAge=$_POST['participantAge'];
			$newId = $program->saveTraining($id,$fiscalYear,$userId,$manualDate,$trainingDay,$trainingMonth,$trainingYear,$trainingName,$trainingLevel,$sewakendra,
			$participantNumber,$participantName,$participantAddress,$participantGender,$participantCast,$participantAge,$maleNumber,$femaleNumber,
			$lowcastNumber,$indigenousNumber,$otherNumber,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_subsidi")
		{
			//echo $donationNumber; die();
			$name=$_POST['name'];$cast=$_POST['cast'];$gender=$_POST['gender'];$age=$_POST['age'];$addressVdcMunicipality=$_POST['addressVdcMunicipality'];
			$addressWardNumber=$_POST['addressWardNumber'];$object=$_POST['object'];$amount=$_POST['amount'];
			$newId = $program->saveSubsidi($id,$fiscalYear,$userId,$manualDate,$programDay,$programMonth,$programYear,$programName,$subsidiAmount,$donationType,
			$donationUnit,$donationNumber,$name,$cast,$gender,$age,$addressVdcMunicipality,$addressWardNumber,$object,$amount,$remarks,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_cropprofit")
		{
			$commodity=$_POST['commodity'];$commodityUnit=$_POST['commodityUnit'];$amount=$_POST['amount'];$rate=$_POST['rate'];
			$investment=$_POST['investment'];$remarks=$_POST['remarks'];
			
			$current_cost = $_POST['current_cost']; $economic_cost = $_POST['economic_cost'];
			$total_cost = $_POST['total_cost'];
			
			$newId = $program->saveCropProfit($id,$fiscalYear,$userId,$manualDate,$addressVdcMunicipality,$addressWardNumber,$pocketSector,$sewaKendra,
			$farmerName,$farmerAge,$farmerEducation,$otherOccupation,$groupName,$landAreaUnit,$totalArea,$agricultureArea,$familyNumber,$cropId,
			$cropVarietyId,$cropAreaUnit,$irrigationUnit,$cropArea,$constructionExpense,$collectorName,$collectorPost,$commodity,
			$commodityUnit,$amount,$rate,$investment,$remarks,$current_cost,$economic_cost,$total_cost,$publish,$weight);
		}
		elseif($_POST['tableName']=="tbl_fruitprofit")
		{
			$commodity=$_POST['commodity'];$commodityUnit=$_POST['commodityUnit'];$amount=$_POST['amount'];$rate=$_POST['rate'];
			$investment=$_POST['investment'];$remarks=$_POST['remarks'];
			
			$current_cost = $_POST['current_cost']; $economic_cost = $_POST['economic_cost'];
			$total_cost = $_POST['total_cost'];
			
			$newId = $program->saveFruitProfit($id,$fiscalYear,$userId,$manualDate,$addressVdcMunicipality,$addressWardNumber,$pocketSector,$sewaKendra,
			$farmerName,$farmerAge,$farmerEducation,$otherOccupation,$groupName,$landAreaUnit,$totalArea,$agricultureArea,$familyNumber,$cropId,
			$cropVarietyId,$cropAreaUnit,$irrigationUnit,$cropArea,$constructionExpense,$collectorName,$collectorPost,$fruitYear,$commodity,
			$commodityUnit,$amount,$rate,$investment,$remarks,$current_cost,$economic_cost,$total_cost,$publish,$weight);
		}
		// elseif($_POST['tableName']=="tbl_costprofitanalysis")
		// {
		// 	$commodity=$_POST['commodity'];$commodityUnit=$_POST['commodityUnit'];$amount=$_POST['amount'];$rate=$_POST['rate'];
		// 	$investment=$_POST['investment'];$remarks=$_POST['remarks'];
			
		// 	$current_cost = $_POST['current_cost']; $economic_cost = $_POST['economic_cost'];
		// 	$production = $_POST['production'];
			
		// 	$newId = $program->saveCostProfitAnalysis($id,$fiscalYear,$userId,$manualDate,$addressVdcMunicipality,$addressWardNumber,$pocketSector,$sewaKendra,
		// 	$farmerName,$farmerAge,$farmerEducation,$otherOccupation,$groupName,$landAreaUnit,$totalArea,$agricultureArea,$familyNumber,$cropName,
		// 	$cropSpecies,$cropAreaUnit,$cropIrrigatedArea,$cropUnirrigatedArea,$constructionExpense,$collectorName,$collectorPost,$commodity,
		// 	$commodityUnit,$amount,$rate,$investment,$remarks,$current_cost,$economic_cost,$total_cost,$publish,$weight);
		// }
	
		//$diary -> saveImage($_POST['id']);
		$priceType="";
		if(isset($_POST['priceType'])){ $priceType="&priceType=".$_POST['priceType'];}
		$url = 	"../index.php?page=program&groupType=". $_GET['groupType'] ."&id=". $_POST['id'].$priceType;

		header ("Location: " . $url ."&msg=Successfully updated!");
		exit();
	 	
 	}
	////////////////
	// ADD NEW //// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	else //add new code goes here...
	{
 		if(empty($msg))
		{
			if($_POST['tableName']=="tbl_outputindicator")
			{
				$newId = $program->saveOutputIndicator("",$fiscalYear,$userId,$manualDate,$outputIndicator,$unit,$target,$achievement,
				$plannedBudget,$eflgpExpenditure,$otherExpenditure,$remarks,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_districtinformation")
			{
				$newId = $program->saveDistrictInformation("",$fiscalYear,$userId,$manualDate,$areaUnit,$totalArea,$agricultureArea,$irrigatedArea,
				$unirrigatedArea,$barrenArea,$irrigationTimeUnit,$grassArea,$forestArea,$otherArea,$totalFamilyNumber,$totalPopulation,$femaleNumber,$maleNumber,
				$farmerFamilyNumber,$farmerPopulation,$publish,$weight);
			}
			if($_POST['tableName']=="tbl_crop")
			{	
				$newId = $program->saveCrop("",$fiscalYear,$userId,$manualDate,$cropName,$cropCode,$areaUnit,$totalArea,$productionUnit,$totalProduction,$farmerUnit,$farmerPrice,$marketUnit,$marketPrice,
				$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_pocketarea")
			{
				$program->savePocketArea("",$fiscalYear,$userId,$manualDate,$pocketAreaName,$totalFamilyNumber,$totalPopulation,$farmerFamilyNumber,
				$farmerPopulation,$femaleNumber,$maleNumber,$firstCrop,$secondCrop,$thirdCrop,$fundamentalService,$areaUnit,$irrigatedArea,$unirrigatedArea,$productionUnit,
				$irrigatedProduction,$unirrigatedProduction,$farmerUnit,$farmerPrice,$marketUnit,$marketPrice,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_nursery")
			{
				$shrotKendraService=$_POST['sks'];
				$newId = $program->saveNursery("",$fiscalYear,$userId,$manualDate,$shrotKendra,$addressVdcMunicipality,$addressWardNumber,$registration,
				$registeredDay,$registeredMonth,$registeredYear,$shrotKendraService,$plantNumber,$fruitNumber,$contactPerson,$phoneNumber,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_cropcutting")
			{
				$newId = $program->saveCropCutting("",$fiscalYear,$userId,$manualDate,$cropName,$cropCode,$farmerName,$sewaKendra,
				$addressVdcMunicipality,$addressWardNumber,$landType,$seedType,$productionUnit,$cropCuttingProduction,$moisturePercent,$productivity,$remarks,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_monthlyreporting")
			{
				
				$newId = $program->saveMonthlyReporting("",$fiscalYear,$userId,$manualDate,$month,$cropName,$cropCode,$cropWork,$cropGrowth,$cropMaturity,
				$cropHarvest,$affectedUnit,$affectedArea,$affectFamilyNo,$productionLoss,$rainCondition,$temperature,$fertilizerSupplied,$farmingEndedAreaUnit,
				$farmingEndedArea,$cutProductionUnit,$cutProduction,$lowHighAreaUnit,$lowHighArea,$lowHighProductionUnit,$lowHighProduction,$remarks,$publish,
				$weight);
			}
			elseif($_POST['tableName']=="tbl_fertilizer")
			{
				$sellingObject=$_POST['sobj'];
				$newId = $program->saveFertilizer("",$fiscalYear,$userId,$manualDate,$sellingOffice,$sellingOfficeType,$addressVdcMunicipality,
				$addressWardNumber,$proprietorName,$contactNumber,$registrationNumber,$renewStatus,$registeredYear,$sellingObject,$remarks,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_agrigroups")
			{
				$newId = $program->saveAgrigroups("",$fiscalYear,$userId,$manualDate,$groupName,$addressVdcMunicipality,$addressWardNumber,$establishedYear,
				$femaleNumber,$maleNumber,$groupType,$subjectiveArea,$registeredDay,$registeredMonth,$registeredYear,$registrationNumber,$meetingDay,$collectedFundPerMonth,$totalFund,
				$debtAmount,$groupStatus,$contactPerson,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_agricoop")
			{
				$newId = $program->saveAgricoop("",$fiscalYear,$userId,$manualDate,$cooperativeName,$addressVdcMunicipality,$addressWardNumber,
				$registeredDay,$registeredMonth,$registeredYear,$registrationNumber,$femaleNumber,$maleNumber,$workingField,$workingVdcMunicipality,$totalFund,
				$debtAmount,$contactPerson,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_market")
			{
				$newId = $program->saveMarket("",$fiscalYear,$userId,$manualDate,$marketName,$marketType,$marketAreaUnit,$marketArea,$establishedYear,
				$addressVdcMunicipality,$addressWardNumber,$command_vdc_mun_number,$marketDay,$governmentInvestment,$agricultureProductTradeUnit,$agricultureProductTradeQuantity,
				$agricultureProductTradeAmount,$contactPerson,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_insuranceinfo")
			{
				$newId = $program->saveInsuranceInfo("",$fiscalYear,$userId,$manualDate,$insuranceHolder,$insuranceCompany,$cropName,$cropCode,$cropAreaUnit,$cropArea,$insuranceAmount,$compensation,$totalFarmer,
				$remarks,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_farmeridentification")
			{
				$newId = $program->saveFarmerIdentification("",$fiscalYear,$userId,$manualDate,$farmerName,$addressVdcMunicipality,$addressWardNumber,
				$farmerAge,$mainCrop,$farmerCaste,$farmerIdType,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_fisheryinformation")
			{
				$newId = $program->saveFisheryInformation("",$fiscalYear,$userId,$manualDate,$farmerName,$addressVdcMunicipality,$addressWardNumber,$lakeType,
				$lakeNumber,$areaUnit,$lakeArea,$fishSpecies,$productionUnit,$production,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_price")
			{
				$rate1=$_POST['r1'];$rate2=$_POST['r2'];$rate3=$_POST['r3'];$rate4=$_POST['r4'];$rate5=$_POST['r5'];
				$average=$_POST['average'];$remarks=$_POST['remarks']; //echo print_r($remarks); die();
				$newId = $program->savePrice("",$fiscalYear,$userId,$manualDate,$month,$marketName,$collectedDate,$collector,$commodity,$rate1,$rate2,$rate3,
				$rate4,$rate5,$average,$remarks,$publish,$weight,$priceType);	
			}
			elseif($_POST['tableName']=="tbl_training")
			{
				$participantName=$_POST['participantName'];$participantAddress=$_POST['participantAddress'];
				$participantGender=$_POST['participantGender'];$participantCast=$_POST['participantCast'];$participantAge=$_POST['participantAge'];
				$newId = $program->saveTraining("",$fiscalYear,$userId,$manualDate,$trainingDay,$trainingMonth,$trainingYear,$trainingName,$trainingLevel,$sewakendra,
				$participantNumber,$participantName,$participantAddress,$participantGender,$participantCast,$participantAge,$maleNumber,$femaleNumber,
				$lowcastNumber,$indigenousNumber,$otherNumber,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_subsidi")
			{
				//print_r($gender); die();
				$name=$_POST['name'];$cast=$_POST['cast'];$gender=$_POST['gender'];$age=$_POST['age'];$addressVdcMunicipality=$_POST['addressVdcMunicipality'];
				$addressWardNumber=$_POST['addressWardNumber'];$object=$_POST['object'];$amount=$_POST['amount'];
				$newId = $program->saveSubsidi("",$fiscalYear,$userId,$manualDate,$programDay,$programMonth,$programYear,$programName,$subsidiAmount,$donationType,
				$donationUnit,$donationNumber,$name,$cast,$gender,$age,$addressVdcMunicipality,$addressWardNumber,$object,$amount,$remarks,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_cropprofit")
			{
				$commodity=$_POST['commodity'];$commodityUnit=$_POST['commodityUnit'];$amount=$_POST['amount'];$rate=$_POST['rate'];
				$investment=$_POST['investment'];$remarks=$_POST['remarks'];
				
				$current_cost = $_POST['current_cost']; $economic_cost = $_POST['economic_cost'];
				$total_cost = $_POST['total_cost'];
				
				$newId = $program->saveCropProfit("",$fiscalYear,$userId,$manualDate,$addressVdcMunicipality,$addressWardNumber,$pocketSector,$sewaKendra,
				$farmerName,$farmerAge,$farmerEducation,$otherOccupation,$groupName,$landAreaUnit,$totalArea,$agricultureArea,$familyNumber,$cropId,
				$cropVarietyId,$cropAreaUnit,$irrigationUnit,$cropArea,$constructionExpense,$collectorName,$collectorPost,$commodity,
				$commodityUnit,$amount,$rate,$investment,$remarks,$current_cost,$economic_cost,$total_cost,$publish,$weight);
			}
			elseif($_POST['tableName']=="tbl_fruitprofit")
			{
				$commodity=$_POST['commodity'];$commodityUnit=$_POST['commodityUnit'];$amount=$_POST['amount'];$rate=$_POST['rate'];
				$investment=$_POST['investment'];$remarks=$_POST['remarks'];
				
				$current_cost = $_POST['current_cost']; $economic_cost = $_POST['economic_cost'];
				$total_cost = $_POST['total_cost'];
				
				$newId = $program->saveFruitProfit("",$fiscalYear,$userId,$manualDate,$addressVdcMunicipality,$addressWardNumber,$pocketSector,$sewaKendra,
				$farmerName,$farmerAge,$farmerEducation,$otherOccupation,$groupName,$landAreaUnit,$totalArea,$agricultureArea,$familyNumber,$cropId,
				$cropVarietyId,$cropAreaUnit,$irrigationUnit,$cropArea,$constructionExpense,$collectorName,$collectorPost,$fruitYear,$commodity,
				$commodityUnit,$amount,$rate,$investment,$remarks,$current_cost,$economic_cost,$total_cost,$publish,$weight);
			}
			// elseif($_POST['tableName']=="tbl_costprofitanalysis")
			// {
			// 	$commodity=$_POST['commodity'];$commodityUnit=$_POST['commodityUnit'];$amount=$_POST['amount'];$rate=$_POST['rate'];
			// 	$investment=$_POST['investment'];$remarks=$_POST['remarks'];
				
			// 	$current_cost = $_POST['current_cost']; $economic_cost = $_POST['economic_cost'];
			// 	$production = $_POST['production'];
				
			// 	$newId = $program->saveCostProfitAnalysis("",$fiscalYear,$userId,$manualDate,$addressVdcMunicipality,$addressWardNumber,$pocketSector,$sewaKendra,
			// 	$farmerName,$farmerAge,$farmerEducation,$otherOccupation,$groupName,$landAreaUnit,$totalArea,$agricultureArea,$familyNumber,$cropName,
			// 	$cropSpecies,$cropAreaUnit,$cropIrrigatedArea,$cropUnirrigatedArea,$constructionExpense,$collectorName,$collectorPost,$commodity,
			// 	$commodityUnit,$amount,$rate,$investment,$remarks,$current_cost,$economic_cost,$total_cost,$publish,$weight);
			// }
			
			//$diary->saveImage($newId);
			
			if(empty($msg))
			{
				$priceType="";
				if(isset($_POST['priceType'])){ $priceType="&priceType=".$_POST['priceType'];}
				$url = 	"../index.php?page=program&groupType=". $_GET['groupType'].$priceType;
				if($showId)
					$url .= "&id=". $_POST['id'];
				header ("Location: " . $url ."&msg=Successfully saved!");
				exit();
			}
		}
	}
 	$priceType="";
	if(isset($_POST['priceType'])){ $priceType="&priceType=".$_POST['priceType'];}
 	header ("Location: ../index.php?page=program&groupType=". $_GET['groupType'].$priceType."&msg=" . $msg);	
 	exit();
}
else if (isset($_GET['id']) && isset($_GET['delete']))
{
 	$program->delete($_GET['groupType'],$_GET['id']);

 	$msg = "Successfully deleted!";
 	if(isset($_GET['priceType'])){ $priceType="&priceType=".$_GET['priceType'];}
	header ("Location: ../index.php?page=program&groupType=". $_GET['groupType'].$priceType."&msg=" . $msg);
 	exit();
}
else if (isset($_GET['deleteListId']))
{
 	$groups->delete($_GET['deleteListId']);
 	$msg = "Listing deleted!";
 	header ("Location: cms.php?id=". $_GET['id'] ."&groupType=". $_GET['groupType'] ."&parentId=". $_GET['parentId'] ."&msg=" . $msg);
 	exit();
}
?>