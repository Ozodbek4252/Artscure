@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Order Create
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('orders.index') }}" style="padding: 10px"><i class='bx bx-arrow-back'></i>Back</a>
                    </div>

                    <form action="{{ Route('orders.update', $order->slug) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="name">Name</label>
                                <input name="name" value="{{ $order->name }}" type="text" id="name"
                                    class="form-control" placeholder="Name" />
                                @error('name')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="phone">Phone</label>
                                <input name="phone" value="{{ $order->phone }}" type="text" id="phone"
                                    class="form-control" placeholder="Phone" />
                                @error('phone')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="product">Products</label>
                                <select name="product_id" id="product" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option @if ($order->product_id == $product->id) selected @endif
                                            value="{{ $product->id }}">{{ $product->name_uz }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-4">
                                <label class="form-label" for="address">Address</label>
                                <input name="address" value="{{ $order->address }}" type="text" id="address"
                                    class="form-control" placeholder="Address" />
                                @error('address')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 px-2">
                                <label class="form-label" for="payment_type">Payment Type</label>
                                <input name="payment_type" value="{{ $order->payment_type }}" type="text" id="payment_type"
                                    class="form-control" placeholder="Payment Type" />
                                @error('payment_type')
                                    <span class="error alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body d-flex">
                            <div class="col-md-2">
                                <button type="submit" class="form-control btn btn-outline-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
