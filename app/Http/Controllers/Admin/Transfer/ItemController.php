<?php

namespace App\Http\Controllers\Admin\Transfer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Item;
use App\Models\Order;
use App\Models\Txns;
use App\Models\User;
use Carbon\Carbon;
use Log;
use DB;
use Auth;

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

        $this->module='transfer';
        $this->moduleCategory=null;
        //set permission to function
        $this->middleware('permission:'. $this->module.'-list');
        $this->middleware('permission:'. $this->module.'-create', ['only' => ['create', 'store','duplicate']]);
        $this->middleware('permission:'. $this->module.'-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:'. $this->module.'-delete', ['only' => ['destroy']]);
        $this->middleware('permission:'. $this->module.'-update-order', ['only' => ['updateOrder']]);



        $this->page_breadcrumbs[] = [
            'page' => route('admin.'.$this->module.'.index'),
            'title' => __(config('module.'.$this->module.'.title'))
        ];
    }

    public function index(Request $request)
    {
        ActivityLog::add($request, 'Truy cập danh sách '.$this->module);
        if($request->ajax()){
            $datatable = Order::where('module','=','charge_bank')->where('payment_type',0)->where('status', '<>', -1);
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

            ->only([
                'id',
                'author_id',
                'price',
                'bank_name',
                'number_account',
                'status',
                'created_at',
                'action'
            ])


            ->editColumn('created_at', function($data) {
                return date('d/m/Y H:i:s', strtotime($data->created_at));
            })
            ->editColumn('author_id', function($data) {
                return $data->author->fullname_display;
            })
            ->editColumn('price', function($data) {
                return number_format($data->price);
            })
            ->addColumn('bank_name', function($row) {
                return $row->params->name;
            })
            ->addColumn('number_account', function($row) {
                return $row->params->number_account;
            })
            ->addColumn('action', function($row) {
                $temp= "<a href=\"".route('admin.'.$this->module.'.show',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary \" title=\"Xem\"><i class=\"la la-eye\"></i></a>";
                return $temp;
            })
            ->toJson();
        }
        return view('admin.transfer.item.index')
        ->with('module', $this->module)
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
    public function show($id)
    {
        $data =  Order::where('module','=','charge_bank')->where('payment_type',0)->findOrFail($id);
        return view('admin.transfer.item.show')
        ->with('data',$data)
        ->with('module', $this->module)
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

    }
    
    public function updateOrder(Request $request, $id){
        $this->validate($request,[
            'status'=>'required',
        ],[
            'status.required' => __('Trạng thái chưa được chọn'),
        ]);
        try{
            DB::beginTransaction();
            $data =  Order::where('module','=','charge_bank')->where('payment_type',0)->findOrFail($id);
            // check status gửi lên trùng status của đơn hàng
            if($data->status == $request->status){
                return redirect()->back()->withErrors(__('Đơn hàng đã ở trạng thái được chọn'));
            }

            // kiểm tra đơn hàng đã được xử lý hay chưa
            if($data->status != 2){
                return redirect()->back()->withErrors(__('Chỉ xử lý đơn hàng ở trạng thái đang chờ'));
            }

            // kiểm tra số tiền của đơn hàng
            if($data->pirce < 0){
                return redirect()->back()->withErrors(__('Số tiền không hợp lệ'));
            }

            // tìm tài khoản người dùng
            $userTransaction = User::where('account_type',2)->where('status',1)->where('id',$data->author_id)->lockForUpdate()->first();
            if(!$userTransaction){
                return redirect()->back()->withErrors(__('Không tìm thấy người dùng'));
            }

            // kiểm tra tính hợp lệ của tài khoản người dùng
            if($userTransaction->checkBalanceValid() == false){
                return redirect()->back()->withErrors(__('Tài khoản người dùng đang có nghi vấn'));
            }
            $status = $request->status;
            // cập nhật người xử lý đơn hàng
            $data->processor_id = Auth::user()->id;

            // đơn hàng được tính là thành công và đúng tiền nạp
            if($status == 1){
                 // cập nhật trạng thái
                $data->status = 1;
                // số tiền được cộng bằng với sô tiền của đơn hàng
                $real_received_price = $data->price;
                $data->real_received_price = $real_received_price; // cập nhật số tiền thực nhận

                // cộng tiền user
                $userTransaction->balance = $userTransaction->balance + $real_received_price;

                // cộng số balance_in của user
                $userTransaction->balance_in = $userTransaction->balance_in + $real_received_price;
                $userTransaction->save();
                $txns=Txns::create([
                    'trade_type' => '1',//thanh toan ngan hang
                    'is_add'=>'1',//tru tien
                    'user_id'=>$userTransaction->id,
                    'amount'=>$real_received_price,
                    'real_received_amount'=>$real_received_price,
                    'last_balance'=>$userTransaction->balance,
                    'description'=>"Cộng tiền nạp tiền theo hình thức chuyển khoản thủ công",
                    'ip'=>$request->getClientIp(),
                    'ref_id'=>$data->id,
                    'status'=>1
                ]);
            }
            // đơn hàng được tính là thành công nhưng số tiền nạp sai
            else if($status == 3){
                // số tiền thực nhận mà qtv gửi lên
                $real_received_price = (int)str_replace(array(' ','.',','), '', $request->price);

                // kiểm tra số tiền thực nhận
                if($real_received_price < 0){
                    return redirect()->back()->withErrors(__('Số tiền thực nhận không hợp lệ'));
                }
                // cập nhật trạng thái đơn hàng thành công sai mệnh giá
                $data->status = 3;

                $data->real_received_price = $real_received_price; // cập nhật số tiền thực nhận

                // cộng tiền user
                $userTransaction->balance = $userTransaction->balance + $real_received_price;

                // cộng số balance_in của user
                $userTransaction->balance_in = $userTransaction->balance_in + $real_received_price;
                $userTransaction->save();
                $txns=Txns::create([
                    'trade_type' => '1',//thanh toan ngan hang
                    'is_add'=>'1',//tru tien
                    'user_id'=>$userTransaction->id,
                    'amount'=>$real_received_price,
                    'real_received_amount'=>$real_received_price,
                    'last_balance'=>$userTransaction->balance,
                    'description'=>"Cộng tiền (sai mệnh giá) nạp tiền theo hình thức chuyển khoản thủ công",
                    'ip'=>$request->getClientIp(),
                    'ref_id'=>$data->id,
                    'status'=>1
                ]);
            }
            // đơn hàng thất bại
            else if($status == 0){
                // cập nhật trạng thái đơn hàng
                $data->status = 0;
                $data->real_received_price = 0;
            }

            $data->save();
            DB::commit();
            return redirect()->back()->with('success',__('Xử lý đơn hàng thành công !'));
        }
        catch (\Exception $e) {
            Log::error($e);
            throw $e;
            return redirect()->back()->withErrors('Có lỗi phát sinh vui lòng thử lại');
        }
        

        
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
}
