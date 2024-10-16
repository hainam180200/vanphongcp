<?php

namespace App\Http\Controllers\Admin\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Log;
use DB;
use Auth;
use App\Library\TECHCOMBANK;
use App\Library\Helpers;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Request $request){
        $this->module='bank';
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
        if($request->ajax()){
            $datatable = Bank::query();
            if ($request->filled('id'))  {
                $datatable->where(function($q) use($request){
                    $q->orWhere('id', 'LIKE', '%' . $request->get('id') . '%');
                });
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
        return view('admin.bank.item.index')
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
        return view('admin.bank.item.create_edit')
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
            'key'=>'required',
            'username'=>'required',
            'password'=>'required',
        ],[
            'key.required' => __('Vui lòng nhập mã ngân hàng'),
            'key.required' => __('Vui lòng nhập tài khoản đăng nhập'),
            'password.required' => __('Vui lòng nhập mật khẩu đăng nhập'),
        ]);
        $checkBank = Bank::where('key',$request->key)->where('username',$request->username)->first();
        if($checkBank){
            return redirect()->back()->withErrors('Tài khoản đã tồn tại!');
        }
        $input = $request->all();
        $username = $request->username;
        $password = $request->password;
        $data = TECHCOMBANK::getLogin($username,$password);
        if($data && isset($data['status']) && $data['status'] == 1){
            $input['holder_name'] = $data['customerName'];
            $input['password'] = Helpers::Encrypt($password,config('module.bank.key_hash_password'));
            $data=Bank::create($input);
            ActivityLog::add($request, 'Tạo mới thành công ngân hàng rút tiền'.$this->module.' #'.$data->id);
            if($request->filled('submit-close')){
                return redirect()->route('admin.'.$this->module.'.index')->with('success',__('Thêm mới thành công !'));
            }
            else {
                return redirect()->back()->with('success',__('Thêm mới thành công !'));
            }
        }
        else{
            return redirect()->back()->withErrors('Không thể login tài khoản !');
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
        $data = Bank::findOrFail($id);

        ActivityLog::add($request, 'Vào form edit '.$this->module.' #'.$data->id);
        return view('admin.bank.item.create_edit')
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
            'key'=>'required',
            'username'=>'required',
            'password'=>'required',
        ],[
            'key.required' => __('Vui lòng nhập mã ngân hàng'),
            'key.required' => __('Vui lòng nhập tài khoản đăng nhập'),
            'password.required' => __('Vui lòng nhập mật khẩu đăng nhập'),
        ]);
        $data = Bank::findOrFail($id);
        $input = $request->all();
        $username = $data->username;
        $password = $request->password;
        $bank = TECHCOMBANK::getLogin($username,$password);
        if($bank && isset($bank['status']) && $bank['status'] == 1){
            $input['holder_name'] = $bank['customerName'];
            $input['username'] = $data->username;
            $input['password'] = Helpers::Encrypt($password,config('module.bank.key_hash_password'));
            $data->update($input);
            ActivityLog::add($request, 'Chỉnh sửa thành công '.$this->module.' #'.$data->id);
            if($request->filled('submit-close')){
                return redirect()->route('admin.'.$this->module.'.index')->with('success',__('Cập nhật thành công !'));
            }
            else {
                return redirect()->back()->with('success',__('Cập nhật thành công !'));
            }
        }
        else{
            return redirect()->back()->withErrors('Không thể login tài khoản !');
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
        $data = Bank::findOrFail($request->id);
        $data->status = 0;
        $data->save();
        return redirect()->back()->with('success',__('Xóa thành công !'));
    }
}
