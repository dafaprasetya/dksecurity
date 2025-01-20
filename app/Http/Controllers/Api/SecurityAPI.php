<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Security;
use App\Http\Resources\SecurityResourceAPI;
use App\Models\PointQR;
use Illuminate\Http\Request;
use InvalidArgumentException;

class SecurityAPI extends Controller
{
    public function checkRadius($asallat, $asallong, $tujuanlat, $tujuanlong) {
        $radius = 30; // Radius dalam meter
    
        // Konversi derajat ke radian
        $asallat = deg2rad($asallat);
        $asallong = deg2rad($asallong);
        $tujuanlat = deg2rad($tujuanlat);
        $tujuanlong = deg2rad($tujuanlong);

        // Hitung perbedaan koordinat
        $dlat = $tujuanlat - $asallat;
        $dlon = $tujuanlong - $asallong;

        // Rumus Haversine
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($asallat) * cos($tujuanlat) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $radius_of_earth = 6371000; // Radius bumi dalam meter
        $distance = $radius_of_earth * $c; // Jarak dalam meter

        // Tentukan keterangan berdasarkan jarak
        $keterangan = ($distance > $radius) ? "lebih dari {$radius}m" : "dalam radius {$radius}m";

        return [
            'distance' => $distance,
            'keterangan' => $keterangan
        ];
    }
    public function check(Request $request, $kodeunik)
    {
        $kodeunik = PointQR::where('kodeunik', $kodeunik)->first();
        $result = $this->checkRadius($kodeunik->latitude, $kodeunik->longitude, $request->latitude, $request->longitude);
        $security = Security::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'kodeunik' => $kodeunik->kodeunik,
            'keterangan' => $result['keterangan'],
            'jarak' => round($result['distance']),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return new SecurityResourceAPI($security);
    }

    
}
