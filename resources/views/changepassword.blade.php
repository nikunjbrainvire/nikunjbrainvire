<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Dashboard</title>
	<link href="http://127.0.0.1/demo/example-app/resources/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://127.0.0.1/demo/example-app/resources/css/font-awesome.min.css" rel="stylesheet">
	<link href="http://127.0.0.1/demo/example-app/resources/css/datepicker3.css" rel="stylesheet">
	<link href="http://127.0.0.1/demo/example-app/resources/css/styles.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
@include('header');


	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Change Password</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Change Password</h1>
			</div>
		</div><!--/.row-->

        {{-- @if (gettype($errors) != 'object')
            <div class="alert bg-success" style="color:black;" role="alert">{{ $errors }}</div>
        @endif --}}
        <div id="mydiv">
        @if( gettype($errors) == 'object' )

        @if(count($errors) > 0)

            @foreach ($errors->all() as $error)
            <div class="alert bg-danger" role="alert">{{ $error }}</div>

            @endforeach
        @endif
    @else
        <div class="alert bg-danger" role="alert">{{ $errors }}</div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success">

    <strong role="alert" class="">{!! Session::get('success') !!}</strong>

    </div>
    @endif
        </div>

        <script>

        $('#mydiv').delay(3500).hide(500);

        </script>



		<div class="panel panel-container">
			<div class="row">
                <div class="col-md-5 ">
                    <form class="form-group panel-body" method="POST" action="{{ route('admin.changePassword') }}">
                        @csrf
                        <div class="form-group">
                            <label>Old Password</label>
                            <input class="form-control" type="password" name="oldpass" placeholder="Old Password">
                            {{-- <span style="color: red">@error('oldpass'){{ $message }}@enderror</span> --}}
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input class="form-control" type="password" name="newpass" placeholder="New Password">
                            {{-- <span style="color: red">@error('newpass'){{ $message }}@enderror</span> --}}
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input class="form-control" type="password" name="confirmpass" placeholder="Confirm Password">
                            {{-- <span style="color: red">@error('confirmpass'){{ $message }}@enderror</span> --}}
                        </div>

                        <input type="submit" class="btn btn-primary form-control">
                    </form>


            </div>
            </div>
		</div>

	</div>	<!--/.main-->

	<script src="http://127.0.0.1/demo/example-app/resources/js/jquery-1.11.1.min.js"></script>
	<script src="http://127.0.0.1/demo/example-app/resources/js/bootstrap.min.js"></script>
	<script src="http://127.0.0.1/demo/example-app/resources/js/chart.min.js"></script>
	<script src="http://127.0.0.1/demo/example-app/resources/js/chart-data.js"></script>
	<script src="http://127.0.0.1/demo/example-app/resources/js/easypiechart.js"></script>
	<script src="http://127.0.0.1/demo/example-app/resources/js/easypiechart-data.js"></script>
	<script src="http://127.0.0.1/demo/example-app/resources/js/bootstrap-datepicker.js"></script>
	<script src="http://127.0.0.1/demo/example-app/resources/js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>

</body>
</html>
