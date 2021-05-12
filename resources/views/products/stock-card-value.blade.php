@extends('layouts.report')

@section('content')
<div class="row">
    <div class="col-md-10 text-left">
        <h2><i class="fa fa-file-invoice-dollar"></i>&nbsp; Fiche de Stock de {{ $product->product_name }} (en valeur)</h2>
    </div>
    <div class="col-md-2 text-right align-self-center to-hide">
        <h6><a href="{{ route ('products.index') }}"><i class="fa fa-arrow-left"></i> Liste de Produits</a></h6>
    </div>
</div>

<table class="table table-bordered mt-3" id="manage_stock">
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Libellé</th>
            <th scope="col">Entrée</th>
            <th scope="col">Sortie</th>
            <th scope="col">Solde</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $a = [];
        $b = [];
        $sumA = 0;
        $sumB = 0;
        ?>

        @foreach ($stock_cards as $stock_card)
            <tr>
                <td>{{ date_format(date_create($stock_card->created_at), "d/m/Y") }}</td>
                <td>{{ $stock_card->status == 'out' ? 'Sortie en Stock' : 'Entrée en Stock' }}</td>
                <td>
                    {{ $stock_card->status != 'out' ? $stock_card->product_price * $stock_card->product_quantity : '-' }}
                    <?php

                        if ($stock_card->status == 'in' || $stock_card->status == 'in_approv') {
                            array_push($a, $stock_card->product_price * $stock_card->product_quantity);
                            $sumA = array_sum ($a);
                        }else if ($stock_card->status == 'out') {
                            array_push($b, $stock_card->product_price * $stock_card->product_quantity);
                            $sumB = array_sum ($b);
                        }
                    ?>

                </td>
                <td>{{ $stock_card->status == 'out' ? $stock_card->product_price * $stock_card->product_quantity : '-' }}</td>
                <td>{{ $sumA - $sumB }}</td>
            </tr>
        @endforeach

    </tbody>
</table>

<div class="text-right">
    <button type="button" class="btn btn-primary mt-2 print"><i class="fa fa-print"></i>&nbsp; Imprimer</button>
</div>

@endsection
