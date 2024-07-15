<?php
// Standard GPL and phpdocs
namespace report_dropout\output;

use renderable;
use renderer_base;
use templatable;
use stdClass;

require_once('functions.php');

class index_page implements renderable, templatable
{
    private $courseid;
    private $students;

    public function __construct($courseid, $context)
    {
        $this->courseid = $courseid;
        $this->students = array_values(get_enrolled_users($context, 'moodle/course:isincompletionreports',
            0, 'u.*', 'firstname'));
        foreach($this->students as $index => $value) {
            $risk = $this->compute_risk($this->students[$index]->id, $courseid);
            $this->students[$index]->risk = $risk;
            $this->students[$index]->riskprint = get_string($risk, 'report_dropout');
            $this->students[$index]->riskclass = get_risk_class($risk);
            /* $this->students[$index]->firstname = "anonymous";
            $this->students[$index]->lastname = ""; */

        }
    }

    public function export_for_template(renderer_base $output)
    {
        $data = new stdClass();
        $data->students = $this->students;
        $data->courseid = $this->courseid;
        $data->noteady = get_string('notready', 'report_dropout');
        return $data;
    }

    private function compute_risk($userid, $courseid) {
        $risk[] = 'lowrisk';
        $risk[] = 'mediumrisk';
        $risk[] = 'highrisk';
        $risk[] = 'veryhighrisk';
        return $risk[rand(0, 3)];
    }
}
