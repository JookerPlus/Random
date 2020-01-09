<?php

namespace App\Http\Controllers;
use App\News;
use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all('name','id');
        return view('news.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tagsId = $request->get('tags');
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'image'=>'required',
            'data'=>'required'
        ]);
        $image = $request->file('image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $news = new News([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'image' => $new_name,
            'data' => $request->get('data'),
        ]);
        if(($request->get('new_tags'))) {
            $tags = new Tag(['name' => $request->get('new_tags')]);
            $tags->save();
        }
    /*    foreach ($tags as $value) {
            $tag_name = new Tag(['name' => $value]);
            $tag_name->save();
        };*/
        $news->save();
        $news->tags()->attach($tagsId);
        return redirect('/news')->with('success', 'News saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $tags= Tag::all('name','id');
        return view('news.edit', compact('news','tags'));
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
        $tagsId = $request->get('tags');
        $image_name = $request->hidden_image;
        $image = $request->file('image');
            $request->validate([
                'title' => 'required',
                'body' => 'required',
                'image' => 'required',
                'data' => 'required',
                'tags' => 'required'
            ]);
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);

        $news = News::find($id);
        $news->title =  $request->get('title');
        $news->body = $request->get('body');
        $news->image = $image_name;
        $news->data = $request->get('data');
        $news->save();
        $news->tags()->attach($tagsId);
        return redirect('/news')->with('success', 'News updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();

        return redirect('/news')->with('success', 'News deleted!');
    }
    public function tags(Request $request) {
        $tags = new Tag(['name' => $request->get('new_tags')]);
        $tags->save();
        return redirect('/news/create')->with('success', 'Tags updated!');
    }
    public function tagsDel($id)
    {
        $news = News::find($id);
        $news->tags()->detach();

        return redirect('/news/'.$id.'/edit')->with('success', 'Tags deleted!');
    }

}
