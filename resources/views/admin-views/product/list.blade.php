@extends('layouts.admin.app')

@section('title','Liste produits')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-filter-list"></i> {{\App\CentralLogics\translate('liste')}} <span class="text-primary">({{ $products->total() }})</span></h1>
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
                                <a href="{{route('admin.product.add-new')}}" class="btn btn-primary pull-right btn-block"><i class="tio-add-circle"></i> {{\App\CentralLogics\translate('ajouter')}} {{\App\CentralLogics\translate('produit')}}</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{\App\CentralLogics\translate('#')}}</th>
                                <th>{{\App\CentralLogics\translate('nom')}}</th>
                                <th>{{\App\CentralLogics\translate('description')}}</th>
                                <th>{{\App\CentralLogics\translate('prix')}}</th>
                              
                                <th>{{\App\CentralLogics\translate('variation')}}</th>
                             <!--   <th>{{\App\CentralLogics\translate('ingredients')}}</th>-->



                                <th>{{\App\CentralLogics\translate('image')}}</th>
                             <!--   <th>{{\App\CentralLogics\translate('quantity_stock')}}</th>-->

                                <th>{{\App\CentralLogics\translate('status')}}</th>
                                <th>{{\App\CentralLogics\translate('action')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($products as $key=>$product)
                                <tr>
                                    <td>{{$products->firstitem()+$key}}</td>
                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{ Str::limit($product['name'], 30) }}

                                           {{--   <a href="{{route('admin.product.view',[$product['id']])}}">
                                             </a> --}}
                                        </span>
                                    </td>

                                    <td>
                                    <span class="d-block font-size-sm text-body">
                                        @if($product->description==false)
                                        <div>
                                            pas de description
                                        </div>
                                        @endif
                                        <div>   {{$product['description']}}
                                            </div>
                                    </span> 
                                    </td>
                                   
                                <td>
                                @if($product->discount > 0)
                               <strike style="font-size: 12px!important;color: grey!important;">
                              {{ $product['price'] . ' ' . \App\CentralLogics\Helpers::currency_symbol() }}
                              </strike><br>
                               @endif
                            {{ ($product['price']- \App\CentralLogics\Helpers::discount_calculate($product, $product['price'])) . ' ' . \App\CentralLogics\Helpers::currency_symbol() }}
                                </td>
                                <td>
                                @if(json_decode($product->variations) == false )
                                <span>No variation available</span>
                                @endif
                                @foreach (json_decode($product->variations) as $key => $variant)
                                <div>Size <strong>{{ $variant->type }} </strong> price :
                                <strong>{{ $variant->price  . ' ' . \App\CentralLogics\Helpers::currency_symbol() }}</strong>
                                </div>  
                               @endforeach
                               <!-- {{$product['variations']}}-->                         
                                </td>
                       
                                    <td>
                                        <div style="height: 100px; width: 100px; overflow-x: hidden;overflow-y: hidden">
                                            <img src="{{asset('storage/product')}}/{{$product['image']}}"style="width: 100px">
                                        </div>
                                    </td>
                                   

                                 <!--   <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{$product['quantity_stock']}}
                                    </span>
                                    </td>-->
                                    <td>
                                        @if($product['status']==1)
                                            <div style="padding: 10px;border: 1px solid;cursor: pointer"onclick="location.href='{{route('admin.product.status',[$product['id'],0])}}'">
                                                <span class="legend-indicator bg-success"></span>{{\App\CentralLogics\translate('active')}}
                                            </div>
                                        @else
                                            <div style="padding: 10px;border: 1px solid;cursor: pointer"onclick="location.href='{{route('admin.product.status',[$product['id'],1])}}'">
                                                <span  class="legend-indicator bg-danger"></span>{{\App\CentralLogics\translate('Désactivé')}}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"href="{{route('admin.product.edit',[$product['id']])}}">{{\App\CentralLogics\translate('Modifier')}}</a>
                                                <a class="dropdown-item" href="javascript:"onclick="form_alert('product-{{$product['id']}}','voulez-vous supprimerce produit ?')">{{\App\CentralLogics\translate('Supprimer')}}</a>
                                                <form action="{{route('admin.product.delete',[$product['id']])}}" method="post" id="product-{{$product['id']}}">
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
                        <div class="page-area">
                            <table>
                                <tfoot class="border-top">
                                {!! $products->links() !!}
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>

@endsection

@push('script_2')
<!--search bar -->
    <script>
        $('#search-form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: "{{route('admin.product.search')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('.page-area').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
@endpush
