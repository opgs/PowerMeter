<?php

error_reporting(-1);
ini_set('display_errors', 'On');

$showdebug = false;

if(isset($_GET['debug']) && htmlspecialchars($_GET['debug']) == '1'){$showdebug = true;}else{$showdebug = false;}

require('power.php');

if(!isset($body))
{
	ob_start();
	?>
	
	<style type="text/css">
	#wrapper{
		margin: 0 auto;
	}
	#spent{
		width: 100%;
		max-width: 931px;
		background-color: #ABD4F0;
		font-size: 14pt;
		margin-bottom: 10px;
		padding: 4px;
	}
	#kwh svg path{
		display: none;
	}
	.phase{
		width: 310px;
		height: 340px;
		display: inline-block;
		background-color: #ABD4F0;
		margin-bottom: 10px;
	}
	.phaseTitle{
		text-align: center;
		font-size: 20pt;
	}
	.phaseGauge{
		width: 150px;
		height: 150px;
		display: inline-block;
	}
	</style>
	
	<script type="text/javascript">
$(document).ready(function(){
	var initialReading = 0;
    var initialTime = "";

	var kwh_gauge = new JustGage({
		id: "kwh",
		value: 0,
		min: 0,
		max: 1,
		hideInnerShadow: true,
		hideMinMax: true,
		customSectors: [{color : "#00ff00",	lo : 0,	hi : 1}]
	});

	var kw_gauge = new JustGage({
		id: "kwgauge",
		value: 0,
		min: 0,
		max: 70,
		label: "Current kW",
		decimals: 1,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 0,	hi : 50}, {color : "#FFA500", lo : 50, hi : 60}, {color : "#ff0000", lo : 60, hi : 70}]
	});
	
	var pf_gauge = new JustGage({
		id: "pfgauge",
		value: 0,
		min: 0,
		max: 1,
		label: "Current pF",
		decimals: 3,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 0.89, hi : 1}, {color : "#FFA500", lo : 0.5, hi : 0.89}, {color : "#ff0000", lo : 0, hi : 0.5}]
	});
	
	var p1v_gauge = new JustGage({
		id: "phase1v",
		value: 0,
		min: 230,
		max: 260,
		label: "Current V",
		decimals: true,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 240, hi : 250}, {color : "#FFA500", lo : 235, hi : 240}, {color : "#FFA500", lo : 250, hi : 255}, {color : "#ff0000", lo : 230, hi : 235}, {color : "#ff0000", lo : 255, hi : 260}]
	});
	
	var p1a_gauge = new JustGage({
		id: "phase1a",
		value: 0,
		min: 0,
		max: 200,
		label: "Current A",
		decimals: true,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 0, hi : 70}, {color : "#FFA500", lo : 70, hi : 130}, {color : "#ff0000", lo : 130, hi : 200}]
	});
	
	var p1pf_gauge = new JustGage({
		id: "phase1pf",
		value: 0,
		min: 0,
		max: 1,
		label: "Current pF",
		decimals: 3,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 0.89, hi : 1}, {color : "#FFA500", lo : 0.5, hi : 0.89}, {color : "#ff0000", lo : 0, hi : 0.5}]
	});
	
	var p2v_gauge = new JustGage({
		id: "phase2v",
		value: 0,
		min: 230,
		max: 260,
		label: "Current V",
		decimals: true,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 240, hi : 250}, {color : "#FFA500", lo : 235, hi : 240}, {color : "#FFA500", lo : 250, hi : 255}, {color : "#ff0000", lo : 230, hi : 235}, {color : "#ff0000", lo : 255, hi : 260}]
	});
	
	var p2a_gauge = new JustGage({
		id: "phase2a",
		value: 0,
		min: 0,
		max: 200,
		label: "Current A",
		decimals: true,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 0, hi : 70}, {color : "#FFA500", lo : 70, hi : 130}, {color : "#ff0000", lo : 130, hi : 200}]
	});
	
	var p2pf_gauge = new JustGage({
		id: "phase2pf",
		value: 0,
		min: 0,
		max: 1,
		label: "Current pF",
		decimals: 3,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 0.89, hi : 1}, {color : "#FFA500", lo : 0.5, hi : 0.89}, {color : "#ff0000", lo : 0, hi : 0.5}]
	});
	
	var p3v_gauge = new JustGage({
		id: "phase3v",
		value: 0,
		min: 230,
		max: 260,
		label: "Current V",
		decimals: true,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 240, hi : 250}, {color : "#FFA500", lo : 235, hi : 240}, {color : "#FFA500", lo : 250, hi : 255}, {color : "#ff0000", lo : 230, hi : 235}, {color : "#ff0000", lo : 255, hi : 260}]
	});
	
	var p3a_gauge = new JustGage({
		id: "phase3a",
		value: 0,
		min: 0,
		max: 200,
		label: "Current A",
		decimals: true,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 0, hi : 70}, {color : "#FFA500", lo : 70, hi : 130}, {color : "#ff0000", lo : 130, hi : 200}]
	});
	
	var p3pf_gauge = new JustGage({
		id: "phase3pf",
		value: 0,
		min: 0,
		max: 1,
		label: "Current pF",
		decimals: 3,
		hideInnerShadow: true,
		labelFontColor: 'black',
		customSectors: [{color : "#00ff00",	lo : 0.89, hi : 1}, {color : "#FFA500", lo : 0.5, hi : 0.89}, {color : "#ff0000", lo : 0, hi : 0.5}]
	});	
	
	var ajaxyStuff = function(initial){
		$.getJSON("<?php echo $SITE->path; ?>/sys/xmlproxy.php", function(data){
			if(initial)
			{
				initialReading = data[0];
				var time = (new Date).toTimeString().split(' ')[0].split(':');
				initialTime = time[0] + ":" + time[1];
			}
			kwh_gauge.refresh(data[0]);
			$("#spent").text("\u00A3" + (((data[0] - initialReading) * <?php echo $SITE->daytimerate; ?>)/100).toFixed(2) + " since " + initialTime);
			kw_gauge.refresh(data[2]/10);
			pf_gauge.refresh(data[4]/1000);
			p1v_gauge.refresh(data[5]/10);
			p1a_gauge.refresh(data[8]/10);
			p1pf_gauge.refresh(data[15]/1000);
			p2v_gauge.refresh(data[6]/10);
			p2a_gauge.refresh(data[9]/10);
			p2pf_gauge.refresh(data[16]/1000);
			p3v_gauge.refresh(data[7]/10);
			p3a_gauge.refresh(data[10]/10);
			p3pf_gauge.refresh(data[17]/1000);
		});
	};
	
	ajaxyStuff(true);
	setInterval(ajaxyStuff, 10000);
});
</script>
<div id="wrapper">
<div id="spent"></div>
<div class="phase"><div class="phaseTitle">Total kWh</div><div id="kwh" class="phaseGauge" style="width: 300px; height: 300px;"></div></div>
<div class="phase"><div class="phaseTitle">kW</div><div id="kwgauge" class="phaseGauge" style="width: 300px; height: 300px;"></div></div>
<div class="phase"><div class="phaseTitle">pF</div><div id="pfgauge" class="phaseGauge" style="width: 300px; height: 300px;"></div></div>
<div id="phase1" class="phase">
<div class="phaseTitle">Phase 1</div>
<div id="phase1v" class="phaseGauge"></div>
<div id="phase1a" class="phaseGauge"></div>
<div id="phase1pf" class="phaseGauge" style="width: 300px;"></div>
</div>
<div id="phase2" class="phase">
<div class="phaseTitle">Phase 2</div>
<div id="phase2v" class="phaseGauge"></div>
<div id="phase2a" class="phaseGauge"></div>
<div id="phase2pf" class="phaseGauge" style="width: 300px;"></div>
</div>
<div id="phase3" class="phase">
<div class="phaseTitle">Phase 3</div>
<div id="phase3v" class="phaseGauge"></div>
<div id="phase3a" class="phaseGauge"></div>
<div id="phase3pf" class="phaseGauge" style="width: 300px;"></div>
</div>
</div>
</div>
	
	<?php
	$body = ob_get_clean();
}

if(!isset($noheader)){echo $header;}
if(!isset($nobody)){echo $body;}
if($showdebug){echo $debug;}
if(!isset($nofooter)){echo $footer;}

?>
