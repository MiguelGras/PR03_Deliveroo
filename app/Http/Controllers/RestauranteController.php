<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RestauranteCrear;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Exception;

class RestauranteController extends Controller
{
    public function mostrarRestaurante(){
        $listaRestaurante = DB::table('tbl_restaurante')->join('tbl_tipo_cocina','tbl_restaurante.id','=','tbl_tipo_cocina.id')->select('*')->get();
        return view('mostrar', compact('listaRestaurante'));
        //return $listaPersona;
    }

    public function eliminarRestaurante($id){
        try{
            DB::beginTransaction();
            DB::table('tbl_tipo_cocina')->where('id','=',$id)->delete();
            DB::table('tbl_restaurante')->where('id','=',$id)->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('mostrar');
    }

    /*Crear*/
    public function crearRestaurante(){
        return view('crear');
    }
    
    public function crearRestaurantePost(RestauranteCrear  $request){
        $datos = $request->except('_token');
        $request->validate([
            'nombre'=>'required|string|max:30',
            'valoracion'=>'required|int|min:0|max:10',
            'tipo'=>'required|string|max:10|min:0',
            'foto'=>'required|mimes:jpg,png,jpeg,webp,svg'
        ]);
        if($request->hasFile('foto')){
            $datos['foto'] = $request->file('foto')->store('uploads','public');
        }else{
            $datos['foto'] = NULL;
        }
    
        try{
            DB::beginTransaction();
            $id = DB::table('tbl_tipo_cocina')->insertGetId(["foto"=>$datos['foto'],"tipo"=>$datos['tipo']]);
            DB::table('tbl_restaurante')->insertGetId(["nombre"=>$datos['nombre'],"valoracion"=>$datos['valoracion'],"id"=>$id]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('mostrar');
    }
    
    public function modificarRestaurante($id){
        $restaurante=DB::table('tbl_restaurante')->join('tbl_tipo_cocina','tbl_restaurante.id','=','tbl_tipo_cocina.id')->select()->where('tbl_restaurante.id','=',$id)->first();
        return view('modificar', compact('restaurante'));
    }
    
    public function modificarRestaurantePut(Request $request){
        $datos=$request->except('_token','_method','nombre','valoracion');
        if ($request->hasFile('foto')) {
            $foto = DB::table('tbl_tipo_cocina')->select('foto')->where('id','=',$request['id'])->first();
            if ($foto->foto != null) {
                Storage::delete('public/'.$foto->foto);
            }
            $datos['foto'] = $request->file('foto')->store('uploads','public');
        }else{
            $foto = DB::table('tbl_tipo_cocina')->select('foto')->where('id','=',$request['id'])->first();
            $datos['foto'] = $foto->foto;
        }
        $datosres=$request->except('_token','_method','foto','tipo');
        try {
            DB::beginTransaction();
            DB::table('tbl_restaurante')->where('id','=',$datosres['id'])->update($datosres);
            DB::table('tbl_tipo_cocina')->where('id','=',$datos['id'])->update($datos);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('mostrar');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurante $restaurante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurante $restaurante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurante $restaurante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurante $restaurante)
    {
        //
    }
}
