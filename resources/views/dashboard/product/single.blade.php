@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Product / View </span>
        </h4>
        <div class="row gy-4">
            <!-- User Sidebar -->
            <div class="col-xl-6 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <div class="swiper" id="swiper-3d-coverflow-effect">
                                    <div class="swiper-wrapper">
                                        @if ($product->images->where('type', 'main')->first())
                                            <?php $path = '../../' . $product->images->where('type', 'main')->first()->image; ?>
                                            <div class="swiper-slide" style="background-image: url({{ $path }})">
                                            </div>
                                        @endif
                                        @if (count($product->images->where('type', 'other')) > 0)
                                            @foreach ($product->images->where('type', 'other') as $image)
                                                <div class="swiper-slide"
                                                    style="background-image: url(../../{{ $image->image }})">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <h5 class="pb-2 border-bottom mb-4">Details</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Name:</span>
                                    <span> Uz: {{ $product->name_uz }} | Ru: {{ $product->name_uz }} @if ($product->name_en)
                                            | En: {{ $product->name_en }}
                                        @endif
                                        @if ($product->category != null)
                                            {{ $product->category->name_uz }}
                                        @endif
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Slug:</span>
                                    <span>{{ $product->slug }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Type:</span>
                                    <span>{{ $product->type->name_uz }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Artist:</span>
                                    <span><a
                                            href="{{ Route('artists.show', $product->artist->slug) }}">{{ $product->artist->first_name_uz }}</a></span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Price:</span>
                                    <span>{{ $product->price }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Year:</span>
                                    <span>{{ $product->year }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">City:</span>
                                    <span>{{ $product->city }}</span>
                                </li>

                                <li class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-xl-6">
                                            <span class="fw-bold me-2">Unique:</span>
                                            @if ($product->unique)
                                                <span class="badge bg-label-success">Yes</span>
                                            @else
                                                <span class="badge bg-label-danger">No</span>
                                            @endif
                                        </div>
                                        <div class="col-xl-6">
                                            <span class="fw-bold me-2">Certificate:</span>
                                            @if ($product->certificate)
                                                <span class="badge bg-label-success">Yes</span>
                                            @else
                                                <span class="badge bg-label-danger">No</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <span class="fw-bold me-2">Signiture:</span>
                                            @if ($product->signiture)
                                                <span class="badge bg-label-success">Yes</span>
                                            @else
                                                <span class="badge bg-label-danger">No</span>
                                            @endif
                                        </div>
                                        <div class="col-xl-6">
                                            <span class="fw-bold me-2">Frame:</span>
                                            @if ($product->frame)
                                                <span class="badge bg-label-success">Yes</span>
                                            @else
                                                <span class="badge bg-label-danger">No</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>

                                <li class="mb-3">
                                    <span class="fw-bold me-2">Size:</span>
                                    <span>{{ $product->size }}</span>
                                </li>

                                <li class="mb-3">
                                    <span class="fw-bold me-2">Status:</span>
                                    <span>{{ $product->status }}</span>
                                </li>
                            </ul>
                            <div class="card-body demo-inline-spacing">
                                @foreach ($product->tools as $tool)
                                    <button type="button" class="btn btn-secondary text-nowrap">
                                        {{ $tool->name_uz }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center pt-3">
                                <a href="{{ Route('products.edit', $product->slug) }}"
                                    class="btn btn-label-warning me-3">Edit</a>
                                <button type="button" class="btn btn-label-danger suspend-user" data-bs-toggle="modal"
                                    data-bs-target="#animationModal{{ $product->id }}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
            </div>

            <div class="col-xl-6 col-lg-7 col-md-7 order-0 order-md-1">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-home" aria-controls="navs-justified-home"
                                aria-selected="true">
                                More
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                            <!-- Description Beginning -->
                            <div class="card mb-4">
                                <h5 class="card-header">Description</h5>
                                <div class="card-body table-responsive mb-3">
                                    <div class="demo-inline-spacing mt-3">
                                        <div class="list-group list-group-horizontal-md text-md-center">
                                            <a class="list-group-item list-group-item-action active" id="home-list-item"
                                                data-bs-toggle="list" href="#description_uz">Uz</a>
                                            <a class="list-group-item list-group-item-action" id="profile-list-item"
                                                data-bs-toggle="list" href="#description_ru">Ru</a>
                                            <a class="list-group-item list-group-item-action" id="messages-list-item"
                                                data-bs-toggle="list" href="#description_en">En</a>
                                        </div>
                                        <div class="tab-content px-0 mt-0">
                                            <div class="tab-pane fade show active" id="description_uz">
                                                {{ $product->description_uz }}
                                            </div>
                                            <div class="tab-pane fade" id="description_ru">
                                                {{ $product->description_ru }}
                                            </div>
                                            <div class="tab-pane fade" id="description_en">
                                                {{ $product->description_en }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Description End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade animate__animated fadeIn" id="animationModal{{ $product->id }}" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel5">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <p>Do you really want to delete this data?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ Route('products.destroy', $product->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End -->
    </div>
@endsection
