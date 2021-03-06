<?php

include "function_dates.php"; include "googleanalytics.class.php";

$fecha2 = date('Y-m-d');
$fecha1 = strtotime ( '-15 day' , strtotime ( $fecha2 ) ) ;
$fecha1 = date ( 'Y-m-d' , $fecha1 );
$fechas = createDateRangeArray($fecha1,$fecha2);
$days = count($fechas);

try {

	$ga = new GoogleAnalytics('rtepantlato@gmail.com','revistatepantlato');
	$ga->setProfile('ga:85054414');
        $ga->setDateRange($fecha1,$fecha2);

        $report = $ga->getReport(

         array('dimensions'=>urlencode('ga:date'),
         'metrics'=>urlencode('ga:visits'),
        'filters'=>urlencode('ga:country!=@Mexico'),
        'sort'=>'ga:date'
                                            )
                              );

$i = 0; $serie_dim = null; $serie_val = null;

foreach ($report as $valor){

    $serie_dim .= "'".$fechas[$i]."', ";
    $serie_val .= $valor['ga:visits'].", ";
    $i++;
	

}
//Aqui acaba el generel y ampieza el de Guanajuato
$serie_dim = substr($serie_dim, 0, -2); $serie_val = substr($serie_val, 0, -2);
$fecha4 = date('Y-m-d');
$fecha3 = strtotime ( '-15 day' , strtotime ( $fecha4 ) ) ;
$fecha3 = date ( 'Y-m-d' , $fecha3 );
$fechas2 = createDateRangeArray($fecha3,$fecha4);
$days = count($fechas2);


	$ga2 = new GoogleAnalytics('rtepantlato@gmail.com','revistatepantlato');
	$ga2->setProfile('ga:85054414');
        $ga2->setDateRange($fecha3,$fecha4);

        $report2 = $ga2->getReport(

         array('dimensions'=>urlencode('ga:date'),
         'metrics'=>urlencode('ga:visits'),
        'filters'=>urlencode('ga:region==Guanajuato'),
        'sort'=>'ga:date'
                                            )
                              );

$i2 = 0; $serie_dim2 = null; $serie_val2 = null;

foreach ($report2 as $valor2){

    $serie_dim2 .= "'".$fechas2[$i2]."', ";
    $serie_val2 .= $valor2['ga:visits'].", ";
    $i2++;
	

}

$serie_dim2 = substr($serie_dim2, 0, -2); $serie_val2 = substr($serie_val2, 0, -2);
//Aqui acba el de guanjuanto y empieza el de edo mex
$fecha4 = date('Y-m-d');
$fecha3 = strtotime ( '-15 day' , strtotime ( $fecha4 ) ) ;
$fecha3 = date ( 'Y-m-d' , $fecha3 );
$fechas2 = createDateRangeArray($fecha3,$fecha4);
$days = count($fechas2);


	$ga2 = new GoogleAnalytics('rtepantlato@gmail.com','revistatepantlato');
	$ga2->setProfile('ga:85054414');
        $ga2->setDateRange($fecha3,$fecha4);

        $report2 = $ga2->getReport(

         array('dimensions'=>urlencode('ga:date'),
         'metrics'=>urlencode('ga:visits'),
        'filters'=>urlencode('ga:region==State of Mexico'),
        'sort'=>'ga:date'
                                            )
                              );

$i3 = 0; $serie_dim3 = null; $serie_val3 = null;

foreach ($report2 as $valor2){

    $serie_dim3 .= "'".$fechas2[$i3]."', ";
    $serie_val3 .= $valor2['ga:visits'].", ";
    $i2++;
	

}
//Aqui acba el de edo mex

$script1 = "<script type='text/javascript'src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'>var chart;$(document).ready(function(){chart=new Highcharts.Chart({chart:{renderTo:'container',defaultSeriesType:'line',marginRight:30,marginBottom:55},title:{text:'VISITAS POR DÍA (Últimos 15 días)',x:-20},subtitle:{text:'Fuente: Google Analytics',x:-20},xAxis:{categories:[".
$serie_dim.
"]},yAxis:{title:{text:'Visitas'},plotLines:[{value:0,width:1,color:'#808080'}]},tooltip:{formatter:function(){return'<b>'+this.series.name+'</b><br/>'+
this.x+': '+this.y+'';}},legend:{layout:'vertical',align:'right',verticalAlign:'top',x:-10,y:100,borderWidth:0},series:[{name:'Visitas Total',data:[".
$serie_val.
"]}, {name:'Guanajuato',data:[".$serie_val2."]}, {name:'Edo. México',data:[".$serie_val3."]}]});});</script><script type='text/javascript'src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'src='highcharts.js'></script><script type='text/javascript'src='exporting.js'></script><div id='container'style='width: 900px; height: 400px; margin: 0 auto'></div>";

}catch (Exception $e) {

               print 'Error: ' . $e->getMessage();

}

echo $script1;

?>