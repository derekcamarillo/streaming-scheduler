<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUISSE-VIDEO STREAMING</title>
    <meta name="keywords" content="Suisse View" />
    <!-- Bootstrap -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    <!--    <link href="css/logincss/jquery.simplyscroll.css" rel="stylesheet">-->
    <link href="css/animate.css" rel="stylesheet">
    <!--    <link href="css/logincss/flaticon.css" rel="stylesheet">-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <!--    <link href="css/logincss/scrollbar-style.css" rel="stylesheet">-->
    <link href="css/main-style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<section class="contaneSection">
    <div class="container">
        <div class="row">
            <h1 class="titleh1">WELCOME TO SUISSE-VIDEO</h1>
            <h1 class="titleh1 loginTitle">STREAMING</h1>
            <div class="col-lg-4 emptyDiv">&nbsp;</div>
            <div class="col-md-4 emptyDiv">
                <form role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="col-lg-12 inputRow">
                        <input id="email" type="email" name="email" placeholder="Email Address" class="input" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="col-lg-12 inputRow">
                        <input id="password" type="password" name="password" placeholder="Password" class="input" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <!--div class="col-lg-12 inputRow">
                        <a href="{{ route('register') }}" class="forgot">Sign Up</a>
                    </div-->
                    <div class="col-lg-12 bottom-btns">
                        <button type="submit" style="height: 60px; color: #fff; font-size: 16px; border-radius: 4px; font-weight: 600; outline: none; display: inline-block;" class="btn add-video-btn"> Login </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 emptyDiv">&nbsp;</div>
        </div><!--row-->
    </div><!--container-fluid-->
</section><!--sectionhome-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/filterable.pack.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- <script src="js/jquery.simplyscroll.js"></script> -->
<script src="js/wow.min.js"></script>
<script src="js/scrollbar.js"></script>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

</body>
</html>