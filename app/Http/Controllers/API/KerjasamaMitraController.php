<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\KerjasamaMitra;

class KerjasamaMitraController extends Controller
{
    public function index()
    {
        try {
            $mitras = KerjasamaMitra::all();
            $url = '/admin/kerjasama-mitra';

            return response()->json([
                'status' => 'success',
                'message' => 'Data Kerjasama Mitra berhasil diambil',
                'mitras' => $mitras,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data Kerjasama Mitra'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_mitra' => 'required|string|max:255',
                'logo_mitra' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'alamat_mitra' => 'required|string|max:255'
            ]);

            if ($request->hasFile('logo_mitra')) {
                $file = $request->file('logo_mitra');
                if ($file->isValid()) {
                    $FileName = uniqid('mitra_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/mitra'), $FileName);
                    $validatedData['logo_mitra'] = $FileName;
                }
            }

            $mitra = KerjasamaMitra::create($validatedData);
            $url = '/admin/kerjasama-mitra';

            return response()->json([
                'status' => 'success',
                'message' => 'Add Kerjasama Mitra successful',
                'mitra' => $mitra,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add Kerjasama Mitra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $mitra = KerjasamaMitra::findOrFail($id);

            $url = sprintf('/admin/mitra/edit/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get Kerjasama Mitra successful',
                'mitra' => $mitra,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get Kerjasama Mitra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $mitra = KerjasamaMitra::findOrFail($id);

            $validatedData = $request->validate([
                'nama_mitra' => 'required|string|max:255',
                'logo_mitra' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'alamat_mitra' => 'required|string|max:255'
            ]);

            if ($request->hasFile('logo_mitra')) {
                $file = $request->file('logo_mitra');
                if ($file->isValid()) {
                    $FileName = uniqid('mitra_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/mitra'), $FileName);
                    $validatedData['logo_mitra'] = $FileName;

                    // Hapus file logo lama jika ada
                    if ($mitra->logo_mitra) {
                        $oldImagePath = public_path('images/mitra/' . $mitra->logo_mitra);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }
            }

            $mitra->update($validatedData);

            $url = '/admin/kerjasama-mitra';

            return response()->json([
                'status' => 'success',
                'message' => 'Update Kerjasama Mitra successful',
                'mitra' => $mitra,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update Kerjasama Mitra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $mitra = KerjasamaMitra::findOrFail($id);

            // Hapus file logo jika ada
            if ($mitra->logo_mitra) {
                $oldImagePath = public_path('images/mitra/' . $mitra->logo_mitra);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $mitra->delete();
            $url = '/admin/kerjasama-mitra';

            return response()->json([
                'status' => 'success',
                'message' => 'Delete Kerjasama Mitra successful',
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete Kerjasama Mitra',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
