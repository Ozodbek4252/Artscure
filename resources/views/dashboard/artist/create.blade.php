@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Artist Create') }}</span>
        </h4>

        <?php $name = 'name_' . app()->getLocale(); ?>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('artists.index') }}" style="padding: 10px"><i
                                class='bx bx-arrow-back'></i>{{ __('body.Back') }}</a>
                    </div>

                    <form action="{{ Route('artists.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="first_name_uz">{{ __('body.First Name Uz') }}</label>
                                <input name="first_name_uz" id="first_name_uz" type="text" class="form-control"
                                    placeholder="{{ __('body.First Name Uz') }}" />
                                @error('first_name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="first_name_ru">{{ __('body.First Name Ru') }}</label>
                                <input name="first_name_ru" id="first_name_ru" type="text" class="form-control"
                                    placeholder="{{ __('body.First Name Ru') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('first_name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="first_name_en">{{ __('body.First Name En') }}</label>
                                <input name="first_name_en" id="first_name_en" type="text" class="form-control"
                                    placeholder="{{ __('body.First Name En') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('first_name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="last_name_uz">{{ __('body.Last Name En') }}</label>
                                <input name="last_name_uz" id="last_name_uz" type="text" class="form-control"
                                    placeholder="{{ __('body.Last Name Uz') }}" />
                                @error('last_name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="last_name_ru">{{ __('body.Last Name En') }}</label>
                                <input name="last_name_ru" id="last_name_ru" type="text" class="form-control"
                                    placeholder="{{ __('body.Last Name Ru') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('last_name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="last_name_en">{{ __('body.Last Name En') }}</label>
                                <input name="last_name_en" id="last_name_en" type="text" class="form-control"
                                    placeholder="{{ __('body.Last Name En') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('last_name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="category">{{ __('body.Category') }}</label>
                                <select name="category_id" id="category" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">{{ __('body.Select Category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->$name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
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

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="speciality">{{ __('body.Speciality') }}</label>
                                <input name="speciality" id="speciality" type="text" class="form-control"
                                    placeholder="{{ __('body.Speciality') }}" />
                                @error('speciality')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="rate">{{ __('body.Rate') }}</label>
                                <input name="rate" id="rate" type="number" class="form-control"
                                    placeholder="{{ __('body.Rate') }}" aria-describedby="defaultFormControlHelp" />
                                @error('rate')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="label">{{ __('body.Label') }}</label>
                                <input name="label" id="label" type="text" class="form-control"
                                    placeholder="{{ __('body.Label') }}" aria-describedby="defaultFormControlHelp" />
                                @error('label')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="image">{{ __('body.Image') }}</label>
                                <input name="image" id="image" type="file" class="form-control"
                                    placeholder="Image" />
                                @error('image')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="description_uz">{{ __('body.Description Uz') }}</label>
                                <textarea name="description_uz" id="description_uz" type="text" class="form-control"
                                    placeholder="{{ __('body.Description Uz') }}"></textarea>
                                @error('description_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="description_ru">{{ __('body.Description Ru') }}</label>
                                <textarea name="description_ru" id="description_ru" type="number" class="form-control"
                                    placeholder="{{ __('body.Description Ru') }}"></textarea>
                                @error('description_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="description_en">{{ __('body.Description En') }}</label>
                                <textarea name="description_en" id="description_en" type="text" class="form-control"
                                    placeholder="{{ __('body.Description En') }}"></textarea>
                                @error('description_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="muzey_uz">{{ __('body.Muzey Uz') }}</label>
                                <textarea name="muzey_uz" id="muzey_uz" type="text" class="form-control"
                                    placeholder="{{ __('body.Muzey Uz') }}"></textarea>
                                @error('muzey_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="muzey_ru">{{ __('body.Muzey Ru') }}</label>
                                <textarea name="muzey_ru" id="muzey_ru" type="number" class="form-control"
                                    placeholder="{{ __('body.Muzey Ru') }}"></textarea>
                                @error('muzey_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="muzey_en">{{ __('body.Muzey En') }}</label>
                                <textarea name="muzey_en" id="muzey_en" type="text" class="form-control"
                                    placeholder="{{ __('body.Muzey En') }}"></textarea>
                                @error('muzey_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="medal_uz">{{ __('body.Medal Uz') }}</label>
                                <textarea name="medal_uz" id="medal_uz" type="text" class="form-control"
                                    placeholder="{{ __('body.Medal Uz') }}"></textarea>
                                @error('medal_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="medal_ru">{{ __('body.Medal Ru') }}</label>
                                <textarea name="medal_ru" id="medal_ru" type="number" class="form-control"
                                    placeholder="{{ __('body.Medal Ru') }}"></textarea>
                                @error('medal_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="medal_en">{{ __('body.Medal En') }}</label>
                                <textarea name="medal_en" id="medal_en" type="text" class="form-control"
                                    placeholder="{{ __('body.Medal En') }}"></textarea>
                                @error('medal_en')
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
