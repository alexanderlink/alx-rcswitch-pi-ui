debug = false;
debugAreaCreated = false;
  
function log(functName, text) {
  if(!debug) return;
  if(!debugAreaCreated) {
    $("body").append("<textarea cols='160' rows='20' id='debug'></textarea>");
	debugAreaCreated = true;
  }
  var date = new Date();
  var time = date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
  if(typeof text === "undefined") {
    $("#debug").prepend(time+" - "+functName+"()\n");
  } else {
    $("#debug").prepend(time+" - "+functName+"() : "+text+"\n");
  }
}

function createRequest() {
  log("createRequest");
  var xmlhttp;
  if (window.XMLHttpRequest)
    xmlhttp = new XMLHttpRequest();
  else
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  return xmlhttp;
}

function send(method, ready4Function, entity, params) {
  log("send", method+", "+entity+", "+params);
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

function sendGet(entity, params, funct) {
  send("GET", funct, entity, params);
}

function sendPost(entity, params) {
  var funct = function(xmlhttp) {
    log("sendPost-result", entity+", "+params+": "+xmlhttp.responseText);
  };
  send("POST", funct, entity, params);
}

function sendPut(entity, params) {
  var funct = function(xmlhttp) {
    log("sendPut-result", entity+", "+params+": "+xmlhttp.responseText);
  };
  send("PUT", funct, entity, params);
}

function switchSwitch(shortId, state, funct) {
  log("switchSwitch", shortId+", "+state);
  setStatusImage(shortId, 2);
  var json = JSON.stringify({shortId:shortId, state:state});
  send("PUT", funct, "switch", "json="+json);
}

function enableIPhoneStyle(boxId) {
  $(":checkbox#"+boxId).iphoneStyle({
    onChange: function(elem, value) { 
      log("enableIPhoneStyles-trigger", elem+", "+value);
      switchSwitch(elem.attr("id"), (value == true ? 1 : 0), function(xmlhttp) { switchSwitched(xmlhttp.responseText); });
    }
  });
}