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
        $data =  (new manageStock())->getManageSupplies([
            "ms_type" => $req->ms_type,
            "ms_start_date" => $req->ms_start_date,
            "ms_end_date" => $req->ms_end_date,
            "all" => $req->all
        ]);
        return json_encode($data);
    }

    function insertManageSupplies(Request $req)
    {
        $data = $req->all();
        return (new manageStock())->insertManageSupplies($data);
    }
    
    function deleteManageSupplies(Request $req)
    {
        $data = $req->all();
        return (new manageStock())->deleteManageSupplies($data);
    }
}
