<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerPrice;
use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderDetail;
use App\Models\pengaturan;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use App\Models\SalesOrderDetailInvoice;
use App\Models\SalesOrderDetailPayment;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //Supplier
    function customer() {
        return view('Backoffice.Customer.Customer');
    }
    
    function customerDetail($id) {
        $param["data"] =(new Customer)->getCustomer(["cus_id"=>$id])[0];
        $param["cus_id"] =$id;
        return view('Backoffice.Customer.Customer_detail')->with($param);
    }

    function getCustomer(Request $req)
    {
        $data =  (new Customer())->getCustomer([
            "cus_name"=>$req->cus_name,
            "city_id"=>$req->city_id
        ]);
        return json_encode($data);
    }

    function insertCustomer(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["cus_img"] = $this->insertFile($req->main, "customer");
        return (new Customer())->insertCustomer($data);
    }

    function updateCustomer(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["cus_img"] = $this->insertFile($req->main, "customer");
        (new Customer())->updateCustomer($data);
    }

    function deleteCustomer(Request $req)
    {
        $data = $req->all();
        return (new Customer())->deleteCustomer($data);
    }

    //Supplier Price + Product
    function getCustomerPrice(Request $req)
    {
        $data =  (new CustomerPrice())->getCustomerPrice([
            "cp_id" => $req->cp_id,
            "pr_id" => $req->pr_id,
        ]);
        return json_encode($data);
    }

    function insertCustomerPrice(Request $req)
    {
        $data = $req->all();
        (new CustomerPrice())->insertCustomerPrice($data);
    }

    function updateCustomerPrice(Request $req)
    {
        $data = $req->all();
        (new CustomerPrice())->updateCustomerPrice($data);
    }

    function deleteCustomerPrice(Request $req)
    {
        $data = $req->all();
        return (new CustomerPrice())->deleteCustomerPrice($data);
    }

     //Purchase Order
    function salesOrder() {
        return view('Backoffice.Customer.SalesOrder');
    }

    function createSalesOrder() {
        $param = $this->fetchPengaturan();
        return view('Backoffice.Customer.createSalesOrder')->with($param);
    }
    
    function salesOrderDetail($id) {
        $param["dataPo"] = (new SalesOrder())->getSalesOrder(["so_id"=>$id])[0];
        $param["data"] =(new customer)->getCustomer(["cus_id"=>$param["dataPo"]["cus_id"]])[0];
        $param["so_id"] =$id;
        return view('Backoffice.Customer.SalesOrderDetail')->with($param);
    }
    
    function getSalesOrder(Request $req)
    {
        $data =  (new SalesOrder())->getSalesOrder([
            "so_id" => $req->so_id,
            "cus_id" => $req->cus_id,
            "so_status" => $req->so_status,
        ]);
        return json_encode($data);
    }

    function insertSalesOrder(Request $req)
    {
        $data = $req->all();
        $cs = customer::find($data["cus_id"]);
        $param = $this->fetchPengaturan();
        $data["so_from_company"] = $param["company_name"];
        $data["so_from_address"] = $param["company_nomor"];
        $data["so_from_nomer"] = $param["company_address"];
        $data["so_to_company"] = $cs->cus_name;
        $data["so_to_address"] = $cs->cus_address;
        $data["so_to_nomer"] = $cs->sp_nomer;
        $id = (new SalesOrder())->insertSalesOrder($data);
        foreach (json_decode($req->list_product,true) as $key => $value) {
            $value["so_id"] = $id;
            $value["pr_id"] = $value["pr_id"];
            if($value["variant"])$value["sod_variant"] = json_encode($value["variant"]);
            $value["sod_nama"] = $value["fullname"];
            $value["sod_harga"] = $value["price"];
            $value["sod_qty"] = $value["qty"];
            $value["sod_subtotal"] = $value["subtotal"];
            (new SalesOrderDetail())->insertDetail($value);
        }
        return $id;
    }

    function updateSalesOrder(Request $req)
    {
        $data = $req->all();
        (new salesOrder())->updateSalesOrder($data);
    }

    function deleteSalesOrder(Request $req)
    {
        $data = $req->all();
        return (new salesOrder())->deleteSalesOrder($data);
    }

    //Invoice PO
    function getPaymentSo(Request $req)
    {
        $list = null;
        if($req->spo_id){
            $list = SalesOrderDetailPayment::where('so_id','=',$req->so_id)
            ->where('soi_status','!=','Deleted')->select("soi_id")->get();
        }
        $data =  (new SalesOrderDetailPayment())->getPayment([
            "soi_id" => $req->soi_id,
            "sop_id" => $req->sop_id,
            "list_soi" => $list
        ]);
        return json_encode($data);
    }

    function insertPaymentSo(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["sop_img"] = $this->insertFile($req->main, "payment");
        return (new SalesOrderDetailPayment())->insertPayment($data);
        
    }

    function updatePaymentSo(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["sop_img"] = $this->insertFile($req->main, "payment");
        return (new SalesOrderDetailPayment())->updatePayment($data);
    }

    function deletePaymentSo(Request $req)
    {
        $data = $req->all();
        return (new SalesOrderDetailPayment())->deletePayment($data);
    }


     //Invoice PO
    function getSoInvoice(Request $req)
    {
        $data =  (new SalesOrderDetailInvoice())->getInvoices([
            "spo_id" => $req->spo_id,
            "spoi_id" => $req->spoi_id,
            "spoi_nomer" => $req->spoi_nomer,
        ]);
        return json_encode($data);
    }

    function insertSoInvoice(Request $req)
    {
        $data = $req->all();
        (new SalesOrderDetailInvoice())->insertInvoice($data);
    }

    function updateSoInvoice(Request $req)
    {
        $data = $req->all();
        (new SalesOrderDetailInvoice())->updateInvoice($data);
    }

    function deleteSoInvoice(Request $req)
    {
        $data = $req->all();
        return (new SalesOrderDetailInvoice())->deleteInvoice($data);
    }

      //DO
    function getDo(Request $req)
    {
        $data =  (new DeliveryOrder())->getDeliveryOrders([
            "so_id" => $req->so_id,
        ]);
        return json_encode($data);
    }

    function insertDO(Request $req)
    {
        $data = $req->all();
        $do_id = (new DeliveryOrder())->insertDo($data);
        foreach (json_decode($data["do_item"]) as $key => $value) {
            $value->do_id = $do_id;
            (new DeliveryOrderDetail())->insertDeliveryOrderDetail((array)$value);
        }
    }

    function updateDo(Request $req)
    {
        $list_id = [];
        $data = $req->all();
        (new DeliveryOrder())->updateDo($data);
        
         foreach (json_decode($data["do_item"]) as $key => $value) {
            $value->do_id = $req->do_id;
           
            if($value->dod_id){
                $dod_id = (new DeliveryOrderDetail())->updateDeliveryOrderDetail((array)$value);
            }
            else{
                $dod_id = (new DeliveryOrderDetail())->insertDeliveryOrderDetail((array)$value);
            }
            array_push($list_id,$dod_id);
        }
        DeliveryOrderDetail::where('do_id','=',$req->do_id)->whereNotIn('dod_id',$list_id)->delete();
    }

    function deleteDo(Request $req)
    {
        $data = $req->all();
        return (new DeliveryOrder())->deleteDo($data);
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
