<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('css/pdf.css') }}" rel="stylesheet">

<script type="text/javascript" src="{{ asset('/canvasjs/canvasjs.min.js') }}"></script>

<script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: false,
      theme: "light2",
      axisX:{
        valueFormatString: "DD",
        title: "Hari",
      },
      axisY:{
        title: "Total Click",
      },
      data: [{        
        type: "area",       
        xValueType: "dateTime",
        xValueFormatString: "DD-MM-YYYY",
        dataPoints: <?php echo json_encode($chart, JSON_NUMERIC_CHECK) ?>,
      }]
    });
    chart.render();  
  };
</script>

<div class="container">
  <div class="col-xs-12 content-txt">
    <div class="row" style="margin-bottom: 100px">
      <div class="col-xs-6" align="left" >
        <img src="{{asset('image/omnilinkz-logo.png')}}">
      </div>
      <div class="col-xs-6" align="right">
        Periode : 
        <div class="date-box">
          <b>{{ date("F Y") }}</b>
        </div>
      </div>
    </div>  

    <div class="row" style="margin-bottom: 50px">
      <div class="col-xs-12">
        <span class="titel">
          <span style="font-size:40px">
            <b>{{$link->title}}</b>  
          </span>
          <br>
          URL : {{$link->link}} <br>
          <br>
          Created on : {{ date("F d, Y", strtotime($link->created_at))  }} 
        </span>
      </div>
    </div>

    <div class="row sub" style="margin-bottom: 50px">
      <div class="col-xs-9" align="center">
        <div id="chartContainer" style="height:300px; width:600px"></div>
      </div>

      <div class="col-xs-3" align="center" style="padding-top: 40px">
        <span class="click-txt">
          Total Click
        </span> <br>
        <span class="total-click">
          {{$total_click}}
        </span> <br>
        <span class="click-txt">
          dalam 30 hari
        </span>
      </div>
    </div>
  </div>
</div>