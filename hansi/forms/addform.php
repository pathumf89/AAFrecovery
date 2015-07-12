<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../ui/js/jquery.min.js"></script>
<script type="text/javascript">

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
    $( "#data" ).append( html );
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
}

</script>
</head>

<body>
<form action="" method="post" name="form1" id="form1">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">FormCode:</td>
      <td><input type="text" name="FormCode" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Heading:</td>
      <td><input type="text" name="Heading" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">SubHeading1:</td>
      <td><input type="text" name="SubHeading1" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">SubHeading2:</td>
      <td><input type="text" name="SubHeading2" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Description:</td>
      <td><input type="text" name="Description" value="" size="32" /></td>
    </tr>
  </table>

  <p>
    <input name="input" type="button" onclick="addRow()" value="Add New Row"/>
  </p>
  <table id="data" border="1">
        <tr>
      <th>Category 
        </td>
        <input id="newCat" type="button" onclick="fnnewCat()" value="+" disabled="disabled"/>
      <th>SubCat1
        <input id="newSubCat1" type="button" onclick="fnnewSubCat1()" value="+" disabled="disabled"/></th>
      <th>SubCat2
        <input id="newSubCat2" type="button" onclick="fnnewSubCat2()" value="+" disabled="disabled"/></th>
      <th>SubCat3
        <input id="newSubCat3" type="button" onclick="fnnewSubCat3()" value="+" disabled="disabled"/></th>
      <th>SubCat4
        <input id="newSubCat4" type="button" onclick="fnnewSubCat4()" value="+" disabled="disabled"/></th>
      <th>SubCat5</th>
      <th>Description</th>
      <th>isTotal</th>
      <th>Min</th>
      <th>Max</th>
  </tr>
   </table>
</form>
<p>&nbsp;</p>
</body>
</html>
