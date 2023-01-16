@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Products List
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('products.create') }}" class="form-control btn btn-outline-success">Create</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Slug</th>
                            <th>Name Uz</th>
                            <th>Category</th>
                            <th>Artist</th>
                            <th>Price</th>
                            <th>Views</th>
                            <th>Photo</th>
                            <th>Sotilgan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($products->currentPage() - 1) * $products->perPage() }}</th>
                                <td><a href="{{ Route('products.show', $product->slug) }}">{{ $product->slug }}</a></td>
                                <td>{{ $product->name_uz }}</td>
                                <td>@if($product->type){{ $product->type->category->name_uz }}@endif</td>
                                <td>@if($product->artist)<a href="{{ Route('artists.show', $product->artist->slug) }}">{{ $product->artist->first_name_uz }}</a>@endif</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->views }}</td>
                                <td>
                                    @if (count($product->images) > 0)<img class="img-fluid rounded my-4"
                                    src="{{ $product->images[0]->image }} "
                                    height="110" width="110" alt="User avatar" />
                                    @endif
                                </td>
                                <td>@if($product->is_sold == 0) Yes @else Ha @endif</td>
                                <td>
                                    <button type="button" class="form-control btn btn-outline-danger"
                                        data-bs-toggle="modal" data-bs-target="#animationModal{{$product->id}}"
                                        style="width: 90px">Delete</button>
                                    <a href="{{ Route('products.edit', $product->slug) }}"
                                        class="form-control btn btn-outline-warning" style="width: 90px">Edit</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade animate__animated fadeIn" id="animationModal{{$product->id}}" tabindex="-1"
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
                                                <form action="{{ Route('products.destroy', $product->slug) }}" method="POST">
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
                    {{ $products->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
