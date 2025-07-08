<?php

namespace App\Http\Controllers;

use App\Models\manageStock;
use App\Models\Product;
use App\Models\Product_variant;
use App\Models\product_variasi;
use App\Models\StockOpname;
use App\Models\StockOpnameDetail;
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
    function CreateStockOpname($stp_type) {
        $param["mode"]=1;
        $param["data"]=[];
        $param["stp_type"]=$stp_type;
        return view('Backoffice.Inventory.CreateStockOpname')->with($param);
    }
    function viewStockOpname($id,$stp_type) {
         $param["mode"]=2;//view
         $param["stp_type"]=$stp_type;
         $param["data"]=(new StockOpname())->getStockOpname(["stp_id"=>$id])[0];//view
         $param["data"]["items"] = (new StockOpnameDetail())->getDetailStockOpname(["stp_id"=>$param["data"]["stp_id"]]);
        return view('Backoffice.Inventory.CreateStockOpname')->with($param);
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

    function StockOpname() {
        $param["stp_type"]=1;
        return view('Backoffice.Inventory.StockOpname')->with($param);
    }
    function StockOpnameSupply() {
         $param["stp_type"]=2;
        return view('Backoffice.Inventory.StockOpname')->with($param);
    }
    function getStockOpname(Request $req)
    {
        $data =  (new StockOpname())->getStockOpname([
            "stp_nomer" => $req->stp_nomer,
            "stp_date" => $req->stp_date,
            "stp_type" => $req->stp_type,
        ]);
        return json_encode($data);
    }
    function getProductStockname(Request $req)
    {
        $result = [];
        if($req->type==1){
            $c = $req->category_id;
            if($c==-1) $c = null;
            $data =  (new Product())->getProduct([
                "c_id" => $c
            ]);

            foreach ($data as $key => $value) {
                $pv = (new product_variasi())->getProductVariant(["pr_id"=>$value->pr_id]);
                $pv = json_decode($pv,true);
                if(count($pv)>0){
                   
                    foreach ($pv as $key => $var) {
                      $temp = [
                        "pr_name"=>$value["pr_name"]. " - ".$var["pvs_name"],
                        "pvs_id"=>$var["pvs_id"],
                        "pr_sku"=>$var["pvs_sku"]?$var["pvs_sku"]:$value["pr_sku"],
                        "pr_stock"=>$var["pvs_stok"]
                      ];
                      $temp = array_merge(json_decode($value,true),$temp);
                      array_push($result,$temp);
                    }
                }
                else array_push($result,json_decode($value,true));
            }

        }
        else{
            $result =  (new Supplies())->getSupplies([
            ]);
            foreach ($result as $key => $value) {
                $value["pr_sku"] = $value["sup_sku"];
                $value["pr_name"] = $value["sup_name"];
                $value["pr_stock"] = $value["sup_stock"];
            }
        }
        return json_encode($result);
    }

    function insertStockOpname(Request $req)
    {
        $data = $req->all();
        $id = (new StockOpname())->insertStockOpname($data);
      
        $list_item = json_decode($data["item"],true); 
        foreach ($list_item as $key => $value) {
            $value["stp_id"] = $id;
            $value["stpd_stock"] = $value["pr_stock"];
            $value["stpd_real_stock"] = $value["real_stok"];
            $value["stpd_note"] = $value["notes"];
            $value["stpd_selisih"] = $value["real_stok"] - $value["pr_stock"];
            (new StockOpnameDetail())->insertDetailStockOpname($value);
            if($req->stp_type==1){
                if(isset($value["pvs_id"])){
                    $pv = product_variasi::find($value["pvs_id"]);
                    $pv->pvs_stok = $value["real_stok"];
                    $pv->save();
                    (new Product())->recalculateStock($value["pr_id"]);
                }
                else{
                    $value["pr_stok"] = $value["real_stok"];
                    (new Product())->updateProduct($value);
                }
            }
            else{
                $s = Supplies::find($value["sup_id"]);
                $s->sup_stock = $value["real_stok"];
                $s->save();
            }
        }
    }
    
    function updateStockOpname(Request $req)
    {
        $data = $req->all();
        return (new StockOpname())->insertStockOpname($data);
    }
    
    function deleteStockOpname(Request $req)
    {
        $data = $req->all();
        return (new StockOpname())->deleteStockOpname($data);
    }
}
