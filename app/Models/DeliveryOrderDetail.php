<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrderDetail extends Model
{
    protected $table = 'delivery_order_details';
    protected $primaryKey = 'dod_id';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'sod_id',
        'dod_qty',
    ];

    public function getDeliveryOrderDetails($filter = [])
    {
        $query = self::query();

        if (!empty($filter['do_id'])) {
            $query->where('do_id','=', $filter['do_id']);
        }

        if (!empty($filter['sod_id'])) {
            $query->where('sod_id', $filter['sod_id']);
        }

        $query->orderBy('created_at', 'desc');

        return $query->get();
    }

    public function insertDeliveryOrderDetail($data)
    {
        $dod = new self();
        
        $dod->sod_id = $data['sod_id'];
        $dod->do_id = $data['do_id'];
        $dod->dod_name = $data['dod_name'];
        $dod->dod_unit = $data['dod_unit'];
        $dod->dod_qty = $data['dod_qty'];
        $dod->save();
        return $dod->dod_id;
    }

    public function updateDeliveryOrderDetail($data)
    {
        $dod = self::find($data['dod_id']);
        if (!$dod) return null;
        $dod->sod_id = $data['sod_id'];
        $dod->do_id = $data['do_id'];
        $dod->dod_name = $data['dod_name'];
        $dod->dod_unit = $data['dod_unit'];
        $dod->dod_qty = $data['dod_qty'];
        $dod->save();

        return $dod->dod_id;
    }

    public function deleteDeliveryOrderDetail($data)
    {
        dd($data);
        $dod = self::find($data["dod_id"]);
        if (!$dod) return false;

        return $dod->delete();
    }
}
