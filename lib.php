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

function report_dropout_extend_navigation_course($navigation, $course, $context)
{
    if (has_capability('report/dropout:view', $context)) {
        $url = new moodle_url('/report/dropout/index.php', array('id' => $course->id));
        $navigation->add(get_string('pluginname', 'report_dropout'), $url, navigation_node::TYPE_SETTING, null, null, new pix_icon('i/report', ''));
    }
}
