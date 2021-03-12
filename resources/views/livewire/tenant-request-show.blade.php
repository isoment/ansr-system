<div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-2 
                    shadow-sm flex flex-col justify-between">
            <div class="mx-2">
                <h3 class="font-bold font-prompt text-lg text-center">Service Request</h3>
                <div class="my-3">
                    <span class="font-bold">Address:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$serviceRequest->lease->property->street}}
                    </div>
                    <div class="text-sm font-light">
                        {{$serviceRequest->lease->property->city}}, {{$serviceRequest->lease->property->state}} {{$serviceRequest->lease->property->zipcode}}
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Request Created:</span> 
                    <div class="text-sm font-light mt-1">
                        {{\Carbon\Carbon::parse($serviceRequest->created_at)->toFormattedDateString()}}
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Issue:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$serviceRequest->issue}}
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Description:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$serviceRequest->description}}
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Completed:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$serviceRequest->completed_date ? \Carbon\Carbon::parse($serviceRequest->completed_at)->toFormattedDateString() : 'Not Completed'}}
                    </div>
                </div>
            </div>
        </div>
        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm 
                    sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
            <div>
                <h3 class="font-bold font-prompt text-lg text-center">Activity</h3>
                <div class="flex flex-col sm:flex-row justify-around items-center my-4">
                    <div class="bg-white rounded shadow-md text-center px-8 py-6 mb-3 sm:mb-0 w-2/3 sm:w-auto">
                        <h3 class="text-teal-300 font-prompt font-bold text-3xl mb-4">2</h3>
                        <h6 class="text-uppercase font-thin text-sm">Work Orders</h6>
                    </div>
                    <div class="bg-white rounded shadow-md text-center px-8 py-6 mb-3 sm:mb-0 w-2/3 sm:w-auto">
                        <h3 class="text-teal-300 font-prompt font-bold text-3xl mb-4">2</h3>
                        <h6 class="text-uppercase font-thin text-sm">Total Tasks</h6>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <h3 class="font-bold font-prompt text-lg">Click Work Order for activity</h3>
                <div class="flex flex-wrap items-center">
                    @foreach ($workOrders as $workOrder)
                        <div class="mr-2 my-2 p-2 border border-orange-300 rounded-md text-orange-300 text-sm
                                    cursor-pointer">
                            {{$workOrder->title}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

