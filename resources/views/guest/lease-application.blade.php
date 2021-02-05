@extends('layouts.guest')

@section('content')


<div class="relative pt-20 container mx-auto px-4 lg:px-20 xl:px-32">
    <h2 class="text-center text-2xl font-bold tracking-wide my-8">Lease Application</h2>
    <div>
        <livewire:lease-application />
    </div>
</div>
    
@endsection