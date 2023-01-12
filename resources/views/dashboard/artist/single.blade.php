@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Artist / View </span>
        </h4>
        <div class="row gy-4">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="img-fluid rounded my-4"
                                    @if (count($artist->images) > 0) src="{{ $artist->images[0] }}"
                                    @else src="" @endif
                                    height="110" width="110" alt="User avatar" />
                                <div class="user-info text-center">
                                    <h5 class="mb-2">{{ $artist->first_name_ru }} {{ $artist->last_name_ru }}</h5>
                                    <span class="badge bg-label-secondary">{{ $artist->speciality }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                            <div class="d-flex align-items-start me-4 mt-3 gap-3" style="align-items: center !important">
                                <span class="badge bg-label-primary p-2 rounded"><i class="fa-solid fa-eye"></i></span>
                                <div>
                                    <h5 class="mb-0">{{ $artist->views }}</h5>
                                </div>

                            </div>
                            <div class="d-flex align-items-start mt-3 gap-3" style="align-items: center !important">
                                <span class="badge bg-label-primary p-2 rounded"><i class="fa-solid fa-star"></i></span>
                                <div>
                                    @php $rate = $artist->rate; @endphp
                                    <h5 class="mb-0">
                                        @for ($i = 0; $i < $rate; $i++)
                                            <i class="fa-sharp fa-solid fa-star"></i>
                                        @endfor
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-2 border-bottom mb-4">Details</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Category:</span>
                                    <span>{{ $artist->category->name_uz }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Slug:</span>
                                    <span>{{ $artist->slug }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Status:</span>
                                    <span class="badge bg-label-success">Active</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Label:</span>
                                    <span>{{ $artist->label }}</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center pt-3">
                                <a href="javascript:;" class="btn btn-label-warning me-3" data-bs-target="#editUser"
                                    data-bs-toggle="modal">Edit</a>
                                <a href="javascript:;" class="btn btn-label-danger suspend-user">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
            </div>

            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-home" aria-controls="navs-justified-home"
                                aria-selected="true">
                                More
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile"
                                aria-selected="false">
                                Products
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                            <!-- Description Beginning -->
                            <div class="card mb-4">
                                <h5 class="card-header">Description</h5>
                                <div class="card-body table-responsive mb-3">
                                    <div class="demo-inline-spacing mt-3">
                                        <div class="list-group list-group-horizontal-md text-md-center">
                                            <a class="list-group-item list-group-item-action active" id="home-list-item"
                                                data-bs-toggle="list" href="#description_uz">Uz</a>
                                            <a class="list-group-item list-group-item-action" id="profile-list-item"
                                                data-bs-toggle="list" href="#description_ru">Ru</a>
                                            <a class="list-group-item list-group-item-action" id="messages-list-item"
                                                data-bs-toggle="list" href="#description_en">En</a>
                                        </div>
                                        <div class="tab-content px-0 mt-0">
                                            <div class="tab-pane fade show active" id="description_uz">
                                                {{ $artist->description_uz }}
                                            </div>
                                            <div class="tab-pane fade" id="description_ru">
                                                {{ $artist->description_ru }}
                                            </div>
                                            <div class="tab-pane fade" id="description_en">
                                                {{ $artist->description_en }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Description End -->

                            <!-- Muzey Beginning -->
                            <div class="card mb-4">
                                <h5 class="card-header">Muzey</h5>
                                <div class="card-body table-responsive mb-3">
                                    <div class="demo-inline-spacing mt-3">
                                        <div class="list-group list-group-horizontal-md text-md-center">
                                            <a class="list-group-item list-group-item-action active" id="home-list-item"
                                                data-bs-toggle="list" href="#muzey_uz">Uz</a>
                                            <a class="list-group-item list-group-item-action" id="profile-list-item"
                                                data-bs-toggle="list" href="#muzey_ru">Ru</a>
                                            <a class="list-group-item list-group-item-action" id="messages-list-item"
                                                data-bs-toggle="list" href="#muzey_en">En</a>
                                        </div>
                                        <div class="tab-content px-0 mt-0">
                                            <div class="tab-pane fade show active" id="muzey_uz">
                                                {{ $artist->muzey_uz }}
                                            </div>
                                            <div class="tab-pane fade" id="muzey_ru">
                                                {{ $artist->muzey_ru }}
                                            </div>
                                            <div class="tab-pane fade" id="muzey_en">
                                                {{ $artist->muzey_en }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Muzey End -->

                            <!-- Medal Beginning -->
                            <div class="card mb-4">
                                <h5 class="card-header">Medal</h5>
                                <div class="card-body table-responsive mb-3">
                                    <div class="demo-inline-spacing mt-3">
                                        <div class="list-group list-group-horizontal-md text-md-center">
                                            <a class="list-group-item list-group-item-action active" id="home-list-item"
                                                data-bs-toggle="list" href="#medal_uz">Uz</a>
                                            <a class="list-group-item list-group-item-action" id="profile-list-item"
                                                data-bs-toggle="list" href="#medal_ru">Ru</a>
                                            <a class="list-group-item list-group-item-action" id="messages-list-item"
                                                data-bs-toggle="list" href="#medal_en">En</a>
                                        </div>
                                        <div class="tab-content px-0 mt-0">
                                            <div class="tab-pane fade show active" id="medal_uz">
                                                {{ $artist->medal_uz }}
                                            </div>
                                            <div class="tab-pane fade" id="medal_ru">
                                                {{ $artist->medal_ru }}
                                            </div>
                                            <div class="tab-pane fade" id="medal_en">
                                                {{ $artist->medal_en }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Medal End -->
                        </div>
                        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>#</th>
                                            <th>Slug</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Views</th>
                                            <th>Photo</th>
                                        </tr>
                                    </thead>
                                    <?php $n = 0; ?>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($artist->products as $product)
                                            <tr>
                                                <th scope="row">
                                                    {{ ++$n }}
                                                </th>
                                                <td>
                                                    <a href="{{ Route('products.show', $product->slug) }}">{{ $product->slug }}</a>
                                                </td>
                                                <td>{{ $product->name_uz }} {{ $product->name_ru }}</td>
                                                <td>{{ $product->type->name_uz }}</td>
                                                <td>{{ $product->views }}</td>
                                                <td>
                                                    @if (count($product->images) > 0)
                                                        <img class="img-fluid rounded my-4"
                                                            src="{{ $product->images[0]->image }} " height="110"
                                                            width="110" alt="User avatar" />
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Edit User Information</h3>
                            <p>Updating user details will receive a privacy audit.</p>
                        </div>
                        <form id="editUserForm" class="row g-3" onsubmit="return false">
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserFirstName">First Name</label>
                                <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName"
                                    class="form-control" placeholder="John" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserLastName">Last Name</label>
                                <input type="text" id="modalEditUserLastName" name="modalEditUserLastName"
                                    class="form-control" placeholder="Doe" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalEditUserName">Username</label>
                                <input type="text" id="modalEditUserName" name="modalEditUserName"
                                    class="form-control" placeholder="john.doe.007" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserEmail">Email</label>
                                <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                    class="form-control" placeholder="example@domain.com" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserStatus">Status</label>
                                <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select"
                                    aria-label="Default select example">
                                    <option selected>Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                    <option value="3">Suspended</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditTaxID">Tax ID</label>
                                <input type="text" id="modalEditTaxID" name="modalEditTaxID"
                                    class="form-control modal-edit-tax-id" placeholder="123 456 7890" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserPhone">Phone Number</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">+1</span>
                                    <input type="text" id="modalEditUserPhone" name="modalEditUserPhone"
                                        class="form-control phone-number-mask" placeholder="202 555 0111" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserLanguage">Language</label>
                                <select id="modalEditUserLanguage" name="modalEditUserLanguage"
                                    class="select2 form-select" multiple>
                                    <option value="">Select</option>
                                    <option value="english" selected>English</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="french">French</option>
                                    <option value="german">German</option>
                                    <option value="dutch">Dutch</option>
                                    <option value="hebrew">Hebrew</option>
                                    <option value="sanskrit">Sanskrit</option>
                                    <option value="hindi">Hindi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserCountry">Country</label>
                                <select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="switch">
                                    <input type="checkbox" class="switch-input" />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label">Usee as a billing address </span>
                                </label>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->
        <!-- /Modal -->
    </div>
@endsection
