<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($menu, Request $request){
        $m = Menu::where('slug', $menu)->first();
        $title = $m->name;
        $products = Product
        ::with('menu')
        ->where('catid', $m->catid)
        ->where('parent_id', null)
        ->orderby('id', 'desc')
        ->paginate(2);

        $page = $request->query('page')??1;
        $trangtruoc = $products->previousPageUrl();
        $trangsau = $products->nextPageUrl();

        return view('product.index', compact('products', 'title', 'page', 'trangtruoc', 'trangsau'));
    }

    public function detail($menu, $slug, $id){
        $m = Menu::where('slug', $menu)->first();
        $title = $m->name;

        $product = Product::with('menu')->find($id);
        return view('product.detail', compact('product', 'title'));
    }
}
