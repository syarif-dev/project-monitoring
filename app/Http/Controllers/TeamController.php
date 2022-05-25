<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use File;
use RealRashid\SweetAlert\Facades\Alert;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'team' => Team::all()
        ];

        return view('team.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:teams',
        ]);

        if ($request->has('photo')) {
            $path = 'photo/';
            $image = $request['photo'];
            $new_image = time() . ' - ' . $image->getClientOriginalName();
            $image->move($path, $new_image);

            $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'photo' => $new_image,
            ];
        }else{
            $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            ];
        }
        // dd($data);

        Team::create($data);

        Alert::success('success', 'add team succesful');
        return redirect('team');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $data = [
            'team' => $team,
        ];

        return view('team.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $rule = [
            'name'      => 'required|max:255',
        ];

        if ($request->email) {
            if ($request->email != $team->email) {
                $rule['email'] = 'email|unique:teams';
            }
        }

        $request->validate($rule);

        $data = [];

        if ($request->has('photo')) {
            $path = 'photo/';
            \Illuminate\Support\Facades\File::delete($path . $request->photo);
            $image = $request['photo'];
            $new_image = time() . ' - ' . $image->getClientOriginalName();
            $image->move($path, $new_image);

            $data['name'] = $request['name'];

            if($request->email != $team->email){
                $data['email'] = $request['email'];
            }

            $data['photo'] = $new_image;
        }else{
            $data['name'] = $request['name'];

            if($request->email != $team->email){
                $data['email'] = $request['email'];
            }
            }

        $team->update($data);

        Alert::success('success', 'change team successful');
        return redirect(route('team.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();

        Alert::success('success', 'delete successful');
        return back();
    }
}
