@extends('layouts.admin.app')

@section('title','Modifier categorie')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-edit"></i> {{\App\CentralLogics\translate('modifier')}} {{\App\CentralLogics\translate('categorie')}}</h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form action="{{route('admin.ingcategory.update',[$ingcategory['id']])}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-6">
                        <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('nom')}}</label>
                        <input type="text" name="name" value="{{$ingcategory['name']}}" class="form-control" placeholder="Categorie" required>

                        <label>{{\App\CentralLogics\translate('image')}}</label><small style="color: red">* ( {{\App\CentralLogics\translate('ratio')}} 3:1 )</small>
                        <div class="custom-file">
                            <input type="file" name="image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            <label class="custom-file-label" for="customFileEg1">{{\App\CentralLogics\translate('choisir')}} {{\App\CentralLogics\translate('fichier')}}</label>
                        </div>
                        <hr>

                        <img style="width: 30%;border: 1px solid; border-radius: 10px;" id="viewer" src="{{asset('storage/ingcategory')}}/{{$ingcategory['image']}}" alt="" />
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('modifier')}}</button>

                </div>
            </form>
        </div>
        <!-- End Table -->
    </div>
</div>

@endsection

@push('script_2')

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
    });
</script>
@endpush