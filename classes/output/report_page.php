<?php
// Standard GPL and phpdocs
namespace report_dropout\output;

use renderable;
use renderer_base;
use templatable;
use stdClass;

class report_page implements renderable, templatable
{

    public function __construct($course, $script, $studentfullname, $risk)
    {
        $this->script = $script;
        $this->course = $course;
        $this->studentfullname = $studentfullname;
        $this->risk = $risk;

    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output)
    {
        $data = new stdClass();
        $data->coursename = $this->course->shortname;
        $data->coursestartdate = $this->course->startdate;
        $data->courseenddate = $this->course->enddate;
        $data->studentfullname = $this->studentfullname;
        $data->script = $this->script;
        // Titles of report_dropout template
        $data->programinformation = get_string('programinformation', 'report_dropout');
        $data->studentinformation = get_string('studentinformation', 'report_dropout');
        $data->graphs = get_string('graphs', 'report_dropout');
        $data->risk = get_string($this->risk, 'report_dropout');
        $data->riskclass = get_risk_class($this->risk);
        $data->studentname = get_string('studentname', 'report_dropout');
        $data->program = get_string('program', 'report_dropout');
        $data->class = get_string('class', 'report_dropout');
        $data->numberofterms = get_string('numberofterms', 'report_dropout');
        $data->situation = get_string('situation', 'report_dropout');
        $data->passedterms = get_string('passedterms', 'report_dropout');
        $data->triedcourses = get_string('triedcourses', 'report_dropout');
        $data->mandatorycourses = get_string('mandatorycourses', 'report_dropout');
        $data->nonmandatorycourses = get_string('nonmandatorycourses', 'report_dropout');
        $data->schedule = get_string('schedule', 'report_dropout');
        $data->notready = get_string('notready', 'report_dropout');
        return $data;
    }
}
