<?php
// Standard GPL and phpdocs
namespace report_dropout;

class student_data {
    var $userid;
    var $header = array();
    var $subheader = array();
    var $behaviourcondition1 = array();
    var $behaviourcondition2 = array();
    var $behaviourcondition3 = array();
    var $behaviourcondition4 = array();
    var $socialcondition1 = array();
    var $socialcondition2 = array();
    var $socialcondition3 = array();
    var $socialcondition4 = array();
    var $cognitivecondition1 = array();
    var $cognitivecondition2 = array();
    var $cognitivecondition3 = array();

    public function __construct($userid) {
	    $contador_temp = 5;
	    $this->header[] = (object) array('month' => 'ago');
	    $this->header[] = (object) array('month' => 'set');
	    $this->header[] = (object) array('month' => 'out');
	    $this->header[] = (object) array('month' => 'nov');
	    $this->header[] = (object) array('month' => 'dez');
	    for ($i = 0; $i < $contador_temp; $i++) {
	    	$this->subheader[] = (object) array('halfmonth' => 'Q1');
	    	$this->subheader[] = (object) array('halfmonth' => 'Q2');
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->behaviourindicator1[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->behaviourindicator2[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->behaviourindicator3[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->behaviourindicator4[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->socialindicator1[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->socialindicator2[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->socialindicator3[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->socialindicator4[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->cognitiveindicator1[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->cognitiveindicator2[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->cognitiveindicator3[] = (object) array('value' => $value);
	    }
    }
}
