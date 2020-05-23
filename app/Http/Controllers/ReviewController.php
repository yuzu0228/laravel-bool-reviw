<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Http\Requests;
use Auth;
use App\User;
use App\Comment;
use App\Favorite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    
    public function index()
    {
    	$reviews = Review::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);
    	$count_all = Review::where('status', 1)->count();
    	$count_htmlcss = Review::where('kind', 'HTML&CSS')->count();
    	$count_javascript = Review::where('kind', 'JavaScript')->count();
    	$count_jquery = Review::where('kind', 'jQuery')->count();
    	$count_php = Review::where('kind', 'PHP')->count();
    	$count_wordpress = Review::where('kind', 'WordPress')->count();
    	$count_laravel = Review::where('kind', 'Laravel')->count();
    	$count_ruby = Review::where('kind', 'Ruby')->count();
    	$count_ruby_on_rails = Review::where('kind', 'Ruby on Rails')->count();
    	$count_etc = Review::where('kind', 'その他')->count();
              
    	return view('index', [
    	    'reviews' => $reviews,
    	    'count_all' => $count_all,
    	    'count_htmlcss' => $count_htmlcss,
    	    'count_javascript' => $count_javascript,
    	    'count_jquery' => $count_jquery,
    	    'count_php' => $count_php,
    	    'count_wordpress' => $count_wordpress,
    	    'count_laravel' => $count_laravel,
    	    'count_ruby' => $count_ruby,
    	    'count_ruby_on_rails' => $count_ruby_on_rails,
    	    'count_etc' => $count_etc,
    	]);
    }
    
    public function create()
    {
        return view('review');
    }
    
    public function store(Request $request)
    {
        $post = $request->all();
        
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'mimes:jpeg, png, jpg, gif, svg|max:2048',
            'url' => 'max:255',
            'price' => 'max:50000|nullable|numeric',
            'issued-year' => 'max:2020|nullable|numeric',
            'issued-month' => 'max:12|nullable|numeric',
            'issued-date' => 'max:31|nullable|numeric',
        ]);
        
        if(empty($request['url'])) {
            $request['url'] = 'no-data';
        }
        if(empty($request['price'])) {
            $request['price'] = 0;
        }
        if(empty($request['issued-year']) || empty($request['issued-month']) || empty($request['issued-date'])) {
            $request['issued-year'] = 0;
            $request['issued-month'] = 0;
            $request['issued-date'] = 0;
        }
        
        
        
        if($request->hasFile('image')) {
            $request->file('image')->store('/public/images');
            $data = [
                'user_id' => \Auth::id(),
                'title' => $post['title'],
                'body' => $post['body'],
                'image' => $request->file('image')->hashName(),
                'url' => $request['url'],
                'price' => $request['price'],
                'issued_year' => $request['issued-year'],
                'issued_month' => $request['issued-month'],
                'issued_date' => $request['issued-date'],
                'kind' => $request['kind'],
                'rating' => $post['rating'],
            ];
        } else {
            $data = [
                'user_id' => \Auth::id(),
                'title' => $post['title'],
                'body' => $post['body'],
                'url' => $request['url'],
                'price' => $request['price'],
                'issued_year' => $request['issued-year'],
                'issued_month' => $request['issued-month'],
                'issued_date' => $request['issued-date'],
                'kind' => $request['kind'],
                'rating' => $post['rating'],
            ];
        }
            
        Review::insert($data);
        
        return redirect('/')->with('flash_message', '投稿が完了しました。');
    }
    
    public function show(Request $request)
    {
        $review = Review::findOrFail($request['id']);
        
        $reviews_same_title = Review::where('title', $request['title'])->get();
        
        $comments = Comment::where('review_id', $request['id'])->get();
        $count_favorites = Favorite::where('review_id', $request['id'])->count();
        $count_comments = Comment::where('review_id', $request['id'])->count();
        $count_htmlcss = Review::where('kind', 'HTML&CSS')->count();
    	$count_javascript = Review::where('kind', 'JavaScript')->count();
    	$count_jquery = Review::where('kind', 'jQuery')->count();
    	$count_php = Review::where('kind', 'PHP')->count();
    	$count_wordpress = Review::where('kind', 'WordPress')->count();
    	$count_laravel = Review::where('kind', 'Laravel')->count();
    	$count_ruby = Review::where('kind', 'Ruby')->count();
    	$count_ruby_on_rails = Review::where('kind', 'Ruby on Rails')->count();
    	$count_etc = Review::where('kind', 'その他')->count();
        $params = [
            'review' => $review,
            'reviews_same_title' => $reviews_same_title,
            'comments' => $comments,
            'count_htmlcss' => $count_htmlcss,
    	    'count_javascript' => $count_javascript,
    	    'count_jquery' => $count_jquery,
    	    'count_php' => $count_php,
    	    'count_wordpress' => $count_wordpress,
    	    'count_laravel' => $count_laravel,
    	    'count_ruby' => $count_ruby,
    	    'count_ruby_on_rails' => $count_ruby_on_rails,
    	    'count_etc' => $count_etc,
            'count_favorites' => $count_favorites,
            'count_comments' => $count_comments,
        ];
        
        return view('show', $params);
    }
    
    public function sort($kind)
    {
        $reviewI = new Review();
        
        $review = Review::where('kind', $kind)->where('status', 1)->paginate(9);
        $count_htmlcss = Review::where('kind', 'HTML&CSS')->count();
    	$count_javascript = Review::where('kind', 'JavaScript')->count();
    	$count_jquery = Review::where('kind', 'jQuery')->count();
    	$count_php = Review::where('kind', 'PHP')->count();
    	$count_wordpress = Review::where('kind', 'WordPress')->count();
    	$count_laravel = Review::where('kind', 'Laravel')->count();
    	$count_ruby = Review::where('kind', 'Ruby')->count();
    	$count_ruby_on_rails = Review::where('kind', 'Ruby on Rails')->count();
    	$count_etc = Review::where('kind', 'その他')->count();
    	
    	$count_favorite_users = $reviewI->favorite_users()->get();
    	
    	
        return view('sort', [
            'reviews' => $review,
            'count_htmlcss' => $count_htmlcss,
    	    'count_javascript' => $count_javascript,
    	    'count_jquery' => $count_jquery,
    	    'count_php' => $count_php,
    	    'count_wordpress' => $count_wordpress,
    	    'count_laravel' => $count_laravel,
    	    'count_ruby' => $count_ruby,
    	    'count_ruby_on_rails' => $count_ruby_on_rails,
    	    'count_etc' => $count_etc,
    	    'count_favorite_users' => $count_favorite_users,
            ]);
    }
    
    public function admin($user_id)
    {
        $reviews = Review::where('user_id', $user_id)->where('status', 1)->paginate(9);
        $count_htmlcss = Review::where('kind', 'HTML&CSS')->count();
    	$count_javascript = Review::where('kind', 'JavaScript')->count();
    	$count_jquery = Review::where('kind', 'jQuery')->count();
    	$count_php = Review::where('kind', 'PHP')->count();
    	$count_wordpress = Review::where('kind', 'WordPress')->count();
    	$count_laravel = Review::where('kind', 'Laravel')->count();
    	$count_ruby = Review::where('kind', 'Ruby')->count();
    	$count_ruby_on_rails = Review::where('kind', 'Ruby on Rails')->count();
    	$count_etc = Review::where('kind', 'その他')->count();
        return view('admin', [
            'reviews' => $reviews,
    	    'count_htmlcss' => $count_htmlcss,
    	    'count_javascript' => $count_javascript,
    	    'count_jquery' => $count_jquery,
    	    'count_php' => $count_php,
    	    'count_wordpress' => $count_wordpress,
    	    'count_laravel' => $count_laravel,
    	    'count_ruby' => $count_ruby,
    	    'count_ruby_on_rails' => $count_ruby_on_rails,
    	    'count_etc' => $count_etc,
            ]);
    }
    
    public function delete($id)
    {
        Review::where('id', $id)->delete();
        return back()->with('flash_message', '投稿を削除しました。');
    }
    
    public function edit($id)
    {
        return view('edit', [
            'data' => Review::find($id)
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $reviewModel = Review::find($id);
        
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'mimes:jpeg, png, jpg, gif, svg|max:2048',
            'url' => 'max:255',
            'price' => 'max:50000|nullable|numeric',
            'issued-year' => 'max:2020|nullable|numeric',
            'issued-month' => 'max:12|nullable|numeric',
            'issued-date' => 'max:31|nullable|numeric',
        ]);
        
        if(empty($request['url'])) {
            $request['url'] = 'no-data';
        }
        if(empty($request['price'])) {
            $request['price'] = 0;
        }
        if(empty($request['issued-year']) || empty($request['issued-month']) || empty($request['issued-date'])) {
            $request['issued-year'] = 0;
            $request['issued-month'] = 0;
            $request['issued-date'] = 0;
        }
        
        if($request->hasFile('image')) {
            $request->file('image')->store('/public/images');
            $data = [
                'title' => $request['title'],
                'body' => $request['body'],
                'image' => $request->file('image')->hashName(),
                'url' => $request['url'],
                'price' => $request['price'],
                'issued_year' => $request['issued-year'],
                'issued_month' => $request['issued-month'],
                'issued_date' => $request['issued-date'],
                'kind' => $request['kind'],
                'rating' => $request['rating'],
            ];
        } else {
            $data = [
                'title' => $request['title'],
                'body' => $request['body'],
                'url' => $request['url'],
                'price' => $request['price'],
                'issued_year' => $request['issued-year'],
                'issued_month' => $request['issued-month'],
                'issued_date' => $request['issued-date'],
                'kind' => $request['kind'],
                'rating' => $request['rating'],
            ];
        }
        
        $reviewModel->fill($data)->save();
        return redirect('/')->with('flash_message', '投稿を編集しました。');
    }
    
    public function search(Request $request) {
        $reviews = Review::where('status', 1)->where('title','like','%' . $request['search-keyword'] . '%')
        ->orWhere('body','like','%' . $request['search-keyword'] . '%')
        ->orWhere('kind','like','%' . $request['search-keyword'] . '%')
        ->orderBy('created_at', 'DESC')->paginate(9);
    	$count_htmlcss = Review::where('kind', 'HTML&CSS')->count();
    	$count_javascript = Review::where('kind', 'JavaScript')->count();
    	$count_jquery = Review::where('kind', 'jQuery')->count();
    	$count_php = Review::where('kind', 'PHP')->count();
    	$count_wordpress = Review::where('kind', 'WordPress')->count();
    	$count_laravel = Review::where('kind', 'Laravel')->count();
    	$count_ruby = Review::where('kind', 'Ruby')->count();
    	$count_ruby_on_rails = Review::where('kind', 'Ruby on Rails')->count();
    	$count_etc = Review::where('kind', 'その他')->count();
              
    	return view('search', [
    	    'reviews' => $reviews,
    	    'count_htmlcss' => $count_htmlcss,
    	    'count_javascript' => $count_javascript,
    	    'count_jquery' => $count_jquery,
    	    'count_php' => $count_php,
    	    'count_wordpress' => $count_wordpress,
    	    'count_laravel' => $count_laravel,
    	    'count_ruby' => $count_ruby,
    	    'count_ruby_on_rails' => $count_ruby_on_rails,
    	    'count_etc' => $count_etc,
    	    'keyword' => $request['search-keyword']
    	]);
    }
}
