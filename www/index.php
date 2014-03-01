<?php
/* The MIT License (MIT)

Copyright (c) 2014 Alexander Link

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE. */


include 'classes.php.inc';
include 'config.php.inc';

$switches =array();
foreach ($switchList as $i => $powerSwitch) {
	$switches[$powerSwitch->shortId] = $powerSwitch;
}

if(isset($_GET["shortId"])) $shortId = $_GET["shortId"];
if(isset($_GET["homecode"])) $homecode = $_GET["homecode"];
if(isset($_GET["groupcode"])) $groupcode = $_GET["groupcode"];
if(isset($_GET["devicecode"])) $devicecode = $_GET["devicecode"];
if(isset($_GET["command"])) $command = $_GET["command"];
$result = "";


function switchPowerSwitch($powerSwitch, $command) {
  if(isset($powerSwitch->groupcode)) {
    $result = shell_exec("sudo /home/pi/rcswitch-pi/send  ".$powerSwitch->homecode." ".$powerSwitch->groupcode." ".$powerSwitch->devicecode." ".$command." 2>&1");
  } else {
    $result = shell_exec("sudo /home/pi/rcswitch-pi/send  ".$powerSwitch->homecode." ".$powerSwitch->devicecode." ".$command." 2>&1");
  }
  shell_exec("echo ".$command." > ".$powerSwitch->shortId);
  return $result;
}

function getStatus($shortId) {
  return shell_exec("cat ".$shortId);
}

if(isset($groupcode)) {
  echo switchPowerSwitch(PowerSwitch::newIntertechno("xx", "xx", $homecode, $groupcode, $devicecode), $command);
} else if(isset($homecode)) {
  echo switchPowerSwitch(PowerSwitch::newDIP("xx", "xx", $homecode, $devicecode), $command);
} else if(isset($shortId) && isset($command)) {
  echo switchPowerSwitch($switches[$shortId], $command);
} else if(isset($shortId)) {
  echo getStatus($shortId);
} else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  
  <meta name="viewport" content="width=device-width, user-scalable=yes">
  <!--meta name="viewport" content="initial-scale=1.0, user-scalable=yes"-->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
  <script src="libs/iphone-style-checkboxes/jquery/iphone-style-checkboxes.js" type="text/javascript" charset="utf-8"></script>

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

var waitingForAjax = false;
var switches = new Array("w1", "s1", "s2", "w3", "k1", "w2");

function sendGet(url, shortId) {
  setStatusImage(shortId, 2);
  waitingForAjax = true;
  var xmlhttp;
if (window.XMLHttpRequest)
    xmlhttp = new XMLHttpRequest();
else
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

xmlhttp.onreadystatechange = function() {
    $('#notice').replaceWith('<div id="notice" class="notice">'+xmlhttp.responseText+'</div>');
	if(xmlhttp.readyState == 4) {
	    waitingForAjax = false;
		updateStatus(shortId);
	}
}
xmlhttp.open('GET',url, true);
xmlhttp.send();
}

function sendGetByShortId(shortId, value) {
  var command = value == true ? 1 : 0;
  sendGet("?shortId="+shortId+"&command="+command, shortId);
}

function schalte(shortId, command, timeout) {
  setTimeout("sendGet('?shortId="+shortId+"&command="+command+"', '"+shortId+"')", timeout);
}

function updateStatuses() {
  for( var i=0; i<switches.length; i++ ) {
    var shortId = switches[ i ];
    updateStatus(shortId);
  }
}

function updateStatus(shortId) {
  var xmlhttp2;
  if (window.XMLHttpRequest)
    xmlhttp2 = new XMLHttpRequest();
  else
    xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp2.onreadystatechange = function() {
    if(xmlhttp2.readyState == 4) {
	  var status = xmlhttp2.responseText;
	  setStatusImage(shortId, status);
	}
  }
  xmlhttp2.open('GET',"?shortId="+shortId, true);
  xmlhttp2.send();
}

function setStatusImage(shortId, status) {
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

var sleep = 1000;

//TODO: make this configurable
function actionVorSchlafen() {
  var timer = 0;
  schalte("s1", 1, timer+=sleep);
  schalte("s2", 1, timer+=sleep);
  schalte("w1", 0, timer+=sleep);
  schalte("w3", 0, timer+=sleep);
  schalte("k1", 0, timer+=sleep);
  schalte("w2", 0, timer+=sleep);
}

function actionSchlafen() {
  var timer = 0;
  schalte("s1", 0, timer+=sleep);
  schalte("s2", 1, timer+=sleep);
  schalte("w1", 0, timer+=sleep);
  schalte("w3", 0, timer+=sleep);
  schalte("k1", 0, timer+=sleep);
  schalte("w2", 0, timer+=sleep);
}

function actionAufstehen() {
  var timer = 0;
  schalte("s1", 0, timer+=sleep);
  schalte("s2", 0, timer+=sleep);
  schalte("w1", 0, timer+=sleep);
  schalte("w3", 0, timer+=sleep);
  schalte("k1", 0, timer+=sleep);
  schalte("w2", 0, timer+=sleep);
}

$(document).ready(function() {
  $(":checkbox").each(function(){
    //var id = $(this).attr("id");
    $(this).iphoneStyle({
        onChange: function(elem, value) { 
          sendGetByShortId(elem.attr("id"), value);
        }
      });
  });
  updateStatuses();
});

  </script>
  
</head>
<body>

<?
if(!file_exists("libs/")) {
  shell_exec("./downloadDependencies.sh 2>&1");
  if(!file_exists("libs/")) {
    echo "<b>Could not execute downloadDependencies.sh! Please <code>chmod +x</code>.</b><br>";
  }
}
?>

<table>

<!--tr><td colspan="2">
  <div id="notice">  </div>
</td></tr-->

<!-- TODO: configurable -->
<tr><td colspan="4" align="center">
  <table><tr><td>
	<a class="button" href="javascript:actionVorSchlafen()">Bed</a>
  </td><td>	
	<a class="button" href="javascript:actionSchlafen()">Sleep</a>
  </td><td>
    <a class="button" href="javascript:actionAufstehen()">All Off</a> 
  </td></tr></table>
</td></tr>

<?
foreach ($switches as $i => $powerSwitch) {
  $checked = shell_exec("cat ".$powerSwitch->shortId);
?>

<tr><td>
  <img src="images/<?=$powerSwitch->room?>.png"/>
</td><td class="title" style="vertical-align:middle">
  <label style="vertical-align:middle" for="<?=$powerSwitch->shortId?>"><?=$powerSwitch->name?></label>
</td><td>
  <img id="<?=$powerSwitch->shortId?>_status" src="images/led_yellow.png"/>
</td><td style="padding-right:10px; vertical-align:middle">
  <input type="checkbox" id="<?=$powerSwitch->shortId?>" <?= ($checked == 1) ? "checked='checked'" : ""?> />
</td></tr>

<?
}
?>

</table>

</body>
</html>

<?
  }
?>