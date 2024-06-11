@extends('layouts.admin.app')

@section('title','détails')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-link" href="{{route('admin.orders.list',['status'=>'all'])}}">
                                Commandes 
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{\App\CentralLogics\translate('détails')}} {{\App\CentralLogics\translate('commande')}}</li>
                    </ol>
                </nav>

                <div class="d-sm-flex align-items-sm-center">
                    <h1 class="page-header-title">{{\App\CentralLogics\translate('commande')}} #{{$order['id']}}</h1>

                    @if($order['payment_status']=='paid')
                    <span class="badge badge-soft-success ml-sm-3">
                        <span class="legend-indicator bg-success"></span>{{\App\CentralLogics\translate('payé')}}
                    </span>
                    @else
                    <span class="badge badge-soft-danger ml-sm-3">
                        <span class="legend-indicator bg-danger"></span>{{\App\CentralLogics\translate('non payé')}}
                    </span>
                    @endif

                    @if($order['order_status']=='pending')
                    <span class="badge badge-soft-info ml-2 ml-sm-3 text-capitalize">
                        <span class="legend-indicator bg-info text"></span>{{\App\CentralLogics\translate('en attente')}}
                    </span>
                    @elseif($order['order_status']=='confirmed')
                    <span class="badge badge-soft-info ml-2 ml-sm-3 text-capitalize">
                        <span class="legend-indicator bg-info"></span>{{\App\CentralLogics\translate('confirmée')}}
                    </span>
                    @elseif($order['order_status']=='canceled')
                    <span class="badge badge-soft-warning ml-2 ml-sm-3 text-capitalize">
                        <span class="legend-indicator bg-warning"></span>{{\App\CentralLogics\translate('annulée')}}
                    </span>
                    @elseif($order['order_status']=='out_for_delivery')
                    <span class="badge badge-soft-warning ml-2 ml-sm-3 text-capitalize">
                        <span class="legend-indicator bg-warning"></span>{{\App\CentralLogics\translate('out_for_delivery')}}
                    </span>
                    @elseif($order['order_status']=='delivered')
                    <span class="badge badge-soft-success ml-2 ml-sm-3 text-capitalize">
                        <span class="legend-indicator bg-success"></span>{{\App\CentralLogics\translate('delivered')}}
                    </span>
                    @else
                    <span class="badge badge-soft-danger ml-2 ml-sm-3 text-capitalize">
                        <span class="legend-indicator bg-danger"></span>{{str_replace('_',' ',$order['order_status'])}}
                    </span>
                    @endif
                    <span class="ml-2 ml-sm-3">
                        <i class="tio-date-range"></i> {{date('d M Y h:i a',strtotime($order['created_at']))}}
                    </span>

                </div>

                <div class="mt-2">
                    <a class="text-body mr-3" href={{route('admin.orders.generate-invoice',[$order['id']])}}>
                        <i class="tio-print mr-1"></i> {{\App\CentralLogics\translate('imprimer')}} {{\App\CentralLogics\translate('facture')}}
                    </a>

                </diV>
            </div>

            <div class="col-sm-auto">
                <a class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle mr-1" href="{{route('admin.orders.details',[$order['id']-1])}}" data-toggle="tooltip" data-placement="top" title="Previous order">
                    <i class="tio-arrow-backward"></i>
                </a>
                <a class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle" href="{{route('admin.orders.details',[$order['id']+1])}}" data-toggle="tooltip" data-placement="top" title="Next order">
                    <i class="tio-arrow-forward"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row" id="printableArea">
        <div class="col-lg-{{$order->customer!=null ? 8 : 12}} mb-3 mb-lg-0">
            <!-- Card -->
            <div class="card mb-3 mb-lg-5">
                <!-- Header -->
                <div class="card-header" style="display: block!important;">
                    <div class="row">
                        <div class="col-12 pb-2 border-bottom">
                            <h4 class="card-header-title">
                                {{\App\CentralLogics\translate('details')}} {{\App\CentralLogics\translate('commande')}}
                                <span class="badge badge-soft-dark rounded-circle ml-1">{{$order->details->count()}}</span>
                            </h4>
                        </div>
                        <!-- <div class="col-6 pt-2">
                            <h6 style="color: #8a8a8a;">
                                {{\App\CentralLogics\translate('order')}} {{\App\CentralLogics\translate('note')}} : {{$order['order_note']}}
                            </h6>
                        </div> -->
                        <div class="col-6 pt-2">
                            <div class="text-right">
                                <h6 class="text-capitalize" style="color: #8a8a8a;">
                                    {{\App\CentralLogics\translate('methode')}} {{\App\CentralLogics\translate('paiement')}}
                                    : {{str_replace('_',' ',$order['payment_method'])}}
                                </h6>
                               <!--  <h6 class="" style="color: #8a8a8a;">
                                    @if($order['transaction_reference']==null && $order['order_type']!='pos')
                                    {{\App\CentralLogics\translate('reference')}} {{\App\CentralLogics\translate('code')}} :
                                    <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">
                                        {{\App\CentralLogics\translate('add')}}
                                    </button>
                                    @elseif($order['order_type']!='pos')
                                    {{\App\CentralLogics\translate('code')}} {{\App\CentralLogics\translate('reference')}}
                                    : {{$order['transaction_reference']}}
                                    @endif
                                </h6> -->
                                <h6 class="text-capitalize" style="color: #8a8a8a;">{{\App\CentralLogics\translate('type')}} {{\App\CentralLogics\translate('commande')}}
                                    : <label style="font-size: 10px" class="badge badge-soft-primary">{{str_replace('_',' ',$order['order_type'])}}</label>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body">
                    @php($sub_total=0)
                    @php($total_tax=0)
                    @php($total_dis_on_pro=0)
                    @php($add_ons_cost=0)
                    @foreach($order->details as $detail)
                    @if($detail->product)
                    @php($add_on_qtys=json_decode($detail['add_on_qtys'],true))
                    <!-- Media -->
                    <div class="media">
                        <div class="avatar avatar-xl mr-3">
                            <img class="img-fluid" src="{{asset('storage/product')}}/{{$detail->product['image']}}" alt="Image Description">
                        </div>


                        <div class="media-body">
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <strong> {{$detail->product['name']}}</strong><br>

                                    @if(count(json_decode($detail['variation'],true))>0)
                                    <strong><u>{{\App\CentralLogics\translate('variation')}} : </u></strong>
                                    @foreach(json_decode($detail['variation'],true)[0] as $key1 =>$variation)
                                    <div class="font-size-sm text-body">
                                        <span>{{$key1}} : </span>
                                        <span class="font-weight-bold">{{$variation}}</span>
                                    </div>
                                    @endforeach
                                    @endif
                                   <div>
                                    @if(count(json_decode($detail['ingredients'],true))>0)
                                    <strong><u>{{\App\CentralLogics\translate('Ingredeints')}} : </u></strong><br>
                                    @foreach(json_decode($detail['ingredients'],true) as $key2 =>$id)
                                    @php($ingredient=\App\Model\Ingredient::find($id))
                                        <span>{{$ingredient['name']}},</span>
                                @endforeach
                                @endif
                                  </div>
                                    @foreach(json_decode($detail['add_on_ids'],true) as $key2 =>$id)
                                    @php($addon=\App\Model\AddOn::find($id))
                                    @if($key2==0)<strong><u>{{\App\CentralLogics\translate('suppléments')}} : </u></strong>@endif

                                    @if($add_on_qtys==null)
                                        @php($add_on_qty=1)
                                    @else
                                        @php($add_on_qty=$add_on_qtys[$key2])
                                    @endif

                                    <div class="font-size-sm text-body">
                                        <span>{{$addon['name']}} :  </span>
                                        <span class="font-weight-bold">
                                            {{$add_on_qty}} x {{$addon['price']}} {{\App\CentralLogics\Helpers::currency_symbol()}}
                                        </span>
                                    </div>
                                    @php($add_ons_cost+=$addon['price']*$add_on_qty)
                                @endforeach
 
                                </div>

                                <div class="col col-md-2 align-self-center">
                                    @if($detail['discount_on_product']!=0)
                                    <h5>
                                        <strike>
                                            {{\App\CentralLogics\Helpers::variation_price(json_decode($detail['product_details'],true),$detail['variation']) ." ".\App\CentralLogics\Helpers::currency_symbol()}}
                                        </strike>
                                    </h5>
                                    @endif
                                    <h6>{{$detail['price']-$detail['discount_on_product'] ." ".\App\CentralLogics\Helpers::currency_symbol()}}</h6>
                                </div>
                                <div class="col col-md-1 align-self-center">
                                    <h5>Quantity {{$detail['quantity']}}</h5>
                                </div>

                                <div class="col col-md-3 align-self-center text-right">
                                    @php($amount=($detail['price']-$detail['discount_on_product'])*$detail['quantity'])
                                    <h5>{{$amount." ".\App\CentralLogics\Helpers::currency_symbol()}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php($sub_total+=$amount)
                    @php($total_tax+=$detail['tax_amount']*$detail['quantity'])
                    <!-- End Media -->
                    <hr>
                   

                    @endif
                    @endforeach


                    <!-- End Card -->
                </div>


            </div>
            <!-- End Row -->
        </div>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                   <!--      <h5 class="modal-title h4" id="mySmallModalLabel">{{\App\CentralLogics\translate('reference')}} {{\App\CentralLogics\translate('code')}} {{\App\CentralLogics\translate('add')}}</h5>
                        <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="tio-clear tio-lg"></i>
                        </button>
                    </div> -->

                    <form action="{{route('admin.orders.add-payment-ref-code',[$order['id']])}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <!-- Input Group -->
                            <div class="form-group">
                                <input type="text" name="transaction_reference" class="form-control" placeholder="EX : Code123" required>
                            </div>
                            <!-- End Input Group -->
                            <button class="btn btn-primary">{{\App\CentralLogics\translate('valider')}}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- End Modal -->

        <!-- Modal -->
        <div id="shipping-address-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalTopCoverTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-top-cover bg-dark text-center">
                        <figure class="position-absolute right-0 bottom-0 left-0" style="margin-bottom: -1px;">
                            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
                                <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z" />
                            </svg>
                        </figure>

                        <div class="modal-close">
                            <button type="button" class="btn btn-icon btn-sm btn-ghost-light" data-dismiss="modal" aria-label="Close">
                                <svg width="16" height="16" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- End Header -->
                    <div class="modal-top-cover-icon">
                        <span class="icon icon-lg icon-light icon-circle icon-centered shadow-soft">
                            <i class="tio-location-search"></i>
                        </span>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Modal -->
        @endsection

        @push('script_2')
        <script>
            function addDeliveryMan(id) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/')}}/admin/orders/add-delivery-man/{{$order['id']}}/" + id,
                    data: $('#product_form').serialize(),
                    success: function(data) {
                        if (data.status == true) {
                            toastr.success('Delivery man successfully assigned/changed', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        } else {
                            toastr.error('Deliveryman man can not assign/change in that status', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    },
                    error: function() {
                        toastr.error('Add valid data', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                });
            }

            function last_location_view() {
                toastr.warning('Only available when order is out for delivery!', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        </script>
        @endpush