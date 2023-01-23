@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Currency Create') }}
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('currencies.index') }}" style="padding: 10px"><i
                                class='bx bx-arrow-back'></i>{{ __('body.Back') }}</a>
                    </div>

                    <form action="{{ Route('currencies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body d-flex">
                            <div class="col-md-2">
                                <label class="form-label" for="name">{{ __('body.Name') }}</label>
                                <input name="name" type="text" id="name" class="form-control"
                                    placeholder="{{ __('body.Name') }}" />
                                @error('name')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 px-2">
                                <label class="form-label" for="value">{{ __('body.Value') }}</label>
                                <input name="value" type="text" id="value" class="form-control"
                                    placeholder="{{ __('body.Value') }}" />
                                @error('value')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label class="form-label" style="visibility: hidden;">a</label>
                                <button type="submit"
                                    class="form-control btn btn-outline-success">{{ __('body.Create') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
