@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Product Update') }}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('products.index') }}" style="padding: 10px"><i
                                class='bx bx-arrow-back'></i>{{ __('body.Back') }}</a>
                    </div>

                    <form action="{{ Route('products.update', $product->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="name_uz">{{ __('body.Name Uz') }}</label>
                                <input name="name_uz" value="{{ $product->name_uz }}" type="text" id="name_uz"
                                    class="form-control" placeholder="{{ __('body.Name Uz') }}" />
                                @error('name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="name_ru">{{ __('body.Name Ru') }}</label>
                                <input name="name_ru" value="{{ $product->name_ru }}" type="text" id="name_ru"
                                    class="form-control" placeholder="{{ __('body.Name Ru') }}" />
                                @error('name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="name_en">{{ __('body.Name En') }}</label>
                                <input name="name_en" value="{{ $product->name_en }}" type="text" id="name_en"
                                    class="form-control" placeholder="{{ __('body.Name En') }}" />
                                @error('name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <?php $first_name = 'first_name_' . app()->getLocale(); ?>
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="artist">{{ __('body.Artist') }}</label>
                                <select name="artist_id" id="artist" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Artist</option>
                                    @foreach ($artists as $artist)
                                        <option @if ($product->artist_id == $artist->id) selected @endif
                                            value="{{ $artist->id }}">{{ $artist->$first_name }}</option>
                                    @endforeach
                                </select>
                                @error('artist_id')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="main_image">{{ __('body.Main Image') }}</label>
                                <input name="main_image" type="file" id="main_image" class="form-control"
                                    placeholder="Main Image" />
                                @error('main_image')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="images">{{ __('body.Images') }}</label>
                                <input name="images[]" type="file" id="images" class="form-control"
                                    placeholder="Images" multiple />
                                @error('images')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                            </div>

                            <div class="col-md-4 px-2">
                                @if (count($product->images) > 0)
                                    <img class="img-fluid rounded my-4" src="/{{ $product->images[0]->image }} "
                                        height="110" width="110" alt="User avatar" style="margin-top: 0 !important;" />
                                @endif
                            </div>

                            <div class="col-md-4">
                                @if (count($product->images) > 0)
                                    @foreach ($product->images->where('type', 'other') as $image)
                                        <img class="img-fluid rounded my-4" src="/{{ $image->image }} " height="110"
                                            width="110" alt="User avatar" style="margin-top: 0 !important;" />
                                        <span class="badge rounded-pill bg-danger text-white badge-notifications"
                                            style="margin-left: -11px; margin-top: -14px; cursor: pointer;"
                                            data-bs-toggle="modal"
                                            data-bs-target="#animationModal{{ $image->id }}">x</span>

                                        <!-- Modal -->
                                        <div class="modal fade animate__animated fadeIn"
                                            id="animationModal{{ $image->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel5">
                                                            {{ __('body.Confirmation') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <p>{{ __('body.Do you really want to delete this image?') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-label-secondary"
                                                            data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                                                        <a href="{{ Route('images.destroy', $image->id) }}"
                                                            class="btn btn-danger">{{ __('body.Delete') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal End -->
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <?php $name = 'name_' . app()->getLocale(); ?>
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="type">{{ __('body.Type') }}</label>
                                <select name="type_id" id="type" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Select Type</option>
                                    @foreach ($types as $type)
                                        <option @if ($product->type_id == $type->id) selected @endif
                                            value="{{ $type->id }}">{{ $type->$name }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-8 px-2">
                                <label class="form-label" for="tools">{{ __('body.Tools') }}</label>
                                <select name="tools[]" id="tools" class="select2 form-select" multiple>
                                    @foreach ($types as $type)
                                        @if (count($type->tools) > 0)
                                            <optgroup label="{{ $type->$name }}">
                                                @foreach ($type->tools as $tool)
                                                    <option value="{{ $tool->id }}"
                                                        @foreach ($toolables as $toolable)
                                                            @if ($toolable->tool_id == $tool->id) selected @endif @endforeach>
                                                        {{ $tool->$name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                @error('tools')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="price">{{ __('body.Price') }}</label>
                                <input name="price" value="{{ $product->price }}" type="number" id="price"
                                    class="form-control" placeholder="{{ __('body.Price') }}" />
                                @error('price')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="year">{{ __('body.Year') }}</label>
                                <input name="year" value="{{ $product->year }}" type="number" id="year"
                                    class="form-control" placeholder="{{ __('body.Year') }}" />
                                @error('year')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="city">{{ __('body.City') }}</label>
                                <input name="city" value="{{ $product->city }}" type="text" id="city"
                                    class="form-control" placeholder="{{ __('body.City') }}" />
                                @error('city')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="description_uz">{{ __('body.Description Uz') }}</label>
                                <textarea name="description_uz" type="text" id="description_uz" class="form-control"
                                    placeholder="{{ __('body.Description Uz') }}">{{ $product->description_uz }}</textarea>
                                @error('description_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="description_ru">{{ __('body.Description Ru') }}</label>
                                <textarea name="description_ru" type="text" id="description_ru" class="form-control"
                                    placeholder="{{ __('body.Description Ru') }}">{{ $product->description_ru }}</textarea>
                                @error('description_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="description_en">{{ __('body.Description En') }}</label>
                                <textarea name="description_en" type="text" id="description_en" class="form-control"
                                    placeholder="{{ __('body.Description En') }}">{{ $product->description_en }}</textarea>
                                @error('description_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @php
                            $resell = json_decode($product->resell, true);
                        @endphp
                        {{--  Resell name  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="resell_name_uz">{{ __('body.Resell Name Uz') }}</label>
                                <input name="resell_name_uz" value="{{$resell['resell_name_uz']}}" type="text" id="resell_name_uz"
                                    class="form-control" placeholder="{{ __('body.Resell Name Uz') }}" />
                                @error('resell_name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 px-2">
                                <label class="form-label" for="resell_name_ru">{{ __('body.Resell Name Ru') }}</label>
                                <input name="resell_name_ru" value="{{$resell['resell_name_ru']}}" type="text" id="resell_name_ru"
                                    class="form-control" placeholder="{{ __('body.Resell Name Ru') }}" />
                                @error('resell_name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="resell_name_en">{{ __('body.Resell Name En') }}</label>
                                <input name="resell_name_en" value="{{$resell['resell_name_en']}}" type="text"
                                    id="resell_name_en" class="form-control"
                                    placeholder="{{ __('body.Resell Name En') }}" />
                                @error('resell_name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  resell body (uz, ru, en)  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="resell_body_uz">{{ __('body.Resell Body Uz') }}</label>
                                <textarea name="resell_body_uz" type="text" id="resell_body_uz" class="form-control"
                                    placeholder="{{ __('body.Resell Body Uz') }}">{{$resell['resell_body_uz']}}</textarea>
                                @error('resell_body_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="resell_body_ru">{{ __('body.Resell Body Ru') }}</label>
                                <textarea name="resell_body_ru" type="text" id="resell_body_ru" class="form-control"
                                    placeholder="{{ __('body.Resell Body Ru') }}">{{$resell['resell_body_ru']}}</textarea>
                                @error('resell_body_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="resell_body_en">{{ __('body.Resell Body En') }}</label>
                                <textarea name="resell_body_en" type="text" id="resell_body_en" class="form-control"
                                    placeholder="{{ __('body.Resell Body En') }}">{{$resell['resell_body_en']}}</textarea>
                                @error('resell_body_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="size">{{ __('body.Size') }}</label>
                                <input name="size" value="{{ $product->size }}" type="text" id="size"
                                    class="form-control" placeholder="{{ __('body.Size') }}" />
                                @error('size')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="unique">{{ __('body.Unique') }}</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="unique" @if ($product->unique) checked @endif
                                        class="form-check-input" type="checkbox" id="unique" />
                                </div>
                                @error('unique')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="certificate">{{ __('body.Certificate') }}</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="certificate" @if ($product->certificate) checked @endif
                                        class="form-check-input" type="checkbox" id="certificate" />
                                </div>
                                @error('certificate')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="signiture">{{ __('body.Signiture') }}</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="signiture" @if ($product->signiture) checked @endif
                                        class="form-check-input" type="checkbox" id="signiture" />
                                </div>
                                @error('signiture')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="frame">{{ __('body.Frame') }}</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="frame" @if ($product->frame) checked @endif
                                        class="form-check-input" type="checkbox" id="frame" />
                                </div>
                                @error('frame')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="status">{{ __('body.Status') }}</label>
                                <input name="status" value="{{ $product->status }}" type="text" id="status"
                                    class="form-control" placeholder="Status" />
                                @error('status')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-2">
                                <button type="submit"
                                    class="form-control btn btn-outline-success">{{ __('body.Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
