@extends('layouts.guest')

@section('content')

    <div class="relative pt-20 container mx-auto px-4 lg:px-4 xl:px-32">

        <livewire:property-listing-show :propertyListing="$propertyListing">

        {{-- Related Rentals --}}
        @if ($relatedRentals->isNotEmpty())
            <div class="pt-6 pb-12">
                <h3 class="text-lg font-bold">Similar Rentals You May Like</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                    @foreach ($relatedRentals as $property)
                        <x-property-listing-card :property="$property" />
                    @endforeach
                </div>
            </div>    
        @endif

    </div>



@endsection