
@extends('agent.test')

@section('content')

<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h4> Demande d'avance </h4>
        </div>


        <div class="card-body">
        <form action="{{ route('avance.store')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">montant demandée</label>
              <input type="number" class="form-control" name="amount">  

            </div>
            <div class="mb-3">
             <label class="form-label">Raison :</label>     
              <textarea name="comment" class="form-control"  placeholder="Ajoutez un commentaire..."></textarea> 
            </div>
            <button class="btn btn-primary" >Soumettre la demande</button>
        </form>
        </div>
    </div>
</div>    
<div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-dark fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-start">Date de creation</th>
                                    <th class="min-w-100px text-start">Montant </th>
                                    <th class="min-w-100px text-start">Etat</th>
                                   


                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600 text-start">
                                @foreach($avances as $pass)
                                <tr class="">
                                    <td >{{ Carbon\Carbon::parse($pass->created_at)->format('d/m/Y')   }}</td>
                                    <td>   {{$pass->amount }} </td>
                                    <td>{{ $pass->etat }}</td>



                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!--end::Table-->
                        {{ $avances->links() }} <!-- Affiche les liens de pagination -->

                    </div>










@endsection