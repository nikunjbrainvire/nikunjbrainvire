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


                <div class="col-md-5">

                    <form method="POST" enctype="multipart/form-data" role="form" action="/admin/updatebook/{{ $editbook->id }}">
                        @csrf
                        <div class="form-group">
                            <label>Book Name</label>
                            <input class="form-control" type="text" name="bookname" placeholder="Book Name" value="{{ $editbook->book_name }}">
                            <span style="color: red">@error('bookname'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <input class="form-control" type="text" name="bookcategory" placeholder="Category" value="{{ $editbook->book_Category }}">
                            <span style="color: red">@error('bookcategory'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Author</label>
                            <input class="form-control" type="text" name="bookauthor" placeholder="Author" value="{{ $editbook->book_Author }}">
                            <span style="color: red">@error('bookauthor'){{ $message }}@enderror</span>
                        </div>


                        <div class="form-group">
                            <label>ISBN Number</label>
                            <input class="form-control" type="number" name="bookisbn" placeholder="Author" value="{{ $editbook->book_isbn }}">
                            <span style="color: red">@error('bookisbn'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Quantity</label>
                            <input class="form-control" type="number" name="bookquantity" placeholder="Quantity" value="{{ $editbook->book_quantity }}">
                            <span style="color: red">@error('bookquantity'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input class="form-control" type="number" name="bookprice" placeholder="Author" value="{{ $editbook->book_price }}">
                            <span style="color: red">@error('bookprice'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="file" class="form-control">

                            <span style="color: red">@error('file'){{ $message }}@enderror</span>
                            <center>
                                <label>Old Image</label><br>
                                <a data-fancybox="gallery" href="http://127.0.0.1/demo/example-app/storage/app/{{ $editbook->book_image }}"> <img height="100" src="http://127.0.0.1/demo/example-app/storage/app/{{ $editbook->book_image }}" /></a>
                            </center>
                        </div>

                        <input type="submit" class="btn btn-primary form-control">
                    </form>
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
