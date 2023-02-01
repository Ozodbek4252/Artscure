@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.News Category Update') }}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('newsCategory.index') }}" style="padding: 10px"><i
                                class='bx bx-arrow-back'></i>{{ __('body.Back') }}</a>
                    </div>

                    <form action="{{ Route('newsCategory.update', $news_category) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body d-flex">
                            <div class="col-md-2">
                                <label class="form-label" for="name_uz">{{ __('body.Name') }} {{ __('body.Uz') }}</label>
                                <input name="name_uz" value="{{ $news_category->name_uz }}" type="text"
                                    class="form-control" placeholder="{{ __('body.Name') }} {{ __('body.Uz') }}" />
                                @error('name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="name_ru">{{ __('body.Name') }} {{ __('body.Ru') }}</label>
                                <input name="name_ru" value="{{ $news_category->name_ru }}" type="text"
                                    class="form-control" id="defaultFormControlInput"
                                    placeholder="{{ __('body.Name') }} {{ __('body.Ru') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="name_en">{{ __('body.Name') }} {{ __('body.En') }}</label>
                                <input name="name_en" value="{{ $news_category->name_en }}" type="text"
                                    class="form-control" id="defaultFormControlInput"
                                    placeholder="{{ __('body.Name') }} {{ __('body.En') }}"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" style="visibility: hidden;">a</label>
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
