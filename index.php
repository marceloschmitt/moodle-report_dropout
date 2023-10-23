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
require_once($CFG->libdir.'/adminlib.php');
$courseid = required_param('id', PARAM_INT);

/* Colocar depois o teste de capability */

/**
 * Set $PAGE parameters
 */
$PAGE->set_url('/report/dropout/index.php');
$PAGE->set_context(context_course::instance($courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Nome da disciplina');
$PAGE->set_heading(get_string('pluginname', 'report_dropout'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'report_dropout'));
echo "Aqui vão estar as informações";
echo $OUTPUT->footer();

$event = \report_dropout\event\report_viewed::create(['context' => context_system::instance()]);
$event->trigger();
