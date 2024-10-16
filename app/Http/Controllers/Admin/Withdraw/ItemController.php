<?php

namespace App\Http\Controllers\Admin\Withdraw;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;
use App\Models\Withdraw;
use App\Models\Bank;
use App\Models\Txns;
use App\Models\Order;
use Carbon\Carbon;
use App\Library\Helpers;
use App\Models\User;

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

        $this->module='withdraw';
        $this->moduleCategory=null;
        //set permission to function
        $this->middleware('permission:'. $this->module.'-list');
        $this->middleware('permission:'. $this->module.'-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:'. $this->module.'-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:'. $this->module.'-delete', ['only' => ['destroy']]);
        $this->middleware('permission:'. $this->module.'-update', ['only' => ['show','updateItem']]);



        $this->page_breadcrumbs[] = [
            'page' => route('admin.'.$this->module.'.index'),
            'title' => __(config('module.'.$this->module.'.title'))
        ];
    }
    public function index(Request $request)
    {
        ActivityLog::add($request, 'Truy cập trang duyệt lệnh rút tiền');
        if($request->ajax()){
            $datatable = Withdraw::with('user');  
            if ($request->filled('id')) {
                $datatable->where('id', $request->get('id'));
            }
            if ($request->filled('username')) {
                $datatable->whereHas('user', function ($query) use ($request) {
                    $query->where(function ($qChild) use ($request){
                        $qChild->orWhere('username', $request->get('username'));
                        $qChild->orWhere('email', $request->get('username'));
                        $qChild->orWhere('fullname_display', 'LIKE', '%' . $request->get('username') . '%');
                    });
                });
            }
            if ($request->filled('amount')) {
                $datatable->where('amount', $request->get('amount'));
            }

            if ($request->filled('status')) {
                $datatable->where('status', $request->get('status'));
            }

            if ($request->filled('started_at')) {
                $datatable->where('created_at', '>=', Carbon::createFromFormat('d/m/Y H:i:s', $request->get('started_at')));
            }
            if ($request->filled('ended_at')) {
                $datatable->where('created_at', '<=', Carbon::createFromFormat('d/m/Y H:i:s', $request->get('ended_at')));
            }
            return \datatables()->eloquent($datatable)
            ->addColumn('auth', function($row) {
                $result = "";
                if($row->user->fullname_display != ""){
                    $result .= $row->user->fullname_display;
                }
                if($row->user->email != ""){
                    $result .= ' - '.$row->user->email;
                }
                return $result;
            })
            ->editColumn('fee', function ($data) {
                return percent_format($data->fee) . "%";
            })
            ->editColumn('amount', function ($data) {
                return number_format($data->amount) . " VNĐ";
            })
            ->editColumn('amount_passed', function ($data) {
                return number_format($data->amount_passed) . " VNĐ";
            })
            ->editColumn('created_at', function ($data) {
                return date('d/m/Y H:i:s', strtotime($data->created_at));
            })
            ->addColumn('action', function($row) {
                $temp= "<a href=\"".route('admin.withdraw.show',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary \" title=\"Xem chi tiết\"><i class=\"flaticon-medical\"></i></a>";
                return $temp;
            })
            ->toJson();
        }
        return view('admin.withdraw.item.index')
            ->with('module', null)
            ->with('page_breadcrumbs', $this->page_breadcrumbs);
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
    public function show(Request $request,$id)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Chi tiết lệnh rút tiền")
        ];
        $data = Withdraw::with('user')->with('processor')->where('id',$id)->firstOrFail();
        ActivityLog::add($request, 'Truy cập chi tiết lệnh rút tiền #'.$data->id);
        return view('admin.withdraw.item.show')
        ->with('data',$data)
        ->with('page_breadcrumbs', $this->page_breadcrumbs);
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
    public function updateItem(Request $request,$id){
        $this->validate($request,[
            'status'=>'required',
            'description'=>'required',
            'password2'=>'required',
        ],[
            'status.required' => __('Trường trạng thái đơn hàng bị thiếu'),
            'description.required' => __('Trường nội dung bị thiếu'),
            'password2.required' => __('Vui lòng nhập mật khẩu cấp 2'),
        ]);
        
        //check password2
        if(!\Hash::check($request->password2,\Auth::user()->password2)){
            session()->put('fail_password2',  session()->get('fail_password2')+1);
            return redirect()->back()->withErrors(__('Mật khẩu cấp 2 không đúng'));
        }
        else{
            session()->put('fail_password2', 0);
        }
        $description = $request->description;
        if(strlen($description) < 10){
            return redirect()->back()->withErrors(__('Nội dung quá ngắn !'));
        }
        $status = $request->status;
        // tìm đơn hàng
        DB::beginTransaction();
        try{
            $data = Withdraw::where('id',$id)->lockForUpdate()->first();
            if(!$data){
                DB::rollback();
                return redirect()->back()->withErrors('Không tìm thấy lệnh rút tiền !');
            }
            if($data->status != 2){
                DB::rollback();
                return redirect()->back()->withErrors('Chỉ cập nhật lệnh rút tiền ở trạng thái đang chờ !');
            }
            // trường hợp cập nhật thành công: update status,nội dung giao dịch và người xử lý đơn hàng
            if($status == 1){
                if($request->image == "" || $request->image == null){
                    DB::rollback();
                    return redirect()->back()->withErrors('Vui lòng chọn ảnh khi cập nhận lệnh rút tiền thành công');
                }
                $admin_note = new \stdClass();
                $admin_note->image = $request->image;
                $admin_note = json_encode($admin_note,JSON_UNESCAPED_UNICODE);
                $data->status = 1;
                $data->admin_note = $admin_note;
                $data->description = $description;
                $data->processor_id = Auth::user()->id;
                $data->save();
            }
            // trường hợp cập nhật thất bại, update status, nội dung từ chối lệnh,update người xử lý đơn hàng, cộng hoàn trả tiền idol và lưu biến động số dư
            elseif($status == 0){
                $userTransaction = User::where('id', $data->user_id)->where('account_type',2)->lockForUpdate()->first();
                if(!$userTransaction){
                    return redirect()->back()->withErrors(__('Không tìm người rút tiền !'));
                }
                $userTransaction->balance = $userTransaction->balance + $data->amount_passed;
                $userTransaction->balance_in = $userTransaction->balance_in + $data->amount_passed;
                $userTransaction->save();
                $data->status = 0;
                $data->description = $description;
                $data->processor_id = Auth::user()->id;
                $data->save();
                $txns = Txns::create([
                    'user_id'=>$userTransaction->id,
                    'trade_type'=>'withdraw', //cộng tiền
                    'is_add'=>'1',//Cộng tiền
                    'amount'=>$data->amount_passed,
                    'last_balance'=>$userTransaction->balance,
                    'description'=>'Hoàn tiền lệnh rút tiền bị từ chối duyệt #'.$data->id,
                    'ip'=>$request->getClientIp(),
                    'status' => 1
                ]);
            }
            else{
                DB::rollback();
                return redirect()->back()->withErrors('Chỉ cập nhật lệnh rút tiền sang trạng thái thành công hoặc thất bại !');
            }
        }
        catch(\Exception $e){
            DB::rollback();
            Log::error($e);
            return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
        }
        ActivityLog::add($request, 'Cập nhật lệnh rút tiền #'.$data->id.' sang trạng thái '.$data->status);
        DB::commit();
        return redirect()->back()->with('success',__('Cập nhật trạng thái đơn hàng thành công !'));
        
    }
}
