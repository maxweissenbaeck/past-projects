<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;
use JWTAuth;

class SongController extends Controller
{
    const RULES = [
        'user_id' => 'required|integer',
        'title' => 'required',
        'length' => 'required|numeric|min:1',
        'artist' => 'required',
        'data' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Song::with('user')->paginate(5);
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
        $user = JWTAuth::parseToken()->toUser();
        $request['user_id'] = $user->id;

        $request->validate(self::RULES);
        $song = $user->songs()->save(Song::create($request->all()));

        $this->show($song->id);

        /*$request->validate(self::Rules);

        \App\Song::create($request->all());
        return 'Created Successfully';*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Song::with('user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->toUser();
        $song = Song::find($id);

        if ($song->user_id == $user->id) {
            $request->validate(self::RULES);
            $song->update($request->all());
        } else {
            return response(null, 401);
        }

        /*$request->validate(self::Rules);

        $song = \App\Song::find($id);
        $song->update($request->all());
        return 'Updated Successfully';*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->toUser();
        $song = Song::find($id);

        if ($song->user_id == $user->id) {
            Song::destroy($id);
        } else {
            return response(null, 401);
        }
    }
}
