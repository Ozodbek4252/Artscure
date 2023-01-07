@extends('layouts.admin')

@section('content')
    <div class="container-fluid ">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Types
        </h4>

        <div class="card">
            <livewire:type />
        </div>
    </div>
@endsection
