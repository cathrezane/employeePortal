@extends('layouts.hr-master')

@section('content')
    <div class="container m-2">
        Edit User
        <h4>{{ $user->name }} Schedule</h4>
        <h2>Assign Schedule</h2>
        {{-- @foreach ($shiftList as $index) --}}
            {{-- tr>
                <td class="shift-days">{{ $index< + 1 }}</td>
                <td>{{ $index->name }}</td> --}}
                {{-- Assuming each $days[$index] is an array of names --}}
                {{-- <td class="shift-days ">
                    @foreach ($days[$index] as $day)
                        <span class="me-2">{{ $day }}</span>
                    @endforeach
                </td> --}}
                {{-- <td><a href="/hr/{{ $row->id }}/edit-shift" class="shift-days btn btn-warning py-0">Edit</a></td>
            </tr>
            @endforeach --}}

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