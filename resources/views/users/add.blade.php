@extends('layouts.auth')
@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif

            <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Ajouter un nouveau utilisateurs</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                    <li class="breadcrumb-item active">Form Validation</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="" class="needs-validation" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Nom et Prenom</label>
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"  placeholder="Nom et prenom" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">UserName</label>
                                                <input type="text" class="form-control" name="username" value="{{ old('username') }}"  placeholder="Username" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Email</label>
                                                <div>
                                                    <input type="email" class="form-control" required
                                                           parsley-type="email" name="email" value="{{ old('email') }}" placeholder="Enter a valid e-mail"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Mot de pass</label>
                                                <div>
                                                    <input type="password" class="form-control" required
                                                           name="password" placeholder="Password"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Utilisateur</label>
                                                <select class="form-select" name="is_admin" required>
                                                    {{--                                                    <option selected disabled value="0">Moderateur</option>--}}
                                                    <option selected value="0">Moderateur</option>
                                                    <option value="1">Administrateur</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid state.
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-primary" type="submit">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->


                </div>
                <!-- end row -->

            </div>
        </div>
    </div>


@endsection
