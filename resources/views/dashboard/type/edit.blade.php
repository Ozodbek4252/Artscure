@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Types
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-2 px-2 my-2">
                    <a href="{{ Route('types.index') }}" style="padding: 10px"><i class='bx bx-arrow-back'></i>Back</a>
                </div>

                <form action="{{ Route('types.update', $type->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body d-flex">
                        <div class="col-md-2">
                            <input name="name_uz" value="{{$type->name_uz}}" type="text" class="form-control" placeholder="Name Uz" />
                        </div>
                        <div class="col-md-2 px-2">
                            <input name="name_ru" value="{{$type->name_ru}}" type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="Name Ru" aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="col-md-2">
                            <input name="name_en" value="{{$type->name_en}}" type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="Name En" aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="col-md-2 px-2">
                            <select name="category_id" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option
                                    @if($category->id == $type->category_id)
                                    selected
                                    @endif
                                    value="{{ $category->id }}">{{ $category->name_uz }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 px-2">
                            <input name="image" class="form-control" type="file" />
                            <img class="img-fluid rounded my-4"
                                    src="@if (count($type->images) > 0) /{{ $type->images[0]->image }} @endif"
                                    height="110" width="110" alt="User avatar" />
                            @error('image')
                                <span class="error alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2 px-2">
                            <button type="submit" class="form-control btn btn-outline-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
