@extends('layouts.app')

@section('content')
    <style>
        @import 'https://fonts.googleapis.com/css?family=Nova+Mono|Eczar';

        #body {
            background-color: black;
            color: white;
        }

        #div1 {
            /*background-color: red;*/
            transform: translateY(8%);
        }

        #time {
            font-family: 'Nova Mono', monospace;
            font-size: 4vw;
            text-align: center;
            color: black;
            text-shadow: 0px 0px 5px;
        }

        #date {
            /* font-family: 'Eczar', serif; */
            font-size: 5vmin;
            text-align: center;
            color: black;
            text-shadow: 0px 0px 7px rgb(119, 119, 207);
        }

        /* Button styles */
        .clock-in-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            background-color: #4CAF50;
            /* Green color */
            color: #fff;
            /* White text */
            border: 2px solid #4CAF50;
            /* Green border */
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        /* Hover effect */
        .clock-in-button:hover {
            background-color: #45a049;
            /* Darker green color on hover */
            border-color: #45a049;
            /* Darker green border on hover */
            color: #fff;
            /* White text on hover */
        }

        /* Active effect (when button is clicked) */
        .clock-in-button:active {
            background-color: #3e8e41;
            /* Even darker green color on click */
            border-color: #3e8e41;
            /* Even darker green border on click */
        }
    </style>
    
    {{-- <div id="div1">
        <p id="time"></p>
        <p id="date"></p>
    </div> --}}
    @if (session()->has('error'))
    <script>
        Swal.fire({
        title: "Error!",
        text: "{{ session()->get('error') }}",
        icon: "error",
        type: "error",
        });
    </script>
    @endif
    @if (session()->has('success'))
    <script>
        Swal.fire({
        title: "Success!",
        text: "{{ session()->get('success') }}",
        icon: "success",
        type: "success",
        });
    </script>
    @endif
    @if (session()->has('warning'))
    <script>
        Swal.fire({
        title: "Warning!",
        text: "{{ session()->get('warning') }}",
        icon: "warning",
        type: "warning",
        });
    </script>
    @endif

    <div class="container d-flex">
        <div class="card w-25 m-5">
            <div class="card-body">
            <h5 class="card-title">Agent Name</h5>
            <p class="card-text"><u>{{ Auth::user()->name }}</u></p>
            </div>
        </div>
        <div class="card w-25 m-5">
            <div class="card-body">
            <h5 class="card-title">Team Leader</h5>
            <p class="card-text"><u>Team Leader Name</u></p>
            </div>
        </div>
        <div class="card w-25 m-5">
            <div class="card-body">
            <h5 class="card-title">Campaign</h5>
            <p class="card-text"><u>Campaign Name</u></p>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap justify-content-evenly col-md-12">
        {{-- <div class="col-md-6 d-flex"> --}}
        <div class="card col-md-5">  
            <div class="mt-3">
                <div id="col-md-6 div1">
                    <p id="time"></p>
                    <p id="date"></p>
                </div>

            <div class="text-center col-md-12 align-items-center rounded mt-5">
                @if (Auth::user()->status == 0 || Auth::user()->status == 4)
                    <form action="/attendance/store" method="post">
                        @csrf
                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" style="display: none">
                        <input type="time" id="time_logged" name="time_logged"
                            value="{{ old('time_logged', now()->format('H:i')) }}" style="display: none">
                        <input type="text" name="status" value="1" style="display: none" hidden>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" style="display: none" hidden>
                        <button type="submit" class="text-white btn btn-success px-5 pb-4 "><span style="font-size:50px;"><i class="bi bi-hourglass-top"></i></span><br>Clock-in</button>
                    </form>
                @elseif (Auth::user()->status == 1)
                    <form action="{{ route('onBreak') }}" method="post">
                        @csrf
                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" style="display: none">
                        <input type="time" id="time_logged" name="time_logged"
                            value="{{ old('time_logged', now()->format('H:i')) }}" style="display: none">
                        <input type="text" name="status" value="2" style="display: none" hidden>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" style="display: none" hidden>
                        <button type="submit" class="text-dark btn btn-light mx-5 px-5 pb-4 border border-dark"><span style="font-size:50px;"><i class="bi bi-stopwatch"></i></span><br>Break-out</button>
                    </form>
                @elseif (Auth::user()->status == 2)
                    <form action="{{ route('breakIn') }}" method="post">
                        @csrf
                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" style="display: none">
                        <input type="time" id="time_logged" name="time_logged"
                            value="{{ old('time_logged', now()->format('H:i')) }}" style="display: none">
                        <input type="text" name="status" value="3" style="display: none" hidden>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" style="display: none" hidden>                       
                        <button type="submit" class="text-white btn btn-dark mx-5 px-5 pb-4 border border-white"><span style="font-size:50px;"><i class="bi bi-stopwatch-fill"></i></span><br>Break-In</button>                  
                    </form>
                @elseif (Auth::user()->status == 3)
                    <form action="{{ route('clockOut') }}" method="post">
                        @csrf
                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" style="display: none">
                        <input type="time" id="time_logged" name="time_logged"
                            value="{{ old('time_logged', now()->format('H:i')) }}" style="display: none">
                        <input type="text" name="status" value="4" style="display: none" hidden>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" style="display: none" hidden>
                        <button type="submit" class="text-white btn btn-primary mx-5 px-5 pb-4 "><span style="font-size:50px;"><i class="bi bi-hourglass-bottom"></i></span><br>Clock-out</button>
                    </form>
                @endif
            </div>
        </div>
        </div>  
        <div class="order-2 card p-2 col-md-6 rounded">
            <h4 class="text-dark">Recent Activity  </h4>
            <div class="card rounded">
                @if (Auth::user()->status == 1)
                <div class="d-flex justify-content-between p-2 bg-success text-white align-items-center">
                    <div class="col-md-4 card text-center">
                        <span style="font-size:30px;">Clocked-in</span>
                    </div>
                    <div class="col-md-7">
                        {{ \Carbon\Carbon::parse($latestActivity->time_logged)->format('l, F j, Y h:i A') }}
                    </div>
                </div>
                @elseif (Auth::user()->status == 2)
                <div class="d-flex justify-content-between p-2 bg-dark text-white align-items-center">
                    <div class="col-md-4 card text-center">
                        <span style="font-size:30px;">On-Break</span>
                    </div>
                    <div class="col-md-7">
                        {{ \Carbon\Carbon::parse($latestActivity->time_logged)->format('l, F j, Y h:i A') }}
                    </div>
                </div>
                @elseif (Auth::user()->status == 3)
                <div class="d-flex justify-content-between p-2 bg-white text-dark align-items-center">
                    <div class="col-md-4 card text-center">
                        <span style="font-size:30px;">Off-Break</span>
                    </div>
                    <div class="col-md-7">
                        {{ \Carbon\Carbon::parse($latestActivity->time_logged)->format('l, F j, Y h:i A') }}
                    </div>
                </div>
                @elseif (Auth::user()->status == 4)
                <div class="d-flex justify-content-between p-2 bg-primary text-white align-items-center">
                    <div class="col-md-4 card text-center">
                        <span style="font-size:30px;">Clocked-out</span>
                    </div>
                    <div class="col-md-7">
                        {{ \Carbon\Carbon::parse($latestActivity->time_logged)->format('l, F j, Y h:i A') }}
                    </div>
                </div>
                @endif
            </div>
            <hr class="px-2 mx-5" style="border: 1px solid gray;">
            
            @if (empty($latestAttendances))
                    <p>No Attendance Found</p>
            @else
            @foreach ( $latestAttendances as $row )
            <div class="card mt-1">
                <div class="d-flex justify-content-between p-2 bg-white text-dark align-items-center">
                    <div class="col-md-4 card text-center rounded">
                            @if ($row->status == 1)
                            <span class="bg-success text-white rounded" style="font-size:30px;">Clocked-in</span>
                            @elseif ($row->status == 2)
                            <span class="bg-dark text-white rounded" style="font-size:30px;">On-Break</span>
                            @elseif ($row->status == 3)
                            <span class="bg-white text-dark rounded" style="font-size:30px;">Off-Break</span>
                            @elseif ($row->status == 4)
                            <span class="bg-primary text-white rounded" style="font-size:30px;">Clocked-out</span>
                            @endif
                    </div>
                    <div class="col-md-7">
                        {{ \Carbon\Carbon::parse($row->time_logged)->format('l, F j, Y h:i A') }}
                    </div>
                </div>
            </div>
            @endforeach 
            @endif
        </div>
    </div>

    <script>
        // Function to update the clock and date
        function updateDateTime() {
          var now = new Date();
          var hours = now.getHours();
          var minutes = now.getMinutes();
          var seconds = now.getSeconds();
          var ampm = hours >= 12 ? 'PM' : 'AM';
    
          // Convert to 12-hour format
          hours = hours % 12;
          hours = hours ? hours : 12;
    
          // Add leading zero if needed
          hours = (hours < 10) ? '0' + hours : hours;
          minutes = (minutes < 10) ? '0' + minutes : minutes;
          seconds = (seconds < 10) ? '0' + seconds : seconds;
    
          // Display the time with AM/PM
          var timeElement = document.getElementById('time');
          timeElement.textContent = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    
          // Display the date
          var dateElement = document.getElementById('date');
          var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
          dateElement.textContent = now.toLocaleDateString('en-US', options);
        }
    
        // Initial call to display the clock and date
        updateDateTime();
    
        // Update the clock and date every second
        setInterval(updateDateTime, 1000);
      </script>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"
        integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
@endsection
