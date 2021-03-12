@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 py-8 lg:py-12 mx-auto">

    <livewire:tenant-request-show :serviceRequest="$serviceRequest"/>

</div>

@endsection