<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Admin;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BackOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backoffice/home',["profile"=>Auth::guard('admin')->User()]);
    }

    public function category() {
        $category = Category::select(DB::raw('categoryID, type AS categoryName, typeEN AS categoryNameEN'))->orderBy('categoryID','asc')->paginate(10);
        $filter = $category->map(function ($item, $key) {
            $subcategory = Subcategory::select(DB::raw('subCategoryID, type AS subCategoryName, typeEN AS subCategoryNameEN'))->where('categoryID','=',$item['categoryID'])->orderBy('subCategoryID','asc')->get();
            $item->subCategory = $subcategory;
        });
        return view('backoffice/category',["profile"=>Auth::guard('admin')->User(),"category"=>$category]);
    }

    public function addCategory() {
        $input = Input::all();
        $validator = Validator::make($input, [
            'CategoryName' => 'required|min:2|max:255',
            'SubCategoryName' => 'required|min:2|max:255'
        ]);
        if ($validator->fails()) {
            return Redirect::to('admin/category')->withErrors($validator);
        }else{
            $check = Category::where('type','=',$input['CategoryName'])->first();
            if($check) {
                $repeat['error'] = "incorrect, please try again: ".$input['CategoryName']; 
                return Redirect::to('admin/category')->withErrors($repeat);
            }else{
                $newCategory = new Category;
                $newCategory->type = $input['CategoryName'];
                $newCategory->typeEN = $input['CategoryNameEN'];
                $newCategory->save();
                $categoryID = $newCategory['categoryID'];
                for ($i=0; $i < count($input['SubCategoryName']); $i++) { 
                    $newSubCategory = new SubCategory;
                    $newSubCategory->categoryID = $categoryID;
                    $newSubCategory->type = $input['SubCategoryName'][$i];
                    $newSubCategory->typeEN = $input['SubCategoryNameEN'][$i];
                    $newSubCategory->save();
                }
                return Redirect::to('admin/category');
            }
        }
    }

    public function profile() {
        return view('backoffice/profile',["profile"=>Auth::guard('admin')->User()]);
    }

    public function manageCategory($type) {
        $input = Input::all();
        $id = $input['id'];
        switch ($type) {
            case 'delete':
                $deleteCategory = Category::where('categoryID','=',$id)->delete();
                $deleteSubCategory = SubCategory::where('categoryID','=',$id)->delete();
                if($deleteCategory||$deleteSubCategory) {
                    return "success";
                }else{
                    return "error";
                }
                break;
            case 'edit':
                # code...
                break;
            default:
                abort(404);
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
