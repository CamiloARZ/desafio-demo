<?php

namespace App\Http\Controllers;

use DataTables; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Parameter;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            
            $data = Parameter::all();

            return DataTables::of($data)
                    ->addColumn('action', 'parameter.datatable.action')
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        };

        return view('parameter.index');
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

        $rules = [
            'nombre'        => 'required|string|unique:parameters',
            'abreviatura'   => 'required|string',
            'unidad_medida' => 'required|string',
            'descripcion'   => 'nullable|string',
        ];


        try {

            $this->validate($request, $rules);

            $new = new Parameter;
                $new->nombre        = $request->nombre;
                $new->abreviatura   = $request->abreviatura;
                $new->unidad_medida = $request->unidad_medida;
                $new->descripcion   = $request->descripcion;
            $new->save();
            
            return response()->json(['success' => true], 200);

        }catch (ValidationException $exception) {

            return response()->json(['errors' => $exception->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter $parameter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $parameter = Parameter::find($request->id);

        if ($parameter) {
            return response()->json([ 'success' => true, 'data' => $parameter], 200);
        }

        return response()->json([ 'success' => false, 'error' => 'Not parameter'], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $rules = [
            'id'            => 'required',
            'nombre'        => 'required|string|unique:parameters,nombre,'.$request->id,
            'abreviatura'   => 'required|string',
            'unidad_medida' => 'required|string',
            'descripcion'   => 'nullable|string',
        ];

        try {

            $this->validate($request, $rules);

            $new =  Parameter::find($request->id);
                $new->nombre        = $request->nombre;
                $new->abreviatura   = $request->abreviatura;
                $new->unidad_medida = $request->unidad_medida;
                $new->descripcion   = $request->descripcion;
            $new->save();
            
            return response()->json(['success' => true], 200);

        }catch (ValidationException $exception) {

            return response()->json(['errors' => $exception->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function parameterDestroy(Request $request)
    {
        $deleted = Parameter::find($request->id);
        $deleted->delete();
        
        return response()->json(['success' => true ], 200);
    }
}
