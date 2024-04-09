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


function generate_linechart($studentdata) {

	$temp[0] = 'Periodo';
	$temp[1] = 'Valor';
	$y = 1;
	$behaviourindicator1[] = $temp;
	foreach($studentdata->behaviourindicator1 AS $value) {
		$temp[0] = 'P' . $y++;
		$temp[1] = $value->value;
		$behaviourindicator1[] = $temp;
	}
	$json = json_encode($behaviourindicator1);
   // Google Charts JavaScript code
$chartScript = "
 <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChartSimple);

     function drawChart() {
        var data = google.visualization.arrayToDataTable([
	  ['Período', 'Acompanhamento ao cronograma', 'Número de acessos ao curso', 'Conteúdos acessados','Atividades concluídas'],
          ['AGO/Q1',  4,      10, 2, 3],
          ['AGO/Q2',  10,      2, 3, 4],
          ['SET/Q1',  6,       2, 1, 2],
          ['SET/Q2',  6,      2, 2, 3],
          ['OUT/Q1',  0,      2, 3, 4],
          ['OUT/Q2',  1,      5, 7,1],
          ['NOV/Q1',  5,       7, 6, 2],
          ['NOV/Q2',  10,      2, 5, 3],
          ['DEZ/Q1',  7,      2, 4, 4],
          ['DEZ/Q2',  4,      9, 0, 3]


        ]);

        var options = {
          title: 'Indicadores comportamentais',
          curveType: 'function',
	  legend: { position: 'bottom' },
          height: 300
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

        chart.draw(data, options);  
     }
     
     function drawChartSimple() {
	var passedArray = " . $json . ";
        var data = google.visualization.arrayToDataTable(passedArray);
        var options = {
          title: 'Interações totais no ambiente',
          curveType: 'function',
	  legend: { position: 'none' },
	  height: 100,
          vAxis: { viewWindow: {min: 0,}}
        };
        var chart = new google.visualization.LineChart(document.getElementById('line_chart_simple'));
        chart.draw(data, options);
	
	var chart = new google.visualization.LineChart(document.getElementById('line_chart_teste'));
        chart.draw(data, options);

 	var chart = new google.visualization.BubbleChart(document.getElementById('bubble_chart_teste'));
        chart.draw(data, options);
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
