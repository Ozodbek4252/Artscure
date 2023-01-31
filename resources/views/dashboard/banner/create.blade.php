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

                <form action="{{ Route('banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="type" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Type</option>
                                    <option value="top">Top</option>
                                    <option value="bottom">Bottom</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input name="title_uz" type="text" class="form-control" placeholder="Title Uz" />
                            </div>
                            <div class="col-md-3">
                                <input name="title_ru" type="text" class="form-control" placeholder="Title Ru"
                                    aria-describedby="defaultFormControlHelp" />
                            </div>
                            <div class="col-md-3">
                                <input name="title_en" type="text" class="form-control" placeholder="Title En"
                                    aria-describedby="defaultFormControlHelp" />
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-md-4">
                                <textarea name="body_uz" type="text" class="form-control" placeholder="Body Uz"></textarea>
                            </div>
                            <div class="col-md-4">
                                <textarea name="body_ru" type="text" class="form-control" placeholder="Body Ru"></textarea>
                            </div>
                            <div class="col-md-4">
                                <textarea name="body_en" type="text" class="form-control" placeholder="Body En"></textarea>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col-md-4">
                                <label class="form-label" for="link">For Link</label>
                                <select name="link" id="link" class="select2 form-select" data-allow-clear="true">
                                    <option value=""></option>
                                    <optgroup label="Artists">
                                        @foreach ($artists as $artist)
                                            <option value="{{ $artist->id }}.artist">{{ $artist->first_name_uz }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Products">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}.product">{{ $product->name_uz }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                @error('link')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
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
