<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SEdarMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SEdarMahasiswaController extends Controller
{
    public function index()
    {
        try {
            $suratEdar = SEdarMahasiswa::all();
            $url = '/admin/surat-edar';

            return response()->json([
                'status' => 'success',
                'message' => 'Get data surat edaran successful',
                'suratEdar' => $suratEdar,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get surat edaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_surat_edar' => 'required|string|max:255',
                'file_surat_edar' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:2048',
                'keterangan' => 'nullable|string',
            ]);

            if ($request->hasFile('file_surat_edar')) {
                $file = $request->file('file_surat_edar');
                if ($file->isValid()) {
                    $FileName = uniqid('SuratEdar_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('files/surat-edar'), $FileName);
                    $validatedData['file_surat_edar'] = $FileName;
                }
            }

            $suratEdar = SEdarMahasiswa::create($validatedData);
            $url = '/admin/surat-edar';

            return response()->json([
                'status' => 'success',
                'message' => 'Add surat edaran successful',
                'suratEdar' => $suratEdar,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add surat edaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function download($id)
    {
        try {
            $suratEdar = SEdarMahasiswa::findOrFail($id);
            $filePath = public_path('files/surat-edar/' . $suratEdar->file_surat_edar);

            if (!File::exists($filePath)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File not found'
                ], 404);
            }

            return response()->download($filePath);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to download file',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function view($id)
    {
        try {
            $suratEdar = SEdarMahasiswa::findOrFail($id);
            
            $filePath = public_path('files/surat-edar/' . $suratEdar->file_surat_edar);

            if (!File::exists($filePath)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File not found'
                ], 404);
            }

            return response()->file($filePath);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to view file',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $suratEdar = SEdarMahasiswa::findOrFail($id);
            $filePath = public_path('files/surat-edar/' . $suratEdar->file_surat_edar);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $suratEdar->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Surat edaran has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete surat edaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
