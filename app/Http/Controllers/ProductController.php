<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::all();
        // return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required',
        //     'main_image' => 'required|image',
        //     'gallery_images.*' => 'image',
        //     'category_id' => 'required|exists:categories,id',
        // ]);

        // // Загрузка основного изображения
        // $mainImagePath = $request->file('main_image')->store('images', 'public');

        // // Загрузка галереи
        // $galleryImages = [];
        // if ($request->hasFile('gallery_images')) {
        //     foreach ($request->file('gallery_images') as $image) {
        //         $galleryImages[] = $image->store('images', 'public');
        //     }
        // }

        // Product::create([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'main_image' => $mainImagePath,
        //     'gallery_images' => json_encode($galleryImages),
        //     'category_id' => $request->category_id,
        // ]);

        // return redirect()->route('products.index')->with('success', 'Товар добавлен!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
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
        // Storage::disk('public')->delete($product->main_image);
        // foreach (json_decode($product->gallery_images) as $image) {
        //     Storage::disk('public')->delete($image);
        // }

        // $product->delete();

        // return redirect()->route('products.index')->with('success', 'Товар удален!');
    }
}
