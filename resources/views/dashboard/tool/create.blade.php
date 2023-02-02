@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{__('body.Tools Create')}}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-2 px-2 my-2">
                    <a href="{{ Route('tools.index') }}" style="padding: 10px"><i class='bx bx-arrow-back'></i>{{__('body.Back')}}</a>
                </div>

                <form action="{{ Route('tools.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body d-flex">
                        <div class="col-md-2">
                            <label class="form-label" for="name_uz">{{__('body.Name')}} {{__('body.Uz')}}</label>
                            <input name="name_uz" type="text" id="name_uz" class="form-control" placeholder="Name Uz" />
                        </div>
                        <div class="col-md-2 px-2">
                            <label class="form-label" for="name_ru">{{__('body.Name')}} {{__('body.Ru')}}</label>
                            <input name="name_ru" type="text" id="name_ru" class="form-control" id="defaultFormControlInput"
                                placeholder="Name Ru" aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="name_en">{{__('body.Name')}} {{__('body.En')}}</label>
                            <input name="name_en" type="text" id="name_en" class="form-control" id="defaultFormControlInput"
                                placeholder="Name En" aria-describedby="defaultFormControlHelp" />
                        </div>
                        <?php $name = 'name_' . app()->getLocale(); ?>
                        <div class="col-md-2 px-2">
                            <label class="form-label" for="type">{{__('body.Type')}}</label>
                            <select name="type_id" id="type" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->$name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 px-2">
                            <label class="form-label" for="image">{{__('body.Photo')}}</label>
                            <input name="image" id="image" class="form-control" type="file" />
                            @error('image')
                                <span class="error alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2 px-2">
                            <label class="form-label" style="visibility: hidden;">a</label>
                            <button type="submit" class="form-control btn btn-outline-success">{{__('body.Create')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
