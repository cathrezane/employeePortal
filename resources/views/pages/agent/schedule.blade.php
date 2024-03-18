
@extends('layouts.app')

@section('content')
@if (empty($userSchedule))
    <h1>No Schedule Found</h1>
@else
    
    <div class="m-2 d-flex">
        <div class="card w-25 m-5">
            <div class="card-body">
            <h5 class="card-title">Name</h5>
            <p class="card-text"><u>{{ $userSchedule->user->name }}</u></p>
            </div>
        </div>

        <div class="card w-25 m-5">
            <div class="card-body">
            <h5 class="card-title">Shift</h5>
            <p class="card-text"><u>{{ $userSchedule->shift->name }}</u></p>
            </div>
        </div>

        <div class="card w-25 m-5">
            <div class="card-body d-flex justify-content-between mx-4">
                <div>
                    <h5 class="card-title">Start time</h5>
                    <p class="card-text"><u>{{ \Carbon\Carbon::parse( $userSchedule->shift->start_time)->format('h:i A') }}</u></p>
                </div>
                <div>
                    <h5 class="card-title">End time</h5>
                    <p class="card-text"><u>{{ \Carbon\Carbon::parse( $userSchedule->shift->end_time)->format('h:i A') }}</u></p>
                </div>
            </div>
        </div>

        <div class="card w-25 m-5">
            <div class="card-body">
              <h5 class="card-title">Scheduled Workdays</h5>
              <div class="d-flex justify-content-around">
                @foreach ($workdayNames as $row)
                  <div>
                    <p class="card-text"><u>{{ Str::substr($row, 0, 3) }}</u></p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          
    </div>

    <div class="m-2 d-flex">
      <div class="card w-20 m-5">
            <div class="card-body">
              <h5 class="card-title">Total Hours Worked</h5>
              <div class="d-flex justify-content-around">
                  <div>
                    <p class="card-text"><u>{{ $totalHours }}</u></p>
                  </div>
              </div>
            </div>
          </div>
    </div>
        
@endif
@endsection
