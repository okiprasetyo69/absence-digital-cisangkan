<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Absence Digital </title>
    <link rel="manifest" href="/manifest.json">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="theme-color" content="white"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Base Project">
    <meta name="msapplication-TileImage" content="images/hello-icon-144.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('')}}assets/plugins/fontawesome-free/css/all.min.css">
    <link href="{{asset('')}}css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Cisangkan Absence Digital</h3></div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>

                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label for="remember">
                                                    Remember Password
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- 
                                            <a href="{{ route('password.request') }}">Forget Password ? </a>
                                            -->
                                            <button type="submit" class="btn btn-primary btn-md btn-block">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- 
                                <div class="card-footer text-center">
                                    <div class="small">
                                        <a href="{{ route('register') }}" class="text-center">Need an account? Sign up !
                                        </a>
                                    </div>
                                </div>
                                 -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('') }}js/scripts.js"></script>
<script src="/main.js"></script>
<script>
    window.onload = () => {
        'use strict';
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker
                    .register('./sw.js');
        }
    }
</script>
</body>
</html>
