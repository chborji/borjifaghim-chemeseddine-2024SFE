@extends('layouts.admin.app')

@section('title','Liste produits composés')

@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-filter-list"></i>{{\App\CentralLogics\translate('liste')}} <span class="text-primary"></span></h1>
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
                            </form>
                        </div>
                        <div class="col-4 mb-3 mb-lg-0">
                            <a href="{{route('admin.productcompose.add-new')}}" class="btn btn-primary pull-right btn-block"><i class="tio-add-circle"></i> {{\App\CentralLogics\translate('ajouter')}} {{\App\CentralLogics\translate('produit')}} {{\App\CentralLogics\translate('composé')}}</a>
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
                                <th>{{\App\CentralLogics\translate('prix')}}</th>
                                <th>{{\App\CentralLogics\translate('ingredients')}}</th>
                                <th>{{\App\CentralLogics\translate('image')}}</th>
                                <th>{{\App\CentralLogics\translate('action')}}</th>
                            </tr>
                        </thead>
                        <tbody id="set-rows">
                            @foreach($prodcomposes as $key=>$prodcompose)
                            <tr>
                                <td>{{$prodcomposes->firstitem()+$key}}</td>
                                <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{ Str::limit($prodcompose['name'], 30) }}
                                        </a>
                                    </span>
                                </td>
                                <td>
                                    {{ $prodcompose['price'] . ' ' . \App\CentralLogics\Helpers::currency_symbol() }}
                                </td>
                                <td>
                                    @foreach(json_decode($prodcompose->ingredients) as $key => $ingredient)
                                    <div>requis <strong>{{ $ingredient->requis }} </strong>category :
                                        <strong>{{ $ingredient->categories}}</strong>
                                        ingredients <strong>{{ $ingredient->ingredients}}</strong>
                                    </div>
                                    @endforeach

                                </td>
                                <td>
                                    <div style="height: 100px; width: 100px; overflow-x: hidden;overflow-y: hidden">
                                        <img src="{{asset('storage/productcompose')}}/{{$prodcompose['image']}}" style="width: 100px">
                                    </div>
                                </td>
                                <td>
                                    <!-- Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="tio-settings"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('admin.productcompose.edit',[$prodcompose['id']])}}">{{\App\CentralLogics\translate('modifier')}}</a>
                                            <a class="dropdown-item" href="javascript:"onclick="form_alert('prodcompose-{{$prodcompose['id']}}','Vous voulez supprimer ce produit?')">{{\App\CentralLogics\translate('supprimer')}}</a>
                                            <form action="{{route('admin.productcompose.delete',[$prodcompose['id']])}}" method="post" id="prodcompose-{{$prodcompose['id']}}">
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
                                {!! $prodcomposes->links() !!}
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