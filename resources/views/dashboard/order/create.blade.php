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
                        <a href="{{ Route('categories.index') }}" style="padding: 10px"><i
                                class='bx bx-arrow-back'></i>Back</a>
                    </div>

                    <form action="{{ Route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body d-flex">
                            <div class="col-md-2">
                                <input name="name_uz" type="text" class="form-control" placeholder="Name Uz" />
                                @error('name_uz')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <input name="name_ru" type="text" class="form-control" id="defaultFormControlInput"
                                    placeholder="Name Ru" aria-describedby="defaultFormControlHelp" />
                                @error('name_ru')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input name="name_en" type="text" class="form-control" id="defaultFormControlInput"
                                    placeholder="Name En" aria-describedby="defaultFormControlHelp" />
                                @error('name_en')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <input name="image" class="form-control" type="file" />
                                @error('image')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

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
