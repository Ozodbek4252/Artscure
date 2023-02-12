@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Product') }} / {{ __('body.View') }} </span>
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
                                        @if ($product)
                                            @if ($product->images->where('type', 'main')->first())
                                                <?php $path = '../../' . $product->images->where('type', 'main')->first()->image; ?>
                                                <div class="swiper-slide"
                                                    style="background-image: url({{ $path }})">
                                                </div>
                                            @endif
                                            @if (count($product->images->where('type', 'other')) > 0)
                                                @foreach ($product->images->where('type', 'other') as $image)
                                                    <div class="swiper-slide"
                                                        style="background-image: url(../../{{ $image->image }})">
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $name = 'name_' . app()->getLocale();
                        $first_name = 'first_name_' . app()->getLocale();
                        ?>
                        <h5 class="pb-2 border-bottom mb-4">{{ __('body.Details') }}</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Name') }}:</span>
                                    <span> {{ __('body.Uz') }}: {{ $product->name_uz }} | {{ __('body.Ru') }}:
                                        {{ $product->name_uz }} @if ($product->name_en)
                                            | {{ __('body.En') }}: {{ $product->name_en }}
                                        @endif
                                        @if ($product->category != null)
                                            {{ $product->category->name_uz }}
                                        @endif
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Slug') }}:</span>
                                    <span>{{ $product->slug }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Type') }}:</span>
                                    <span>
                                        @if ($product->type)
                                            {{ $product->type->$name }}
                                        @endif
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Artist') }}:</span>
                                    <span><a
                                            href="{{ Route('artists.show', $product->artist->slug) }}">{{ $product->artist->$first_name }}</a></span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Price') }}:</span>
                                    <span>{{ $product->price }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Year') }}:</span>
                                    <span>{{ $product->year }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.City') }}:</span>
                                    <span>{{ $product->city }}</span>
                                </li>

                                <li class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col-xl-6">
                                            <span class="fw-bold me-2">{{ __('body.Unique') }}:</span>
                                            @if ($product->unique)
                                                <span class="badge bg-label-success">{{ __('body.Yes') }}</span>
                                            @else
                                                <span class="badge bg-label-danger">{{ __('body.No') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-xl-6">
                                            <span class="fw-bold me-2">{{ __('body.Certificate') }}:</span>
                                            @if ($product->certificate)
                                                <span class="badge bg-label-success">{{ __('body.Yes') }}</span>
                                            @else
                                                <span class="badge bg-label-danger">{{ __('body.No') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <span class="fw-bold me-2">{{ __('body.Signiture') }}:</span>
                                            @if ($product->signiture)
                                                <span class="badge bg-label-success">{{ __('body.Yes') }}</span>
                                            @else
                                                <span class="badge bg-label-danger">{{ __('body.No') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-xl-6">
                                            <span class="fw-bold me-2">{{ __('body.Frame') }}:</span>
                                            @if ($product->frame)
                                                <span class="badge bg-label-success">{{ __('body.Yes') }}</span>
                                            @else
                                                <span class="badge bg-label-danger">{{ __('body.No') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>

                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Size') }}:</span>
                                    <span>{{ $product->size }}</span>
                                </li>

                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Status') }}:</span>
                                    <span>{{ $product->status }}</span>
                                </li>
                            </ul>
                            <div class="card-body demo-inline-spacing">
                                @foreach ($product->tools as $tool)
                                    <button type="button" class="btn btn-secondary text-nowrap">
                                        {{ $tool->$name }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center pt-3">
                                <a href="{{ Route('products.edit', $product->slug) }}"
                                    class="btn btn-label-warning me-3">{{ __('body.Edit') }}</a>
                                <button type="button" class="btn btn-label-danger suspend-user" data-bs-toggle="modal"
                                    data-bs-target="#animationModal{{ $product->id }}">{{ __('body.Delete') }}</button>
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
                                {{ __('body.More') }}
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                            <!-- Description Beginning -->
                            <div class="card mb-4">
                                <h5 class="card-header">{{ __('body.Description') }}</h5>
                                <div class="card-body table-responsive mb-3">
                                    <div class="demo-inline-spacing mt-3">
                                        <div class="list-group list-group-horizontal-md text-md-center">
                                            <a class="list-group-item list-group-item-action active" id="home-list-item"
                                                data-bs-toggle="list" href="#description_uz">{{ __('body.Uz') }}</a>
                                            <a class="list-group-item list-group-item-action" id="profile-list-item"
                                                data-bs-toggle="list" href="#description_ru">{{ __('body.Ru') }}</a>
                                            <a class="list-group-item list-group-item-action" id="messages-list-item"
                                                data-bs-toggle="list" href="#description_en">{{ __('body.En') }}</a>
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

                            <!-- Resell Beginning -->
                            @if ($product->resell)
                                <div class="card mb-4">
                                    <h5 class="card-header">{{ __('body.Resell') }}</h5>
                                    <div class="card-body table-responsive mb-3">
                                        <div class="demo-inline-spacing mt-3">
                                            <div class="list-group list-group-horizontal-md text-md-center">
                                                <a class="list-group-item list-group-item-action active"
                                                    id="home-list-item" data-bs-toggle="list"
                                                    href="#resell_body_uz">{{ __('body.Uz') }}</a>
                                                <a class="list-group-item list-group-item-action" id="profile-list-item"
                                                    data-bs-toggle="list" href="#resell_body_ru">{{ __('body.Ru') }}</a>
                                                <a class="list-group-item list-group-item-action" id="messages-list-item"
                                                    data-bs-toggle="list" href="#resell_body_en">{{ __('body.En') }}</a>
                                            </div>
                                            @php
                                                $resell = json_decode($product->resell, true);
                                            @endphp
                                            <div class="tab-content px-0 mt-0">
                                                <div class="tab-pane fade show active" id="resell_body_uz">
                                                    {{ __('body.Name') }}: {{ $resell['resell_name_uz'] }}
                                                    <br>
                                                    {{ __('body.Body') }}: {{ $resell['resell_body_uz'] }}
                                                </div>
                                                <div class="tab-pane fade" id="resell_body_ru">
                                                    {{ __('body.Name') }}: {{ $resell['resell_name_ru'] }}
                                                    <br>
                                                    {{ __('body.Body') }}: {{ $resell['resell_body_ru'] }}
                                                </div>
                                                <div class="tab-pane fade" id="resell_body_en">
                                                    {{ __('body.Name') }}: {{ $resell['resell_name_en'] }}
                                                    <br>
                                                    {{ __('body.Body') }}: {{ $resell['resell_body_en'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- Resell End -->
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
