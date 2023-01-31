@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{__('body.Payment Types Update')}}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('paymentTypes.index') }}" style="padding: 10px"><i
                                class='bx bx-arrow-back'></i>Back</a>
                    </div>

                    <form action="{{ Route('paymentTypes.update', $payment_type->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body d-flex">
                            <div class="col-md-2 mx-2">
                                <label class="form-label" for="name">{{__('body.Name')}}</label>
                                <input name="name" value="{{ $payment_type->name }}" type="text" class="form-control"
                                    placeholder="{{__('body.Name')}}" />
                                @error('name')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label class="form-label" style="visibility: hidden;">a</label>
                                <button type="submit" class="form-control btn btn-outline-success">{{__('body.Update')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
