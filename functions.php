<?php

function generate_charts($studentdata) {
	$jsonbehaviour = json_encode($studentdata->behaviourconditions);
	$jsonsocial = json_encode($studentdata->socialconditions);
	$jsoncognitive = json_encode($studentdata->cognitiveconditions);
	$jsonallconditions = json_encode($studentdata->allconditions);
    $jsonbehaviourtable = json_encode($studentdata->behaviourtable);
    $jsonsocialtable = json_encode($studentdata->socialtable);
    $jsoncognitivetable = json_encode($studentdata->cognitivetable);

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
    google.charts.setOnLoadCallback(drawChartTable);
    google.charts.setOnLoadCallback(drawBehaviourTable);
    google.charts.setOnLoadCallback(drawSocialTable);
    google.charts.setOnLoadCallback(drawCognitiveTable);


    function drawChartLine() {
        var passedArray = " . $jsonbehaviour . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        var options = {
          title: '" . $titlebehaviour . "',
          legend: { position: 'bottom' },
          height: 300,
	  chartArea: {left: 20, width: '100%'},
          pointSize: 7,
          series: {
                0: { pointShape: 'circle',  lineWidth: 1  },
                1: { pointShape: 'triangle', lineWidth: 1 },
                2: { pointShape: 'square', lineWidth: 1 },
                3: { pointShape: 'diamond', lineWidth: 1 },
            },
          vAxis: { viewWindow: {min: 0,},
                   gridlines: { count: 5 } },
        };
        var chart = new google.visualization.LineChart(document.getElementById('line_chart_behaviour'));
        chart.draw(data, options);
       
        var passedArray = " . $jsonsocial . ";
        options.title = '" . $titlesocial . "';
        var data = google.visualization.arrayToDataTable(passedArray);
        var chart = new google.visualization.LineChart(document.getElementById('line_chart_social'));
        chart.draw(data, options);

        var passedArray = " . $jsoncognitive . ";
        options.title = '" . $titlecognitive . "';
        var data = google.visualization.arrayToDataTable(passedArray);
        var chart = new google.visualization.LineChart(document.getElementById('line_chart_cognitive'));
        chart.draw(data, options);
    }


    function drawChartColumn() {
        var passedArray = " . $jsonbehaviour . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        var options = {
          title: '" . $titlebehaviour . "',
          legend: { position: 'bottom' },
          height: 300,
        chartArea: {left: 20, width: '100%'},
          bar: {groupWidth: 50},
          vAxis: { viewWindow: {min: 0,},
                   gridlines: { count: 5 } },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart_behaviour'));
        chart.draw(data, options);

        var passedArray = " . $jsonsocial . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '" . $titlesocial . "';
	options.bar.groupWidth = 40;
        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart_social'));
        chart.draw(data, options);
	
        var passedArray = " . $jsoncognitive . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '" . $titlecognitive . "';
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
        var passedArray = " . $jsonsocialtable . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        var chart = new google.visualization.Table(document.getElementById('cognitive_table'));
        chart.draw(data, {allowHtml: true, showRowNumber: true, width: '100%', height: '100%'});
    }
 
    function button_table_charts() {
       var x = document.getElementById('table_chart');
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
   </script>
";
   return $chartScript;
}


function tableStructureData($tableData = []){
    // deixa os dados do aluno 'table friendly'

    $tableStructure = [];

    foreach ($tableData as $key => $value) {
        switch ($key) {
            case 'comportamentais':
                $tableStructure['Comportamentais'] = [
                    'Acompanhamento ao cronograma' => $tableData['comportamentais'][0],
                    ' Número de acessos ao curso' => $tableData['comportamentais'][1],
                    'Conteúdos acessados' => $tableData['comportamentais'][2],
                    'Atividades concluídas' => $tableData['comportamentais'][3]
                ];
                break;

            case 'sociais':
                $tableStructure['Sociais'] = [
                    'Interações totais no Ambiente' => $tableData['sociais'][0],
                    'Interações com colegas' => $tableData['sociais'][1],
                    'Intearações com professores e tutores' => $tableData['sociais'][2],
                ];
                break;

            case 'cognitivos':
                $tableStructure['Cognitivos'] = [
                    'Desempenho geral' => $tableData['cognitivos'][0],
                    'Desempenho em atividades não avaliativas' => $tableData['cognitivos'][1],
                    'Desempenho em atividades avaliativas' => $tableData['cognitivos'][2]
                ];
                break;
        }
    }
    
    return $tableStructure;
}

//TODO
function generateChart($chartType) {
    // Return the chart data in a format that can be used by JavaScript
}
