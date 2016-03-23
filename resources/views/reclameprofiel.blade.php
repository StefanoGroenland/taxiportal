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
								<option value="1">2016</option>
								<option value="2">2015</option>
							</select>	
						</div>
						
						<div id="year"></div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="maand">
						<div id="month"></div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="week">
						<div id="week">
					</div>
				</div>
        	</div>


        </div> 

@endsection
@section('scripts')

    <script src="{{URL::asset('../assets/js/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('../assets/js/morris-0.4.3.min.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
	

		$('a[href="#maand"]').on('shown.bs.tab', function (e) {
			maand.redraw();
			$('#month svg').attr('width', '100%');
		});

		$('a[href="#year"]').on('shown.bs.tab', function (e) {
			jaar.redraw();
			$('#year svg').attr('width', '100%');
		});

		$('a[href="#week"]').on('shown.bs.tab', function (e) {
			week.redraw();
			$('#week svg').attr('width', '100%');
		});

		$('.year-select').on('change', function() {
			var yearValue = $(this).val();
			
			$.post('test.dev/api/v1/statistics/year', yearValue)
				.done(function(data) {
					console.log(data);
					yearObject = [

						    {"month": {{$janClicks}},"period": "2016-01"},
						    {"month": {{$febClicks}},"period": "2016-02"},
						    {"month": {{$maaClicks}},"period": "2016-03"},
						    {"month": {{$aprClicks}},"period": "2016-04"},
						    {"month": {{$meiClicks}},"period": "2016-05"},
						    {"month": {{$junClicks}},"period": "2016-06"},
						    {"month": {{$julClicks}},"period": "2016-07"},
						    {"month": {{$augClicks}},"period": "2016-08"},
						    {"month": {{$sepClicks}},"period": "2016-09"},
						    {"month": {{$oktClicks}},"period": "2016-10"},
						    {"month": {{$novClicks}},"period": "2016-11"},
						    {"month": {{$decClicks}},"period": "2016-12"}
						  ]

						 jaar.redraw();

				});

		});

		var yearObject = [

		    {"month": {{$janClicks}},"period": "2016-01"},
		    {"month": {{$febClicks}},"period": "2016-02"},
		    {"month": {{$maaClicks}},"period": "2016-03"},
		    {"month": {{$aprClicks}},"period": "2016-04"},
		    {"month": {{$meiClicks}},"period": "2016-05"},
		    {"month": {{$junClicks}},"period": "2016-06"},
		    {"month": {{$julClicks}},"period": "2016-07"},
		    {"month": {{$augClicks}},"period": "2016-08"},
		    {"month": {{$sepClicks}},"period": "2016-09"},
		    {"month": {{$oktClicks}},"period": "2016-10"},
		    {"month": {{$novClicks}},"period": "2016-11"},
		    {"month": {{$decClicks}},"period": "2016-12"}
		  ]

	// Year graphics
		var jaar = Morris.Line({
          element: 'year',
          data: yearObject,
          xkey: 'period',
          ykeys: ['month'],
          labels: ['Aantal kliks'],
          hideHover: 'auto',
          xLabelAngle: 40,
          xLabelFormat: function (x) {
                  var IndexToMonth = [ "januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december" ];
                  var month = IndexToMonth[ x.getMonth() ];
                  var year = x.getFullYear();
                  return month;
              },
          dateFormat: function (x) {
                  var IndexToMonth = [ "januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december" ];
                  var month = IndexToMonth[ new Date(x).getMonth() ];
                  var year = new Date(x).getFullYear();
                   return month;
              },
          resize: true
      });

	// Month graphics
	var maand = Morris.Bar({
	  element: 'month',
	  data: [

	  	@foreach($list as $kee => $value)
	  	{day: '{{$value}}',
	    	@foreach($clickCount as $key => $val)
	    		@if($key == $value)   		
	    			 clicks:'{{$val}}'
	    		@endif
	    	@endforeach
	    	},
	    @endforeach
	  ],
	 	xkey: 'day',
        ykeys: ['clicks'],
	    hideHover: 'auto',
        xLabelAngle: 40,
	    labels: ['Aantal kliks'],
	    resize: true
	});


// Week graphics
	var week = Morris.Bar({
	  element: 'week',
	  data: [
	  @foreach($dagen_week as $kee => $value)
	  	
	  	{week: '{{$value}}',
	    	@foreach($clickCount as $key => $val)
	    		@if($key == $value)   		
	    			 clicks:'{{$val}}'
	    		@endif
	    	@endforeach
	    	},
	    @endforeach
	    	
	  ],
	 	xkey: 'week',
        ykeys: ['clicks'],
	    hideHover: 'auto',
        xLabelAngle: 40,
	    labels: ['Aantal kliks'],
	    resize: true
	});
	</script>
@endsection

