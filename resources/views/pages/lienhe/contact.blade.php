@extends('layouts')
@section('content')

 <div class="features_items"><!--features_items-->
    <h2 class="title text-center">Liên hệ với chúng tôi</h2>
    <div class="row">
        @foreach($contact as $key =>$val)
        <div class="col-md-12">
           {!!$val->info_contact!!}
           
           
        </div>
        <div class="col-md-12">
            <h4>Bản đồ</h4>
             {!!$val->info_map!!}
        </div>
    </div>
    @endforeach
    
</div><!--features_items-->

@endsection