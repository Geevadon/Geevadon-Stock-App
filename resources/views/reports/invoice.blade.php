@extends('layouts.report')

@section('content')
<div class="row">
    <div class="col-md-6 text-left to-hide">
        <h2><i class="fa fa-file-invoice-dollar"></i>&nbsp; Facture #{{ $order->order_number }}</h2>
    </div>
    <div class="col-md-6 text-right align-self-center to-hide">
        <h6><a href="{{ route ('orders.index') }}"><i class="fa fa-arrow-left"></i> Gestion de Commandes</a></h6>
    </div>
</div>

<div class="row mb-2 mt-4">
    <div class="col-md-2 mr-3">
        <img src="{{ asset ('images/logo.png') }}" alt="Logo" class="img-thumbnail" style="max-width: 100%; height:auto">
        <div class="font-italic lead">Technology for life</div>

    </div>

    <div class="col-md-4 py-2 mr-4">
        <h6 class="font-italic font-weight-normal">Nos factures sont payables au grand comptant à l'enlèvement du matériel.<br>
            Délai exceptionnel de 7 jours pour les ONG et nos abonnés.<br>
            Pénalité de retard : 3% par semaine.<br>
            Aucune garantie accordée sur le matériel à alimentation électrique.</h6>
    </div>

    <div class="col-md-5">
        <div class="client-name bg-light p-1 mb-2">
            <h4>Client : {{ $order->customer_name }}</h4>
        </div>
        <div class="border border-dark rounded p-1">
            ProduitNom<br><br>
            {{ $order->designation }}
        </div>
        <div class="row mt-1">
            <div class="col-md-2">
                <img src="{{ asset ('images/drc-flag.png') }}" alt="Logo" class="img-thumbnail" style="max-width: 60px; height:auto">
            </div>
            <div class="col-md-10">
                <div>REPUBLIQUE DEMOCRATIQUE DU CONGO</div>
                <small>Goma : 26, Av. Les bougainvilliers, Q. Les Volcans</small>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <small>Direction : +243 970 766 755, +243 823 403 336</small><br>
        <small>Garage : +243 821 688 586</small><br>
        <small>Email : <u>techlifeinfo1@gmail.com</u></small><br>
        <small>RCCM : GOMA/RCCM/14-00575</small><br>
        <small>Id Nat : 5-93-N89963F</small><br>
        <small>N° impôt : A1511529Z</small>
    </div>
    <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-4">
        <small>Compte bancaire (TMB) : <b>1272-7200254-01-13</b></small><br>
        <small>Intitulé : <b>ETS TECHLI</b></small><br>
        <small>Code Swift : <b>TRMSCD3L</b></small>
    </div>
    <div class="col-md-4">
        <h1 class="font-weight-bold text-center print-title">FACTURE</h1>
    </div>
    <div class="col-md-4 text-right">
        <br><br>
        <small>VENDOR NUMBER : <b>50066457</b></small>
    </div>
</div>

<div class="row bg-light mt-3 border border-dark">
    <div class="col-md-3">
        <div>{{ $order->order_number }}</div>
        <small><i>Numéro</i></small>
    </div>
    <div class="col-md-3">
        <div>{{ date_format (date_create ($order->added_date), 'd/m/Y') }}</div>
        <small><i>Date</i></small>
    </div>
    <div class="col-md-2">
        <div>{{ $order->currency }}</div>
        <small><i>Devise</i></small>
    </div>
    <div class="col-md-2">
        <div>{{ $order->customer_name }}</div>
        <small><i>Client</i></small>
    </div>
    <div class="col-md-2">
        <div>Garage</div>
        <small><i>Service</i></small>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-2">
        <h6><b>ARTICLE</b></h6>
        @foreach ($order->order_details as $detail)
            <div>{{ $detail->product_name }}</div>
        @endforeach
    </div>
    <div class="col-md-2 bg-light">
        <h6><b>DÉSIGNATION</b></h6>
        <div>{{ $order->designation }}</div>
    </div>
    <div class="col-md-2">
        <h6><b>QUANTITE</b></h6>
        @foreach ($order->order_details as $detail)
            <div>{{ $detail->product_quantity }}</div>
        @endforeach
    </div>
    <div class="col-md-2 bg-light">
        <h6><b>PRIX</b></h6>
        @foreach ($order->order_details as $detail)
            <div>{{ number_format ($detail->product_price, 2, ',', '.'). ' $'}}</div>
        @endforeach
    </div>
    <div class="col-md-2">
        <h6><b>REMISE</b></h6>
        <div>{{ number_format ($order->discount, 2, ',', '.'). ' $'}}</div>
    </div>
    <div class="col-md-2 bg-light">
        <h6><b>MONTANT</b></h6>
        <span><b>{{ number_format ($order->due, 2, ',', '.'). ' $'}}</b></span>
    </div>
</div>
<div class="row mt-1">
    <span>&nbsp;&nbsp; Certificat sincère et véritable à la somme de : {{ $order->due <= 1 ? $order->amount_in_letters. ' dollar américain' : $order->amount_in_letters. ' ' .Str::plural('dollar'). ' '.Str::plural('américain')  }}</span>
</div>
<hr class="row bg-dark">
<div class="row mt-3 my-1">
    <div class="col-md-4">
        <small>Diesel injection pumps reconditioning</small><br>
        <small>Engine rebuilding</small><br>
        <small>Power generators</small><br>
    </div>
    <div class="col-md-4">
        <img src="{{ asset ('images/clock.jpg') }}" alt="Logo" class="img-thumbnail" style="max-width: 100px; height:auto">
        <img src="{{ asset ('images/clock.jpg') }}" alt="Logo" class="img-thumbnail" style="max-width: 100px; height:auto">
    </div>
    <div class="col-md-4">
        <div class="border border-dark p-2">
            <small>TOTAL FACTURE ({{ $order->currency }}) : {{ number_format ($order->net_total, 2, ',', '.'). ' $'}}</small><br>
            <!-- <small>Remise ( //$data ['devise'] ) : //$data ['discount'] , 00</small><br> -->
            <small>Main d'oeuvre ({{ $order->currency }}) : {{ number_format ($order->workforce, 2, ',', '.'). ' $'}}</small><br>
            <small>TOTAL A PAYER ({{ $order->currency }}) : {{ number_format ($order->due, 2, ',', '.'). ' $'}}</small>
        </div>
    </div>
</div>
<div class="text-right mt-4">
    <button type="button" class="btn btn-primary mt-2 print"><i class="fa fa-print"></i>&nbsp; Imprimer la Facture</button>
</div>
</div>

@endsection
