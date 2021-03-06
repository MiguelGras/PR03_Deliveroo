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

    public function mostrarRestaurante($id){
        $listaRestaurantes=DB::select('select tbl_restaurante.id,tbl_restaurante.nombre,tbl_restaurante.valoracion,tbl_foto.foto,tbl_restaurante.tiempo_medio,tbl_restaurante.descripcion from tbl_restaurante inner join tbl_foto on tbl_foto.restaurante_fk=tbl_restaurante.id where tbl_restaurante.id='.$id.';');
        return view('mostrarres', compact('listaRestaurantes'));
        
    }
    
    public function mostrarRestauranteAdmin(){
        $listaRestaurante=DB::select('select tbl_restaurante.id,tbl_restaurante.nombre,tbl_restaurante.valoracion,tbl_foto.foto,tbl_restaurante.tiempo_medio from tbl_restaurante inner join tbl_foto on tbl_foto.restaurante_fk=tbl_restaurante.id order by tbl_restaurante.id asc');
        return view('mostrar', compact('listaRestaurante'));
    }
    
    public function eliminarRestaurante($id){
        try{
            DB::beginTransaction();
            DB::table('tbl_tipo_cocina_restaurante')->where('restaurante_fk','=',$id)->delete();
            DB::table('tbl_tipo_servicio_restaurante')->where('restaurante_fk','=',$id)->delete();
            DB::table('tbl_foto')->where('restaurante_fk','=',$id)->delete();
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
        ]);
        if($request->hasFile('foto')){
            $datos['foto'] = $request->file('foto')->store('uploads','public');
        }else{
            $datos['foto'] = NULL;
        }
    
        try{
            DB::beginTransaction();
            $id = DB::table('tbl_restaurante')->insertGetId(["nombre"=>$datos['nombre'],"valoracion"=>$datos['valoracion']]);
            //DB::table('tbl_restaurante')->insertGetId(["id"=>$id]);
            $id2 = DB::table('tbl_restaurante')->max('id');
            DB::table('tbl_foto')->insertGetId(["foto"=>$datos['foto'],"restaurante_fk"=>$id2]);
            //DB::table('tbl_foto')->insertGetId(["foto"=>$datos['foto']]);
            DB::table('tbl_tipo_cocina_restaurante')->insertGetId(["tipo_cocina_fk"=>$datos['tipo'],"restaurante_fk"=>$id2]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('mostrar');
    }
    
    public function modificarRestaurante($id){
        $restaurante=DB::table('tbl_restaurante')->join('tbl_tipo_cocina','tbl_restaurante.id','=','tbl_tipo_cocina.id')->join('tbl_foto','tbl_restaurante.id','=','tbl_foto.restaurante_fk')->select()->where('tbl_restaurante.id','=',$id)->first();
        return view('modificar', compact('restaurante'));
    }
    
    public function modificarRestaurantePut(Request $request){
        $datos=$request->except('_token','_method','nombre','valoracion','tipo');
        if ($request->hasFile('foto')) {
            $foto = DB::table('tbl_foto')->select('foto')->where('restaurante_fk','=',$request['id'])->first();
            if ($foto->foto != null) {
                Storage::delete('public/'.$foto->foto);
            }
            $datos['foto'] = $request->file('foto')->store('uploads','public');
        }else{
            $foto = DB::table('tbl_foto')->select('foto')->where('restaurante_fk','=',$request['id'])->first();
            $datos['foto'] = $foto->foto;
        }
        $datosres=$request->except('_token','_method','foto','tipo');
        $datostipo=$request->except('_token','_method','foto','nombre','valoracion');
        try {
            DB::beginTransaction();
            DB::table('tbl_restaurante')->where('id','=',$datosres['id'])->update($datosres);
            DB::table('tbl_tipo_cocina')->where('id','=',$datostipo['id'])->update($datostipo);
            DB::table('tbl_foto')->where('restaurante_fk','=',$datos['id'])->update($datos);
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
/*Login*/
    public function formlogin(){
        return redirect('vistaclientes');
    }
    public function loginPost(Request $request){
        $datos_frm = $request->except('_token','_method');
        $email=$datos_frm['correo'];
        $password=$datos_frm['pass'];
        $password=md5($password);
        $users = DB::table("tbl_usuario")->where('correo','=',$email)->where('pass','=',$password)->count();
        $tipouser = DB::table("tbl_usuario")->where('tipo','=','Admin')->where('correo','=',$email)->count();
        if($users == 1 && $tipouser == 0){
            //Establecer la sesion
            $request->session()->put('email',$request->correo);
            return redirect('vistaclientes');
        }elseif($users == 1 && $tipouser == 1){
            $request->session()->put('email',$request->correo);
            return redirect('mostrar');
        }else{
            //Redirigir al login
            return redirect('vistaclientes');
        }
    }
    public function logout(Request $request){
        //Olvidas la sesion
        $request->session()->forget('email');
        //Eliminar todo
        $request->session()->flush();
        return redirect('vistaclientes');
    }
/*Mostrar*/
    public function vistaCliente(Request $request){ 
        $listaRestaurantes=DB::select('select tbl_restaurante.id,tbl_restaurante.nombre,tbl_restaurante.valoracion,tbl_foto.foto,tbl_restaurante.tiempo_medio from tbl_restaurante inner join tbl_foto on tbl_foto.restaurante_fk=tbl_restaurante.id');
        $listaTipo=DB::select('SELECT tipo from tbl_tipo_cocina;');
        //return response()->json($listaRestaurantes);
        return view('vistaclientes', compact('listaRestaurantes'), compact('listaTipo') );
    }
    public function vistaClientePost(Request $request){ 
        $listaRestaurantes=DB::select('select tbl_restaurante.id,tbl_restaurante.nombre,tbl_restaurante.valoracion,tbl_foto.foto,tbl_restaurante.tiempo_medio from tbl_restaurante inner join tbl_foto on tbl_foto.restaurante_fk=tbl_restaurante.id where tbl_restaurante.nombre like ?',['%'.$request->input('search').'%']);
        $listaTipo=DB::select('SELECT tipo from tbl_tipo_cocina;');
        return response()->json($listaRestaurantes);
        //return view('vistaclientes', compact('listaRestaurantes'), compact('listaTipo') );
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
