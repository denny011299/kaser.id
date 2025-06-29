<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $table = "sales_orders";
    protected $primaryKey = "so_id";
    public $timestamps = true;
    public $incrementing = true;

    function getSalesOrder($data = [])
    {
        $data = array_merge([
            "so_id" => null,
            "cus_id" => null,
            "cus_status" => null
        ], $data);

        $q = self::where('so_status', '!=', 'cancelled');

        if ($data["so_id"])       $q->where("so_id", $data["so_id"]);
        if ($data["cus_id"])        $q->where("sp_id", $data["cus_id"]);
        if ($data["cus_status"])   $q->where("cus_status", $data["cus_status"]);

        $q->orderBy('so_tanggal', 'desc');

        $result = $q->get();

        foreach ($result as $key => $value) {
            $sup = Customer::find($value->cus_id);
            $value->customer_name = $sup->cus_name;

            $value->items = (new SalesOrderDetail())->getDetails(["so_id"=>$value->so_id]);
        }
        
        return $result;
    }

    function insertSalesOrder($data)
    {
        $t = new self();
        $t->so_nomer        = $this->generateSONumber();
        $t->cus_id            = $data["cus_id"];
        $t->so_tanggal       = $data["so_tanggal"];
        $t->so_from_company = $data["so_from_company"];
        $t->so_from_address = $data["so_from_address"];
        $t->so_from_nomer   = $data["so_from_nomer"];
        $t->so_to_company   = $data["so_to_company"];
        $t->so_to_address   = $data["so_to_address"];
        $t->so_to_nomer     = $data["so_to_nomer"];
        $t->so_sign_by      = $data["so_sign_by"];
        $t->so_status       = isset($data["so_status"]) ? $data["so_status"] : 'Submitted';
        $t->so_total        = $data["so_total"];
        $t->so_total_ppn        = $data["so_total_ppn"];
        $t->save();
        return $t->so_id;
    }

    function updateSalesOrder($data)
    {
        $t = self::find($data["spo_id"]);
        $t->so_nomer        = $this->generateSONumber();
        $t->cus_id            = $data["cus_id"];
        $t->so_tanggal       = $data["so_tanggal"];
        $t->so_from_company = $data["so_from_company"];
        $t->so_from_address = $data["so_from_address"];
        $t->so_from_nomer   = $data["so_from_nomer"];
        $t->so_to_company   = $data["so_to_company"];
        $t->so_to_address   = $data["so_to_address"];
        $t->so_to_nomer     = $data["so_to_nomer"];
        $t->so_sign_by      = $data["so_sign_by"];
        $t->so_status       = isset($data["so_status"]) ? $data["so_status"] : 'Submitted';
        $t->so_total        = $data["so_total"];
        $t->so_total_ppn        = $data["so_total_ppn"];
        $t->save();
        return $t->so_id;
    }

    function deleteSalesOrder($data)
    {
        $t = self::find($data["so_id"]);
        $t->so_status = "cancelled";
        $t->save();
    }

    function generateSONumber()
    {
        $latest = self::max('so_id');
        $latest = is_null($latest) ? 1 : $latest + 1;
        return "SO" . str_pad($latest, 5, "0", STR_PAD_LEFT);
    }
}
