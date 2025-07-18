<?php

namespace App\Http\Controllers;

use App\Models\pengaturan;
use App\Models\pengaturanSettingTax;
use Illuminate\Http\Request;

class SettingTaxController extends Controller
{
    function Payment(){
        $param["data"] = (new pengaturan())->getPengaturan();
        $param["tax"] = (new pengaturanSettingTax())->getTax();
        return view('Backoffice.Setting.Payment')->with($param);
    }

    function getTax(Request $req){
        $data = (new pengaturanSettingTax())->getTax([
            "tx_id"=>$req->tx_id,
            "tx_name"=>$req->tx_name
        ]);
        return json_encode($data);
    }

    function insertTax(Request $req){
        $data = $req->all();
        return (new pengaturanSettingTax())->insertTax($data);
    }
    
    function deleteTax(Request $req){
        $data = $req->all();
        return (new pengaturanSettingTax())->deleteTax($data);
    }
    
    function toggleActiveTax(Request $req){
        $data = $req->all();
        return (new pengaturanSettingTax())->toggleActiveTax($data);
    }
}
