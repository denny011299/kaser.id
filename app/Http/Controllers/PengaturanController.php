<?php

namespace App\Http\Controllers;

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
