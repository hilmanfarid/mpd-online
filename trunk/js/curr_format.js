
function checkNum(data) {      // checks if all characters 
var valid = "0123456789.";     // are valid numbers or a "."
var ok = 1; var checktemp;
for (var i=0; i<data.length; i++) {
checktemp = "" + data.substring(i, i+1);
if (valid.indexOf(checktemp) == "-1") return 0; }
return 1;
}
function CurrAmount(form, field) { // idea by David Turley
Num = "" + eval("document." + form + "." + field + ".value");
dec = Num.indexOf(".");
end = ((dec > -1) ? "" + Num.substring(dec,Num.length) : ".00");
Num = "" + parseInt(Num);
var temp1 = "";
var temp2 = "";
if (checkNum(Num) == 0) {
alert("This does not appear to be a valid number.  Please try again.");
}
else { 
if (end.length == 2) end += "0";
if (end.length == 1) end += "00";
if (end == "") end += ".00";
var count = 0;
for (var k = Num.length-1; k >= 0; k--) {
var oneChar = Num.charAt(k);
if (count == 3) {
temp1 += ",";
temp1 += oneChar;
count = 1;
continue;
}
else {
temp1 += oneChar;
count ++;
}
}
for (var k = temp1.length-1; k >= 0; k--) {
var oneChar = temp1.charAt(k);
temp2 += oneChar;
}
temp2 = temp2 + end;
eval("document." + form + "." + field + ".value = '" + temp2 + "';");
}
}
