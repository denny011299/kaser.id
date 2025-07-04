<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    protected $table = 'delivery_orders';
    protected $primaryKey = 'do_id';
    public $timestamps = true;
    public $incrementing = true;

    public function getDeliveryOrders($filter = [])
    {
        $query = self::where('status', 1);

        if (!empty($filter['do_id'])) {
            $query->where('do_id','=', $filter['do_id']);
        }
        if (!empty($filter['so_id'])) {
            $query->where('so_id', '=',$filter['so_id']);
        }
        if (!empty($filter['do_date'])) {
            $query->whereDate('do_date', $filter['do_date']);
        }

        $query->orderBy('created_at', 'desc');

        $query = $query->get();

        foreach ($query as $key => $value) {
           $value->items = (new DeliveryOrderDetail)->getDeliveryOrderDetails(["do_id"=>$value->do_id]);
        }

        return $query;
    }

    public function insertDo($data)
    {
        $deliveryOrder = new self();
        $deliveryOrder->do_nomer = $this->generateDoNumber();
        $deliveryOrder->so_id = $data['so_id'] ?? null;
        $deliveryOrder->do_date = $data['do_date'] ?? null;
        $deliveryOrder->do_sender_name = $data['do_sender_name'] ?? null;
        $deliveryOrder->do_receiver_name = $data['do_receiver_name'] ?? null;
        $deliveryOrder->do_note = $data['do_note'] ?? null;
        $deliveryOrder->status = 1;
        $deliveryOrder->save();

        return $deliveryOrder->do_id;
    }

    public function updateDo($data)
    {
        $deliveryOrder = self::find($data['do_id']);
        if (!$deliveryOrder) return null;

        $deliveryOrder->so_id = $data['so_id'] ?? $deliveryOrder->so_id;
        $deliveryOrder->do_date = $data['do_date'] ?? $deliveryOrder->do_date;
        $deliveryOrder->do_sender_name = $data['do_sender_name'] ?? $deliveryOrder->do_sender_name;
        $deliveryOrder->do_receiver_name = $data['do_receiver_name'] ?? $deliveryOrder->do_receiver_name;
        $deliveryOrder->do_note = $data['do_note'] ?? $deliveryOrder->do_note;
        $deliveryOrder->save();

        return $deliveryOrder->do_id;
    }

    public function deleteDo($data)
    {
        $deliveryOrder = self::find($data["do_id"]);
        $deliveryOrder->status = 0;
        $deliveryOrder->save();

        return true;
    }

    function generateDoNumber()
    {
        $latest = self::max('do_id');
        $latest = is_null($latest) ? 1 : $latest + 1;
        return "DO" . str_pad($latest, 5, "0", STR_PAD_LEFT);
    }
}
