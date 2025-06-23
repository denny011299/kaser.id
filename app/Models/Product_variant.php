<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_variant extends Model
{
   protected $table = "product_variants";
    protected $primaryKey = "pv_id";
    public $timestamps = true;
    public $incrementing = true;

    function getProductVariant($data = [])
    {
        $data = array_merge([
            "pv_name"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["pv_name"]) $result->where('pv_name','like','%'.$data["pv_name"].'%');
        $result->orderBy('created_at', 'asc');
       
        return $result->get();
    }

    function insertProductVariant($data)
    {
        $t = new self();
        $t->pv_name = $data["pv_name"];
        $t->pv_attribute = $data["pv_attribute"];
        $t->save();
        return $t->pv_id;
    }

    function updateProductVariant($data)
    {
        $t = self::find($data["pv_id"]);
        $t->pv_name = $data["pv_name"];
        $t->pv_attribute = $data["pv_attribute"];
        $t->save();
        return $t->pv_id;
    }

    function deleteProductVariant($data)
    {
        $t = self::find($data["pv_id"]);
        $t->status = 0;
        $t->save();
    }
}
