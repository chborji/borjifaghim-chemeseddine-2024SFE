@extends('layouts.admin.app')

@section('title','Ajouter table')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('ajouter')}} {{\App\CentralLogics\translate('table')}}
                </h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
        <div class="card p-4">
            <form action="{{route('admin.table.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('numero')}}</label>
                            <input type="number" name="num" class="form-control" placeholder="1" required>
                        </div>
                    </div>
                    
                </div>

                <div class="form-group">
<button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('ajouter')}}</button>
</div>
                </div>

               

            </form>
        </div>

        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <hr>
            <div class="card">
                <!-- Page Header -->
                <div class="page-header p-2">
                    <div class="row align-items-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <h1 class="page-header-title"><i class="tio-filter-list"></i> {{\App\CentralLogics\translate('tables')}} <span class="text-primary">({{ $tables->total() }})</span></h1>
                        </div>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Table -->
                <div class="table-responsive datatable-custom">
               
                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                
                                <th style="width: 40%">{{\App\CentralLogics\translate('numero')}}</th>
                                <th style="width: 20%">{{\App\CentralLogics\translate('status')}}</th>
                                <th style="width: 20%">{{\App\CentralLogics\translate('action')}}</th>
                            </tr>
                         
                        </thead>

                        <tbody>
                            @foreach($tables as $key=>$table)
                            <tr>
                                <td>{{$table['num']}}</td>
                                <td>
                                  @if($table['status']==1)
                                            <div style="padding: 10px;border: 1px solid;cursor: pointer">
                                                <span class="legend-indicator bg-success"></span>{{\App\CentralLogics\translate('active')}}
                                            </div>
                                        @else
                                            <div style="padding: 10px;border: 1px solid;cursor: pointer">
                                                <span  class="legend-indicator bg-danger"></span>{{\App\CentralLogics\translate('disabled')}}
                                            </div>
                                        @endif
                                    </td>
                                 <!-- Dropdown -->
                                 <td>
                                 <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                   <a class="dropdown-item" href="javascript:"onclick="form_alert('table-{{$table['id']}}','Vous voulez supprimer cette table')">{{\App\CentralLogics\translate('supprimer')}}</a>
                                                <form action="{{route('admin.table.delete',[$table['id']])}}" method="post" id="table-{{$table['id']}}">
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
                            {!! $tables->links() !!}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Table -->
    </div>
</div>

@endsection

