<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parameter;
use DataTables; 

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
        //
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
    public function update(Request $request, Parameter $parameter)
    {
        //
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
