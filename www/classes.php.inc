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


class PowerSwitch
{
    public $shortId;
    public $name;
    public $room;
    public $homecode;
    public $groupcode;
	public $devicecode;
	public $state = 0;
	
	public function __construct() {
    }

    public static function newDIP($shortId, $title, $room, $homecode, $devicecode) {
		$instance = new self();
		$instance->shortId = $shortId;
		$instance->name = $title;
		$instance->room = $room;
		$instance->homecode = $homecode;
		$instance->groupcode = null;
		$instance->devicecode = $devicecode;
    	return $instance;
    }

    public static function newIntertechno($shortId, $title, $room, $sFamily, $nGroup, $nDevice) {
		$instance = new self();
		$instance->shortId = $shortId;
		$instance->name = $title;
		$instance->room = $room;
		$instance->homecode = $sFamily;
		$instance->groupcode = $nGroup;
		$instance->devicecode = $nDevice;
    	return $instance;
    }

}

class SwitchAutomation
{
	public $id;
	public $name;
	public $switchArray;
	public $stateArray;

	public function __construct() {
    }

    public static function newAutomation($id, $name, $switchArray, $stateArray) {
		$instance = new self();
		$instance->id = $id;
		$instance->name = $name;
		$instance->switchArray = $switchArray;
		$instance->stateArray = $stateArray;
    	return $instance;
    }


}

?>