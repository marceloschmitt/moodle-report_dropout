<?php
// Standard GPL and phpdocs
namespace report_dropout\output;

use renderable;
use renderer_base;
use templatable;
use stdClass;

class index_page implements renderable, templatable
{
    private $courseid;
    private $students;

    public function __construct($courseid, $context)
    {
        $this->courseid = $courseid;
        $this->students = array_values(get_enrolled_users($context));
        foreach($this->students as $index => $value) {
            $risk = $this->compute_risk($this->students[$index]->userid, $courseid);
            $this->students[$index]->risk = get_string($risk, 'report_dropout');
            $this->students[$index]->riskclass = 'warning';
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
        return 'highrisk';
    }
}
