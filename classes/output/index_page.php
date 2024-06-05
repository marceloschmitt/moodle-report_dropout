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
            $this->students[$index]->risk = $this->compute_risk($this->students[$index]->userid, $courseid);
        }
    }

    public function export_for_template(renderer_base $output)
    {
        $data = new stdClass();
        $data->students = $this->students;
        $data->courseid = $this->courseid;
        return $data;
    }

    private function compute_risk($userid, $courseid) {
        return get_string('mediumrisk', 'report_dropout');
    }
}
