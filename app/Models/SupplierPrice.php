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
            "sp_id"=>null,
            "type"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["pr_id"]) $result->where('city_id','=',$data["pr_id"]);
        if($data["sp_id"]) $result->where('sp_id','=',$data["sp_id"]);
        if($data["spr_id"]) $result->where('spr_id','=',$data["spr_id"]);
        if($data["type"]==1) $result->whereNotNull('pr_id');
        else $result->whereNotNull('sup_id');
        $result->orderBy('created_at', 'asc');
        $result = $result->get();
        
         foreach ($result as $key => $value) {
            if($value["sup_id"]!=null){
                $s = Supplies::find($value->sup_id);
                $value->sup_name = $s->sup_name;
                $value->sup_sku = $s->sup_sku;
            }
            else{
                $p = Product::find($value->pr_id);
                $c = Category::find($p->c_id);
                $value->pr_name = $p->pr_name;
                $value->pr_sku = $p->pr_sku;
                $value->pr_barcode = $p->pr_barcode;
                $value->pr_price = $value->spr_price;
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

        }
        
        return $result;
    }

    function insertSupplierPrice($data)
    {
        $t = new self();
        $t->sp_id = $data["sp_id"];
        if(isset($data["pr_id"]))$t->pr_id = $data["pr_id"];
        if(isset($data["sup_id"]))$t->sup_id = $data["sup_id"];
        $t->spr_price = $data["spr_price"];
        $t->save();
        return $t->spr_id;
    }

    function updateSupplierPrice($data)
    {
        $t = self::find($data["spr_id"]);
        $t->sp_id = $data["sp_id"];
        if(isset($data["pr_id"]))$t->pr_id = $data["pr_id"];
        if(isset($data["sup_id"]))$t->sup_id = $data["sup_id"];
        $t->spr_price = $data["spr_price"];
        $t->save();
        return $t->spr_id;
    }

    function deleteSupplierPrice($data)
    {
        $t = self::find($data["spr_id"]);
        $t->status = 0;
        $t->save();
    }
}
