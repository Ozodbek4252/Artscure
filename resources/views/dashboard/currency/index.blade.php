@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{__('body.Currency List')}}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('currencies.create') }}" class="form-control btn btn-outline-success">{{__('body.Create')}}</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>{{__('body.Name')}}</th>
                            <th>{{__('body.Value')}}</th>
                            <th>{{__('body.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($currencies as $currency)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($currencies->currentPage() - 1) * $currencies->perPage() }}</th>
                                <td>{{ $currency->name }}</td>
                                <td>{{ $currency->value }}</td>
                                <td>
                                    <button type="button" class="form-control btn btn-outline-danger"
                                        data-bs-toggle="modal" data-bs-target="#animationModal{{ $currency->id }}"
                                        style="width: auto;">{{__('body.Delete')}}</button>
                                    <a href="{{ Route('currencies.edit', $currency->id) }}"
                                        class="form-control btn btn-outline-warning" style="width: auto;">{{__('body.Edit')}}</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade animate__animated fadeIn" id="animationModal{{ $currency->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel5">{{__('body.Confirmation')}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <p>{{__('body.Do you really want to delete this data?')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">{{__('body.Close')}}</button>
                                                <form action="{{ Route('currencies.destroy', $currency->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">{{__('body.Delete')}}</button>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </tbody>
                    {{ $currencies->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
