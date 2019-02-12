<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coa;

class ControllerCOA extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarCoa = Coa::all();

        return view('coa.list_coa', compact('daftarCoa'));
        // return 'test coyyyy';
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
        $postCoa = new Coa;
        $postCoa->kode_budget = $request->kode_coa;
        $postCoa->deskripsi = $request->deskripsi;
        $postCoa->save();

        return redirect()->route('coa.index');
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
        $data = Coa::where('id', $id)->get();

        return view('coa.edit_coa', compact('data'));
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
        $updateCoa = Coa::where('id', $id);
        $updateCoa->update([
            'kode_budget' => $request->kode_coa,
            'deskripsi' => $request->deskripsi
            ]);

        return redirect()->route('coa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
