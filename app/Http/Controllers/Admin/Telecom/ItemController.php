<?php

namespace App\Http\Controllers\Admin\Telecom;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Group;
use App\Models\Telecom;
use App\Models\TelecomValue;
use Carbon\Carbon;
use Html;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ItemController extends Controller
{

    protected $page_breadcrumbs;
    protected $module;
    protected $moduleCategory;
    public function __construct(Request $request)
    {

        $this->module='telecom';
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
            $datatable= Telecom::query();

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
        //$dataCategory = Group::where('module', '=',  $this->moduleCategory)->orderBy('order','asc')->get();
        if( $this->moduleCategory==null){
            $dataCategory=null;
        }
        else{
            //$dataCategory = Group::where('module', '=',  $this->moduleCategory)->orderBy('order','asc')->get();
        }

        return view('admin.'.$this->module.'.item.index')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('dataCategory', $dataCategory);
    }


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


    public function store(Request $request)
    {
        $params=$request->params;

        $this->validate($request,[
            'title'=>'required',
        ],[
            'title.required' => __('Vui lòng nhập tiêu đề'),
        ]);
        $input=$request->all();
        $input['module']=$this->module;
        $input['type_charge']=0;


        //xử lý params
        if($request->filled('params')){
            //check value param ở đây nếu cần //Example:  $params['demo']='Value demo edited'
            $params=$request->params;
            $input['params'] =$params;
        }
        $data=Telecom::create($input);

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


    public function show(Request $request,$id)
    {
        //$data = Group::findOrFail($id);
        //ActivityLog::add($request, 'Show '.$this->module.' #'.$data->id);
        //return view('admin.module.item.show', compact('datatable'));
    }

    public function edit(Request $request,$id)
    {


        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Cập nhật")
        ];
        $data = Telecom::findOrFail($id);
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

    public function update(Request $request,$id)
    {



        $data =  Telecom::findOrFail($id);

        $this->validate($request,[
            'title'=>'required',
        ],[
            'title.required' => __('Vui lòng nhập tiêu đề'),
        ]);

        $input=$request->all();
        $input['module']=$this->module;
        $input['type_charge']=0;
        //xử lý params
        if($request->filled('params')){
            //check value param ở đây nếu cần //Example:  $params['demo']='Value demo edited'

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

    public function destroy(Request $request)
    {
        $input=explode(',',$request->id);
        Telecom::whereIn('id',$input)->delete();
        ActivityLog::add($request, 'Xóa thành công '.$this->module.' #'.json_encode($input));
        return redirect()->back()->with('success',__('Xóa thành công !'));
    }



    public function getSetValue(Request $request,$id)
    {
        $data=Telecom::findOrFail($id);
        $data_telecom_value=TelecomValue::where('telecom_id',$data->id)->get();

        ActivityLog::add($request, 'Vào form cập nhật mệnh giá nhà mạng '.$this->module.' #'.$data->id);
        return view('admin.'.$this->module.'.item.set-value', compact('data','data_telecom_value'));
    }



    public function postSetValue(Request $request,$id)
    {
        //check password2
        if(!\Hash::check($request->password2,\Auth::user()->password2)){
            session()->put('fail_password2',  session()->get('fail_password2')+1);
            DB::rollBack();
            return redirect()->back()->withErrors(__('Mật khẩu cấp 2 không đúng'))->withInput();
        }
        else{
            session()->put('fail_password2', 0);
        }


        $data=Telecom::findOrFail($id);
        TelecomValue::where('telecom_id',$data->id)->delete();
        for ($i=0;$i<count($request->amount);$i++){
            if($request->amount[$i]!='' && $request->ratio_true_amount[$i]!='' && $request->ratio_false_amount[$i]!='' && $request->agency_ratio_true_amount[$i]!=''&& $request->agency_ratio_false_amount[$i]!=''&& $request->status[$i]!='' )
            {
                $input=[
                    'telecom_id'=>$data->id,
                    'telecom_key'=>$data->key,
                    'amount'=>$request->amount[$i],
                    'ratio_true_amount'=>$request->ratio_true_amount[$i],
                    'ratio_false_amount'=>$request->ratio_false_amount[$i],
                    'agency_ratio_true_amount'=>$request->agency_ratio_true_amount[$i],
                    'agency_ratio_false_amount'=>$request->agency_ratio_false_amount[$i],
                    'type_charge'=>0,
                    'status'=>$request->status[$i],
                ];
                TelecomValue::create($input);
            }

        }

        ActivityLog::add($request, 'Cập nhật thành công nhật mệnh giá nhà mạng '.$this->module.' #'.$data->id);

        return redirect()->route('admin.'.$this->module.'.index')->with('success',__('Câp nhật thành công !'));

    }

}
