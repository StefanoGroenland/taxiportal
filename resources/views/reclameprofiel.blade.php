@extends('layouts.master')

@section('content')
		<div class="page-content">
            @if (count($errors))
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
                     @endforeach
                </ul>
            @endif
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                            </p>
                        </div>
                    </div>
                @endif
            @endforeach
           <div class="portlet light bordered">
       	       <div class="portlet-title">
       	           <div class="caption font-grey-gallery">
       	               <i class="fa fa-bar-chart font-grey-gallery"></i>
       	               <span class="caption-subject bold uppercase">Reclame profiel : {{$ad->link}}</span>
       	           </div>     
       	       </div>


       	        <ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#jaar" aria-controls="year" role="tab" data-toggle="tab">Jaar</a></li>
					<li role="presentation"><a href="#maand" aria-controls="maand" role="tab" data-toggle="tab">Maand</a></li>
					<li role="presentation"><a href="#week" aria-controls="week" role="tab" data-toggle="tab">Week</a></li>
				</ul>

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="jaar">
						<div class="form-group">
							<select class="form-control year-select">
								<option value="2016">2016</option>
								<option value="2015">2015</option>
							</select>	
						</div>
						
						<div id="jaar-chart" style="width: 100%; height: 350px;"></div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="maand">
						<div class="form-group">
							<select class="form-control month-select">
								<option value="01">januari</option>
								<option value="02">februari</option>
								<option value="03">maart</option>
								<option value="04">april</option>
								<option value="05">mei</option>
								<option value="06">juni</option>
								<option value="07">juli</option>
								<option value="08">augustus</option>
								<option value="09">september</option>
								<option value="10">oktober</option>
								<option value="11">november</option>
								<option value="12">december</option>
							</select>	
						</div>
						<div class="form-group">
							<select class="form-control yearmonth-select">
								<option value="2016">2016</option>
								<option value="2015">2015</option>
							</select>	
						</div>
						
						<div id="maand-chart" style="width: 100%; height: 350px;"></div>
					</div>
					<div role="tabpanel" class="tab-pane fade " id="week">
						<div id="week">
					</div>
				</div>
        	</div>


        </div> 

@endsection
@section('scripts')


	<script type="text/javascript">
		
		$(document).ready(function(){
			var yearNow = (new Date).getFullYear();
			var monthNow = (new Date).getMonth() + 1;
			fillYearData(yearNow);
			fillMonthYearData(monthNow,yearNow);
		});
		// waarde van huidige jaar / maand
		// post call voor eerste graph uitvoeren met als params bovenstaande waardes. als jquery.document ready ofz,

	// Jaar
		var jaar = AmCharts.makeChart("jaar-chart", {
				"type": "serial",
				"language": "nl",
				"categoryField": "date",
				"columnWidth": 0,
				"dataDateFormat": "YYYY-MM",
				"maxSelectedSeries": 0,
				"autoMarginOffset": 20,
				"marginLeft": 40,
				"marginRight": 40,
				"color": "#39424a",
				"export": {
					"enabled": true
				},
				"theme": "light",
				"fontFamily": "Roboto",
				"fontSize": 13,
				"categoryAxis": {
					"parseDates": true,
					"minPeriod": "MM"
				},
				"trendLines": [],
				"language": "nl",

				"graphs": [
					{
						"balloonText": "<span style='font-size:12px;'>[[value]]</span>",
						"bullet": "round",
						"bulletBorderAlpha": 0.07,
						"bulletBorderColor": "#FFFFFF",
						"bulletBorderThickness": 10,
						"bulletColor": "#0089ae",
						
						"fixedColumnWidth": 0,
						"hideBulletsCount": 50,
						"id": "g1",
						"lineAlpha": 1,
						"lineColor": "#009dc7",
						"negativeLineColor": "#C69F9F",
						"title": "red line",
						"topRadius": 0,
						"useLineColorForBulletBorder": true,
						"valueField": "value"
					}
				],
				"guides": [],
				"valueAxes": [
					{
						"id": "v1",
						"zeroGridAlpha": 0,
						"axisAlpha": 0.1,
						"gridAlpha": 0,
						"ignoreAxisWidth": true
					}
				],
				"allLabels": [],
				"balloon": {
					"animationDuration": 0,
					"borderAlpha": 0,
					"borderColor": "#000000",
					"borderThickness": 1,
					"color": "#FFFFFF",
					"drop": true,
					"fadeOutDuration": 0,
					"fillAlpha": 0.66,
					"fillColor": "#000000",
					"fixedPosition": false,
					"shadowAlpha": 0
				},
				"titles": [],
				"dataProvider": [
					
				]
			}
		);
		
		jaar.addListener("rendered", handleLoading);
		
		function handleLoading(event) {
			$('.chart-loader-wrapper').hide();
		}

		$('a[href="#maand"]').on('shown.bs.tab', function (e) {
			//maand.redraw();
			$('#month svg').attr('width', '100%');
		});

		$('a[href="#year"]').on('shown.bs.tab', function (e) {
			//jaar.redraw();
			$('#year svg').attr('width', '100%');
		});

		$('a[href="#week"]').on('shown.bs.tab', function (e) {
			// week.redraw();
			$('#week svg').attr('width', '100%');
		});

		$('.year-select').on('change', function() {

				// roep post aan met parameter .year-select.val();
			var yearValue = $(this).val();
			fillYearData(yearValue);
			
		});

	//Maand
	var maand = AmCharts.makeChart("maand-chart", {
				"type": "serial",
				"categoryField": "date",
				"language": "nl",
				"columnWidth": 0,
				"dataDateFormat": "YYYY-MM-DD",
				"maxSelectedSeries": 0,
				"autoMarginOffset": 20,
				"marginLeft": 40,
				"marginRight": 40,
				"color": "#9EACB4",
				"export": {
					"enabled": true
				},
				"theme": "light",
				"fontFamily": "Roboto",
				"fontSize": 13,
				"categoryAxis": {
					"parseDates": true,
					"minPeriod": "DD"
				},
				"trendLines": [],
				"graphs": [
					{
						"balloonText": "<span style='font-size:12px;'>[[value]]</span>",
						"bullet": "round",
						"bulletBorderAlpha": 0.07,
						"bulletBorderColor": "#FFFFFF",
						"bulletBorderThickness": 10,
						"bulletColor": "#0089ae",
						
						"fixedColumnWidth": 0,
						"hideBulletsCount": 50,
						"id": "g1",
						"lineAlpha": 1,
						"lineColor": "#009dc7",
						"negativeLineColor": "#C69F9F",
						"title": "red line",
						"topRadius": 0,
						"useLineColorForBulletBorder": true,
						"valueField": "value"
					
					}
				],
				"guides": [],
				"valueAxes": [
					{
						"id": "v1",
						"zeroGridAlpha": 0,
						"axisAlpha": 0.1,
						"gridAlpha": 0,
						"ignoreAxisWidth": true
					}
				],
				"allLabels": [],
				"balloon": {
					"animationDuration": 0,
					"borderAlpha": 0,
					"borderColor": "#000000",
					"borderThickness": 1,
					"color": "#FFFFFF",
					"drop": true,
					"fadeOutDuration": 0,
					"fillAlpha": 0.66,
					"fillColor": "#000000",
					"fixedPosition": false,
					"shadowAlpha": 0
				},
				"titles": [],
				"dataProvider": [
					
					{
						"date": "2016-08-01",
						"value": {{$augClicks}}
					},
					{
						"date": "2016-09-01",
						"value": {{$sepClicks}}
					}
				]
				
			}
		);
		
		maand.addListener("rendered", handleLoading);
		
		function handleLoading(event) {
			$('.chart-loader-wrapper').hide();
		}

		$('a[href="#maand"]').on('shown.bs.tab', function (e) {
			//maand.redraw();
			$('#month svg').attr('width', '100%');
		});

		$('a[href="#year"]').on('shown.bs.tab', function (e) {
			//jaar.redraw();
			$('#year svg').attr('width', '100%');
		});

		$('a[href="#week"]').on('shown.bs.tab', function (e) {
			//week.redraw();
			$('#week svg').attr('width', '100%');
		});




	$('.month-select, .yearmonth-select').on('change', function() {

			var monthValue = $('.month-select').val();
			var yearMonthValue = $('.yearmonth-select').val();
			
			fillMonthYearData(monthValue,yearMonthValue);
		});
	

			function fillYearData(year){
				$.post('/api/v1/statistics/year', {year: year})
				.done(function(data) { 

					var maand     = [];
					var clicks    = [];
					var jaarArray = [];

					$.each(data.result, function(key, value) {
						maand.push(moment(value.created_at).format('YYYY-MM'));
						clicks.push(value.clicks);
					});

					var result = maand.reduce(function(res, n, i) {
					    res[n] = (res[n] + +clicks[i]) || +clicks[i];
					    return res;
					}, {});

					$.each(result, function(key, value) {
						jaarArray.push({
							"date": key,
							"value": value
						})
					});

					jaar.dataProvider = jaarArray;
					jaar.validateData();

				});
			}
			function fillMonthYearData(month,year){
				$.post('/api/v1/statistics/month', {month: month, year: year })
				.done(function(data) { 

					var dag     = [];
					var clicks    = [];
					var maandArray = [];

					$.each(data.result, function(key, value) {
						dag.push(moment(value.created_at).format('YYYY-MM-DD'));
						clicks.push(value.clicks);
					});

					var result = dag.reduce(function(res, n, i) {
					    res[n] = (res[n] + +clicks[i]) || +clicks[i];
					    return res;
					}, {});
					
					$.each(result, function(key, value) {

						maandArray.push({
							"date": key,
							"value": value
						})

					});

					maand.dataProvider = maandArray;
					maand.validateData();
				});
			}
// 		var yearObject = [

// 		    {"month": {{$janClicks}},"period": "2016-01"},
// 		    {"month": {{$febClicks}},"period": "2016-02"},
// 		    {"month": {{$maaClicks}},"period": "2016-03"},
// 		    {"month": {{$aprClicks}},"period": "2016-04"},
// 		    {"month": {{$meiClicks}},"period": "2016-05"},
// 		    {"month": {{$junClicks}},"period": "2016-06"},
// 		    {"month": {{$julClicks}},"period": "2016-07"},
// 		    {"month": {{$augClicks}},"period": "2016-08"},
// 		    {"month": {{$sepClicks}},"period": "2016-09"},
// 		    {"month": {{$oktClicks}},"period": "2016-10"},
// 		    {"month": {{$novClicks}},"period": "2016-11"},
// 		    {"month": {{$decClicks}},"period": "2016-12"}
// 		  ]

// 		  console.log(yearObject);

// 	// Year graphics
// 		var jaar = Morris.Line({
//           element: 'year',
//           data: yearObject,
//           xkey: 'period',
//           ykeys: ['month'],
//           labels: ['Aantal kliks'],
//           hideHover: 'auto',
//           xLabelAngle: 40,
//           xLabelFormat: function (x) {
//                   var IndexToMonth = [ "september", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december" ];
//                   var month = IndexToMonth[ x.getMonth() ];
//                   var year = x.getFullYear();
//                   return month;
//               },
//           dateFormat: function (x) {
//                   var IndexToMonth = [ "september", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december" ];
//                   var month = IndexToMonth[ new Date(x).getMonth() ];
//                   var year = new Date(x).getFullYear();
//                    return month;
//               },
//           resize: true
//       });

// 	// Month graphics
// 	var maand = Morris.Bar({
// 	  element: 'month',
// 	  data: [

// 	  	@foreach($list as $kee => $value)
// 	  	{day: '{{$value}}',
// 	    	@foreach($clickCount as $key => $val)
// 	    		@if($key == $value)   		
// 	    			 clicks:'{{$val}}'
// 	    		@endif
// 	    	@endforeach
// 	    	},
// 	    @endforeach
// 	  ],
// 	 	xkey: 'day',
//         ykeys: ['clicks'],
// 	    hideHover: 'auto',
//         xLabelAngle: 40,
// 	    labels: ['Aantal kliks'],
// 	    resize: true
// 	});


// // Week graphics
// 	var week = Morris.Bar({
// 	  element: 'week',
// 	  data: [
// 	  @foreach($dagen_week as $kee => $value)
	  	
// 	  	{week: '{{$value}}',
// 	    	@foreach($clickCount as $key => $val)
// 	    		@if($key == $value)   		
// 	    			 clicks:'{{$val}}'
// 	    		@endif
// 	    	@endforeach
// 	    	},
// 	    @endforeach
	    	
// 	  ],
// 	 	xkey: 'week',
//         ykeys: ['clicks'],
// 	    hideHover: 'auto',
//         xLabelAngle: 40,
// 	    labels: ['Aantal kliks'],
// 	    resize: true
// 	});
	</script>
@endsection

