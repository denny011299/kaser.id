<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    protected $table = "stock_opnames";
    protected $primaryKey = "stp_id";
    public $timestamps = true;
    public $incrementing = true;

    function getStockOpname($data = [])
    {
        $data = array_merge([
            "stp_nomer"=>null,
            "stp_type"=>null,
            "stp_date"=>null,
            "stp_id"=>null,
        ], $data);
     
        $result = self::where('status', '=', 1);
        if($data["stp_nomer"]) $result->where('stp_nomer','like',"%".$data["stp_nomer"]."%");
        if($data["stp_type"]) $result->where('stp_type','=',$data["stp_type"]);
        if($data["stp_date"]) $result->whereDate('stp_date','=',$data["stp_date"]);
        if($data["stp_id"]) $result->where('stp_id','=',$data["stp_id"]);
    
        $result->orderBy('created_at', 'asc');
       
        $result =   $result->get();
  
        foreach ($result as $key => $item) {
          //  $item->item = (new StockOpnameDetail())->getDetailStockOpname(["stpd_id"=>$item->stpd_id]);
          if($item["category_id"]!=null){
                try {
                     $item["category_name"] = Category::find($item["category_id"])->category_name;
                } catch (\Throwable $th) {
                    $item["category_name"] = "All";
                }
               
          }
        }

        return $result;
    }

    function insertStockOpname($data)
    {
        $t = new self();
        $t->stp_nomer = $this->generateSTNumber();
        $t->stp_date = now();
        $t->stp_type = $data["stp_type"];
        $t->created_by = $data["created_by"];
        if(isset($data["category_id"]))$t->category_id = $data["category_id"];
        $t->save();
        return $t->stp_id;
    }

    function updateStockOpname($data)
    {
        $t = self::find($data["stp_id"]);
        $t->stp_type = $data["stp_type"];
        $t->created_by = $data["created_by"];
        if(isset($data["category_id"]))$t->category_id = $data["category_id"];
        $t->save();
        return $t->stp_id;
    }

    function deleteStockOpname($data)
    {
        $t = self::find($data["stp_id"]);
        $t->status = 0;
        $t->save();
    }
    
    function generateSTNumber()
    {
        $latest = self::max('stp_id');
        $latest = is_null($latest) ? 1 : $latest + 1;
        return "STK" . str_pad($latest, 5, "0", STR_PAD_LEFT);
    }
}
