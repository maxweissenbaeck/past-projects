<?php

namespace App\Http\Controllers;

use App\Bug;
use Illuminate\Http\Request;
use JWTAuth;
use phpDocumentor\Reflection\Types\Boolean;

class BugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Bug::with('user')->paginate(5);
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

        //$request->validate(self::Rules);
        $user->bugs()->save(Bug::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bug $bug)
    {
        /*Wenn nur Besitzer das Objekt bearbeiten darf

        $user = JWTAuth::parseToken()->toUser();

        if($bug->user_id == $user->id) {
            return Bug::with('comments', 'user')->find($bug->id);
        }else{
            return response('Not Authorized!', 401);
        }*/

        return Bug::with('comments', 'user')->find($bug->id);
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
    public function update(Request $request, Bug $bug)
    {
        $user = JWTAuth::parseToken()->toUser();
        $bug = Bug::find($bug->id);

        if($bug->user_id == $user->id) {
            //$request->validate(self::Rules);
            $bug->update($request->all());
        }else{
            return response('Not Authorized!', 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->toUser();
        $bug = Bug::find($id);

        if($bug->user_id == $user->id) {
            Bug::destroy($id);
            //Bug:find($id)->destroy();
        }else{
            return response('Not Authorized!', 401);
        }
    }
}
