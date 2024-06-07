<?php
// Standard GPL and phpdocs
namespace report_dropout;

class student_data
{
    public $userid;
    public $behaviourconditions = array();
    public $behaviourcondition4 = array();
    public $socialconditions = array();
    public $cognitiveconditions = array();
    public $behaviourtable = array();
    public $socialtable = array();
    public $cognitivetable = array();


    public function __construct($userid)
    {
        $this->userid = $userid;

        $contador_temp = 5;
        // Behaviour data.
        for ($i = 0; $i < ($contador_temp * 2); $i++) {
            $value = rand(0, 10);
            $this->behaviourindicator2[] = (object)array('value' => $value);
        }
        for ($i = 0; $i < ($contador_temp * 2); $i++) {
            $value = rand(0, 15);
            $this->behaviourindicator3[] = (object)array('value' => $value);
        }
        for ($i = 0; $i < ($contador_temp * 2); $i++) {
            $value = rand(0, 100);
            $this->behaviourindicator4[] = (object)array('value' => (float)$value/100);
        }

        // Social data.
        for ($i = 0; $i < ($contador_temp * 2); $i++) {
            $value = rand(0, 10);
            $this->socialindicator2[] = (object)array('value' => $value);
        }
        for ($i = 0; $i < ($contador_temp * 2); $i++) {
            $value = rand(0, 10);
            $this->socialindicator3[] = (object)array('value' => $value);
        }
        foreach ($this->socialindicator2 as $index => $value) {
            $this->socialindicator1[] = (object)array('value' => $value->value + $this->socialindicator3[$index]->value);
        }

        // Cognitive data.
        $numberofgrades = 6;
        for ($i = 0; $i < $numberofgrades; $i++) {
            $value = rand(0, 100);
            $this->cognitiveindicator1[] = (object)array('value' => (float)$value/10);
        }

        // Graph lines/bars.
        $this->behaviourconditions[] = array('Term', get_string('Behaviour2', 'report_dropout'),
            get_string('Behaviour3', 'report_dropout'));
        $this->behaviourcondition4[] = array('Term', get_string('Behaviour4', 'report_dropout') . '(%)');
        $this->socialconditions[] = array('Term', get_string('Social1', 'report_dropout'),
            get_string('Social2', 'report_dropout'),
            get_string('Social3', 'report_dropout'));
        $this->cognitiveconditions[] = array('Term', get_string('Cognitive3', 'report_dropout'));

        // Table header.
        $date = date_create("2013-03-15");
        $enddate = date_create("2013-03-15");
        date_add($enddate, date_interval_create_from_date_string("13 days"));
        for ($i = 0; $i < ($contador_temp * 2); $i++) {
            $dateinterval = date_format($date, "d/m") . "\n" . date_format($enddate, "d/m");
            $this->behaviourconditions[] = array($dateinterval, $this->behaviourindicator2[$i]->value,
                $this->behaviourindicator3[$i]->value);
            $this->behaviourcondition4[] = array($dateinterval, $this->behaviourindicator4[$i]->value);
            $this->socialconditions[] = array($dateinterval, $this->socialindicator1[$i]->value,
                $this->socialindicator2[$i]->value, $this->socialindicator3[$i]->value);
            date_add($date, date_interval_create_from_date_string("14 days"));
            date_add($enddate, date_interval_create_from_date_string("14 days"));
        }
        for ($column = 0; $column < $numberofgrades; $column++) {
            $this->cognitiveconditions[] = array($column, $this->cognitiveindicator1[$column]->value);
        }


        // Table data for each line.
        $allconditions = array();

        $allconditions[] = array_column($this->behaviourconditions, 0);
        foreach ($allconditions[0] as $x => $y) {
            $allconditions[0][$x] = str_replace("\n", "<BR>", $y);
        }

        $allconditions[0][0] = get_string('indicators', 'report_dropout');
        $index = 1;

        //Create behaviour table
        $this->behaviourtable[0] = $allconditions[0];
        for ($row = 1; $row < 3; $row++) {
            $this->behaviourtable[] = array_column($this->behaviourconditions, $row);
        }
        $this->behaviourtable[] = array_column($this->behaviourcondition4, 1);
        for($index = 1; $index < $i+1 ; $index++) {
            $this->behaviourtable[$row][$index] = $this->behaviourtable[$row][$index] * 100;
        }
        $this->behaviourtable[0][0] = get_string('behaviourindicators', 'report_dropout') . '<br>' .
            $this->get_behaviour_risk($behaviourtable, $row + 1);

        $allconditions[0][$i + 1] = "Risco parcial";
        $this->socialtable[0] = $allconditions[0];
        $this->socialtable[0][0] = get_string('socialindicators', 'report_dropout');
        for ($row = 1; $row < 4; $row++) {
            $this->socialtable[] = array_column($this->socialconditions, $row);
            $this->socialtable[$row][$i + 1] =
                $this->get_social_risk($row, array_sum(array_slice($this->socialtable[$row], 1)), $i);
        }


        $this->cognitivetable[0][0] = get_string('cognitiveindicators', 'report_dropout');
        for ($column = 1; $column <= $numberofgrades; $column++) {
            $this->cognitivetable[0][$column] = '-';
        }
        $this->cognitivetable[0][$numberofgrades + 1] = 'Risco parcial';
        for ($row = 1; $row < 2; $row++) {
            $this->cognitivetable[] = array_column($this->cognitiveconditions, $row);
            $this->cognitivetable[$row][$numberofgrades + 1] =
                $this->get_cognitive_risk($row, array_sum(array_slice($this->cognitivetable[$row], 1)), $numberofgrades);
        }
    }


    private function get_behaviour_risk($table, $numberoffortnights)
    {
        $behaviour2sum = array_sum(array_slice($this->behaviourtable[1], 1));
        $behaviour3sum = array_sum(array_slice($this->behaviourtable[2], 1));
        $behaviour4sum = array_sum(array_slice($this->behaviourtable[3], 1));
        echo $behaviour2sum . "<br>" . $numberoffortnights; exit;
        $avarage = $behaviour2sum / $numberoffortnights;
        if ($avarage >= 7) {
            return '<span class="badge badge-primary">' . get_string('lowrisk', 'report_dropout') . '</span>';
        } else if ($avarage >= 5) {
            return '<span class="badge badge-secondary">' . get_string('mediumrisk', 'report_dropout') . '</span>';
        } else if ($avarage >= 3) {
            return '<span class="badge badge-warning">' . get_string('highrisk', 'report_dropout') . '</span>';
        } else {
            return '<span class="badge badge-danger">' . get_string('veryhighrisk', 'report_dropout') . '</span>';
        }
    }


    private function get_social_risk($behaviourid, $sum, $numberoffortnights)
    {
        switch ($behaviourid) {
            case 1:
                return $this->get_social1_risk($sum, $numberoffortnights);
            case 2:
                return '-';
            case 3:
                return '-';
        }
    }

    // Os métodos a seguir serão subsituídos após a mineração.
    private function get_social1_risk($sum, $numberoffortnights)
    {
        $avarage = $sum / $numberoffortnights;
        if ($avarage >= 3) {
            return '<span class="badge badge-primary">' . get_string('lowrisk', 'report_dropout') . '</span>';
        } else if ($avarage >= 2) {
            return '<span class="badge badge-secondary">' . get_string('mediumrisk', 'report_dropout') . '</span>';
        } else if ($avarage >= 1) {
            return '<span class="badge badge-warning">' . get_string('highrisk', 'report_dropout') . '</span>';
        } else {
            return '<span class="badge badge-danger">' . get_string('veryhighrisk', 'report_dropout') . '</span>';
        }
    }


    private function get_cognitive_risk($cognitiveid, $sum, $numberofgrades)
    {
        $avarage = $sum / $numberofgrades;
        if ($avarage >= 7) {
            return '<span class="badge badge-primary">' . get_string('lowrisk', 'report_dropout') . '</span>';
        } else if ($avarage >= 5) {
            return '<span class="badge badge-secondary">' . get_string('mediumrisk', 'report_dropout') . '</span>';
        } else if ($avarage >= 2) {
            return '<span class="badge badge-warning">' . get_string('highrisk', 'report_dropout') . '</span>';
        } else {
            return '<span class="badge badge-danger">' . get_string('veryhighrisk', 'report_dropout') . '</span>';
        }
    }


}
