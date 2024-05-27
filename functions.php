<?php

// função que gera tabela
function generate_table($studentData, $selected) {
    // Your logic to generate the table HTML goes here
    $tableData = $studentData[$selected['year']][$selected['period']];
    $tableStructure = tableStructureData($tableData);
    
    $tableHead =    "<table class='table table-bordered table-sm custom-table'>
                    <thead id='table_head' class='text-center'>
                    <th scope='col' colspan='100%'>Semestre {$selected['year']}/{$selected['period']} </th>
                    <tr>
                    <th scope='col' rowspan='2' colspan='2'>Indicadores</th>
                    <th scope='col' >FEV</th>
                    <th scope='col' colspan='2'>MAR</th>
                    <th scope='col' colspan='2'>ABR</th>
                    <th scope='col' colspan='2'>MAI</th>
                    <th scope='col' colspan='2'>JUN</th>
                    <th scope='col' >JUL</th>
                    <th scope='col' rowspan='2'>Parciais</th>
                    </tr>
                    <tr>
                    <th scope='col'> Q2 </th>
                    <th scope='col'> Q1</th>
                    <th scope='col'> Q2 </th>
                    <th scope='col'> Q1</th>
                    <th scope='col'> Q2 </th>
                    <th scope='col'> Q1</th>
                    <th scope='col'> Q2 </th>
                    <th scope='col'> Q1</th>
                    <th scope='col'> Q2 </th>
                    <th scope='col'> Q1</th>
                    </tr>
                    </thead> ";
    

    foreach($tableStructure as $group => $row){}


    // generate table
    $tableHTML = $tableHead;
    foreach ($tableStructure as $group => $rowNames) {
        // echo($key);
        // var_dump($values);
        $rowspan = count($rowNames);
        $tableHTML .="<tbody>
        <tr>
        <th scope='row' rowspan='{$rowspan}'>{$group}</th>";

        foreach ($rowNames as $rowName => $value) {

            // row name 
            $tableHTML .=  "<td>{$rowName}</td>";
            

            // student data (value cells)
            // do jeito que ta, precisa que 
            $partialSum = 0;
            for ($i = 0; $i < 10; $i++){
                if (!is_numeric($value[$i])){
                $tableHTML .=  "<td> - </td>";

                } else {
                    $partialSum += $value[$i]; 
                    $tableHTML .=  "<td>{$value[$i]}</td>";
                }
                
            }
            $partialSum = $partialSum/10;
            $tableHTML .=  "<td>{$partialSum}</td>";
            $tableHTML .=  "</tr>";
        } 
        $tableHTML .=  "</tbody>";
    }
    $tableHTML .=  "</table>";



    
    foreach ($tableData['comportamentais'][1] as $colcell) {
        // $tableHTML .=  "<td>{$colcell}</td>";
    }
    // $tableHTML .= $tableHead.

    return $tableHTML;
}


function generate_charts($studentdata) {
	$jsonbehaviour = json_encode($studentdata->behaviourconditions);
	$jsonsocial = json_encode($studentdata->socialconditions);
	$jsoncognitive = json_encode($studentdata->cognitiveconditions);
	$jsonallconditions = json_encode($studentdata->allconditions);

	$titlebehaviour = get_string('behaviourindicators', 'report_dropout');
	$titlesocial = get_string('socialindicators', 'report_dropout');
	$titlecognitive = get_string('cognitiveindicators', 'report_dropout');
	
   // Google Charts JavaScript code
	$chartScript = "
<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
    google.charts.load('current', {'packages':['corechart']});  
    google.charts.load('current', {'packages':['table']});
    google.charts.setOnLoadCallback(drawChartLine);
    google.charts.setOnLoadCallback(drawChartBar);
    google.charts.setOnLoadCallback(drawChartTable);


    function drawChartLine() {
        var passedArray = " . $jsonbehaviour . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        var options = {
          title: '" . $titlebehaviour . "',
          legend: { position: 'bottom' },
          height: 300,
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


    function drawChartBar() {
        var passedArray = " . $jsonbehaviour . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        var options = {
          title: '" . $titlebehaviour . "',
          legend: { position: 'bottom' },
          height: 300,
          vAxis: { viewWindow: {min: 0,},
                   gridlines: { count: 5 } },
        };
        var chart = new google.visualization.BarChart(document.getElementById('bar_chart_behaviour'));
        chart.draw(data, options);

        var passedArray = " . $jsonsocial . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '" . $titlesocial . "';
        var chart = new google.visualization.BarChart(document.getElementById('bar_chart_social'));
        chart.draw(data, options);
	
        var passedArray = " . $jsoncognitive . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        options.title = '" . $titlecognitive . "';
        var chart = new google.visualization.BarChart(document.getElementById('bar_chart_cognitive'));
        chart.draw(data, options);
    }

    
    function drawChartTable() {
        var passedArray = " . $jsonallconditions . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        var options = {
          title: 'BehaviourConditions',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };
        var chart = new google.visualization.Table(document.getElementById('table_chart'));
        chart.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
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


    function button_bar_charts() {
       var x = document.getElementById('bar_charts');
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
