<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPurchaseOrderDetail extends Model
{
    protected $table = "supplier_purchase_order_details";
    protected $primaryKey = "spod_id";
    public $timestamps = true;
    public $incrementing = true;

    function getDetails($data = [])
    {
        $data = array_merge([
            "spo_id" => null,
            "spod_type" => null,
            "status" => 1
        ], $data);

        $q = self::where("status", $data["status"]);

        if ($data["spo_id"]) $q->where("spo_id", $data["spo_id"]);
        if ($data["spod_type"]) $q->where("spod_type", $data["spod_type"]);

        return $q->orderBy("created_at", "asc")->get();
    }

    function insertDetail($data)
    {
        $t = new self();
        $t->spo_id        = $data["spo_id"];
        $t->spod_type     = $data["spod_type"];
        $t->spod_value_id = $data["spod_value_id"];
        $t->spod_nama     = $data["spod_nama"];
        $t->spod_variant  = $data["spod_variant"] ?? null;
        $t->spod_harga    = $data["spod_harga"];
        $t->spod_qty      = $data["spod_qty"];
        $t->spod_subtotal = $data["spod_subtotal"];
        $t->save();
        return $t->spod_id;
    }

    function updateDetail($data)
    {
        $t = self::find($data["spod_id"]);
        $t->spo_id        = $data["spo_id"];
        $t->spod_type     = $data["spod_type"];
        $t->spod_value_id = $data["spod_value_id"];
        $t->spod_nama     = $data["spod_nama"];
        $t->spod_variant  = $data["spod_variant"] ?? null;
        $t->spod_harga    = $data["spod_harga"];
        $t->spod_qty      = $data["spod_qty"];
        $t->spod_subtotal = $data["spod_subtotal"];
        $t->save();
        return $t->spod_id;
    }

    function deleteDetail($id)
    {
        $t = self::find($id);
        $t->status = 0;
        $t->save();
    }

}
