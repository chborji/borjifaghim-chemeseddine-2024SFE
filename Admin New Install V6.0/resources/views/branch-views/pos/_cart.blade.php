    
    
    
  
  <style>
        .table-cart {
            width: 100%;
            margin: 10px;
            border-collapse: separate;
            border-spacing: 0 10px; /* Margin between rows */
        
        }
        .table-cart th, .table-cart td {
            padding: 15px;

             border: none;
        }
        .table-cart th {
            text-align: center;
        }
        .table-cart td {
            text-align: center;
            padding: 0; /* Remove padding from td to rely on inner div */
        }
        .row-container {
            background-color: #F5F7F8;
            border-radius: 10px;
            overflow: hidden;
            padding: 10px;
            width: 100%;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;  
             }
        .row-container td {

            border: none;/* Remove borders from inner td elements */
        }


    </style>
    <div class="d-flex flex-row " style="max-height: 360px; overflow-y: scroll;">
        <table class="table-cart">
            <thead class="text-muted">
                <tr>
                 {{--  <th scope="col">{{\App\CentralLogics\translate('article')}}</th>
                    <th scope="col" class="text-center">{{\App\CentralLogics\translate('qty')}}</th>
                    <th scope="col">{{\App\CentralLogics\translate('prix')}}</th>
                    <th scope="col">{{\App\CentralLogics\translate('supprimer')}}</th>  --}}
                </tr>
            </thead>
            <tbody>
            <?php
                $subtotal = 0;
                $addon_price = 0;
                $discount = 0;
                $discount_type = 'amount';
                $discount_on_product = 0;
                $total_tax = 0;
            ?>
            @if(session()->has('cart') && count( session()->get('cart')) > 0)
                <?php
                    $cart = session()->get('cart');
                    if(isset($cart['discount']))
                    {
                        $discount = $cart['discount'];
                        $discount_type = $cart['discount_type'];
                    }
                ?>
                @foreach(session()->get('cart') as $key => $cartItem)
                @if(is_array($cartItem))
                    <?php
                    $product_subtotal = ($cartItem['price'])*$cartItem['quantity'];
                    $discount_on_product += ($cartItem['discount']*$cartItem['quantity']);
                    $subtotal += $product_subtotal;
                    $addon_price += $cartItem['addon_price'];

                    //tax calculation
                    $product = \App\Model\Product::find($cartItem['id']);
                    $total_tax += \App\CentralLogics\Helpers::tax_calculate($product, $cartItem['price'])*$cartItem['quantity'];

                    ?>
                    <tr>
            <td colspan="5">
                            <div class="row-container">
                                <table style="width: 100%;" class="table">
                    <tr>

                        <td class="media align-items-center" >

                            <img class="avatar " src="{{asset('storage/product')}}/{{$cartItem['image']}}" alt="{{$cartItem['name']}} image">
                            <div class="media-body" >
                                <h5 class="text-hover-primary mb-0">{{Str::limit($cartItem['name'], 10)}}</h5>
                                <small>{{Str::limit($cartItem['variant'], 20)}}</small>
                              
                                
                                    <div>
                                        {{$product_subtotal . ' ' . \App\CentralLogics\Helpers::currency_symbol()}}
                                    </div> <!-- price-wrap .// -->
                            </div>
                        </td>
                         <td style="width: 25%;">
                             <small>
                                        @php($add_on_qtys=$cartItem['add_on_qtys'])
                                        @foreach($cartItem['add_ons'] as $key2 =>$id)
                                            @php($addon=\App\Model\AddOn::find($id))
                                            @if($key2==0)<strong><u>Supp: </u></strong>@endif
    
                                            @if($add_on_qtys==null)
                                                @php($add_on_qty=1)
                                            @else
                                                @php($add_on_qty=$add_on_qtys[$key2])
                                            @endif
    
                                            <div>
                                                <span>{{$addon['name']}} :  </span>
                                                <br>
                                                <span class="font-weight-bold ">
                                                        {{$add_on_qty}} x {{$addon['price']}} {{\App\CentralLogics\Helpers::currency_symbol()}}
                                                    </span>
                                                    
                                            </div>
                                            
                                        @endforeach 
                                    </small> 
                        </td> 
                        <td style="text-align: end;">
                        <a href="javascript:removeFromCart({{$key}})" class="btn btn-sm btn-outline-danger"> <i class="tio-delete-outlined"></i></a>
                     <br>
                     <br>
                            <input type="number"  data-key="{{$key}}" style="width:30px;text-align:center;" class="circular-input"value="{{$cartItem['quantity']}}" min="1" onkeyup="updateQuantity(event)">
                           
                        </td>
                    </div>
                </tr>
            </table>
        </div>
    </td>
    </tr>
                   
                @endif
                @endforeach
            @endif
  
            </tbody>
        </table>
    </div>

    <?php
        $total = $subtotal+$addon_price;
        $discount_amount = ($discount_type=='percent' && $discount>0)?(($total * $discount)/100):$discount;
        $discount_amount += $discount_on_product;
        $total -= $discount_amount;

        $extra_discount = session()->get('cart')['extra_discount'] ?? 0;
        $extra_discount_type = session()->get('cart')['extra_discount_type'] ?? 'amount';
        if($extra_discount_type == 'percent' && $extra_discount > 0){
            $extra_discount =  (($total+$total_tax)*$extra_discount) / 100;
        }
        if($extra_discount) {
            $total -= $extra_discount;
        }
    ?>
    <div class="box p-3">
        <dl class="row text-sm-left">

            <dt  class="col-sm-6">{{\App\CentralLogics\translate('Supplément')}} : </dt>
            <dd class="col-sm-6 text-right">{{$addon_price . ' ' . \App\CentralLogics\Helpers::currency_symbol()}}</dd>

            <dt  class="col-sm-6">{{\App\CentralLogics\translate('sub_total')}} : </dt>
            <dd class="col-sm-6 text-right">{{($subtotal+$addon_price) . ' ' . \App\CentralLogics\Helpers::currency_symbol()}}</dd>


            <dt  class="col-sm-6">{{\App\CentralLogics\translate('Produit')}} {{\App\CentralLogics\translate('discount')}} :</dt>
            <dd class="col-sm-6 text-right">- {{round($discount_amount,2) . ' ' . \App\CentralLogics\Helpers::currency_symbol()}}</dd>

            {{-- <dt  class="col-sm-6">{{\App\CentralLogics\translate('extra')}} {{\App\CentralLogics\translate('discount')}} :</dt>
            <dd class="col-sm-6 text-right"><button class="btn btn-sm" type="button" data-toggle="modal" data-target="#add-discount"><i class="tio-edit"></i></button>- {{$extra_discount . ' ' . \App\CentralLogics\Helpers::currency_symbol()}}</dd> --}}

            <dt  class="col-sm-6">{{\App\CentralLogics\translate('tax')}} : </dt>
            <dd class="col-sm-6 text-right">{{round($total_tax,2) . ' ' . \App\CentralLogics\Helpers::currency_symbol()}}</dd>

            <dt  class="col-sm-6">{{\App\CentralLogics\translate('total')}} : </dt>
            <dd class="col-sm-6 text-right h4 b">{{round($total+$total_tax, 2) . ' ' . \App\CentralLogics\Helpers::currency_symbol()}}</dd>
        </dl>
        <form action="{{ route('branch.pos.order') }}" method="POST" id="order-form">
            @csrf
            <input type="hidden" name="status" id="order-status" value="confirmed">
        <div class="row">
            <div class="col-md-6">
               <a href="#" class="btn btn-sm btn-block"  style="background-color:#B33030; color: white;"    onclick="emptyCart()"><i
                        class="fa fa-times-circle "></i> {{\App\CentralLogics\translate('Annuler')}} </a> 
                       {{--  <button type="submit" onclick="setOrderStatus('canceled')"class="btn btn-danger btn-sm btn-block" >
                            <i class="fa fa-times-circle "></i>
                            {{\App\CentralLogics\translate('Cancel')}} </button> --}}
            </div>
            <div class="col-md-6">
                <button type="button" {{-- onclick="setOrderStatus('confirmed')" --}} class="btn btn-sm btn-block" style="background-color:#A1B57D; color: white;" data-toggle="modal" data-target="#paymentModal"><i class="fa fa-shopping-bag"></i>
                    {{\App\CentralLogics\translate('Commander')}} </button>
            </div>
        </div>
    </form>
    </div>

    <div class="modal fade" id="add-discount" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{\App\CentralLogics\translate('update_discount')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('branch.pos.discount')}}" method="post" class="row">
                        @csrf
                        <div class="form-group col-sm-6">
                            <label for="">{{\App\CentralLogics\translate('discount')}}</label>
                            <input type="number" class="form-control" name="discount" value="{{ session()->get('cart')['extra_discount'] ?? 0 }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">{{\App\CentralLogics\translate('type')}}</label>
                            <select name="type" class="form-control">
                                <option
                                    value="amount" {{$extra_discount_type=='amount'?'selected':''}}>{{\App\CentralLogics\translate('amount')}}
                                    ({{\App\CentralLogics\Helpers::currency_symbol()}})
                                </option>
                                <option
                                    value="percent" {{$extra_discount_type=='percent'?'selected':''}}>{{\App\CentralLogics\translate('percent')}}
                                    (%)
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-sm-12">
                            <button class="btn btn-sm btn-primary" type="submit">{{\App\CentralLogics\translate('submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-tax" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{\App\CentralLogics\translate('update_tax')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('branch.pos.tax')}}" method="POST" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="">{{\App\CentralLogics\translate('tax')}} (%)</label>
                            <input type="number" class="form-control" name="tax" min="0">
                        </div>

                        <div class="form-group col-sm-12">
                            <button class="btn btn-sm btn-primary" type="submit">{{\App\CentralLogics\translate('submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="paymentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{\App\CentralLogics\translate('payment')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('branch.pos.order')}}" id='order_place' method="post" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label class="input-label" for="">amount({{\App\CentralLogics\Helpers::currency_symbol()}})</label>
                            <input type="number" class="form-control" name="amount" min="0" step="0.01" value="{{round($total+$total_tax, 2)}}" disabled>
                        </div>
                        <div class="form-group col-12">
                            <label class="input-label" for="">{{\App\CentralLogics\translate('type')}}</label>
                            <select name="type" class="form-control">
                                <option value="cash">{{\App\CentralLogics\translate('cash')}}</option>
                                <option value="card">{{\App\CentralLogics\translate('card')}}</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <button class="btn btn-sm btn-primary" type="submit">{{\App\CentralLogics\translate('submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setOrderStatus(status) {
            document.getElementById('order-status').value = status;
        }
    </script>
    