<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Settings and links
 *
 * @package    report_dropout
 * @copyright  2023 Schmitt; Ferro (IFRS)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_OUTPUT_BUFFERING', true);

require('../../config.php');
require('functions.php');
require_once($CFG->libdir.'/adminlib.php');

// Security.
$courseid = required_param('id', PARAM_INT);
$userid = required_param('userid', PARAM_INT);
require_login($courseid);
$context = context_course::instance($courseid);
require_capability('report/dropout:view', $context);
$course = get_course($courseid);
$studentname = $USER->firstname . " " . $USER->lastname;

// Get student data.
$studentdata = new \report_dropout\student_data($userid);
$lineChart = generate_charts($studentdata);

// Set $PAGE parameters.
$PAGE->set_url('/report/dropout/report.php', array('id' => $courseid, 'userid' => $userid));
$PAGE->set_pagelayout('standard');
$PAGE->set_title("report");
$PAGE->set_heading($course->fullname);

$output = $PAGE->get_renderer('report_dropout');
echo $output->header();
echo $output->heading(get_string('pluginname', 'report_dropout'));

$renderable = new \report_dropout\output\report_page($course, $lineChart, $studentname, $studentdata);
echo $output->render($renderable);
echo $output->footer();

// Log.
//$event = \report_dropout\event\report_viewed::create(['context' => context_system::instance()]);
//$event->trigger();
