<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PrestasiController extends Controller
{
    public function index()
    {
        try {
            $prestasi = Prestasi::all();
            $url = '/admin/prestasi';

            return response()->json([
                'status' => 'success',
                'message' => 'Get data prestasi successful',
                'prestasi' => $prestasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get prestasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_prestasi' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'keterangan' => 'nullable|string'
            ]);

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $FileName = uniqid('prestasi_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/prestasi'), $FileName);
                    $validatedData['gambar'] = $FileName;
                }
            }

            $prestasi = Prestasi::create($validatedData);
            $url = '/admin/prestasi';

            return response()->json([
                'status' => 'success',
                'message' => 'Add prestasi successful',
                'prestasi' => $prestasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add prestasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);
            $url = sprintf('/admin/prestasi/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get prestasi successful',
                'prestasi' => $prestasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get prestasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);

            $url = sprintf('/admin/prestasi/edit/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get prestasi successful',
                'prestasi' => $prestasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get prestasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);

            $validatedData = $request->validate([
                'nama_prestasi' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'keterangan' => 'nullable|string'
            ]);

            if ($request->hasFile('gambar')) {
                if ($prestasi->gambar) {
                    File::delete(public_path('images/prestasi/' . $prestasi->gambar));
                }

                $file = $request->file('gambar');
                $FileName = uniqid('prestasi_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/prestasi'), $FileName);
                $validatedData['gambar'] = $FileName;
            }

            $prestasi->update($validatedData);
            $url = '/admin/prestasi';

            return response()->json([
                'status' => 'success',
                'message' => 'Update prestasi successful',
                'prestasi' => $prestasi,
                'url' => $url,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update prestasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);

            if ($prestasi->gambar) {
                File::delete(public_path('images/prestasi/' . $prestasi->gambar));
            }

            $prestasi->delete();
            $url = '/admin/prestasi';

            return response()->json([
                'status' => 'success',
                'message' => 'prestasi has been removed',
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove prestasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
