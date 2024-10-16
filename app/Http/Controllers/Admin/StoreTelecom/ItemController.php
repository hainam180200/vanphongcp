<?php

namespace App\Http\Controllers\Admin\StoreTelecom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Group;
use App\Models\StoreTelecom;
use App\Models\StoreTelecomValue;
use Carbon\Carbon;
use Html;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $page_breadcrumbs;
    protected $module;
    protected $moduleCategory;

    public function __construct(Request $request)
    {

        $this->module='store-telecom';
        $this->moduleCategory=null;
        //set permission to function
        $this->middleware('permission:'. $this->module.'-list');
        $this->middleware('permission:'. $this->module.'-create', ['only' => ['create', 'store','duplicate']]);
        $this->middleware('permission:'. $this->module.'-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:'. $this->module.'-delete', ['only' => ['destroy']]);



        $this->page_breadcrumbs[] = [
            'page' => route('admin.'.$this->module.'.index'),
            'title' => __(config('module.'.$this->module.'.title'))
        ];
    }


    public function index(Request $request)
    {

        ActivityLog::add($request, 'Truy cập danh sách '.$this->module);
        if($request->ajax) {
            $datatable= StoreTelecom::query();

            if ($request->filled('group_id')) {
                $datatable->whereHas('groups', function ($query) use ($request) {
                    $query->where('group_id',$request->get('group_id'));
                });
            }

            if ($request->filled('id'))  {
                $datatable->where(function($q) use($request){
                    $q->orWhere('id', 'LIKE', '%' . $request->get('id') . '%');
                });
            }

            if ($request->filled('title'))  {
                $datatable->where(function($q) use($request){
                    $q->orWhere('title', 'LIKE', '%' . $request->get('title') . '%');
                });
            }
            if ($request->filled('position')) {
                $datatable->where('position',$request->get('position') );
            }

            if ($request->filled('status')) {
                $datatable->where('status',$request->get('status') );
            }

            if ($request->filled('started_at')) {
                $datatable->where('created_at', '>=', Carbon::createFromFormat('d/m/Y H:i:s', $request->get('started_at')));
            }
            if ($request->filled('ended_at')) {
                $datatable->where('created_at', '<=', Carbon::createFromFormat('d/m/Y H:i:s', $request->get('ended_at')));
            }

            return \datatables()->eloquent($datatable)

                ->only([
                    'id',
                    'title',
                    'image',
                    'key',
                    'ratio',
                    'type_charge',
                    'seri',
                    'order',
                    'gate_id',
                    'note',
                    'status',
                    'created_at',
                    'action'
                ])


                ->editColumn('created_at', function($data) {
                    return date('d/m/Y H:i:s', strtotime($data->created_at));
                })
                ->addColumn('action', function($row) {
                    $temp= "<a href=\"".route('admin.'.$this->module.'.edit',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary \" title=\"Sửa\"><i class=\"la la-edit\"></i></a>";
                    $temp.="<a href=\"".route('admin.'.$this->module.'.set-value',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary  setvalue_toggle\" title=\"Mệnh giá\"><i class=\"la la-th-list\"></i></a>";
                    $temp.= "<a  rel=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger delete_toggle' data-toggle=\"modal\" data-target=\"#deleteModal\" class=\"delete_toggle\" title=\"Xóa\"><i class=\"la la-trash\"></i></a>";
                    return $temp;
                })
                ->toJson();
        }


        return view('admin.'.$this->module.'.item.index')
        ->with('module', $this->module)
        ->with('page_breadcrumbs', $this->page_breadcrumbs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Thêm mới")
        ];

        if( $this->moduleCategory==null){
            $dataCategory=null;
        }
        else{
            //$dataCategory = Group::where('module', '=',  $this->moduleCategory)->orderBy('order','asc')->get();
        }

        $dataCategory = null;
        ActivityLog::add($request, 'Vào form create '.$this->module);
        return view('admin.'.$this->module.'.item.create_edit')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('dataCategory', $dataCategory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params=$request->params;

        $this->validate($request,[
            'title'=>'required',
            'key' => 'required|unique:store_telecom,key',
            'image' => 'required'
        ],[
            'title.required' => __('Vui lòng nhập tiêu đề'),
            'key.required' => __('Vui lòng nhập unique nhà mạng'),
            'key.unique' => __('Key nhà mạng đã tồn tại'),
            'image.required' => __('Vui lòng upload ảnh'),
        ]);
        $input=$request->all();
        $input['module']=$this->module;


        //xử lý params
        if($request->filled('params')){
            //check value param ở đây nếu cần //Example:  $params['demo']='Value demo edited'
            $params=$request->params;
            $input['params'] =$params;
        }
        $data=StoreTelecom::create($input);

        //set category
        if( isset($input['group_id'] ) &&  $input['group_id']!=0){
            $data->groups()->attach($input['group_id']);
        }
        ActivityLog::add($request, 'Tạo mới thành công '.$this->module.' #'.$data->id);
        if($request->filled('submit-close')){
            return redirect()->route('admin.'.$this->module.'.index')->with('success',__('Thêm mới thành công !'));
        }
        else {
            return redirect()->back()->with('success',__('Thêm mới thành công !'));
        }
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
    public function edit(Request $request, $id)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Cập nhật")
        ];
        $data = StoreTelecom::findOrFail($id);
        if( $this->moduleCategory==null){
            $dataCategory=null;
        }
        else{
            //$dataCategory = Group::where('module', '=',  $this->moduleCategory)->orderBy('order','asc')->get();
        }

        ActivityLog::add($request, 'Vào form edit '.$this->module.' #'.$data->id);
        return view('admin.'.$this->module.'.item.create_edit')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('data', $data)
            ->with('dataCategory', $dataCategory);

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
        $data =  StoreTelecom::findOrFail($id);
        $this->validate($request,[
            'title'=>'required',
            'key' => 'required',
        ],[
            'title.required' => __('Vui lòng nhập tiêu đề'),
            'key.required' => __('Vui lòng nhập nhà mạng'),
        ]);

        $input=$request->all();
        $input['module']=$this->module;
        //xử lý params
        if($request->filled('params')){
            $params=$request->params;
            $input['params'] =$params;
        }

        $data->update($input);
        ActivityLog::add($request, 'Cập nhật thành công '.$this->module.' #'.$data->id);
        if($request->filled('submit-close')){
            return redirect()->route('admin.'.$this->module.'.index')->with('success',__('Cập nhật thành công !'));
        }
        else {
            return redirect()->back()->with('success',__('Cập nhật thành công !'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $input=explode(',',$request->id);
        $data =  StoreTelecom::where("id",$input)->first();
        $data->status = 0;
        $data->save();
        ActivityLog::add($request, 'Xóa thành công '.$this->module.' #'.json_encode($input));
        return redirect()->back()->with('success',__('Xóa thành công !'));
        
    }

    public function SetValue(Request $request, $id){
        $data=StoreTelecom::findOrFail($id);
        $data_telecom_value=StoreTelecomValue::where('telecom_id',$data->id)->get();
        ActivityLog::add($request, 'Vào form cập nhật mệnh giá nhà mạng '.$this->module.' #'.$data->id);
        return view('admin.'.$this->module.'.item.set-value', compact('data','data_telecom_value'));
    }

    public function postSetValue(Request $request,$id){
        if(!\Hash::check($request->password2,\Auth::user()->password2)){
            session()->put('fail_password2',  session()->get('fail_password2')+1);
            DB::rollBack();
            return redirect()->back()->withErrors(__('Mật khẩu cấp 2 không đúng'))->withInput();
        }
        else{
            session()->put('fail_password2', 0);
        }
        $data=StoreTelecom::findOrFail($id);
        StoreTelecomValue::where('telecom_id',$data->id)->delete();
        for ($i=0;$i<count($request->amount);$i++){
            if($request->amount[$i]!='' && $request->ratio_agency[$i]!='' && $request->ratio_agency[$i]!='' && $request->status[$i]!='' )
            {
                $input=[
                    'telecom_id'=>$data->id,
                    'telecom_key'=>$data->key,
                    'amount'=>$request->amount[$i],
                    'ratio_default'=>$request->ratio_default[$i],
                    'ratio_agency'=>$request->ratio_agency[$i],
                    'status'=>$request->status[$i],
                ];
                StoreTelecomValue::create($input);
            }

        }
        ActivityLog::add($request, 'Cập nhật thành công nhật mệnh giá nhà mạng '.$this->module.' #'.$data->id);
        return redirect()->route('admin.'.$this->module.'.index')->with('success',__('Câp nhật thành công !'));
    }

    public function postSetting(Request $request){

    }
}
