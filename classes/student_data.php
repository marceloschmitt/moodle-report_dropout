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
    var $cognitivecondition1 = array();
    var $cognitivecondition2 = array();
    var $cognitivecondition3 = array();

    var $behaviourconditions = array();
    var $socialconditions = array();
    var $congnitiveconditions = array();
    var $allconditions = array();
	
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
	    $this->behaviourconditions[] = array('Term', get_string('Behaviour1', 'report_dropout'),
						         get_string('Behaviour2', 'report_dropout'),
						         get_string('Behaviour3', 'report_dropout'),
						         get_string('Behaviour4', 'report_dropout'));
            $this->socialconditions[] = array('Term', get_string('Social1', 'report_dropout'),
						      get_string('Social2', 'report_dropout'),
					              get_string('Social3', 'report_dropout'));
	    $this->cognitiveconditions[] = array('Term', get_string('Cognitive1', 'report_dropout'),
						         get_string('Cognitive2', 'report_dropout'),
					                 get_string('Cognitive3', 'report_dropout'));
            $date = date_create("2013-03-15");
            $enddate = date_create("2013-03-15");
            date_add($enddate,date_interval_create_from_date_string("13 days"));
            for ($i = 0, $j=1 ; $i < ($contador_temp*2) ; $i++, $j++) {
                $dateinterval = date_format($date,"d/m") . "\n" . date_format($enddate, "d/m");
                $this->behaviourconditions[] = array($dateinterval, $this->behaviourindicator1[$i]->value,  $this->behaviourindicator2[$i]->value,  $this->behaviourindicator3[$i]->value,  $this->behaviourindicator4[$i]->value);
                $this->socialconditions[] = array($dateinterval, $this->socialindicator1[$i]->value,  $this->socialindicator2[$i]->value,  $this->socialindicator3[$i]->value);
                $this->cognitiveconditions[] = array($dateinterval, $this->cognitiveindicator1[$i]->value, $this->cognitiveindicator2[$i]->value,  $this->cognitiveindicator3[$i]->value);
                date_add($date,date_interval_create_from_date_string("14 days"));
                date_add($enddate,date_interval_create_from_date_string("14 days"));
            }
	    
	    $this->allconditions[] = array_column($this->behaviourconditions, 0);
	    foreach($this->allconditions[0] AS $x => $y) {
                    $this->allconditions[0][$x] = str_replace("\n", "<BR>", $y);
            }
	    $this->allconditions[0][10] = "Parcial";
            $this->allconditions[0][0] = "Conditions";
            $this->allconditions[] = array_column($this->behaviourconditions, 1);
            $this->allconditions[] = array_column($this->behaviourconditions, 2);
            $this->allconditions[] = array_column($this->behaviourconditions, 3);
            $this->allconditions[] = array_column($this->behaviourconditions, 4);
	    $this->allconditions[] = array_column($this->socialconditions, 1);
            $this->allconditions[] = array_column($this->socialconditions, 2);
            $this->allconditions[] = array_column($this->socialconditions, 3);
	    $this->allconditions[] = array_column($this->cognitiveconditions, 1);
            $this->allconditions[] = array_column($this->cognitiveconditions, 2);
            $this->allconditions[] = array_column($this->cognitiveconditions, 3);
          
    }
}
