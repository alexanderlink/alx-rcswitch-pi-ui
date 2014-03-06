<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  
  <meta name="viewport" content="width=device-width, user-scalable=yes">
  <!--meta name="viewport" content="initial-scale=1.0, user-scalable=yes"-->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
  <script src="libs/iphone-style-checkboxes/jquery/iphone-style-checkboxes.js" type="text/javascript" charset="utf-8"></script>
  <script src="client.js" type="text/javascript"></script>

  <link rel="stylesheet" href="libs/iphone-style-checkboxes/style.css" type="text/css" media="screen" charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css">

  <style type="text/css">
    body {
      padding: 10px; }
    th {
      text-align: right;
      padding: 4px;
      padding-right: 15px;
      vertical-align: top; }
    .css_sized_container .iPhoneCheckContainer {
      width: 500px; }
  </style>
  
  <script language="javascript">

  function setStatusImage(shortId, status) {
    log("setStatusImage", "id:"+shortId+", status:"+status);
    var checked = ""
    if (status == 2) checked = "led_yellow.png"
    if (status == 1) checked = "led_green.png"
    if (status == 0) checked = "led_red.png"
    $('#'+shortId+"_status").attr("src", "images/"+checked);
    if(status == 1 || status == 0) {
  	//onchange_checkbox.prop('checked', !onchange_checkbox.is(':checked')).iphoneStyle("refresh");
	  var toggle = $('#'+shortId);
	  var toggleState = toggle.is(':checked');
	  if(status == 1 && !toggleState) {
  	    toggle.prop("checked", true).iphoneStyle("refresh");
	  } 
	  if(status == 0 && toggleState) {
	    toggle.prop("checked", false).iphoneStyle("refresh");
	  }
    }
  }
  
  function switchSwitched(switchJson){
    log("switchSwitched", switchJson);
    var sw = JSON.parse(switchJson);
    setStatusImage(sw.shortId, sw.state);
  }

  function renderSwitch(sw) {
    log("renderSwitch", sw);
	$("#switchTable").append(
	"<tr><td>"+
	"<img src='images/"+sw.room+".png'/>"+
	"</td><td class='title' style='vertical-align:middle'>"+
	"<label style='vertical-align:middle' for='"+sw.shortId+"'>"+sw.name+"</label>"+
	"</td><td>"+
	"<img id='"+sw.shortId+"_status' src='images/led_yellow.png'/>"+
	"</td><td style='padding-right:10px; vertical-align:middle'>"+
	"<input type='checkbox' id='"+sw.shortId+"'/>"+
	"</td></tr>"
	);
	enableIPhoneStyle(sw.shortId);
	setStatusImage(sw.shortId, sw.state);
  }
  
  function renderSwitches() {
    log("renderSwitches");
	sendGet("switch", "", function(xmlhttp) {
		log("renderSwitches", xmlhttp.responseText);
		var switches = JSON.parse(xmlhttp.responseText);
		jQuery.each(switches, function(i, val) { renderSwitch(val); });
    });
  }
  
  function renderAutomation(auto) {
    log("renderAutomation", auto);
	$("#automationRow").append("<td><a class='button' href='javascript:xxx()'>"+auto.name+"</a></td>");
  }
  
  function renderAutomations() {
    log("renderAutomations");
	sendGet("switchAutomation", "", function(xmlhttp) {
		log("renderAutomations", xmlhttp.responseText);
		$("#switchTable").append("<tr><td colspan='4' align='center'><table><tr id='automationRow'></tr></table></td></tr>");
		var switches = JSON.parse(xmlhttp.responseText);
		jQuery.each(switches, function(i, val) { renderAutomation(val); });
    });
  }
  
  $(document).ready(function() {
    log("ready");
	renderAutomations();
    renderSwitches();
  });

  </script>
  
</head>
<body>

<table id="switchTable">
</table>

</body>
</html>
