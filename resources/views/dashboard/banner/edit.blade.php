@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Banners
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-2 px-2 my-2">
                    <a href="{{ Route('banners.index') }}" style="padding: 10px"><i class='bx bx-arrow-back'></i>Back</a>
                </div>

                <form action="{{ Route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="type" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Type</option>
                                    <option @if ($banner->type == 'top') selected @endif value="top">Top</option>
                                    <option @if ($banner->type == 'bottom') selected @endif value="bottom">Bottom</option>
                                    <option @if ($banner->type == 'other') selected @endif value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input name="title_uz" value="{{ $banner->title_uz }}" type="text" class="form-control"
                                    placeholder="Title Uz" />
                            </div>
                            <div class="col-md-3">
                                <input name="title_ru" value="{{ $banner->title_ru }}" type="text" class="form-control"
                                    placeholder="Title Ru" aria-describedby="defaultFormControlHelp" />
                            </div>
                            <div class="col-md-3">
                                <input name="title_en" value="{{ $banner->title_en }}" type="text" class="form-control"
                                    placeholder="Title En" aria-describedby="defaultFormControlHelp" />
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-md-4">
                                <textarea name="body_uz" type="text" class="form-control" placeholder="Body Uz">{{ $banner->body_uz }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <textarea name="body_ru" type="text" class="form-control" placeholder="Body Ru">{{ $banner->body_ru }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <textarea name="body_en" type="text" class="form-control" placeholder="Body En">{{ $banner->body_en }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <input name="image" class="form-control" type="file" />
                                @error('image')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <img class="img-fluid rounded"
                                    src="@if (count($banner->images) > 0) /{{ $banner->images[0]->image }} @endif"
                                    height="110" width="110" alt="User avatar" />
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="form-control btn btn-outline-success">Update</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
