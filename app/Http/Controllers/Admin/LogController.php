<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\LogDetail;
Use App\Helpers\Helper;
use Carbon\Carbon;


class LogController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $logs = LogDetail::orderBy('id', 'DESC')->get();
        return view('admin.log.index',compact('logs'));
    }

    public function getLogData(Request $request)
    {
        
        $inputData = $request->all();
        if(isset($inputData['logId']) && !empty($inputData['logId'])){
            $logs = LogDetail::where(['id'=>$inputData['logId']])->first();
            $oldData = json_decode($logs->old_data);
            $newData = json_decode($logs->new_data);
            $updateOldData = [];
            $updateNewData = [];
            foreach($newData as $newDataKey=>$newDataval){
                $updateNewData[$newDataKey] = $newDataval;
                if(isset($oldData->$newDataKey) && !empty($oldData->$newDataKey)){
                    $updateOldData[$newDataKey] = $oldData->$newDataKey;
                }
                
                
            }
            return response()->json(['code' => 200, 'olddata'=>$updateOldData, 'newData'=>$updateNewData ]);
        }else{
            return response()->json(['code' => 400, 'msg'=>'Please provide valid input']);
        }

    }

}
