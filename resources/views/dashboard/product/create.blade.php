@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Product Create
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('products.index') }}" style="padding: 10px"><i class='bx bx-arrow-back'></i>Back</a>
                    </div>

                    <form action="{{ Route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{--  name (uz, ru, en)  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="name_uz">Name Uz</label>
                                <input name="name_uz" type="text" id="name_uz" class="form-control"
                                    placeholder="Name Uz" />
                                @error('name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="name_ru">Name Ru</label>
                                <input name="name_ru" type="text" id="name_ru" class="form-control"
                                    placeholder="Name Ru" />
                                @error('name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="name_en">Name En</label>
                                <input name="name_en" type="text" id="name_en" class="form-control"
                                    placeholder="Name En" />
                                @error('name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  artist, main_image, images  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="artist">Artist</label>
                                <select name="artist_id" id="artist" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Artist</option>
                                    @foreach ($artists as $artist)
                                        <option value="{{ $artist->id }}">{{ $artist->first_name_uz }}</option>
                                    @endforeach
                                </select>
                                @error('artist_id')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="main_image">Main Image</label>
                                <input name="main_image" type="file" id="main_image" class="form-control"
                                    placeholder="Main Image" />
                                @error('main_image')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="images">Images</label>
                                <input name="images[]" type="file" id="images" class="form-control"
                                    placeholder="Images" multiple />
                                @error('images')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  type, tools  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="type">Type</label>
                                <select name="type_id" id="type" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name_uz }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-8 px-2">
                                <label class="form-label" for="tools">Tools</label>
                                <select name="tools[]" id="tools" class="select2 form-select" multiple>
                                    @foreach ($types as $type)
                                        @if (count($type->tools) > 0)
                                            <optgroup label="{{ $type->name_uz }}">
                                                @foreach ($type->tools as $tool)
                                                    <option value="{{ $tool->id }}">{{ $tool->name_uz }}</option>
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
                                <label class="form-label" for="price">Price</label>
                                <input name="price" type="number" id="price" class="form-control"
                                    placeholder="Price" />
                                @error('price')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="year">Year</label>
                                <input name="year" type="number" id="year" class="form-control"
                                    placeholder="Year" />
                                @error('year')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="city">City</label>
                                <input name="city" type="text" id="city" class="form-control"
                                    placeholder="City" />
                                @error('city')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  description (uz, ru, en)  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="description_uz">Description Uz</label>
                                <textarea name="description_uz" type="text" id="description_uz" class="form-control"
                                    placeholder="Description Uz"></textarea>
                                @error('description_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="description_ru">Description Ru</label>
                                <textarea name="description_ru" type="text" id="description_ru" class="form-control"
                                    placeholder="Description Ru"></textarea>
                                @error('description_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="description_en">Description En</label>
                                <textarea name="description_en" type="text" id="description_en" class="form-control"
                                    placeholder="Description En"></textarea>
                                @error('description_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  size, unique, certificate, signiture, frame  --}}
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="size">Size</label>
                                <input name="size" type="text" id="size" class="form-control"
                                    placeholder="Size" />
                                @error('size')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="unique">Unique</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="unique" class="form-check-input" type="checkbox" id="unique" />
                                </div>
                                @error('unique')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="certificate">Certificate</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="certificate" class="form-check-input" type="checkbox"
                                        id="certificate" />
                                </div>
                                @error('certificate')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="signiture">Signiture</label>
                                <div class="form-check form-switch mb-2">
                                    <input name="signiture" class="form-check-input" type="checkbox" id="signiture" />
                                </div>
                                @error('signiture')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="frame">Frame</label>
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
                                <label class="form-label" for="status">Status</label>
                                <input name="status" type="text" id="status" class="form-control"
                                    placeholder="Status" />
                                @error('status')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-2">
                                <button type="submit" class="form-control btn btn-outline-success">{{__('body.Create')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
