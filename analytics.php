<?php session_start(); ?>

<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="js/chart.js"></script>
		<script src="js/analytics.js"></script>
		
		<style>
			h5 span {
				font-weight: normal;
			}
			
			#platformtop, #bartop, #pielabels {
				display: none;
			}
			
			.timehead {
				margin-top: 0px;
			}
			
			.wrap {
				margin: 0 auto;
				width: 141px;
			}
			.box {
				width: 50px;
				height: 25px;
				display: inline-block;
				vertical-align: middle;
			}
			
				.box#d {
					background: #ff2052;
				}
				
				.box#w {
					background: #6441a5;
				}
				
				.box#m, .box#psn{
					background: #01b5dd;
				}
				
				.box#t, .box#xbl {
					background: #b0db64;
				}
				
				.box + span {
					font-weight: bold;
					margin-left: 10px;
				}
			
		</style>
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<h1>Analytics <?php if ( isset($_SESSION['logged_in']) ) { ?><a href="tabledata.php" class="btn btn-primary pull-right">View Table Data</a><?php } ?></h1>
					</div>
					<p class="lead">These are live analytics for <a href="http://mattaltepeter.com/destiny" target="_blank">http://mattaltepeter.com/destiny</a>. Views and infusion calculations can be done without having put in any previous information, so no information is tied to those..These numbers are not entirely accurate due to the following reasons:</p>
					<ul>
						<li>I originally launched the calculator September 18th</li>
						<li>I initially only tracked views up until September 24th, which is when I added the ability to track <i>what</i> people were doing on the site (user search, character select, etc)</li>
						<li>I added gamertag and platform (XBL or PSN) tracking on September 28th (which is why the total count number for each activities varies from the data in the charts)</li>
						<li>I added the infusion calculator on September 28th, hence the low numbers so far</li>
					</ul>
				</div>
			</div>
			
			<hr>
			<div class="row" id="loading">
				<div class="col-md-12">
					<h3 class="text-center">Loading...</h3>
				</div>
			</div>
			
			<div class="row" id="bartop">
				<div class="col-md-12">
					<h3>Activity Statistics</h3>
					<br />
				</div>
				<div class="col-md-3">
					<div class="wrap">
						<div class="box" id="d"></div>
						<span>Today</span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="wrap">
					<div class="box" id="w"></div>
					<span>Past Week</span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="wrap">
					<div class="box" id="m"></div>
					<span>Past Month</span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="wrap">
					<div class="box" id="t"></div>
					<span>All Time</span>
					</div>
				</div>
			</div>
			
			<br />
			
			<div class="row">
				<div class="col-md-12">
					<canvas id="todaybar" style="width: 100%" height="250"></canvas>
				</div>
			</div>
			
			<br />
			
			<div class="row" id="platformtop">
				<div class="col-md-12">
					<h3>Platform Data</h3>
				</div>
				<br />
				<div class="col-md-6">
					<div class="wrap">
						<div class="box" id="xbl"></div>
						<span>Xbox Live</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box" id="psn"></div>
					<span>PlayStation Network</span>
				</div>
			</div>
			<br />
			<div class="row" id="pielabels">
				<div class="col-md-4">
					<h5 class="text-center">User Searches</h5>
				</div>
				
				<div class="col-md-4">
					<h5 class="text-center">Character Selections</h5>
				</div>
				
				<div class="col-md-4">
					<h5 class="text-center">Light Calculations</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<canvas id="gtpie" style="width: 100%" height="250" ></canvas>
				</div>
				<div class="col-md-4">
					<canvas id="cspie" style="width: 100%" height="250"></canvas>
				</div>
				<div class="col-md-4">
					<canvas id="lcpie" style="width: 100%" height="250"></canvas>
				</div>
			</div>
		</div>
		<br />
	</body>
</html>
				