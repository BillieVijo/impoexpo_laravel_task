<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \AshAllenDesign\ShortURL\Models\ShortURL;
use \AshAllenDesign\ShortURL\Classes\Builder;

class ShortenerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urls = ShortURL::latest()->get();
        return view('dashboard', compact('urls'));
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $builder = new Builder();

        $shortURLObject = $builder->destinationUrl(request()->url)->make();
        $shortURL = $shortURLObject->default_short_url;

        return back()->with('success','URL shortened successfully. ');
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
        //
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
        $url = ShortURL::find($id);
        $url->url_key = request()->url;
        $url->destination_url = request()->destination;
        $url->save();

        return back()->with('success','URL updated successfully. ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $url = ShortURL::find($id);
        $url->delete();
        return back()->with('success','URL deleted successfully. ');
    }
}
