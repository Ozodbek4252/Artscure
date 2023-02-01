@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Banner Create') }}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-2 px-2 my-2">
                    <a href="{{ Route('banners.index') }}" style="padding: 10px"><i
                            class='bx bx-arrow-back'></i>{{ __('body.Back') }}</a>
                </div>

                <form action="{{ Route('banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label" for="type">{{ __('body.Type') }}</label>
                                <select name="type" id="type" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Type</option>
                                    <option value="top">{{ __('body.Top') }}</option>
                                    <option value="bottom">{{ __('body.Bottom') }}</option>
                                    <option value="other">{{ __('body.Other') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="title_uz">{{ __('body.Title') }} {{ __('body.Uz') }}</label>
                                <input name="title_uz" id="title_uz" type="text" class="form-control"
                                    placeholder="{{ __('body.Title') }} {{ __('body.Uz') }}" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="title_ru">{{ __('body.Title') }}
                                    {{ __('body.Ru') }}</label>
                                <input name="title_ru" id="title_ru" type="text" class="form-control"
                                    placeholder="{{ __('body.Title') }} {{ __('body.Ru') }}"
                                    aria-describedby="defaultFormControlHelp" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="title_en">{{ __('body.Title') }}
                                    {{ __('body.En') }}</label>
                                <input name="title_en" id="title_en" type="text" class="form-control"
                                    placeholder="{{ __('body.Title') }} {{ __('body.En') }}"
                                    aria-describedby="defaultFormControlHelp" />
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-md-4">
                                <label class="form-label" for="body_uz">{{ __('body.Body') }} {{ __('body.Uz') }}</label>
                                <textarea name="body_uz" id="body_uz" type="text" class="form-control"
                                    placeholder="{{ __('body.Body') }} {{ __('body.Uz') }}"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="body_ru">{{ __('body.Body') }} {{ __('body.Ru') }}</label>
                                <textarea name="body_ru" id="body_ru" type="text" class="form-control"
                                    placeholder="{{ __('body.Body') }} {{ __('body.Ru') }}"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="body_en">{{ __('body.Body') }} {{ __('body.En') }}</label>
                                <textarea name="body_en" id="body_en" type="text" class="form-control"
                                    placeholder="{{ __('body.Body') }} {{ __('body.En') }}"></textarea>
                            </div>
                        </div>

                        <?php
                        $first_name = 'first_name_' . app()->getLocale();
                        $name = 'name_' . app()->getLocale();
                        ?>
                        <div class="row my-4">
                            <div class="col-md-4">
                                <label class="form-label" for="link">{{ __('body.For Link') }}</label>
                                <select name="link" id="link" class="select2 form-select" data-allow-clear="true">
                                    <option value=""></option>
                                    <optgroup label="Artists">
                                        @foreach ($artists as $artist)
                                            <option value="{{ $artist->id }}.artist">{{ $artist->$first_name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Products">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}.product">{{ $product->$name }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                @error('link')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="image">{{ __('body.Image') }}</label>
                                <input name="image" id="image" class="form-control" type="file" />
                                @error('image')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit"
                                    class="form-control btn btn-outline-success">{{ __('body.Create') }}</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
