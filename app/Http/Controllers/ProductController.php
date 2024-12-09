<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class ProductController extends Controller
{
    public function adminIndex()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin.index', compact('products'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'main_image' => 'required|image',
            'gallery_images.*' => 'image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $mainImagePath = $this->processImage($request->file('main_image'));

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'main_image' => $mainImagePath,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $this->processImage($image);
            }
            $product->update(['gallery_images' => json_encode($galleryPaths)]);
        }

        return redirect()->route('admin')->with('success', 'Товар дsобавлен!');
    }

    private function processImage($image)
    {
        $relativePath = $image->store('images', 'public');
        $fullPath = storage_path('app/public/' . $relativePath);

        $img = Image::fromFile($fullPath);

        $img->resize(960, 960, Image::Cover);
        $watermark = Image::fromFile(public_path('watermark.png'));
        $img->place($watermark, 0, 0, 100); // Смещение на 10px, прозрачность 50%

        $img->save($fullPath, 80);

        return 'storage/' . $relativePath;
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // $categories = Category::all();
        // return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required',
        //     'main_image' => 'image',
        //     'gallery_images.*' => 'image',
        //     'category_id' => 'required|exists:categories,id',
        // ]);

        // // Обновление основного изображения
        // if ($request->hasFile('main_image')) {
        //     Storage::disk('public')->delete($product->main_image);
        //     $product->main_image = $request->file('main_image')->store('images', 'public');
        // }

        // // Обновление галереи
        // if ($request->hasFile('gallery_images')) {
        //     foreach (json_decode($product->gallery_images) as $oldImage) {
        //         Storage::disk('public')->delete($oldImage);
        //     }
        //     $galleryImages = [];
        //     foreach ($request->file('gallery_images') as $image) {
        //         $galleryImages[] = $image->store('images', 'public');
        //     }
        //     $product->gallery_images = json_encode($galleryImages);
        // }

        // $product->update([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'category_id' => $request->category_id,
        // ]);

        // return redirect()->route('products.index')->with('success', 'Товар обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->main_image);
        foreach (json_decode($product->gallery_images) as $image) {
            Storage::disk('public')->delete($image);
        }

        $product->delete();

        return redirect()->route('admin')->with('success', 'Товар удален!');
    }
}
