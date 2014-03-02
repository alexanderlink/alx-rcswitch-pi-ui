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
    xmlhttp.open("GET","switch?method=GET", true);
    xmlhttp.send();
  } else if(method == "PUT") {
    //TODO: Using "PUT" results in confirmation popup in Firefox. Therefore using GET with parameters.
	var json = JSON.stringify({shortId:"w1", state:"1"});
    xmlhttp.open("GET","switch?method=PUT&json="+encodeURI(json), true);
    xmlhttp.setRequestHeader("Content-type","application/json");
    xmlhttp.send();
  } else if(method == "POST") {
    //TODO: Using "POST" does not work! Result is GET with empty content! Therefore using GET with parameters.
	var json = JSON.stringify({shortId:"w1", state:"1"});
    xmlhttp.open("GET", "switch?method=POST&json="+encodeURI(json), true);
    xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xmlhttp.send();
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

