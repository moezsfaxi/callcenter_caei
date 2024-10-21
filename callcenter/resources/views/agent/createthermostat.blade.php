@extends('agent.test')

@section('content')

<div class="container">
    <h1 class="mb-4">Créer un nouveau rendez-vous Thermostat</h1>
    <form action="{{ route('rdv-thermostat.store') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0 text-center">Informations du prospect</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nom_du_prospect" class="form-label">Nom du prospect</label>
                        <input type="text" class="form-control text-center" id="nom_du_prospect" name="nom_du_prospect" required>
                    </div>
                    <div class="col-md-6">
                        <label for="prenom_du_prospect" class="form-label">Prénom du prospect</label>
                        <input type="text" class="form-control text-center" id="prenom_du_prospect" name="prenom_du_prospect" required>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control text-center" id="telephone" name="telephone"
                               pattern="[0-9]{10}" maxlength="10"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                               required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0 text-center">Adresse</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control text-center" id="adresse" name="adresse" required>
                    </div>
                    <div class="col-md-4">
                        <label for="code_postal" class="form-label">Code Postal</label>
                        <input type="text" class="form-control text-center" id="code_postal" name="code_postal" required>
                    </div>
                    <div class="col-md-8">
                        <label for="ville" class="form-label">Ville</label>
                        <input type="text" class="form-control text-center" id="ville" name="ville" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0 text-center">Détails du rendez-vous</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="date_du_rdv" class="form-label">Date du RDV</label>
                        <input type="datetime-local" class="form-control text-center" id="date_du_rdv" name="date_du_rdv" required>
                    </div>
                    <div class="col-md-6">
                        <label for="statut_de_residence" class="form-label">Statut de résidence</label>
                        <select class="form-select text-center" id="statut_de_residence" name="statut_de_residence" required>
                            <option value="">Choisir...</option>
                            <option value="Propriétaire">Propriétaire</option>
                            <option value="Locataire">Locataire</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="Commentaire_agent" class="form-label">Commentaire agent</label>
                        <textarea class="form-control text-center" id="Commentaire_agent" name="Commentaire_agent" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Créer le rendez-vous</button>
        </div>
    </form>
</div>

@endsection

@push('styles')
<style>
    .form-label {
        font-weight: bold;
    }
    .form-control, .form-select {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #fff;
    }
    .form-control:focus, .form-select:focus {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
    }
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
    }
    h1, h4 {
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    ::placeholder {
        text-align: center;
        color: rgba(255, 255, 255, 0.7);
    }
    select option {
        text-align: center;
        background-color: #667eea;
    }
</style>
@endpush
