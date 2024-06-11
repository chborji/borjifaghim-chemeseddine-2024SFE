@extends('layouts.admin.app')

@section('title','Ajouter categorie')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('ajouter')}} {{\App\CentralLogics\translate('categorie')}}</h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form action="{{route('admin.ingcategory.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-6">
                        <label class="input-label" for="exampleFormControlInput1">{{ \App\CentralLogics\translate('nom') }}
                        </label>
                        <input type="text" name="name" class="form-control" placeholder="New Category" required>
                 

                    <label>{{ \App\CentralLogics\translate('image') }}</label><small style="color: red">* ( {{ \App\CentralLogics\translate('ratio') }}3:1 )</small>
                    <div class="custom-file">
                        <input type="file" name="image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                        <label class="custom-file-label" for="customFileEg1">{{ \App\CentralLogics\translate('choisir') }} {{ \App\CentralLogics\translate('fichier') }}</label>
                    </div>

                    <hr>

                    <img style="width: 30%;border: 1px solid; border-radius: 10px;" id="viewer" src="{{ asset('assets/admin/img/900x400/img1.jpg') }}" alt="image" />

                </div>
        </div>
    </div>

    <div class="col-6 mt-3"> <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('ajouter')}}</button>
    </div>
    </form>
</div>
<div class="row gx-2 gx-lg-3">

    <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
        <hr>
        <div class="card">
            <div class="card-header">
                <div class="flex-start">
                    <h5 class="card-header-title">Table categories</h5>
                    <h5 class="card-header-title text-primary mx-1">({{ $ingcategories->total() }})</h5>
                </div>
                <div>
                    <form action="{{url()->current()}}" method="GET">
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search"></i>
                                </div>
                            </div>
                            <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="Rechercher" aria-label="Search" value="{{$search}}" required>
                            <button type="submit" class="btn btn-primary">Rechercher</button>

                        </div>
                        <!-- End Search -->
                    </form>
                </div>
            </div>
            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 25%">{{\App\CentralLogics\translate('#')}}</th>
                            <th style="width: 25%">{{\App\CentralLogics\translate('nom')}}</th>
                            <!--<th style="width: 20%">{{\App\CentralLogics\translate('description')}}</th>-->
                            <th style="width: 25%">{{\App\CentralLogics\translate('image')}}</th>
<!--                             <th style="width: 20%">{{\App\CentralLogics\translate('status')}}</th>
 -->                            <th style="width: 25%">{{\App\CentralLogics\translate('action')}}</th>
                        </tr>
                        <tr>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ingcategories as $key=>$ingcategory)
                        <tr>
                            <td>{{$ingcategories->firstitem()+$key}}</td>
                            <td>
                                <span class="d-block font-size-sm text-body">
                                    {{$ingcategory['name']}}
                                </span>
                            </td>
                            <td>
                                <span class="d-block font-size-sm text-body">
                                    <img src="{{asset('storage/ingcategory/'.$ingcategory->image)}}" width="100px">
                                </span>
                            </td>
                          <!--   <td>
                                @if($ingcategory['status']==1)
                                <div style="padding: 10px;border: 1px solid;cursor: pointer"onclick="location.href='{{route('admin.ingcategory.status',[$ingcategory['id'],0])}}'">
                                    <span class="legend-indicator bg-success"></span>{{\App\CentralLogics\translate('active')}}
                                </div>
                                @else
                                <div style="padding: 10px;border: 1px solid;cursor: pointer"onclick="location.href='{{route('admin.ingcategory.status',[$ingcategory['id'],1])}}'">
                                    <span class="legend-indicator bg-danger"></span>{{\App\CentralLogics\translate('disabled')}}
                                </div>
                                @endif
                            </td> -->
                            <td>
                                <!-- Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="tio-settings"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('admin.ingcategory.edit',[$ingcategory['id']])}}">{{\App\CentralLogics\translate('modifier')}}</a>
                                        <a class="dropdown-item" href="javascript:"onclick="form_alert('ingcategory-{{$ingcategory['id']}}','Vous voulez supprimer cette catégorie ?')">{{\App\CentralLogics\translate('supprimer')}}</a>
                                        <form action="{{route('admin.ingcategory.delete',[$ingcategory['id']])}}" method="post" id="ingcategory-{{$ingcategory['id']}}">
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
                        {!! $ingcategories->links() !!}
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
    $(document).on('ready', function() {
        // INITIALIZATION OF DATATABLES
        // =======================================================
        var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

        $('#column1_search').on('keyup', function() {
            datatable
                .columns(1)
                .search(this.value)
                .draw();
        });


        $('#column3_search').on('change', function() {
            datatable
                .columns(2)
                .search(this.value)
                .draw();
        });


        // INITIALIZATION OF SELECT2
        // =======================================================
        $('.js-select2-custom').each(function() {
            var select2 = $.HSCore.components.HSSelect2.init($(this));
        });
    });
</script>

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