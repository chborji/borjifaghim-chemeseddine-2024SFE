@extends('layouts.admin.app')

@section('title','Modifier supplément')

@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('modifier')}} {{\App\CentralLogics\translate('supplément')}} </h1>

            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form action="{{route('admin.addon.update',[$addon['id']])}}" method="post" id="product_form" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-6">
                        <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('nom')}} </label>
                        <input type="text" name="name" value="{{$addon['name']}}" class="form-control" placeholder="supplément" required>




                        <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('prix')}}</label>
                        <input type="number" min="0" step="0.01" name="price" value="{{$addon['price']}}" class="form-control" placeholder="20" required>

                        <label>{{\App\CentralLogics\translate('image')}} {{\App\CentralLogics\translate('supplément')}}</label><small style="color: red">* ( {{\App\CentralLogics\translate('ratio')}} 1:1 )</small>
                        <div class="custom-file">
                            <input type="file" name="image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            <label class="custom-file-label" for="customFileEg1">{{\App\CentralLogics\translate('choisir')}} {{\App\CentralLogics\translate('fichier')}}</label>
                        </div>

                        <hr>
                        <center>
                            <img style="width:30%; border: 1px solid; border-radius: 10px;" id="viewer" src="{{asset('storage/addon')}}/{{$addon['image']}}" alt="image extra" />
                        </center>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('modifier')}}</button>

        </div>

    </div>
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
        $('#image-viewer-section').show(1000)
    });
</script>
<script>
    $('#product_form').on('submit', function() {
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: "{{route('admin.addon.update',[$addon['id']])}}",
            data: $('#product_form').serialize(),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.errors) {
                    for (var i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                } else {
                    toastr.success('produit mis à jour avec succès !', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function() {
                        location.href = "{{route('admin.addon.add-new')}}";
                    }, 2000);
                }
            }
        });
    });
</script>

@endpush