@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Sellers List') }}</span>
        </h4>

        <div class="card">

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>{{ __('body.Full Name') }}</th>
                            <th>{{ __('body.Phone') }}</th>
                            <th>{{ __('body.Email') }}</th>
                            <th>{{ __('body.Cover Letter') }}</th>
                            <th>{{ __('body.Portfolio') }}</th>
                            <th>{{ __('body.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($requests as $request)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($requests->currentPage() - 1) * $requests->perPage() }}</th>
                                <td>{{ $request->full_name }}</td>
                                <td>{{ $request->phone }}</td>
                                <td>{{ $request->email }}</td>
                                <td>{{ $request->cover_letter }}</td>
                                <td>{{ $request->portfolio }}</td>
                                <td>
                                    <button type="button" class="form-control btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#animationModal{{ $request->id }}"
                                        style="width: auto;">{{ __('body.Delete') }}</button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade animate__animated fadeIn" id="animationModal{{ $request->id }}"
                                tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel5">{{ __('body.Confirmation') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <p>{{ __('body.Do you really want to delete this data?') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                                            <form action="{{ Route('requests.destroy', $request->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger">{{ __('body.Delete') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    {{ $requests->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
