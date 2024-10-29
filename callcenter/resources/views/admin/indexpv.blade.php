@extends('admin.test')

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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">Rendez-vous Pompe a chaleur</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                        
                    <!--end::Actions-->
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
                                    <th class="min-w-100px text-start">Nom</th>
                                    <th class="min-w-100px text-start">Prénom</th>
                                    <th class="min-w-100px text-start">Téléphone</th>
                                    <th class="min-w-150px text-start">Adresse</th>
                                    <th class="min-w-70px text-start">Code Postal</th>
                                    <th class="min-w-100px text-start">Ville</th>
                                    <th class="min-w-100px text-start">Date du RDV</th>
                                    <th class="min-w-100px text-start">Statut de résidence</th>
                                    <th class="min-w-100px text-start">Commentaire agent</th>
                                    <th class="min-w-100px text-start">Commentaire partenaire</th>
                                    <th class="min-w-100px">Qualification</th>

                                </tr>

                            </thead>
                            <tbody class="fw-semibold text-gray-600 text-start">
                                @foreach($rdvRecords as $rdv)
                                <tr class="
                                    @switch($rdv->classification)
                                        @case('NRP') table-warning @break
                                        @case('Hors cible') table-info @break
                                        @case('RDV confirmé') table-primary @break
                                        @case('RDV installé') table-success @break
                                        @case('Pas intéressé') table-secondary @break
                                        @case('RDV annulé') table-danger @break
                                        @case('RDV à rappeler') table-warning @break
                                    @endswitch
                                ">
                                    <td>{{ $rdv->nom_du_prospect }}</td>
                                    <td>{{ $rdv->prenom_du_prospect }}</td>
                                    <td>{{ $rdv->telephone }}</td>
                                    <td>{{ $rdv->adresse }}</td>
                                    <td>{{ $rdv->code_postal }}</td>
                                    <td>{{ $rdv->ville }}</td>
                                    <td>{{ $rdv->date_du_rdv }}</td>
                                    <td>{{ $rdv->statut_de_residence }}</td>
                                    <td>{{ $rdv->Commentaire_agent }}</td>
                                    <td>{{ $rdv->Commentaire_partenaire }}</td>
                                    <td>{{ $rdv->classification }}</td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!--end::Table-->
                        {{ $rdvRecords->links() }} <!-- Affiche les liens de pagination -->
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




@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<script>
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
</script>

@endsection
