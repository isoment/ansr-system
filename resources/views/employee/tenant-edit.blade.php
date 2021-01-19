@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 xl:px-32 pt-4 md:py-12 mx-auto">

    <div class="flex items-center ml-4">
        <a href="{{route('employee.tenant-index')}}"
           class="bg-teal-300 hover:bg-teal-400 transition-all duration-200 text-white px-4 
                  py-2 text-xs font-bold rounded-t-md">Tenant Index</a>
    </div>

    <div>
        <livewire:admin-tenant-edit :tenant="$tenant">
    </div>

</div>

@endsection