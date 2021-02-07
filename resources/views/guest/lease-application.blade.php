@extends('layouts.guest')

@section('content')


<div class="relative pt-20 container mx-auto px-4 lg:px-20 xl:px-32">
    <h2 class="text-center text-2xl font-bold tracking-wide mt-8">Lease Application</h2>
    <h5 class="text-center font-bold mt-2 mb-8">Fields marked <span class="text-orange-300">&#9913;</span> are required</h5>
    <div>
        <livewire:lease-application-form />
    </div>
</div>
    
@endsection