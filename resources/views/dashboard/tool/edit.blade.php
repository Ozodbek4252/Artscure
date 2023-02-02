@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{__('body.Tools Update')}}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-2 px-2 my-2">
                    <a href="{{ Route('tools.index') }}" style="padding: 10px"><i class='bx bx-arrow-back'></i>{{__('body.Back')}}</a>
                </div>

                <form action="{{ Route('tools.update', $tool->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body d-flex">
                        <div class="col-md-2">
                            <label class="form-label" for="name_uz">{{__('body.Name')}} {{__('body.Uz')}}</label>
                            <input name="name_uz" value="{{$tool->name_uz}}" id="name_uz" type="text" class="form-control" placeholder="Name Uz" />
                        </div>
                        <div class="col-md-2 px-2">
                            <label class="form-label" for="name_ru">{{__('body.Name')}} {{__('body.Ru')}}</label>
                            <input name="name_ru" value="{{$tool->name_ru}}" id="name_ru" type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="Name Ru" aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="name_en">{{__('body.Name')}} {{__('body.En')}}</label>
                            <input name="name_en" id="name_en" value="{{$tool->name_en}}" type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="Name En" aria-describedby="defaultFormControlHelp" />
                        </div>
                        <?php $name = 'name_' . app()->getLocale(); ?>
                        <div class="col-md-2 px-2">
                            <label class="form-label" for="type">{{__('body.Type')}}</label>
                            <select name="type_id" id="type" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select Type</option>
                                @foreach ($types as $type)
                                    <option
                                    @if($type->id == $tool->type_id)
                                    selected
                                    @endif
                                    value="{{ $type->id }}">{{ $type->$name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 px-2">
                            <label class="form-label" for="image">{{__('body.Photo')}}</label>
                            <input name="image" class="form-control" type="file" />
                            @if (count($tool->images) > 0)<img class="img-fluid rounded my-4"
                                    src=" /{{ $tool->images[0]->image }} "
                                    height="110" width="110" alt="User avatar" />
                            @endif
                        </div>
                        <div class="col-md-2 px-2">
                            <label class="form-label" style="visibility: hidden;">a</label>
                            <button type="submit" class="form-control btn btn-outline-success">{{__('body.Update')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
