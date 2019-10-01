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

    public function search(Request $request)
    {
        $search = $request->input('search');

        $empleados = Empleados::all();

        $empresas = Empresas::where('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%')
                            ->orWhere('website', 'LIKE', '%'.$search.'%')
                            ->paginate(10);

        if($empresas){

            foreach($empresas as $empresa){

                if($empleados->count() > 0)
                {
                    $employers = $empleados->where('company_id', $empresa->id);
                    $employerslist = $employers->count();
                }else{
                    $employerslist = 0;
                }

                echo '
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-2 align-self-center">
                                    <img class="img-thumbnail" src="'.url("storage/".$empresa->logo).'" alt="Empresa '.$empresa->name.'">
                                </div>
                                <div class="col-md-10 align-self-center">
                                    <h4 class="my-0"><strong>'.$empresa->name.'</strong></h4>
                                    <p class="my-0"><strong>Correo Electrónico:</strong> '.$empresa->email.'</p>
                                    <p class="my-0"><strong>Empleados:</strong> '.$employerslist.'</p>
                                    <p class="my-0"><strong>Sitio Web:</strong> '.$empresa->website.'</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="float-right">
                                <a href="'.url("empresas/".$empresa->id).'" class="btn btn-primary rounded" data-tooltip="tooltip" title="Editar"><i class="now-ui-icons ui-1_settings-gear-63"></i></a>
                                <a href="javascript:{}" onclick="document.RemoveCompany'.$empresa->id.'.submit();" data-tooltip="tooltip" title="Remover" class="btn btn-danger rounded"><i class="now-ui-icons ui-1_simple-remove"></i></a>
                                <form name="RemoveCompany'.$empresa->id.'" action="'.url("empresas/".$empresa->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="SjMhnltUWJTkL3Joqw8CFVdFjewHkiXN2MruwdBf">
                                </form>
                            </div>
                        </td>
                    </tr>
                ';
            }
        }else{
            echo '
            <tr>
                <td>
                    <h1>No hay Empresas que conicidan con: "'.$search.'".</h1>
                </td>
            </tr>
            ';
        }
    }
}
