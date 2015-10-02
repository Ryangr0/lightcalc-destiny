$(function() {
	$.post('controls/post.php?type=5');
	
	var $totalviews = $('#totalviews');
	var $totalinfuse = $('#totalinfuse');
	var $totalsearches = $('#totalsearches');
	var $totalselections = $('#totalselections');
	var $totallight = $('#totallight');
	
	var $weeklyviews = $('#weeklyviews');
	var $weeklyinfuse = $('#weeklyinfuse');
	var $weeklysearches = $('#weeklysearches');
	var $weeklyselections = $('#weeklyselections');
	var $weeklylight = $('#weeklylight');
	
	var $monthlyviews = $('#monthlyviews');
	var $monthlyinfuse = $('#monthlyinfuse');
	var $monthlysearches = $('#monthlysearches');
	var $monthlyselections = $('#monthlyselections');
	var $monthlylight = $('#monthlylight');
	
	var $todayviews = $('#todayviews');
	var $todayinfuse = $('#todayinfuse');
	var $todaysearches = $('#todaysearches');
	var $todayselections = $('#todayselections');
	var $todaylight = $('#todaylight');
	
	var $pt = $('#platformtop');
	var $bt = $('#bartop');
	
	var gtpiectx = document.getElementById('gtpie').getContext('2d');
	var cspiectx = document.getElementById('cspie').getContext('2d');
	var lcpiectx = document.getElementById('lcpie').getContext('2d');
	
	var todaybar = document.getElementById('todaybar').getContext('2d');
	
	var xboxColor = '#52b043';
	var xboxHighlight = '#71CC62';
	var psColor = "#003087";
	var psHighlight = "#3865B5";
	
	var bc1 = "#ff2052"; //rgba(255, 32, 82, .5)
	var bc2 = "#6441a5"; //rgba(100, 65, 165, .5)
	var bc3 = "#01b5dd"; //rgba(1, 181, 221, 0.5)
	var bc4 = "#b0db64"; //rgba(179, 219, 100, 0.5)
	var bcdone = false;
	var pddone = false;
	
	bcdone = getPlatformData();
	pddone = barChart();
	
	var rid = setInterval(function() {
		console.log('checking again...');
		if ( bcdone && pddone ) {
			$('#loading').hide();
			$('#pielabels').show();
			$pt.show();
			$bt.show();
			clearInterval(rid);
		}
	}, 500);
	
	function barChart() {			
		$.get('controls/getAnalytics.php?r=getCounts', function(response) {
			data = JSON.parse(response);
			
			var tv = data.t.vcount;
			var ti = data.t.icount;
			var tu = data.t.ucount;
			var ts = data.t.scount;
			var tl = data.t.lcount;
			var tmi = data.t.micount;
			
			var mv = data.m.vcount;
			var mi = data.m.icount;
			var mu = data.m.ucount;
			var ms = data.m.scount;
			var ml = data.m.lcount;
			var mmi = data.m.micount;
			
			var wv = data.w.vcount;
			var wi = data.w.icount;
			var wu = data.w.ucount;
			var ws = data.w.scount;
			var wl = data.w.lcount;
			var wmi = data.w.micount;
			
			var dv = data.d.vcount;
			var di = data.d.icount;
			var du = data.d.ucount;
			var ds = data.d.scount;
			var dl = data.d.lcount;
			var dmi = data.d.micount;
			
			var options = {
				multiTooltipTemplate: "<%= datasetLabel %>: <%= value %>",
			};
			
			var data = {
				labels: ["Views", "Infusion Calculations", "Infusion Calculations (multiple items)", "User Searches", "Character Selections", "Light Calculations"],
				datasets: [
					{
						label: "Today",
						fillColor: "rgba(255, 32, 82, 0.7)",
						strokeColor: "rgba(255, 32, 82, 0.7)",
						highlightFill: "rgba(255, 32, 82, 0.8)",
						highlightStroke: "rgba(255, 32, 82, 0.8)",
						data: [dv, di, dmi, du, ds, dl]
					},
					{
						label: "Past Week",
						fillColor: "rgba(100, 65, 165, 0.7)",
						strokeColor: "rgba(100, 65, 165, 0.7)",
						highlightFill: "rgba(100, 65, 165, 0.8)",
						highlightStroke: "rgba(100, 65, 165, 0.8)",
						data: [wv, wi, wmi, wu, ws, wl],
					},
					{
						label: "Past Month",
						fillColor: "rgba(1, 181, 221, 0.7)",
						strokeColor: "rgba(1, 181, 221, 0.7)",
						highlightFill: "rgba(1, 181, 221, 0.8)",
						highlightStroke: "rgba(1, 181, 221, 0.8)",
						data: [mv, mi, mmi, mu, ms, ml],
					},
					{
						label: "All Time",
						fillColor: "rgba(179, 219, 100, 0.7)",
						strokeColor: "rgba(179, 219, 100, 0.7)",
						highlightFill: "rgba(179, 219, 100, 0.8)",
						highlightStroke: "rgba(179, 219, 100, 0.8)",
						data: [tv, ti, tmi, tu, ts, tl],
					}
				]
			};
			var barchart = new Chart(todaybar).Bar(data, options);
		});
		
		return true;
	}
	
	
	function getPlatformData() {
		$.get('controls/getAnalytics.php?r=getPlatformData', function(response) {
			data = JSON.parse(response);

			var gtPieData = [
				{
					//xbl
					value: data.gt.xcount,
					color: "rgba(179, 219, 100, 0.7)",
					highlight: "rgba(179, 219, 100, 0.8)",
					label: 'Xbox Live'
				},
				{
					//psn
					value: data.gt.pcount,
					color: "rgba(1, 181, 221, 0.7)",
					highlight: "rgba(1, 181, 221, 0.8)",
					label: 'PlayStation Network'
				}
			];
			
			var csPieData = [
				{
					//xbl
					value: data.char.xcount,
					color: "rgba(179, 219, 100, 0.7)",
					highlight: "rgba(179, 219, 100, 0.8)",
					label: 'Xbox Live'
				},
				{
					//psn
					value: data.char.pcount,
					color: "rgba(1, 181, 221, 0.7)",
					highlight: "rgba(1, 181, 221, 0.8)",
					label: 'PlayStation Network'
				}
			];
			
			var lcPieData = [
				{
					//xbl
					value: data.light.xcount,
					color: "rgba(179, 219, 100, 0.7)",
					highlight: "rgba(179, 219, 100, 0.8)",
					label: 'Xbox Live'
				},
				{
					//psn
					value: data.light.pcount,
					color: "rgba(1, 181, 221, 0.7)",
					highlight: "rgba(1, 181, 221, 0.8)",
					label: 'PlayStation Network'
				}
			];
			
			
			var gtPieChart = new Chart(gtpiectx).Pie(gtPieData);
			var csPieChart = new Chart(cspiectx).Pie(csPieData);
			var lcPieChart = new Chart(lcpiectx).Pie(lcPieData);
		});
		
		return true;
	}
});