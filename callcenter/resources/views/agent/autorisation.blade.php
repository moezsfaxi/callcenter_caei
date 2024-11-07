
@extends('agent.test')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h4>Demande d'Autorisation d'Absence</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('autorisation.store') }}" method="POST">
                @csrf
                
               
                <div class="mb-3">
                    <label class="form-label">Type de demande</label>
                    <select name="request_type" id="request_type" class="form-control" required>
                        <option value="">Sélectionnez le type</option>
                        <option value="hours">Absence en heures</option>
                        <option value="days">Absence en jours</option>
                    </select>
                </div>

                {{-- Hours-based request fields --}}
                <div id="hours_section" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="single_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Durée</label>
                        <select name="hours" class="form-control">
                            <option value="1">1 heure</option>
                            <option value="2">2 heures</option>
                            <option value="3">3 heures</option>
                            <option value="4">Demi-journée matin</option>
                            <option value="5">Demi-journée après-midi</option>
                        </select>
                    </div>
                </div>

                {{-- Days-based request fields --}}
                <div id="days_section" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Date de début</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date de fin</label>
                        <input type="date" name="end_date" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                     <label class="form-label">Raison : </label>
                     <textarea name="comment" class="form-control" rows="3" placeholder="Ajoutez un commentaire..."></textarea>
                </div>


                <button type="submit" class="btn btn-primary">Soumettre la demande</button>
            </form>
        </div>
    </div>
</div>
 <hr>
 <hr>
  <!-- start the table -->
  <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-dark fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-start">date de creation</th>
                                    <th class="min-w-100px text-start">Durée d'absence demandée</th>
                                    <th class="min-w-100px text-start">etat</th>
                                   


                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600 text-start">
                                @foreach($autorisations as $pass)
                                <tr class="">
                                    <td >{{ Carbon\Carbon::parse($pass->created_at)->format('d/m/Y')   }}</td>
                                    <td>
                                    @if ($pass->hours === null)
                                        Du {{ Carbon\Carbon::parse($pass->start_date)->format('d/m/Y') }} au {{ Carbon\Carbon::parse($pass->end_date)->format('d/m/Y')  }}
                                    @elseif ($pass->hours === 1)
                                        {{ $pass->hours }} heure à {{  Carbon\Carbon::parse($pass->end_date)->format('d/m/Y')  }} 
                                    @elseif ($pass->hours === 2)
                                        {{ $pass->hours }} heures à {{ Carbon\Carbon::parse($pass->end_date)->format('d/m/Y')  }}    
                                    @elseif ($pass->hours === 3)
                                        {{ $pass->hours }} heures à {{ Carbon\Carbon::parse($pass->end_date)->format('d/m/Y')  }}
                                    @elseif ($pass->hours === 4)
                                        Demi-journée matin à {{ Carbon\Carbon::parse($pass->end_date)->format('d/m/Y')  }}
                                    @elseif ($pass->hours === 5)
                                        Demi-journée après-midi à {{ Carbon\Carbon::parse($pass->end_date)->format('d/m/Y')  }}
                                    @endif   


                                    </td>
                                    <td>{{ $pass->etat }}</td>



                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!--end::Table-->
                        {{ $autorisations->links() }} <!-- Affiche les liens de pagination -->

                    </div>

   <!-- end the table -->




@endsection

@push('scripts')
<script>
document.getElementById('request_type').addEventListener('change', function() {
    const hoursSection = document.getElementById('hours_section');
    const daysSection = document.getElementById('days_section');
    
    if (this.value === 'hours') {
        hoursSection.style.display = 'block';
        daysSection.style.display = 'none';
    } else if (this.value === 'days') {
        hoursSection.style.display = 'none';
        daysSection.style.display = 'block';
    } else {
        hoursSection.style.display = 'none';
        daysSection.style.display = 'none';
    }
});
</script>
@endpush