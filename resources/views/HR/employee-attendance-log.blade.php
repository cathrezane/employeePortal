@extends('layouts.hr-master')

@section('content')
    @foreach ($attendances as $row)
        <p>{{ $row->id }} - {{ $row->user->name }} - {{ $row->time_logged }} - {{ $row->status }}</p>
    @endforeach
@endsection