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
 * A report to display the risk of dropout or retention
 *
 * @package    report
 * @subpackage dropout
 * @copyright  2024 onwards Marcelo Augusto Rauh Schmitt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function generate_charts($studentdata)
{
    // Arrays defined PHP and will be used in JavaScript.
    $jsonbehaviour = json_encode($studentdata->behaviourconditions);
    $jsonbehaviour4 = json_encode($studentdata->behaviourcondition4);
    $jsonsocial = json_encode($studentdata->socialconditions);
    $jsoncognitive = json_encode($studentdata->cognitiveconditions);
    $jsonbehaviourtable = json_encode($studentdata->behaviourtable);
    $jsonsocialtable = json_encode($studentdata->socialtable);
    $jsoncognitivetable = json_encode($studentdata->cognitivetable);

    // Titles defined in PHP that will be used in JavaScript.
    $titlebehaviour = get_string('behaviourindicators', 'report_dropout');
    $titlesocial = get_string('socialindicators', 'report_dropout');
    $titlecognitive = get_string('cognitiveindicators', 'report_dropout');

    // Google Charts JavaScript code
    $chartScript = "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
    google.charts.load('current', {'packages':['corechart']});  
    google.charts.load('current', {'packages':['table']});
    google.charts.setOnLoadCallback(drawChartLine);
    google.charts.setOnLoadCallback(drawChartColumn);
    google.charts.setOnLoadCallback(drawBehaviourTable);
    google.charts.setOnLoadCallback(drawSocialTable);
    google.charts.setOnLoadCallback(drawCognitiveTable);


    function drawChartLine() {
        
        //Global options.
        var options = {
            legend: { position: 'bottom' },
            height: 250,
            chartArea: {left: 60, width: '100%'},
            pointSize: 7,
            series: {
                0: { pointShape: 'circle',  lineWidth: 1  },
                1: { pointShape: 'triangle', lineWidth: 1 },
                2: { pointShape: 'square', lineWidth: 1 },
                3: { pointShape: 'diamond', lineWidth: 1 },
            },
            vAxis: { viewWindow: { min: 0 },
                gridlines: { count: 5 } },
        };
  
        // Behaviour conditions.
        var passedArray = " . $jsonbehaviour . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '" . $titlebehaviour . "';
        options.vAxis.viewWindow.max = 20;
        var chart = new google.visualization.LineChart(document.getElementById('line_chart_behaviour'));
        chart.draw(data, options);
       
        // Behaviour4 condition.
        var passedArray = " . $jsonbehaviour4 . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '';
        options.vAxis.viewWindow.max = '';
        options.vAxis.format = 'percent';
        var chart = new google.visualization.LineChart(document.getElementById('line_chart_behaviour4'));
        chart.draw(data, options);
       
        // Social conditions.
        var passedArray = " . $jsonsocial . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '" . $titlesocial . "';
        options.vAxis.viewWindow.max = 20;
        options.vAxis.format = '';
        var chart = new google.visualization.LineChart(document.getElementById('line_chart_social'));
        chart.draw(data, options);

        // Cognitive conditions.
        var passedArray = " . $jsoncognitive . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '" . $titlecognitive . "';
        options.vAxis.viewWindow.max = 10;
        options.vAxis.format = 'decimal';
        var chart = new google.visualization.LineChart(document.getElementById('line_chart_cognitive'));
        chart.draw(data, options);
    }


    function drawChartColumn() {
        // Global options.
        var options = {
            legend: { position: 'bottom' },
            height: 250,
            chartArea: {left: 60, width: '100%'},
            bar: { groupWidth: 50 },
            vAxis: { viewWindow: { min: 0 },
                gridlines: { count: 5 } },
        };
        
     // Behaviour conditions.
        var passedArray = " . $jsonbehaviour . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '" . $titlebehaviour . "';
        options.vAxis.viewWindow.max = 20;
        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart_behaviour'));
        chart.draw(data, options);

        // Behaviour4 condition.
        var passedArray = " . $jsonbehaviour4 . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '';
        options.vAxis.viewWindow.max = '';
        options.vAxis.format = 'percent';
        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart_behaviour4'));
        chart.draw(data, options);
               
        // Social conditions.
        var passedArray = " . $jsonsocial . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '" . $titlesocial . "';
        options.vAxis.viewWindow.max = 20;
        options.vAxis.format = '';
        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart_social'));
        chart.draw(data, options);
 
         // Cognitive conditions.
        var passedArray = " . $jsoncognitive . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '" . $titlecognitive . "';
        options.vAxis.viewWindow.max = 10;
        options.vAxis.format = 'decimal';
        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart_cognitive'));
        chart.draw(data, options);
    }

    
    function drawBehaviourTable() {
        var passedArray = " . $jsonbehaviourtable . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        var chart = new google.visualization.Table(document.getElementById('behaviour_table'));
        chart.draw(data, {allowHtml: true, showRowNumber: true, width: '100%', height: '100%'});
    }
    
    function drawSocialTable() {
        var passedArray = " . $jsonsocialtable . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        var chart = new google.visualization.Table(document.getElementById('social_table'));
        chart.draw(data, {allowHtml: true, showRowNumber: true, width: '100%', height: '100%'});
    }

    function drawCognitiveTable() {
        var passedArray = " . $jsoncognitivetable . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        var chart = new google.visualization.Table(document.getElementById('cognitive_table'));
        chart.draw(data, {allowHtml: true, showRowNumber: true, width: '100%', height: '100%'});
    }
 
    function button_table_charts() {
       var x = document.getElementById('table_charts');
       if (x.style.display === 'none') {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
    }


    function button_line_charts() {
       var x = document.getElementById('line_charts');
       if (x.style.display === 'none') {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
    }


    function button_column_charts() {
       var x = document.getElementById('column_charts');
       if (x.style.display === 'none') {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
    }
    
    
    </script>";
    return $chartScript;
}

function print_risk_line($risk) {
    $text = get_string($risk, 'report_dropout');
    switch($risk) {
        case 'lowrisk': $class = 'alert-success';
                        break;
        case 'mediurisk': $class = 'alert-info';
                        break;
        case 'highrisk': $class = 'alert-warning';
                        break;
        case 'veryrisk': $class = 'alert-danger';
                        break;
    }
    return '<div class="alert '. $class . '" role="alert"> . $text . '</div>';
    
}

