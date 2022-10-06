<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Portfolio;
use App\Models\Categorypost;
use Illuminate\Http\Request;

class FrontendPagesController extends Controller
{
    // Show Home Page
    public function ShowFrontendHomePage()
    {
        return view('frontend.pages.home');
    }

    // Show About Page
    public function ShowFrontendAboutPage()
    {
        return view('frontend.pages.about');
    }

    // Show Contact Page
    public function ShowFrontendContactPage()
    {
        return view('frontend.pages.contact');
    }

    // Show Blog Page
    public function ShowFrontendBlogPage()
    {
        $posts = Post::latest() -> get();
        return view('frontend.pages.blog',[
            'posts'          => $posts
        ]);
    }

    // Show Contact Page
    public function ShowSinglePortfolioPage($slug)
    {
        $portfolio = Portfolio::where('slug', $slug) -> first();
        return view('frontend.pages.portfolio', [
               'portfolio'      => $portfolio 
        ]);
    }

    /**
     * Blog Post By Category
     */
    public function ShowBlogPostByCategory($slug)
    {
        $category =  Categorypost::where('slug', $slug) -> first();
        $posts = $category -> posts;
        return view('frontend.pages.blog',[
            'posts'          => $posts
        ]);
    }

    /**
     * Blog Post By Tag
     */
    public function ShowBlogPostByTag($slug)
    {
        $tag =  Tag::where('slug', $slug) -> first();
        $posts = $tag -> posts;
        return view('frontend.pages.blog',[
            'posts'          => $posts
        ]);
    }

     /**
     * Single Blog page
     */
    public function ShowSingleBlogPage($slug)
    {
        $single_blog    = Post::where('slug', $slug) -> first();
        return view('frontend.pages.single-blog',[
            'post'          => $single_blog
        ]);
    }
    
}
