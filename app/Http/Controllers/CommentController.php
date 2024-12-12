<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'parent_id' => $request->parent_id ?? null,
        ]);

        return redirect()->back()->with('success', 'Комментарий добавлен!');
    }
}
