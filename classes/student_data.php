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

        // Graph header.
	    for ($i = 0; $i < $contador_temp; $i++) {
	    	$this->subheader[] = (object) array('halfmonth' => 'Q1');
	    	$this->subheader[] = (object) array('halfmonth' => 'Q2');
	    }

        // Behaviour data.
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 20);
		$this->behaviourindicator2[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 20);
		$this->behaviourindicator3[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->behaviourindicator4[] = (object) array('value' => $value);
	    }

        // Social data.
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->socialindicator2[] = (object) array('value' => $value);
	    }
	    for ($i = 0; $i < ($contador_temp*2); $i++) {
	    	$value = rand(0, 10);
		$this->socialindicator3[] = (object) array('value' => $value);
	    }
	    foreach ($this->socialindicator2 AS $index => $value) {
            $this->socialindicator1[] = (object) array('value' => 1);
        }

        // Cognitive data.
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

        // Dates.
	    $this->behaviourconditions[] = array('Term', get_string('Behaviour2', 'report_dropout'),
						        get_string('Behaviour3', 'report_dropout'),
						        get_string('Behaviour4', 'report_dropout'));
        $this->socialconditions[] = array('Term', get_string('Social1', 'report_dropout'),
		                        get_string('Social2', 'report_dropout'),
					            get_string('Social3', 'report_dropout'));
	    $this->cognitiveconditions[] = array('Term', get_string('Cognitive1', 'report_dropout'),
						        get_string('Cognitive2', 'report_dropout'),
					            get_string('Cognitive3', 'report_dropout'));
            
        // Table header.
        $date = date_create("2013-03-15");
        $enddate = date_create("2013-03-15");
        date_add($enddate,date_interval_create_from_date_string("13 days"));
        for ($i = 0; $i < ($contador_temp*2) ; $i++) {
            $dateinterval = date_format($date,"d/m") . "\n" . date_format($enddate, "d/m");
            $this->behaviourconditions[] = array($dateinterval, $this->behaviourindicator2[$i]->value,  $this->behaviourindicator3[$i]->value,  $this->behaviourindicator4[$i]->value);
            $this->socialconditions[] = array($dateinterval, $this->socialindicator1[$i]->value,  $this->socialindicator2[$i]->value,  $this->socialindicator3[$i]->value);
            $this->cognitiveconditions[] = array($dateinterval, $this->cognitiveindicator1[$i]->value, $this->cognitiveindicator2[$i]->value,  $this->cognitiveindicator3[$i]->value);
            date_add($date,date_interval_create_from_date_string("14 days"));
            date_add($enddate,date_interval_create_from_date_string("14 days"));
        }

        // Table data for each line.
	    $this->allconditions[] = array_column($this->behaviourconditions, 0);
	    foreach($this->allconditions[0] AS $x => $y) {
            $this->allconditions[0][$x] = str_replace("\n", "<BR>", $y);
        }
	    $this->allconditions[0][$i+1] = "Risco parcial";
            $this->allconditions[0][0] = get_string('indicators', 'report_dropout');
	    $index = 1;
	    for($j = 1; $j < 4; $j++) {
            $this->allconditions[] = array_column($this->behaviourconditions, $j);
            $this->allconditions[$index][$i+1] = 
	        $this->get_behaviour_risk($j+1, array_sum(array_slice($this->allconditions[$index], 1)), $i);
		    $index++;
        }
        for($j = 1; $j < 4; $j++) {	    
            $this->allconditions[] = array_column($this->socialconditions, $j);
            $this->allconditions[$index++][$i+1] = 0;
        }
        for($j = 1; $j < 4; $j++) {
            $this->allconditions[] = array_column($this->cognitiveconditions, $j);
            $partial = array_sum(array_slice($this->allconditions[$index], 1)) / $i / 2;
            $this->allconditions[$index++][$i+1] = (int)$partial;
        } 
    }


    private function get_behaviour_risk($behaviourid, $sum, $numberoffortnights) {
        switch($behaviourid) {
            case 1: return $this->get_behaviour1_risk($sum, $numberoffortnights);
            case 2: return $this->get_behaviour2_risk($sum, $numberoffortnights);
            case 3: return $this->get_behaviour3_risk($sum, $numberoffortnights);
            case 4: return $this->get_behaviour4_risk($sum, $numberoffortnights);
        }
    }

    // Os métodos a seguir serão subsituídos após a mineração.
    private function get_behaviour1_risk($sum, $numberoffortnights) {
        $avarage = $sum / $numberoffortnights;
        if($avarage >= 7) {
            return '<span class="badge badge-primary">' . get_string('lowrisk', 'report_dropout') . '</span>';
        } else if($avarage >= 5) {
            return '<span class="badge badge-secondary">' . get_string('mediumrisk', 'report_dropout') . '</span>';
        } else if($avarage >= 3) {
            return '<span class="badge badge-warning">' . get_string('highrisk', 'report_dropout') . '</span>'; 
        } else {
            return '<span class="badge badge-danger">' . get_string('veryhighrisk', 'report_dropout') . '</span>';
        }
    }


    private function get_behaviour2_risk($sum, $numberoffortnights) {
        $avarage = $sum / $numberoffortnights;
        if($avarage >= 7) {
            return '<span class="badge badge-primary">' . get_string('lowrisk', 'report_dropout') . '</span>';
        } else if($avarage >= 5) {
            return '<span class="badge badge-secondary">' . get_string('mediumrisk', 'report_dropout') . '</span>';
        } else if($avarage >= 3) {
            return '<span class="badge badge-warning">' . get_string('highrisk', 'report_dropout') . '</span>'; 
        } else {
            return '<span class="badge badge-danger">' . get_string('veryhighrisk', 'report_dropout') . '</span>';
        }
    }


    private function get_behaviour3_risk($sum, $numberoffortnights) {
        $avarage = $sum / $numberoffortnights;
        if($avarage >= 7) {
            return '<span class="badge badge-primary">' . get_string('lowrisk', 'report_dropout') . '</span>';
        } else if($avarage >= 5) {
            return '<span class="badge badge-secondary">' . get_string('mediumrisk', 'report_dropout') . '</span>';
        } else if($avarage >= 3) {
            return '<span class="badge badge-warning">' . get_string('highrisk', 'report_dropout') . '</span>'; 
        } else {
            return '<span class="badge badge-danger">' . get_string('veryhighrisk', 'report_dropout') . '</span>';
        }
    }

    
    private function get_behaviour4_risk($sum, $numberoffortnights) {
        $avarage = $sum / $numberoffortnights;
        if($avarage >= 7) {
            return '<span class="badge badge-primary">' . get_string('lowrisk', 'report_dropout') . '</span>';
        } else if($avarage >= 5) {
            return '<span class="badge badge-secondary">' . get_string('mediumrisk', 'report_dropout') . '</span>';
        } else if($avarage >= 3) {
            return '<span class="badge badge-warning">' . get_string('highrisk', 'report_dropout') . '</span>'; 
        } else {
            return '<span class="badge badge-danger">' . get_string('veryhighrisk', 'report_dropout') . '</span>';
        }
    }
}
