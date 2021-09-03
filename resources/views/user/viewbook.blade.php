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
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">{{ Session::get('username'); }}</div>
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
        <li ><a href="/user/dashboard2"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>

        <li class="active" ><a href="/user/viewbook"><em class="fa fa-navicon">&nbsp;</em> Books</a></li>
        <li> <a href="/user/profile"><em class="fa fa-navicon">&nbsp;</em> My profile</a></li>
        <li><a href="/user/vieworder"><em class="fa fa-navicon">&nbsp;</em> My Orders</a></li>
        <li><a href="/user/viewcart"><em class="fa fa-navicon">&nbsp;</em>Add To Cart</a></li>
        <li><a href="/user/changepassword"><em class="fa fa-navicon">&nbsp;</em> Change Password</a></li>
        <li><a href="/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->
</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">View Book</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">View Book</h1>
			</div>
		</div><!--/.row-->
        @if (gettype($errors) != 'object')
        <div class="alert bg-success" style="color:black;" role="alert">{{ $errors }}</div>
        @endif

        @if(Session::has('success'))
        <div class="alert alert-danger" id='mydiv'>

        <strong role="alert" class="">{!! Session::get('success') !!}</strong>
        </div>
        @endif

        <script>

            $('#mydiv').delay(3500).hide(500);

        </script>

		<div class="panel panel-container">
			<div class="row">

                <div class="col-md-12">




                    <form method="get"  class="panel-body">

                        <div style="float: left;">
                            <select name="id" class="form-control">
                                <option value="6">6</option>
                                <option value="12">12</option>
                            </select>
                        </div>

                        <div style="float: right;">
                            <input type="text" name="search" class="">
                            <input type="submit" >
                        </div>
                    </form>

                    <div class="panel-body">
                    {{-- <table class="table table-bordered table-hover ">
                    <tr style="font-weight: bold;" align="center" >
                        <td>Id</td>
                        <td>Book Name</td>
                        <td>Book Category</td>
                        <td>Book Author</td>
                        <td>Book ISBN</td>
                        <td>Book Price</td>
                        <td>Book Image</td>
                        <td>Action</td>
                    </tr>
                    </table> --}}
                    <div class="container">
                        <div class="row test" style="border: solid 1px;"><br>
                    @php
                    $id=1;
                    @endphp

                    {{-- @dd($data->orders_id); --}}
                    @foreach ($data as $datas)


                    <div class="col-md-2" >
                        <center>

                        <img height="80" src="{{ 'http://127.0.0.1/demo/example-app/storage/app/'.$datas['book_image'] }}"></img>
                        <h5>{{ $datas['book_name'] }}</h5>
                        <h5>Price :- {{ $datas['book_price'] }}</h5>
                        <h5>Quantity :- {{ $datas['book_quantity'] }}</h5>
                        <form action="/user/viewbook" method="POST">
                            @csrf
                                <input type="hidden" name="quantity" value="{{ $datas['book_quantity']  }}" />
                                {{-- @php $s = "".$datas['id'].""; @endphp

                                @if($datas['book_quantity'] == 0)
                                <a href="#" class="btn btn-danger" name="addtocart" style="margin-bottom:3px;">Out Of stock</a>

                                @elseif (in_array($s, Session::get('orders'), TRUE))

                                <a href="#" class="btn btn-danger" name="addtocart" style="margin-bottom:3px;">Book Already Borrowed</a>

                                @elseif(in_array($s, Session::get('carts'), TRUE))

                                <a href="#" class="btn btn-danger" name="addtocart" style="margin-bottom:3px;">Already add In card</a>

                                @else --}}

                                <button type="submit" class="btn btn-primary" name="addtocart" value="{{ $datas['id'] }}" style="margin-bottom:3px;">Add to Cart</button>




                        {{-- <button type="submit" class="btn btn-danger" name="ordernow" value="{{ $datas['id'] }}" style="margin-bottom:10px;">Order Now</button> --}}
                        </form>
                        </center>
                    </div>

{{--
                    <tr align="center">
                        <td>{{ $id }}</td>
                        <td>{{ $datas['book_name'] }}</td>
                        <td>{{ $datas['book_Category'] }}</td>
                        <td>{{ $datas['book_Author'] }}</td>
                        <td>{{ $datas['book_isbn'] }}</td>
                        <td>{{ $datas['book_price'] }}</td>
                        <td> <a data-fancybox="gallery" href="{{ 'http://127.0.0.1/demo/example-app/storage/app/'.$datas['book_image'] }}"> <img height="80" src="{{ 'http://127.0.0.1/demo/example-app/storage/app/'.$datas['book_image'] }}"></img></a></td>
                        <td><a href="/admin/editbook/{{ $datas['id'] }}" class="btn btn-primary">Edit</a> <a href="/admin/deletebook/{{ $datas['id'] }}" class="btn btn-danger">Delete</a></td>
                    </tr> --}}
                    @php
                    $id++;
                    @endphp
                    @endforeach
                {{-- </table> --}}
                    </div>





                        </div>
                    </div>


        <nav aria-label="Page navigation example">
            <ul class="pagination panel-body">
                @php $linknum = 1; @endphp
                @foreach ($data->links()->elements[0] as $link)


                      <li class="page-item" ><a class="page-link"  href="{{ $link }}">{{ $linknum }}</a></li>
                    @php $linknum++; @endphp


                @endforeach

            </ul>
        </nav>

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
