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
					<li role="presentation"><a href="#jaar" aria-controls="year" role="tab" data-toggle="tab">Jaar</a></li>
					<li role="presentation"><a href="#maand" aria-controls="maand" role="tab" data-toggle="tab">Maand</a></li>
					<li role="presentation"class="active"><a href="#week" aria-controls="week" role="tab" data-toggle="tab">Week</a></li>
				</ul>

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade" id="jaar">
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
					<div role="tabpanel" class="tab-pane fade in active" id="week">
						<div class="form-group">
							
							<select class="form-control yearweek-select">
								<option value="2016">2016</option>
								<option value="2015">2015</option>
							</select>	
							<select class="form-control week-select">
								<option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
								<option value="32">32</option>
								<option value="33">33</option>
								<option value="34">34</option>
								<option value="35">35</option>
								<option value="36">36</option>
								<option value="37">37</option>
								<option value="38">38</option>
								<option value="39">39</option>
								<option value="40">40</option>
								<option value="41">41</option>
								<option value="42">42</option>
								<option value="43">43</option>
								<option value="44">44</option>
								<option value="45">45</option>
								<option value="46">46</option>
								<option value="47">47</option>
								<option value="48">48</option>
								<option value="49">49</option>
								<option value="50">50</option>
								<option value="51">51</option>
								<option value="52">52</option>
							</select>	
						</div>
						
						<div id="week-chart" style="width: 100%; height: 350px;"></div>
					</div>
				</div>
        	</div>
        </div> 

@endsection
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			var yearNow = moment().format('YYYY');
			var monthNow = moment().format('MM');
			var weekNow = moment().format('W');
			fillYearData(yearNow);
			fillMonthYearData(monthNow,yearNow);
			fillMonthYearWeekData(weekNow, yearNow);
		});

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
				"dataProvider": []
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
			"dataProvider": []
		}
	);

	$('.month-select, .yearmonth-select').on('change', function() {

		var monthValue = $('.month-select').val();
		var yearMonthValue = $('.yearmonth-select').val();
		
		fillMonthYearData(monthValue,yearMonthValue);
	});
		//week
		var week = AmCharts.makeChart("week-chart", {
				"type": "serial",
				"language": "nl",
				"categoryField": "date",
				"columnWidth": 0,
				"dataDateFormat": "YYYY-MM-DD",
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
					"parseDates": true
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
				"dataProvider": []
		});
		
	week.addListener("rendered", handleLoading);
	
	$('.week-select, .yearmonth-select').on('change', function() {

		var weekValue = $('.week-select').val();
		var yearMonthValue = $('.yearmonth-select').val();
		
		fillMonthYearWeekData(weekValue,yearMonthValue);
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

		function fillMonthYearWeekData(month,year){
			$.post('/api/v1/statistics/week', {week: month, year: year })
			.done(function(data) { 
				console.log(data);
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
				console.log(maandArray);
				week.dataProvider = maandArray;
				week.validateData();
			});
		}
	</script>
@endsection