$(function() {
		$('[data-toggle="tooltip"]').tooltip();

		$.post('controls/post.php?type=0');

		var mid, mtype, gt, acct;
		var $primary = $('#primary');
		var $secondary = $('#secondary');
		var $heavy = $('#heavy');
		var $ghost = $('#ghost');
		var $helmet = $('#helmet');
		var $gauntlets = $('#gauntlets');
		var $chest = $('#chest');
		var $legs = $('#legs');
		var $class = $('#class');
		var $artifact = $('#artifact');
		var $lr = $('#lightres');

		$ir = $("#infusionres");
		$r = $('#res');
		$sr = $('#simpleres');
		$tr = $('#table-res');
		
		var $e = $('#isExotic');
		var exotic = false;
		var amt;
		
		$('#complex').click(function() {
			complexInfuse();
		});

		function complexInfuse() {
			amt = 0.8;
			if ( $e.is(':checked') ) 
				amt = 0.7;
				
			$sr.hide();
			$tr.hide();
			$r.hide();
			$sr.html('');
			$tr.html('');

			var orig = parseInt($('#original-item').val());
			var f1 = parseInt($('#fodder1').val());
			var f2 = parseInt($('#fodder2').val());
			var f3 = parseInt($('#fodder3').val());
			var f4 = parseInt($('#fodder4').val());
			var f5 = parseInt($('#fodder5').val());
			var f6 = parseInt($('#fodder6').val());

			var fodder = [f1, f2, f3, f4, f5, f6];
			var numLength = 0;
			var removedIndex = 0;

			if ( isNaN(orig) || orig <= 0 || orig > 310 ) {
				$sr.html('<h3 style="color: red">Invalid original number (can not be less than 0 or greater than 310)</h3>');
				$sr.show();
				return false;
			}

			for (var i = 0; i < fodder.length; i++) {
				if ( isNaN(fodder[i]) || fodder[i] <= 0 || fodder[i] > 310 || fodder[i] <= orig) {
					fodder.splice(i, 1);
					i--;
				}
			}

			var fLen = fodder.length;

			if ( fLen == 0 ) {
				$sr.html('<h3 style="color: red"> Please enter number(s) to perform infusion!</h3>');
				$sr.show();
				return false;
			}

			else {
				if ( fLen == 1 )
					$.post('controls/post.php?type=4');
				else
					$.post('controls/post.php?type=6');

				var sorted = fodder;
				sorted.sort(function(a, b) { return a - b; });

				var onestep = []; //[[original, sorted-index, result]]
				var twostep = []; //[[onestep-index, sorted-index, result]]
				var threestep = [];
				var fourstep = [];
				var fivestep = [];
				var sixstep = 0;

				var oInd = 0;
				var jInd = 0;
				var kInd = 0;
				var lInd = 0;
				var mInd = 0;

				for (var i = 0; i < sorted.length; i++) {
					onestep[i] = [];
					onestep[i][0] = sorted[i]; //item using to infuse
					onestep[i]['result'] = inf(sorted[i], orig);

					for ( var j = i+1; j < sorted.length; j++) {
						twostep[jInd] = [];
						twostep[jInd][0] = onestep[i][0];
						twostep[jInd][1] = sorted[j];
						twostep[jInd]['result'] = inf(sorted[j], onestep[i]['result']);

						for (var k = j+1; k < sorted.length; k++) {
							threestep[kInd] = [];
							threestep[kInd][0] = onestep[i][0];
							threestep[kInd][1] = twostep[jInd][1];
							threestep[kInd][2] = sorted[k];
							threestep[kInd]['result'] = inf(sorted[k], twostep[jInd]['result']);

							for (var l = k+1; l < sorted.length; l++) {
								fourstep[lInd] = [];
								fourstep[lInd][0] = onestep[i][0];
								fourstep[lInd][1] = twostep[jInd][1];
								fourstep[lInd][2] = threestep[kInd][2];
								fourstep[lInd][3] = sorted[l];
								fourstep[lInd]['result'] = inf(sorted[l], threestep[kInd]['result']);

								for (var m = l+1; m < sorted.length; m++) {
									fivestep[mInd] = [];
									fivestep[mInd][0] = onestep[i][0];
									fivestep[mInd][1] = twostep[jInd][1];
									fivestep[mInd][2] = threestep[kInd][2];
									fivestep[mInd][3] = fourstep[lInd][3];
									fivestep[mInd][4] = sorted[m];
									fivestep[mInd]['result'] = inf(sorted[m], fourstep[lInd]['result']);

									for (var n = m+1; n < sorted.length; n++) {
										sixstep = inf(sorted[n], fivestep[mInd]['result']);
									}
									mInd++;
								}
								lInd++;
							}
							kInd++;
						}
						jInd++;
					}
				}

				var max1arr = [];
				var max2arr = [];
				var max3arr = [];
				var max4arr = [];
				var max5arr = [];

				var m1 = 0;
				var m2 = 0;
				var m3 = 0;
				var m4 = 0;
				var m5 = 0;

				var m1i = 0;
				var m2i = 0;
				var m3i = 0;
				var m4i = 0;
				var m5i = 0;

				$.each(onestep, function(i) {
						if ( this['result'] > m1 ) {
							m1 = this['result'];
							m1i = i;
						}
				});

				$.each(twostep, function(i) {
						if ( this['result'] > m2 ) {
							m2 = this['result'];
							m2i = i;
						}
				});

				$.each(threestep, function(i) {
						if ( this['result'] > m3 ) {
							m3 = this['result'];
							m3i = i;
						}
				});

				$.each(fourstep, function(i) {
						if ( this['result'] > m4 ) {
							m4 = this['result'];
							m4i = i;
						}
				});

				$.each(fivestep, function(i) {
						if ( this['result'] > m5 ) {
							m5 = this['result'];
							m5i = i;
						}
				});

				var ms = [m1, m2, m3, m4, m5, sixstep];
				var mi = 0;
				var am = 0;

				$.each(ms, function(i) {
					if (this > am) {
						am = this;
						mi = i;
					}
				});

				var numRows = 0;
				var t = "<table class='table table-striped text-center'><thead><th class='text-center'># of Steps</th><th class='text-center'>Step 1</th><th class='text-center'>Step 2</th><th class='text-center'>Step 3</th><th class='text-center'>Step 4</th><th class='text-center'>Step 5</th><th class='text-center'>Final Value</th></thead><tbody>";

				$.each(ms, function(i) {
					if ( this != 0 )
						numRows++;
				});

				for (var i = 0; i < numRows; i++) {
					var r = '';
					var arr;
					var tdc = 0;
					var t2q = false;
					switch (i) {
						case 0: arr = onestep[m1i]; tdc = 4; first = "<td>1 Step</td>"; index = m1i; maxi = 0; break;
						case 1: arr = twostep[m2i]; tdc = 3; first = "<td>2 Steps</td>"; index = m2i; maxi = 1; break;
						case 2: arr = threestep[m3i]; tdc = 2; first = "<td>3 Steps</td>"; index = m3i; maxi = 2; break;
						case 3: arr = fourstep[m4i]; tdc = 1; first = "<td>4 Steps</td>"; index = m4i; maxi = 3; break;
						case 4: arr = fivestep[m5i]; tdc = 0; first = "<td>5 Steps</td>"; index = m5i; maxi = 4; break;
						case 5: t2q = true;
					}

					if ( t2q )
						break;

					if (i == mi) {
						c = 'success';
					}
					else {
						c = '';
					}

					r = "<tr class='" + c + "'>" + first;
					for (var j = 0; j <= maxi; j++) {
						r += "<td>" + arr[j] + "</td>";
					}

					for (var k = 0; k < tdc; k++) {
						r += "<td>--</td>";
					}

					r += "<td><strong>" + arr['result'] + "</strong></td></tr>";
					t += r;

				}

				t += "</tbody></table>";

				$tr.append(t);
				$ir.show();
				$r.show();
				$tr.show();
			}
		}

		function inf(num1, num2) { //num1 higher num2 lower
			console.log(amt);
			var diff = num1 - num2;
			var r = 0;

			if ( diff < 7) {
				r = num2 + diff;
			}
			else {
				r = Math.ceil((diff * amt) + num2);
			}

			return r;
		}

		$('input[type=radio]').change(function() {
			 $('#lightCalc').hide();
			 $('#chars').html('');
			 $('#gt').val('');
		});

		$('#primary, #secondary, #heavy, #ghost, #helmet, #gauntlets, #legs, #chest, #class, #artifact').change(function() {
			$(this).parent().find('.weaponName').text('');
			var primary = parseInt($('#primary').val());
			var secondary = parseInt($('#secondary').val());
			var heavy = parseInt($('#heavy').val());
			var ghost = parseInt($('#ghost').val());
			var helmet = parseInt($('#helmet').val());
			var gauntlets = parseInt($('#gauntlets').val());
			var legs = parseInt($('#legs').val());
			var chest = parseInt($('#chest').val());
			var cls = parseInt($('#class').val());
			var artifact = parseInt($('#artifact').val());

			if ( $.isNumeric(primary) && $.isNumeric(secondary) && $.isNumeric(heavy) && $.isNumeric(ghost) && $.isNumeric(helmet) && $.isNumeric(gauntlets) && $.isNumeric(legs) && $.isNumeric(chest) && $.isNumeric(cls) && $.isNumeric(artifact) )
				light(primary, secondary, heavy, ghost, helmet, gauntlets, legs, chest, cls, artifact);

		});

		function light(primary, secondary, heavy, ghost, helmet, gauntlets, legs, chest, cls, artifact) {
			$.post('controls/post.php?type=3', { 'acct': acct, 'gt':gt});

			var vars = [primary, secondary, heavy, ghost, helmet, gauntlets, legs, chest, cls, artifact];
			pos = true;

			vars.forEach(function(num) {
				if ( num <= 0 )
					pos = false;
			});

			if ( !pos ) {
				$('#r').text('--');
				return;
			}

			var wepWeight = .36;
			var armWeight = .40;
			var otherWeight = .24;

			var wepT = (primary + secondary + heavy) / 3;
			var armT = (helmet + gauntlets + legs + chest) / 4;
			var oT = (ghost + cls + artifact) / 3;

			var r = Math.floor(wepT * wepWeight + armT * armWeight + oT * otherWeight);
			$lr.text(r);
		}

		$(document).on('click', '.character', function() {
			$('#lightCalc').hide();
			$('#charload').show();
			$.post('controls/post.php?type=2', { 'acct' : acct, 'gt' : gt});
			$lr.html($(this).attr('data-ll'));
			$('#sel-class').text($(this).attr('data-cls'));
			$('.character.selected').removeClass('selected');
			$(this).addClass('selected');
			var cid = $(this).attr('data-id');

			$.post('controls/request.php?r=inv', { 'cid' : cid, 'mid' : mid, 'mtype' : mtype}, function(response) {
				$('#charload').hide();
				var d = JSON.parse(response);
				$.each(d, function(i) {
					var itemImg = 'http://bungie.net' + this.icon;
					$('#lightCalc img').eq(i).attr('src', itemImg);
					$('#lightCalc img').eq(i).attr('title', this.name).tooltip('fixTitle');
					$('#lightCalc input').eq(i).val(this.val);
				});
				$("#lightCalc").show();
			});
		});

	$('#search').click(function() {
		if ( gt !== $('#gt').val() ) {
			getChar();
		}
	});

	$('#gt').bind('keyup', function(e) {
		if ( gt !== $('#gt').val() ) {
			if (e.keyCode == 13 || e.keyCode == 10 ) {
				getChar();
			}
		}
	});

	function getChar() {
		$('#lightCalc').hide();
		$('#chars').html('<h3 style="text-align:center">Loading...</h3>');
		gt = $('#gt').val();
		acct = $('input[name=acct]:checked').val();
		$.post('controls/post.php?type=1', { 'gt' : gt, 'acct' : acct});

		$.post('controls/request.php?r=search', { 'platform' : acct, 'gt' : encodeURIComponent(gt) }, function(response) {
			var d = JSON.parse(response);
			if ( d.membershipId == null ) {
				$('#chars').html('<h3 style="text-align:center">User not found!</h3>');
			}

			else {
				$('#chars').html('');

				mid = d.membershipId;
				mtype = d.membershipType;

				$.each(d.characters, function() {
					var c = this;
					var ll = c.lightLevel;
					var bl = c.baseLevel;
					var em = 'http:///bungie.net' + c.emblem;
					var bg = 'http:///bungie.net' + c.bg;
					var cls = c.cls;
					var sex = c.sex;
					var race = c.race;
					var id = c.cId;

					html = "<div class='character' style='background-image: url(" + bg + ");' data-ll='" + ll + "' data-cls='" + cls + "'data-id='" + id + "'>";
					html += "<div class='emblem'><img height='87px' src='" + em + "' /></div>";
					html += "<div class='details'><h2>" + cls + "</h2><h5>" + race + " " + sex + "</h5></div><div class='levels'><span class='baselvl'>" + bl + "</span><span class='light'>" + ll + "</span></div>";
					$('#chars').append(html);
				});
			}
		});
	}
});
