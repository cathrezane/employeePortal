<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SixEleven Global Services Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
        <link href="https://api.fontshare.com/v2/css?f[]=switzer@300&f[]=outfit@600&display=swap" rel="stylesheet">
        
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,500;0,600;0,800;0,900;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <style>
            body {
              overflow: hidden;
              height: 100%;
              font-family: 'Outfit', sans-serif;
              background-size: cover;
              height: 50%;
              background-repeat: no-repeat; 
              background-attachment: fixed;
            }

            .front{
                margin-top: 9%;
            }

            .neomorphic-image-wrapper {
                border-radius: 20px;
                background: #ede9e9;
                box-shadow:  5px 5px 48px #ffffff,
                            -5px -5px 48px #ffffff;
            }

            .login,
            .register{
            /* Change background and text color on hover */
                background-color: dark;  /* Adjust to your desired hover color */
                color: white;  /* Adjust to your desired text hover color */
                padding: 10px;
                border-radius: 5px;
                text-decoration: none;
            }

            .login:hover,
            .register:hover {
            /* Change background and text color on hover */
                background-color: #ddd;  /* Adjust to your desired hover color */
                color: #333;  /* Adjust to your desired text hover color */
                padding: 10px;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-light bg-dark">
            <div class="container-fluid d-flex align-items-center">
                <div class="me-auto">  
                    <img class="align-middle" src="{{ asset('images/six-eleven-logo.png') }}" width="40" height="40">
                  <a class="navbar-brand ms-2 align-middle text-white">SixEleven Portal</a>
                </div>
                <form class="d-flex">
                    @if (Route::has('login'))
                      <div class="text-center">
                        @auth
                          <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-dark-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mx-2">Home</a>
                        @else
                          <a href="{{ route('login') }}" class="login hover:outline outline-white mx-2 custom-link">Login</a>
                          @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="register hover:outline outline-white mx-2 custom-link">Register</a>
                          @endif
                        @endauth
                      </div>
                    @endif
                </form>
              </div>
        </nav>
        <div class="container mt-5 neomorphic-image-wrapper col-md-3">
            <div class="d-flex">
              <div class="col-md-12 m-2 text-center">
                <img class="align-middle pt-3" src="{{ asset('images/six-eleven-logo.png') }}" width="150" height="150">
                <p class="display-4 text-center align-middle">Welcome to the <br><span style="color:#09D500;">Six</span><span style="color:#31559D;">Eleven</span> <br>Portal</p>
              </div>
            </div>
        </div>

        <div class="d-flex justify-between neomorphic-image-wrapper mt-5">
            <div class="col-md-4 m-2">
              <div class="text-center">
                <img class="align-middle" src="{{ asset('images/611-a1.jpg') }}" width="450" height="250">
              </div>
            </div>
            <div class="col-md-4 m-2">
              <div class="text-center">
                <img class="align-middle" src="{{ asset('images/611-a2.jpg') }}" width="450" height="250">
              </div>
            </div>
            <div class="col-md-4 m-2">
              <div class="text-center">
                <img class="align-middle" src="{{ asset('images/611-a3.webp') }}" width="450" height="250">
              </div>
            </div>
          </div>
        </div>
        <footer class="bg-dark py-3 mt-auto text-center text-white" style="position: fixed; bottom: 0; width: 100%;">
            <div class="col"> SixEleven &circledR; {{ date("Y") }}</div>
        </footer>
    </body>
</html>
