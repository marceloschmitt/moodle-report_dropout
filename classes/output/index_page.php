<?php
// Standard GPL and phpdocs
namespace report_dropout\output;                                                                                                         
                                                                                                                                    
use renderable;                                                                                                                     
use renderer_base;                                                                                                                  
use templatable;                                                                                                                    
use stdClass;                                                                                                                       
             
class index_page implements renderable, templatable {                                                                               
    var $sometext = null;
    var $student;
            
    public function __construct($sometext) {                                                                                        
        $this->sometext = $sometext;
        $this->student[] = "Marcelo";
        $this->student[] = "André";
        $this->student[] = "Mariana";
        $this->student[] = "Pablo";
    }
                                                                                                                            
    public function export_for_template(renderer_base $output) {                                                                    
        $data = new stdClass();
        $data->student = $this->student;
        $data->sometext = $this->sometext;                                                                                          
        return $data;                                                                                                               
    } 
}
