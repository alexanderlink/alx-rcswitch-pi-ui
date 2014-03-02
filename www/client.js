function createRequest() {
  var xmlhttp;
  if (window.XMLHttpRequest)
    xmlhttp = new XMLHttpRequest();
  else
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  return xmlhttp;
}

function send(method, ready4Function, entity, params) {
  var xmlhttp = createRequest();
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4) {
	  ready4Function(xmlhttp);
	}
  }
  if(method == "GET") {
    xmlhttp.open("GET", entity + "?method=GET", true);
    xmlhttp.send();
  } else if(method == "PUT") {
    //TODO: Using "PUT" results in confirmation popup in Firefox. Therefore using GET with parameters.
    xmlhttp.open("GET", entity + "?method=PUT&"+encodeURI(params), true);
    xmlhttp.setRequestHeader("Content-type","application/json");
    xmlhttp.send();
  } else if(method == "POST") {
    //TODO: Using "POST" does not work! Result is GET with empty content! Therefore using GET with parameters.
    xmlhttp.open("GET", entity + "?method=POST&"+encodeURI(params), true);
    xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xmlhttp.send();
  }
}

function sendGet(entity, params) {
  var funct = function(xmlhttp) {
  		alert("JSON : "+xmlhttp.responseText);
		//var obj = JSON.parse(xmlhttp.responseText);
		//alert(obj);
		//alert(obj.w1.name);
  }
  send("GET", funct, entity, params);
}

function sendPost(entity, params) {
  var funct = function(xmlhttp) {
  		alert("Post : "+xmlhttp.responseText);
  };
  send("POST", funct, entity, params);
}

function sendPut(entity, params) {
  var funct = function(xmlhttp) {
  		alert("PUT : "+xmlhttp.responseText);
  };
  send("PUT", funct, entity, params);
}

function switchSwitch(shortId, state) {
  var funct = function(xmlhttp) {
  		alert("Switch response : "+xmlhttp.responseText);
  };
  var json = JSON.stringify({shortId:"w1", state:"1"});
  send("PUT", funct, "switch", "json="+json);
}