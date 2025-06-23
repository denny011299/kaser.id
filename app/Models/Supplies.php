<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    protected $table = "supplies";
    protected $primaryKey = "sup_id";
    public $timestamps = true;
    public $incrementing = true;

    function getSupplies($data = [])
    {
        $data = array_merge([
            "sup_name"=>null,
            "supplier_id"=>null,
            "sup_id"=>null
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["sup_name"]) $result->where('sup_name','like','%'.$data["sup_name"].'%');
        if($data["supplier_id"]) $result->where('supplier_id','=',$data["supplier_id"]);
        if($data["sup_id"]) $result->where('sup_id','=',$data["sup_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();
        
        return $result;
    }

    function insertSupplies($data)
    {
        $t = new self();
        $t->sup_sku = $data["sup_sku"];
        $t->sup_name = $data["sup_name"];
        $t->sup_unit = $data["sup_unit"];
        $t->sup_stock = $data["sup_stock"];
        $t->sup_buy_price = $data["sup_buy_price"];
        $t->sup_min_stok = $data["sup_min_stock"];
        $t->save();
        return $t->sup_id;
    }

    function updateSupplies($data)
    {
        $t = self::find($data["sup_id"]);
        $t->sup_sku = $data["sup_sku"];
        $t->sup_name = $data["sup_name"];
        $t->sup_unit = $data["sup_unit"];
        $t->sup_stock = $data["sup_stock"];
        $t->sup_buy_price = $data["sup_buy_price"];
        $t->sup_min_stok = $data["sup_min_stock"];
        $t->save();
        return $t->sup_id;
    }

    function deleteSupplies($data)
    {
        $t = self::find($data["sup_id"]);
        $t->status = 0;
        $t->save();
    }
}
