<?php

include "function_dates.php"; include "googleanalytics.class.php";

$fecha4 = date('Y-m-d');
$fecha3 = strtotime ( '-7 day' , strtotime ( $fecha4 ) ) ;
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

$i4 = 0; $serie_dim4 = null; $serie_val4 = null;

foreach ($report2 as $valor2){

    $serie_dim4 .= "'".$fechas2[$i4]."', ";
    $serie_val4 .= $valor2['ga:visits'].", ";
    $i4++;
	
	
}
$script1 = "<script type='text/javascript'src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'>var chart;$(document).ready(function(){chart=new Highcharts.Chart({chart:{renderTo:'container',defaultSeriesType:'line',marginRight:30,marginBottom:55},title:{text:'VISITAS POR DÍA (Últimos 15 días)',x:-20},subtitle:{text:'Fuente: Google Analytics',x:-20},xAxis:{categories:[".
$serie_dim.
"]},yAxis:{title:{text:'Visitas'},plotLines:[{value:0,width:1,color:'#808080'}]},tooltip:{formatter:function(){return'<b>'+this.series.name+'</b><br/>'+
this.x+': '+this.y+'';}},legend:{layout:'vertical',align:'right',verticalAlign:'top',x:-10,y:100,borderWidth:0},series:[{name:'Visitas Total',data:[".
$serie_val.
"]}, {name:'Guanajuato',data:[".$serie_val2."]}, {name:'Edo. México',data:[".$serie_val3."]}]});});</script><script type='text/javascript'src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'src='highcharts.js'></script><script type='text/javascript'src='exporting.js'></script><div id='container'style='width: 900px; height: 400px; margin: 0 auto'></div>";



?>