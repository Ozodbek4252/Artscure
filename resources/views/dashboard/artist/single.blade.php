@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Artist') }} / {{ __('body.View') }} </span>
        </h4>
        <div class="row gy-4">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="img-fluid rounded my-4"
                                    @if (count($artist->images) > 0) src="/{{ $artist->images[0]->image }}"
                                    @else src="" @endif
                                    height="110" width="110" alt="User avatar" />
                                <?php
                                $first_name = 'first_name_' . app()->getLocale();
                                $last_name = 'last_name_' . app()->getLocale();
                                ?>
                                <div class="user-info text-center">
                                    <h5 class="mb-2">{{ $artist->$first_name }} {{ $artist->$last_name }}</h5>
                                    <span class="badge bg-label-secondary">{{ $artist->speciality }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                            <div class="d-flex align-items-start me-4 mt-3 gap-3" style="align-items: center !important">
                                <span class="badge bg-label-primary p-2 rounded"><i class="fa-solid fa-eye"></i></span>
                                <div>
                                    <h5 class="mb-0">{{ $artist->views }}</h5>
                                </div>

                            </div>
                            <div class="d-flex align-items-start mt-3 gap-3" style="align-items: center !important">
                                <span class="badge bg-label-primary p-2 rounded"><i class="fa-solid fa-star"></i></span>
                                <div>
                                    @php
                                        $rate = $artist->rate;
                                        $name = 'name_' . app()->getLocale();
                                    @endphp
                                    <h5 class="mb-0">
                                        @for ($i = 0; $i < $rate; $i++)
                                            <i class="fa-sharp fa-solid fa-star"></i>
                                        @endfor
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-2 border-bottom mb-4">{{ __('body.Details') }}</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Category') }}:</span>
                                    <span>
                                        @if ($artist->category != null)
                                            {{ $artist->category->$name }}
                                        @endif
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Slug') }}:</span>
                                    <span>{{ $artist->slug }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Status') }}:</span>
                                    <span class="badge bg-label-success">Active</span>
                                </li>
                                @if ($artist->label != null)
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('body.Label') }}:</span>
                                    <span>{{ $artist->label }}</span>
                                </li>
                                @endif
                            </ul>
                            <div class="card-body demo-inline-spacing">
                                @foreach ($artist->tools as $tool)
                                    <button type="button" class="btn btn-secondary text-nowrap">
                                        {{ $tool->$name }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center pt-3">
                                <a href="{{ Route('artists.edit', $artist->slug) }}"
                                    class="btn btn-label-warning me-3">{{ __('body.Edit') }}</a>
                                <button type="button" class="btn btn-label-danger suspend-user" data-bs-toggle="modal"
                                    data-bs-target="#animationModal{{ $artist->id }}">{{ __('body.Delete') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
            </div>

            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-home" aria-controls="navs-justified-home"
                                aria-selected="true">
                                {{ __('body.More') }}
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile"
                                aria-selected="false">
                                {{ __('body.Products') }}
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
                                                {{ $artist->description_uz }}
                                            </div>
                                            <div class="tab-pane fade" id="description_ru">
                                                {{ $artist->description_ru }}
                                            </div>
                                            <div class="tab-pane fade" id="description_en">
                                                {{ $artist->description_en }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Description End -->

                            <!-- Muzey Beginning -->
                            <div class="card mb-4">
                                <h5 class="card-header">{{ __('body.Muzey') }}</h5>
                                <div class="card-body table-responsive mb-3">
                                    <div class="demo-inline-spacing mt-3">
                                        <div class="list-group list-group-horizontal-md text-md-center">
                                            <a class="list-group-item list-group-item-action active" id="home-list-item"
                                                data-bs-toggle="list" href="#muzey_uz">{{ __('body.Uz') }}</a>
                                            <a class="list-group-item list-group-item-action" id="profile-list-item"
                                                data-bs-toggle="list" href="#muzey_ru">{{ __('body.Ru') }}</a>
                                            <a class="list-group-item list-group-item-action" id="messages-list-item"
                                                data-bs-toggle="list" href="#muzey_en">{{ __('body.En') }}</a>
                                        </div>
                                        <div class="tab-content px-0 mt-0">
                                            <div class="tab-pane fade show active" id="muzey_uz">
                                                {{ $artist->muzey_uz }}
                                            </div>
                                            <div class="tab-pane fade" id="muzey_ru">
                                                {{ $artist->muzey_ru }}
                                            </div>
                                            <div class="tab-pane fade" id="muzey_en">
                                                {{ $artist->muzey_en }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Muzey End -->

                            <!-- Medal Beginning -->
                            <div class="card mb-4">
                                <h5 class="card-header">{{ __('body.Medal') }}</h5>
                                <div class="card-body table-responsive mb-3">
                                    <div class="demo-inline-spacing mt-3">
                                        <div class="list-group list-group-horizontal-md text-md-center">
                                            <a class="list-group-item list-group-item-action active" id="home-list-item"
                                                data-bs-toggle="list" href="#medal_uz">{{ __('body.Uz') }}</a>
                                            <a class="list-group-item list-group-item-action" id="profile-list-item"
                                                data-bs-toggle="list" href="#medal_ru">{{ __('body.Ru') }}</a>
                                            <a class="list-group-item list-group-item-action" id="messages-list-item"
                                                data-bs-toggle="list" href="#medal_en">{{ __('body.En') }}</a>
                                        </div>
                                        <div class="tab-content px-0 mt-0">
                                            <div class="tab-pane fade show active" id="medal_uz">
                                                {{ $artist->medal_uz }}
                                            </div>
                                            <div class="tab-pane fade" id="medal_ru">
                                                {{ $artist->medal_ru }}
                                            </div>
                                            <div class="tab-pane fade" id="medal_en">
                                                {{ $artist->medal_en }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Medal End -->
                        </div>
                        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>#</th>
                                            <th>{{ __('body.Slug') }}</th>
                                            <th>{{ __('body.Name') }}</th>
                                            <th>{{ __('body.Type') }}</th>
                                            <th>{{ __('body.Views') }}</th>
                                            <th>{{ __('body.Photo') }}</th>
                                        </tr>
                                    </thead>
                                    <?php $n = 0; ?>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($artist->products as $product)
                                            <tr>
                                                <th scope="row">
                                                    {{ ++$n }}
                                                </th>
                                                <td>
                                                    <a
                                                        href="{{ Route('products.show', $product->slug) }}">{{ $product->slug }}</a>
                                                </td>
                                                <td>{{ $product->$name }}</td>
                                                <td>
                                                    {{ $product->type->$name }}
                                                </td>
                                                <td>{{ $product->views }}</td>
                                                <td>
                                                    @if (count($product->images) > 0)
                                                        <img class="img-fluid rounded my-4"
                                                            src="/{{ $product->images[0]->image }} " height="110"
                                                            width="110" alt="User avatar" />
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade animate__animated fadeIn" id="animationModal{{ $artist->id }}" tabindex="-1"
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
                        <form action="{{ Route('artists.destroy', $artist->slug) }}" method="POST">
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
