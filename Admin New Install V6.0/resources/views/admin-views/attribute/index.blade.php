@extends('layouts.admin.app')

@section('title','Ajouter attribut')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('ajouter')}} {{\App\CentralLogics\translate('attribut')}}</h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">

        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <div class="card p-4">
                <form action="{{route('admin.attribute.store')}}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('nom')}}</label>
                            <input type="text" name="name" class="form-control" placeholder="New Attribute">
                        </div>
                    </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('ajouter')}}</button>
            </div>

            </form>
        </div>
    </div>
    </div>
        <div class="row gx-2 gx-lg-3">

            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <hr>
                <div class="card">
                    <div class="card-header">
                        <div class="flex-start">
                            <h5 class="card-header-title">Table Attribut</h5>
                            <h5 class="card-header-title text-primary mx-1">({{ $attributes->total() }})</h5>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{\App\CentralLogics\translate('#')}}</th>
                                    <th style="width: 50%">{{\App\CentralLogics\translate('nom')}}</th>
                                    <th style="width: 10%">{{\App\CentralLogics\translate('action')}}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($attributes as $key=>$attribute)
                                <tr>
                                    <td>{{$attributes->firstitem()+$key}}</td>
                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{$attribute['name']}}
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('admin.attribute.edit',[$attribute['id']])}}">{{\App\CentralLogics\translate('Modifier')}}</a>
                                                <a class="dropdown-item" href="javascript:"onclick="form_alert('attribute-{{$attribute['id']}}','Vous voulez supprimer cet attribut ?')">{{\App\CentralLogics\translate('supprimer')}}</a>
                                                <form action="{{route('admin.attribute.delete',[$attribute['id']])}}" method="post" id="attribute-{{$attribute['id']}}">
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
                                {!! $attributes->links() !!}
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
    @endpush