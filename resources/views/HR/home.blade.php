@extends('layouts.hr-master')

@section('content')

<div class="container d-flex">
    <div class="card w-25 m-5">
        <div class="card-body">
        <h5 class="card-title">Number of Agents</h5>
        <p class="card-text"><u>
            @if(isset($agents))
                {{ count($agents)}}
                @endif</u></p>
        </div>
    </div>
    <div class="card w-25 m-5">
        <div class="card-body">
        <h5 class="card-title">Managed Campaigns</h5>
        {{-- <p class="card-text"><u></u></p> --}}
        </div>
    </div>
    <div class="card w-25 m-5">
        <div class="card-body">
        <h5 class="card-title">Number of Absences</h5>
        <p class="card-text"><u></u></p>
        </div>
    </div>
</div>
@endsection