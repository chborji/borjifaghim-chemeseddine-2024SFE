@extends('layouts.blank')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <div class="card mt-3">
                <div class="card-body text-center">
                    <?php $restaurant_logo = \App\Model\BusinessSetting::where(['key' => 'logo'])->first()->value; ?>
                    <img class="" style="width: 200px!important" src="{{asset('storage/restaurant/'.$restaurant_logo)}}" alt="Logo">
                    <br>
                    <hr>

                    <a class="btn btn-primary" href="{{route('admin.dashboard')}}">Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection