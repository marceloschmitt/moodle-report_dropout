<?php
// Standard GPL and phpdocs
namespace report_dropout\output;                                                                                                         
                                                                                                                                    
use renderable;                                                                                                                     
use renderer_base;                                                                                                                  
use templatable;                                                                                                                    
use stdClass;                                                                                                                       
             
class report_test_page implements renderable, templatable {                                                                               
    /** @var string $sometext Some text to show how to pass data to a template. */                                                  
    var $sometext = null;                                                                                                           
            
    public function __construct($sometext) {                                                                                        
        $this->sometext = $sometext;                                                                                                
    }

    /**                                                                                                                             
     * Export this data so it can be used as the context for a mustache template.                                                   
     *                                                                                                                              
     * @return stdClass                                                                                                             
     */                                                                                                                             
    public function export_for_template(renderer_base $output) {                                                                    
        $data = new stdClass();                                                                                                     
        $data->sometext = $this->sometext;                                                                                          
        return $data;                                                                                                               
    }
}
