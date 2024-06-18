<?php
// Standard GPL and phpdocs
namespace report_dropout;

class student_data
{
    public $userid;
    public $programname = 'Curso Superior de Tecnologia em XYZ';
    public $classname = '2023/1';
    public $numberofterms = '6';

    public $behaviourconditions = array();
    public $behaviourcondition4 = array();
    public $socialconditions = array();
    public $cognitiveconditions = array();
    public $behaviourtable = array();
    public $socialtable = array();
    public $cognitivetable = array();


    public function __construct($userid,$risk)
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
        $numberofgrades = 4;
        for ($i = 0; $i < $numberofgrades; $i++) {
            $value = rand(0, 100);
            $this->cognitiveindicator1[] = (object)array('value' => (float)$value/10);
        }

        // Graph lines/bars.
        $this->behaviourconditions[] = array('Term', get_string('Behaviour2', 'report_dropout'),
            get_string('Behaviour3', 'report_dropout'));
        $this->behaviourcondition4[] = array('Term', get_string('Behaviour4', 'report_dropout') .  ' (%)');
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
            $this->cognitiveconditions[] = array('Prova ' . $column, $this->cognitiveindicator1[$column]->value);
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
        $this->behaviourtable[0][0] = get_string('behaviourindicators', 'report_dropout');

        $this->socialtable[0] = $allconditions[0];
        $this->socialtable[0][0] = get_string('socialindicators', 'report_dropout');
        for ($row = 1; $row < 4; $row++) {
            $this->socialtable[] = array_column($this->socialconditions, $row);
        }


        $this->cognitivetable[0][0] = get_string('cognitiveindicators', 'report_dropout');
        for ($column = 1; $column <= $numberofgrades; $column++) {
            $this->cognitivetable[0][$column] = '-';
        }
        for ($row = 1; $row < 2; $row++) {
            $this->cognitivetable[] = array_column($this->cognitiveconditions, $row);
        }
    }



}
