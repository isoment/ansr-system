@extends('layouts.guest')

@section('content')

    <div class="relative pt-20 container mx-auto px-4 lg:px-20 xl:px-32">
        <livewire:property-listing-show :propertyListing="$propertyListing">
    </div>

@endsection