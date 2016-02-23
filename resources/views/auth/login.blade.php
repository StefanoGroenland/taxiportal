<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Taxi admin portal</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
     
        <link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <link href="{{URL::asset('../assets/css/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('../assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('../assets/css/uniform.default.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('../assets/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{URL::asset('../assets/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{URL::asset('../assets/css/components-md.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('../assets/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" /> 
         
        <link href="{{URL::asset('../assets/css/login.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('../assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
    </head>
    <body class=" login">
        <div class="logo">
            <a href="index.html">
                <img src="{{URL::asset('../assets/img/logo.png')}}" alt="Logo"> 
            </a>
        </div>
        <div class="content">
        <!-- resources/views/auth/login.blade.php -->
            <form class="login-form" action="/login" method="post" novalidate="novalidate">
            	{!! csrf_field() !!}
                <h3 class="form-title font-green">Log in</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Vul uw E-mail adres en wachtwoord in! </span>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">E-mail</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" value="{{ old('email') }}"> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Wachtwoord</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Wachtwoord" name="password"> </div>
                <div class="form-actions ">
                    <button type="submit" class="btn green uppercase">Login</button>
                    <label class="rememberme check pull-right">
                    <a href="#" id="forget-password" class="forget-password ">Wachtwoord reset?</a>
                </div>
            </form>
        </div>
        <p class="copyright copy-color">2016 Â© Moodles.</p>
	    <a href="#index" class="go2top">
	        <i class="icon-arrow-up"></i>
	    </a>
</body>
</html>