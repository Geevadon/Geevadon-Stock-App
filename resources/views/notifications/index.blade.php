@extends('layouts.default')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Gestion de Notifications</h1>
        <a href="{{ route ('products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Liste de Produits</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-list"></i> Notifications</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Notification</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $n = 0 ?>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ ++$n }}</td>
                                <td>{{ $notification->content }}</td>
                                <td>{{ date_format (date_create ($notification->created_at), 'd/m/Y à H:i') }}</td>
                                <td>
                                    <div class="dropup">
                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                        </button>
                                        <div class="dropdown-menu border border-dark" aria-labelledby="dropdownMenuButton">

                                            <form action="{{ route ('notifications.destroy', $notification->id)}}" method="POST" id="delete-form-{{ $notification->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item delete" did="{{ $notification->id }}">
                                                    <i class="fa fa-trash"></i> Supprimer
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
