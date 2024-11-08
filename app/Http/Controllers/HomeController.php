<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Tag;
use App\Models\Like;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $races = Race::query()->orderBy('created_at', 'desc')->paginate(9);
        
        return view('pages.index', [
            'races' => $races,
        ]);
    }

    public function more(Request $request, $slug = null)
    {
        $categorySlug = $request->route()->parameter('category');
        $tagSlug = $request->route()->parameter('tag');
        $tags = Tag::all();
        $recentPosts = Post::latest()->take(4)->get();

        $category = $categorySlug ? Category::where('slug', $categorySlug)->first() : null;
        $tag = $tagSlug ? Tag::where('slug', $tagSlug)->first() : null;

        if ($category) {
            $posts = Post::whereHas('categories', fn($query) => $query->where('slug', $category->slug))
                ->with(['categories', 'user', 'tags'])->orderBy('created_at', 'desc')
                ->paginate(10);
            $filterTitle = 'Category: ' . $category->title;
        } elseif ($tag) {
            $posts = Post::whereHas('tags', fn($query) => $query->where('slug', $tag->slug))
                ->with(['categories', 'user', 'tags'])->orderBy('created_at', 'desc')
                ->paginate(10);
            $filterTitle = 'Tag: ' . $tag->title;
        } else {
            $posts = Post::with(['categories', 'user', 'tags'])->orderBy('created_at', 'desc')->paginate(10);
            $filterTitle = null;
        }

        return view('posts.more', [
            'posts' => $posts,
            'tags' => $tags,
            'recentPosts' => $recentPosts,
            'filterTitle' => $filterTitle,
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2',
            'requestType' => 'in:api,route',
        ]);

        $query = $request->get('query');

        $searchedPosts = Post::query()
            ->with(['categories', 'user'])
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                    ->orWhere('short_description', 'like', '%' . $query . '%');
            })
            ->paginate(10)->withQueryString();

        $searchedCategories = Category::where('title', 'like', '%' . $query . '%')
            ->select('id', 'title')
            ->get();

        $searchedTags = Tag::where('title', 'like', '%' . $query . '%')
            ->select('id', 'title')
            ->get();

        if ($request->get('requestType') === 'route') {
            $slider_posts = Post::where('visible_on_slider', 1)->get();
            $tags = Tag::get();
            $recentPosts = Post::latest()->take(4)->get();

            return view('posts.index', [
                'posts' => $searchedPosts,
                'recentPosts' => $recentPosts,
                'sliderPosts' => $slider_posts,
                'tags' => $tags,
            ]);
        }
        return response()->json([
            'posts' => $searchedPosts->items(),
            'categories' => $searchedCategories,
            'tags' => $searchedTags,
            'searchMessage' => 'Search results for: ' . $query,
            'pagination' => [
                'total' => $searchedPosts->total(),
                'current_page' => $searchedPosts->currentPage(),
                'last_page' => $searchedPosts->lastPage(),
            ]
        ]);
    }

    public function show(Post $post)
    {
        $post->load([
            'user',
            'categories',
            'tags',
            'comments' => fn($query) => $query->where('status', true),
            'comments.user'
        ]);
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function like(Request $request, Post $post)
    {
        $user = Auth::user();

        $existing_like = Like::where('post_id', $post->id)->where('user_id', $user->id)->first();

        if ($existing_like) {
            $existing_like->delete();
            return response()->json(['status' => 'unliked']);
        } else {
            Like::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
            ]);
            return response()->json(['status' => 'liked']);
        }
    }
}