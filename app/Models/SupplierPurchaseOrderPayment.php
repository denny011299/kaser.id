<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPurchaseOrderPayment extends Model
{
    protected $table = "supplier_purchase_order_payments";
    protected $primaryKey = "spop_id";
    public $timestamps = true;
    public $incrementing = true;

    function getPayment($data = [])
    {
        $data = array_merge([
            "spoi_id"=>null,
            "spop_id"=>null,
            "list_spoi"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["spoi_id"]) $result->where('spoi_id','=',$data["spoi_id"]);
        if($data["spop_id"]) $result->where('spop_id','=',$data["pu_full_name"]);
        if($data["list_spoi"]) $result->whereIn('spoi_id',$data["list_spoi"]);
        $result->orderBy('spop_date', 'desc');
        $result =$result->get();
        
        foreach ($result as $key => $value) {
            $value->spoi_nomer = SupplierPurchaseOrderInvoice::find($value->spoi_id)->spoi_nomer;
        }

        return $result;
    }

    function insertPayment($data)
    {
        $t = new self();
        $t->spoi_id = $data["spoi_id"];
        $t->spop_date = $data["spop_date"];
        $t->spop_total = $data["spop_total"];
        $t->spop_type = $data["spop_type"];
        if(isset($data["spop_img"])) $t->spop_img = $data["spop_img"];
        $t->save();
       
        $inv = SupplierPurchaseOrderInvoice::find($t->spoi_id);
        $total = self::where('spoi_id','=',$data["spoi_id"])->where('status','=',1)->sum("spop_total");
        if($total>=$inv->spoi_total){
            $inv->spoi_status = "Paid";
        }
        else if($total<=$inv->spoi_total&&$total>0){
            $inv->spoi_status = "Half Paid";
        }
        else{
             $inv->spoi_status = "Unpaid";
        }
        $inv->save();
        $paid = SupplierPurchaseOrderInvoice::where('spo_id','=',$inv->spo_id)->select("spoi_id")->get();
        $paid = SupplierPurchaseOrderPayment::where('status','=',1)->whereIn("spoi_id",$paid)->sum("spop_total");
        $po = SupplierPurchaseOrder::find($inv->spo_id);
        if($paid>=$po->spo_total){
            $po->spo_status ="Done";
        }
        else{
            $po->spo_status ="Invoice";
        }
        $po->save();
        return $po;
    }

    function updatePayment($data)
    {
        $t = self::find($data["spop_id"]);
        $t->spoi_id = $data["spoi_id"];
        $t->spop_date = $data["spop_date"];
        $t->spop_total = $data["spop_total"];
        $t->spop_type = $data["spop_type"];
        if(isset($data["spop_img"])) $t->spop_img = $data["spop_img"];
        $t->save();

        $inv = SupplierPurchaseOrderInvoice::find($t->spoi_id);
        $total = self::where('spoi_id','=',$data["spoi_id"])->where('status','=',1)->sum("spop_total");
        if($total>=$inv->spoi_total){
            $inv->spoi_status = "Paid";
        }
        else if($total<=$inv->spoi_total&&$total>0){
            $inv->spoi_status = "Half Paid";
        }
        else{
             $inv->spoi_status = "Unpaid";
        }
        $inv->save();
        $paid = SupplierPurchaseOrderInvoice::where('spo_id','=',$inv->spo_id)->select("spoi_id")->get();
        $paid = SupplierPurchaseOrderPayment::where('status','=',1)->whereIn("spoi_id",$paid)->sum("spop_total");
        $po = SupplierPurchaseOrder::find($inv->spo_id);
        if($paid>=$po->spo_total){
            $po->spo_status ="Done";
        }
        else{
            $po->spo_status ="Invoice";
        }
        $po->save();
        return $po;
    }

    function deletePayment($data)
    {
        $t = self::find($data["spop_id"]);
        $t->status = 0;
        $t->save();

        $inv = SupplierPurchaseOrderInvoice::find($t->spoi_id);
        $total = self::where('spoi_id','=',$t->spoi_id)->where('status','=',1)->sum("spop_total");

        if($total>=$inv->spoi_total){
            $inv->spoi_status = "Paid";
        }
        else if($total<=$inv->spoi_total&&$total>0){
            $inv->spoi_status = "Half Paid";
        }
        else{
             $inv->spoi_status = "Unpaid";
        }
        $paid = SupplierPurchaseOrderInvoice::where('spoi_id','=',$t->spoi_id)->where('spoi_status',"Paid")->sum("spoi_total");
        $po = SupplierPurchaseOrder::find($inv->spo_id);
        if($paid>=$po["spo_total"]){

            $po->spo_status ="Done";
        }
        else{
            $po->spo_status ="Invoice";
        }
        $po->save();
    }
}
