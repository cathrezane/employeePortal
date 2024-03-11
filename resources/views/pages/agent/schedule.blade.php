
@extends('layouts.app')

@section('content')
@if (empty($userSchedule))
    <h1>No Schedule Found</h1>
@else
    <div class="container">
        <div class="row">
             <div class="card">
                Name:   {{ $userSchedule->user->name }}
                <br>
                Shift:  {{ $userSchedule->shift->name }}
                <br>
             </div>
             <div class="card">
                Start time: {{ \Carbon\Carbon::parse( $userSchedule->shift->start_time)->format('h:i A') }}
                <br>
                End time:  {{ \Carbon\Carbon::parse( $userSchedule->shift->end_time)->format('h:i A') }}
                <br>
             </div>
             <div class="card">
                Workdays: 
                @foreach ($workdayNames as $row)
                    {{ $row }}
                @endforeach
                {{-- {{ dd($userSchedule->shift->workdays->days) }} --}}
                {{-- @foreach ($userSchedule->shift->workdays as $row)
                    <span class="me-2">{{ $row->name }}</span>
                @endforeach --}}
                {{-- @foreach ($userSchedule->shift->days as $dayId)
                    
                @endforeach --}}
                <br>
             </div>
        </div>
    </div>
@endif
@endsection
