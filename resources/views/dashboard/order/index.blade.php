@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Orders List') }}</span>
        </h4>

        <div class="card">
            {{--  <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('orders.create') }}" class="form-control btn btn-outline-success">{{__('body.Create')}}</a>
                    </div>
                </div>
            </div>  --}}

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>{{ __('body.Slug') }}</th>
                            <th>{{ __('body.Name') }}</th>
                            <th>{{ __('body.Product') }}</th>
                            <th>{{ __('body.Phone') }}</th>
                            <th>{{ __('body.Address') }}</th>
                            <th>{{ __('body.Total Price') }}</th>
                            <th>{{ __('body.Status') }}</th>
                            <th>{{ __('body.Email') }}</th>
                            <th>{{ __('body.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</th>
                                <td>{{ $order->slug }}</td>
                                <td>{{ $order->name }}</td>
                                <td>
                                    @foreach ($order->products as $product)
                                        <li style="list-style: none;"><a
                                                href="{{ Route('products.show', $product->slug) }}">{{ $product->name_uz }}</a>
                                        </li>
                                    @endforeach
                                </td>
                                <td><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->email }}</td>

                                <td>
                                    <button type="button" class="form-control btn btn-outline-danger"
                                        data-bs-toggle="modal" data-bs-target="#animationModal{{ $order->id }}"
                                        style="width: auto;">Delete</button>
                                    {{--  <a href="{{ Route('orders.edit', $order->slug) }}"
                                        class="form-control btn btn-outline-warning" style="width: auto;">Edit</a>  --}}
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade animate__animated fadeIn" id="animationModal{{ $order->id }}"
                                tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel5">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <p>Do you really want to delete this data?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="{{ Route('orders.destroy', $order->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    {{ $orders->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
