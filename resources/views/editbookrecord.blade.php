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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
@date_default_timezone_set('Asia/Kolkata');
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    $(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var minDate= year + '-' + month + '-' + day;

    $('#txtDate').attr('min', minDate);
});
    </script>
<body>
@include('header');

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Edit Book</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Edit Book</h1>
			</div>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div class="row">
                <div class="col-md-3"></div>
                @foreach ($editbook as $editbook)

                {{-- @dd($editbook->name); --}}
                <div class="col-md-5">

                    <form method="POST" enctype="multipart/form-data" role="form">
                        @csrf

                        <div class="form-group">

                            <center>
                                <label>Borrowed Book Details</label><br>
                                <a data-fancybox="gallery" href="http://127.0.0.1/demo/example-app/storage/app/{{ $editbook->book_image }}"> <img height="100" src="http://127.0.0.1/demo/example-app/storage/app/{{ $editbook->book_image }}" /></a>
                            </center>
                        </div>

                        <div class="form-group">
                            <label>Book Name</label>
                            <input class="form-control" type="text" name="bookname" placeholder="Book Name" value="{{ $editbook->book_name }}" disabled>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <input class="form-control" type="text" name="bookcategory" placeholder="Category" value="{{ $editbook->book_Category }}" disabled>
                            <span style="color: red">@error('bookcategory'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Borrowed Date</label>
                            <input class="form-control" type="text" name="bookauthor" placeholder="Author" value="{{ $editbook->updated_at }}" disabled>
                            <span style="color: red">@error('bookauthor'){{ $message }}@enderror</span>
                        </div>


                        <div class="form-group">
                            <label>Person Name</label>
                            <input class="form-control" type="text" name="bookisbn" placeholder="Author" value="{{ $editbook->name }}" disabled>
                            <span style="color: red">@error('bookisbn'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Email Id</label>
                            <input class="form-control" type="text" name="bookquantity" placeholder="Quantity" value="{{ $editbook->email }}" disabled>
                            <span style="color: red">@error('bookquantity'){{ $message }}@enderror</span>
                        </div>
                        <input class="form-control" type="hidden" name="quantity" placeholder="Quantity" value="{{ $editbook->book_quantity }}" hidden>
                        <input class="form-control" type="hidden" name="upid" placeholder="Quantity" value="{{ $editbook->book_id }}" hidden>

                        <div class="form-group">
                            <label>Return Book Date</label>
                                <input class="form-control" type="date" name="returnbook" placeholder="Author" id="txtDate" value="{{ $editbook->returnbook_date }}"  >
                            <span style="color: red">@error('returnbook'){{ $message }}@enderror</span>
                        </div>



                        <input type="submit" class="btn btn-primary form-control">
                    </form>
                    @endforeach

                </div>


                <div class="col-md-3"></div>
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
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
