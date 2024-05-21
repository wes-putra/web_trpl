<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kurikulum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class KurikulumController extends Controller
{
    public function index()
    {
        try {
            $kurikulums = Kurikulum::all();

            $url = '/admin/kurikulum';

            return response()->json([
                'status' => 'success',
                'message' => 'Data kurikulum berhasil diambil',
                'kurikulums' => $kurikulums,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data kurikulum',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'semester' => 'required|string|max:255',
                'file_kurikulum' => 'required|mimes:pdf|max:2048'
            ]);

            if ($request->hasFile('file_kurikulum')) {
                $file = $request->file('file_kurikulum');
                if ($file->isValid()) {
                    $fileName = uniqid('kurikulum_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('files/kurikulum'), $fileName);
                    $validatedData['file_kurikulum'] = $fileName;
                }
            }

            $kurikulum = Kurikulum::create($validatedData);
            $url = '/admin/kurikulum';

            return response()->json([
                'status' => 'success',
                'message' => 'Kurikulum berhasil ditambahkan',
                'kurikulum' => $kurikulum,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan kurikulum',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function download($id)
    {
        try {
            $kurikulum = Kurikulum::findOrFail($id);

            $filePath = public_path('files/kurikulum/' . $kurikulum->file_kurikulum);
            if (!File::exists($filePath)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File tidak ditemukan'
                ], 404);
            }

            return response()->download($filePath);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengunduh file',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function view($id)
    {
        try {
            $kurikulum = Kurikulum::findOrFail($id);

            $filePath = public_path('files/kurikulum/' . $kurikulum->file_kurikulum);
            if (!File::exists($filePath)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File tidak ditemukan'
                ], 404);
            }

            return response()->file($filePath);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menampilkan file',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $kurikulum = Kurikulum::findOrFail($id);

            if ($kurikulum->file_kurikulum) {
                File::delete(public_path('files/kurikulum/' . $kurikulum->file_kurikulum));
            }

            $kurikulum->delete();
            $url = '/admin/kurikulum';

            return response()->json([
                'status' => 'success',
                'message' => 'Kurikulum berhasil dihapus',
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kurikulum',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
