<?php
include "googleanalytics.class.php";
include "function_dates.php";

$fecha4 = date('Y-m-d');
$fecha3 = strtotime ( '-365 day' , strtotime ( $fecha4 ) ) ;
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




$i4 = 0; $serie_dim4 = null; $serie_val4 = null;
foreach ($report2 as $valor2){
  
    $serie_dim4 .= "'".$fechas2[$i4]."', ";
	$serie_val4 .= $valor2['ga:visits'].", ";
	$final+=$valor2['ga:visits'];
	$i4++;
	
	
}

$visitas_final=array_sum($valor2);
echo $fecha3;
echo "<br>";
echo $fecha4;
echo "<br>";
echo $final;

 ?>