<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Activities</title>

    <!-- Bootstrap core CSS -->
    <link href="/user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="/user/css/heroic-features.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Tour Package</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                        <a class="dropdown-item " href="">Sign In</a>
                        <a class="dropdown-item" href="">Sign Up</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Page Content -->
<div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h5 class="display-3"><strong>Welcome,</strong></h5>
        <p class="display-4"><strong>Set Up Your Package</strong></p>
        <p class="display-4">&nbsp;</p>
        <a href="#" class="btn btn-warning btn-lg float-right">Tour NOW!</a>
    </header>

    <!-- Page Features -->
    <div class="row text-center">
        <img src="/banner/{{ $package->banner }}" alt="" style="width: 400px;">
        <p>Destination Name : {{ $package->destination_name }}</p>

        <form action="{{ route('act.store') }}" method="post">
            @csrf

            <input type="hidden" value="{{ $package->id }}" name="packageId">
            <div class="form-group">
                <lable>Activity</lable>
                <input type="text" name="activity" class="form-control" placeholder="Enter Only Days in number">
            </div>

            <div class="form-group">
                <lable>Details</lable>
                <textarea name="details" id="" cols="30" rows="10" class="form-control" placeholder="What You are doing in package"></textarea>
            </div>

            <button type="submit" class="btn btn-sm btn-success">Submit</button>
        </form>
    </div>
    <!-- /.row -->
    <br><br>
</div>
<!-- /.container -->


<!-- Bootstrap core JavaScript -->
<script src="/user/vendor/jquery/jquery.min.js"></script>
<script src="/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
