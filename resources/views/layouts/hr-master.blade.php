<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Simple CMS" />
    <meta name="author" content="Daryl Don Abril" />
    {{-- <link rel="shortcut icon" href={{ assets("favicon.png") }} /> --}}
    <title>HR Six Eleven Portal</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,500;0,600;0,800;0,900;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://api.fontshare.com/v2/css?f[]=switzer@300&f[]=outfit@600&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet"/>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Custom styles for this template -->
    <link href = {{ asset("bootstrap/css/sticky-footer-navbar.css") }} rel="stylesheet"/>
    <!-- Optional theme -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-theme.min.css') }}">
</head>
<body>
    <style>
        body {
            overflow: hidden;
            /* font-family: 'Source Code Pro', monospace; */
            /* font-family: 'Switzer', sans-serif, 'Outfit'; */
            font-family: 'Outfit', sans-serif;
        }


    </style>
    <script>
        @if (session()->has('error'))
            Swal.fire({
            title: "Error!",
            text: "{{ session()->get('error') }}",
            icon: "error",
            type: "error",
            });
        @endif
        @if (session()->has('success'))
            Swal.fire({
            title: "Success!",
            text: "{{ session()->get('success') }}",
            icon: "success",
            type: "success",
            });
        @endif
        @if (session()->has('warning'))
            Swal.fire({
            title: "Warning!",
            text: "{{ session()->get('warning') }}",
            icon: "warning",
            type: "warning",
            });
        @endif
        @if (session()->has('info'))
            Swal.fire({
            title: "Information!",
            text: "{{ session()->get('info') }}",
            icon: "info",
            type: "info",
            });
        @endif
      </script>
    <div id="app d-flex col-md-2">
        <div class="container-fluid overflow-hidden">
          <div class="row vh-100 overflow-auto">
              <div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-light d-flex sticky-top">
                  <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
                      <h2 href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 text-decoration-none" style="font-weight: 900;">
                          <span><img height="90" src="{{ asset('images/six-eleven-logo.png') }}"></span><span class="" style="color: #09D500;"> Six<span style="color:#31559D;">Eleven</span><span class="d-none d-sm-inline" style="color: black;"> Portal</span></span>
                      </h2>
                      <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" id="menu">
                          <li class="nav-item">
                              <a href="/hr" class="nav-link px-sm-0 px-2">
                                  <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                              </a>
                          </li>
                          <li>
                              <a href="/hr/employee-attendance-log" class="nav-link px-sm-0 px-2">
                                <i class="fs-5 bi bi-check2-square"></i><span class="ms-1 d-none d-sm-inline">Agent Attendance</span></a>
                          </li>
                          <li>
                              <a href="/hr/schedule" class="nav-link px-sm-0 px-2">
                                  <i class="fs-5 bi-calendar-week"></i><span class="ms-1 d-none d-sm-inline">Employee Schedule</span></a>
                          </li>
                            <li>
                                <a href="{{ route('shiftlist') }}" class="nav-link px-sm-0 px-2">
                                    <i class="fs-5 bi-calendar-week"></i><span class="ms-1 d-none d-sm-inline">Shift Scheduling</span></a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('hr.employees') }}" class="nav-link px-sm-0 px-2">
                                    <i class="fs-5 bi-calendar-week"></i><span class="ms-1 d-none d-sm-inline">Employees</span></a>
                            </li> --}}
                      </ul>
                      <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                        <a href="#" class="d-flex align-middle text-white dropdown-toggle" id="dropdownUser1"  style="text-decoration:none;" data-bs-toggle="dropdown" aria-expanded="false">
                            <button class="btn btn-dark">
                                <span><i class="bi bi-person-circle"></i> {{ Str::title(Auth::user()->name) }}</i></span>
                            </button>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-white text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="/logout">Profile</a></li>
                            <li><a class="dropdown-item" href="/logout">Sign out</a></li>
                        </ul>
                    </div>
                      {{-- <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                              <img src="https://github.com/mdo.png" alt="hugenerd" width="28" height="28" class="rounded-circle">
                              <span class="d-none d-sm-inline mx-1">Joe</span>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                              <li><a class="dropdown-item" href="#">Profile</a></li>
                              <li>
                                  <hr class="dropdown-divider">
                              </li>
                              <li><a class="dropdown-item" href="/logout">Sign out</a></li>
                          </ul>
                      </div> --}}
                  </div>
              </div>
              <div class="col-md-10 d-flex flex-column h-sm-100">
                  <main class="row overflow-auto">
                      <div class="col">
                        @yield('content')
                          {{-- <h3>Vertical Sidebar that switches to Horizontal Navbar</h3>
                          <p class="lead">An example multi-level sidebar with collasible menu items. The menu functions like an "accordion" where only a single menu is be open at a time.</p>
                          <hr />
                          <h3>More content...</h3>
                          <p>Sriracha biodiesel taxidermy organic post-ironic, Intelligentsia salvia mustache 90's code editing brunch. Butcher polaroid VHS art party, hashtag Brooklyn deep v PBR narwhal sustainable mixtape swag wolf squid tote bag. Tote bag cronut semiotics, raw denim deep v taxidermy messenger bag. Tofu YOLO Etsy, direct trade ethical Odd Future jean shorts paleo. Forage Shoreditch tousled aesthetic irony, street art organic Bushwick artisan cliche semiotics ugh synth chillwave meditation. Shabby chic lomo plaid vinyl chambray Vice. Vice sustainable cardigan, Williamsburg master cleanse hella DIY 90's blog.</p>
                          <p>Ethical Kickstarter PBR asymmetrical lo-fi. Dreamcatcher street art Carles, stumptown gluten-free Kickstarter artisan Wes Anderson wolf pug. Godard sustainable you probably haven't heard of them, vegan farm-to-table Williamsburg slow-carb readymade disrupt deep v. Meggings seitan Wes Anderson semiotics, cliche American Apparel whatever. Helvetica cray plaid, vegan brunch Banksy leggings +1 direct trade. Wayfarers codeply PBR selfies. Banh mi McSweeney's Shoreditch selfies, forage fingerstache food truck occupy YOLO Pitchfork fixie iPhone fanny pack art party Portland.</p> --}}
                      </div>
                  </main>
                  <footer class="row bg-light py-4 mt-auto text-center">
                      <div class="col"> SixEleven &circledR; {{ date("Y") }}</div>
                  </footer>
              </div>
          </div>
      </div>
      </div>
      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>