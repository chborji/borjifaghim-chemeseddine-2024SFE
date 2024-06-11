@extends('layouts.admin.app')

@section('title','Ajouter caissier')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('ajouter')}}{{\App\CentralLogics\translate('caissier')}}
                </h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form action="{{route('admin.branch.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('prenom')}}</label>
                            <input type="text" name="name" class="form-control" placeholder="Prenom " required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('email')}}</label>
                            <input type="email" name="email" class="form-control" placeholder="EX : caissier@exemple.com" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="">{{\App\CentralLogics\translate('nom')}}</label>
                            <input type="text" name="l_name" class="form-control" placeholder="Nom" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="">{{\App\CentralLogics\translate('tel')}}</label>
                            <input type="tel" name="phone" class="form-control" placeholder="55 555 555" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="">{{\App\CentralLogics\translate('addresse')}}</label>
                            <input type="text" name="address" class="form-control" placeholder="Houmet souk" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('Mot de passe')}}</label>
                            <input type="text" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label>{{ \App\CentralLogics\translate('image') }}</label><small style="color: red">* ( {{ \App\CentralLogics\translate('ratio') }}3:1 )</small>
                        <div class="custom-file">
                            <input type="file" name="image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                            <label class="custom-file-label" for="customFileEg1">{{ \App\CentralLogics\translate('choisir') }} {{ \App\CentralLogics\translate('fichier') }}</label>
                        </div>

                    </div>
                    <div class="col-12 from_part_2">
                        <div class="form-group">
                            <hr>
                            <center>
                                <img style="width: 30%;border: 1px solid; border-radius: 10px;" id="viewer" src="{{ asset('assets/admin/img/900x400/img1.jpg') }}" alt="image" />
                            </center>
                        </div>
                    </div>


                </div>

                <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('ajouter')}}</button>

            </form>
        </div>

        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <hr>
            <div class="card">
                <!-- Page Header -->
                <div class="page-header p-2">
                    <div class="row align-items-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <h1 class="page-header-title"><i class="tio-filter-list"></i> {{\App\CentralLogics\translate('cashier')}} {{\App\CentralLogics\translate('list')}} <span class="text-primary">({{ $branches->total() }})</span></h1>
                        </div>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Table -->
                <div class="table-responsive datatable-custom">

                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th>{{\App\CentralLogics\translate('#')}}</th>
                                <th>{{\App\CentralLogics\translate('prenom')}}</th>
                                <th>{{\App\CentralLogics\translate('nom')}}</th>
                                <th>{{\App\CentralLogics\translate('tel')}}</th>
                                <th>{{\App\CentralLogics\translate('email')}}</th>
                                <th>{{\App\CentralLogics\translate('addresse')}}</th>
                                <th>{{\App\CentralLogics\translate('image')}}</th>
                              <!--  <th>{{\App\CentralLogics\translate('status')}}</th> -->

                                <th>{{\App\CentralLogics\translate('action')}}</th>
                            </tr>

                        </thead>

                        <tbody>
                            @foreach($branches as $key=>$branch)
                            <tr>
                                <td>{{$branches->firstitem()+$key}}</td>
                                <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{$branch['name']}}
                                        <!--@if($branch['id']==1)
                                        <label class="badge badge-danger">{{\App\CentralLogics\translate('main')}}</label>
                                        @else
                                        <label class="badge badge-info">{{\App\CentralLogics\translate('sub')}}</label>
                                        @endif-->
                                    </span>
                                </td>
                                <td><span class="d-block font-size-sm text-body">{{$branch['l_name']}}</span></td>
                                <td><span class="d-block font-size-sm text-body">{{$branch['phone']}}</span></td>
                                <td><span class="d-block font-size-sm text-body">{{$branch['email']}}</span></td>
                                <td><span class="d-block font-size-sm text-body">{{$branch['address']}}</span></td>

                                <td>
                                    <span class="d-block font-size-sm text-body">
                                        <img src='{{asset("storage/branch/".$branch->image)}}' height="50px" width="50px"></span>
                                </td>
                               <!-- <td>
                                    @if($branch['status']==1)
                                    <div style="padding: 10px;border: 1px solid;cursor: pointer"onclick="location.href='{{route('admin.branch.status',[$branch['id'],'status_code'=> 0])}}'">
                                        <span class="legend-indicator bg-success"></span>{{\App\CentralLogics\translate('active')}}
                                    </div>
                                    @else
                                    <div style="padding: 10px;border: 1px solid;cursor: pointer"onclick="location.href='{{route('admin.branch.status',[$branch['id'],'status_code'=> 1])}}'">
                                        <span class="legend-indicator bg-danger"></span>{{\App\CentralLogics\translate('bloqué')}}
                                    </div>
                                    @endif
                                </td>-->
                                <!-- Dropdown -->
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="tio-settings"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('admin.branch.edit',[$branch['id']])}}">{{\App\CentralLogics\translate('Modifier')}}</a>
                                            <a class="dropdown-item" href="javascript:"onclick="form_alert('branch-{{$branch['id']}}','Vous voulez supprimer ce caissier')">{{\App\CentralLogics\translate('supprimer')}}</a>
                                            <form action="{{route('admin.branch.delete',[$branch['id']])}}" method="post" id="branch-{{$branch['id']}}">
                                                @csrf @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Dropdown -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <table>
                        <tfoot>
                            {!! $branches->links() !!}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Table -->
    </div>
</div>

@endsection

@push('script_2')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#viewer').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileEg1").change(function() {
        readURL(this);
    });
</script>

@endpush