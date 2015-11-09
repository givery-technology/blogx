<?php echo $this->Html->script('count', array('inline' => false)); ?>
<!-- quick button -->
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
				<h2><i class=""></i><?php echo __('Quick Menu') ?></h2>
			</div>
			<div class="box-content">
<!-- keywords -->
				<div class="col-sm-2">
					<a class="quick-button" href="<?php echo $this->webroot?>keywords">
						<i class="icon-link"></i>
						<p><?php echo __('Keywords List'); ?></p>
						<span id="count_keyword" class="notification red"></span>
					</a>
				</div>
<!-- posts -->
				<div class="col-sm-2">
					<a class="quick-button" href="<?php echo $this->webroot?>posts">
						<i class="icon-edit"></i>
						<p><?php echo __('Posts List'); ?></p>
						<span id="count_post" class="notification orange"></span>
					</a>
				</div>
<!-- blogs -->
				<div class="col-sm-2">
					<a class="quick-button" href="<?php echo $this->webroot?>blogs">
						<i class="icon-list"></i>
						<p><?php echo __('Blogs List'); ?></p>
						<span id="count_blog" class="notification green"></span>
					</a>
				</div>
<!-- categories	-->
				<div class="col-sm-2">
					<a class="quick-button" href="<?php echo $this->webroot?>categories">
						<i class="icon-briefcase"></i>
						<p><?php echo __('Categories List'); ?></p>
						<span id="count_category" class="notification grey"></span>
					</a>
				</div>
<!-- design	-->
				<div class="col-sm-2">
					<a class="quick-button" href="<?php echo $this->webroot?>designs">
						<i class="icon-picture"></i>
						<p><?php echo __('Designs List'); ?></p>
						<span id="count_design" class="notification grey"></span>
					</a>
				</div>
<!-- arbitrary -->
				<div class="col-sm-2">
					<a class="quick-button" href="<?php echo $this->webroot?>arbitraries">
						<i class="icon-random"></i>
						<p><?php echo __('Arbitraries List'); ?></p>
						<span id="count_arbitrary" class="notification grey"></span>
					</a>
				</div>
				<div class="clearfix"></div>
			</div>	
		</div>	
	</div><!--/col-->
</div>

<!--area chart full width year-->
<div class="row">
	<div class="col-sm-12">
		<div class="box">
			<div class="box-header">
				<h2><i class="fa"></i>Month <?php echo date('Y-m'); ?> Data</h2>
				<div class="box-icon">
					<a class="btn-setting" href="charts-xcharts.html#"><i class="fa fa-wrench"></i></a>
					<a class="btn-minimize" href="charts-xcharts.html#"><i class="fa fa-chevron-up"></i></a>
					<a class="btn-close" href="charts-xcharts.html#"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div id="days_of_month_chart" style="width: 100%; height: 250px;"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
<!--area chart full width month-->
	<div class="col-sm-8">
		<div class="box">
			<div class="box-header">
				<h2><i class="fa"></i><?php echo __('AreaCharts'); ?></h2>
				<div class="box-icon">
					<a class="btn-setting" href="charts-xcharts.html#"><i class="fa fa-wrench"></i></a>
					<a class="btn-minimize" href="charts-xcharts.html#"><i class="fa fa-chevron-up"></i></a>
					<a class="btn-close" href="charts-xcharts.html#"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div id="area_chart_div" style="width: 720px; height: 250px;"></div>
			</div>
		</div>
	</div><!--/col-->
<!--pie chart full width month-->
	<div class="col-sm-4">
		<div class="box">
			<div class="box-header">
				<h2><i class="fa"></i><?php echo __('PieCharts'); ?></h2>
				<div class="box-icon">
					<a class="btn-setting" href="charts-xcharts.html#"><i class="fa fa-wrench"></i></a>
					<a class="btn-minimize" href="charts-xcharts.html#"><i class="fa fa-chevron-up"></i></a>
					<a class="btn-close" href="charts-xcharts.html#"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div id="piechart" style="width: 350px; height: 250px;"></div>
			</div>
		</div>
	</div><!--/col-->	
</div>

<!--area chart full width year-->
<div class="row">
	<div class="col-sm-12">
		<div class="box">
			<div class="box-header">
				<h2><i class="fa"></i>Year <?php echo date('Y'); ?> Data</h2>
				<div class="box-icon">
					<a class="btn-setting" href="charts-xcharts.html#"><i class="fa fa-wrench"></i></a>
					<a class="btn-minimize" href="charts-xcharts.html#"><i class="fa fa-chevron-up"></i></a>
					<a class="btn-close" href="charts-xcharts.html#"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div id="months_of_year_chart" style="width: 100%; height: 250px;"></div>
			</div>
		</div>
	</div>
</div>

<!-- google chart libs -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<!-- pie chart -->
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {

    var data = google.visualization.arrayToDataTable(<?php echo "[".implode(',',$piechart)."]" ?>);

    var options = {
      title: 'BLOGX Performance',
      slices: {
		0: { color: 'red' },
		1: { color: 'orange' },
		2: { color: 'green' }
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
</script>

<!-- area chart -->
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    
    var data = google.visualization.arrayToDataTable(<?php echo "[".implode(',',$linechart)."]" ?>);

    var options = {
      title: 'BlogX Performance',
      hAxis: {title: 'Week',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}, 
      colors:['red','orange','green']
    };

    var chart = new google.visualization.AreaChart(document.getElementById('area_chart_div'));
    chart.draw(data, options);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {  
    var data = google.visualization.arrayToDataTable(<?php echo "[".implode(',',$days_of_month_graph)."]" ?>);

    var options = {
      title: 'BlogX Days of month',
      hAxis: {title: 'Days of month',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}, 
      colors:['red','orange','green'],
	  chartArea:{left:30,top:30,width:"85%",height:"70%"}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('days_of_month_chart'));
    chart.draw(data, options);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {  
    var data = google.visualization.arrayToDataTable(<?php echo "[".implode(',',$graph)."]" ?>);

    var options = {
      title: 'BlogX Month of year',
      hAxis: {title: 'Month of year',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}, 
      colors:['red','orange','green'],
	  chartArea:{left:30,top:30,width:"85%",height:"70%"}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('months_of_year_chart'));
    chart.draw(data, options);
  }
</script>