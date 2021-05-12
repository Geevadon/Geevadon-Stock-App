@extends('layouts.default')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-question-circle"></i>&nbsp; Aide</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="card-title"><b>Lisez-Moi !</b></h4><br>
            <h5>Concernant l'Approvisionnement du Stock :</h5>
            <p class="card-text">
                Lorsque le stock d'un produit est faible, il va falloir approvisionner ce stock (augmenter la quantité du stock du produit concerné). Dans cette application, s'il arrive que le prix d'achat des nouveaux produits à approvisionner soit différent de celui des produits restant dans le stock faible, <b>il vaut mieux attendre « l'épuisement total du stock » avant de l'approvisionner.</b>
            </p>

            <h5>Concernant l'Historique :</h5>
            <p class="card-text">
                Lorsque vous supprimez (mettrez en corbeille) une commande depuis la page de gestion des commandes, cette dernière va directement dans l'Historique de Commandes. De même, lorsque vous effectuez un approvisionnement de stock, les détails de ce dernier vont directement dans l'Historique des approviosionnements.<br>
                Notez que <b>pour supprimer un élement dans l'Historique, il faut que cet élement ait déjà totalisé au moins 1 mois dans l'Historique.</b> Cette restriction a été mise en place pour ne pas fausser les fiches de stock (en valeur et en quantité).
            </p>

        </div>
    </div>
@endsection
