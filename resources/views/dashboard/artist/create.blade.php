@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Category Create
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('artists.index') }}" style="padding: 10px"><i class='bx bx-arrow-back'></i>Back</a>
                    </div>

                    <form action="{{ Route('artists.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <input name="first_name_uz" type="text" class="form-control"
                                    placeholder="First Name Uz" />
                                @error('first_name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <input name="first_name_ru" type="text" class="form-control" placeholder="First Name Ru"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('first_name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <input name="first_name_en" type="text" class="form-control" placeholder="First Name En"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('first_name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <input name="last_name_uz" type="text" class="form-control" placeholder="Last Name Uz" />
                                @error('last_name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <input name="last_name_ru" type="text" class="form-control" placeholder="Last Name Ru"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('last_name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <input name="last_name_en" type="text" class="form-control" placeholder="Last Name En"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('last_name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="category">Category</label>
                                <select name="category_id" id="category" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name_uz }}</option>
                                    @endforeach
                                </select>
                                @error('speciality')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-8 px-2">
                                <label class="form-label" for="tools">Tools</label>
                                <select name="tools" id="tools" class="select2 form-select" placeholder="asdsda" multiple>
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
                                @error('rate')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <input name="speciality" type="text" class="form-control" placeholder="Speciality" />
                                @error('speciality')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <input name="rate" type="number" class="form-control" placeholder="Rating"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('rate')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <input name="label" type="text" class="form-control" placeholder="Label"
                                    aria-describedby="defaultFormControlHelp" />
                                @error('label')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <input name="image" type="file" class="form-control" placeholder="Image" />
                                @error('speciality')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <textarea name="description_uz" type="text" class="form-control" placeholder="Description Uz"></textarea>
                                @error('description_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <textarea name="description_ru" type="number" class="form-control" placeholder="Description Ru"></textarea>
                                @error('description_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <textarea name="description_en" type="text" class="form-control" placeholder="Description En"></textarea>
                                @error('description_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  <div class="col-md-2">
                                <button type="submit" class="form-control btn btn-outline-success">Create</button>
                            </div>  --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
