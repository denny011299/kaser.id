<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $table = "cities";
    protected $primaryKey = "id";
    public $timestamps = true;
    public $incrementing = true;

    public function get_data_simple_city($data=[])
    {
        $data = array_merge(array(
            "city_name" =>null,
        ), $data);
        
        $pc = City::where('cities.status','=',1);
        if($data["city_name"]!=null) $pc->where("name","like","%".$data["city_name"]."%");
        return [
            "data"=>$pc->get(),
            "count"=>$pc->count()
        ];
    }
}
