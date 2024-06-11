@extends('layouts.admin.app')

@section('title','modifier produit composé')

@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush


@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('ajouter')}} {{\App\CentralLogics\translate('new')}} {{\App\CentralLogics\translate('produit')}} {{\App\CentralLogics\translate('composé')}}</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group lang_form" id="">
                <label class="input-label" for="exampleFormControlInput1">{{ \App\CentralLogics\translate('nom') }}</label>
                <input type="text" id="product-name" name="name[]" value="{{$prodcompose['name']}}" class="form-control" placeholder="produit" required>
            </div>
            <div class="form-group">
                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('prix')}}</label>
                <input type="number" id="product-price" value="{{$prodcompose['price']}}" min="0" step="0.01" name="price" class="form-control" placeholder="Ex : 10 TND" required>
            </div>
            <form enctype="multipart/form-data">
                <div class="form-group">

                    <label> {{\App\CentralLogics\translate('image')}}</label><small style="color: red">* ( {{\App\CentralLogics\translate('ratio')}} 1:1 )</small>
                    <div class="custom-file">
                        <input type="file" name="image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                        <label class="custom-file-label" for="image">{{\App\CentralLogics\translate('choisir')}} {{\App\CentralLogics\translate('fichier')}}</label>
                    </div>

                    <div class="col-12 from_part_2">
                        <div class="form-group">
                            <hr>

                            <img style="width: 40%;border: 1px solid; border-radius: 10px;" id="viewer" src="{{asset('storage/productcompose')}}/{{$prodcompose['image']}}" alt="image" />

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="content container-fluid">
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
                @foreach($ingcategories as $ingcategory)
                <option value="{{$ingcategory['id']}}">{{$ingcategory['name']}}</option>
                @endforeach
            </select>
            <div class="form-group">
                <label class="input-label" for="exampleFormControlSelect1">{{\App\CentralLogics\translate('ingredients')}}<span class="input-label-secondary"></span></label>
                <select name="ingredient_ids" onchange="handleChangeingrediants(event)" id="ingredients" class="form-control js-select2-custom" multiple="multiple">
                </select>
            </div>
        </div>

    </div>
    <div>
        <button id="addMore" class="btn btn-success btn-sm">Ajouter plus </button>
    </div>

    <form action="javascript:" method="post" id="product_form" enctype="multipart/form-data">
        @csrf

        <table class="table table-sm table-bordered" id="mytable" style=" display: none;">
            <thead>
                <tr>
                    <th>categorie</th>

                    <th>Requis</th>
                    <th>Ingredients</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="addRow" class="addRow">

            <tbody id="addRow1" class="addRow">
            </tbody>


        </table>
        <div class="mt-5">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>

    </form>
</div>
</div>
</div>
</div>
</body>

<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
<script src="{{asset('assets/admin/js/spartan-multi-image-picker.js')}}"></script>

<script>
    var ingredints = <?php echo $prodcompose->ingredients ?>;
    $(document).ready(function() {
        $('.table').show();
        var image

        var table2 = document.getElementById("addRow");
        ingredints.forEach(data => {
            var row = table2.insertRow(0);
            row.setAttribute("id", data.categories);

            var cell1 = row.insertCell(0);
            cell1.classList.add('categories1');

            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);

            cell1.innerHTML = data.categories;
            cell2.innerHTML = data.requis;
            cell3.innerHTML = data.ingredients;
            cell4.innerHTML += '<i class="removeaddmores" onclick="deleteIngrediantsbyid(' + data.categories + ')" style="cursor:pointer;color:red;"> Remove </i>';

            // allIngredinat.push(data1)
            // console.log(data1)
        });
    });

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
    var allIngredinat = [];
    var data = {
        requis: "",
        ingredients: "",
        categories: ""
    }

    function handleChange(e) {
        // console.log(e)
        getRequest('/admin/ingredient/get-categories?parent_id=' + e.target.value, 'ingredients');
        let values = Array.from(e.target.selectedOptions).map((value) => value.innerText).toString();
        console.log(values)

        data.categories = values
    }

    function handleChangeingrediants(e) {
        console.log(e)
        let values = Array.from(e.target.selectedOptions).map((value) => value.innerText).toString();
        console.log(values)

        let innerText = e.target[e.target.options.selectedIndex].innerText;
        data.ingredients = values
    }

    $(document).on('click', '#addMore', function(event) {

        $('.table').show();
        data.requis = $("#requis").val();
        var data1 = {
            requis: data.requis,
            ingredients: data.ingredients,
            categories: data.categories
        }

        var table = document.getElementById("addRow");

        if (allIngredinat.findIndex(res => res.categories === data1.categories) > -1) {
            var row1 = document.getElementById(data1.categories);
            row1.parentNode.removeChild(row1);
            allIngredinat = allIngredinat.filter(res => res.categories !== data1.categories)
            allIngredinat.push(data1)

            var row = table.insertRow(0);
            row.setAttribute("id", data.categories);

            var cell1 = row.insertCell(0);
            cell1.classList.add('categories1');

            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);

            cell1.innerHTML = data.categories;
            cell2.innerHTML = data.requis;
            cell3.innerHTML = data.ingredients;
            cell4.innerHTML += '<i class="removeaddmores" onclick="deleteIngrediants(' + data.categories + ')" style="cursor:pointer;color:red;"> Remove </i>';


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
            cell3.innerHTML = data.ingredients;
            cell4.innerHTML += '<i class="removeaddmores" onclick="deleteIngrediants(' + data.categories + ')" style="cursor:pointer;color:red;"> Remove </i>';

            allIngredinat.push(data1)
            console.log(data1)
        }



    });

    $(document).on('click', '.removeaddmore', function(event) {

        $(this).closest('#addRow').remove();
        // total_ammount_price();
        deleteIngrediants();

    });

    function deleteIngrediants(categorie) {
        console.log(categorie)
        let ingeredinstcopy = []
        console.log(allIngredinat)
        // var value = $(this).val();

        if (categorie.id.length != 0 && allIngredinat.findIndex(res => res.categories === categorie.id) > -1) {

            ingeredinstcopy.push(allIngredinat.find(res => res.categories === categorie.id))

            allIngredinat = allIngredinat.filter(res => res.categories !== categorie.id)
            var row2 = document.getElementById(categorie.id);
            console.log(row2)

            row2.parentNode.removeChild(row2);
            //allIngredinat = ingeredinstcopy;
        }
    }

    function deleteIngrediantsbyid(categorie) {
        console.log(categorie)
        let ingeredinstcopy = []
        console.log(ingredints)
        // var value = $(this).val();

        if (categorie.length != 0 && ingredints.findIndex(res => res.categories === categorie.id) > -1) {

            ingeredinstcopy.push(ingredints.find(res => res.categories === categorie.id))

            ingredints = ingredints.filter(res => res.categories !== categorie.id)
            var row2 = document.getElementById(categorie.id);
            console.log(row2)

            row2.parentNode.removeChild(row2);
            //allIngredinat = ingeredinstcopy;
        }
    }
    $('#product_form').on('submit', function() {
        // var formData = new FormData(this);

        let productName = document.getElementById("product-name").value
        let productPrice = document.getElementById("product-price").value

        //   let allIngredinat = document.getElementById("ingredients").value

        console.log(productName)
        console.log(productPrice)
        var formData = new FormData();
        formData.append("name", productName)
        formData.append("price", productPrice)
        formData.append("file", document.getElementById("customFileEg1").files[0])
        formData.append("ingredients", (JSON.stringify((allIngredinat).concat(ingredints))))

        console.log(ingredients)
        let data = {
            name: productName,
            price: productPrice,
            ingredients: allIngredinat
            // image: productImage
        }
        console.log(data)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('admin.productcompose.update',[$prodcompose['id']])}}",
            data: $('#product_form').serialize(),
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
                    toastr.success('produit composé ajouté avec succés!', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function() {
                        location.href = "{{route('admin.productcompose.list')}}";
                    }, 2000);
                }
            }

        });
    });
</script>

@endsection

@push('script_2')

<script src="{{asset('assets/admin/js/spartan-multi-image-picker.js')}}"></script>



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


<script src="{{asset('assets/admin')}}/js/tags-input.min.js"></script>
@endpush