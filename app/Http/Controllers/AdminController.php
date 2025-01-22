<?php

namespace App\Http\Controllers;
use App\Models\Security;
use App\Models\UserSecurity;
use App\Models\PointQR;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminController extends Controller
{
    // LIST SCAN QR SECURITY
    protected $data;
    public function __construct()
    {
        $security = Security::all();
        $valid = Security::where('status', 'valid');
        $invalid = Security::where('status', 'invalid');
        $usersecurity = UserSecurity::all();
        $this->data = [
            'security' => $security,
            'valid' => $valid,
            'invalid' => $invalid,
            'usersec'=>$usersecurity,
        ];
    }

    // SECURITY SCAN HANDLE
    public function index()
    {
        // $kodeunik = ::all();
        // dd($this->data['usersec']);
        return view('admin.admin', $this->data);
    }
    public function validQrScan()
    {
        // $kodeunik = ::all();
        $data = [
            'security' => $this->data['valid']->get(),
            'valid' => $this->data['valid'],
            'invalid' => $this->data['invalid'],
        ];
        return view('admin.admin', $data);
    }
    public function invalidQrScan()
    {
        // $kodeunik = ::all();
        $data = [
            'security' => $this->data['invalid']->get(),
            'valid' => $this->data['valid'],
            'invalid' => $this->data['invalid'],
        ];
        // dd($data['invalid']);
        return view('admin.admin', $data);
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
    public function cleanupQrScan()
    {
        // Hitung tanggal 3 hari yang lalu
        $threeDaysAgo = Carbon::now()->subDays(3);

        // Hapus data dengan status 'invalid' yang lebih lama dari 3 hari
        $deletedRecords = Security::where('status', 'invalid')
            ->where('created_at', '<', $threeDaysAgo)
            ->delete();

        return redirect()->back()->with('success', 'Data Scan QR yang Lama Telah di Hapus');
    }
    // END SECURITY SCAN
    // TITKPOINT
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
    public function buatTitikpoint() {
        $security = Security::all();
        $valid = Security::where('status', 'valid');
        $invalid = Security::where('status', 'invalid');
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
    // END TITIK POINT
    // SECURITY USER
    public function listSecurityUser() {
        $usersec = UserSecurity::all();
        $data = [
            'usersec'=>$usersec,
        ];
        return view('admin.securityuser',$this->data, $data);
    }
    public function updateSecurityUser(Request $request, $nik)
    {
        $usersec = UserSecurity::where('nik', $nik)->first();
        if (!$usersec) {
            return redirect()->route('listtitikpoint')->with('error', 'Data tidak ditemukan');
        }
        $usersec->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'area' => $request->area,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Diedit');
    }
    public function buatSecurityUser(Request $request) {
        $qr = new UserSecurity();

        $validated = $request->validate([
            'nik' => 'required|unique:user_securities,nik',
            'nama' => 'required',
            'area' => 'required',
        ]);
        $qr->nik = $validated['nik'];
        $qr->nama = $validated['nama'];
        $qr->area = $validated['area'];
        $qr->save();
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }


}
