<?php

namespace App\Http\Controllers;

use App\Match;
use Illuminate\Http\Request;
use App\User;
use Notification;
use App\Notifications\MatchConfirm;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $matches = Match::where('user_id_1', $user_id)->orWhere('user_id_2', $user_id)->paginate(10);

        return view('matches.index', compact('matches'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $match = Match::find($id);
        $userMatch = $this->getUserMatch($match);
        return view('matches.show', compact('userMatch', 'match'));
    }

    /**
     * Get the matched user
     *
     * @param Match $match
     * @return User
     */
    private function getUserMatch($match){
        $user = auth()->user();
        $user1 = $match->user1()->first();
        $user2 = $match->user2()->first();
        return $user->id != $user1->id ? $user1 : $user2;
    }

    public function confirm(Request $request, $id)
    {
        $match = Match::find($id);
        $user = auth()->user();
        $userMatch = $this->getUserMatch($match);

        if ($match->user_id_1 == $user->id){
            $match->user_id_1_confirm = 1;
            $match->user_id_1_message = $request->input('message');
        }
        else{
            $match->user_id_2_confirm = 1;
            $match->user_id_2_message = $request->input('message');
        }

        $userMatch->notify(new MatchConfirm($user, $match, "El usuario {$user->name} ha aceptado compartir su informacion"));

        $match->save();
        return redirect('/match/' . $match->id)->with('success', 'Confirmado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        //
    }
}
