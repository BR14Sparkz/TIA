<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Slim;
use Auth;
use DB;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // using elequant not using DB
        $articles = Article::paginate(20);
        //$articles = Article::whereLive(1)->get();

        //get all + deleted
        //$articles = Article::withTrashed()->paginate(10);

        //get only deleted
        //$articles = Article::onlyTrashed()->paginate(10);

        // using DB
        //$articles = DB::table('articles')->get();
        //$articles = DB::table('articles')->whereLive(1)->get();

        return view('articles.index', compact('articles'));
    }

    public function welcome()
    {
        // using elequant not using DB
        $articles = Article::whereLive(1)->latest()->limit(6)->get();
        //$articles = Article::whereLive(1)->get();

        // using DB
        //$articles = DB::table('articles')->get();
        //$articles = DB::table('articles')->whereLive(1)->get();

        return view('welcome', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd($request);
        //get the image
        $uploadedImages = Slim::getImages();
        $imageName = $request->title;
        
        foreach($uploadedImages as $uploadedImage){

            //assign image blob to $data
            $imageData = $uploadedImage['output']['data'];            
            
            //name the file name
            $imageext = str_replace("image/", "", $uploadedImage['input']['type']); 
            $imageNameDirty = str_replace(' ', '_', $imageName);
            $imageNameClean = $imageNameDirty . "." . $imageext; 

            //set the store path
            $saveLocation = public_path('img/');

            //upload file ($data = imagedata, $name = filename, $location = storelocation, true/false = adding unique id to image name)
            $imageFile = Slim::saveFile($imageData, $imageNameClean, $saveLocation, true);             

            //save the article to the database
            Article::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'image' => "/img/" . $imageFile['name'],
                'content' => $request->content,            
                'post_on' => $request->post_on,
                'live' => $request->live,
            ]);
        }      

        //go home your drunk
        return redirect('/articles');

        /* 
        a method of saving (quick if all feilds match db columns)        
        Article::create($request->all());
        */ 

        /* 
        a method of saving (long hand if you like)
        $article = new Article;

        $article->user_id = Auth::user()->id;
        $article->content = $request->content;
        $article->live = (boolean)$request->live;
        $article->post_on = $request->post_on;

        $article->save();
        */      

        /* method of createing using DB 
        DB::table('articles')->insert($request->all());
        DB::table('articles')->insert($request->except('unwanted_field'));
        DB::table('articles')->insert([
            'user_id' => Auth::user()->id,
            'content' => $request->content,
            'live' => $request->live,
            'post_on' => $request->post_on   
        ]);
        */

        /* 
        another method for unpaired values with form input fields 
        Article::create([
            'user_id' => Auth::user()->id,
            'content' => $request->content,
            'live' => $request->live,
            'post_on' => $request->post_on   
        ]);
        */        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id); 

        dd($request);

        if  (!isset($request->live))
            $article->update(array_merge($request->all(), ['live' => false]));
        else
        $article->update($request->all());
        return view('articles.edit', compact('article'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        /* REMOVES FROM DATABASE */
        $article = Article::findOrFail($id);
        $article->delete();

        /* ALT METHOD
        Article::destroy($id);
        Article::destroy([1,2,3,4]);
        */

        /* SOFT DELETE 

        */

        return redirect('/articles');
    }

}
