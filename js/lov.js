function selectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}

function isNumeric(value) {
  if (value == null || !value.toString().match(/^[-]?\d*\.?\d*$/)) return false;
  return true;
}

function clickReturn(retVal) {
	var nilai = null;
	
	strObj = document.getElementById('OBJ').value;
	strForm = document.getElementById('FORM').value;
	arrVal = retVal.split('#~#');
	arrForm = strObj.split(',');
	for (x=0;x<arrForm.length;x++) {
		window.opener.document.getElementById(strForm+arrForm[x]).value = new String(arrVal[x]);
		if (window.opener.document.getElementById(strForm+arrForm[x]).value == 'undefined') {
			window.opener.document.getElementById(strForm+arrForm[x]).value = '';
		}
	}
	window.close();
}

function popup(url) 
{
	params  = 'width='+screen.width;
	params += ', height='+screen.height;
	params += ', top=0, left=0'
	params += ', fullscreen=yes';
	
	newwin=window.open(url,'windowname4', params);
	if (window.focus) {newwin.focus()}
		return false;
}

function getFrom_LOV(formName,fieldList,LOV_NM)
{
	arrLOV = LOV_NM.split("?");
	window.open("../lov/"+arrLOV[0]+"?FORM="+formName+"&OBJ="+fieldList+"&"+arrLOV[1],"LOV","width=600,height=500,toolbar=no,scrollbars=yes,resizable=yes");
}

function inputcek(inpstr) {
	var textArr = inpstr.split(',');
	var i;
	var res = true;
	for (i = 0; i<textArr.length; i+=2) {
		if (document.getElementById(textArr[i]) != null) {
			if (document.getElementById(textArr[i]).value == "" || document.getElementById(textArr[i]).value == null) {
				alert(textArr[i+1]+' Tidak Boleh Kosong');
				document.getElementById(textArr[i]).focus();
				res = false;
				break;
			}
		} else {
			alert('ERROR!!!! element '+textArr[i]+' is null');
			res = false;
			break;
		}
	}
	return res;
}