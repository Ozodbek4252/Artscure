@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Banners
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('banners.create') }}" class="form-control btn btn-outline-success">Create</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Type</th>
                            <th>Title Uz</th>
                            <th>Title Ru</th>
                            <th>Title En</th>
                            <th style="width: 600px !important">Body Uz</th>
                            <th style="width: 600px !important">Body Ru</th>
                            <th style="width: 600px !important">Body En</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($banners as $banner)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($banners->currentPage() - 1) * $banners->perPage() }}</th>
                                <td>{{ $banner->type }}</td>
                                <td>{{ $banner->title_uz }}</td>
                                <td>{{ $banner->title_ru }}</td>
                                <td>{{ $banner->title_en }}</td>
                                <td style="width: 600px">{{ $banner->body_uz }}</td>
                                <td style="width: 600px">{{ $banner->body_ru }}</td>
                                <td style="width: 600px">{{ $banner->body_en }}</td>
                                <td>
                                    @if (count($banner->images) > 0)
                                        <img class="img-fluid rounded my-4"
                                            src="{{ $banner->images[0]->image }} "
                                            height="110" width="110" alt="User avatar" />
                                    @endif
                                </td>
                                <td>
                                    <button
                                        class="form-control btn btn-outline-danger" style="width: 90px">Delete</button>
                                    <a href="{{ Route('banners.edit', $banner->id) }}"
                                        class="form-control btn btn-outline-warning" style="width: 90px">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{ $banners->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
