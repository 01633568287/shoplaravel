<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function send_mail(){
        $to_name= 'hay';
        $to_email= "duongquanga123@gmail.com";
        $data= array("name"=>"Mail từ tài khoản khách hàng","body"=>"Mail gửi ề vấn đề hàng hóa");
        Mail::send('pages.send_mail',$data,function($message) use($to_name,$to_email){
            $message->to($to_name)->subject('Test thử gửi mail google');
            $message->from($to_email,$to_name);
        });
        return Redirect('/')->with('message','');
    }
    public function index(Request $request){
        // //seo
        // $meta_desc="Chuyên bán những phụ kiện gym và thực phẩm dinh dưỡng, là 1 gymer ngoài việc có body đẹp cần là 1 người có ích trong xã hội: trí tuê, sức khỏe";
        // $meta_keywords="Thực phẩm chức năng, phụ kiện gym";
        // $meta_title="Thực phẩm bổ sung thể hình, phụ kiện tập GYM VIP";
        // $url_canonical=$request->url();

        // // end seo




        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        // $all_product=DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','desc')->get();

         $all_product=DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(4)->get();
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
        // ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function search(Request $request){
        $keywords=$request->keywords_submit;
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        // $all_product=DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','desc')->get();

         $search_product=DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }
}
