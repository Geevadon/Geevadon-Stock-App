@extends('layouts.report')

@section('content')
<div class="row">
    <div class="col-md-10 text-left to-hide">
        <h2><i class="fa fa-file-invoice-dollar"></i>&nbsp; Fiche de Stock de {{ $product->product_name }} (en quantité)</h2>
    </div>
    <div class="col-md-2 text-right align-self-center to-hide">
        <h6><a href="{{ route ('products.index') }}"><i class="fa fa-arrow-left"></i> Liste de Produits</a></h6>
    </div>
</div>

<div class="row mt-3 border border-dark">
    <div class="col-md-1 border-right border-dark text-center">
        <b>Date</b>
    </div>
    <div class="col-md-1 border-right border-dark text-center">
        <b>Libellé</b>
    </div>
    <div class="col-md-1 text-center">
        <b>N°</b>
    </div>
    <div class="col-md-3">
        <div class="row border-bottom border-left border-right border-dark">
            <b class="mx-auto">ENTRÉE</b>
        </div>
        <div class="row border-right border-left border-dark">
            <div class="col-md-4 border-right border-dark"><b>Q</b></div>
            <div class="col-md-4 border-right border-dark"><b>PU</b></div>
            <div class="col-md-4"><b>PT</b></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row border-bottom border-right border-dark">
            <b class="mx-auto">SORTIE</b>
        </div>
        <div class="row border-right border-dark">
            <div class="col-md-4 border-right border-dark"><b>Q</b></div>
            <div class="col-md-4 border-right border-dark"><b>PU</b></div>
            <div class="col-md-4"><b>PT</b></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row border-bottom border-dark">
            <b class="mx-auto">SOLDE</b>
        </div>
        <div class="row">
            <div class="col-md-4 border-right border-dark"><b>Q</b></div>
            <div class="col-md-4 border-right border-dark"><b>PU</b></div>
            <div class="col-md-4"><b>PT</b></div>
        </div>
    </div>
</div>

<?php

$n = 0;

$quantities_in = [];
//$prices_in = [];
$totals_in = [];

$quantities_sum_in = 0;
//$prices_sum_in = 0;
$totals_sum_in = 0;

$quantities_out = [];
//$prices_out = [];
$totals_out = [];

$quantities_sum_out = 0;
//$prices_sum_out = 0;
$totals_sum_out = 0;

?>

@foreach ($stock_cards as $stock_card)
    <div class="row border-left border-bottom border-right border-dark">
        <div class="col-md-1 border-right border-dark p-2">
            <small><b>{{ date_format(date_create($stock_card->created_at), "d/m/Y") }}</b></small>
        </div>
        <div class="col-md-1 border-right border-dark py-2">
            {{ $stock_card->status == 'out' ? 'Sortie' : 'Entrée' }}
        </div>
        <div class="col-md-1 py-2">
            <?= ++$n ?>
        </div>
        <div class="col-md-3 border-left border-right border-dark">
            <div class="row">
                <div class="col-md-4 border-right border-dark py-2">{{  $stock_card->status != 'out' ? $stock_card->product_quantity : '-' }}</div>
                <div class="col-md-4 border-right border-dark py-2">{{ $stock_card->status != 'out' ?$stock_card->product_price : '-' }}</div>
                <div class="col-md-4 py-2">
                    {{ $stock_card->status != 'out' ? $stock_card->product_quantity * $stock_card->product_price : '-'}}
                    <?php
                        if ($stock_card->status != 'out') {

                            array_push ($quantities_in, $stock_card->product_quantity);
                            //array_push ($prices_in, $stock_card->product_price);
                            array_push ($totals_in, $stock_card->product_price * $stock_card->product_quantity);
                            $quantities_sum_in = array_sum ($quantities_in);
                            //$prices_sum_in = array_sum ($prices_in);
                            $totals_sum_in = array_sum ($totals_in);

                        }else if ($stock_card->status == 'out') {

                            array_push ($quantities_out, $stock_card->product_quantity);
                            //array_push ($prices_out, $stock_card->product_price);
                            array_push ($totals_out, $stock_card->product_price * $stock_card->product_quantity);
                            $quantities_sum_out = array_sum ($quantities_out);
                            //$prices_sum_out = array_sum ($prices_out);
                            $totals_sum_out = array_sum ($totals_out);

                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 border-right border-dark">
            <div class="row">
                <div class="col-md-4 border-right border-dark py-2">{{  $stock_card->status == 'out' ? $stock_card->product_quantity : '-' }}</div>
                <div class="col-md-4 border-right border-dark py-2">{{  $stock_card->status == 'out' ? $stock_card->product_price : '-' }}</div>
                <div class="col-md-4 py-2"> {{ $stock_card->status == 'out' ? $stock_card->product_quantity * $stock_card->product_price : '-' }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-4 border-right border-dark py-2">{{ $quantities_sum_in - $quantities_sum_out }}</div>
                <div class="col-md-4 border-right border-dark py-2">{{ $stock_card->product_price }}</div>
                <div class="col-md-4 py-2">{{ $totals_sum_in - $totals_sum_out }}</div>
            </div>
        </div>
    </div>
@endforeach

<div class="row">
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-primary mt-2 print"><i class="fa fa-print"></i>&nbsp; Imprimer</button>
    </div>
</div>

@endsection
