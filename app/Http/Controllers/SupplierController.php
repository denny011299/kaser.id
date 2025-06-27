<?php

namespace App\Http\Controllers;

use App\Models\pengaturan;
use App\Models\Supplier;
use App\Models\SupplierPrice;
use App\Models\SupplierPurchaseOrder;
use App\Models\SupplierPurchaseOrderDetail;
use App\Models\SupplierPurchaseOrderInvoice;
use App\Models\SupplierPurchaseOrderPayment;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    
    //Supplier
    function supplier() {
        return view('Backoffice.Supplier.Supplier');
    }
    
    function supplierDetail($id) {
        $param["data"] =(new supplier)->getSupplier(["sp_id"=>$id])[0];
        return view('Backoffice.Supplier.Supplier_detail')->with($param);
    }

    function getSupplier(Request $req)
    {
        $data =  (new Supplier())->getSupplier([
            "sp_name"=>$req->sp_name,
            "city_id"=>$req->city_id
        ]);
        return json_encode($data);
    }

    function insertSupplier(Request $req)
    {
        $data = $req->all();
        if(isset($req->main))$data["sp_img"] = $this->insertFile($req->main, "supplier");
        return (new Supplier())->insertSupplier($data);
    }

    function updateSupplier(Request $req)
    {
        $data = $req->all();
        if(isset($req->main))$data["sp_img"] = $this->insertFile($req->main, "supplier");
        (new Supplier())->updateSupplier($data);
    }

    function deleteSupplier(Request $req)
    {
        $data = $req->all();
        return (new Supplier())->deleteSupplier($data);
    }
    
    //Purchase Order
    function purchase_order() {
        return view('Backoffice.Supplier.PurchaseOrder');
    }

    function creatPurchaseOrder() {
        $param = $this->fetchPengaturan();
        return view('Backoffice.Supplier.creatPurchaseOrder')->with($param);
    }
    
    function PurchaseOrderDetail($id) {
        $param["dataPo"] = (new SupplierPurchaseOrder())->getPurchaseOrder(["spo_id"=>$id])[0];
        $param["data"] =(new supplier)->getSupplier(["sp_id"=>$id])[0];
        $param["spo_id"] =$id;
        return view('Backoffice.Supplier.PurchaseOrderDetail')->with($param);
    }
    
    function getPurchaseOrder(Request $req)
    {
        $data =  (new SupplierPurchaseOrder())->getPurchaseOrder([
            "spo_id" => $req->spo_id,
            "sp_id" => $req->sp_id,
            "spo_status" => $req->spo_status,
        ]);
        return json_encode($data);
    }

    function insertPurchaseOrder(Request $req)
    {
        $data = $req->all();
        $s = supplier::find($data["sp_id"]);
        $param = $this->fetchPengaturan();
        $data["spo_from_company"] = $param["company_name"];
        $data["spo_from_address"] = $param["company_nomor"];
        $data["spo_from_nomer"] = $param["company_address"];
        $data["spo_to_company"] = $s->sp_name;
        $data["spo_to_address"] = $s->sp_address;
        $data["spo_to_nomer"] = $s->sp_nomer;
        $id = (new SupplierPurchaseOrder())->insertPurchaseOrder($data);
        foreach (json_decode($req->list_product,true) as $key => $value) {
            $value["spo_id"] = $id;
            $value["spod_type"] = $value["type"];
            if($value["type"]==1){
                $value["spod_value_id"] = $value["pr_id"];
                if($value["variant"])$value["spod_variant"] = json_encode($value["variant"]);
            }
            else{
                $value["spod_value_id"] = $value["sup_id"];
            }
            $value["spod_nama"] = $value["fullname"];
            $value["spod_harga"] = $value["price"];
            $value["spod_qty"] = $value["qty"];
            $value["spod_subtotal"] = $value["subtotal"];
            (new SupplierPurchaseOrderDetail())->insertDetail($value);
        }
        return $id;
    }

    function updatePurchaseOrder(Request $req)
    {
        $data = $req->all();
        (new SupplierPurchaseOrder())->updatePurchaseOrder($data);
    }

    function deletePurchaseOrder(Request $req)
    {
        $data = $req->all();
        return (new SupplierPurchaseOrder())->deletePurchaseOrder($data);
    }

    //Supplier Price + Product
    function getSupplierPrice(Request $req)
    {
        $data =  (new SupplierPrice())->getSupplierPrice([
            "spr_id" => $req->spr_id,
            "pr_id" => $req->pr_id,
            "sp_id" => $req->sp_id,
            "type" => $req->type
        ]);
        return json_encode($data);
    }

    function insertSupplierPrice(Request $req)
    {
        $data = $req->all();
        (new SupplierPrice())->insertSupplierPrice($data);
    }

    function updateSupplierPrice(Request $req)
    {
        $data = $req->all();
        (new SupplierPrice())->updateSupplierPrice($data);
    }

    function deleteSupplierPrice(Request $req)
    {
        $data = $req->all();
        return (new SupplierPrice())->deleteSupplierPrice($data);
    }
   
    //Invoice PO
    function getPoInvoice(Request $req)
    {
        $data =  (new SupplierPurchaseOrderInvoice())->getInvoices([
            "spo_id" => $req->spo_id,
            "spoi_id" => $req->spoi_id,
            "spoi_nomer" => $req->spoi_nomer,
        ]);
        return json_encode($data);
    }

    function insertPoInvoice(Request $req)
    {
        $data = $req->all();
        (new SupplierPurchaseOrderInvoice())->insertInvoice($data);
    }

    function updatePoInvoice(Request $req)
    {
        $data = $req->all();
        (new SupplierPurchaseOrderInvoice())->updateInvoice($data);
    }

    function deletePoInvoice(Request $req)
    {
        $data = $req->all();
        return (new SupplierPurchaseOrderInvoice())->deleteInvoice($data);
    }

    //Invoice PO
    function getPaymentPo(Request $req)
    {
        $list = null;
        if($req->spo_id){
            $list = SupplierPurchaseOrderInvoice::where('spo_id','=',$req->spo_id)
            ->where('spoi_status','!=','Deleted')->select("spoi_id")->get();
        }
        $data =  (new SupplierPurchaseOrderPayment())->getPayment([
            "spoi_id" => $req->spoi_id,
            "spop_id" => $req->spop_id,
            "list_spoi" => $list
        ]);
        return json_encode($data);
    }

    function insertPaymentPo(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["spop_img"] = $this->insertFile($req->main, "payment");
        return (new SupplierPurchaseOrderPayment())->insertPayment($data);
    }

    function updatePaymentPo(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["spop_img"] = $this->insertFile($req->main, "payment");
        return (new SupplierPurchaseOrderPayment())->updatePayment($data);
    }

    function deletePaymentPo(Request $req)
    {
        $data = $req->all();
        return (new SupplierPurchaseOrderPayment())->deletePayment($data);
    }

        //lain lain
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

    function fetchPengaturan()
    {
        $data = pengaturan::all();
        $param = [];
        foreach ($data as $key => $value) {
            $param[$value["pengaturan_nama"]] = $value["pengaturan_value"];
        };
        return $param;
    }
}
