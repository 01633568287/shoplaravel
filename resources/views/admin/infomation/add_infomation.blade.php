 @extends('admin_layout')
 @section('admin_content')

 <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thông tin website
                </header>
                <div class="panel-body">
                    <?php
                        $message=Session::get('message');
                        if($message){
                            echo $message;
                            Session::put('message',null);
                        }


                    ?>
                    <div class="position-center">
                        @foreach($contact as $key =>$val)
                        <form role="form" action="{{URL::to('/update-info/'.$val->info_id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                          
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thông tin liên hệ</label><br>
                                <textarea name="info_contact" data-validation="length" data-validation-length="min6" data-validation-error-msg="Làm ơn điền ít nhất 6 ký tự" class="form-control" id="ckediter" style="width: 100%;"{{$val->info_contact}}>{{$val->info_contact}}</textarea>
                            </div>
                             <div class="form-group">
                                <label for="exampleInputPassword1">Bản đồ</label><br>
                                <textarea name="info_map" data-validation="length" data-validation-length="min6" data-validation-error-msg="Làm ơn điền ít nhất 6 ký tự" class="form-control" id="exampleInputPassword1" style="width: 100%;">{{$val->info_map}}</textarea>
                            </div>
                             <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh</label><br>
                                <input type="file" name="info_image" class="form-control" id="exampleInputEmail1" style="width: 100%;" >
                                 <img src="{{URL::to('public/uploads/contact/'.$val->info_logo)}}" height="100" width="100">
                            </div>
                            
                           
                            
                            <button type="submit" name="add_info" class="btn btn-info">Thêm thông tin</button>
                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>

@endsection