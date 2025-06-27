<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerPrice;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //Supplier
    function customer() {
        return view('Backoffice.Customer.Customer');
    }
    
    function customerDetail($id) {
        $param["data"] =(new Customer)->getCustomer(["cus_id"=>$id])[0];
        $param["cus_id"] =$id;
        return view('Backoffice.Customer.Customer_detail')->with($param);
    }

    function getCustomer(Request $req)
    {
        $data =  (new Customer())->getCustomer([
            "cus_name"=>$req->cus_name,
            "city_id"=>$req->city_id
        ]);
        return json_encode($data);
    }

    function insertCustomer(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["cus_img"] = $this->insertFile($req->main, "customer");
        return (new Customer())->insertCustomer($data);
    }

    function updateCustomer(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["cus_img"] = $this->insertFile($req->main, "customer");
        (new Customer())->updateCustomer($data);
    }

    function deleteCustomer(Request $req)
    {
        $data = $req->all();
        return (new Customer())->deleteCustomer($data);
    }

    //Supplier Price + Product
    function getCustomerPrice(Request $req)
    {
        $data =  (new CustomerPrice())->getCustomerPrice([
            "cp_id" => $req->cp_id,
            "pr_id" => $req->pr_id,
        ]);
        return json_encode($data);
    }

    function insertCustomerPrice(Request $req)
    {
        $data = $req->all();
        (new CustomerPrice())->insertCustomerPrice($data);
    }

    function updateCustomerPrice(Request $req)
    {
        $data = $req->all();
        (new CustomerPrice())->updateCustomerPrice($data);
    }

    function deleteCustomerPrice(Request $req)
    {
        $data = $req->all();
        return (new CustomerPrice())->deleteCustomerPrice($data);
    }

        //lain lain
    public function insertFile($file, $type)
    {
        try {
            $fileName = uniqid() . '.' . $file->extension();
            $filePath = 'upload/' . $type . "/" . $fileName;

            $file->move(public_path('upload/' . $type), $fileName);
            return $filePath;
        } catch (\Throwable $th) {
            dd($th);
            return -1;
        }
    }
}
