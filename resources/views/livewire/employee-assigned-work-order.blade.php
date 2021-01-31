<div>

    <div class="bg-white rounded mb-6 flex items-center">
        <h5 class="shadow-sm rounded-md py-4 pl-6 pr-3 bg-white font-bold">Filter by:</h5>
        <button class="font-bold text-sm rounded-md px-3 py-1 text-white bg-orange-300"
                wire:click="toggleComplete">
            {{$open ? 'Completed' : 'Open'}}
        </button>
        <button class="font-bold text-sm bg-orange-300 rounded-md px-3 py-1 text-white ml-3"
                wire:click="toggleSortStart">
            {{$startDateAsc ? 'Start Date Newest' : 'Start Date Oldest'}}
        </button>
    </div>

    <section class="text-gray-700 grid grid-cols-1 xl:grid-cols-3 gap-8">

        @foreach ($workOrders as $workOrder)
        <div>
            <div class="h-full flex flex-col justify-between shadow-md rounded-lg py-4 px-6 bg-white">
                <div>
                    <div class="mb-2 text-right">
                        @if ($workOrder->end_date)
                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs 
                                        font-medium leading-4 bg-green-100 text-green-400">
                                Complete
                            </div>
                        @else
                            <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    bg-red-100 text-red-400">
                                Open
                            </div>
                        @endif
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">Service Request Issue:</div>
                        <div class="font-light text-md">{{$workOrder->serviceRequest->issue}}</div>
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">Start Date:</div>
                        <div class="font-light text-md">{{\Carbon\Carbon::parse($workOrder->start_date)->toFormattedDateString()}}</div>
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">End Date:</div>
                        @if ($workOrder->end_date)
                            <div class="font-light text-md">{{\Carbon\Carbon::parse($workOrder->end_date)->toFormattedDateString()}}</div>
                        @else
                            <div class="font-light text-md">Not Complete</div>
                        @endif
                    </div>
                </div>
                <a href="{{route('employee.manage-workorder', $workOrder->id)}}" class="text-teal-300 font-bold flex items-center justify-end">
                    <i class="fas fa-link text-sm mr-1"></i>
                    <div class="font-prompt text-sm">Work Order</div>
                </a>
            </div>
        </div>
        @endforeach

    </section>

    <div class="flex justify-between items-center">
        <div class="my-4">
            {{ $workOrders->links('vendor.livewire.pagination') }}
        </div>
    </div>

</div>
