<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Meja;
use App\Models\pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    function Receipt(){
        $param["data"] = (new pengaturan())->getPengaturan();
        return view('Backoffice.Setting.Receipt')->with($param);
    }

    function getPengaturan(Request $req){
        $data = (new pengaturan())->getPengaturan(["select"=>$req->select]);
        return json_encode($data);
    }
    
    function updatePengaturan(Request $req) {
        if(isset($req->old_file) && isset($req->pengaturan_value)) $logo = $this->insertFile($req->pengaturan_value, "setting", $req->old_file);
        (new pengaturan())->updatePengaturan($req->pengaturan_nama, $logo ?? $req->pengaturan_value);
        return response()->json(['success' => true, isset($logo) ? ['filePath' => $logo] : []]);
    }

    //setting meja
     function Meja($id) {
        $param["floor"] = (new Floor())->getFloor(["fl_id"=>$id])[0];
        return view('Backoffice.Setting.Meja')->with($param);
    }
    function getMeja(Request $req)
    {
        $data =  (new Meja())->getMeja([
            "fl_id"=>$req->fl_id,
        ]);
        return json_encode($data);
    }

    function insertMeja(Request $req)
    {
        $data = $req->all();
        return (new Meja())->insertMeja($data);
    }
    function deleteMeja(Request $req)
    {
        $data = $req->all();
        return (new Meja())->deleteMeja($data);
    }
    function updateKoordinatMeja(Request $req)
    {
        $data = $req->all();
        return (new Meja())->updateKoordinatMeja($data);
    }

    //setting meja
     function Floor() {
        return view('Backoffice.Setting.Floor');
    }
    function getFloor(Request $req)
    {
        $data =  (new Floor())->getFloor([
        ]);
        return json_encode($data);
    }

    function insertFloor(Request $req)
    {
        $data = $req->all();
        return (new Floor())->insertFloor($data);
    }
    function updateFloor(Request $req)
    {
        $data = $req->all();
        return (new Floor())->updateFloor($data);
    }
    function deleteFloor(Request $req)
    {
        $data = $req->all();
        return (new Floor())->deleteFloor($data);
    }
   
    public function insertFile($file, $type, $currentImage)
    {
        try {
            $fileName = uniqid() . '.' . $file->extension();
            $filePath = 'upload/' . $type . "/" . $fileName;
            

            if ($currentImage && file_exists($currentImage) && $currentImage !== ($filePath)) {
                unlink($currentImage);
            }

            $file->move(public_path('upload/' . $type), $fileName);
            return $filePath;
        } catch (\Throwable $th) {
            dd($th);
            return -1;
        }
    }
}
