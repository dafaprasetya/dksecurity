<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Security;
use App\Http\Resources\SecurityResourceAPI;
use App\Models\PointQR;
use App\Models\UserSecurity;
use Illuminate\Http\Request;
use InvalidArgumentException;

class SecurityAPI extends Controller
{
    protected $keterangan;

    public function checkRadius($asallat, $asallong, $tujuanlat, $tujuanlong) {
        $radius = 30;

        $asallat = deg2rad($asallat);
        $asallong = deg2rad($asallong);
        $tujuanlat = deg2rad($tujuanlat);
        $tujuanlong = deg2rad($tujuanlong);

        $dlat = $tujuanlat - $asallat;
        $dlon = $tujuanlong - $asallong;

        // Rumus Haversine
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($asallat) * cos($tujuanlat) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $radius_of_earth = 6371000;
        $distance = $radius_of_earth * $c;

        $keterangan = ($distance > $radius) ? "lebih dari {$radius}m" : "dalam radius {$radius}m";

        return [
            'distance' => $distance,
            'keterangan' => $keterangan
        ];
    }
    public function updateQrScan(Request $request, $id)
    {
        $security = Security::find($id);
        $usersecurity = UserSecurity::where('nik', $request->nik)->first();
        $kodeunik = PointQR::where('kodeunik', $security->kodeunik)->first();
        $result = $this->checkRadius($kodeunik->latitude, $kodeunik->longitude, $security->latitude, $security->longitude);
        $security->nik = $usersecurity->nik;
        $security->nama = $usersecurity->nama;
        $security->keterangan = $result['keterangan'];
        if ($result['keterangan'] == 'dalam radius 30m') {
            $security->status = 'valid';
        }
        $security->save();
        // dd($data['invalid']);
        return redirect()->back()->with('success', 'Data Berhasil Diedit');
    }
    public function checkUser($nikapi, $namaapi) {
        $user = UserSecurity::where('nik', $nikapi)->first();
        // Jika user tidak ditemukan
        if (!$user) {
            return[
                'status' => 'error',
                'keterangan' => 'NIK tidak cocok dengan data security',
            ];
        }
        if ($user->nama !== $namaapi) {
            return[
                'status' => 'error',
                'keterangan' => 'Nama tidak cocok dengan data security',
            ];
        }
        if ($user->nama !== $namaapi && $user->nik !== $namaapi) {
            return[
                'status' => 'error',
                'keterangan' => 'Nama dan NIK tidak cocok dengan data security',
            ];
        }
        else {
            return[
                'status'=>'success',
                'keterangan' => 'User cocok',
            ];
        }

    }
    public function check(Request $request, $kodeunik)
    {
        $kodeunik = PointQR::where('kodeunik', $kodeunik)->first();
        $result = $this->checkRadius($kodeunik->latitude, $kodeunik->longitude, $request->latitude, $request->longitude);
        $cekuser = $this->checkUser($request->nik, $request->nama);
        $security = Security::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'kodeunik' => $kodeunik->kodeunik,
            'keterangan' => $result['keterangan'].', '.$cekuser['keterangan'],
            'jarak' => round($result['distance']),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return new SecurityResourceAPI($security);
    }
    public function deleteQrScan($id) {
        $security = Security::find($id);
        $security->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }


}
