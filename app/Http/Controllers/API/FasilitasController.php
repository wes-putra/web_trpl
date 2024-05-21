<?php

namespace App\Http\Controllers\API;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class FasilitasController extends Controller
{
    public function index()
    {
        try {
            $fasilitas = Fasilitas::all();
            $url = '/admin/fasilitas';

            return response()->json([
                'status' => 'success',
                'message' => 'Get data fasilitas successful',
                'fasilitas' => $fasilitas,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get fasilitas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_fasilitas' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'keterangan' => 'nullable|string'
            ]);

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $FileName = uniqid('fasilitas_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/fasilitas'), $FileName);
                    $validatedData['gambar'] = $FileName;
                }
            }

            $fasilitas = Fasilitas::create($validatedData);
            $url = '/admin/fasilitas';

            return response()->json([
                'status' => 'success',
                'message' => 'Add fasilitas successful',
                'fasilitas' => $fasilitas,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add fasilitas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $fasilitas = Fasilitas::findOrFail($id);
            $url = sprintf('/admin/fasilitas/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get fasilitas successful',
                'fasilitas' => $fasilitas,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get fasilitas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $fasilitas = Fasilitas::findOrFail($id);

            $url = sprintf('/admin/fasilitas/edit/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get fasilitas successful',
                'fasilitas' => $fasilitas,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get fasilitas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $fasilitas = Fasilitas::findOrFail($id);

            $validatedData = $request->validate([
                'nama_fasilitas' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'keterangan' => 'nullable|string'
            ]);

            if ($request->hasFile('gambar')) {
                if ($fasilitas->gambar) {
                    File::delete(public_path('images/fasilitas/' . $fasilitas->gambar));
                }

                $file = $request->file('gambar');
                $FileName = uniqid('fasilitas_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/fasilitas'), $FileName);
                $validatedData['gambar'] = $FileName;
            }

            $fasilitas->update($validatedData);
            $url = '/admin/fasilitas';

            return response()->json([
                'status' => 'success',
                'message' => 'Update fasilitas successful',
                'fasilitas' => $fasilitas,
                'url' => $url,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update fasilitas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $fasilitas = Fasilitas::findOrFail($id);

            if ($fasilitas->gambar) {
                File::delete(public_path('images/fasilitas/' . $fasilitas->gambar));
            }

            $fasilitas->delete();
            $url = '/admin/fasilitas';

            return response()->json([
                'status' => 'success',
                'message' => 'Fasilitas has been removed',
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove fasilitas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
