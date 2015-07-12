var MajorGroupId=1;
var SubGroupId1=0;
var SubGroupId2=0;
var SubGroupId3=0;
var SubGroupId4=0;
var SubGroupId5=0;

function optunlock()
{
	$("input").removeAttr('disabled');

}


function addRow()
{
$.ajax({
  url: "table.html",
  cache: false
})
  .done(function( html ) {
    $( "#fdcasformdata" ).append( html );
	$('input').each(function(){
  $(this).trigger('blur');
  optunlock();
  //each input event one by one... will be blured
})
  });
	
//$('#data').append($( "#template" ).html());
//$('#template').html();

}

function fnnewCat()
{
	MajorGroupId++;
	SubGroupId1=0;
	SubGroupId2=0;
	SubGroupId3=0;
	SubGroupId4=0;
	SubGroupId5=0;
	addRow();
}

function fnnewSubCat1()
{
	//MajorGroupId++;
	SubGroupId1++;
	SubGroupId2=0;
	SubGroupId3=0;
	SubGroupId4=0;
	SubGroupId5=0;
	addRow();
}
function fnnewSubCat2()
{
	//MajorGroupId++;
	//SubGroupId1++;
	SubGroupId2++;
	SubGroupId3=0;
	SubGroupId4=0;
	SubGroupId5=0;
	addRow();
}
function fnnewSubCat3()
{
	//MajorGroupId++;
	//SubGroupId1++;
	//SubGroupId2++;
	SubGroupId3++;
	SubGroupId4=0;
	SubGroupId5=0;
	addRow();
}
function fnnewSubCat4()
{
	//MajorGroupId++;
	//SubGroupId1++;
	//SubGroupId2++;
	//SubGroupId3=0;
	SubGroupId4++;
	SubGroupId5=0;
	addRow();
}


function MajorGroupIdfn(value)
{
	
	value.removeAttribute("onblur");
	return value.value=MajorGroupId;
}
function SubGroupId1fn(value)
{
	
	value.removeAttribute("onblur");
	return value.value=SubGroupId1;
}
function SubGroupId2fn(value)
{
	
	value.removeAttribute("onblur");
	return value.value=SubGroupId2;
}
function SubGroupId3fn(value)
{
	
	value.removeAttribute("onblur");
	return value.value=SubGroupId3;
}
function SubGroupId4fn(value)
{
	
	value.removeAttribute("onblur");
	return value.value=SubGroupId4;
}
function SubGroupId5fn(value)
{
	SubGroupId5++;
	value.removeAttribute("onblur");
	return value.value=SubGroupId5;
}// JavaScript Document