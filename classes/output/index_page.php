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
        $this->student[] = (object) array('name' => 'Marcelo');
        $this->student[] = (object) array('name' => 'Mariana');
        $this->students = array_values(get_enrolled_users($context));

      print_r($this->student);
      echo "<BR><BR>";
            print_r($this->students);
      exit;

    }
                                                                                                                            
    public function export_for_template(renderer_base $output) {                                                                    
        $data = new stdClass();
        $data->students = $this->students;
        $data->sometext = $this->sometext;                                                                                          
        return $data;                                                                                                               
    } 
}
