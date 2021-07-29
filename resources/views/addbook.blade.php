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
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
@include('header');
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">Welocme Admin</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li ><a href="/admin/dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>

        <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
            <em class="fa fa-navicon">&nbsp;</em> Manager Book <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a class="active" href="/admin/addbook">
                    <span class="fa fa-arrow-right">&nbsp;</span> Add Book
                </a></li>
                <li><a class="" href="/admin/viewbook">
                    <span class="fa fa-arrow-right">&nbsp;</span> view Book
                </a></li>

            </ul>
        </li>
        <li><a href="/admin/viewuser"><em class="fa fa-navicon">&nbsp;</em> Manage User</a></li>
        <li><a href="/admin/changepassword"><em class="fa fa-navicon">&nbsp;</em> Change Password</a></li>
        <li><a href="/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Add Book</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Add Book</h1>
			</div>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div class="row">
                <div class="col-md-3"></div>


                <div class="col-md-5">



                    <form method="POST" enctype="multipart/form-data" role="form" action="/admin/addbook">
                        @csrf
                        <div class="form-group">
                            <label>Book Name</label>
                            <input class="form-control" type="text" name="bookname" placeholder="Book Name">
                            <span style="color: red">@error('bookname'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <input class="form-control" type="text" name="bookcategory" placeholder="Category">
                            <span style="color: red">@error('bookcategory'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Author</label>
                            <input class="form-control" type="text" name="bookauthor" placeholder="Author">
                            <span style="color: red">@error('bookauthor'){{ $message }}@enderror</span>
                        </div>


                        <div class="form-group">
                            <label>ISBN Number</label>
                            <input class="form-control" type="number" name="bookisbn" placeholder="ISBN Number">
                            <span style="color: red">@error('bookisbn'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input class="form-control" type="number" name="bookprice" placeholder="Price In INR">
                            <span style="color: red">@error('bookprice'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="file" class="form-control">
                            <span style="color: red">@error('file'){{ $message }}@enderror</span>
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
