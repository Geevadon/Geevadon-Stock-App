<!-- Delete User Modal-->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment supprimer ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Cet utilisateur sera définitivement supprimé. Vous devez être sûr de votre décision car cette action est irréversible !</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
          <button class="btn btn-danger" id="ok_button_user_delete"><i class="fa fa-trash"></i> Supprimer</button>
        </div>
      </div>
    </div>
  </div>

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment supprimer ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Tous les données seront supprimées. Vous devez être sûr de votre décision car cette action est irréversible !</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
          <button class="btn btn-danger" id="ok_button_delete"><i class="fa fa-trash"></i> Supprimer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Pay Modal-->
  <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment définir comme "payée" ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Cette commande sera définie comme payée.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
          <button class="btn btn-success" id="ok_button_pay"><i class="fa fa-check"></i> Définir</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Trash Modal-->
  <div class="modal fade" id="trashModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment mettre en corbeille ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Cette commande va être mise en corbeille. Elle sera désormais trouvable dans l'historique de commandes.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
          <button class="btn btn-danger" id="ok_button_trash"><i class="fa fa-trash"></i> Mettre en corbeille</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Clear Checkout Modal-->
  <div class="modal fade" id="clearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment vider ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Toutes les données seront définitivement supprimées. Vous devez être sûr de votre décision car cette action est irréversible.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
          <button class="btn btn-danger" id="ok_button_clear"><i class="fa fa-trash"></i> Vider</button>
        </div>
      </div>
    </div>
  </div>
