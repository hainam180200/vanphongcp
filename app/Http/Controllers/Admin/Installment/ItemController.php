<?php

namespace App\Http\Controllers\Admin\Installment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Group;
use App\Models\Item;
use App\Models\SubItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Installment;
use App\Models\InstallmentDetail;
use Carbon\Carbon;
use Html;
use App\Library\Files;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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


        $this->module="installment";
        $this->moduleCategory=null;

        //set permission to function
        $this->middleware('permission:'. $this->module.'-list');
        $this->middleware('permission:'. $this->module.'-create', ['only' => ['create', 'store','duplicate']]);
        $this->middleware('permission:'. $this->module.'-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:'. $this->module.'-delete', ['only' => ['destroy']]);


        if( $this->module!=""){
            $this->page_breadcrumbs[] = [
                'page' => route('admin.'.$this->module.'.index'),
                'title' => __(config('module.'.$this->module.'.title'))
            ];
        }
    }
    public function index(Request $request)
    {
        ActivityLog::add($request, 'Truy cập danh sách '.$this->module);
        if($request->ajax) {
            $datatable = Installment::query();
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
                ->editColumn('created_at', function($data) {
                    return date('d/m/Y H:i:s', strtotime($data->created_at));
                })
                ->editColumn('image', function($data) {
                    return Files::media($data->image);
                })
                ->editColumn('type', function($data) {
                    return config('module.installment.'.$data->type);
                })
                ->addColumn('action', function($row) {
                    $temp= "<a href=\"".route('admin.'.$this->module.'.edit',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary \" title=\"Sửa\"><i class=\"la la-edit\"></i></a>";
                    $temp.= "<a  rel=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger delete_toggle' data-toggle=\"modal\" data-target=\"#deleteModal\" class=\"delete_toggle\" title=\"Xóa\"><i class=\"la la-trash\"></i></a>";
                    return $temp;
                })
                ->toJson();
        }


        return view('admin.installment.item.index')
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

        ActivityLog::add($request, 'Vào form create '.$this->module);
        return view('admin.installment.item.create_edit')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'papers'=>'required',
            'fee'=>'required',
            'ratio'=>'required',
        ],[
            'title.required' => __('Vui lòng nhập tiêu đề'),
            'papers.required' => __('Vui lòng nhập giấy tờ yêu cầu'),
            'fee.required' => __('Vui lòng nhập phí'),
            'ratio.required' => __('Vui lòng nhập lãi suất'),
        ]);
        $input=$request->all();
        // $input['module']=$this->module;
        $input['author_id']=auth()->user()->id;
        if(!$request->filled('image_oldest')){
            $input['image']= Files::upload_image($request->file('image'),'images',null,null,null,false);
        }
        $input['fee'] = (float)str_replace(array(' ', '.'), '', $request->fee);
        // $input['ratio'] = (float)str_replace(array(' ', '.'), '', $request->ratio);

        $data=Installment::create($input);
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
        $data = Installment::findOrFail($id);
        ActivityLog::add($request, 'Vào form edit '.$this->module.' #'.$data->id);
        return view('admin.installment.item.create_edit')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('data', $data);
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
        $this->validate($request,[
            'title'=>'required',
            'papers'=>'required',
            'fee'=>'required',
            'ratio'=>'required',
        ],[
            'title.required' => __('Vui lòng nhập tiêu đề'),
            'papers.required' => __('Vui lòng nhập giấy tờ yêu cầu'),
            'fee.required' => __('Vui lòng nhập phí'),
            'ratio.required' => __('Vui lòng nhập lãi suất'),
        ]);
        $data = Installment::findOrFail($id);
        $input=$request->all();
        $input['author_id']= auth()->user()->id;
        if(!$request->filled('image_oldest')){
            $input['image']= Files::upload_image($request->file('image'),'images',null,null,null,false);
        }
        $input['fee'] = (float)str_replace(array(' ', '.'), '', $request->fee);
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

        Installment::whereIn('id',$input)->update(['status' => 0]);
        ActivityLog::add($request, 'Xóa thành công '.$this->module.' #'.json_encode($input));
        return redirect()->back()->with('success',__('Xóa thành công !'));
    }
}
