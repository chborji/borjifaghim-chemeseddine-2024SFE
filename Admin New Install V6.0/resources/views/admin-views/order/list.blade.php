@extends('layouts.admin.app')

@section('title','Order List')

@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center mb-3">
            <div class="col-9">
                <h1 class="page-header-title">{{\App\CentralLogics\translate('Commandes')}} <span class="badge badge-soft-dark ml-2">{{$orders->total()}}</span></h1>
            </div>

            <div class="col-3">
                <!-- Select -->
                <select class="custom-select custom-select-sm text-capitalize" name="branch" onchange="filter_branch_orders(this.value)">
                    <option disabled>--- {{\App\CentralLogics\translate('caissier')}} ---</option>
                    <option value="0" {{session('branch_filter')==0?'selected':''}}>{{\App\CentralLogics\translate('tous')}} {{\App\CentralLogics\translate('caissiers')}}</option>
                    @foreach(\App\Model\Branch::all() as $branch)
                    <option value="{{$branch['id']}}" {{session('branch_filter')==$branch['id']?'selected':''}}>{{$branch['name']}}</option>
                    @endforeach
                </select>
                <!-- End Select -->
            </div>
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev" style="display: none;">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-left"></i>
                </a>
            </span>

            <span class="hs-nav-scroller-arrow-next" style="display: none;">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-right"></i>
                </a>
            </span>

            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">{{\App\CentralLogics\translate('liste')}} {{\App\CentralLogics\translate('Commandes')}}</a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
    <!-- End Page Header -->

    <!-- Card -->
    <div class="card">
        <!-- Header -->
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <form action="{{url()->current()}}" method="GET">
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search"></i>
                                </div>
                            </div>
                            <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="Rechercher" aria-label="Search" value="{{$search}}" required>
                            <button type="submit" class="btn btn-primary">rechercher</button>

                        </div>
                        <!-- End Search -->
                    </form>
                </div>


               <!-- <div class="col-lg-6">
                    <a href="{{route('admin.orders.export')}}" class="btn btn-secondary float-right"><i class="tio-pages"></i>
                        Bulk Export</a>
                </div>-->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive datatable-custom">
            <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%">
                <thead class="thead-light">
                    <tr>
                        <th class="">
                            {{\App\CentralLogics\translate('#')}}
                        </th>
                        <th class="table-column-pl-0">{{\App\CentralLogics\translate('commande')}}</th>
                        <th>{{\App\CentralLogics\translate('date')}}</th>
                      <!--<th>{{\App\CentralLogics\translate('customer')}}</th>-->
                        <th>{{\App\CentralLogics\translate('caissier')}}</th>
                        <th>{{\App\CentralLogics\translate('paiement')}} {{\App\CentralLogics\translate('status')}}</th>
                        <th>{{\App\CentralLogics\translate('total')}}</th>
                        <th>{{\App\CentralLogics\translate('commande')}} {{\App\CentralLogics\translate('status')}}</th>
                        <th>{{\App\CentralLogics\translate('actions')}}</th>
                    </tr>
                </thead>

                <tbody id="set-rows">
                    @foreach($orders as $key=>$order)

                    <tr class="status-{{$order['order_status']}} class-all">
                        <td class="">
                            {{$orders->firstitem()+$key}}
                        </td>
                        <td class="table-column-pl-0">
                            <a href="{{route('admin.orders.details',['id'=>$order['id']])}}">{{$order['id']}}</a>
                        </td>
                        <td>{{date('d M Y',strtotime($order['created_at']))}}</td>
                      <!--  <td>
                            @if($order->customer)
                            <a class="text-body text-capitalize" href="{{route('admin.customer.view',[$order['user_id']])}}">{{$order->customer['f_name'].' '.$order->customer['l_name']}}</a>
                            @else
                            <label class="badge badge-danger">{{\App\CentralLogics\translate('invalid')}} {{\App\CentralLogics\translate('customer')}} {{\App\CentralLogics\translate('data')}}</label>
                            @endif
                        </td>-->
                        <td>
                            <label class="badge badge-soft-primary">{{$order->branch?$order->branch->name:'Cashier'}}</label>
                        </td>
                        <td>
                            @if($order->payment_status=='paid')
                            <span class="badge badge-soft-success">
                                <span class="legend-indicator bg-success"></span>{{\App\CentralLogics\translate('payé')}}
                            </span>
                            @else
                            <span class="badge badge-soft-danger">
                                <span class="legend-indicator bg-danger"></span>{{\App\CentralLogics\translate('non payé')}}
                            </span>
                            @endif
                        </td>
                        <td>{{$order['order_amount'] ." ". \App\CentralLogics\Helpers::currency_symbol()}}</td>
                        <td class="text-capitalize">
                            @if($order['order_status']=='confirmed')
                            <span class="badge badge-soft-info ml-2 ml-sm-3">
                                <span class="legend-indicator bg-success"></span>{{\App\CentralLogics\translate('confirmée')}}
                            </span>
                            @elseif($order['order_status']=='pending')
                            <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                <span class="legend-indicator bg-danger"></span>{{\App\CentralLogics\translate('en attente')}}
                            </span>
                            @elseif($order['order_status']=='canceled')
                            <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                <span class="legend-indicator bg-warning"></span>{{\App\CentralLogics\translate('annulée')}}
                            </span>
                            @elseif($order['order_status']=='out_for_delivery')
                            <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                <span class="legend-indicator bg-warning"></span>{{\App\CentralLogics\translate('out_for_delivery')}}
                            </span>
                            @elseif($order['order_status']=='delivered')
                            <span class="badge badge-soft-success ml-2 ml-sm-3">
                                <span class="legend-indicator bg-success"></span>{{\App\CentralLogics\translate('delivered')}}
                            </span>
                            @else
                            <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                <span class="legend-indicator bg-danger"></span>{{str_replace('_',' ',$order['order_status'])}}
                            </span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="tio-settings"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('admin.orders.details',['id'=>$order['id']])}}"><i class="tio-visible"></i> {{\App\CentralLogics\translate('detail')}}</a>
                                    <a class="dropdown-item" target="_blank" href="{{route('admin.orders.generate-invoice',[$order['id']])}}"><i class="tio-download"></i> {{\App\CentralLogics\translate('facture')}}</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End Table -->

        <!-- Footer -->
        <div class="card-footer">
            <!-- Pagination -->
            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
                        {!! $orders->links() !!}
                        <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                    </div>
                </div>
            </div>
            <!-- End Pagination -->
        </div>
        <!-- End Footer -->
    </div>
    <!-- End Card -->
</div>
@endsection

@push('script_2')
<script>
    function filter_branch_orders(id) {
        location.href = '/admin/orders/branch-filter/' + id;
    }
</script>

<script>
    $('#search-form').on('submit', function() {
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: "{{route('admin.orders.search')}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                $('#set-rows').html(data.view);
                $('.card-footer').hide();
            },
            complete: function() {
                $('#loading').hide();
            },
        });
    });
</script>
@endpush