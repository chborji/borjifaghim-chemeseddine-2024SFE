@extends('layouts.admin.app')

@section('title','Liste ingredients ')

@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-filter-list"></i> {{\App\CentralLogics\translate('liste')}} <span class="text-primary">({{$ingredients->total() }})</span></h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <div class="row" style="width: 100%">
                            <div class="col-8 mb-3 mb-lg-0">
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
                            <div class="col-4 mb-3 mb-lg-0">
                                <a href="{{route('admin.ingredient.add-new')}}" class="btn btn-primary pull-right btn-block"><i class="tio-add-circle"></i> {{\App\CentralLogics\translate('ajouter')}}{{\App\CentralLogics\translate('ingredient')}}</a>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>{{\App\CentralLogics\translate('#')}}</th>
                            <th>{{\App\CentralLogics\translate('nom')}}</th>

                            <th>{{\App\CentralLogics\translate('image')}}</th>
                            <th>{{\App\CentralLogics\translate('action')}}</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ingredients as $key=>$ingredient)
                        <tr>
                            <td>{{$ingredients->firstitem()+$key}}</td>
                            <td>
                                <span class="">
                                    {{$ingredient['name']}}
                                </span>
                            </td>
                            

                            <td>
                                <div class="">
                                    <img src='{{asset("storage/ingredient/".$ingredient->image)}}'  width="100px">
                                </div>
                            </td>
                            <td>
                                <!-- Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="tio-settings"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('admin.ingredient.edit',[$ingredient['id']])}}">{{\App\CentralLogics\translate('modifier')}}</a>
                                        <a class="dropdown-item" href="javascript:"onclick="form_alert('ingredient-{{$ingredient['id']}}','Vous voulez supprimer cet ingrédient ?')">{{\App\CentralLogics\translate('supprimer')}}</a>
                                        <form action="{{route('admin.ingredient.delete',[$ingredient['id']])}}" method="post" id="ingredient-{{$ingredient['id']}}">
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
                        {!! $ingredients->links() !!}
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- End Table -->
@endsection
    @push('script')
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
    @endpush