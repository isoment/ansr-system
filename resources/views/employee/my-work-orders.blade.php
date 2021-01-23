@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 py-8 lg:py-12 mx-auto">
    
    <div class="font-bold text-xl text-center mb-8">
        <h5>My Work Orders</h5>
    </div>

    <livewire:employee-assigned-work-order />

</div>

@endsection