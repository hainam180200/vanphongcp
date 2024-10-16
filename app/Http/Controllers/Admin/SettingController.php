<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Files;
use App\Models\ActivityLog;
use App\Models\Setting;
use Illuminate\Http\Request;


class SettingController extends Controller
{


    protected $page_breadcrumbs;

    public function __construct()
    {


        //set permission to function
        $this->middleware("permission:setting-list");
        $this->middleware("permission:setting-create", ['only' => ['create', 'store']]);
        $this->middleware("permission:setting-edit", ['only' => ['edit', 'update']]);
        $this->middleware("permission:setting-delete", ['only' => ['destroy']]);

        $this->page_breadcrumbs = [
            ['page' => route('admin.setting.index'),
                'title' => "Cấu hình hệ thống"
            ],
        ];
    }

    public function index(Request $request)
    {
        ActivityLog::add($request, 'Vào form edit setting');
        return view('admin.setting.index')
            ->with('page_breadcrumbs', $this->page_breadcrumbs);

    }


    public function store(Request $request)
    {

        $rules = Setting::getValidationRules();
        $this->validate($request, $rules);
        $data=$request->all();
        $validSettings = array_keys($rules);
        foreach ($data as $key => $val) {
            if (in_array($key, $validSettings)) {
                $InputTypeOfField = Setting::getInputType($key);
                if ($InputTypeOfField == "image") {
                    if ($request->has($key) || $request->hasFile($key)) {
                        $val = Files::upload_image($request->file($key),'images',null,null,null,true);
                    } else {
                        $val = "";
                    }
                }

                //add giá trị
                Setting::add($key, $val, Setting::getDataType($key));
            }
        }


        ActivityLog::add($request, 'Cập nhật thành công setting');

        // return response()->json([
        //     'success' => true,
        //     'message' => __('Cập nhật thành công !'),
        //     'redirect' => ''
        // ]);

        return redirect()->back()->with('success',__('Cập nhật thành công !'));

    }


}
