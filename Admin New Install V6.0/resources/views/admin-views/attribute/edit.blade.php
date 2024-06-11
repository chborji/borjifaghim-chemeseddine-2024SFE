@extends('layouts.admin.app')

@section('title','Modifier attribut')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-edit"></i> {{\App\CentralLogics\translate('Modifier')}} {{\App\CentralLogics\translate('attribut')}}</h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <div class="card p-4">
                <form action="{{route('admin.attribute.update',[$attribute['id']])}}" method="post" id="product_form">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('nom')}} </label>
                            <input type="text" name="name" class="form-control" value="{{ $attribute['name'] }}" placeholder="Attribut">
                        </div>

                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('Modifier')}}</button>

                    </div>

            </div>
            </form>
        </div>
        <!-- End Table -->
    </div>
</div>

@endsection