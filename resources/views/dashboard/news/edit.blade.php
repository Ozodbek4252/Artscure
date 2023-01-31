@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.News Update') }}
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('news.index') }}" style="padding: 10px"><i
                                class='bx bx-arrow-back'></i>{{ __('body.Back') }}</a>
                    </div>

                    <form action="{{ Route('news.update', $news->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="title_uz">{{ __('body.Title') }} {{ __('body.Uz') }}</label>
                                <input name="title_uz" value="{{ $news->title_uz }}" id="title_uz" type="text"
                                    class="form-control" placeholder="{{ __('body.Title') }} {{ __('body.Uz') }}" />
                                @error('title_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="title_ru">{{ __('body.Title') }}
                                    {{ __('body.Ru') }}</label>
                                <input name="title_ru" value="{{ $news->title_ru }}" id="title_ru" type="text"
                                    class="form-control" placeholder="{{ __('body.Title') }} {{ __('body.Ru') }}" />
                                @error('title_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="title_en">{{ __('body.Title') }}
                                    {{ __('body.En') }}</label>
                                <input name="title_en" value="{{ $news->title_en }}" id="title_en" type="text"
                                    class="form-control" placeholder="{{ __('body.Title') }} {{ __('body.En') }}" />
                                @error('title_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-12">
                                <label class="form-label" for="body_uz">{{ __('body.Body') }} {{ __('body.Uz') }}</label>
                                <textarea name="body_uz" id="body_uz" type="text" class="form-control"
                                    placeholder="{{ __('body.Body') }} {{ __('body.Uz') }}">
                                    {{ $news->body_uz }}
                                </textarea>
                                @error('body_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-12">
                                <label class="form-label" for="body_ru">{{ __('body.Body') }} {{ __('body.Ru') }}</label>
                                <textarea name="body_ru" id="body_ru" type="number" class="form-control"
                                    placeholder="{{ __('body.Body') }} {{ __('body.Ru') }}">
                                    {{ $news->body_ru }}
                                </textarea>
                                @error('body_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-12">
                                <label class="form-label" for="body_en">{{ __('body.Body') }} {{ __('body.En') }}</label>
                                <textarea name="body_en" id="body_en" type="text" class="form-control"
                                    placeholder="{{ __('body.Body') }} {{ __('body.En') }}">
                                    {{ $news->body_en }}
                                </textarea>
                                @error('body_en')
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
                                        <option @if ($news->category_id == $category->id) selected @endif
                                            value="{{ $category->id }}">{{ $category->name_uz }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="image">{{ __('body.Image') }}</label>
                                <input name="image" type="file" class="form-control" placeholder="Image" />
                                @error('image')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 card-body" style="padding-top: 0; padding-bottom: 0;">
                                @if (count($news->images) > 0)
                                    <img class="img-fluid rounded my-4" src="/{{ $news->images[0]->image }} "
                                        height="110" width="110" alt="User avatar"
                                        style="margin-top: 0 !important; margin-bottom: 0 !important;" />
                                @endif
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="video_link">{{ __('body.Video') }} (Youtube)</label>
                                <input name="video_link" id="video_link" value="{{$news->video_link}}" type="text" class="form-control"
                                    placeholder="{{ __('body.Video') }}" />
                                @error('video_link')
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

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#body_uz'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#body_ru'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#body_en'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
