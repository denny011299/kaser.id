<?php
namespace App\Http\Controllers;

use App\Models\CategoryStaff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
   //CategoryStaff
    function CategoryStaff() {
        return view('Backoffice.Staff.CategoryStaff');
    }
    function getCategoryStaff(Request $req)
    {
        $data =  (new CategoryStaff())->getCategoryStaff([
            "cs_id"=>$req->cs_id,
            "cs_name"=>$req->cs_name
        ]);
        return json_encode($data);
    }

    function insertCategoryStaff(Request $req)
    {
        $data = $req->all();
        return (new CategoryStaff())->insertCategoryStaff($data);
    }


    function updateCategoryStaff(Request $req)
    {
        $data = $req->all();
        (new CategoryStaff())->updateCategoryStaff($data);
    }

    function deleteCategoryStaff(Request $req)
    {
        $data = $req->all();
        return (new CategoryStaff())->deleteCategoryStaff($data);
    }
}
