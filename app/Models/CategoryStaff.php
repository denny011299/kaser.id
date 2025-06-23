<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryStaff extends Model
{
    protected $table = "category_staff";
    protected $primaryKey = "cs_id";
    public $timestamps = true;
    public $incrementing = true;

    function getCategoryStaff($data = [])
    {
        $data = array_merge([
            "cs_name"=>null,
            "cs_id"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["cs_name"]) $result->where('cs_name','like','%'.$data["cs_name"].'%');
        if($data["cs_id"]) $result->where('cs_id','=',$data["cs_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();
        
        return $result;
    }

    function insertCategoryStaff($data)
    {
        $t = new self();
        $t->cs_name = $data["cs_name"];
        $t->save();
        return $t->cs_id;
    }

    function updateCategoryStaff($data)
    {
        $t = self::find($data["cs_id"]);
        $t->cs_name = $data["cs_name"];
        $t->save();
        return $t->cs_id;
    }

    function deleteCategoryStaff($data)
    {
        $t = self::find($data["cs_id"]);
        $t->status = 0;
        $t->save();
    }
}
