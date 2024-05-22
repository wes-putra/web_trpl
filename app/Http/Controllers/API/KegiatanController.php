<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KegiatanController extends Controller
{
    public function index()
    {
        try {
            $kegiatan = Kegiatan::all();
            $url = '/admin/kegiatan';

            return response()->json([
                'status' => 'success',
                'message' => 'Get data kegiatan successful',
                'kegiatan' => $kegiatan,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get kegiatan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_kegiatan' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'keterangan' => 'nullable|string'
            ]);

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $FileName = uniqid('kegiatan_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/kegiatan'), $FileName);
                    $validatedData['gambar'] = $FileName;
                }
            }

            $kegiatan = Kegiatan::create($validatedData);
            $url = '/admin/kegiatan';

            return response()->json([
                'status' => 'success',
                'message' => 'Add kegiatan successful',
                'kegiatan' => $kegiatan,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add kegiatan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);
            $url = sprintf('/admin/kegiatan/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get kegiatan successful',
                'kegiatan' => $kegiatan,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get kegiatan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);

            $url = sprintf('/admin/kegiatan/edit/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get kegiatan successful',
                'kegiatan' => $kegiatan,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get kegiatan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);

            $validatedData = $request->validate([
                'nama_kegiatan' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'keterangan' => 'nullable|string'
            ]);

            if ($request->hasFile('gambar')) {
                if ($kegiatan->gambar) {
                    File::delete(public_path('images/kegiatan/' . $kegiatan->gambar));
                }

                $file = $request->file('gambar');
                $FileName = uniqid('kegiatan_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/kegiatan'), $FileName);
                $validatedData['gambar'] = $FileName;
            }

            $kegiatan->update($validatedData);
            $url = '/admin/kegiatan';

            return response()->json([
                'status' => 'success',
                'message' => 'Update kegiatan successful',
                'kegiatan' => $kegiatan,
                'url' => $url,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update kegiatan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);

            if ($kegiatan->gambar) {
                File::delete(public_path('images/kegiatan/' . $kegiatan->gambar));
            }

            $kegiatan->delete();
            $url = '/admin/kegiatan';

            return response()->json([
                'status' => 'success',
                'message' => 'kegiatan has been removed',
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove kegiatan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
