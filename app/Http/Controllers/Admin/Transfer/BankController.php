<?php

namespace App\Http\Controllers\Admin\Transfer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Item;
use Carbon\Carbon;

class BankController extends Controller
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

        $this->module='transfer-bank';
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
            $datatable= Item::with(array('groups' => function ($query) {
                $query->where('module', $this->moduleCategory);

                $query->select('groups.id','title');
            }))->where('module', $this->module);

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
                    $temp.= "<a  rel=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger delete_toggle' data-toggle=\"modal\" data-target=\"#deleteModal\" class=\"delete_toggle\" title=\"Xóa\"><i class=\"la la-trash\"></i></a>";
                    return $temp;
                })
                ->toJson();
        }
        return view('admin.transfer.bank.index')
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
        $dataCategory = null;
        ActivityLog::add($request, 'Vào form create '.$this->module);
        return view('admin.transfer.bank.create_edit')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs);
            // ->with('dataCategory', $dataCategory);
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
            'account_name'=>'required',
            'number_account'=>'required',
            'image' => 'required'
        ],[
            'title.required' => __('Vui lòng nhập tên ngân hàng'),
            'account_name.required' => __('Vui lòng nhập chủ tài khoản'),
            'number_account.required' => __('Vui lòng nhập số tài khoản'),
            'number_account.required' => __('Vui lòng nhập ảnh ngân hàng'),
        ]);
        $title = $request->title;
        $account_name = $request->account_name;
        $number_account = $request->number_account;
        $params = [
            'account_name' => $account_name,
            'number_account' => $number_account,
        ];
        $params = json_decode(json_encode($params), FALSE);
        $input['module']=$this->module;
        $input['title']=$title;
        $input['params']=$params;
        $input['image']=$request->image;
        $input['status']=$request->status;
        $input['order']=$request->order;
        $input['author_id']=auth()->user()->id;
        $data=Item::create($input);
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
        $data = Item::findOrFail($id);

        ActivityLog::add($request, 'Vào form edit '.$this->module.' #'.$data->id);
        return view('admin.transfer.bank.create_edit')
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
            'account_name'=>'required',
            'number_account'=>'required',
        ],[
            'title.required' => __('Vui lòng nhập tên ngân hàng'),
            'account_name.required' => __('Vui lòng nhập chủ tài khoản'),
            'number_account.required' => __('Vui lòng nhập số tài khoản'),
            'number_account.required' => __('Vui lòng nhập ảnh ngân hàng'),
        ]);
        $data =  Item::where('module', '=', $this->module)->findOrFail($id);
        $title = $request->title;
        $account_name = $request->account_name;
        $number_account = $request->number_account;
        $params = [
            'account_name' => $account_name,
            'number_account' => $number_account,
        ];
        $params = json_decode(json_encode($params), FALSE);
        $input['module']=$this->module;
        $input['title']=$title;
        $input['params']=$params;
        if($request->filled('image')){
            $input['image']=$request->image;
        }
        $input['status']=$request->status;
        $input['order']=$request->order;
        $input['author_id']=auth()->user()->id;
        $data->update($input);
        ActivityLog::add($request, 'Chỉnh sửa thành công'.$this->module.' #'.$data->id);
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
        $data =  Item::where('module', '=', $this->module)->findOrFail($request->id);
        $data->status = 0;
        $data->save();
        return redirect()->back()->with('success',__('Xóa thành công !'));
    }
}
