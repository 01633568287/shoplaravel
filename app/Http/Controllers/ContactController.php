<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class ContactController extends Controller
{
    public function lien_he(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $contact=Contact::where('info_id',1)->get();
        return view('pages.lienhe.contact')->with('category',$cate_product)->with('brand',$brand_product)->with('contact',$contact);
    }
    public function infomation(){
        $contact=Contact::where('info_id',1)->get();
        return view('admin.infomation.add_infomation')->with(compact('contact'));
    }
    public function update_info(Request $request,$info_id){
        $data=$request->all();
        $contact=Contact::find($info_id);
        $contact->info_contact=$data['info_contact'];
        $contact->info_map=$data['info_map'];
        
        $get_image=$request->file('info_image');
        $path='public/uploads/contact/';
        if($get_image){
            unlink($path.$contact->info_logo);
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo=$new_image;
          
        }
          $contact->save();
            return redirect()->back()->with('message','Cập nhật thông tin thành công');
        

    }
    public function save_info(Request $request){

        $data=$request->all();
        $contact= new Contact();
        $contact->info_contact=$data['info_contact'];
        $contact->info_map=$data['info_map'];
        
        $get_image=$request->file('info_image');
        $path='public/uploads/contact/';
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo=$new_image;
          
        }
          $contact->save();
            return redirect()->back()->with('message','Cập nhật thông tin thành công');
        
    }

}
