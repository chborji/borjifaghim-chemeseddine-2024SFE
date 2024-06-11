<!-- Header -->
<div class="card-header">
    <h5 class="card-header-title">
        <i class="tio-align-to-top"></i> {{\App\CentralLogics\translate('Produits les plus vendus')}}
    </h5>
    <i class="tio-gift" style="font-size: 45px"></i>
</div>
<!-- End Header -->

<!-- Body -->
<div class="card-body">
    <div class="row">
        @foreach($top_sell as $key=>$item)
        @if(isset($item->product))
        <div class="col-md-4 col-6 mt-2">
            <div class="grid-card">
                <label class="label_1">Vendu : {{$item['count']}}</label>
                <center class="mt-4">
                    <img style="height: 90px" src="{{ asset('storage/product').'/'.$item->product->image  ?? '' }}"alt="{{$item->product->name}} image">
                </center>
                <div class="text-center mt-2">
                    <span class="" style="font-size: 10px">{{substr($item->product['name'],0,20)}} {{strlen($item->product['name'])>20?'...':''}}</span>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<!-- End Body -->