<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPrice extends Model
{
    protected $table = "customer_prices";
    protected $primaryKey = "cp_id";
    public $timestamps = true;
    public $incrementing = true;

    function getCustomerPrice($data = [])
    {
        $data = array_merge([
            "cp_id"=>null,
            "pr_id"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["pr_id"]) $result->where('city_id','=',$data["pr_id"]);
        if($data["cp_id"]) $result->where('cp_id','=',$data["cp_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();
        
         foreach ($result as $key => $value) {
            
                $p = Product::find($value->pr_id);
                $c = Category::find($p->c_id);
                $value->pr_name = $p->pr_name;
                $value->pr_sku = $p->pr_sku;
                $value->pr_barcode = $p->pr_barcode;
                $value->pr_price = $value->cp_price;
                $value->pr_deskripsi = $p->pr_deskripsi;
                $value->pr_img = $p->pr_img;
                $value->c_name = $c->category_name;
                $c =  Category::find($p->c_id);
                $pu = Product_unit::find($p->pu_id);
                $value->list_price = product_price::where('pr_id', $p->pr_id)->where('status','=', 1)->get();
                $value->list_variasi = product_variasi::where('product_variasis.pr_id', $p->pr_id)
                ->where('product_variasis.status','=', 1)
                ->leftJoin('product_variants as pv','product_variasis.pv_id','pv.pv_id')
                ->select('product_variasis.*','pv.pv_name')
                ->get();
                $value->pu_id = $pu->pu_id;   
                $value->pu_name = $pu->pu_short_name;
         
        }
        
        return $result;
    }

    function insertCustomerPrice($data)
    {
        $t = new self();
        $t->cus_id = $data["cus_id"];
        if(isset($data["pr_id"]))$t->pr_id = $data["pr_id"];
        $t->cp_price = $data["cp_price"];
        $t->save();
        return $t->cp_id;
    }

    function updateCustomerPrice($data)
    {
        $t = self::find($data["cp_id"]);
        $t->cus_id = $data["cus_id"];
        if(isset($data["pr_id"]))$t->pr_id = $data["pr_id"];
        $t->cp_price = $data["cp_price"];
        $t->save();
        return $t->cp_id;
    }

    function deleteCustomerPrice($data)
    {
        $t = self::find($data["cp_id"]);
        $t->status = 0;
        $t->save();
    }
}
