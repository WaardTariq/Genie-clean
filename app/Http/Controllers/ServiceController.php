<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\Categories;
use App\Models\service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function serviceIndex()
    {
        $categories = Categories::where('status', 1)->get();
        $services = service::with('category')->where('status', 1)->get();

        foreach ($services as $service) {
            $included = explode(',', $service->whats_included);
        }
        return view('admin.service.all', compact('categories', 'services', 'included'));
    }

    public function serviceCreate()
    {
        $categories = Categories::where('status', 1)->get();
        return view('admin.service.add', compact('categories'));
    }

    public function serviceStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'max_duration' => 'required|integer',
            'min_duration' => 'required|integer',
            'max_price' => 'required|numeric',
            'min_price' => 'required|numeric',
            'image' => 'required|image',
            'multiple_image.*' => 'image',
        ]);

        // Create service
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->max_duration = $request->max_duration;
        $service->min_duration = $request->min_duration;
        $service->category_id = $request->category_id;
        $service->duration_unit = $request->duration_unit;
        $service->max_price = $request->max_price;
        $service->min_price = $request->min_price;
        $service->whats_included = implode(',', $request->included);

        // Single image upload
        $service->image = Helpers::customUpload('service-image', $request->file('image'));

        // Multiple images upload
        $multipleImages = [];
        if ($request->hasFile('multiple_image')) {
            foreach ($request->file('multiple_image') as $image) {
                $imagePath = Helpers::customUpload('services-multiple-images', $image);
                $multipleImages[] = $imagePath;
            }
        }
        $service->multiple_image = json_encode($multipleImages);
        $service->save();
        return redirect()->route('serviceIndex')->with('modal-success', 'Service Stored Successfully');
    }

    public function serviceEdit($serviceId)
    {
        $service = service::findOrFail($serviceId);
        $categories = Categories::where('status', 1)->get();
        return view('admin.service.edit', compact('service', 'categories'));
    }

    public function serviceDelete($serviceId)
    {
        $service = service::findOrFail($serviceId);
        $service->delete();
        return redirect()->back()->with('modal-success', 'Service Deleted Successfully');
    }
}

