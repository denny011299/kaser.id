<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class manageStock extends Model
{
    protected $table = "manage_stocks";
    protected $primaryKey = "ms_id";
    public $timestamps = true;
    public $incrementing = true;

    function getManage($data = [])
    {
        $data = array_merge([
            "ms_type"=>null,
            "ms_start_date"=>null,
            "ms_end_date"=>null,
            "all"=>null,
            "type"=>2,//default = product
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["ms_type"])$result->where('ms_type','=',$data["ms_type"]);
        
        if($data["type"]==1)$result->whereNotNull('sup_id');
        else $result->whereNotNull('pr_id');

        if($data["ms_start_date"] && $data["ms_end_date"]) {
            $result->whereBetween('created_at', [$data["ms_start_date"], $data["ms_end_date"]]);
        } elseif($data["ms_start_date"]) {
            $result->where('created_at', '>=', $data["ms_start_date"]);
        } elseif($data["ms_end_date"]) {
            $result->where('created_at', '<=', $data["ms_end_date"]);
        }
        
        $result->orderBy('created_at', 'asc');
       
        $result = $result->get();
         
        foreach ($result as $key => $value) {
            $sup = Supplies::find($value->sup_id);
            if($sup){
                $value->sup_name = $sup->sup_name;
                $value->sup_unit = $sup->sup_unit;
                $value->sup_sku = $sup->sup_sku;

                $value->sup_in = manageStock::where("sup_id", $value->sup_id)
                    ->where("ms_type", 1)
                   // ->whereBetween('created_at', [$data["ms_start_date"] ?? Carbon::now(), $data["ms_end_date"] ?? Carbon::now()])
                    ->sum('ms_stock');
                $value->sup_out = manageStock::where("sup_id", $value->sup_id)
                    ->where("ms_type", 2)
                    //->whereBetween('created_at', [$data["ms_start_date"] ?? Carbon::now(), $data["ms_end_date"] ?? Carbon::now()])
                    ->sum('ms_stock');
            }
            else{
                $sup = Product::find($value->pr_id);
                if($sup){
                    $value->pr_name = $sup->pr_name;
                    $value->pr_unit = $sup->pr_unit;
                    $value->pr_sku = $sup->pr_sku;

                    $value->sup_in = manageStock::where("pr_id", $value->pr_id)
                        ->where("ms_type", 1)
                    // ->whereBetween('created_at', [$data["ms_start_date"] ?? Carbon::now(), $data["ms_end_date"] ?? Carbon::now()])
                        ->sum('ms_stock');
                    $value->sup_out = manageStock::where("pr_id", $value->pr_id)
                        ->where("ms_type", 2)
                        //->whereBetween('created_at', [$data["ms_start_date"] ?? Carbon::now(), $data["ms_end_date"] ?? Carbon::now()])
                        ->sum('ms_stock');
                }
            }
        }
 
        return $result;
    }

    function insertManage($data)
    {   
        $now = Carbon::now();
        $oneHourAgo = Carbon::now()->subHour();

        if($data["jenis_insert"] == 1) {
            $s = Supplies::where("sup_barcode","=",$data["barcode"])->first();
            if($s){
                $exists = self::where("sup_id", $s->sup_id)
                    ->where("ms_type", $data["ms_type"])
                    ->whereBetween('created_at', [$oneHourAgo, $now]);
                $ext  = $exists->count();
             
                if ($ext>0) {
                  
                   $s= $exists->first();
                   $data["sup_id"] = $s->sup_id;
                   $data["ms_id"] = $s->ms_id;
                   return $this->updateManage($data);

                }
                else{
                    $data["sup_id"] = $s->sup_id;
                }
            } else {
                return "Supplies not found";
            }
        }
        else{
            $p = Product::where("pr_barcode","=",$data["barcode"])->first();
            if($p){
                 $exists = self::where("pr_id", $p->pr_id)
                    ->where("ms_type", $data["ms_type"])
                    ->whereBetween('created_at', [$oneHourAgo, $now]);
                $ext  = $exists->count();
             
                if ($ext>0) {
                  
                   $s= $exists->first();
                   $data["pr_id"] = $s->pr_id;
                   $data["ms_id"] = $s->ms_id;
                   return $this->updateManage($data);

                }
                else{
                    $data["pr_id"] = $p->pr_id;
                }
            } else {
                return "Product not found";
            }
        }

        $t = new self();    
        $t->ms_type = $data["ms_type"]; 
        if(isset($data["pr_id"]))$t->pr_id = $data["pr_id"];    
        if(isset($data["sup_id"]))$t->sup_id = $data["sup_id"]; 
        $t->ms_stock = $data["ms_stock"];   
        $t->save(); 
        return $t->ms_id;   
    }

    function updateManage($data)
    {
        $t = self::find($data["ms_id"]);    
        $t->ms_type = $data["ms_type"]; 
        if(isset($data["pr_id"]))$t->pr_id = $data["pr_id"];    
        if(isset($data["sup_id"]))$t->sup_id = $data["sup_id"]; 
        $t->ms_stock += $data["ms_stock"];   
        $t->save(); 
        return $t->ms_id;   
    }

    function deleteManage($data)
    {
        $t = self::find($data["ms_id"]);    
        $t->status = 0;
        $t->save();
    }
}
