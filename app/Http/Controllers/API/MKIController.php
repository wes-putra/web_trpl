<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MKI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MKIController extends Controller
{
    public function index()
    {
        try {
            $mki = MKI::all();
            $url = '/admin/magang-kerja-industri';

            return response()->json([
                'status' => 'success',
                'message' => 'Get data magang kerja industri successful',
                'mki' => $mki,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get magang kerja industri',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_file_mki' => 'required|string|max:255',
                'file_mki' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:2048',
                'keterangan' => 'nullable|string',
            ]);

            if ($request->hasFile('file_mki')) {
                $file = $request->file('file_mki');
                if ($file->isValid()) {
                    $FileName = uniqid('MKI_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('files/mki'), $FileName);
                    $validatedData['file_mki'] = $FileName;
                }
            }

            $mki = MKI::create($validatedData);
            $url = '/admin/magang-kerja-industri';

            return response()->json([
                'status' => 'success',
                'message' => 'Add magang kerja industri successful',
                'mki' => $mki,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add magang kerja industri',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function download($id)
    {
        try {
            $mki = MKI::findOrFail($id);
            $filePath = public_path('files/mki/' . $mki->file_mki);

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
            $mki = MKI::findOrFail($id);
            
            $filePath = public_path('files/mki/' . $mki->file_mki);

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
            $mki = MKI::findOrFail($id);
            $filePath = public_path('files/mki/' . $mki->file_mki);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $mki->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'magang kerja industri has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete magang kerja industri',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
