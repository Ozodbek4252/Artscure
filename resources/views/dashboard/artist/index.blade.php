@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Artists List
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('artists.create') }}" class="form-control btn btn-outline-success">Create</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Slug</th>
                            <th>Full Name</th>
                            <th>Speciality</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($artists as $artist)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($artists->currentPage() - 1) * $artists->perPage() }}</th>
                                <td><a href="{{Route('artists.show', $artist->slug)}}">{{ $artist->slug }}</a></td>
                                <td>{{ $artist->first_name_uz }} {{$artist->last_name_uz}}</td>
                                <td>{{ $artist->speciality }}</td>
                                <td>
                                    @if (count($artist->images) > 0)<img class="img-fluid rounded my-4"
                                        src="{{ $artist->images[0]->image }} "
                                        height="110" width="110" alt="User avatar" />
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="form-control btn btn-outline-danger"
                                        data-bs-toggle="modal" data-bs-target="#animationModal"
                                        style="width: 90px">Delete</button>
                                    <a href="{{ Route('artists.edit', $artist->id) }}"
                                        class="form-control btn btn-outline-warning" style="width: 90px">Edit</a>
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
                                            {{$artist->id}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                                <form action="{{ Route('artists.destroy', $artist->id) }}" method="POST">
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
                    {{ $artists->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
