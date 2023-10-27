<?php
// Standard GPL and phpdocs
namespace report_dropout\output;                                                                                                         
                                                                                                                                    
use renderable;                                                                                                                     
use renderer_base;                                                                                                                  
use templatable;                                                                                                                    
use stdClass;                                                                                                                       
             
class index_page implements renderable, templatable {                                                                               
    var $sometext = null;
    var $students;
            
    public function __construct($sometext, $context) {                                                                                        
        $this->sometext = $sometext;
        $this->students = array_values(get_enrolled_users($context));
    }
                                                                                                                            
    public function export_for_template(renderer_base $output) {                                                                    
        $data = new stdClass();
        $data->students = $this->students;
        $data->sometext = $this->sometext;                                                                                          
        return $data;                                                                                                               
    } 
}
