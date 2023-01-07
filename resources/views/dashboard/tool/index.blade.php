@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Tools
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('tools.create') }}" class="form-control btn btn-outline-success">Create</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Type</th>
                            <th>Name Uz</th>
                            <th>Name Ru</th>
                            <th>Name En</th>
                            <th>Photos</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($tools as $tool)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($tools->currentPage() - 1) * $tools->perPage() }}</th>
                                <td>{{ $tool->type->name_uz }}</td>
                                <td>{{ $tool->name_uz }}</td>
                                <td>{{ $tool->name_ru }}</td>
                                <td>{{ $tool->name_en }}</td>
                                <td>
                                    @if (count($tool->images) > 0)<img class="img-fluid rounded my-4"
                                        src=" {{ $tool->images[0]->image }} "
                                        height="110" width="110" alt="User avatar" />
                                    @endif
                                </td>
                                <td>
                                    <button
                                        class="form-control btn btn-outline-danger" style="width: 90px">Delete</button>
                                    <a href="{{ Route('tools.edit', $tool) }}"
                                        class="form-control btn btn-outline-warning" style="width: 90px">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{ $tools->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
