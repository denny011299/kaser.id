<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $primaryKey = "pr_id";
    public $timestamps = true;
    public $incrementing = true;

    function getProduct($data = [])
    {
        $data = array_merge([
            "pr_name"=>null,
            "pr_id"=>null,
            "pr_sku"=>null,
            "c_id"=>null
        ], $data);

        $result = Product::where('status', '=', 1);
        if($data["pr_name"]) $result->where('pr_name','like','%'.$data["pr_name"].'%');
        if($data["pr_sku"]) $result->where('pr_sku','like','%'.$data["pr_sku"].'%');
        if($data["pr_id"]) $result->where('pr_id','=',$data["pr_id"]);
        if($data["c_id"]) $result->where('c_id','=',$data["c_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();

        foreach($result as $item) {
            $c =  Category::find($item->c_id);
            $p = Product_unit::find($item->pu_id);
            $item->list_price = product_price::where('pr_id', $item->pr_id)->where('status','=', 1)->get();
            $item->list_variasi = product_variasi::where('product_variasis.pr_id', $item->pr_id)
            ->where('product_variasis.status','=', 1)
            ->leftJoin('product_variants as pv','product_variasis.pv_id','pv.pv_id')
            ->select('product_variasis.*','pv.pv_name')
            ->get();
           
            $item->pu_id = $p->pu_id;
            $item->pu_name = $p->pu_short_name;
            $item->c_name =$c? $c->category_name : null;
            $item->c_id =$c? $c->category_id : null;
        }
        return $result;
    }

    function insertProduct($data)
    {
        $t = new Product();
        $t->pr_name = $data["pr_name"];
        $t->pr_sku = $data["pr_sku"];
        $t->pr_deskripsi = $data["pr_deskripsi"];
        $t->pr_stock = $data["pr_stok"];
        $t->pr_price = $data["pr_price"];
        $t->pr_berat = $data["pr_berat"];
        $t->pr_exp = $data["pr_exp"];
        $t->pu_id = $data["pu_id"];
        $t->pr_alert_stok = $data["pr_alert_stok"];
        $t->c_id = $data["c_id"];
        $t->pr_barcode = isset($data["pr_barcode"]) ? $data["pr_barcode"] : $this->generateBarcode();
        if(isset($data["pr_img"]))$t->pr_img = $data["pr_img"];
        $t->save();
        return $t->pr_id;
    }

    function updateProduct($data)
    {
        $t = Product::find($data["pr_id"]);
        $t->pr_name = $data["pr_name"];
        $t->pr_sku = $data["pr_sku"];
        $t->pr_deskripsi = $data["pr_deskripsi"];
        $t->pr_stock = $data["pr_stok"];
        $t->pr_price = $data["pr_price"];
        $t->pr_berat = $data["pr_berat"];
        $t->pr_exp = $data["pr_exp"];
        $t->pu_id = $data["pu_id"];
        $t->pr_alert_stok = $data["pr_alert_stok"];
        $t->c_id = $data["c_id"];
        $t->pr_barcode = isset($data["pr_barcode"]) ? $data["pr_barcode"] : $this->generateBarcode();
        if(isset($data["pr_img"]))$t->pr_img = $data["pr_img"];
        $t->save();
        return $t->pr_id;
    }

    function deleteProduct($data)
    {
        $t = Product::find($data["pr_id"]);
        $t->status = 0;
        $t->save();
    }

    function generateBarcode() {
       do {
        // Generate angka acak sebanyak 12 digit
            $barcode = (string) random_int(100000000000, 999999999999);
        } while (self::where('pr_barcode', $barcode)->exists());
        return $barcode;
    }
}
