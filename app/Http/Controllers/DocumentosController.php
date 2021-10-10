<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use App\Models\Area;
use App\Models\Documento;

class DocumentosController extends Controller
{
    public function create() {
        $areas = Area::where('activo', 's')->get();
        return view('documentos.create', compact('areas'));
    }

    public function store(Request $request) {
        request()->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'area_id' => 'required',
        ]);
        
        if ($request->hasFile('nombre_archivo')) {
            $file = $request->file('nombre_archivo');
            $file_name = $file->getClientOriginalName();
            Storage::disk('local')->put('local/'.$file_name, File::get($file));

            $resp = Documento::create([
                'codigo' => $request['codigo'],
                'area_id' => $request['area_id'],
                'nombre' => $request['nombre'],
                'archivo' => $file_name,
                'fecha' => date('Y-m-d'),
                'activo' => 's',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
            DB::table('doc_ver')
            ->insert([
                'documentos_id' => $resp->id,
                'version_id' => 1,
            ]);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Por favor carga el archivo']);
        }
    }

    public function index() {
        $documentos = DB::table('area')
        ->join('documentos', 'documentos.area_id', 'area.id')
        ->join('doc_ver', 'doc_ver.documentos_id', 'documentos.id')
        ->join('version', 'version.id', 'doc_ver.version_id')
        ->select('documentos.id', 'documentos.nombre', 'documentos.archivo', 'area.nombre as area', 'documentos.codigo')
        ->where('version.activo', 's')
        ->where('documentos.activo', 's')
        ->get();
        return view('documentos.index', compact('documentos'));
    }

    public function file($file) {
        return Storage::download('local/'.$file);
    }

    public function edit($id) {
        $resp = Documento::
        join('area', 'area.id', 'documentos.area_id')
        ->select('area.nombre as area', 'documentos.*')
        ->findOrFail($id);
        return view('documentos.edit', compact('resp'));
    }

    public function update(Request $request, $id) {
        if ($request->hasFile('nombre_archivo')) {
            $file = $request->file('nombre_archivo');
            $file_name = $file->getClientOriginalName();
            Storage::disk('local')->put('local/'.$file_name, File::get($file));

            Documento::where('id', $id)
            ->update([
                'archivo' => $file_name,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
            $resp = DB::table('doc_ver')->where('documentos_id', $id)->get();
            $collection = Collection::make($resp);
            $vers = $collection->first();
            $num = $vers->version_id + 1;
            
            DB::table('doc_ver')
            ->where('documentos_id', $id)
            ->update([
                'version_id' => $num,
            ]);
            return Redirect::back()->withErrors(['msg' => 'Editado Correctamente']);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Por favor carga el archivo']);
        }
    }
}
