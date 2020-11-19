<?php

namespace App\Http\Controllers;

use App\Banner;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function addBanner(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $banner = new Banner;
            $banner->title = $data['title'];
            $banner->link = $data['link'];

            if (empty($data['status'])){
                $status = '0';
            }else{
                $status = '1';
            }

            //Upload image
            if ($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()){

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/banner/'.$filename;
                    //Resize images
                    Image::make($image_tmp)->resize(1140,340)->save($banner_path);
                    //Store image name is products table
                    $banner->image = $filename;
                }
            }

            $banner->status = $status;
            $banner->save();
            return redirect()->back()->with('flash_message_success','Banner has been added successfully!');
        }
        return view('admin.banners.add-banner');
    }

    public function editBanner(Request $request,$id=null){
        if ($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if (empty($data['status'])){
                $status = '0';
            }else{
                $status = '1';
            }

            if (empty($data['title'])){
                $data['title'] = '';
            }
            if (empty($data['link'])){
                $data['link'] = '';
            }

            //Upload Image
            if ($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()){

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/banner/'.$filename;
                    //Resize images
                    Image::make($image_tmp)->resize(1140,340)->save($banner_path);
                }
            }else
            if (!empty($data['current_image'])){
                $filename = $data['current_image'];
            }else{
                $filename = '';
            }
            Banner::where('id',$id)->update(['status'=>$status,'title'=>$data['title'],'link'=>$data['link'],'image'=>$filename]);
            return redirect()->back()->with('flash_message_success','Banner has been edited successfully');
        }
        $bannerDetails = Banner::where('id',$id)->first();
        return view('admin.banners.edit_banner')->with(compact('bannerDetails'));
    }

    public function viewBanners(){
        $banners = Banner::get();
        return view('admin.banners.view_banners')->with(compact('banners'));
    }

    public function deleteBanner($id=null){
        Banner::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Banner has been deleted successfully!');
    }
}
