@extends('layouts.admin.app')

@section('title','Produit Aperçu')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-6">
                <h1 class="page-header-title">{{ Str::limit($product['name'], 30) }}</h1>
            </div>
            <div class="col-6">
                <a href="{{url()->previous()}}" class="btn btn-primary float-right">
                    <i class="tio-back-ui"></i> {{\App\CentralLogics\translate('retour')}}
                </a>
            </div>
        </div>
        <!-- Nav -->
        <!-- <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:">
                       {{\App\CentralLogics\translate('product')}} {{\App\CentralLogics\translate('reviews')}}
                    </a>
                </li>
            </ul>-->
        <!-- End Nav -->
    </div>
    <!-- End Page Header -->

    <!-- Card -->
    <div class="card mb-3 mb-lg-5">
        <!-- Body -->
        <div class="card-body">
            <div class="row align-items-md-center gx-md-5">
                <div class="col-md-auto mb-3 mb-md-0">
                    <div class="d-flex align-items-center">
                        <img class="avatar avatar-xxl avatar-4by3 mr-4" src="{{asset('storage/product')}}/{{$product['image']}}" alt="Image Description">
                        <!--<div class="d-block">
                            <h4 class="display-2 text-dark mb-0">{{count($product->rating)>0?number_format($product->rating[0]->average, 2, '.', ' '):0}}</h4>
                             <p> {{\App\CentralLogics\translate('of')}} {{$product->reviews->count()}} {{\App\CentralLogics\translate('reviews')}}
                                    <span class="badge badge-soft-dark badge-pill ml-1"></span>
                                </p>
                        </div>-->
                    </div>
                </div>

                <!--  <div class="col-md">
                        <ul class="list-unstyled list-unstyled-py-2 mb-0">

                        @php($total=$product->reviews->count())
                        
                            <li class="d-flex align-items-center font-size-sm">
                                @php($five=\App\CentralLogics\Helpers::rating_count($product['id'],5))
                                <span
                                    class="mr-3">5 star</span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"style="width: {{$total==0?0:($five/$total)*100}}%;"aria-valuenow="{{$total==0?0:($five/$total)*100}}"aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-3">{{$five}}</span>
                            </li>
                           
                            <li class="d-flex align-items-center font-size-sm">
                                @php($four=\App\CentralLogics\Helpers::rating_count($product['id'],4))
                                <span class="mr-3">4 star</span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"style="width: {{$total==0?0:($four/$total)*100}}%;"aria-valuenow="{{$total==0?0:($four/$total)*100}}"aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-3">{{$four}}</span>
                            </li>
                           
                            <li class="d-flex align-items-center font-size-sm">
                                @php($three=\App\CentralLogics\Helpers::rating_count($product['id'],3))
                                <span class="mr-3">3 star</span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"style="width: {{$total==0?0:($three/$total)*100}}%;"aria-valuenow="{{$total==0?0:($three/$total)*100}}"aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-3">{{$three}}</span>
                            </li>
                          
                            <li class="d-flex align-items-center font-size-sm">
                                @php($two=\App\CentralLogics\Helpers::rating_count($product['id'],2))
                                <span class="mr-3">2 star</span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"style="width: {{$total==0?0:($two/$total)*100}}%;"aria-valuenow="{{$total==0?0:($two/$total)*100}}"aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-3">{{$two}}</span>
                            </li>
                            
                            <li class="d-flex align-items-center font-size-sm">
                                @php($one=\App\CentralLogics\Helpers::rating_count($product['id'],1))
                                <span class="mr-3">1 star</span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"style="width: {{$total==0?0:($one/$total)*100}}%;"aria-valuenow="{{$total==0?0:($one/$total)*100}}"aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-3">{{$one}}</span>
                            </li>
                          
                        </ul>
                    </div>-->

                <div class="col-12">
                    <hr>
                </div>
                <div class="col-4 pt-2">
                    <h4 class="border-bottom">{{$product['name']}}</h4>
                    <span>{{\App\CentralLogics\translate('primary')}} :
                        <span>{{$product['price']}} {{\App\CentralLogics\Helpers::currency_symbol()}}</span>
                    </span><br>
                    <span>{{\App\CentralLogics\translate('tax')}} :
                        <span>{{\App\CentralLogics\Helpers::tax_calculate($product,$product['price'])}} {{\App\CentralLogics\Helpers::currency_symbol()}}</span>
                    </span><br>
                    <span>{{\App\CentralLogics\translate('réduction')}} :
                        <span>{{\App\CentralLogics\Helpers::discount_calculate($product,$product['price'])}} {{\App\CentralLogics\Helpers::currency_symbol()}}</span>
                    </span><br>
                    <!-- <span>
                        {{\App\CentralLogics\translate('quantity_stock')}}: {{$product['quantity_stock']}}
                    </span><br> -->

                    <h4 class="border-bottom mt-2"> {{\App\CentralLogics\translate('variations')}} </h4>
                    @foreach(json_decode($product['variations'],true) as $variation)
                    <span class="text-capitalize">
                        {{$variation['type']}} : {{$variation['price']}} {{\App\CentralLogics\Helpers::currency_symbol()}}
                    </span><br>
                    @endforeach

                </div>

                <div class="col-8 pt-2 border-left">
                    <h4>{{\App\CentralLogics\translate('short')}} {{\App\CentralLogics\translate('description')}} : </h4>
                    <p>{!! $product['description'] !!}</p>
                </div>
                </div>
        </div>
        <!-- End Body -->
    </div>
    <!-- End Card -->

    <!-- Card -->
    <!--  <div class="card">-->
    <!-- Table -->
    <!--
            <div class="table-responsive datatable-custom">
                <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap card-table"
                       data-hs-datatables-options='{
                     "columnDefs": [{
                        "targets": [0, 3, 6],
                        "orderable": false
                      }],
                     "order": [],
                     "info": {
                       "totalQty": "#datatableWithPaginationInfoTotalQty"
                     },
                     "search": "#datatableSearch",
                     "entries": "#datatableEntries",
                     "pageLength": 25,
                     "isResponsive": false,
                     "isShowPaging": false,
                     "pagination": "datatablePagination"
                   }'>
                    <thead class="thead-light">
                    <tr>
                        <th>{{\App\CentralLogics\translate('reviewer')}}</th>
                        <th>{{\App\CentralLogics\translate('review')}}</th>
                        <th>{{\App\CentralLogics\translate('date')}}</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($reviews as $review)
                        <tr>
                            <td>
                                <a class="d-flex align-items-center"
                                   href="{{route('admin.customer.view',[$review['user_id']])}}">
                                    <div class="avatar avatar-circle">
                                        <img class="avatar-img" width="75" height="75"onerror="this.src='{{asset('assets/admin/img/160*160/img1.jpg')}}'"src="{{asset('storage/app/public/profile/'.$review->customer->image)}}"alt="Image Description">
                                    </div>
                                    <div class="ml-3">
                                    <span class="d-block h5 text-hover-primary mb-0">{{$review->customer['f_name']." ".$review->customer['l_name']}} <i
                                            class="tio-verified text-primary" data-toggle="tooltip" data-placement="top"
                                            title="Verified Customer"></i></span>
                                        <span class="d-block font-size-sm text-body">{{$review->customer->email}}</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <div class="text-wrap" style="width: 18rem;">
                                    <div class="d-flex mb-2">
                                        <label class="badge badge-soft-info">
                                            {{$review->rating}} <i class="tio-star"></i>
                                        </label>
                                    </div>

                                    <p>
                                        {{$review['comment']}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                {{date('d M Y H:i:s',strtotime($review['created_at']))}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>-->
    <!-- End Table -->

    <!-- Footer -->
    <!-- <div class="card-footer">-->
    <!-- Pagination -->
    <!--
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-12">
                        {!! $reviews->links() !!}
                    </div>
                </div>-->
    <!-- End Pagination 
            </div>-->
    <!-- End Footer
        </div> -->
    <!-- End Card -->
</div>
@endsection

