<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bundling extends Model
{
    protected $table = "bundlings";
    protected $primaryKey = "bd_id";
    public $timestamps = true;
    public $incrementing = true;
    
    function getBundling($data = [])
    {
        $data = array_merge([
            "bd_name"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["bd_name"]) $result->where('bd_name','like','%'.$data["bd_name"].'%');
        $result->orderBy('created_at', 'asc');
       
        return $result->get();
    }

    function insertBundling($data)
    {
        $t = new self();
        $t->bd_name = $data["bd_name"];
        $t->bd_price = $data["bd_price"];
        $t->bd_desc = $data["bd_desc"];
        $t->bd_products = $data["bd_products"];
        if(isset($data["bd_img"])) $t->bd_img = $data["bd_img"];
        $t->save();
        return $t->bd_id;
    }

    function updateBundling($data)
    {
        $t = self::find($data["bd_id"]);
        $t->bd_name = $data["bd_name"];
        $t->bd_price = $data["bd_price"];
        $t->bd_desc = $data["bd_desc"];
        $t->bd_products = $data["bd_products"];
        if(isset($data["bd_img"])) $t->bd_img = $data["bd_img"];
        $t->save();
        return $t->bd_id;
    }

    function deleteBundling($data)
    {
        $t = self::find($data["bd_id"]);
        $t->status = 0;
        $t->save();
    }
}
