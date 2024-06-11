@extends('layouts.admin.app')

@section('title','Modifier cassier')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title text-capitalize"><i class="tio-edit"></i> {{\App\CentralLogics\translate('Modifier')}} {{\App\CentralLogics\translate('cassier')}}</h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    @php($branch_count=\App\Model\Branch::count())
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form action="{{route('admin.branch.update',[$branch['id']])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('prenom')}}</label>
                            <input type="text" name="name" value="{{$branch['name']}}" class="form-control" placeholder="prenom caissier" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="">{{\App\CentralLogics\translate('nom')}}</label>
                            <input type="text" name="l_name" value="{{$branch['l_name']}}" class="form-control" placeholder="nom caissier">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('email')}}</label>
                            <input type="email" name="email" value="{{$branch['email']}}" class="form-control" placeholder="EX : exemple@exemple.com" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="">{{\App\CentralLogics\translate('Tel')}}</label>
                            <input type="tel" name="phone" value="{{$branch['phone']}}" class="form-control" placeholder="22111444">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="">{{\App\CentralLogics\translate('addresse')}}</label>
                            <input type="text" name="address" value="{{$branch['address']}}" class="form-control" placeholder="Houmet Souk" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('Mot de passe')}} <span class="" style="color: red;font-size: small">* ( si vous voulez réinitialiser. )</span></label>
                            <input type="text" name="password" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>{{\App\CentralLogics\translate('image')}}</label><small style="color: red">* ( {{\App\CentralLogics\translate('ratio')}} 3:1 )</small>
                            <div class="custom-file">
                                <input type="file" name="image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                <label class="custom-file-label" for="customFileEg1">{{\App\CentralLogics\translate('choisir')}} {{\App\CentralLogics\translate('fichier')}}</label>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <img style="width: 10%;border: 1px solid; border-radius: 10px; float:right" id="viewer" src="{{asset('storage/branch')}}/{{$branch['image']}}" alt="" />


                </div>


                <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('Modifier')}}</button>
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