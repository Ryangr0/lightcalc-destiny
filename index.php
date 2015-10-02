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
				<h1>Destiny Light Level and Infusion Calculator<a class="btn btn-primary pull-right" href="http://mattaltepeter.com/destiny/analytics">View Analytics</a></h1>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p class="lead">Issues, suggestions, comments? <a href="mailto:mattaltepeter@me.com">Email me!</a></p>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12"><h3 style="margin-top: 0;">Infusion</h3></div>
				<div class="col-md-12"><p class="lead">This is the new and improved infusion calculator. In addition to calculating one infusion, you can enter up to 6 items to use as infusion fuel and it will figure out what the best path for you to infuse is (highest number, shortest amount of moves).</p>
					<p class="lead">The numbers you enter as 'infusion fuel' must have a value between the original item as well as be less than or equal to 310. Any numbers that do not meet this criteria will be removed from the calculation.</p>
					<p class="lead">According to people over <a target="_blank" href="https://www.reddit.com/r/DestinyTheGame/comments/3mtyr5/infusion_calculator/">here</a>, if the original weapon is exotic, you will only get 70% of the difference, so make sure to hit that checkbox if you are trying to use an exotic as your original weapon to get more accurate results.</p><br />
				</div>
				<div class="col-md-3">
					<label>Original Item</label>
					<input type="text" id="original-item" maxlength="3"> <br />
					<input type="checkbox" id="isExotic" value="1" /> <label for="isExotic" style="display: inline">Is this an exotic item?</label>
					<br /><br />
					
					<label>Infusion Fuel 1</label>
					<input type="text" id="fodder1" value="" maxlength="3"><br /><br />
					<label>Infusion Fuel 2</label>
					<input type="text" id="fodder2" value="" maxlength="3"> <br /><br />
					<label>Infusion Fuel 3</label>
					<input type="text" id="fodder3" value="" maxlength="3"> <br /><br />
					<label>Infusion Fuel 4</label>
					<input type="text" id="fodder4" value="" maxlength="3"> <br /><br />
					<label>Infusion Fuel 5</label>
					<input type="text" id="fodder5" value="" maxlength="3"> <br /><br />
					<label>Infusion Fuel 6</label>
					<input type="text" id="fodder6" value="" maxlength="3"> <br /><br />
					<button class="btn btn-default btn-sm" id="complex">Calculate</button>
			</div>
			<div class="col-md-9" id="infusionres">
				<div class="page-header" style="margin-top: 0">
					<h3 style="margin-top: 0">Infusion Results</h3>
				</div>
				<div id="res" class="lead">
					<p class="lead">This table shows how to use the items you entered to achieve maximum level for your original gear. The value listed in each column (besides result) shows the value of the item you should use as infusion fuel next. The row highlighted in green shows the recommended infusion path (pretty much the highest number you can achieve in the fewest amount of moves possible). </p>
					<p class="lead">To follow this table, infuse your original item with the item in 'step 1', if you wish to do more infusions, infuse the item in 'step 2' and so on, in to the result from the previous step.</p>
					<p class="lead">This allows you to chose if doing an extra infusion is worth the extra cost (legendary marks, etc)</p>
					<div id="table-res"></div>
				</div>
				<div id="simpleres"></div>
			</div>


		</div>
			<hr>
			<div class="row">
				<div class="col-md-12"><h3 style="margin-top: 0;">Light Calculator</h3></div>
				<div class="col-md-12">
				<p class="lead">Select your platform, enter your gamertag, and wait for the system to load your characters. Simply click on one of your characters to load all of your <strong>equipped</strong> weapons into the text boxes below. Once loaded, you can change numbers to see how your light level will change with the new numbers. </p></div>
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
					<h1 id="lightres">--</h1><br />
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
				<div class="col-md-12"><p class="text-center">Developed by <a href="http://mattaltepeter.com">Matt Altepeter</a> | <a href="https://github.com/maltepet/lightcalc-destiny" target="_blank">Source code</a> | Add me on Xbox One: <a href="https://account.xbox.com/en-US/Profile?xr=mebarnav" target="_blank">COUGAR CHAS3R</a> | My characters: 304 Hunter, 300 Warlock, 298 Titan</p></div>
			</div>
		</div>
		<script src="js/ga.js"></script>
	</body>
</html>
