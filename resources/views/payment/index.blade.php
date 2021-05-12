@extends('layouts.default')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Paiement de la Commande</h1>
        <a href="{{ route ('orders.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Liste de Commandes</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-edit"></i> Paiement de #{{ $order->order_number }}</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route ('orders.payment.update', $order->id) }}" novalidate>
                <div class="form-row">
                    <div class="col-md-10 mx-auto">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="text" class="form-control" id="order_customer_name" name="order_customer_name" value="{{ 'Client : '. $order->customer_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="order_due" name="order_due" value="{{ 'Dette : '. number_format ($order->due, 2, ',', '.'). ' $' }}" readonly>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control @error('order_payment_amount') is-invalid @enderror" id="order_payment_amount" name="order_payment_amount" placeholder="Tapez le montant payé..." value="{{ old ('order_payment_amount') }}" required>

                            @error('order_payment_amount')
                                <div class="invalid-feedback text-danger" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-check"></i> Valider
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
