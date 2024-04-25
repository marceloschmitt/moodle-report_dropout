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

    var $behaviourconditions = array();
    var $socialconditions = array();
    var $congnitiveconditions = array();
	
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
	    $this->behaviourconditions[] = array('Term', 'Behaviour1',  'Behaviour2', 'Behaviour3', 'Behaviour4');
            $this->socialconditions[] = array('Term', 'Social1',  'Social2', 'Social3', 'Social4');
            $this->cognitiveconditions[] = array('Term', 'Cognitive1',  'Cognitive2', 'Cognitive3');
            for ($i = 0 ; $i < ($contador_temp*2) ; $i++) {
                $this->behaviourconditions[] = array("P$i", $this->behaviourindicator1[$i]->value,  $this->behaviourindicator2[$i]->value,  $this->behaviourindicator3[$i]->value,  $this->behaviourindicator4[$i]->value);
                $this->socialconditions[] = array("P$i", $this->socialindicator1[$i]->value,  $this->socialindicator2[$i]->value,  $this->socialindicator3[$i]->value,  $this->socialindicator4[$i]->value);
                $this->cognitiveconditions[] = array("P$i", $this->cognitiveindicator1[$i]->value, $this->cognitiveindicator2[$i]->value,  $this->cognitiveindicator3[$i]->value);
	    }
    }
}
