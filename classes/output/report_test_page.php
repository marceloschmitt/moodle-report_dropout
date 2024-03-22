<?php
// Standard GPL and phpdocs
namespace report_dropout\output;                                                                


use renderable;                                                                                 
use renderer_base;                                                                              
use templatable;                                                                                                                    
use stdClass;                                                                                   

class report_test_page implements renderable, templatable {                                                                               
/** @var string $sometext Some text to show how to pass data to a template. */                                                  
    public function __construct($script, $sometext, $studentdata) {                                                                                        
	    $this->script = $script;
	    $this->sometext = $sometext;
            $this->header = $studentdata->header;
            $this->subheader = $studentdata->subheader;
            $this->behaviourindicator1 = $studentdata->behaviourindicator1;
            $this->behaviourindicator2 = $studentdata->behaviourindicator2;
            $this->behaviourindicator3 = $studentdata->behaviourindicator3;
            $this->behaviourindicator4 = $studentdata->behaviourindicator4;
            $this->socialindicator1 = $studentdata->socialindicator1;
            $this->socialindicator2 = $studentdata->socialindicator2;
            $this->socialindicator3 = $studentdata->socialindicator3;
            $this->socialindicator4 = $studentdata->socialindicator4;
            $this->cognitiveindicator1 = $studentdata->cognitiveindicator1;
            $this->cognitiveindicator2 = $studentdata->cognitiveindicator2;
            $this->cognitiveindicator3 = $studentdata->cognitiveindicator3;

    }

    /**                                                                                                                             
     * Export this data so it can be used as the context for a mustache template.                                                   
     *                                                                                                                              
     * @return stdClass                                                                                                             
     */                                                                                                                             
    public function export_for_template(renderer_base $output) {                                                                    
	    $data = new stdClass();                             

	$data->sometext = $this->sometext;
        $data->header = $this->header;
        $data->subheader = $this->subheader;
        $data->behaviourindicator1 = $this->behaviourindicator1;
        $data->behaviourindicator2 = $this->behaviourindicator2;
        $data->behaviourindicator3 = $this->behaviourindicator3;
        $data->behaviourindicator4 = $this->behaviourindicator4;
        $data->socialindicator1 = $this->socialindicator1;
        $data->socialindicator2 = $this->socialindicator2;
        $data->socialindicator3 = $this->socialindicator3;
        $data->socialindicator4 = $this->socialindicator4;
        $data->cognitiveindicator1 = $this->cognitiveindicator1;
        $data->cognitiveindicator2 = $this->cognitiveindicator2;
        $data->cognitiveindicator3 = $this->cognitiveindicator3;	    
	    $data->script = $this->script;
        return $data;                                                                                                               
    }
}
