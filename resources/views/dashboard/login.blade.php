<!DOCTYPE html>
<html class="login-html" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
</head>

<body class="login-body">
    <div class="center-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <img src={{ asset('assets/app_logo.png') }} class="img-fluid" style="width: 10rem">
                </div>
                <div class="col-xs-1 col-sm-2 col-md-3 col-lg-4 "></div>
                <div class="col-xs-10 col-sm-8 col-md-6 col-lg-4">
                    <div class="card mt-2">
                        <div class="card-body">
                            <h5 class="card-title text-center">Login</h5>
                            <form method="POST" action={{ url('/en/admin/login') }}>
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                                <input type="submit" class="btn btn-primary mt-3 w-100" value="Login" />
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-2">
                                        @foreach ($errors->all() as $error)
                                            <strong>{{ $error }}</strong>
                                        @endforeach
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-1 col-sm-2 col-md-3 col-lg-4"></div>
            </div>
        </div>
    </div>
</body>

</html>
