<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TAController extends Controller
{
    public function index()
    {
        try {
            $ta = TA::all();
            $url = '/admin/tugas-akhir';

            return response()->json([
                'status' => 'success',
                'message' => 'Get data tugas akhir successful',
                'ta' => $ta,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get tugas akhir',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_file_ta' => 'required|string|max:255',
                'file_ta' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:2048',
                'keterangan' => 'nullable|string',
            ]);

            if ($request->hasFile('file_ta')) {
                $file = $request->file('file_ta');
                if ($file->isValid()) {
                    $FileName = uniqid('TA_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('files/ta'), $FileName);
                    $validatedData['file_ta'] = $FileName;
                }
            }

            $ta = TA::create($validatedData);
            $url = '/admin/tugas-akhir';

            return response()->json([
                'status' => 'success',
                'message' => 'Add tugas akhir successful',
                'ta' => $ta,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add tugas akhir',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function download($id)
    {
        try {
            $ta = TA::findOrFail($id);
            $filePath = public_path('files/ta/' . $ta->file_ta);

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
            $ta = TA::findOrFail($id);
            
            $filePath = public_path('files/ta/' . $ta->file_ta);

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
            $ta = TA::findOrFail($id);
            $filePath = public_path('files/ta/' . $ta->file_ta);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $ta->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'tugas akhir has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete tugas akhir',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
