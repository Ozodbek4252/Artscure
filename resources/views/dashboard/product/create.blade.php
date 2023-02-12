@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Product Create') }}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('products.index') }}" style="padding: 10px"><i
                                class='bx bx-arrow-back'></i>{{ __('body.Back') }}</a>
                    </div>

                    <form action="{{ Route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{--  name (uz, ru, en)  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="name_uz">{{ __('body.Name Uz') }}</label>
                                <input name="name_uz" type="text" id="name_uz" class="form-control"
                                    placeholder="{{ __('body.Name Uz') }}" />
                                @error('name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="name_ru">{{ __('body.Name Ru') }}</label>
                                <input name="name_ru" type="text" id="name_ru" class="form-control"
                                    placeholder="{{ __('body.Name Ru') }}" />
                                @error('name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="name_en">{{ __('body.Name En') }}</label>
                                <input name="name_en" type="text" id="name_en" class="form-control"
                                    placeholder="{{ __('body.Name En') }}" />
                                @error('name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  artist, main_image, images  --}}
                        <?php
                        $first_name = 'first_name_' . app()->getLocale();
                        $name = 'name_' . app()->getLocale();
                        ?>
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="artist">{{ __('body.Artist') }}</label>
                                <select name="artist_id" id="artist" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Artist</option>
                                    @foreach ($artists as $artist)
                                        <option value="{{ $artist->id }}">{{ $artist->$first_name }}</option>
                                    @endforeach
                                </select>
                                @error('artist_id')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="main_image">{{ __('body.Main Image') }}</label>
                                <input name="main_image" type="file" id="main_image" class="form-control" />
                                @error('main_image')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="images">{{ __('body.Images') }}</label>
                                <input name="images[]" type="file" id="images" class="form-control" multiple />
                                @error('images')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  type, tools  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="type">{{ __('body.Type') }}</label>
                                <select name="type_id" id="type" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->$name }}</option>
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
                                                    <option value="{{ $tool->id }}">{{ $tool->$name }}</option>
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

                        {{--  price, year, city  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="price">{{ __('body.Price') }}</label>
                                <input name="price" type="number" id="price" class="form-control"
                                    placeholder="{{ __('body.Price') }}" />
                                @error('price')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="year">{{ __('body.Year') }}</label>
                                <input name="year" type="number" id="year" class="form-control"
                                    placeholder="{{ __('body.Year') }}" />
                                @error('year')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="city">{{ __('body.City') }}</label>
                                <input name="city" type="text" id="city" class="form-control"
                                    placeholder="{{ __('body.City') }}" />
                                @error('city')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  description (uz, ru, en)  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="description_uz">{{ __('body.Description Uz') }}</label>
                                <textarea name="description_uz" type="text" id="description_uz" class="form-control"
                                    placeholder="{{ __('body.Description Uz') }}"></textarea>
                                @error('description_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="description_ru">{{ __('body.Description Ru') }}</label>
                                <textarea name="description_ru" type="text" id="description_ru" class="form-control"
                                    placeholder="{{ __('body.Description Ru') }}"></textarea>
                                @error('description_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="description_en">{{ __('body.Description En') }}</label>
                                <textarea name="description_en" type="text" id="description_en" class="form-control"
                                    placeholder="{{ __('body.Description En') }}"></textarea>
                                @error('description_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  Resell name  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="resell_name_uz">{{ __('body.Resell Name Uz') }}</label>
                                <input name="resell_name_uz" type="text" id="resell_name_uz" class="form-control"
                                    placeholder="{{ __('body.Resell Name Uz') }}" />
                                @error('resell_name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 px-2">
                                <label class="form-label" for="resell_name_ru">{{ __('body.Resell Name Ru') }}</label>
                                <input name="resell_name_ru" type="text" id="resell_name_ru" class="form-control"
                                    placeholder="{{ __('body.Resell Name Ru') }}" />
                                @error('resell_name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="resell_name_en">{{ __('body.Resell Name En') }}</label>
                                <input name="resell_name_en" type="text" id="resell_name_en" class="form-control"
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
                                    placeholder="{{ __('body.Resell Body Uz') }}"></textarea>
                                @error('resell_body_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="resell_body_ru">{{ __('body.Resell Body Ru') }}</label>
                                <textarea name="resell_body_ru" type="text" id="resell_body_ru" class="form-control"
                                    placeholder="{{ __('body.Resell Body Ru') }}"></textarea>
                                @error('resell_body_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="resell_body_en">{{ __('body.Resell Body En') }}</label>
                                <textarea name="resell_body_en" type="text" id="resell_body_en" class="form-control"
                                    placeholder="{{ __('body.Resell Body En') }}"></textarea>
                                @error('resell_body_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  size, unique, certificate, signiture, frame  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="size">{{ __('body.Size') }}</label>
                                <input name="size" type="text" id="size" class="form-control"
                                    placeholder="{{ __('body.Size') }}" />
                                @error('size')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="unique">{{ __('body.Unique') }}</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="unique" class="form-check-input" type="checkbox" id="unique" />
                                </div>
                                @error('unique')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="certificate">{{ __('body.Certificate') }}</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="certificate" class="form-check-input" type="checkbox"
                                        id="certificate" />
                                </div>
                                @error('certificate')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="signiture">{{ __('body.Signiture') }}</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="signiture" class="form-check-input" type="checkbox" id="signiture" />
                                </div>
                                @error('signiture')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="frame">{{ __('body.Frame') }}</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="frame" class="form-check-input" type="checkbox" id="frame" />
                                </div>
                                @error('frame')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  status  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="status">{{ __('body.Status') }}</label>
                                <input name="status" type="text" id="status" class="form-control"
                                    placeholder="{{ __('body.Status') }}" />
                                @error('status')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-2">
                                <button type="submit"
                                    class="form-control btn btn-outline-success">{{ __('body.Create') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
