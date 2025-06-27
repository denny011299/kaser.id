<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\city;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Product_unit;
use App\Models\Product_variant;
use App\Models\product_variasi;
use App\Models\Supplier;
use App\Models\Supplies;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function autocompleteLocation(Request $req)
    {
        $keyword = isset($req->keyword) ? $req->keyword : null;

        $p = new city();
        $data_city = $p->get_data_simple_city([
            "city_name" => $keyword
        ]);


        foreach ($data_city['data'] as $r) {
            $r->id = $r["id"];
            $r->text = $r["name"];
        };

        echo json_encode(array(
            "data" => $data_city
        ));
    }
    
    public function autocompleteSupplier(Request $req)
    {
        $keyword = isset($req->keyword) ? $req->keyword : null;

        $p = new Supplier();
        $data_city = $p->getSupplier([
            "sp_name" => $keyword
        ]);


        foreach ($data_city as $r) {
            $r->id = $r["sp_id"];
            $r->text = $r["sp_name"];
        };

        echo json_encode(array(
            "data" => $data_city
        ));
    }

    public function autocompleteCategory(Request $req)
    {
        $keyword = isset($req->keyword) ? $req->keyword : null;

        $p = new Category();
        $data = $p->getCategory([
            "category_name" => $keyword
        ]);


        foreach ($data as $r) {
            $r->id = $r["category_id"];
            $r->text = $r["category_name"];
        };
        echo json_encode(array(
            "data" => $data
        ));
    }

    public function autocompleteUnit(Request $req)
    {
        $keyword = isset($req->keyword) ? $req->keyword : null;

        $p = new Product_unit();
        $data = $p->getProductUnit([
            "pu_short_name" => $keyword
        ]);


        foreach ($data as $r) {
            $r->id = $r["pu_id"];
            $r->text = $r["pu_short_name"];
        };
        echo json_encode(array(
            "data" => $data
        ));
    }

    public function autocompleteProductVariant(Request $req)
    {
        $keyword = isset($req->keyword) ? $req->keyword : null;

        $p = new Product_variant();
        $data = $p->getProductVariant([
            "pv_name" => $keyword
        ]);
        foreach ($data as $r) {
            $r->id = $r["pv_id"];
            $r->text = $r["pv_name"];
        };
        echo json_encode(array(
            "data" => $data
        ));
    }

    public function autocompleteProduct(Request $req)
    {
        $keyword = isset($req->keyword) ? $req->keyword : null;

        $p = new Product();
        $data = $p->getProduct([
            "pr_name" => $keyword
        ]);
        foreach ($data as $r) {
            $r->id = $r["pr_id"];
            $r->text = $r["pr_name"];
        };
        echo json_encode(array(
            "data" => $data
        ));
    }

    public function autocompleteSupplies(Request $req)
    {
        $keyword = isset($req->keyword) ? $req->keyword : null;

        $p = new Supplies();
        $data = $p->getSupplies([
            "sup_name" => $keyword
        ]);
        foreach ($data as $r) {
            $r->id = $r["sup_id"];
            $r->text = $r["sup_name"];
        };
        echo json_encode(array(
            "data" => $data
        ));
    }
    
    public function autocompleteCustomer(Request $req)
    {
        $keyword = isset($req->keyword) ? $req->keyword : null;

        $p = new Customer();
        $data = $p->getCustomer([
            "cus_name" => $keyword
        ]);
        foreach ($data as $r) {
            $r->id = $r["cus_id"];
            $r->text = $r["cus_name"];
        };
        echo json_encode(array(
            "data" => $data
        ));
    }
}
