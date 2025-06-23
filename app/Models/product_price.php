<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_price extends Model
{
    protected $table = "product_prices";
    protected $primaryKey = "pp_id";
    public $timestamps = true;
    public $incrementing = true;

    function getProductPrice($data = [])
    {
        $data = array_merge([
            "pr_id"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["pr_id"]) $result->where('pr_id','=',$data["pr_id"]);
        $result->orderBy('created_at', 'asc');
       
        return $result->get();
    }

    function insertProductPrice($data)
    {
        $t = new self();
        $t->pr_id = $data["pr_id"];
        $t->pp_from = $data["pp_from"];
        $t->pp_to = $data["pp_to"];
        $t->pp_price = $data["pp_price"];
        $t->save();
        return $t->pp_id;
    }

    function updateProductPrice($data)
    {
        $t = self::find($data["pp_id"]);
        $t->pr_id = $data["pr_id"];
        $t->pp_from = $data["pp_from"];
        $t->pp_to = $data["pp_to"];
        $t->pp_price = $data["pp_price"];
        $t->save();
        return $t->pp_id;
    }

    function deleteProductPrice($data)
    {
        $t = self::find($data["pp_id"]);
        $t->status = 0;
        $t->save();
    }
}
