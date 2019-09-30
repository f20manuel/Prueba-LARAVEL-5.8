<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresas;
use App\Empleados;
use Image;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresas::paginate(10);
        $empleados = Empleados::paginate(20);

        return view('empresas.index', compact([
            'empresas',
            'empleados'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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
            'name' => 'required|string',
            'email' => 'required|unique:empresas|max:255|email'
        ]);

        if($request->hasFile('logo')){
    		$logo = $request->file('logo');
            $filename = strtolower($request->input('name')) . '.' . $logo->getClientOriginalExtension();
    		Image::make($logo)->resize(100, 100)->save( public_path('storage/'.$filename));
        }

        $empresa = new Empresas();
        $empresa->name = $request->input('name');
        $empresa->email = $request->input('email');
        $empresa->logo = $filename;
        $empresa->website = $request->input('website');
        $empresa->save();

        return back();
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
        $empresa = Empresas::find($id);
        $empleados = Empleados::all();

        return view('empresas.edit', compact([
            'empresa',
            'empleados'
        ]));
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
        $thisEmpresa = Empresas::where('id', $id)->first();
        if($thisEmpresa->email != $request->input('email'))
        {
            $request->validate([
                'name' => 'required',
                'email' => 'email|unique:empresas|max:255'
            ]);
        }else{
            $request->validate([
                'name' => 'required',
                'email' => 'email|max:255'
            ]);
        }

        if($request->hasFile('logo')){
    		$logo = $request->file('logo');
            $filename = strtolower($request->input('name')) . '.' . $logo->getClientOriginalExtension();
    		Image::make($logo)->resize(100, 100)->save(public_path('storage/'.$filename));
        }

        $empresa = Empresas::find($id);
        $empresa->name = $request->input('name');
        $empresa->email = $request->input('email');
        if($request->hasFile('logo'))
        {
            $empresa->logo = $filename;
        }
        $empresa->website = $request->input('website');
        $empresa->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresas::find($id);
        $empresa->delete();

        return back();
    }
}
