@extends('layouts.default')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Gestion de Commandes</h1>
        <a href="{{ route ('orders.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Nouvelle Commande</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-list"></i> Liste de Commandes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Numéro</th>
                            <th>Nom du Client</th>
                            <th>Montant dû</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $n = 0 ?>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ ++$n }}</td>
                                <td>{{ date_format (date_create ($order->added_date), 'd/m/Y') }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ number_format ($order->due, 2, ',', '.'). ' $' }}</td>
                                <td>{!! $order->status == 'not_paid' ? "<span class='text-danger font-weight-bold'>Non payé</span>" : "<span class='text-success font-weight-bold'>Payé</span>" !!}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                        </button>
                                        <div class="dropdown-menu border border-dark" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route ('orders.show', $order->id)}}"><i class="fa fa-info"></i>&nbsp; Détails</a>

                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item" href="{{ route ('orders.payment.update', $order->id)}}"><i class="fa fa-dollar-sign"></i>&nbsp; Paiement</a>

                                            {{-- <form action="{{ route ('orders.pay', $order->id)}}" method="POST" id="pay-form-{{ $order->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item pay" pid="{{ $order->id }}">
                                                    <i class="fa fa-dollar"></i>&nbsp; Definir comme Paye
                                                </button>
                                            </form> --}}

                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item" href="{{ route ('invoice.report', $order->id)}}"><i class="fa fa-file-invoice-dollar"></i>&nbsp; Facture</a>

                                            <div class="dropdown-divider"></div>

                                            <form action="{{ route ('orders.trash', $order->id)}}" method="POST" id="trash-form-{{ $order->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item trash" tid="{{ $order->id }}">
                                                    <i class="fa fa-trash"></i>&nbsp; Mettre en Corbeille
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
