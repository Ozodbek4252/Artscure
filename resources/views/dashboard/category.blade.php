@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Categories
        </h4>

        <div class="card">
            <h5 class="card-header">Categories list</h5>
            <livewire:category-add />
        </div>
    </div>
@endsection
