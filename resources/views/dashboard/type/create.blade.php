@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Type Create') }}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-2 px-2 my-2">
                    <a href="{{ Route('types.index') }}" style="padding: 10px"><i
                            class='bx bx-arrow-back'></i>{{ __('body.Back') }}</a>
                </div>

                <form action="{{ Route('types.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body d-flex">
                        <div class="col-md-2">
                            <label class="form-label" for="name_uz">{{ __('body.Name') }} {{ __('body.Uz') }}</label>
                            <input name="name_uz" type="text" id="name_uz" class="form-control"
                                placeholder="{{ __('body.Name') }} {{ __('body.Uz') }}" />
                        </div>
                        <div class="col-md-2 px-2">
                            <label class="form-label" for="name_ru">{{ __('body.Name') }} {{ __('body.Ru') }}</label>
                            <input name="name_ru" type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="{{ __('body.Name') }} {{ __('body.Ru') }}"
                                aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="name_en">{{ __('body.Name') }} {{ __('body.En') }}</label>
                            <input name="name_en" type="text" id="name_en" class="form-control"
                                id="defaultFormControlInput" placeholder="{{ __('body.Name') }} {{ __('body.En') }}"
                                aria-describedby="defaultFormControlHelp" />
                        </div>
                        <?php $name = 'name_' . app()->getLocale(); ?>
                        <div class="col-md-2 px-2">
                            <label class="form-label" for="category">{{ __('body.Category') }}</label>
                            <select name="category_id" id="category" class="select2 form-select" data-allow-clear="true">
                                <option value=""></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->$name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 px-2">
                            <label class="form-label" for="name_ru">{{ __('body.Photo') }}</label>
                            <input name="image" class="form-control" type="file" />
                            @error('image')
                                <span class="error alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2 px-2">
                            <label class="form-label" style="visibility: hidden;">a</label>
                            <button type="submit"
                                class="form-control btn btn-outline-success">{{ __('body.Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
