<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <script src="client.js" type="text/javascript"></script>
</head>
<body>
<a href="javascript:sendGet('switch')">GET</a><br>
<a href="javascript:sendGet('switch', 'id=w1')">GET ID</a><br>
<a href="javascript:sendPost('switch', 'json={shortId:w1, state:1}')">POST</a><br>
<a href="javascript:switchSwitch('w1', 0)">PUT</a><br>

</body>
</html>

