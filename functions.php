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
      google.charts.load('current', {'packages':['gantt']});
      google.charts.load('current', {'packages':['corechart']});  
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChartSimple);
      google.charts.setOnLoadCallback(drawSeriesChart);


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
	
	var chart = new google.visualization.LineChart(document.getElementById('line_chart_teste'));
        chart.draw(data, options);
     }

function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      
     function drawSeriesChart() {

      var data = google.visualization.arrayToDataTable([
        ['ID', 'Life Expectancy', 'Fertility Rate', 'Region',     'Population'],
        ['CAN',    80.66,              1.67,      'North America',  33739900],
        ['DEU',    79.84,              1.36,      'Europe',         81902307],
        ['DNK',    78.6,               1.84,      'Europe',         5523095],
        ['EGY',    72.73,              2.78,      'Middle East',    79716203],
        ['GBR',    80.05,              2,         'Europe',         61801570],
        ['IRN',    72.49,              1.7,       'Middle East',    73137148],
        ['IRQ',    68.09,              4.77,      'Middle East',    31090763],
        ['ISR',    81.55,              2.96,      'Middle East',    7485600],
        ['RUS',    68.6,               1.54,      'Europe',         141850000],
        ['USA',    78.09,              2.05,      'North America',  307007000]
      ]);

      var options = {
        title: 'Fertility rate vs life expectancy in selected countries (2010).' +
          ' X=Life Expectancy, Y=Fertility, Bubble size=Population, Bubble color=Region',
        hAxis: {title: 'Life Expectancy'},
        vAxis: {title: 'Fertility Rate'},
        bubble: {textStyle: {fontSize: 11}}
      };

      var chart = new google.visualization.BubbleChart(document.getElementById('bubble_chart_teste'));
      chart.draw(data, options);
    }

    

  function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      data.addRows([
        ['Research', 'Find sources',
         new Date(2015, 0, 1), new Date(2015, 0, 5), null,  100,  null],
        ['Write', 'Write paper',
         null, new Date(2015, 0, 9), daysToMilliseconds(3), 25, 'Research,Outline'],
        ['Cite', 'Create bibliography',
         null, new Date(2015, 0, 7), daysToMilliseconds(1), 20, 'Research'],
        ['Complete', 'Hand in paper',
         null, new Date(2015, 0, 10), daysToMilliseconds(1), 0, 'Cite,Write'],
        ['Outline', 'Outline paper',
         null, new Date(2015, 0, 6), daysToMilliseconds(1), 100, 'Research']
      ]);

      var options = {
        height: 275
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

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
