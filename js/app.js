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
		var $r = $('#r');
		
		$('#infusebtn').click(function() {
			infuse();
		});
		
		$('#higher, #lower').bind('keyup', function(e) {
			if (e.keyCode == 13 || e.keyCode == 10 ) {
				infuse();
			}
		});
		
		function infuse() {
			$.post('controls/post.php?type=4');
			var l = parseInt($('#lower').val());
			var h = parseInt($('#higher').val());
			var diff, ir;
			$ir = $('#infuser');
			
			if ( h < l ) {
				$ir.text('Higher gear value must be higher than the lower gear value');
				return false;
			}
				
			if ( l > 0 && h > 0 ) {
				diff = h - l;
				
				ir = Math.ceil((diff * .8) + l);
				
				if ( diff < 7 ) {
					ir = h;
				}
				$ir.text(ir);
			}
			else {
				$ir.text('Please fill out both fields');
			}
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
			$('#r').text(r);
		}
		
		$(document).on('click', '.character', function() {
			$('#lightCalc').hide();
			$('#charload').show();
			$.post('controls/post.php?type=2', { 'acct' : acct, 'gt' : gt});
			$r.html($(this).attr('data-ll'));
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