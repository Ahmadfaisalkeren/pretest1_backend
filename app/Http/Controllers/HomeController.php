<?php

namespace App\Http\Controllers;

use App\RandomUser;
use App\Models\Profesi;
use Illuminate\Http\Request;
use App\Models\HasilResponse;

class HomeController extends Controller
{
    public function index()
    {
        $randomUser = RandomUser::getData();

        $hasilResponse = new HasilResponse();

        $hasilResponse->jenis_kelamin = $randomUser['results'][0]['gender'] == 'female' ? 2 : 1;
        $hasilResponse->nama = $randomUser['results'][0]['name']['first'] . ' ' . $randomUser['results'][0]['name']['last'];
        $hasilResponse->nama_jalan = $randomUser['results'][0]['location']['street']['name'];
        $hasilResponse->email = $randomUser['results'][0]['email'];

        $md5 = md5(json_encode($randomUser));
        $angka_kurang = preg_match_all("/[0-6]/", $md5);
        $angka_lebih = preg_match_all("/[8-9]/", $md5);
        $hasilResponse->angka_kurang = $angka_kurang;
        $hasilResponse->angka_lebih = $angka_lebih;

        $profesi = chr(rand(65, 69));
        $hasilResponse->profesi = $profesi;

        $hasilResponse->plain_json = json_encode($randomUser);

        $hasilResponse->save();

        return response()->json([
            'random_user' => $randomUser,
            'message' => 'Data Fetched Successfully'
        ]);
    }

    public function menyajikanData()
    {
        $randomUser = HasilResponse::with('gender', 'profesi')->orderBy('id', 'DESC')->get();

        $profesiCounts = $randomUser->pluck('profesi')
            ->map(function ($profesi) {
                return Profesi::where('kode', $profesi)->value('nama_profesi');
            })
            ->filter()
            ->countBy();

        return response()->json([
            'randomUser' => $randomUser,
            'profesiCounts' => $profesiCounts,
            'message' => 'Data Fetched Successfully'
        ]);
    }
}
