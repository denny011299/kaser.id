<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPurchaseOrder extends Model
{
    protected $table = "supplier_purchase_orders";
    protected $primaryKey = "spo_id";
    public $timestamps = true;
    public $incrementing = true;

    function getPurchaseOrder($data = [])
    {
        $data = array_merge([
            "spo_id" => null,
            "sp_id" => null,
            "spo_status" => null
        ], $data);

        $q = self::where('spo_status', '!=', 'cancelled');

        if ($data["spo_id"])       $q->where("spo_id", $data["spo_id"]);
        if ($data["sp_id"])        $q->where("sp_id", $data["sp_id"]);
        if ($data["spo_status"])   $q->where("spo_status", $data["spo_status"]);

        $q->orderBy('spo_tanggal', 'desc');

        $result = $q->get();

        foreach ($result as $key => $value) {
            $sup = Supplier::find($value->sp_id);
            $value->supplier_name = $sup->sp_name;

            $value->items = (new SupplierPurchaseOrderDetail)->getDetails(["spo_id"=>$value->spo_id]);
        }
        
        return $result;
    }

    function insertPurchaseOrder($data)
    {
        $t = new self();
        $t->spo_nomer        = $this->generatePONumber();
        $t->sp_id            = $data["sp_id"];
        $t->spo_tanggal       = $data["spo_tanggal"];
        $t->spo_from_company = $data["spo_from_company"];
        $t->spo_from_address = $data["spo_from_address"];
        $t->spo_from_nomer   = $data["spo_from_nomer"];
        $t->spo_to_company   = $data["spo_to_company"];
        $t->spo_to_address   = $data["spo_to_address"];
        $t->spo_to_nomer     = $data["spo_to_nomer"];
        $t->spo_sign_by      = $data["spo_sign_by"];
        $t->spo_status       = isset($data["spo_status"]) ? $data["spo_status"] : 'Submitted';
        $t->spo_total        = $data["spo_total"];
        $t->spo_total_ppn        = $data["spo_total_ppn"];
        $t->save();
        return $t->spo_id;
    }

    function updatePurchaseOrder($data)
    {
        $t = self::find($data["spo_id"]);
        $t->sp_id            = $data["sp_id"];
        $t->spo_tanggal       = $data["spo_tanggal"];
        $t->spo_from_company = $data["spo_from_company"];
        $t->spo_from_address = $data["spo_from_address"];
        $t->spo_from_nomer   = $data["spo_from_nomer"];
        $t->spo_to_company   = $data["spo_to_company"];
        $t->spo_to_address   = $data["spo_to_address"];
        $t->spo_to_nomer     = $data["spo_to_nomer"];
        $t->spo_sign_by      = $data["spo_sign_by"];
        $t->spo_status       = $data["spo_status"];
        $t->spo_total        = $data["spo_total"];
        $t->spo_total_ppn        = $data["spo_total_ppn"];
        $t->save();
        return $t->spo_id;
    }

    function deletePurchaseOrder($data)
    {
        $t = self::find($data["spo_id"]);
        $t->spo_status = "cancelled";
        $t->save();
    }

    function generatePONumber()
    {
        $latest = self::max('spo_id');
        $latest = is_null($latest) ? 1 : $latest + 1;
        return "PO" . str_pad($latest, 5, "0", STR_PAD_LEFT);
    }
}
