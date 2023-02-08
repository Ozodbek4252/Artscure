@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Artist Update') }}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('artists.index') }}" style="padding: 10px"><i
                                class='bx bx-arrow-back'></i>{{ __('body.Back') }}</a>
                    </div>

                    <form action="{{ Route('artists.update', $artist->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="first_name_uz">{{ __('body.First Name Uz') }}</label>
                                <input name="first_name_uz" id="first_name_uz" value="{{ $artist->first_name_uz }}"
                                    type="text" class="form-control" placeholder="{{ __('body.First Name Uz') }}" />
                                @error('first_name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="first_name_ru">{{ __('body.First Name Ru') }}</label>
                                <input name="first_name_ru" id="first_name_ru" value="{{ $artist->first_name_ru }}"
                                    type="text" class="form-control" placeholder="{{ __('body.First Name Ru') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('first_name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="first_name_en">{{ __('body.First Name En') }}</label>
                                <input name="first_name_en" id="first_name_en" value="{{ $artist->first_name_en }}"
                                    type="text" class="form-control" placeholder="{{ __('body.First Name En') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('first_name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="last_name_uz">{{ __('body.Last Name Uz') }}</label>
                                <input name="last_name_uz" id="last_name_uz" value="{{ $artist->last_name_uz }}"
                                    type="text" class="form-control" placeholder="{{ __('body.Last Name Uz') }}" />
                                @error('last_name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="last_name_ru">{{ __('body.Last Name Ru') }}</label>
                                <input name="last_name_ru" id="last_name_ru" value="{{ $artist->last_name_ru }}"
                                    type="text" class="form-control" placeholder="{{ __('body.Last Name Ru') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('last_name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="last_name_en">{{ __('body.Last Name En') }}</label>
                                <input name="last_name_en" id="last_name_en" value="{{ $artist->last_name_en }}"
                                    type="text" class="form-control" placeholder="{{ __('body.Last Name En') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('last_name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <?php $name = 'name_' . app()->getLocale(); ?>
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="category">{{ __('body.Category') }}</label>
                                <select name="category_id" id="category" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">{{ __('body.Select Category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($artist->category_id == $category->id) selected @endif>{{ $category->$name }}
                                        </option>
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
                                <label class="form-label" for="speciality">{{ __('body.Speciality') }}</label>
                                <input name="speciality" id="speciality" value="{{ $artist->speciality }}"
                                    type="text" class="form-control" placeholder="{{ __('body.Speciality') }}" />
                                @error('speciality')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="rate">{{ __('body.Rate') }}</label>
                                <input name="rate" id="rate" value="{{ $artist->rate }}" type="number"
                                    class="form-control" placeholder="{{ __('body.Rate') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('rate')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="category">{{ __('body.Category') }}</label>
                                <input name="label" value="{{ $artist->label }}" type="text" class="form-control"
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
                                    placeholder="{{ __('body.Image') }}" />
                                @error('image')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 card-body" style="padding-top: 0; padding-bottom: 0;">
                                @if (count($artist->images) > 0)
                                    <img class="img-fluid rounded my-4" src="/{{ $artist->images[0]->image }} "
                                        height="110" width="110" alt="User avatar"
                                        style="margin-top: 0 !important; margin-bottom: 0 !important;" />
                                @endif
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="muzey_en">{{ __('body.Description Uz') }}</label>
                                <textarea name="description_uz" type="text" class="form-control" placeholder="{{ __('body.Description Uz') }}">{{ $artist->description_uz }}</textarea>
                                @error('description_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="muzey_en">{{ __('body.Description Ru') }}</label>
                                <textarea name="description_ru" type="number" class="form-control" placeholder="{{ __('body.Description Ru') }}">{{ $artist->description_ru }}</textarea>
                                @error('description_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="muzey_en">{{ __('body.Description En') }}</label>
                                <textarea name="description_en" type="text" class="form-control" placeholder="{{ __('body.Description En') }}">{{ $artist->description_en }}</textarea>
                                @error('description_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="muzey_uz">{{ __('body.Muzey Uz') }}</label>
                                <textarea name="muzey_uz" id="muzey_uz" type="text" class="form-control"
                                    placeholder="{{ __('body.Muzey Uz') }}">{{ $artist->muzey_uz }}</textarea>
                                @error('muzey_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="muzey_ru">{{ __('body.Muzey Ru') }}</label>
                                <textarea name="muzey_ru" id="muzey_ru" type="number" class="form-control"
                                    placeholder="{{ __('body.Muzey Ru') }}">{{ $artist->muzey_ru }}</textarea>
                                @error('muzey_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="muzey_en">{{ __('body.Muzey En') }}</label>
                                <textarea name="muzey_en" id="muzey_en" type="text" class="form-control"
                                    placeholder="{{ __('body.Muzey En') }}">{{ $artist->muzey_en }}</textarea>
                                @error('muzey_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="medal_uz">{{ __('body.Medal Uz') }}</label>
                                <textarea name="medal_uz" id="medal_uz" type="text" class="form-control"
                                    placeholder="{{ __('body.Medal Uz') }}">{{ $artist->medal_uz }}</textarea>
                                @error('medal_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="medal_ru">{{ __('body.Medal Ru') }}</label>
                                <textarea name="medal_ru" id="medal_ru" type="number" class="form-control"
                                    placeholder="{{ __('body.Medal Ru') }}">{{ $artist->medal_ru }}</textarea>
                                @error('medal_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="medal_en">{{ __('body.Medal En') }}</label>
                                <textarea name="medal_en" id="medal_en" type="text" class="form-control"
                                    placeholder="{{ __('body.Medal En') }}">{{ $artist->medal_en }}</textarea>
                                @error('medal_en')
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
