<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_unit extends Model
{
    protected $table = "product_units";
    protected $primaryKey = "pu_id";
    public $timestamps = true;
    public $incrementing = true;

    function getProductUnit($data = [])
    {
        $data = array_merge([
            "pu_short_name"=>null,
            "pu_full_name"=>null
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["pu_short_name"]) $result->where('pu_short_name','like','%'.$data["pu_short_name"].'%');
        if($data["pu_full_name"]) $result->where('pu_short_name','like','%'.$data["pu_full_name"].'%');
        $result->orderBy('created_at', 'asc');
       
        return $result->get();
    }

    function insertProductUnit($data)
    {
        $t = new self();
        $t->pu_short_name = $data["pu_short_name"];
        $t->pu_full_name = $data["pu_full_name"];
        $t->save();
        return $t->pu_id;
    }

    function updateProductUnit($data)
    {
        $t = self::find($data["pu_id"]);
        $t->pu_short_name = $data["pu_short_name"];
        $t->pu_full_name = $data["pu_full_name"];
        $t->save();
        return $t->pu_id;
    }

    function deleteProductUnit($data)
    {
        $t = self::find($data["pu_id"]);
        $t->status = 0;
        $t->save();
    }
}
