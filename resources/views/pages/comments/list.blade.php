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
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
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
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        {{--                                            <th>ID</th>--}}
                                        <th>Utilisateur</th>
                                        <th>Terminal</th>
                                        <th>Status</th>
                                        <th>Commentaire</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getRecord as $value)
                                        <tr>
                                            <td data-field="gender">{{ $value->user_id }}</td>
                                            <td data-field="gender">{{ $value->terminal }}</td>
                                            <td data-field="gender">{{ $value->status }}</td>
                                            <td data-field="gender">
                                                <p style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">
                                                    {{ $value->suggestion }}
                                                </p>
                                            </td>
                                            @if($value->is_admin == 0)
                                                <td>
                                                    <a href="{{ route('deleteComment',$value->id) }}"
                                                       class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

@endsection
