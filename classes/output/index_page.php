<?php
// Standard GPL and phpdocs
namespace report_dropout\output;                                                                                                         
                                                                                                                                    
use renderable;                                                                                                                     
use renderer_base;                                                                                                                  
use templatable;                                                                                                                    
use stdClass;                                                                                                                       
             
class index_page implements renderable, templatable {                                                                               
    var $courseid;
    var $students;
            
    public function __construct($context) {
        echo var_dump($context.instanceid()); exit;
        $this->courseid = 24;
        $this->students = array_values(get_enrolled_users($context));
    }
                                                                                                                            
    public function export_for_template(renderer_base $output) {                                                                    
        $data = new stdClass();
        $data->students = $this->students;
        $data->courseid = $this->courseid;                                                                                          
        return $data;                                                                                                               
    } 
}
