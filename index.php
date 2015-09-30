<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<link href="css/style.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="js/app.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1>Destiny Light Level and Infusion Calculator</h1>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p class="lead">I decided to add the infusion calculator back in!</p>
					<p class="lead">Select your platform, enter your gamertag, and wait for the system to load your characters. Simply click on one of your characters to load all of your <strong>equipped</strong> weapons into the text boxes below. Once loaded, you can change numbers to see how your light level will change with the new numbers. I'm currently working to figure on getting all of your inventory in here so you can choose from this site.</p>
					<p class="lead">Do you like data? Check out the analytics site I made for this app <a href="http://mattaltepeter.com/destiny/analytics">here</a></p>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12"><p class="lead">Equation: ((higher - lower) * 80%) + lower --- (rounded up; if difference is less than 7, the result is the higher value gear)</p></div>
				<div class="col-md-12"><h4>Simple Infusion</h4></div>
				<div class="col-md-4">
					<label>Lower Gear</label>
					<input type="text" name="lower" id="lower">
				</div>

				<div class="col-md-4">
					<label>Higher Gear</label>
					<input type="text" name="higher" id="higher">
					<button class="btn btn-default btn-sm" id="infusebtn">Calculate</button>
					<p class="text-muted">(or hit enter)</p>
				</div>

				<div class="col-md-4">
					<label>Infusion Result</label>
					<h3 id="infuser" style="margin: 0;">--</h3>
				</div>
				<div class="col-md-12"><h4>Complex Infusion</h4></div>
				<div class="col-md-4">
					<label>Original Gear</label>
					<input type="text" id="original-item" value="280" maxlength="3">
				</div>
				<div class="col-md-4">
					<label>Fodder 1</label>
					<input type="text" id="fodder1" value="283" maxlength="3"><br /><br />
					<label>Fodder 2</label>
					<input type="text" id="fodder2" value="285" maxlength="3"> <br /><br />
					<label>Fodder 3</label>
					<input type="text" id="fodder3" value="289" maxlength="3"> <br /><br />
					<label>Fodder 4</label>
					<input type="text" id="fodder4" value="291" maxlength="3"> <br /><br />
					<label>Fodder 5</label>
					<input type="text" id="fodder5" value="295" maxlength="3"> <br /><br />
					<label>Fodder 6</label>
					<input type="text" id="fodder6" value="297" maxlength="3"> <br /><br />
			</div>
			<div class="col-md-4">
				<button class="btn btn-default btn-sm" id="complex">Calculate</button>
				<h3 id="complexr"></h3>
			</div>
			<div class="col-md-12" id="res">

			</div>

		</div>
			<hr>
			<div class="row">
				<div class="col-md-4">
					<label>Platform</label>
					<div class="radio">
					  <label>
					    <input type="radio" name="acct" value="1" checked>
					    Xbox Live
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" name="acct" value="2">
					    PSN
					  </label>
					</div>
				</div>
				<div class="col-md-4">
					<label>Gamertag</label>
					<input type="text" id="gt"> <button class="btn btn-default btn-sm" id="search">Search</button>
					<p class="text-muted">(or hit enter)</p>
					<br />
				</div>
				<br /><br />
				<div class="col-md-4">
					<div id="chars">
					</div>
				</div>
			</div>
			<div class="row" id="charload" style="display: none;"><div class="col-md-12"><h3 class="text-center">Loading...</h3></div></div>
			<div class="row" id="lightCalc">

				<div class="col-md-12"><h3>Light Level <small id="sel-class"></small></h3><hr></div>
				<div class="col-md-12"><p class="lead">Equation: 12% * <i>primary</i> + 12% * <i>secondary</i> + 12% * <i>heavy</i> + 10% * <i>helmet</i> + 10% * <i>gaunlets</i> + 10% * <i>chest</i> + 10% * <i>legs</i> + 8% * <i>ghost</i> + 8% * <i>class</i> + 8% * <i>artifact</i></p></div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12">
							<label>Primary</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img class="itemImg" src="" data-toggle="tooltip" title="Some tooltip text!">
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input id="primary" class="val" type="text" pattern="[0-9]*" />
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label>Secondary</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img class="itemImg" src="" data-toggle="tooltip" title="Some tooltip text!">
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input id="secondary" class="val" type="text" pattern="[0-9]*" />
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label>Heavy</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img class="itemImg" src="" data-toggle="tooltip" title="Some tooltip text!">
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input id="heavy" class="val" type="text" pattern="[0-9]*" />
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label>Ghost</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img class="itemImg" src="" data-toggle="tooltip" title="Some tooltip text!">
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input id="ghost" class="val" type="text" pattern="[0-9]*" />
							</div>
						</div>
					</div>

				</div>
				<div class="col-md-4">
					<h1 id="r">--</h1><br />
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12">
							<label>Helmet</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img class="itemImg" src="" data-toggle="tooltip" title="Some tooltip text!">
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input id="helmet" class="val" type="text" pattern="[0-9]*" />
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label>Gauntlets</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img class="itemImg" src="" data-toggle="tooltip" title="Some tooltip text!">
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input id="gauntlets" class="val" type="text" pattern="[0-9]*" />
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label>Chest</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img class="itemImg" src="" data-toggle="tooltip" title="Some tooltip text!">
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input id="chest" class="val" type="text" pattern="[0-9]*" />
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label>Legs</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img class="itemImg" src="" data-toggle="tooltip" title="Some tooltip text!">
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input id="legs" class="val" type="text" pattern="[0-9]*" />
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label>Class</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img class="itemImg" src="" data-toggle="tooltip" title="Some tooltip text!">
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input id="class" class="val" type="text" pattern="[0-9]*" />
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label>Artifact</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<img class="itemImg" src="" data-toggle="tooltip" title="Some tooltip text!">
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input id="artifact" class="val" type="text" pattern="[0-9]*" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12"><p class="text-center">Developed by <a href="http://mattaltepeter.com">Matt Altepeter</a> | Add me on Xbox One: <a href="https://account.xbox.com/en-US/Profile?xr=mebarnav" target="_blank">COUGAR CHAS3R</a> | My characters: 304 Hunter, 300 Warlock, 298 Titan</p></div>
			</div>
		</div>
		<script src="js/ga.js"></script>
	</body>
</html>
