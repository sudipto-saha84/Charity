<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function create()
    {
        return view('backend.slider.add');
    }
    public function manage()
    {
        return view('backend.slider.index');
    }
    public function store(Request $request)
    {
       $req= $request->validate([
           'big_title'=>'required',
           'small_title'=>'required',
           'image'=>'required|image|max:50000'
        ]);
        if($request->hasFile('image')){
           $imageUrl= $request->file('image')->store('public/slider');
        }
        Slider::$image=$imageUrl;
        Slider::storeSlider($req);
        return redirect()->back()->with('success','Slider Add Successfully');
    }
    public  function  delete($id){

        $slider=Slider::findOrFail($id);
        if($slider->image){
            if(file_exists($slider->image)){
                unlink($slider->image);
            }
        }
        $slider->delete();
        return redirect()->back()->with('success','Slider Deleted Successfully');
    }
}
