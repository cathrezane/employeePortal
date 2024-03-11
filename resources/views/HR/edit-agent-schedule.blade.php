@extends('layouts.hr-master')

@section('content')
    <div class="m-2">
        <h4>{{ $user->name }} Schedule</h4>
        @foreach ($schedules as $row)
        <div class="card col-md-2 p-1 mb-1 text-center">
            {{ $row->shift->name }}
            <br>
            {{ $row->shift->start_time }}
            {{ $row->shift->end_time }}
            <br>
            {{ $row->date }}
        </div>
        @endforeach
    </div>
@endsection