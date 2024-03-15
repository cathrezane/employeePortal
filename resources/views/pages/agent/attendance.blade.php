
@extends('layouts.app')

@section('content')
<div class="container p-4 mt-2">
    <div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search...">
            <button class="btn btn-outline-secondary" type="button">Search</button>
        </div>
    </div>
    <label class="text-left" style="font-size: 2rem;">Attendance Log</label>
    <div class="card text-center">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">On-time/Late</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                <tr>
                    <td>{{ Auth::user()->name; }}</td>
                    <td>
                    @if ($result->status == 1)
                        <span class="badge rounded-pill text-bg-primary">Clocked-in</span>
                    @elseif ($result->status == 2)
                        <span class="badge rounded-pill text-bg-warning">On-Break</span>
                    @elseif ($result->status == 3)
                        <span class="badge rounded-pill text-bg-info">Break-In</span>
                    @elseif ($result->status == 4)
                        <span class="badge rounded-pill text-bg-dark">Clocked-out</span>
                    @endif</td>

                    <td><span class="badge pill text-bg-success">On-time</span></td>
                    {{-- {{ dd($result->schedules) }} --}}
                    <td>{{ \Carbon\Carbon::parse($result->time_logged)->format('h:i A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($result->time_logged)->format('D, M d, Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
