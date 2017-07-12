function GetXmlHttpObject()
{
	var xmlHttp=null;
	
	try
	{
	// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

function addImage()
{
	newDiv = document.createElement("div");
	
	str = "<div style='width:100px; float: left;'>Image : </div><div style='float:left;'>";
	str += "<input type='file' name='galimage[]' class='file' /></div><br style='clear: both;'>";
	str += "<div style='width:100px; float: left;'>Caption : </div>";
	str += "<div style='float:left;'><input type='text' name='imageCaption[]' class='text' /></div>";
	str += "<hr style='clear: both;'>";

	newDiv.innerHTML = str;

	document.getElementById('uploadImageHolder').appendChild(newDiv);
}
						
function addListFile()
{
	newDiv = document.createElement("div");
	
	str = "<div style='width:100px; float: left;'>File : </div><div style='float:left;'>";
	str += "<input type='file' name='listFile[]' class='file' /></div><br style='clear: both;'>";
	str += "<div style='width:100px; float: left;'>Caption : </div>";
	str += "<div style='float:left;'><input type='text' name='listCaption[]' class='text' /></div>";
	str += "<hr style='clear: both;'>";

	newDiv.innerHTML = str;

	document.getElementById('uploadFileHolder').appendChild(newDiv);
}

function addVideo()
{
	newDiv = document.createElement("div");
	
	str = "<div style=''>Link : </div>";
	str += "<div style='float:left; padding-bottom:5px;'><textarea name='videoUrl[]' rows='4' cols='100'></textarea></div>";
	str += "<hr style='clear: both;'>";

	newDiv.innerHTML = str;

	document.getElementById('uploadVideoHolder').appendChild(newDiv);
}

function changeType(box)
{
	location.href = "cms.php?groupType=" + box.value;
}

function changePackageContentType(sbox)
{
	cDiv = document.getElementById('packageContentDiv');
	gDiv = document.getElementById('packageGalleryDiv');
	cDiv.style.display = 'none';
	gDiv.style.display = 'none';

	if(sbox.value == "Content")
	{
		cDiv.style.display = 'block';
		//getAndPut("ajaxPackageContentPanel.php", myDiv);
		//document.getElementById('packageContentDiv').innerHTML = 'Create your content';
	}
	else if(sbox.value == "Gallery")
	{
		gDiv.style.display = 'block';
		//getAndPut("ajaxPackageGalleryPanel.php", myDiv);
		//document.getElementById('packageGalleryDiv').innerHTML = 'Create your gallery';
	}
}

function getAndPut(url, intoDiv)
{
	xmlHttp = GetXmlHttpObject();
	
	xmlHttp.onreadystatechange=function()
	{
		if (xmlHttp.readyState==4)
		{ 
			intoDiv.innerHTML = xmlHttp.responseText;
			CKEDITOR.replace('shortcontents', { toolbar: 'basic' });
			CKEDITOR.replace('shortcontentsnp', { toolbar: 'basic' });
			CKEDITOR.replace( 'contents');
			CKEDITOR.replace( 'contentsnp');
		}
	};
	xmlHttp.open("GET",url,true);

	xmlHttp.send(null);
}

function getAndPutList(url, intoDiv)
{
	xmlHttp = GetXmlHttpObject();
	
	xmlHttp.onreadystatechange=function()
	{
		if (xmlHttp.readyState==4)
		{ 
			intoDiv.innerHTML = xmlHttp.responseText;
			CKEDITOR.replace( 'listDescription' );
			CKEDITOR.replace( 'listDescriptionnp' );
		}
	};
	xmlHttp.open("GET",url,true);

	xmlHttp.send(null);
}

function changeLinkType(sbox)
{

	document.getElementById('directLink').disabled = true;

	document.getElementById('uploadFile').disabled = true;

	document.getElementById('directLink').style.display = 'none';

	document.getElementById('uploadFile').style.display = 'none';

	document.getElementById('fckEditor').style.display = 'none';

	document.getElementById('galleryDiv').style.display = 'none';

	document.getElementById('listDiv').style.display = 'none';
	
	document.getElementById('normalGroupDiv').style.display = 'none';	
	
	document.getElementById('videoGalleryDiv').style.display = 'none';
	
	document.getElementById('pageDetails').style.display = 'none';

	document.getElementById('contentsLabel').innerHTML = '';
	document.getElementById('contentsLabel').style.display = 'none';
	
	document.getElementById('displaytype').style.display = 'none';
	document.getElementById('featured').style.display = 'none';
	//document.getElementById('ImageLabel').style.display = 'none';
	//document.getElementById('grpImage').style.display= 'none';

	if(sbox.value == "Link")
	{
		myDiv = document.getElementById('directLink');

		myDiv.disabled = false;

		myDiv.style.display = 'block';

		document.getElementById('contentsLabel').innerHTML = 'Page name / URL';
		document.getElementById('contentsLabel').style.display = 'block';
	}
	else if(sbox.value == "Normal Group")
	{
		document.getElementById('pageDetails').style.display = 'block';
		
		myDiv = document.getElementById('fckEditor');
		myDiv.style.display = 'block';
		
		document.getElementById('displaytype').style.display = 'block';

		getAndPut("ajaxNormalGroup.php", myDiv);
		document.getElementById('contentsLabel').innerHTML = 'Put your contents';
		document.getElementById('contentsLabel').style.display = 'block';
		
		//document.getElementById('ImageLabel').style.display = 'block';
		//document.getElementById('grpImage').style.display= 'block';		
	}

	else if(sbox.value == "File")
	{
		myDiv = document.getElementById('uploadFile');
		myDiv.disabled = false;
		myDiv.style.display = 'block';

		document.getElementById('contentsLabel').innerHTML = 'Upload a file';
		document.getElementById('contentsLabel').style.display = 'block';
	}
	else if(sbox.value == "Contents Page")
	{
		document.getElementById('pageDetails').style.display = 'block';
		
		myDiv = document.getElementById('fckEditor');
		myDiv.style.display = 'block';
		
		document.getElementById('featured').style.display = 'block';

		getAndPut("ajaxContentsPanel.php", myDiv);
		document.getElementById('contentsLabel').innerHTML = 'Put your contents';
		document.getElementById('contentsLabel').style.display = 'block';
		
		//document.getElementById('ImageLabel').style.display = 'block';
		//document.getElementById('grpImage').style.display= 'block';
	}
	else if(sbox.value == "Gallery")
	{
		document.getElementById('pageDetails').style.display = 'block';
		
		myDiv = document.getElementById('galleryDiv');

		myDiv.style.display = 'block';

		getAndPut("ajaxGalleryPanel.php", myDiv);

		//document.getElementById('contentsLabel').innerHTML = 'Create your gallery';
	}
	else if(sbox.value == "List")
	{
		document.getElementById('pageDetails').style.display = 'block';
		
		myDiv = document.getElementById('listDiv');

		myDiv.style.display = 'block';

		getAndPutList("ajaxListingPanel.php", myDiv);

		//document.getElementById('contentsLabel').innerHTML = 'Create your gallery';
	}
	else if(sbox.value == "Video Gallery")
	{
		document.getElementById('pageDetails').style.display = 'block';
		
		myDiv = document.getElementById('videoGalleryDiv');

		myDiv.style.display = 'block';

		getAndPut("ajaxVideoGalleryPanel.php", myDiv);

		//document.getElementById('contentsLabel').innerHTML = 'Create your gallery';
	}
}

function delete_confirmation(query)
{
	//alert("dismissed");
	if(confirm("Are you sure you want to delete?"))
	{
		location.href = query;	
	}
	return false;
}


function copySame(divId, value)
{
	xmlHttp = GetXmlHttpObject();
	
	xmlHttp.onreadystatechange=function()
	{
		if (xmlHttp.readyState==4)
		{ 
			document.getElementById(divId).value = xmlHttp.responseText;
		}
	};
	xmlHttp.open("GET",'formaturl.php?value='+ value,true);

	xmlHttp.send(null);
}

function checkUrlName(id, val, div)
{
	$.get('checkurlname.php', {id: id, value: val}, function(data){
		$("#" + div).html(data);
	})
}

function changeTypeProgram(box)
{
	location.href = "index.php?page=program&groupType=" + box.value;	
}

// autocomplet : this function will be executed every time we change the text
function searchCrop() {
	//alert("hell");
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#cropName').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajaxsearchcrop.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#cropNameError').hide();
				$('#cropNameList').show();
				$('#cropNameList').html(data);
				ajaxcheckvalidcrop(keyword);
			}
		});
	} else {
		$('#cropNameList').hide();
	}
}

// set_item : this function will be executed when we select an item
function set_item(item,code,image) {
	// change input value
	//alert(image);
	img="files/groups/"+image; //alert(img);
	$('#cropName').val(item);
	$('#cropCodeShow').html(code);
	$('#cropCode').val(code);
	$('#cropNameError').html(null);
	$('#cropNameError').hide();
	
	var http = new XMLHttpRequest();
    http.open('HEAD', img, false);
    http.send();
	if(http.status!=404)
	{
		document.getElementById("cropImage").innerHTML='<img style="width:70px;height:50px; margin-top:-35px;" src="'+img+'" />';
	}
	else
	{
		document.getElementById("cropImage").innerHTML="";
	}
	//str = "<img style='width:100px;' src='' />";
	// hide proposition list
	$('#cropNameList').hide();
}

function validate(fm,table)
{
	if(table=='tbl_districtinformation')
	{
		// for tbl_districtinformation fields validation
		$('#totalArea').html(null);
		$('#agricultureArea').html(null);
		$('#irrigatedArea').html(null);
		$('#unirrigatedArea').html(null);
		$('#barrenArea').html(null);
		$('#grassArea').html(null);
		$('#forestArea').html(null);
		$('#otherArea').html(null);
		$('#totalFamilyNumber').html(null);
		$('#totalPopulation').html(null);
		$('#farmerFamilyNumber').html(null);
		$('#farmerPopulation').html(null);
		$('#femaleNumber').html(null);
		$('#maleNumber').html(null);
		
		if(isNaN(fm.totalArea.value)){
			//&& fm.totalArea.value!='-'
			$('#totalArea').html('[numeric value]'); fm.totalArea.value=''; fm.totalArea.focus(); return false;
		}
		if(isNaN(fm.agricultureArea.value)){
			$('#agricultureArea').html('[numeric value]'); fm.agricultureArea.value=''; fm.agricultureArea.focus(); return false;
		}
		if(isNaN(fm.irrigatedArea.value)){
			$('#irrigatedArea').html('[numeric value]'); fm.irrigatedArea.value=''; fm.irrigatedArea.focus(); return false;
		}
		if(isNaN(fm.unirrigatedArea.value)){
			$('#unirrigatedArea').html('[numeric value]'); fm.unirrigatedArea.value=''; fm.unirrigatedArea.focus(); return false;
		}
		if(isNaN(fm.barrenArea.value)){
			$('#barrenArea').html('[numeric value]'); fm.barrenArea.value=''; fm.barrenArea.focus(); return false;
		}	
		if(isNaN(fm.grassArea.value)){
			$('#grassArea').html('[numeric value]'); fm.grassArea.value=''; fm.grassArea.focus(); return false;
		}
		if(isNaN(fm.forestArea.value)){
			$('#forestArea').html('[numeric value]'); fm.forestArea.value=''; fm.forestArea.focus(); return false;
		}
		if(isNaN(fm.otherArea.value)){
			$('#otherArea').html('[numeric value]'); fm.otherArea.value=''; fm.otherArea.focus(); return false;
		}
		if(isNaN(fm.totalFamilyNumber.value)){
			$('#totalFamilyNumber').html('[numeric value]'); fm.totalFamilyNumber.value=''; fm.totalFamilyNumber.focus(); return false;
		}
		if(isNaN(fm.totalPopulation.value)){
			$('#totalPopulation').html('[numeric value]'); fm.totalPopulation.value=''; fm.totalPopulation.focus(); return false;
		}
		if(isNaN(fm.farmerFamilyNumber.value)){
			$('#farmerFamilyNumber').html('[numeric value]'); fm.farmerFamilyNumber.value=''; fm.farmerFamilyNumber.focus(); return false;
		}
		if(isNaN(fm.farmerPopulation.value)){
			$('#farmerPopulation').html('[numeric value]'); fm.farmerPopulation.value=''; fm.farmerPopulation.focus(); return false;
		}
		if(isNaN(fm.femaleNumber.value)){
			$('#femaleNumber').html('[numeric value]'); fm.femaleNumber.value=''; fm.femaleNumber.focus(); return false;
		}
		if(isNaN(fm.maleNumber.value)){
			$('#maleNumber').html('[numeric value]'); fm.maleNumber.value=''; fm.maleNumber.focus(); return false;
		}
	}
	else if(table=='tbl_crop')
	{
		//for tbl_crop fields validation
		$('#totalArea').html(null);
		$('#totalProduction').html(null);
		$('#farmerPrice').html(null);
		$('#marketPrice').html(null);
		if(document.getElementById("cropNameError").innerHTML!=""){
			fm.cropName.focus(); return false;		
		}
		if(isNaN(fm.totalArea.value)){
			$('#totalArea').html('[numeric value]'); fm.totalArea.value=''; fm.totalArea.focus(); return false;
		}
		if(isNaN(fm.totalProduction.value)){
			$('#totalProduction').html('[numeric value]'); fm.totalProduction.value=''; fm.totalProduction.focus(); return false;
		}
		if(isNaN(fm.farmerPrice.value)){
			$('#farmerPrice').html('[numeric value]'); fm.farmerPrice.value=''; fm.farmerPrice.focus(); return false;
		}
		if(isNaN(fm.marketPrice.value)){
			$('#marketPrice').html('[numeric value]'); fm.marketPrice.value=''; fm.marketPrice.focus(); return false;
		}
	}
	else if(table=='tbl_pocketarea')
	{
		//for tbl_pocketarea fields validation
		$('#totalFamilyNumber').html(null);
		$('#totalPopulation').html(null);
		$('#farmerFamilyNumber').html(null);
		$('#farmerPopulation').html(null);
		$('#femaleNumber').html(null);
		$('#maleNumber').html(null);
		$('#irrigatedArea').html(null);
		$('#unirrigatedArea').html(null);
		$('#irrigatedProduction').html(null);
		$('#unirrigatedProduction').html(null);
		$('#farmerPrice').html(null);
		$('#marketPrice').html(null);
		if(isNaN(fm.totalFamilyNumber.value)){
			$('#totalFamilyNumber').html('[numeric value]'); fm.totalFamilyNumber.value=''; fm.totalFamilyNumber.focus(); return false;
		}
		if(isNaN(fm.totalPopulation.value)){
			$('#totalPopulation').html('[numeric value]'); fm.totalPopulation.value=''; fm.totalPopulation.focus(); return false;
		}
		if(isNaN(fm.farmerFamilyNumber.value)){
			$('#farmerFamilyNumber').html('[numeric value]'); fm.farmerFamilyNumber.value=''; fm.farmerFamilyNumber.focus(); return false;
		}
		if(isNaN(fm.farmerPopulation.value)){
			$('#farmerPopulation').html('[numeric value]'); fm.farmerPopulation.value=''; fm.farmerPopulation.focus(); return false;
		}
		if(isNaN(fm.femaleNumber.value)){
			$('#femaleNumber').html('[numeric value]'); fm.femaleNumber.value=''; fm.femaleNumber.focus(); return false;
		}
		if(isNaN(fm.maleNumber.value)){
			$('#maleNumber').html('[numeric value]'); fm.maleNumber.value=''; fm.maleNumber.focus(); return false;
		}
		if(isNaN(fm.irrigatedArea.value)){
			$('#irrigatedArea').html('[numeric value]'); fm.irrigatedArea.value=''; fm.irrigatedArea.focus(); return false;
		}
		if(isNaN(fm.unirrigatedArea.value)){
			$('#unirrigatedArea').html('[numeric value]'); fm.unirrigatedArea.value=''; fm.unirrigatedArea.focus(); return false;
		}
		if(isNaN(fm.irrigatedProduction.value)){
			$('#irrigatedProduction').html('[numeric value]'); fm.irrigatedProduction.value=''; fm.irrigatedProduction.focus(); return false;
		}
		if(isNaN(fm.unirrigatedProduction.value)){
			$('#unirrigatedProduction').html('[numeric value]'); fm.unirrigatedProduction.value=''; fm.unirrigatedProduction.focus(); return false;
		}
		if(isNaN(fm.farmerPrice.value)){
			$('#farmerPrice').html('[numeric value]'); fm.farmerPrice.value=''; fm.farmerPrice.focus(); return false;
		}
		if(isNaN(fm.marketPrice.value)){
			$('#marketPrice').html('[numeric value]'); fm.marketPrice.value=''; fm.marketPrice.focus(); return false;
		}
	}
	else if(table=='tbl_nursery')
	{
		//alert("nursery");
		//for tbl_nursery fields validation
		$('#addressWardNumber').html(null);
		$('#sks').html(null);
		$('#phoneNumber').html(null);
		if(isNaN(fm.addressWardNumber.value)){
			$('#addressWardNumber').html('[numeric value]'); fm.addressWardNumber.value=''; fm.addressWardNumber.focus(); return false;
		}
		if($('[name="sks[]"]:checked').length==0){
			$('#sks').css({ 'border-radius': '7px', 'box-shadow': '0 1px 10px #888888', 'float':'left', 'font-size':'11px','margin-top':'1%','padding':'0 1%',
			'text-align':'left','width':'31%' });
			$('#sks').html('[ Please select atleast one item ]'); return false;
		}
		if(isNaN(fm.phoneNumber.value)){
			$('#phoneNumber').html('[numeric value]'); fm.phoneNumber.value=''; fm.phoneNumber.focus(); return false;
		}
	}
	else if(table=='tbl_cropcutting')
	{
		//for tbl_cropcutting fields validation
		$('#addressWardNumber').html(null);
		$('#cropCuttingProduction').html(null);
                $('#moisturePercent').html(null);
		if(document.getElementById("cropNameError").innerHTML!=""){
			fm.cropName.focus(); return false;		
		}
		if(isNaN(fm.addressWardNumber.value)){
			$('#addressWardNumber').html('[numeric value]'); fm.addressWardNumber.value=''; fm.addressWardNumber.focus(); return false;
		}
		if(isNaN(fm.cropCuttingProduction.value)){
			$('#cropCuttingProduction').html('[numeric value]'); fm.cropCuttingProduction.value=''; fm.cropCuttingProduction.focus(); return false;
		}
                if(isNaN(fm.moisturePercent.value)){
			$('#moisturePercent').html('[numeric value]'); fm.moisturePercent.value=''; fm.moisturePercent.focus(); return false;
		}
	}
	else if(table=='tbl_monthlyreporting')
	{
		//for tbl_monthlyreporting fields validation
		$('#cropWork').html(null);
		$('#cropGrowth').html(null);
		$('#cropMaturity').html(null);
		$('#cropHarvest').html(null);
		$('#affectedArea').html(null);
		$('#affectFamilyNo').html(null);
		$('#productionLoss').html(null);
		$('#farmingEndedArea').html(null);
		$('#cutProduction').html(null);
		$('#lowHighArea').html(null);
		$('#lowHighProduction').html(null);
		
		if(document.getElementById("cropNameError").innerHTML!=""){
			fm.cropName.focus(); return false;		
		}
		if(isNaN(fm.cropWork.value)){
			$('#cropWork').html('[numeric value]'); fm.cropWork.value=''; fm.cropWork.focus(); return false;
		}
		if(isNaN(fm.cropGrowth.value)){
			$('#cropGrowth').html('[numeric value]'); fm.cropGrowth.value=''; fm.cropGrowth.focus(); return false;
		}
		if(isNaN(fm.cropMaturity.value)){
			$('#cropMaturity').html('[numeric value]'); fm.cropMaturity.value=''; fm.cropMaturity.focus(); return false;
		}
		if(isNaN(fm.cropHarvest.value)){
			$('#cropHarvest').html('[numeric value]'); fm.cropHarvest.value=''; fm.cropHarvest.focus(); return false;
		}
		if(isNaN(fm.affectedArea.value)){
			$('#affectedArea').html('[numeric value]'); fm.affectedArea.value=''; fm.affectedArea.focus(); return false;
		}
		if(isNaN(fm.affectFamilyNo.value)){
			$('#affectFamilyNo').html('[numeric value]'); fm.affectFamilyNo.value=''; fm.affectFamilyNo.focus(); return false;
		}
		if(isNaN(fm.productionLoss.value)){
			$('#productionLoss').html('[numeric value]'); fm.productionLoss.value=''; fm.productionLoss.focus(); return false;
		}
		if(isNaN(fm.farmingEndedArea.value)){
			$('#farmingEndedArea').html('[numeric value]'); fm.farmingEndedArea.value=''; fm.farmingEndedArea.focus(); return false;
		}
		if(isNaN(fm.cutProduction.value)){
			$('#cutProduction').html('[numeric value]'); fm.cutProduction.value=''; fm.cutProduction.focus(); return false;
		}
		if(isNaN(fm.lowHighArea.value)){
			$('#lowHighArea').html('[numeric value]'); fm.lowHighArea.value=''; fm.lowHighArea.focus(); return false;
		}
		if(isNaN(fm.lowHighProduction.value)){
			$('#lowHighProduction').html('[numeric value]'); fm.lowHighProduction.value=''; fm.lowHighProduction.focus(); return false;
		}
	}
	else if(table=='tbl_fertilizer')
	{
		//for tbl_fertilizer fields validation
		$('#addressWardNumber').html(null);
		$('#contactNumber').html(null);
		if(isNaN(fm.addressWardNumber.value)){
			$('#addressWardNumber').html('[numeric value]'); fm.addressWardNumber.value=''; fm.addressWardNumber.focus(); return false;
		}
		if(isNaN(fm.contactNumber.value)){
			$('#contactNumber').html('[numeric value]'); fm.contactNumber.value=''; fm.contactNumber.focus(); return false;
		}
		if($('[name="sobj[]"]:checked').length==0){
			$('#sobj').css({ 'border-radius': '7px', 'box-shadow': '0 1px 10px #888888', 'float':'left', 'font-size':'11px','margin-top':'1%','padding':'0 1%',
			'text-align':'left','width':'31%' });
			$('#sobj').html('[ Please select atleast one item ]'); return false;
		}
	}
	else if(table=='tbl_agrigroups')
	{
		//for tbl_agrigroups fields validation
		$('#addressWardNumber').html(null);
		$('#femaleNumber').html(null);
		$('#maleNumber').html(null);
		$('#collectedFundPerMonth').html(null);
		$('#totalFund').html(null);
		$('#debtAmount').html(null);
		
		if(isNaN(fm.addressWardNumber.value)){
			$('#addressWardNumber').html('[numeric value]'); fm.addressWardNumber.value=''; fm.addressWardNumber.focus(); return false;
		}
		if(isNaN(fm.femaleNumber.value)){
			$('#femaleNumber').html('[numeric value]'); fm.femaleNumber.value=''; fm.femaleNumber.focus(); return false;
		}
		if(isNaN(fm.maleNumber.value)){
			$('#maleNumber').html('[numeric value]'); fm.maleNumber.value=''; fm.maleNumber.focus(); return false;
		}
		if(isNaN(fm.collectedFundPerMonth.value)){
			$('#collectedFundPerMonth').html('[numeric value]'); fm.collectedFundPerMonth.value=''; fm.collectedFundPerMonth.focus(); return false;
		}
		if(isNaN(fm.totalFund.value)){
			$('#totalFund').html('[numeric value]'); fm.totalFund.value=''; fm.totalFund.focus(); return false;
		}
		if(isNaN(fm.debtAmount.value)){
			$('#debtAmount').html('[numeric value]'); fm.debtAmount.value=''; fm.debtAmount.focus(); return false;
		}
	}
	else if(table=='tbl_agricoop')
	{
		//for tbl_agricoop fields validation
		$('#addressWardNumber').html(null);
		$('#femaleNumber').html(null);
		$('#maleNumber').html(null);
		$('#totalFund').html(null);
		$('#debtAmount').html(null);
		
		if(isNaN(fm.addressWardNumber.value)){
			$('#addressWardNumber').html('[numeric value]'); fm.addressWardNumber.value=''; fm.addressWardNumber.focus(); return false;
		}
		if(isNaN(fm.femaleNumber.value)){
			$('#femaleNumber').html('[numeric value]'); fm.femaleNumber.value=''; fm.femaleNumber.focus(); return false;
		}
		if(isNaN(fm.maleNumber.value)){
			$('#maleNumber').html('[numeric value]'); fm.maleNumber.value=''; fm.maleNumber.focus(); return false;
		}
		if(isNaN(fm.totalFund.value)){
			$('#totalFund').html('[numeric value]'); fm.totalFund.value=''; fm.totalFund.focus(); return false;
		}
		if(isNaN(fm.debtAmount.value)){
			$('#debtAmount').html('[numeric value]'); fm.debtAmount.value=''; fm.debtAmount.focus(); return false;
		}
	}
	else if(table=='tbl_market')
	{
		//for tbl_market fields validation
		$('#marketArea').html(null);
		$('#addressWardNumber').html(null);
		$('#governmentInvestment').html(null);
		$('#agricultureProductTradeQuantity').html(null);
		$('#agricultureProductTradeAmount').html(null);
		
		if(isNaN(fm.marketArea.value)){
			$('#marketArea').html('[numeric value]'); fm.marketArea.value=''; fm.marketArea.focus(); return false;
		}
		if(isNaN(fm.addressWardNumber.value)){
			$('#addressWardNumber').html('[numeric value]'); fm.addressWardNumber.value=''; fm.addressWardNumber.focus(); return false;
		}
		if(isNaN(fm.governmentInvestment.value)){
			$('#governmentInvestment').html('[numeric value]'); fm.governmentInvestment.value=''; fm.governmentInvestment.focus(); return false;
		}
		if(isNaN(fm.agricultureProductTradeQuantity.value)){
			$('#agricultureProductTradeQuantity').html('[numeric value]'); fm.agricultureProductTradeQuantity.value=''; 
			fm.agricultureProductTradeQuantity.focus(); return false;
		}
		if(isNaN(fm.agricultureProductTradeAmount.value)){
			$('#agricultureProductTradeAmount').html('[numeric value]'); fm.agricultureProductTradeAmount.value=''; 
			fm.agricultureProductTradeAmount.focus(); return false;
		}
	}
	else if(table=='tbl_insuranceinfo')
	{
		//for tbl_cinsuranceinfo fields validation
		$('#cropArea').html(null);
		$('#insuranceAmount').html(null);
                $('#totalFarmer').html(null);
		if(document.getElementById("cropNameError").innerHTML!="")
		{
			fm.cropName.focus();
			return false;		
		}
		if(isNaN(fm.cropArea.value)){
			$('#cropArea').html('[numeric value]'); fm.cropArea.value=''; fm.cropArea.focus(); return false;
		}
		if(isNaN(fm.insuranceAmount.value)){
			$('#insuranceAmount').html('[numeric value]'); fm.insuranceAmount.value=''; fm.insuranceAmount.focus(); return false;
		}
                if(isNaN(fm.totalFarmer.value)){
			$('#totalFarmer').html('[numeric value]'); fm.totalFarmer.value=''; fm.totalFarmer.focus(); return false;
		}
	}
	else if(table=='tbl_farmeridentification')
	{
		//for tbl_cinsuranceinfo fields validation
		$('#addressWardNumber').html(null);
		$('#farmerAge').html(null);
		if(isNaN(fm.addressWardNumber.value)){
			$('#addressWardNumber').html('[numeric value]'); fm.addressWardNumber.value=''; fm.addressWardNumber.focus(); return false;
		}
		if(isNaN(fm.farmerAge.value)){
			$('#farmerAge').html('[numeric value]'); fm.farmerAge.value=''; fm.farmerAge.focus(); return false;
		}
	}
	else if(table=='tbl_fisheryinformation')
	{
		//for tbl_cinsuranceinfo fields validation
		$('#addressWardNumber').html(null);
		$('#lakeNumber').html(null);
		$('#lakeArea').html(null);
                $('#production').html(null);
		if(isNaN(fm.addressWardNumber.value)){
			$('#addressWardNumber').html('[numeric value]'); fm.addressWardNumber.value=''; fm.addressWardNumber.focus(); return false;
		}
		if(isNaN(fm.lakeNumber.value)){
			$('#lakeNumber').html('[numeric value]'); fm.lakeNumber.value=''; fm.lakeNumber.focus(); return false;
		}
		if(isNaN(fm.lakeArea.value)){
			$('#lakeArea').html('[numeric value]'); fm.lakeArea.value=''; fm.lakeArea.focus(); return false;
		}
                if(isNaN(fm.production.value)){
			$('#production').html('[numeric value]'); fm.production.value=''; fm.production.focus(); return false;
		}
	}
	else if(table=='tbl_price')
	{
		//for tbl_price fields validation
		var r1=document.getElementsByName('r1[]');
		var r2=document.getElementsByName('r2[]');
		var r3=document.getElementsByName('r3[]');
		var r4=document.getElementsByName('r4[]');
		var r5=document.getElementsByName('r5[]'); ret=true;
		for(key=0; key < r1.length; key++){
			id='r1'+(key+1);
			document.getElementById(id).style="border-color:#abadb3";
			if(isNaN(r1[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
			
			id='r2'+(key+1);
			document.getElementById(id).style="border-color:#abadb3"; 
			if(isNaN(r2[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
			
			id='r3'+(key+1);
			document.getElementById(id).style="border-color:#abadb3"; 
			if(isNaN(r3[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
			
			id='r4'+(key+1);
			document.getElementById(id).style="border-color:#abadb3"; 
			if(isNaN(r4[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
			
			id='r5'+(key+1);
			document.getElementById(id).style="border-color:#abadb3"; 
			if(isNaN(r5[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
		}
		return ret;
	}
	else if(table=='tbl_training')
	{
		//for tbl_training fields validation
		$('#participantNumber').html(null);
		$('#maleNumber').html(null);
		$('#femaleNumber').html(null);
		$('#lowcastNumber').html(null);
		$('#indigenousNumber').html(null);
		$('#otherNumber').html(null);
		
		if(isNaN(fm.participantNumber.value)){
			$('#participantNumber').html('[ numeric ]'); fm.participantNumber.value=''; fm.participantNumber.focus(); return false;
		}
		
		var pn=document.getElementsByName('participantName[]');
		if(pn.length==0)
		{
			//alert(pn.length); return false;
			$('#pnError').css('display','block'); return false;
		}
		
		if(isNaN(fm.maleNumber.value)){
			$('#maleNumber').html('[numeric value]'); fm.maleNumber.value=''; fm.maleNumber.focus(); return false;
		}
		if(isNaN(fm.femaleNumber.value)){
			$('#femaleNumber').html('[numeric value]'); fm.femaleNumber.value=''; fm.femaleNumber.focus(); return false;
		}
		if(isNaN(fm.lowcastNumber.value)){
			$('#lowcastNumber').html('[numeric value]'); fm.lowcastNumber.value=''; fm.lowcastNumber.focus(); return false;
		}
		if(isNaN(fm.indigenousNumber.value)){
			$('#indigenousNumber').html('[numeric value]'); fm.indigenousNumber.value=''; fm.indigenousNumber.focus(); return false;
		}
		if(isNaN(fm.otherNumber.value)){
			$('#otherNumber').html('[numeric value]'); fm.otherNumber.value=''; fm.otherNumber.focus(); return false;
		}
	}
	else if(table=='tbl_subsidi')
	{
		//for tbl_subsidi fields validation
		$('#subsidiAmount').html(null);
		$('#donationNumber').html(null);
		
		if(isNaN(fm.subsidiAmount.value)){
			$('#subsidiAmount').html('[numeric value]'); fm.subsidiAmount.value=''; fm.subsidiAmount.focus(); return false;
		}
		if(isNaN(fm.donationNumber.value)){
			$('#donationNumber').html('[numeric value]'); fm.donationNumber.value=''; fm.donationNumber.focus(); return false;
		}
		var dname=document.getElementsByName('name[]');
		if(dname.length==0)
		{
			//alert(dname.length); return false;
			$('#dnError').css('display','block'); return false;
		}
	}
	else if(table=='tbl_cropprofit')
	{
		//for tbl_cropprofit fields validation
		$('#addressWardNumber').html(null);
		$('#farmerAge').html(null);
		$('#totalArea').html(null);
		$('#agricultureArea').html(null);
		$('#familyNumber').html(null);
		$('#cropIrrigatedArea').html(null);
		$('#cropUnirrigatedArea').html(null);
		$('#constructionExpense').html(null); ret=true;
		
		if(isNaN(fm.addressWardNumber.value)){
			$('#addressWardNumber').html('[numeric value]'); fm.addressWardNumber.value=''; ret=false;
		}
		if(isNaN(fm.farmerAge.value)){
			$('#farmerAge').html('[numeric value]'); fm.farmerAge.value=''; ret=false;
		}
		if(isNaN(fm.totalArea.value)){
			$('#totalArea').html('[numeric value]'); fm.totalArea.value=''; ret=false;
		}
		if(isNaN(fm.agricultureArea.value)){
			$('#agricultureArea').html('[numeric value]'); fm.agricultureArea.value=''; ret=false;
		}
		if(isNaN(fm.familyNumber.value)){
			$('#familyNumber').html('[numeric value]'); fm.familyNumber.value=''; ret=false;
		}
		if(isNaN(fm.cropIrrigatedArea.value)){
			$('#cropIrrigatedArea').html('[numeric value]'); fm.cropIrrigatedArea.value=''; ret=false;
		}
		if(isNaN(fm.cropUnirrigatedArea.value)){
			$('#cropUnirrigatedArea').html('[numeric value]'); fm.cropUnirrigatedArea.value=''; ret=false;
		}
		if(isNaN(fm.constructionExpense.value)){
			$('#constructionExpense').html('[numeric value]'); fm.constructionExpense.value=''; ret=false;
		}
		var a=document.getElementsByName('amount[]');
		var r=document.getElementsByName('rate[]');
		var i=document.getElementsByName('investment[]');
		for(key=0; key < a.length; key++){
			id='a'+(key+1);
			document.getElementById(id).style="border-color:#abadb3";
			if(isNaN(a[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
			
			id='r'+(key+1);
			document.getElementById(id).style="border-color:#abadb3"; 
			if(isNaN(r[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
			
			id='i'+(key+1);
			document.getElementById(id).style="border-color:#abadb3"; 
			if(isNaN(i[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
		}
		return ret;
	}
	else if(table=='tbl_fruitprofit')
	{
		//for tbl_fruitprofit fields validation
		$('#addressWardNumber').html(null);
		$('#farmerAge').html(null);
		$('#totalArea').html(null);
		$('#agricultureArea').html(null);
		$('#familyNumber').html(null);
		$('#cropIrrigatedArea').html(null);
		$('#cropUnirrigatedArea').html(null);
		$('#constructionExpense').html(null); ret=true;
		
		if(isNaN(fm.addressWardNumber.value)){
			$('#addressWardNumber').html('[numeric value]'); fm.addressWardNumber.value=''; ret=false;
		}
		if(isNaN(fm.farmerAge.value)){
			$('#farmerAge').html('[numeric value]'); fm.farmerAge.value=''; ret=false;
		}
		if(isNaN(fm.totalArea.value)){
			$('#totalArea').html('[numeric value]'); fm.totalArea.value=''; ret=false;
		}
		if(isNaN(fm.agricultureArea.value)){
			$('#agricultureArea').html('[numeric value]'); fm.agricultureArea.value=''; ret=false;
		}
		if(isNaN(fm.familyNumber.value)){
			$('#familyNumber').html('[numeric value]'); fm.familyNumber.value=''; ret=false;
		}
		if(isNaN(fm.cropIrrigatedArea.value)){
			$('#cropIrrigatedArea').html('[numeric value]'); fm.cropIrrigatedArea.value=''; ret=false;
		}
		if(isNaN(fm.cropUnirrigatedArea.value)){
			$('#cropUnirrigatedArea').html('[numeric value]'); fm.cropUnirrigatedArea.value=''; ret=false;
		}
		if(isNaN(fm.constructionExpense.value)){
			$('#constructionExpense').html('[numeric value]'); fm.constructionExpense.value=''; ret=false;
		}
		//alert(ret); return false;
		var a=document.getElementsByName('amount[]');
		var r=document.getElementsByName('rate[]');
		var i=document.getElementsByName('investment[]');
		//alert(a); return false;
		for(key=0; key < a.length; key++){
			id='a'+(key+1);
			document.getElementById(id).style="border-color:#abadb3";
			if(isNaN(a[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
			
			id='r'+(key+1);
			document.getElementById(id).style="border-color:#abadb3"; 
			if(isNaN(r[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
			
			id='i'+(key+1);
			document.getElementById(id).style="border-color:#abadb3"; 
			if(isNaN(i[key].value)){
				document.getElementById(id).value=""; document.getElementById(id).style="border-color:red"; ret=false;	
			}
		}
		//alert(ret);
		return ret;
	}
}

function ajaxcheckvalidcrop(crop)
{
	var min_length = 0; // min caracters to display the autocomplete
	if (crop.length >= min_length) {
		$.ajax({
			url: 'ajaxcheckvalidcrop.php',
			type: 'POST',
			data: {crop:crop},
			success:function(data){
				$('#cropNameError').show();
				$('#cropNameError').html(data);
				$("#cropNameError").css("font-size", "11px");
				$("#cropNameError").css("text-align", "left");
				$('#cropCodeShow').html(null);
				$('#cropImage').html(null);
				
				//$("#cropNameError").html("<li><p class='error' style='font-size:11px;'>no crop found</p></li>");
			}
		});
	}	
}

function average(r1,r2,r3,r4,r5,average)
{
	document.getElementById(average).value='';
	r1=document.getElementById(r1).value;
	r2=document.getElementById(r2).value;
	r3=document.getElementById(r3).value;
	r4=document.getElementById(r4).value;
	r5=document.getElementById(r5).value;
	var divider=0; //alert(r1+r2);
	if(r1!=''){ divider++;}
	if(r2!=''){ divider++;}
	if(r3!=''){ divider++;}
	if(r4!=''){ divider++;}
	if(r5!=''){ divider++;}
	var avg=(+r1 + +r2 + +r3 + +r4 + +r5)/divider;
	if(isNaN(avg)){ avg='';}
	document.getElementById(average).value= avg;
	//alert();	
}

function displayCast(id)
{
	//alert(id.value);
	if(id.value==56)
	{
		document.getElementById("dUnitAlert").value=56;
		//document.getElementById("castDiv").style="display:block";
		//document.getElementById("genderId").style="display:block";	
	}
	else
	{
		document.getElementById("dUnitAlert").value=55;
		//document.getElementById("castDiv").style='display:none';
		//document.getElementById("castValue").value='';
		//document.getElementById("genderId").style='display:none';
		//var elements = document.getElementById("gender").options;
		//for(var i = 0; i < elements.length; i++){
      		//elements[i].selected = false;
    	//}
	}
}

function displayCastOnSelected()
{
	document.getElementById("castDiv").style="display:block";
	document.getElementById("genderId").style="display:block";	
}

//for display registration in nursery
function displayRegistration(id)
{
	//alert(id.value);
	if(id.value==7)
	{
		document.getElementById("rDay").style="display:block";
		document.getElementById("rMonth").style="display:block";
		document.getElementById("rYear").style="display:block";	
	}
	else
	{
		document.getElementById("rDay").style='display:none';
		document.getElementById("rMonth").style='display:none';
		document.getElementById("rYear").style='display:none';
		var elements = document.getElementById("registeredDay").options;
		for(var i = 0; i < elements.length; i++){
      		elements[i].selected = false;
    	}
		var elements = document.getElementById("registeredMonth").options;
		for(var i = 0; i < elements.length; i++){
      		elements[i].selected = false;
    	}
		var elements = document.getElementById("registeredYear").options;
		for(var i = 0; i < elements.length; i++){
      		elements[i].selected = false;
    	}
	}
}
function displayRegistrationOnSelected()
{
	//alert("in");
	document.getElementById("rDay").style="display:block";
	document.getElementById("rMonth").style="display:block";
	document.getElementById("rYear").style="display:block";	
}

//for participant information entry
function participantEntry()
{
	//alert("g");
	var min_length = 0; // min caracters to display the autocomplete
	var pn = $('#pn').val();
	if((isNaN(pn) || pn=='')){ $('#participantNumber').html("[ numeric ]");}
	else
	{
		//alert(pn);
		if (pn.length >= min_length) {
			$.ajax({
				url: 'ajaxentry.php',
				type: 'POST',
				data: {pn:pn},
				success:function(data){
					$('#entryTr').show();
					//alert(pn);
					//$('#entry').html(data);
					document.getElementById("entry").innerHTML=data;
					$('#participantNumber').html(null);
					$('#pnError').css('display','none');
				}
			});
		} else {
			//$('#cropNameList').hide();
		}
		//return false;
	}
}

//for participant information entry
function entrySingle()
{
	//alert("g");
	var min_length = 0; // min caracters to display the autocomplete
	var pn = $('#pn').val();
	pn++;
	document.getElementById("pn").value=pn;
	document.getElementById("epn").value=pn;
	$.ajax({
		url: 'ajaxentrysingle.php',
		type: 'POST',
		data: {pn:pn},
		success:function(data){
			$('#entryTr').show();
			newLi = document.createElement("li");
			newLi.setAttribute("id","delete"+(pn-1));	
			newLi.innerHTML = data;
			document.getElementById("entrylist").appendChild(newLi);
		}
	});
}

//for deleting row
function deleteRow(id)
{
	var pn = $('#pn').val();
	pn--;
	document.getElementById("pn").value=pn;
	if (document.getElementById('epn'))
		document.getElementById("epn").value=pn;
	//alert(id);
	var element = document.getElementById(id);
	element.parentNode.removeChild(element);
	return false;
}

function deleteRowEdit(id,idEdit)
{
	var pn = $('#pn').val();
	pn--;
	document.getElementById("pn").value=pn;
	document.getElementById("epn").value=pn;
	//alert(id);
	var element = document.getElementById(id);
	element.parentNode.removeChild(element);
	
	$.ajax({
		url: 'ajaxdeleteentrysingle.php',
		type: 'POST',
		data: {id:idEdit},
		success:function(data){
			
		}
	});
	
	return false;
}

// for subsidy
function donationEntry()
{
	var min_length = 0; // min caracters to display the autocomplete
	var dn = $('#dn').val();
	var dUnitAlert=$('#dUnitAlert').val();
	//alert(dn);
	if((isNaN(dn) || dn=='')){ $('#donationNumber').html("[ numeric ]");}
	else
	{
		//alert(dn);
		if (dn.length >= min_length) {
			$.ajax({
				url: 'ajaxdonation.php',
				type: 'POST',
				data: {dn:dn,dUnitAlert:dUnitAlert},
				success:function(data){
					$('#entryTr').show();
					//alert(pn);
					//$('#entry').html(data);
					document.getElementById("entry").innerHTML=data;
					$('#donationNumber').html(null);
					$('#dnError').css('display','none');
				}
			});
		} else {
			//$('#cropNameList').hide();
		}
		//return false;
	}
}

//for participant information entry
function donationSingle()
{
	//alert("g");
	var min_length = 0; // min caracters to display the autocomplete
	var dn = $('#dn').val();
	dn++;
	var dUnitAlert=$('#dUnitAlert').val();
	document.getElementById("dn").value=dn;
	document.getElementById("edn").value=dn;
	$.ajax({
		url: 'ajaxdonationsingle.php',
		type: 'POST',
		data: {dn:dn,dUnitAlert:dUnitAlert},
		success:function(data){
			$('#entryTr').show();
			newLi = document.createElement("li");
			newLi.setAttribute("id","delete"+(dn-1));	
			newLi.innerHTML = data;
			document.getElementById("entrylist").appendChild(newLi);
		}
	});
}

//for deleting row
function deleteRowDonation(id)
{
	var dn = $('#dn').val();
	dn--;
	document.getElementById("dn").value=dn;
	if(document.getElementById('edn'))
		document.getElementById("edn").value=dn;
	//alert(id);
	var element = document.getElementById(id);
	element.parentNode.removeChild(element);
	return false;
}

function deleteRowEditDonation(id,idEdit)
{
	var dn = $('#dn').val();
	dn--;
	document.getElementById("dn").value=dn;
	document.getElementById("edn").value=dn;
	//alert(id);
	var element = document.getElementById(id);
	element.parentNode.removeChild(element);
	
	$.ajax({
		url: 'ajaxdeletedonationsingle.php',
		type: 'POST',
		data: {id:idEdit},
		success:function(data){
			
		}
	});
	
	return false;
}

function disableDistrict(id,district)
{
	//alert(id.value);
	if(id.value!=district)
	{
		$("#dist").find('option:selected').removeAttr("selected");
		$('#hidedist').hide();
		//$('#dist').attr('disabled', 'disabled');	
	}
	else
	{
		$('#hidedist').show();
		//$('#dist').removeAttr('disabled');
	}
}

function changeVarietyCrop(box)
{
	location.href = "cropvariety.php?cropId=" + box.value;	
}