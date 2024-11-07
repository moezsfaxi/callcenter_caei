@extends('superviseur.test')


@section('content')
  <!-- start the table -->
  <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-dark fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px text-start">date de creation</th>
                                    <th class="min-w-100px text-start">agent</th>                      
                                    <th class="min-w-100px text-start">Durée d'absence demandée</th>
                                    <th class="min-w-100px text-start">Raison</th>
                                    <th class="min-w-100px text-start">etat</th>
                                   


                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600 text-start">
                                @foreach($autorisations as $pass)
                                <tr class="">
                                    <td >{{ Carbon\Carbon::parse($pass->created_at)->format('d/m/Y')   }}</td>
                                    <td>
                                    <p>{{ $pass->agent->name ?? 'N/A' }}</p>
                                    <p>{{ $pass->agent->last_name ?? 'N/A' }}</p>        
                                </td>
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
                                    <td class="table-cell-limited" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $pass->comment }}">
                                      {{ $pass->comment }}
                                    </td>
                                    <td>
    @if ($pass->etat === 'en attente')
        <!-- Form to Accept -->
        <form action="{{ route('autorisations.updateEtat', $pass->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <input type="hidden" name="etat" value="accepté">
            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to accept this request?')">
                Accepté
            </button>
        </form>

        <!-- Form to Refuse -->
        <form action="{{ route('autorisations.updateEtat', $pass->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <input type="hidden" name="etat" value="refusé">
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to refuse this request?')">
                Refusé
            </button>
        </form>
    @else
        {{ $pass->etat }}
    @endif
</td></td>



                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!--end::Table-->
                        {{ $autorisations->links() }} <!-- Affiche les liens de pagination -->

                    </div>

   <!-- end the table -->



@endsection





<style>


.table-cell-limited {
    max-width: 150px; /* Adjust width as needed */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<script>

document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

</script>