<div>

    <section class="text-gray-700 grid grid-cols-1 xl:grid-cols-3 gap-8">

        @foreach ($workOrders as $workOrder)
        <div>
            <div class="h-full flex flex-col justify-between shadow-md rounded-lg py-4 px-6 bg-white">
                <div>
                    <div class="mb-2 text-right">
                        <div class="font-bold text-xs text-teal-700">ID: {{$workOrder->id}}</div>
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">Service Request Issue:</div>
                        <div class="font-light text-md">{{$workOrder->serviceRequest->issue}}</div>
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">Start Date:</div>
                        <div class="font-light text-md">{{\Carbon\Carbon::parse($workOrder->start_date)->toFormattedDateString()}}</div>
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

</div>
