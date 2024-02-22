<?php
// Standard GPL and phpdocs
namespace report_dropout;

class student_data {
    var $userid;
    var $header = array();
    var $behaviour1 = array();

    public function __construct($userid) {
        $header = array("AGO", "SET", "OUT", "NOV", "DEZ");
        $behaviour1 = array(9, 10, 5, 7, 8);
    }
}
