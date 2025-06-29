<?php
namespace App\Http\Controllers;

use App\Models\CategoryStaff;
use App\Models\Staff;
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

    // Staff
    function Staff(){
        return view('Backoffice.Staff.Staff');
    }

    function staffDetail($id) {
        $param["data"] =(new Staff())->getStaff(["st_id"=>$id])[0];
        return view('Backoffice.Staff.Staff_detail')->with($param);
    }

    function getStaff(Request $req)
    {
        $data =  (new Staff())->getStaff([
            "st_name"=>$req->st_name,
            "cs_id"=>$req->category_id
        ]);
        return json_encode($data);
    }

    function insertStaff(Request $req)
    {
        $data = $req->all();
        if(isset($req->profile))$data["st_profile"] = $this->insertFile($req->profile, "photo");
        if(isset($req->ktp))$data["st_ktp"] = $this->insertFile($req->ktp, "ktp");
        return (new Staff())->insertStaff($data);
    }

    function updateStaff(Request $req)
    {
        $data = $req->all();
        if(isset($req->profile) && $req->profile!="undefined")$data["st_profile"] = $this->insertFile($req->profile, "photo");
        if(isset($req->ktp) && $req->ktp!="undefined")$data["st_ktp"] = $this->insertFile($req->ktp, "ktp");
        return (new Staff())->updateStaff($data);
    }

    function deleteStaff(Request $req)
    {
        $data = $req->all();
        return (new Staff())->deleteStaff($data);
    }

    // lain-lain
    public function insertFile($file, $type)
    {
        try {
            $fileName = uniqid() . '.' . $file->extension();
            $filePath = 'upload/staff/' . $type . "/" . $fileName;

            $file->move(public_path('upload/staff/' . $type), $fileName);
            return $filePath;
        } catch (\Throwable $th) {
            dd($th);
            return -1;
        }
    }
}
