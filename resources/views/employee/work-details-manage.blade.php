@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-8 xl:px-20 pt-4 md:py-12 mx-auto">

    <div class="flex items-center ml-4">
        <a href="{{route('employee.manage-workorder', $workDetail->workOrder->id)}}"
           class="bg-teal-300 hover:bg-teal-400 transition-all duration-200 text-white px-4 
                  py-2 text-xs font-bold rounded-t-md">Parent Work Order</a>
    </div>

    <livewire:employee-work-detail-manage :workDetail="$workDetail">

</div>

@endsection