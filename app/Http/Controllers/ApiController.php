<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa;
use App\Http\Resources\MahasiswaResource;

class ApiController extends Controller
{
    function getMahasiswa(){
        return MahasiswaResource::collection(Mahasiswa::paginate(2));
    }

    function storeMahasiswa(Request $request) {
        $request->validate([
            'name' => ['required', 'min:3'],
            'nim' => ['required', 'min:9', 'max:11'],
            'dateOfBirth' => ['required'],
            'selfPhoto' => 'required'
        ]);

        $now = now()->format('Y-m-d_H.i.s');
        $filename = $now.'_'.$request->file('selfPhoto')->getClientOriginalName();
        $request->file('selfPhoto')->storeAs('/public'.'/'.$filename);

        Mahasiswa::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'dateOfBirth' => $request->dateOfBirth,
            'selfPhoto' => $filename,
        ]);


        return 'Data Mahasiswa berhasil dibuat!';
    }

    function updateMahasiswa(Request $request, $id) {
        $mahasiswa = Mahasiswa::find($id);

        $request->validate([
            'name' => ['required', 'min:3'],
            'nim' => ['required', 'min:9'],
            'dateOfBirth' => ['required'],
            'selfPhoto' => 'required'
        ]);

        Storage::delete('/public'.'/'.$mahasiswa->selfPhoto);
        $now = now()->format('Y-m-d_H.i.s');
        $filename = $now.'_'.$request->file('selfPhoto')->getClientOriginalName();
        $request->file('selfPhoto')->storeAs('/public'.'/'.$filename);

        $mahasiswa->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'dateOfBirth' => $request->dateOfBirth,
            'selfPhoto' => $filename,
        ]);

        return 'Data mahasiswa berhasil diupdate!';
    }

    function deleteMahasiswa($id) {
        $mahasiswa = Mahasiswa::find($id);
        Storage::delete('/public'.'/'.$mahasiswa->selfPhoto);
        Mahasiswa::destroy($mahasiswa->id);
        return 'Data mahasiswa berhasil didelete!';
    }
}
