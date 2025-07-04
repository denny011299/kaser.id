<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderDetailPayment extends Model
{
    protected $table = "sales_order_payments";
    protected $primaryKey = "sop_id";
    public $timestamps = true;
    public $incrementing = true;

    function getPayment($data = [])
    {
        $data = array_merge([
            "soi_id"=>null,
            "sop_id"=>null,
            "list_soi"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["soi_id"]) $result->where('soi_id','=',$data["soi_id"]);
        if($data["sop_id"]) $result->where('sop_id','=',$data["sop_id"]);
        if($data["list_soi"]) $result->whereIn('soi_id',$data["list_soi"]);
        $result->orderBy('sop_date', 'desc');
        $result =$result->get();
        
        foreach ($result as $key => $value) {
            $value->soi_nomer = SalesOrderDetailInvoice::find($value->soi_id)->soi_nomer;
        }

        return $result;
    }

    function insertPayment($data)
    {
        $t = new self();
        $t->soi_id = $data["soi_id"];
        $t->sop_date = $data["sop_date"];
        $t->sop_total = $data["sop_total"];
        $t->sop_type = $data["sop_type"];
        if(isset($data["sop_img"])) $t->sop_img = $data["sop_img"];
        $t->save();
       
        $inv = SalesOrderDetailInvoice::find($t->soi_id);
    
        $total = self::where('soi_id','=',$data["soi_id"])->where('status','=',1)->sum("sop_total");
        if($total>=$inv->soi_total){
            $inv->soi_status = "Paid";
        }
        else if($total<=$inv->soi_total&&$total>0){
            $inv->soi_status = "Half Paid";
        }
        else{
             $inv->soi_status = "Unpaid";
        }
        $inv->save();
        $paid = SalesOrderDetailInvoice::where('so_id','=',$inv->so_id)->select("soi_id")->get();
        $paid = SalesOrderDetailPayment::where('status','=',1)->whereIn("soi_id",$paid)->sum("sop_total");
        $po = SalesOrder::find($inv->so_id);
        if($paid>=$po->so_total){
            $po->so_status ="Done";
        }
        else{
            $po->so_status ="Invoice";
        }
        $po->save();
        return $po;
    }

    function updatePayment($data)
    {
        $t = self::find($data["spop_id"]);
        $t->soi_id = $data["soi_id"];
        $t->sop_date = $data["sop_date"];
        $t->sop_total = $data["sop_total"];
        $t->sop_type = $data["sop_type"];
        if(isset($data["sop_img"])) $t->sop_img = $data["sop_img"];
        $t->save();
       
        $inv = SalesOrderDetailInvoice::find($t->soi_id);
    
        $total = self::where('soi_id','=',$data["soi_id"])->where('status','=',1)->sum("sop_total");
        if($total>=$inv->soi_total){
            $inv->soi_status = "Paid";
        }
        else if($total<=$inv->soi_total&&$total>0){
            $inv->soi_status = "Half Paid";
        }
        else{
             $inv->soi_status = "Unpaid";
        }
        $inv->save();
        $paid = SalesOrderDetailInvoice::where('so_id','=',$inv->so_id)->select("soi_id")->get();
        $paid = SalesOrderDetailPayment::where('status','=',1)->whereIn("soi_id",$paid)->sum("sop_total");
        $po = SalesOrder::find($inv->so_id);
        if($paid>=$po->so_total){
            $po->so_status ="Done";
        }
        else{
            $po->so_status ="Invoice";
        }
        $po->save();
        return $po;
    }

    function deletePayment($data)
    {
        $t = self::find($data["sop_id"]);
        $t->status = 0;
        $t->save();

        $inv = SalesOrderDetailInvoice::find($t->soi_id);
        $total = self::where('soi_id','=',$t->soi_id)->where('status','=',1)->sum("sop_total");
        
        if($total>=$inv->soi_total){
            $inv->soi_status = "Paid";
        }
        else if($total<=$inv->soi_total&&$total>0){
            $inv->soi_status = "Half Paid";
        }
        else{
             $inv->soi_status = "Unpaid";
        }
        $inv->save();
        $paid = SalesOrderDetailInvoice::where('soi_id','=',$t->soi_id)->where('soi_status',"Paid")->sum("soi_total");
        $po = SalesOrder::find($inv->so_id);
        if($paid>=$po["so_total"]){

            $po->so_status ="Done";
        }
        else{
            $po->so_status ="Invoice";
        }
        $po->save();
    }
}
