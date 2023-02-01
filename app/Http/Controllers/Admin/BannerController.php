<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Banner;
Use App\Helpers\Helper;


class BannerController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('banner_manage')) {
            return abort(401);
        }
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $banners = Banner::where(['status' => $type])->orderBy('id')->get();
        return view('admin.banner.index', compact('banners', 'type', 'btnStatus'));
    }

    public function create(Request $request)
    {
        if (!Gate::allows('banner_manage')) {
            return abort(401);
        }
        return view('admin.banner.create');
    }


    public function store(Request $request)
    {
        if (!Gate::allows('banner_manage')) {
            return abort(401);
        }
        $inputData = $request->all();
        if (isset($inputData['id']) && !empty($inputData['id'])) {
            $bannerId = $inputData['id'];
            $edit = true;
        } else {
            $edit = false;
        }
        if ($file = $request->hasFile('baneer_image_name')) {
            $bannerImage = $inputData['baneer_image_name'];
            $orgImage_name = $bannerImage->getClientOriginalName();
            $image_name = $orgImage_name;
            $path = $bannerImage->move('public/images/banner', $image_name);
            $insertData['baneer_image_name'] =  $image_name;
        } else {
            if (!$edit) {
                $insertData['baneer_image_name'] =  '';
            }
        }
        $insertData['first_heading'] =  $inputData['first_heading'];
        $insertData['second_heading'] =  $inputData['second_heading'];
        $insertData['button_link'] =  $inputData['button_link'];
        $insertData['status'] =  1;
        if (!$edit) {
            $createBanner = Banner::create($insertData);
            $newData = Banner::where(['id'=>$createBanner->id])->first()->toArray();
            $oldData = [];
            $action = 'Create';
        } else {
            $oldData = Banner::where(['id' => $bannerId])->first()->toArray();
            $createBanner = Banner::where(['id' => $bannerId])->update($insertData);
            $newData = Banner::where(['id'=>$bannerId])->first()->toArray();
            $action = 'Update';
        }

        $updateLogs = Helper::storeLogs($oldData,  $newData, $action, 'Banner');
        return redirect('admin/master/banner');
    }

    public function edit(Request $request)
    {
        if (!Gate::allows('banner_manage')) {
            return abort(401);
        }
        $bannerId = isset($_GET['banner']) ? $_GET['banner'] : '0';
        if (!empty($bannerId)) {
            $bannerDetails = Banner::where(['id' => $bannerId])->first();
            if ($bannerDetails) {
                return view('admin.banner.create', compact('bannerDetails'));
            } else {
                return redirect('admin/master/banner');
            }
        } else {
            return redirect('admin/master/banner');
        }
    }
}
