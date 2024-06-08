<?php
namespace App\Http\Controllers\API;

use App\Models\Akreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AkreditasiController extends Controller
{
    public function index()
    {
        try {
            $Allakreditasi = Akreditasi::all();

            $akreditasi = $Allakreditasi[0];

            $url = '/admin/akreditasi';
            
            return response()->json([
                'status' => 'success',
                'message' => 'Get data akreditasi successful',
                'akreditasis' => $akreditasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve akreditasi data: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve akreditasi data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'tgl_akreditasi' => 'required|date',
                'gambar_akreditasi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('gambar_akreditasi')) {
                $file = $request->file('gambar_akreditasi');
                if ($file->isValid()) {
                    $fileName = uniqid('akreditasi_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/akreditasi'), $fileName);
                    $validatedData['gambar_akreditasi'] = $fileName;
                }
            }

            $akreditasi = Akreditasi::create($validatedData);
            $url = '/admin/akreditasi';

            return response()->json([
                'status' => 'success',
                'message' => 'Add akreditasi successful',
                'akreditasi' => $akreditasi,
                'url' => $url,
            ]);
        } catch (ValidationException $e) {
            Log::error('Failed to add akreditasi: ' . $e->getMessage());
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add akreditasi', 
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve akreditasi data: ' . $e->getMessage());
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add akreditasi', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit()
    {
        try {
            $Allakreditasi = Akreditasi::all();

            $akreditasi = $Allakreditasi[0];

            $url = '/admin/akreditasi/edit';

            return response()->json([
                'status' => 'success',
                'message' => 'Get akreditasi successful',
                'akreditasi' => $akreditasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get akreditasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $Allakreditasi = Akreditasi::all();

            $akreditasi = $Allakreditasi[0];

            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'tgl_akreditasi' => 'required|date',
                'gambar_akreditasi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('gambar_akreditasi')) {
                if ($akreditasi->gambar_akreditasi) {
                    File::delete(public_path('images/akreditasi/' . $akreditasi->gambar_akreditasi));
                }

                $file = $request->file('gambar_akreditasi');
                $fileName = uniqid('akreditasi_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/akreditasi'), $fileName);
                $validatedData['gambar_akreditasi'] = $fileName;
            }

            $akreditasi->update($validatedData);
            $url = '/admin/akreditasi';

            return response()->json([
                'status' => 'success',
                'message' => 'Update akreditasi successful',
                'akreditasi' => $akreditasi,
                'url' => $url,
            ]);
        } catch (ValidationException $e) {
            Log::error('Failed to add akreditasi: ' . $e->getMessage());
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add akreditasi', 
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to update akreditasi', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function destroy()
    // {
    //     try {
    //         $Allakreditasi = Akreditasi::all();

    //         $akreditasi = $Allakreditasi[0];

    //         if ($akreditasi->gambar_akreditasi) {
    //             File::delete(public_path('images/akreditasi/' . $akreditasi->gambar_akreditasi));
    //         }

    //         $akreditasi->delete();
    //         $url = '/admin/akreditasi';

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Akreditasi has been removed',
    //             'url' => $url,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to remove Akreditasi',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
