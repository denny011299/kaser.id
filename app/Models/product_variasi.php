<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_variasi extends Model
{
     protected $table = "product_variasis";
    protected $primaryKey = "pvs_id";
    public $timestamps = true;
    public $incrementing = true;

    function getProductVariant($data = [])
    {
        $data = array_merge([
            "pvs_name"=>null,
            "pr_id"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["pvs_name"]) $result->where('pvs_name','like','%'.$data["pvs_name"].'%');
        if($data["pr_id"]) $result->where('pr_id','=',$data["pr_id"]);
        $result->orderBy('created_at', 'asc');
       
        return $result->get();
    }

    function insertProductVariant($data)
    {
        $t = new self();
        $t->pvs_name = $data["pvs_name"];
        $t->pr_id = $data["pr_id"];
        $t->pv_id = $data["pv_id"];
        $t->pvs_sku = $data["pvs_sku"];
        $t->pvs_stok = $data["pvs_stok"];
        $t->save();
        return $t->pvs_id;
    }

    function updateProductVariant($data)
    {
        $t = self::find($data["pvs_id"]);
        $t->pvs_name = $data["pvs_name"];
        $t->pr_id = $data["pr_id"];
        $t->pv_id = $data["pv_id"];
        $t->pvs_sku = $data["pvs_sku"];
        $t->pvs_stok = $data["pvs_stok"];
        $t->save();
        return $t->pvs_id;
    }

    function deleteProductVariant($data)
    {
        $t = self::find($data["pvs_id"]);
        $t->status = 0;
        $t->save();
    }
}
