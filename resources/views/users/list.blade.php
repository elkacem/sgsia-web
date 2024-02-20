@extends('layouts.auth')
@section('content')
{{--{{ $numberSondage }}--}}
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Editable Table</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                    <li class="breadcrumb-item active">Editable Table</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title" style="text-align: right"><a href="{{ route('add')  }}" class="btn btn-primary" > Ajouter Admin </a></h4>

                                <div class="table-responsive">
                                    <table class="table table-editable table-nowrap align-middle table-edits">
                                        <thead>
                                        <tr>
{{--                                            <th>ID</th>--}}
                                            <th>Nom et Prenom</th>
                                            <th>Username</th>
                                            <th>Nombre Sondage</th>
                                            <th>Role</th>
                                            <th>Date Creation</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($getRecord as $value)
                                        <tr>
                                            <td data-field="gender">{{ $value->name }}</td>
                                            <td data-field="gender">{{ $value->username }}</td>
                                            <td data-field="gender">{{ $value->surveys_count + $value->surveydepart_count + $value->passager_arrive_count }}</td>
                                            <td data-field="gender">{{ $value->is_admin == 0 ? "Moderateur" : "Admin" }}</td>
                                            <td data-field="gender">{{ $value->created_at->format('Y-m-d') }}</td>
                                            @if($value->is_admin == 0)
                                            <td>
                                                <a href="{{ route('edit',$value->id) }}" class="btn btn-primary">Editer</a>
                                                <a href="{{ route('delete',$value->id) }}" class="btn btn-danger">Supprimer</a>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



    </div>

@endsection
