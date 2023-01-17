@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Categories List
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('categories.create') }}" class="form-control btn btn-outline-success">Create</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Name Uz</th>
                            <th>Name Ru</th>
                            <th>Name En</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($categories->currentPage() - 1) * $categories->perPage() }}</th>
                                <td>{{ $category->name_uz }}</td>
                                <td>{{ $category->name_ru }}</td>
                                <td>{{ $category->name_en }}</td>
                                <td>
                                    @if (count($category->images) > 0)<img class="img-fluid rounded my-4"
                                        src="{{ $category->images[0]->image }} "
                                        height="110" width="110" alt="User avatar" />
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="form-control btn btn-outline-danger"
                                        data-bs-toggle="modal" data-bs-target="#animationModal"
                                        style="width: auto;">Delete</button>
                                    <a href="{{ Route('categories.edit', $category->id) }}"
                                        class="form-control btn btn-outline-warning" style="width: auto;">Edit</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade animate__animated fadeIn" id="animationModal" tabindex="-1"
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
                                            {{$category->id}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                                <form action="{{ Route('categories.destroy', $category->id) }}" method="POST">
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
                    {{ $categories->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
