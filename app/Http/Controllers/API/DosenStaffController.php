<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DosenStaff;
use Illuminate\Http\Request;

class DosenStaffController extends Controller
{
    public function index(){
        try {
            $dosenStaff = DosenStaff::all();
            $url = '/admin/dosen-staff';
    
            return response()->json([
                'status' => 'success',
                'message' => 'Get data dosen staff successful',
                'dosenStaff' => $dosenStaff,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get dosen staff',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                if ($file->isValid()) {
                    $FileName = uniqid('dosenStaff_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/dosenStaff'), $FileName);
                    $validatedData['foto'] = $FileName;
                }
            }

            $dosenStaff = DosenStaff::create($validatedData);
            $url = '/admin/dosen-staff';

            return response()->json([
                'status' => 'success',
                'message' => 'Add dosen staff successful',
                'dosenStaff' => $dosenStaff,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add dosen staff',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $dosenStaff = DosenStaff::findOrFail($id);

            $url = sprintf('/admin/dosen-staff/edit/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get dosen staff successful',
                'dosenStaff' => $dosenStaff,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get dosen staff',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dosenStaff = DosenStaff::findOrFail($id);

            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                if ($file->isValid()) {
                    $FileName = uniqid('dosenStaff_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/dosenStaff'), $FileName);
                    $validatedData['foto'] = $FileName;

                    // Hapus file logo lama jika ada
                    if ($dosenStaff->foto) {
                        $oldImagePath = public_path('images/dosenStaff/' . $dosenStaff->foto);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }
            }

            $dosenStaff->update($validatedData);

            $url = '/admin/dosen-staff';

            return response()->json([
                'status' => 'success',
                'message' => 'Update dosen staff successful',
                'dosenStaff' => $dosenStaff,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update dosen staff',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $dosenStaff = DosenStaff::findOrFail($id);

            // Hapus file logo jika ada
            if ($dosenStaff->foto) {
                $oldImagePath = public_path('images/dosenStaff/' . $dosenStaff->foto);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $dosenStaff->delete();
            $url = '/admin/dosen-staff';

            return response()->json([
                'status' => 'success',
                'message' => 'Delete dosen staff successful',
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete dosen staff',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
