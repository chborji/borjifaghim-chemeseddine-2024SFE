@extends('layouts.admin.app')

@section('title','modifier Formule')

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
                <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('modifier')}} {{\App\CentralLogics\translate('formule')}}</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group lang_form" id="">
                <label class="input-label" for="exampleFormControlInput1">{{ \App\CentralLogics\translate('nom') }}</label>
                <input type="text" id="formule-name" name="name[]" class="form-control" value="{{$formule['name']}}" placeholder="formule" required>
            </div>
            <div class="form-group">
                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('prix')}}</label>
                <input type="number" id="formule-price" min="0" step="0.01" name="price" value="{{$formule['price']}}" class="form-control" placeholder="Ex : 10 TND" required>
            </div>

            <form enctype="multipart/form-data">
                <div class="form-group">

                    <label> {{\App\CentralLogics\translate('image')}}</label><small style="color: red">* ( {{\App\CentralLogics\translate('ratio')}} 1:1 )</small>
                    <div class="custom-file">
                        <input type="file" name="image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                        <label class="custom-file-label" for="image">{{\App\CentralLogics\translate('choose')}} {{\App\CentralLogics\translate('file')}}</label>
                    </div>

                    <div class="col-12 from_part_2">
                        <div class="form-group">
                            <hr>

                            <img style="width: 40%;border: 1px solid; border-radius: 10px;" id="viewer" src="{{asset('storage/formule')}}/{{$formule['image']}}" alt="image" />

                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="container">
            <div class="row">
                <div class="form-group col-3">
                    <label for="">Ajouter</label>
                    <input type="number" placeholder="Enter requis" class="form-control form-control-sm" name="requis" id="requis" value="">
                    <font style="color:red"> {{ $errors->has('requis') ?  $errors->first('requis') : '' }} </font>
                </div>
                <div class="form-group col-3 ">
                    <label class="input-label" for="exampleFormControlSelect1">{{\App\CentralLogics\translate('categorie')}}<span class="input-label-secondary">*</span></label>
                    <select name="category_id" id="category_id" class="form-control js-select2-custom" onchange="handleChange(event)" required>
                        <option value="">---{{\App\CentralLogics\translate('select')}}---</option>
                        @foreach($categories as $category)
                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlSelect1">{{\App\CentralLogics\translate('produit')}}<span class="input-label-secondary"></span></label>
                        <select name="product" id="products" class="form-control js-select2-custom" onchange="handleChangeproducts(event)" multiple="multiple">
                        </select>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <button id="addMore" class="btn btn-success btn-sm">Ajouter plus </button>
            </div>

            <form action="javascript:" method="post" id="formule_form">
                @csrf

                <table class="table table-sm table-bordered" id="mytable" style=" display: none;">
                    <thead>
                        <tr>
                            <th>categorie</th>

                            <th>Requis</th>
                            <th>Produit</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="addRow" class="addRow">
                    <tbody id="addRow1" class="addRow">


                    </tbody>


                </table>
                <div class="form-group mt-5"> <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
<script src="{{asset('assets/admin/js/spartan-multi-image-picker.js')}}"></script>
<script src="//code.jquery.com/jquery.js"></script>


<script>
    var allProd = <?php echo $formule->products ?>;
    $(document).ready(function() {
        $('.table').show();

        var table2 = document.getElementById("addRow");
        allProd.forEach(data => {
            var row = table2.insertRow(0);
            row.setAttribute("id", data.categories);

            var cell1 = row.insertCell(0);
            cell1.classList.add('categories1');

            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);

            cell1.innerHTML = data.categories;
            cell2.innerHTML = data.requis;
            cell3.innerHTML = data.products;
            cell4.innerHTML += '<i class="removeaddmores" onclick="deleteproductsbyid(' + data.categories + ')" style="cursor:pointer;color:red;"> Remove </i>';

            // allIngredinat.push(data1)
            // console.log(data1)
        });
    });
    var image

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#viewer').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            image = input.files[0];
        }
    }

    $("#customFileEg1").change(function() {

        readURL(this);
        $('#image-viewer-section').show(1000)
    });


    let log = document.getElementById('log');
    var allProduct = [];
    var data = {
        requis: "",
        products: "",
        categories: ""
    }

    function handleChange(e) {
        console.log(e)
        getRequest('/admin/product/get-categories?parent_id=' + e.target.value, 'products');
        let values = Array.from(e.target.selectedOptions).map((value) => value.innerText).toString();
        data.categories = values
    }

    function handleChangeproducts(e) {
        console.log(e)
        let values = Array.from(e.target.selectedOptions).map((value) => value.innerText).toString();
        let innerText = e.target[e.target.options.selectedIndex].innerText;
        data.products = values
    }
</script>
<script>
    function getRequest(route, id) {
        $.get({
            url: route,
            dataType: 'json',
            success: function(data) {
                $('#' + id).empty().append(data.options);
            },
        });
    }
</script>
<script>
    $(document).on('click', '#addMore', function(event) {

        $('.table').show();
        data.requis = $("#requis").val();
        var data1 = {
            requis: data.requis,
            products: data.products,
            categories: data.categories
        }

        var table = document.getElementById("addRow");

        if (allProduct.findIndex(res => res.categories === data1.categories) > -1) {
            var row1 = document.getElementById(data1.categories);
            row1.parentNode.removeChild(row1);
            allProduct = allProduct.filter(res => res.categories !== data1.categories)
            allProduct.push(data1)

            var row = table.insertRow(0);
            row.setAttribute("id", data.categories);

            var cell1 = row.insertCell(0);
            cell1.classList.add('categories1');

            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);

            cell1.innerHTML = data.categories;
            cell2.innerHTML = data.requis;
            cell3.innerHTML = data.products;
            cell4.innerHTML += '<i class="removeaddmores" onclick="deleteProducts(' + data.categories + ')" style="cursor:pointer;color:red;"> Remove </i>';


        } else {
            var row = table.insertRow(0);
            row.setAttribute("id", data.categories);

            var cell1 = row.insertCell(0);
            cell1.classList.add('categories1');

            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);

            cell1.innerHTML = data.categories;
            cell2.innerHTML = data.requis;
            cell3.innerHTML = data.products;
            cell4.innerHTML += '<i class="removeaddmores" onclick="deleteProducts(' + data.categories + ')" style="cursor:pointer;color:red;"> Remove </i>';

            allProduct.push(data1)
            console.log(data1)
        }



    });
    $(document).on('click', '.removeaddmore', function(event) {

        $(this).closest('#addRow').remove();
        // total_ammount_price();
        deleteProducts();

    });

    function deleteProducts(categorie) {
        //console.log(categorie.id)
        let productscopy = []
        //console.log(allProduct)
        // var value = $(this).val();

        if (categorie.id.length != 0 && allProduct.findIndex(res => res.categories === categorie.id) > -1) {

            productscopy.push(allProduct.find(res => res.categories === categorie.id))

            allProduct = allProduct.filter(res => res.categories !== categorie.id)
            var row2 = document.getElementById(categorie.id);
            row2.parentNode.removeChild(row2);
            //allProduct = ingeredinstcopy;
        }
    }

    function deleteproductsbyid(categorie) {
        //  console.log(categorie)
        let productscopy = []
        //  console.log(ingredints)
        // var value = $(this).val();

        if (categorie.length != 0 && allProd.findIndex(res => res.categories === categorie.id) > -1) {

            productscopy.push(allProd.find(res => res.categories === categorie.id))

            allProd = allProd.filter(res => res.categories !== categorie.id)
            var row2 = document.getElementById(categorie.id);
            console.log(row2)

            row2.parentNode.removeChild(row2);
            //allIngredinat = ingeredinstcopy;
        }
    }

    $('#formule_form').on('submit', function() {
        // var formData = new FormData(this);

        let formuleName = document.getElementById("formule-name").value
        let formulePrice = document.getElementById("formule-price").value
        //let allProduct = document.getElementById("products").value
        //   console.log(productName)
        //   console.log(productPrice)
        var formData = new FormData();
        formData.append("name", formuleName)
        formData.append("price", formulePrice)
        formData.append("file", document.getElementById("customFileEg1").files[0])
        formData.append("products", (JSON.stringify((allProduct).concat(allProd))))


        let data = {
            name: formuleName,
            price: formulePrice,
            formule: allProduct
        }
        console.log(data)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('admin.formule.update',[$formule['id']])}}",
            data: formData,
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data)
                if (data.errors) {
                    for (var i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                } else {
                    toastr.success('produit ajouté avec succès !', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function() {
                        location.href = "{{route('admin.formule.list')}}";
                    }, 2000);
                }
            }

        });
    });
</script>
@endsection