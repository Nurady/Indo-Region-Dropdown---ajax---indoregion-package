<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class IndoregionController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return view('home', compact('provinces'));
    }

    public function getRegency(Request $request)
    {
        $provinceId = $request->provinceId;
        $regencies = Regency::where('province_id', $provinceId)->get();

        $option = "<option>-- Pilih Kabupaten --</option>";
        foreach ($regencies as $regency) {
            $option .= "<option value='$regency->id'>$regency->name</option>";
        }

        echo $option;
    }

    public function getDistrict(Request $request)
    {
        $regencyId = $request->regencyId;
        $districts = District::where('regency_id', $regencyId)->get();

        $option = "<option>-- Pilih Kecamatan --</option>";
        foreach ($districts as $district) {
            $option .= "<option value='$district->id'>$district->name</option>";
        }

        echo $option;
    }

    public function getVillage(Request $request)
    {
        $districtId = $request->districtId;
        $villages = Village::where('district_id', $districtId)->get();

        $option = "<option>-- Pilih Desa --</option>";
        foreach ($villages as $village) {
            $option .= "<option value='$village->id'>$village->name</option>";
        }

        echo $option;
    }
}
