<?php

namespace App\Http\Controllers;

use App\Models\pengaturan;
use App\Models\SettingTax;
use Illuminate\Http\Request;

class SettingTaxController extends Controller
{
    function Payment(){
        $param["data"] = (new pengaturan())->getPengaturan();
        $param["tax"] = (new SettingTax())->getTax();
        return view('Backoffice.Setting.Payment')->with($param);
    }

    function getTax(Request $req){
        $data = (new SettingTax())->getTax([
            "tx_id"=>$req->tx_id,
            "tx_name"=>$req->tx_name
        ]);
        return json_encode($data);
    }

    function insertTax(Request $req){
        $data = $req->all();
        return (new SettingTax())->insertTax($data);
    }
    
    function deleteTax(Request $req){
        $data = $req->all();
        return (new SettingTax())->deleteTax($data);
    }
    
    function toggleActiveTax(Request $req){
        $data = $req->all();
        return (new SettingTax())->toggleActiveTax($data);
    }
}
