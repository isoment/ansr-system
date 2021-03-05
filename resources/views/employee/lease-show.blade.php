@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 py-8 lg:py-12 mx-auto">
    
    <div class="flex items-center ml-4">
        <a href="{{route('employee.lease-manage')}}"
           class="bg-teal-300 hover:bg-teal-400 transition-all duration-200 text-white px-4 
                  py-2 text-xs font-bold rounded-t-md">Manage Leases</a>
    </div>

    <div>
        <livewire:employee-lease-show :lease="$lease" />
    </div>
    
</div>

@endsection