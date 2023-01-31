@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">{{ __('body.News List') }}
        </h4>

        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 px-2 my-2">
                        <a href="{{ Route('news.create') }}"
                            class="form-control btn btn-outline-success">{{ __('body.Create') }}</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>{{ __('body.Category') }}</th>
                            <th>{{ __('body.Photo') }}</th>
                            <th>{{ __('body.Title') }} {{ __('body.Uz') }}</th>
                            <th>{{ __('body.Title') }} {{ __('body.Ru') }}</th>
                            <th>{{ __('body.Title') }} {{ __('body.En') }}</th>
                            <th>{{ __('body.Body') }} {{ __('body.Uz') }}</th>
                            <th>{{ __('body.Body') }} {{ __('body.Ru') }}</th>
                            <th>{{ __('body.Body') }} {{ __('body.En') }}</th>
                            <th>{{ __('body.Views') }}</th>
                            <th>{{ __('body.Video') }}</th>
                            <th>{{ __('body.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($news as $new)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index + 1 + ($news->currentPage() - 1) * $news->perPage() }}</th>
                                <td>{{ $new->category->name_uz }}</td>
                                <td>
                                    @if (count($new->images) > 0)
                                        <img class="img-fluid rounded my-4" src="{{ $new->images[0]->image }} "
                                            height="110" width="110" alt="User avatar" />
                                    @endif
                                </td>
                                <td>{{ $new->title_uz }}</td>
                                <td>{{ $new->title_ru }}</td>
                                <td>{{ $new->title_en }}</td>
                                <td>{!! $new->body_uz !!}</td>
                                <td>{!! $new->body_ru !!}</td>
                                <td>{!! $new->body_en !!}</td>
                                <td>{{ $new->views }}</td>
                                <td>{{ $new->video_link }}</td>
                                <td>
                                    <button type="button" class="form-control btn btn-outline-danger"
                                        data-bs-toggle="modal" data-bs-target="#animationModal"
                                        style="width: auto;">{{ __('body.Delete') }}</button>
                                    <a href="{{ Route('news.edit', $new->slug) }}"
                                        class="form-control btn btn-outline-warning"
                                        style="width: auto;">{{ __('body.Edit') }}</a>
                                </td>
                            </tr>

                            {{--  Model Beginning  --}}
                            <div class="modal fade animate__animated fadeIn" id="animationModal" tabindex="-1"
                                aria-hidden="true">
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
                                            <form action="{{ Route('news.destroy', $new->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger">{{ __('body.Delete') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  Model Ending  --}}
                        @endforeach
                    </tbody>
                    {{ $news->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
