<?php

namespace App\Http\Controllers;

use App\Models\Bundling;
use App\Models\voucher;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
     //Discount / Voucher
    function voucher() {
        return view('Backoffice.Promotion.Voucher');
    }
    function getVoucher(Request $req)
    {
        $data =  (new voucher())->getVoucher([
            "vc_name"=>$req->vc_name
        ]);
        return json_encode($data);
    }

    function insertVoucher(Request $req)
    {
        $data = $req->all();
        return (new voucher())->insertVoucher($data);
    }

    function updateVoucher(Request $req)
    {
        $data = $req->all();
        (new voucher())->updateVoucher($data);
    }

    function deleteVoucher(Request $req)
    {
        $data = $req->all();
        return (new voucher())->deleteVoucher($data);
    }
    //Bundling / Paket
    function bundling() {
        return view('Backoffice.Promotion.Bundling');
    }
    function getBundling(Request $req)
    {
        $data =  (new Bundling())->getbundling([
            "bd_name"=>$req->bd_name
        ]);
        return json_encode($data);
    }

    function insertBundling(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["bd_img"] = $this->insertFile($req->main, "bundling");
        return (new Bundling())->insertBundling($data);
    }

    function updateBundling(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["bd_img"] = $this->insertFile($req->main, "bundling");
        (new Bundling())->updateBundling($data);
    }

    function deleteBundling(Request $req)
    {
        $data = $req->all();
        return (new Bundling())->deleteBundling($data);
    }

    public function insertFile($file, $type)
    {
        try {
            $fileName = uniqid() . '.' . $file->extension();
            $filePath = 'upload/' . $type . "/" . $fileName;

            $file->move(public_path('upload/' . $type), $fileName);
            return $filePath;
        } catch (\Throwable $th) {
            dd($th);
            return -1;
        }
    }
}
