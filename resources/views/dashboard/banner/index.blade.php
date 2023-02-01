@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.Banners') }}</span>
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('banners.create') }}"
                            class="form-control btn btn-outline-success">{{ __('body.Create') }}</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>{{ __('body.Type') }}</th>
                            <th>{{ __('body.Title') }} {{ __('body.Uz') }}</th>
                            <th>{{ __('body.Title') }} {{ __('body.Ru') }}</th>
                            <th>{{ __('body.Title') }} {{ __('body.En') }}</th>
                            <th style="width: 600px !important">{{ __('body.Body') }} {{ __('body.Uz') }}</th>
                            <th style="width: 600px !important">{{ __('body.Body') }} {{ __('body.Ru') }}</th>
                            <th style="width: 600px !important">{{ __('body.Body') }} {{ __('body.En') }}</th>
                            <th>{{ __('body.Image') }}</th>
                            <th>{{ __('body.Link') }}</th>
                            <th>{{ __('body.Link Type') }}</th>
                            <th>{{ __('body.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($banners as $banner)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($banners->currentPage() - 1) * $banners->perPage() }}</th>
                                <td>{{ $banner->type }}</td>
                                <td>{{ $banner->title_uz }}</td>
                                <td>{{ $banner->title_ru }}</td>
                                <td>{{ $banner->title_en }}</td>
                                <td style="width: 600px">{{ $banner->body_uz }}</td>
                                <td style="width: 600px">{{ $banner->body_ru }}</td>
                                <td style="width: 600px">{{ $banner->body_en }}</td>
                                <td>
                                    @if (count($banner->images) > 0)
                                        <img class="img-fluid rounded my-4" src="{{ $banner->images[0]->image }} "
                                            height="110" width="110" alt="User avatar" />
                                    @endif
                                </td>
                                <td>{{ $banner->link }}</td>
                                <td>{{ $banner->link_type }}</td>
                                <td>
                                    <button type="button" class="form-control btn btn-outline-danger" style="width: auto;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#animationModal{{ $banner->id }}">{{__('body.Delete')}}</button>
                                    <a href="{{ Route('banners.edit', $banner->id) }}"
                                        class="form-control btn btn-outline-warning" style="width: auto;">{{__('body.Edit')}}</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade animate__animated fadeIn" id="animationModal{{ $banner->id }}"
                                tabindex="-1" aria-hidden="true">
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
                                            <form action="{{ Route('banners.destroy', $banner->id) }}" method="POST">
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
                    {{ $banners->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
