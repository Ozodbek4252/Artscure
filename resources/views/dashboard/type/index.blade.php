@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Types
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('types.create') }}" class="form-control btn btn-outline-success">{{__('body.Create')}}</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Name Uz</th>
                            <th>Name Ru</th>
                            <th>Name En</th>
                            <th>Views</th>
                            <th>Photos</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($types as $type)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($types->currentPage() - 1) * $types->perPage() }}</th>
                                <td>{{ $type->category->name_uz }}</td>
                                <td>{{ $type->slug }}</td>
                                <td>{{ $type->name_uz }}</td>
                                <td>{{ $type->name_ru }}</td>
                                <td>{{ $type->name_en }}</td>
                                <td>{{ $type->views }}</td>
                                <td>
                                    @if (count($type->images) > 0)<img class="img-fluid rounded my-4"
                                        src="{{ $type->images[0]->image }} "
                                        height="110" width="110" alt="User avatar" />
                                    @endif
                                </td>
                                <td>
                                    <button type="button"
                                        class="form-control btn btn-outline-danger" style="width: 90px"
                                        data-bs-toggle="modal" data-bs-target="#animationModal{{$type->id}}">Delete</button>
                                    <a href="{{ Route('types.edit', $type->slug) }}"
                                        class="form-control btn btn-outline-warning" style="width: 90px">Edit</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade animate__animated fadeIn" id="animationModal{{$type->id}}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel5">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <p>Do you really want to delete this data?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                                <form action="{{ Route('types.destroy', $type->slug) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    {{ $types->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
