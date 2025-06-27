<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderDetail extends Model
{
    protected $table = "sales_order_details";
    protected $primaryKey = "sod_id";
    public $timestamps = true;
    public $incrementing = true;

    function getDetails($data = [])
    {
        $data = array_merge([
            "so_id" => null,
            "status" => 1
        ], $data);

        $q = self::where("status", $data["status"]);

        if ($data["so_id"]) $q->where("so_id", $data["so_id"]);

        return $q->orderBy("created_at", "asc")->get();
    }

    function insertDetail($data)
    {
        $t = new self();
        $t->so_id       = $data["so_id"];
        $t->pr_id        = $data["pr_id"];
        $t->sod_nama     = $data["sod_nama"];
        $t->sod_variant  = $data["sod_variant"] ?? null;
        $t->sod_harga    = $data["sod_harga"];
        $t->sod_qty      = $data["sod_qty"];
        $t->sod_subtotal = $data["sod_subtotal"];
        $t->save();
        return $t->sod_id;
    }

    function updateDetail($data)
    {
        $t = self::find($data["sod_id"]);
        $t->so_id       = $data["so_id"];
        $t->pr_id        = $data["pr_id"];
        $t->sod_nama     = $data["sod_nama"];
        $t->sod_variant  = $data["sod_variant"] ?? null;
        $t->sod_harga    = $data["sod_harga"];
        $t->sod_qty      = $data["sod_qty"];
        $t->sod_subtotal = $data["sod_subtotal"];
        $t->save();
        return $t->sod_id;
    }

    function deleteDetail($id)
    {
        $t = self::find($id);
        $t->status = 0;
        $t->save();
    }
}
