<?php

namespace App\Http\Controllers;
use App\Models\Security;
use App\Models\PointQR;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // LIST SCAN QR SECURITY
    protected $data;
    public function __construct()
    {
        $security = Security::all();
        $valid = Security::where('status', 'valid')->count();
        $invalid = Security::where('status', 'invalid')->count();
        $this->data = [
            'security' => $security,
            'valid' => $valid,
            'invalid' => $invalid,
        ];
    }
    public function index()
    {
        // $kodeunik = ::all();
        $security = Security::all();
        $valid = Security::where('status', 'valid')->count();
        $invalid = Security::where('status', 'invalid')->count();
        $data = [
            'security' => $security,
            'valid' => $valid,
            'invalid' => $invalid,
        ];
        return view('admin.admin', $data);
    }
    // TITKPOINT
    public function buatTitikpoint() {
        $security = Security::all();
        $valid = Security::where('status', 'valid')->count();
        $invalid = Security::where('status', 'invalid')->count();
        $data = [
            'security' => $security,
            'valid' => $valid,
            'invalid' => $invalid,
        ];
        return view('admin.buatqr', $data);
    }
    public function listTitikpoint() {
        $titikpoint = PointQR::all();
        $data = [
            'titikpoint'=>$titikpoint,
        ];
        return view('admin.listqr',$this->data, $data);
    }
    public function buatTitikpointpost(Request $request) {
        $qr = new PointQR();
        
        $validated = $request->validate([
            'kodeunik' => 'required',
            'nama_tempat' => 'required',
            'area' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ]);
        $qr->kodeunik = $validated['kodeunik'];
        $qr->nama_tempat = $validated['nama_tempat'];
        $qr->area = $validated['area'];
        $qr->latitude = $validated['latitude'];
        $qr->longitude = $validated['longitude'];
        $qr->save();
        return redirect()->route('listtitikpoint');
    }

    public function show($id)
    {
        $security = Security::find($id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
    public function ubahStatusScan(Request $request, $id)
    {
        $security = Security::find($id);
        $security->status = $request->status;
        $security->save();

        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }
    public function updateTitikpoint(Request $request, $kodeunik)
    {
        $pointqr = PointQR::where('kodeunik', $kodeunik)->first();
        if (!$pointqr) {
            return redirect()->route('listtitikpoint')->with('error', 'Data tidak ditemukan');
        }
        $pointqr->update([
            'kodeunik' => $request->kodeunik,
            'nama_tempat' => $request->nama_tempat,
            'area' => $request->area,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return redirect()->route('listtitikpoint')->with('success', 'Data Berhasil Diedit');
    }

    public function hapusTitikpoint($kodeunik)
    {
        $pointqr = PointQR::where('kodeunik', $kodeunik);
        $pointqr->delete();

        return redirect()->route('listtitikpoint')->with('success', 'Data Berhasil Dihapus');
    }
    public function destroy($id)
    {
        $security = Security::find($id);
        $security->delete();

        return response()->json($security);
    }
}
