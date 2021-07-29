<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Login</title>
	<link href="http://127.0.0.1/demo/example-app/resources/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://127.0.0.1/demo/example-app/resources/css/datepicker3.css" rel="stylesheet">
	<link href="http://127.0.0.1/demo/example-app/resources/css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Sign Up</div>
				<div class="panel-body">
					{{-- @if($msg != ' ')
					<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> {{ $msg }}<a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>
					@endif --}}


                    @if( gettype($errors) == 'object' )

                        @if(count($errors) > 0)

                            @foreach ($errors->all() as $error)
                            <div class="alert bg-danger" role="alert">{{ $error }}</div>

                            @endforeach
                        @endif
                    @else
                        <div class="alert bg-danger" role="alert">{{ $errors }}</div>
                    @endif

                    <form role="form" method="POST" action="/register/user">
                        @csrf
						<fieldset>
                            <div class="form-group">
								<input class="form-control" placeholder="Name" name="name" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
                            <div class="form-group">
								<input class="form-control" placeholder="Confirm Password" name="cofirmpassword" type="password" value="">
							</div>
							{{-- <div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div> --}}
							<input type="submit" value="submit" class="btn btn-primary"></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->


<script src="http://127.0.0.1/demo/example-app/resources/js/jquery-1.11.1.min.js"></script>
	<script src="http://127.0.0.1/demo/example-app/resources/js/bootstrap.min.js"></script>
</body>
</html>
