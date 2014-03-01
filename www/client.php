<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  
  <script language="javascript">
  
function send(method) {
  var xmlhttp;
  if (window.XMLHttpRequest)
    xmlhttp = new XMLHttpRequest();
  else
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4) {
		alert("JSON : "+xmlhttp.responseText);
		//var obj = JSON.parse(xmlhttp.responseText);
		//alert(obj);
		//alert(obj.w1.name);
	}
  }

  if(method == "GET") {
    xmlhttp.open("GET","http://raspi/switch", true);
    xmlhttp.send();
  } else if(method == "PUT") {
    xmlhttp.open("PUT","switch", true);
    xmlhttp.setRequestHeader("Content-type","application/json");
    xmlhttp.send(JSON.stringify({shortId:"w1", state:"1"}));
  } else if(method == "POST") {
    //TODO: Does not work! Result is GET with empty content!
    xmlhttp.open("POST", "http://raspi/switch", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xmlhttp.send(JSON.stringify({shortId:"w1", state:"1"}));
  }
}
  </script>
  
</head>
<body>

<a href="javascript:send('GET')">GET</a><br>
<a href="javascript:send('POST')">POST</a><br>
<a href="javascript:send('PUT')">PUT</a><br>

</body>
</html>

