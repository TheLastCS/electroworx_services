<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Appointment::all();
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
        $request->validate([
            'appType' => 'required',
            'dateTime' => 'required',
        ]);

        return $request->user()->create(['appType' => $request->appType,
                                    'dateTime' => $request->dateTime,
                                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Appointment::find($id);
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
        $appointment = Appointment::find($id);
        $appointment->update([
            'appType'=>$request->appType,
            'dateTime'=>$request->dateTime,
        ]);
        return $appointment;
    }

    /**
     * Change the specified resource delete_at.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $request = Appointment::findorFail($id);
        $request->delete();
        return response()->json(['delete_at' => $request->deleted_at], 200);
    }

    public function restore($id) {
        $request = Appointment::onlyTrashed()->findOrFail($id);
        $request->restore();
        return response()->json($request, 200);
    }

    public function onlyTrashed() {
        $request = Appointment::onlyTrashed()->get();
        return response()->json($request, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Appointment::destroy($id);
    }
}
