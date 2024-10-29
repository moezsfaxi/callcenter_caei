@extends('partenaire.test')

@section('content')
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-5">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column gap-1 me-3 mb-2">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">Rendez-vous PV Non qualifié</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->

                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" id="filteringbyname" class="form-control form-control-solid w-250px ps-12" placeholder="Rechercher un rendez-vous" />
                                <span class="text-start text-black-400 fw-bold fs-7 text-uppercase gs-0 ms-3 me-3 text-dark">filtrer par jour:</span>
                                <input type="date" id="filteringbydate" lang="fr" class="form-control form-control-solid w-250px ps-12" placeholder="Filter by Date" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">

                                    <th class="min-w-100px">Nom</th>
                                    <th class="min-w-100px">Prénom</th>
                                    <th class="min-w-100px">Téléphone</th>
                                    <th class="min-w-150px">Adresse</th>
                                    <th class="min-w-70px">Code Postal</th>
                                    <!-- <th class="min-w-100px">Ville</th> -->
                                    <th class="min-w-100px">Date du RDV</th>
                                    <!-- <th class="min-w-100px">Statut de résidence</th> -->
                                    <!-- <th class="min-w-100px">Commentaire agent</th> -->
                                    <th class="min-w-100px">Qualification</th>
                                    <th class="min-w-100px" >voir plus</th>

                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach($rdvRecords as $rdv)
                                <tr>

                                    <td>{{ $rdv->nom_du_prospect }}</td>
                                    <td>{{ $rdv->prenom_du_prospect }}</td>
                                    <td>{{ $rdv->telephone }}</td>
                                    <td>{{ $rdv->adresse }}</td>
                                    <td>{{ $rdv->code_postal }}</td>
                                    <!-- <td>{{ $rdv->ville }}</td> -->
                                    <td>{{ $rdv->date_du_rdv }}</td>
                                    <!-- <td>{{ $rdv->statut_de_residence }}</td> -->
                                    <!-- <td>{{ $rdv->Commentaire_agent }}</td> -->
                                    <td>
                                        @if($rdv->qualification)
                                            {{ $rdv->qualification }}
                                        @else
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#qualifyModal{{ $rdv->id }}">
                                                Qualifier
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="qualifyModal{{ $rdv->id }}" tabindex="-1" aria-labelledby="qualifyModalLabel{{ $rdv->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="qualifyModalLabel{{ $rdv->id }}">Qualifier le rendez-vous</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form id="qualifyForm{{ $rdv->id }}" action="{{ route('rdv-panneaux-photovoltaique.update', $rdv->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="classification" class="form-label">Classification</label>
                                                                    <select class="form-select" id="classification" name="classification" required>
                                                                        <option value="NRP">NRP</option>
                                                                        <option value="Hors cible">Hors cible</option>
                                                                        <option value="RDV confirmé">RDV confirmé</option>
                                                                        <option value="RDV installé">RDV installé</option>
                                                                        <option value="Pas intéressé">Pas intéressé</option>
                                                                        <option value="RDV annulé">RDV annulé</option>
                                                                        <option value="RDV à rappeler">RDV à rappeler</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="Commentaire_partenaire" class="form-label">Commentaire partenaire</label>
                                                                    <textarea class="form-control" id="Commentaire_partenaire" name="Commentaire_partenaire" rows="3" required></textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="date_rappelle" class="form-label">Date de rappel</label>
                                                                    <input type="datetime-local" class="form-control" id="date_rappelle" name="date_rappelle">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td><a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_view_details_{{ $rdv->id }}"> Voir détails</a> </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                        {{ $rdvRecords->links() }}

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Products-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</div>
<!--end::Main-->

<!-- Modal pour afficher les détails (y compris le commentaire) -->
<!-- <div class="modal fade" id="kt_modal_view_details" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Détails du rendez-vous</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
           
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                </div>
            </div>
        </div>
    </div>
</div> -->

@foreach($rdvRecords as $rdv)
<!-- Modal pour afficher les détails -->
<div class="modal fade" id="kt_modal_view_details_{{ $rdv->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Détails du rendez-vous</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_details_scroll_{{ $rdv->id }}" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_details_header_{{ $rdv->id }}" data-kt-scroll-wrappers="#kt_modal_details_scroll_{{ $rdv->id }}" data-kt-scroll-offset="300px">


                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2">Ville:</label>
                        <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $rdv->ville }}" readonly />
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2">Statut de résidence:</label>
                        <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $rdv->statut_de_residence }}" readonly />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2">Commentaire agent:</label>
                        <textarea class="form-control form-control-solid mb-3 mb-lg-0" rows="3" readonly>{{ $rdv->Commentaire_agent }}</textarea>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour modifier le RDV -->
<div class="modal fade" id="kt_modal_edit_rdv_{{ $rdv->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Modifier le rendez-vous</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <form id="editForm{{ $rdv->id }}" action="{{ route('rdv-pv.updatequalification', $rdv->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_rdv_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_rdv_header" data-kt-scroll-wrappers="#kt_modal_edit_rdv_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Classification</label>
                            <select class="form-select form-select-solid" name="classification" required>
                                <option value="">Sélectionner une classification</option>
                                <option value="NRP" {{ $rdv->classification == 'NRP' ? 'selected' : '' }}>NRP</option>
                                <option value="Hors cible" {{ $rdv->classification == 'Hors cible' ? 'selected' : '' }}>Hors cible</option>
                                <option value="RDV confirmé" {{ $rdv->classification == 'RDV confirmé' ? 'selected' : '' }}>RDV confirmé</option>
                                <option value="RDV installé" {{ $rdv->classification == 'RDV installé' ? 'selected' : '' }}>RDV installé</option>
                                <option value="Pas intéressé" {{ $rdv->classification == 'Pas intéressé' ? 'selected' : '' }}>Pas intéressé</option>
                                <option value="RDV annulé" {{ $rdv->classification == 'RDV annulé' ? 'selected' : '' }}>RDV annulé</option>
                                <option value="RDV à rappeler" {{ $rdv->classification == 'RDV à rappeler' ? 'selected' : '' }}>RDV à rappeler</option>
                            </select>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Commentaire partenaire</label>
                            <textarea class="form-control form-control-solid mb-3 mb-lg-0" name="Commentaire_partenaire" rows="4">{{ $rdv->Commentaire_partenaire }}</textarea>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Date de rappel</label>
                            <input type="datetime-local" class="form-control form-control-solid mb-3 mb-lg-0" name="date_rappelle" value="{{ $rdv->date_rappelle ? date('Y-m-d\TH:i', strtotime($rdv->date_rappelle)) : '' }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endforeach





@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- <script>
    // Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Get the search input element
    const searchInput = document.getElementById('filteringbyname');
    
    // Add input event listener for real-time filtering
    searchInput.addEventListener('input', function(e) {
        // Get the search query and convert to lowercase for case-insensitive search
        const searchQuery = e.target.value.toLowerCase();
        
        // Get all table rows except the header
        const tableRows = document.querySelectorAll('tbody tr');
        
        // Loop through each row
        tableRows.forEach(row => {
            // Get the prospect name cell (first column)
            const prospectName = row.querySelector('td:first-child').textContent.toLowerCase();
            
            // Show/hide row based on whether the name contains the search query
            if (prospectName.includes(searchQuery)) {
                row.style.display = '';  // Show the row
            } else {
                row.style.display = 'none';  // Hide the row
            }
        });
    });
});
</script> -->

<!-- second script  -->


<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('filteringbyname');
    const dateInput = document.getElementById('filteringbydate');

    
    function filterTable() {
        const nameQuery = searchInput.value.toLowerCase();
        const dateQuery = dateInput.value;

        const tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const prospectName = row.querySelector('td:first-child').textContent.toLowerCase();
            const rdvDate = row.querySelector('td:nth-child(6)').textContent.trim();

            const matchesName = prospectName.includes(nameQuery);
            const matchesDate = !dateQuery || rdvDate === dateQuery;

            if (matchesName && matchesDate) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    
    searchInput.addEventListener('input', filterTable);
    dateInput.addEventListener('input', filterTable);
});
</script>




@endsection
