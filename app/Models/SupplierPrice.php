<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPrice extends Model
{
    protected $table = "supplier_prices";
    protected $primaryKey = "spr_id";
    public $timestamps = true;
    public $incrementing = true;

    function getSupplierPrice($data = [])
    {
        $data = array_merge([
            "spr_id"=>null,
            "pr_id"=>null,
            "sp_id"=>null
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["pr_id"]) $result->where('city_id','=',$data["pr_id"]);
        if($data["sp_id"]) $result->where('sp_id','=',$data["sp_id"]);
        if($data["spr_id"]) $result->where('spr_id','=',$data["spr_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();
        
         foreach ($result as $key => $value) {
            $p = product_price::find($value->pr_id);
            $value->pr_name = $p->pr_name;
            $value->pr_sku = $p->pr_sku;
            $value->pr_barcode = $p->pr_barcode;
            $value->pr_price = $value->spr_price;
            $value->pr_deskripsi = $p->pr_deskripsi;
            $value->pr_img = $p->pr_img;
        }
        
        return $result;
    }

    function insertSupplierPrice($data)
    {
        $t = new self();
        $t->sp_id = $data["sp_id"];
        $t->pr_id = $data["pr_id"];
        $t->spr_id = $data["spr_id"];
        $t->save();
        return $t->pu_id;
    }

    function updateSupplierPrice($data)
    {
        $t = self::find($data["spr_id"]);
         $t->sp_id = $data["sp_id"];
        $t->pr_id = $data["pr_id"];
        $t->spr_id = $data["spr_id"];
        $t->save();
        return $t->pu_id;
    }

    function deleteSupplierPrice($data)
    {
        $t = self::find($data["spr_id"]);
        $t->status = 0;
        $t->save();
    }
}
