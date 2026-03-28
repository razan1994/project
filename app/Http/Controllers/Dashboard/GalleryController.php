<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        // Get or create the default gallery
        $gallery = Gallery::firstOrCreate(
            ['id' => 1],
            ['title' => 'Main Gallery', 'description' => 'Main Gallery']
        );

        $images = $gallery->images()->latest()->get();
        return view('dashboard.gallery.index', compact('gallery', 'images'));
    }

    public function uploadImages(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Get or create the default gallery
        $gallery = Gallery::firstOrCreate(
            ['id' => 1],
            ['title' => 'Main Gallery', 'description' => 'Main Gallery']
        );

        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $path = $image->store('gallery', 'public');
                $gallery->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    public function deleteImage($imageId)
    {
        $image = GalleryImage::findOrFail($imageId);

        // Delete the file from storage
        if(Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();
        return back()->with('success', 'Image deleted successfully!');
    }
}
