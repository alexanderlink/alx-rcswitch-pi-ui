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


$switchList = array(
  PowerSwitch::newDIP("w1", "Light", "livingroom", "00001", 1),
  PowerSwitch::newIntertechno("w3", "Printer/XBox", "livingroom", "b", 1, 3),
  PowerSwitch::newIntertechno("w2", "Couch", "livingroom", "b", 1, 2),
  PowerSwitch::newDIP("s1", "Light", "bedroom", "00001", 2),
  PowerSwitch::newDIP("s2", "Recharger", "bedroom", "00001", 3),
  PowerSwitch::newIntertechno("k1", "Water Boiler", "kitchen", "b", 1, 1)
);
  
?>