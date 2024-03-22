<?php
// Standard GPL and phpdocs
namespace report_dropout\output;                                                                


use renderable;                                                                                 
use renderer_base;                                                                              
use templatable;                                                                                                                    
use stdClass;                                                                                   

class report_test_page implements renderable, templatable {                                                                               
/** @var string $sometext Some text to show how to pass data to a template. */                                                  
    public function __construct($script) {                                                                                        
        $this->script = $script;                                                                                                
    }

    /**                                                                                                                             
     * Export this data so it can be used as the context for a mustache template.                                                   
     *                                                                                                                              
     * @return stdClass                                                                                                             
     */                                                                                                                             
    public function export_for_template(renderer_base $output) {                                                                    
	    $data = new stdClass();                                                                                                     
	    $data->script = $this->script;
        return $data;                                                                                                               
    }
}
