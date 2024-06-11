@extends('layouts.admin.app')

@section('title','Ajouter product')

@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{asset('assets/admin/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('ajouter')}} {{\App\CentralLogics\translate('produit')}}
                </h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form action="javascript:" method="post" id="product_form" enctype="multipart/form-data">
                @csrf

                <div class="card p-4">
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('name')}}</label>
                        <input type="text" name="name" class="form-control" placeholder="Produit" required>
                    </div>
                   {{-- <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('description')}}</label>
                        <textarea name="description" class="form-control" id="hiddenArea"></textarea>
                    </div> --}}
                </div>

                <div class="card p-4">
                    <div class="mt-4" id="from_part_2">
                        <div class="row">
                            <div class="col-md-4 col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('prix')}}</label>
                                    <input type="number" min="0" step="0.01" value="1" name="price" class="form-control" placeholder="Ex : 10" required>
                                </div>
                            </div>


                            <div class="col-md-4 col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('tax')}}</label>
                                    <input type="number" min="0" value="0" step="0.01" name="tax" class="form-control" placeholder="Ex : 7" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('type')}} {{\App\CentralLogics\translate('tax')}}</label>
                                    <select name="tax_type" class="form-control js-select2-custom">
                                        <option value="percent">{{\App\CentralLogics\translate('pourcent')}}</option>
                                        <option value="amount">{{\App\CentralLogics\translate('montant')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('réduction')}}</label>
                                    <input type="number" min="0" value="0" name="discount" class="form-control" placeholder="Ex : 100">
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('type')}} {{\App\CentralLogics\translate('réduction')}}</label>
                                    <select name="discount_type" class="form-control js-select2-custom">
                                        <option value="percent">{{\App\CentralLogics\translate('pourcent')}}</option>
                                        <option value="amount">{{\App\CentralLogics\translate('montant')}}</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">{{\App\CentralLogics\translate('categorie')}}<span class="input-label-secondary">*</span></label>
                                <select name="category_ids" class="form-control js-select2-custom" required>
                                    <option value="">---{{\App\CentralLogics\translate('select')}}---</option>

                                    @foreach(\App\Model\Category::orderBy('name')->get() as $category)
                                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="border: 1px solid #80808045; border-radius: 10px;padding-top: 10px;margin: 1px">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">{{\App\CentralLogics\translate('attribut')}}<span class="input-label-secondary"></span></label>
                                <select name="attribute_id[]" id="choice_attributes" class="form-control js-select2-custom" multiple="multiple">
                                    @foreach(\App\Model\Attribute::orderBy('name')->get() as $attribute)
                                    <option value="{{$attribute['id']}}">{{$attribute['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2 mb-2">
                            <div class="customer_choice_options" id="customer_choice_options">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2 mb-2">
                            <div class="variant_combination" id="variant_combination">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2" style="border: 1px solid #80808045; border-radius: 10px;padding-top: 10px;margin: 1px">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">{{\App\CentralLogics\translate('supplément')}}<span class="input-label-secondary"></span></label>
                                <select name="addon_ids[]" class="form-control js-select2-custom" multiple="multiple">
                                    @foreach(\App\Model\AddOn::orderBy('name')->get() as $addon)
                                    <option value="{{$addon['id']}}">{{$addon['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2" style="border: 1px solid #80808045; border-radius: 10px;padding-top: 10px;margin: 1px">
                        <div class="col-12">
                            <div class="form-group">
                               <label class="input-label" for="exampleFormControlSelect1">Categorie d'ingredient</label>
                                 <select name="category_id[]" class="form-control js-select2-custom" onchange="getRequest('{{url('/')}}/admin/ingredient/get-categories?parent_id='+this.value,'ingredients')" multiple>
                                   <option value="">---{{\App\CentralLogics\translate('select')}}---</option>
                                    @foreach($ingcategories as $ingcategory)
                                    <option value="{{$ingcategory['id']}}">{{$ingcategory['name']}}</option>
                                    @endforeach     
                                </select> 
                               
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlSelect1">{{\App\CentralLogics\translate('ingredients')}}<span class="input-label-secondary"></span></label>
                                    <select  name="ingredient_ids[]" id="ingredients" class="form-control js-select2-custom" multiple="multiple">
                                    </select>
                                </div> 
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label> {{\App\CentralLogics\translate('image')}}</label><small style="color: red">* ( {{\App\CentralLogics\translate('ratio')}} 1:1 )</small>
                        <div class="custom-file">
                            <input type="file" name="image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                            <label class="custom-file-label" for="customFileEg1">{{\App\CentralLogics\translate('choisir')}} {{\App\CentralLogics\translate('fichier')}}</label>
                        </div>

                        <div class="col-12 from_part_2">
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
        <hr>
        <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('ajouter')}}</button>
        </form>
    </div>
</div>
</div>

@endsection

@push('script')

@endpush

@push('script_2')
<!--File Reader-->
<script src="{{asset('assets/admin/js/spartan-multi-image-picker.js')}}"></script>

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
    //submit new product
    $('#product_form').on('submit', function() {
        var formData = new FormData(this);
        console.log(formData)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: "{{route('admin.product.ajouter')}}",
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
                    toastr.success('produit ajouté avec succés !', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function() {
                        location.href = "{{route('admin.product.list')}}";
                    }, 2000);
                }
            }
        });
    });
</script>

{{--  <script>
    function getRequest(route, id) {
        $.get({
            url: route,
            dataType: 'json',
            success: function(data) {
                $('#' + id).empty().append(data.options);
            },
        });
    }
</script>  --}}

<script>
    function getRequest(url, targetId) {
        var selectedCategories = document.querySelectorAll('.js-select2-custom option:checked');
        var categoryIds = [];
        selectedCategories.forEach(function(category) {
            categoryIds.push(category.value);
        });
        
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    populateIngredientsDropdown(response.options, targetId);
                } else {
                    console.error('Failed to fetch ingredients');
                }
            }
        };
        xhr.open('GET', url + '&parent_id=' + JSON.stringify(categoryIds), true);
        xhr.send();
    }
    
    function populateIngredientsDropdown(options, targetId) {
        var ingredientsDropdown = document.getElementById(targetId);
        ingredientsDropdown.innerHTML = ''; // Clear existing options
        ingredientsDropdown.innerHTML = options; // Populate with new options
    }
    </script>

<script>
    $(document).on('ready', function() {
        $('.js-select2-custom').each(function() {
            var select2 = $.HSCore.components.HSSelect2.init($(this));
        });
    });
</script>

<script src="{{asset('assets/admin')}}/js/tags-input.min.js"></script>

<script>
    $('#choice_attributes').on('change', function() {
        $('#customer_choice_options').html(null);
        $.each($("#choice_attributes option:selected"), function() {
            add_more_customer_choice_option($(this).val(), $(this).text());
        });
    });

    function add_more_customer_choice_option(i, name) {
        let n = name.split(' ').join('');
        $('#customer_choice_options').append('<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + n + '" placeholder="Choice Title" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="Enter choice values" data-role="tagsinput" onchange="combination_update()"></div></div>');
        $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    }

    function combination_update() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{route('admin.product.variant-combination')}}",
            data: $('#product_form').serialize(),
            success: function(data) {
                $('#variant_combination').html(data.view);
                if (data.length > 1) {
                    $('#quantity').hide();
                } else {
                    $('#quantity').show();
                }
            }
        });
    }
</script>

<script>
    function update_qty() {
        var total_qty = 0;
        var qty_elements = $('input[name^="stock_"]');
        for (var i = 0; i < qty_elements.length; i++) {
            total_qty += parseInt(qty_elements.eq(i).val());
        }
        if (qty_elements.length > 0) {
            $('input[name="total_stock"]').attr("readonly", true);
            $('input[name="total_stock"]').val(total_qty);
            console.log(total_qty)
        } else {
            $('input[name="total_stock"]').attr("readonly", false);
        }
    }
</script>
@endpush