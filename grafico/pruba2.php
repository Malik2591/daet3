<?php
include "googleanalytics.class.php";
include "function_dates.php";

$fecha4 = date('Y-m-d');
$fecha3 = strtotime ( '-300 day' , strtotime ( $fecha4 ) ) ;
$fecha3 = date ( 'Y-m-d' , $fecha3 );
$fechas2 = createDateRangeArray($fecha3,$fecha4);
$days = count($fechas2);

$ga2 = new GoogleAnalytics('rtepantlato@gmail.com','revistatepantlato');
	$ga2->setProfile('ga:85054414');
        $ga2->setDateRange($fecha3,$fecha4);

        $report2 = $ga2->getReport(

         array('dimensions'=>urlencode('ga:region'),
         'metrics'=>urlencode('ga:visits'),
       
        'sort'=>'ga:visits'
                                            )
                              );


 
  $ciu=array_keys_multi($report2);
  for ($x=0;$x<count($ciu); $x++) { 
	if($ciu[$x]=="ga:visits"){
		unset($ciu[$x]);
		 $ciu = array_values($ciu);
		}
 }


$i4 = 0; $serie_dim4 = null; $serie_val4 = null;
foreach ($report2 as $valor2){
  
    $serie_dim4 .= "'".$fechas2[$i4]."', ";
	$serie_val4 .= $valor2['ga:visits'].", ";
    $datos.="['".$ciu[$i4]."', ".$valor2['ga:visits']."],";
	$i4++;
	
		
	
}
 


echo "<br>";

$script1 = "<script type='text/javascript'src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'>var chart;$(document).ready(function(){chart=new Highcharts.Chart({
        chart: {
			renderTo:'container',
            type: 'pie',
            options3d: {
				enabled: true,
                alpha: 45
            }
        },
		
        title: {
            text: 'Visitas de los Ultimos 15 dias'
        },
        subtitle: {
            text: 'Fuente: Google Analytics'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Visitas',
            data: [
                ".$datos."
            ]
        }]
    });
	
});</script><script type='text/javascript'src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'src='highcharts.js'></script> <script type='text/javascript'src='themes/grid.js'></script><script type='text/javascript'src='highcharts-3d.js'></script><script type='text/javascript'src='exporting.js'></script><div id='container'style='width: 600px; height: 500px; margin: 0 auto'></div>";
echo $script1;

function array_keys_multi(array $array)
{
    $keys = array();
 
    foreach ($array as $key => $value) {
        $keys[] = $key;
 
        if (is_array($value)) {
            $keys = array_merge($keys, array_keys_multi($value));
        }
    }
 
    return $keys;
}


?>