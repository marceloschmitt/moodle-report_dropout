<?php
// Standard GPL and phpdocs
namespace report_dropout\output;

defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

class renderer extends plugin_renderer_base
{

    public function render_index_page($page)
    {
        $data = $page->export_for_template($this);
        return parent::render_from_template('report_dropout/index_page', $data);
    }

    public function render_report1_page($page)
    {
        $data = $page->export_for_template($this);
        return parent::render_from_template('report_dropout/report1_page', $data);
    }
}
