<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function createBanner()
    {
        return view('admin.banner.add');
    }

    public function storeBanner(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'discount' => 'required',
            'image' => 'required',
        ]);

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->discount = $request->discount;
        $banner->image = Helpers::customUpload('banner-image', $request->image);
        $banner->description = $request->description;
        $banner->save();

        return redirect()->back()->with('modal-success', 'Banner Stored Successfully');
    }
}
