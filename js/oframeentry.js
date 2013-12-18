if (window == top) top.location.href = "../index.php";

var timer = 800;

function countdown()
{
  if(timer > 0)
  {
    timer -= 1;
    setTimeout("countdown()",1000);
  }
  else
  {
    top.frmmenu.location.href= "../main/sip_logout.php?TIME="+(new Date()).getTime(); 
  }
}

function confirmdelete()
{
    var result;
    result = confirm("[Konfirmasi] :\nAnda yakin ingin menghapus record ini ?")
    return result;
}

function confirmSimpan()
{
    var result;
    result = confirm("[Konfirmasi] :\nAnda yakin ingin menyimpan data ini ?")
    return result;
}

function confirmAddBtn()
{
    var result;
    result = confirm("[Konfirmasi] :\nAnda ingin menambah record ?")
    return result;
}

function BukaWindow(urll)
{
		window.open(urll,"_","menubar=no,location=no,resizable=yes,scrollbars=yes,status=yes");
}

function bind_events() 
{

	if (this.document.getElementById('Delete')) {
		this.document.getElementById('Delete').onclick = confirmdelete;
	}
   
    if (this.document.getElementById('AddBtn')) {
		this.document.getElementById('AddBtn').onclick = confirmAddBtn;
	}
	
// 	if (this.document.all.Insert) {
// 		this.document.all.Insert.onclick = confirmSimpan;
// 	}
// 	
// 	if (this.document.all.Update) {
// 		this.document.all.Update.onclick = confirmSimpan;
// 	}
}

function forms_onloadd()
{
  var forms = document.forms;
  var i, j, elm, form;
  for(i = 0; i < forms.length; i++)
  {
    form = forms[i];
    if (typeof(form.onLoad) == "function") form.onLoad();
    for (j = 0; j < form.elements.length; j++)
    {
      elm = form.elements[j];
      if (typeof(elm.onLoad) == "function") elm.onLoad();
    }
  }
  return true;
}

countdown();

window.onload = bind_events; 
window.status = "[Versi 1.01-2006]";
