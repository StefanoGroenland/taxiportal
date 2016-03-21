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
                   <div class="row">
                   		<div class="col-lg-12 col-md-12">
                   			<div id="graph"></div>
                   		</div>
                   </div>
               </div>
            </div>
@endsection
@section('scripts')
    <script src="{{URL::asset('../assets/js/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('../assets/js/morris-0.4.3.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	
	 
	Morris.Line({
          element: 'graph',
          data: [

		    { "month": {{$janClicks}},"period":"2016-01"},
		    { "month": {{$febClicks}},"period": "2016-02" },
		    { "month": {{$maaClicks}},"period": "2016-03" },
		    { "month": {{$aprClicks}},"period": "2016-04" },
		    { "month": {{$meiClicks}},"period": "2016-05" },
		    { "month": {{$junClicks}},"period": "2016-06" },
		    { "month": {{$julClicks}},"period": "2016-07" },
		    { "month": {{$augClicks}},"period": "2016-08" },
		    { "month": {{$sepClicks}},"period": "2016-09" },
		    { "month": {{$oktClicks}},"period": "2016-10" },
		    { "month": {{$novClicks}},"period": "2016-11" },
		    { "month": {{$decClicks}},"period": "2016-12" }

		  ],
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
</script>
@endsection

