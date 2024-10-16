<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Group_Item;
use App\Models\SubItem;
use App\Models\Item;

class SiteMapController extends Controller
{
    public function index(Request $request){
        
        $menu = Group::where('module','=','menu-category')->where('status',1)->get();
        $article_category = Group::where('module','article-category')->where('status',1)->get();

        $article = Item::where('module','article')->where('status',1)->orderBy('created_at','desc')->get();

        $product_category = Group::where('module','product-category')->where('status',1)->get();

        $product = Item::where('module','product')->where('status',1)->orderBy('created_at','desc')->get();

        return response()->view('frontend.pages.sitemap.index', [
            'menu' => $menu,
            'article_category' => $article_category,
            'article' => $article,
            'product_category' => $product_category,
            'product' => $product,
        ])->header('Content-Type', 'text/xml');
    }
}
