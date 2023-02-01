<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Category;
Use App\Helpers\Helper;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('category_manage')) {
            return abort(401);
        }
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $categories = Category::where(['status'=>$type])->orderBy('id')->get();
        return view('admin.category.index',compact('categories', 'type', 'btnStatus'));
    }

    public function create(Request $request)
    {
        if (!Gate::allows('category_manage')) {
            return abort(401);
        }
        return view('admin.category.create');
        
    }

    
    public function store(Request $request)
    {    
        if (!Gate::allows('category_manage')) {
            return abort(401);
        }      
        $inputData = $request->all();
        if(isset($inputData['id']) && !empty($inputData['id'])){
            $categoryId = $inputData['id'];
            $edit = true;
        }else{
            $edit = false;
        }
        if($file = $request->hasFile('category_image')){
            $categoryImage = $inputData['category_image'];
            $orgImage_name = $categoryImage->getClientOriginalName();
            $image_name = $orgImage_name;
            $path = $categoryImage->move('public/images/category',$image_name);
            $insertData['category_image_name'] =  $image_name;
        }else{
            if(!$edit){
                $insertData['category_image_name'] =  '';
            }
        }
        $insertData['category_name'] =  $inputData['category_name'];
        $insertData['status'] =  1;
        if(!$edit){
            $createCategory = Category::create($insertData);
            $newData = Category::where(['id'=>$createCategory->id])->first()->toArray();
            $oldData = [];
            $action = 'Create';
        }else{
            $oldData = Category::where(['id' => $categoryId])->first()->toArray();
            $createCategory = Category::where(['id'=>$categoryId])->update($insertData);
            $newData = Category::where(['id'=>$categoryId])->first()->toArray();
            $action = 'Update';
        }
        $updateLogs = Helper::storeLogs($oldData,  $newData, $action, 'Category');
        return redirect('admin/master/category');
        
        
        
        
    }

    public function edit(Request $request)
    {
        if (!Gate::allows('category_manage')) {
            return abort(401);
        }
        $categoryId = isset($_GET['category']) ? $_GET['category'] : '0';
        if(!empty($categoryId)){
            $categoryDetails = Category::where(['id'=>$categoryId])->first();
            if($categoryDetails){
                return view('admin.category.create',compact('categoryDetails'));
            }else{
                return redirect('admin/master/category');
            }
        }else{
            return redirect('admin/master/category');
        }
        
    }

    

}
