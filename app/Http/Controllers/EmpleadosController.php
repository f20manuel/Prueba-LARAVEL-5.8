<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;
use App\Empresas;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresas::all();
        $empleados = Empleados::paginate(20);

        return view('empleados.index', compact([
            'empresas',
            'empleados'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'unique:empleados',
            'company_id' => 'required',
            'email' => 'required|unique:empleados|max:255|email'
        ]);

        $Empleado = new Empleados();
        $Empleado->first_name = $request->input('first_name');
        $Empleado->last_name = $request->input('last_name');
        $Empleado->email = $request->input('email');
        $Empleado->company_id = $request->input('company_id');
        $Empleado->phone = $request->input('phone');
        $Empleado->save();

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
        $empleado = Empleados::find($id);
        $empresas = Empresas::all();

        return view('empleados.edit', compact([
            'empleado',
            'empresas'
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
        $thisEmpleado = Empleados::where('id', $id)->first();
        if($thisEmpleado->email != $request->input('email'))
        {
            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone' => 'unique:empleados',
                'company_id' => 'required',
                'email' => 'required|unique:empleados|max:255|email'
            ]);
        }elseif($thisEmpleado->phone != $request->input('phone')){
            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'company_id' => 'required',
                'email' => 'required|max:255|email'
            ]);
        }else{
            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'company_id' => 'required',
                'email' => 'required|max:255|email'
            ]);
        }

        $empleado = Empleados::find($id);
        $empleado->first_name = $request->input('first_name');
        $empleado->last_name = $request->input('last_name');
        $empleado->email = $request->input('email');
        $empleado->company_id = $request->input('company_id');
        $empleado->phone = $request->input('phone');
        $empleado->save();

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
        $empleado = Empleados::find($id);
        $empleado->delete();

        return back();
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $empresas = Empresas::all();

        $empleados = Empleados::where('first_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%')
                            ->orWhere('phone', 'LIKE', '%'.$search.'%')
                            ->paginate(10);

        if($empleados){

            foreach($empleados as $empleado){
                $empresa = $empresas->where('id', $empleado->company_id)->first();
                echo '
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-2 align-self-center">
                                <img class="img-thumbnail" src="'.url("storage/".$empresa->logo).'" alt="Empleado de '.$empresa->name.'">
                            </div>
                            <div class="col-md-10 align-self-center">
                                <h4 class="my-0"><strong>'.$empleado->first_name.' '.$empleado->last_name.'</strong></h4>
                                <p class="my-0"><strong>Correo Electrónico:</strong> '.$empleado->email.'</p>
                                <p class="my-0"><strong>Teléfono:</strong> '.$empleado->phone.'</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="float-right">
                            <a href="'.route("empresas.edit", $empleado->id).'" class="btn btn-primary rounded" data-tooltip="tooltip" title="Editar"><i class="now-ui-icons ui-1_settings-gear-63"></i></a>
                            <a href="javascript:{}" onclick="document.RemoveCompany'.$empleado->id.'.submit();" data-tooltip="tooltip" title="Remover" class="btn btn-danger rounded"><i class="now-ui-icons ui-1_simple-remove"></i></a>
                            <form name="RemoveCompany'.$empleado->id.'" action="'.route('empresas.destroy', $empleado->id).'" method="POST">
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
                    <h1>No hay Empleados que conicidan con: "'.$search.'".</h1>
                </td>
            </tr>
            ';
        }
    }
}
