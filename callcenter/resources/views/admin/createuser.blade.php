@extends('admin.test')

@section('content')
   							<!--begin::Content-->
                               <div id="kt_app_content" class="app-content flex-column-fluid">
								<!--begin::Content container-->
								<div id="kt_app_content_container" class="app-container container-fluid">
									<!--begin::Card-->
									<div class="card">
										<!--begin::Card header-->
										<div class="card-header border-0 pt-6">
											<!--begin::Card title-->
											<!--begin::Card title-->
											<!--begin::Card toolbar-->
											<div class="card-toolbar">
												<!--begin::Toolbar-->
												<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
													
													<!--begin::Add user-->
													<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
													<i class="ki-duotone ki-plus fs-2"></i>Créer un utilisateur</button>
													<!--end::Add user-->
												</div>
												<!--end::Toolbar-->
												<!--begin::Group actions-->
												<div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
													<div class="fw-bold me-5">
													<span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
													<button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
												</div>
												<!--end::Group actions-->
												<!--begin::Modal - Adjust Balance-->
												<div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
													<!--begin::Modal dialog-->
													<div class="modal-dialog modal-dialog-centered mw-650px">
														<!--begin::Modal content-->
														<div class="modal-content">
															<!--begin::Modal header-->
															<div class="modal-header">
																<!--begin::Modal title-->
																<h2 class="fw-bold">Export Users</h2>
																<!--end::Modal title-->
																<!--begin::Close-->
																<div class="btn btn-icon btn-sm btn-active-icon-primary one"  data-kt-users-modal-action="close">
																	<i class="ki-duotone ki-cross fs-1">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</div>
																<!--end::Close-->
															</div>
															<!--end::Modal header-->
															<!--begin::Modal body-->
															<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
																<!--begin::Form-->
																<form id="kt_modal_export_users_form" class="form" action="#">
																	<!--begin::Input group-->
																	<div class="fv-row mb-10">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold form-label mb-2">Select Roles:</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<select name="role" data-control="select2" data-placeholder="Select a role" data-hide-search="true" class="form-select form-select-solid fw-bold">
																			<option></option>
																			<option value="Administrator">Administrator</option>
																			<option value="Analyst">Analyst</option>
																			<option value="Developer">Developer</option>
																			<option value="Support">Support</option>
																			<option value="Trial">Trial</option>
																		</select>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-10">
																		<!--begin::Label-->
																		<label class="required fs-6 fw-semibold form-label mb-2">Select Export Format:</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<select name="format" data-control="select2" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bold">
																			<option></option>
																			<option value="excel">Excel</option>
																			<option value="pdf">PDF</option>
																			<option value="cvs">CVS</option>
																			<option value="zip">ZIP</option>
																		</select>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Actions-->
																	<div class="text-center">
																		<button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
																		<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
																			<span class="indicator-label">Submit</span>
																			<span class="indicator-progress">Please wait...
																			<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
																		</button>
																	</div>
																	<!--end::Actions-->
																</form>
																<!--end::Form-->
															</div>
															<!--end::Modal body-->
														</div>
														<!--end::Modal content-->
													</div>
													<!--end::Modal dialog-->
												</div>
												<!--end::Modal - New Card-->
												<!--begin::Modal - Add task-->
												<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
													<!--begin::Modal dialog-->
													<div class="modal-dialog modal-dialog-centered mw-650px">
														<!--begin::Modal content-->
														<div class="modal-content">
															<!--begin::Modal header-->
															<div class="modal-header" id="kt_modal_add_user_header">
																<!--begin::Modal title-->
																<h2 class="fw-bold">créer un utilisateur</h2>
																<!--end::Modal title-->
																<!--begin::Close-->
																<button type="button" id="willclosethemoadal" class="btn-close" data-kt-users-modal-action="close" aria-label="Close"></button>

																<!--end::Close-->
															</div>
															<!--end::Modal header-->
															<!--begin::Modal body-->
															<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
																<!--begin::Form-->
		<!-- <form id="kt_modal_add_user_form" class="form" action="#"> -->
		<form id="kt_modal_add_user_form" class="form" action="{{ route('create_users_store') }}" method="POST" enctype="multipart/form-data">
		@csrf	
    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

        <!-- Profile Photo Input -->
        <div class="fv-row mb-7">
            <label class="d-block fw-semibold fs-6 mb-5">Photo de profil</label>
            <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url(images/placeholder.png);"></div>
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <i class="ki-duotone ki-pencil fs-7"></i>
                    <input type="file" name="image_de_profil" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                </label>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                    <i class="ki-duotone ki-cross fs-2"></i>
                </span>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                    <i class="ki-duotone ki-cross fs-2"></i>
                </span>
            </div>
            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
        </div>

        <!-- Name Input (updated) -->
        <div class="fv-row mb-7">
            <label class="required fw-semibold fs-6 mb-2">Nom</label>
            <input type="text" name="user_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nom"  />
        </div>

        <!-- Last Name Input (new) -->
        <div class="fv-row mb-7">
            <label class="required fw-semibold fs-6 mb-2">Prénom</label>
            <input type="text" name="user_last_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Prénom" />
        </div>

        <!-- Phone Input (new) -->
        <div class="fv-row mb-7">
            <label class="required fw-semibold fs-6 mb-2">Téléphone</label>
            <input type="tel" name="user_phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Téléphone" />
        </div>

        <!-- Address Input (new) -->
        <div class="fv-row mb-7">
            <label class="required fw-semibold fs-6 mb-2">Adresse</label>
            <input type="text" name="user_address" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Adresse" />
        </div>

        <!-- Password Input (new) -->
        <div class="fv-row mb-7">
            <label class="required fw-semibold fs-6 mb-2">Mot de passe </label>
            <input type="text" name="user_password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Choose a password" />
        </div>

        <!-- Email Input -->
        <div class="fv-row mb-7">
            <label class="required fw-semibold fs-6 mb-2">Email</label>
            <input type="email" name="user_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@caei.com" />
        </div>

        <!-- Role Selection -->
        <div class="mb-7">
            <label class="required fw-semibold fs-6 mb-5">Role</label>
            <div class="d-flex fv-row">
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input me-3" name="user_role" type="radio" value="agent" id="kt_modal_update_role_option_agent" checked='checked' />
                    <label class="form-check-label" for="kt_modal_update_role_option_agent">
                        <div class="fw-bold text-gray-800">Agent</div>
                    </label>
                </div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <div class="d-flex fv-row">
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input me-3" name="user_role" type="radio" value="admin" id="kt_modal_update_role_option_admin" />
                    <label class="form-check-label" for="kt_modal_update_role_option_admin">
                        <div class="fw-bold text-gray-800">Admin</div>
                    </label>
                </div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <div class="d-flex fv-row">
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input me-3" name="user_role" type="radio" value="superviseur" id="kt_modal_update_role_option_superviseur" />
                    <label class="form-check-label" for="kt_modal_update_role_option_superviseur">
                        <div class="fw-bold text-gray-800">Superviseur</div>
                    </label>
                </div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <div class="d-flex fv-row">
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input me-3" name="user_role" type="radio" value="partenaire" id="kt_modal_update_role_option_partenaire" />
                    <label class="form-check-label" for="kt_modal_update_role_option_partenaire">
                        <div class="fw-bold text-gray-800">Partenaire</div>
                    </label>
                </div>
            </div>
        </div>

    </div>

    <!-- Submit and Cancel Buttons -->
    <div class="text-center pt-15">
        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
            <span class="indicator-label">Submit</span>
            <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
</form>


																<!--end::Form-->

															</div>
															<!--end::Modal body-->
														</div>
														<!--end::Modal content-->
													</div>
													<!--end::Modal dialog-->
												</div>
												<!--end::Modal - Add task-->
											</div>
											<!--end::Card toolbar-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body py-4">
											<!--begin::Table-->
										<!--	<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
												<thead>
													<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
														<th class="w-10px pe-2">
															<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
																<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
															</div>
														</th>
														<th class="min-w-125px">User</th>
														<th class="min-w-125px">Role</th>
														<th class="text-end min-w-100px">Actions</th>
													</tr>
												</thead>
												<tbody class="text-gray-600 fw-semibold">

												</tbody>
											</table> -->


<!-- new table  -->
 <!--begin::Table-->
<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                </div>
            </th>
            <th class="min-w-125px">Utilisateur</th>
            <th class="min-w-125px">Role</th>
            <th class="text-end min-w-100px">Actions</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
        @foreach ($users as $user)
        <tr>
            <td>
                <div class="form-check form-check-sm form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" />
                </div>
            </td>
            <td class="d-flex align-items-center">
                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                    <a href="#">
                        <div class="symbol-label">
                            <img src="{{ asset('storage/' . $user['image_de_profil']) }}" alt="{{ $user['name'] }}" class="w-100" />
                        </div>
                    </a>
                </div>
                <div class="d-flex flex-column">
                    <a href="{{ route('user.edit-foryou', ['id' => $user->id]) }}" class="text-gray-800 text-hover-primary mb-1">{{ $user['name'] }}</a>
                    <span>{{ $user['email'] }}</span>
                </div>
            </td>
            <td>{{ $user['role'] }}</td>
            <td class="text-end">
                <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                <!-- Actions Menu -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end::Table-->

<!-- Pagination Links -->
 {{ $users->links() }} 


 <script>
    const element = document.getElementById('kt_modal_add_user');
    const form = element.querySelector('#kt_modal_add_user_form');
    const modal = new bootstrap.Modal(element);	

const buttontoclosethemodal = document.getElementById('willclosethemoadal');
buttontoclosethemodal.addEventListener('click',(e)=>{

e.preventDefault();
console.log("working");
//form.reset();
modal.hide();
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());

            document.body.classList.remove('modal-open');


});


 </script>











											<!--end::Table-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->
								</div>
								<!--end::Content container-->
							</div>
@endsection
