<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Requests\BeritaCreate;
use DB;
class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Berita::with(['user'=>function($query){
            $query->select('id','name');
        }
        ])->get();
        
        return response()->json(['results'=>$data, 'message'=>'success', 'status'=>'success'],200);
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
    public function store(BeritaCreate $request)
    {

        $berita= $request->user()->berita()->create($request->json()->all());   
        return $berita;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $berita = Berita::with(['user'=>function($query){
            $query->select('id','name');
        }
        ])->where('id',$id)->get();
        if(count($berita)<=0){
            return response()->json(['results'=>null, 'message'=>'data tidak di temukan','status'=>'error'], 404 );
        }else{
            return response()->json(['results'=>$berita, 'message'=>'success', 'status'=>'success'],200);
        }
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
        //
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
