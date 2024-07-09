<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $upload = Upload::orderBy('path')->paginate(10);
        return view('upload.index', ['uploads' => $upload]);
    }

    public function search(Request $request)
    {
        dd($request);
        $search = $request->input('search');
        $items = Upload::where('path', 'like', '%' . $search . '%')->orWhere('created_at', 'like', '%' . $search . '%')->orWhere('status_konfirmasi', 'like', '%' . $search . '%')->paginate(10);
        return view('upload.index', ['uploads' => $items]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'path' => 'required|mimes:pdf|max:10240',
        ]);

        $file = $request->file('path');
        $extFile = $file->getClientOriginalExtension();
        $namaFile = time() . "." . $extFile;
        $path = 'file/' . $namaFile;

        Storage::disk('public')->put($path, file_get_contents($file));

        $data['nama'] = $request->nama;
        $data['path'] = $namaFile;

        Upload::create($data);
        Alert::success('Berhasil', "Data berhasil Di Upload");
        return redirect("/upload");
    }

    /**
     * Display the specified resource.
     */
    public function show($upload)
    {
        $file = Upload::findOrFail($upload);
        $ext = pathinfo(
            Storage::disk('public')->path('file/' . $file->path),
            PATHINFO_EXTENSION
        );

        return Storage::disk('public')->download('file/' . $file->path, 'preview.' . $ext, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $file->path . '"',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload $upload)
    {
        $upload->delete();
        Alert::success('Berhasil', "File $upload->path telah di hapus");
        return redirect("/upload");
    }

    function getStatusColor($status)
    {
        switch ($status) {
            case 'Confirmed':
                return 'green'; // Warna hijau untuk status terkonfirmasi
            case 'Pending':
                return 'orange'; // Warna oranye untuk status menunggu
            case 'Rejected':
                return 'red'; // Warna merah untuk status ditolak
            default:
                return 'black'; // Warna default (misalnya, hitam)
        }
    }

    public function confirmStatus(Upload $upload)
    {
        $upload->update(['status_konfirmasi' => 'Confirmed']);
        Alert::success('Berhasil', "File $upload->path telah di Konfirmasi");
        return redirect("/upload");
    }

    public function rejectStatus(Upload $upload)
    {
        $upload->update(['status_konfirmasi' => 'Rejected']);
        Alert::success('Berhasil', "File $upload->path telah di Di Tolak");
        return redirect("/upload");
    }
}
