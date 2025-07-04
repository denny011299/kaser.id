<?php

namespace App\Http\Controllers;

use App\Models\manageStock;
use App\Models\Supplies;
use Illuminate\Http\Request;

class StockController extends Controller
{
    function manageSupplies() {
        return view('Backoffice.Inventory.Manage_supplies');
    }

    function getManageSupplies(Request $req)
    {
        $data =  (new manageStock())->getManage([
            "ms_type" => $req->ms_type,
            "ms_start_date" => $req->ms_start_date,
            "ms_end_date" => $req->ms_end_date,
            "type" => 1,
            "all" => $req->all
        ]);
        return json_encode($data);
    }

    function insertManageSupplies(Request $req)
    {
        $data = $req->all();
        return (new manageStock())->insertManage($data);
    }
    
    function deleteManageSupplies(Request $req)
    {
        $data = $req->all();
        return (new manageStock())->deleteManage($data);
    }

    // Product
    function manageProduct() {
        return view('Backoffice.Inventory.Manage_Product');
    }

    function getManageProduct(Request $req)
    {
        $data =  (new manageStock())->getManage([
            "ms_type" => $req->ms_type,
            "ms_start_date" => $req->ms_start_date,
            "ms_end_date" => $req->ms_end_date,
            "all" => $req->all,
            "type" => 2,
        ]);
        return json_encode($data);
    }

    function insertManageProduct(Request $req)
    {
        $data = $req->all();
        return (new manageStock())->insertManage($data);
    }
    
    function deleteManageProduct(Request $req)
    {
        $data = $req->all();
        return (new manageStock())->deleteManage($data);
    }
}
