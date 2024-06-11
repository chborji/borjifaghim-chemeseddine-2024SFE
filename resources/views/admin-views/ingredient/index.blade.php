@extends('layouts.admin.app')

@section('title','Ajouter ingredient')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('ajouter')}} {{\App\CentralLogics\translate('ingredient')}}</h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form action="{{route('admin.ingredient.store')}}" method="post" enctype="multipart/form-data">
                @csrf


                <div class="row">
                    <div class="form-group col-6">


                        <label class="input-label" for="exampleFormControlInput1">{{ \App\CentralLogics\translate('nom') }}
                        </label>
                        <input type="text" name="name" class="form-control" placeholder="New ingredient">

                        <label class="input-label" for="exampleFormControlSelect1">{{\App\CentralLogics\translate('categorie')}}<span class="input-label-secondary">*</span></label>
                        <select name="category_id" class="form-control js-select2-custom" onchange="getRequest('{{url('/')}}/admin/ingredient/get-categories?parent_id='+this.value,'sub-categories')" required>
                            <option value="">---{{\App\CentralLogics\translate('select')}}---</option>
                            @foreach($ingcategories as $ingcategory)
                            <option value="{{$ingcategory['id']}}">{{$ingcategory['name']}}</option>
                            @endforeach
                        </select>
                        <hr>
                        <div class="">
                            <label>{{\App\CentralLogics\translate('image')}}</label><small style="color: red">* ( {{\App\CentralLogics\translate('ratio')}} 1:1 )</small>
                            <div class="custom-file">
                                <input type="file" name="image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                <label class="custom-file-label" for="customFileEg1">{{\App\CentralLogics\translate('choisir')}} {{\App\CentralLogics\translate('fichier')}}</label>
                            </div>

                            <div class="">
                                <div class="form-group">
                                    <hr>
                                    <center>
                                        <img style="width: 30%;border: 1px solid; border-radius: 10px;" id="viewer" src="{{ asset('assets/admin/img/900x400/img1.jpg') }}" alt="image" />
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('ajouter')}}</button>
    </div>
    </form>
</div>


</div>
</div>

@endsection

@push('script_2')

<script>
    $(document).on('ready', function() {
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
        $('#image-viewer-section').show(1000)
    });
</script>


@endpush