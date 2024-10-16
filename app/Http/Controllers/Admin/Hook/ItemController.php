<?php

namespace App\Http\Controllers\Admin\Hook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;
use App\Models\Order;
use App\Models\User;
use App\Library\Helpers;
use App\Library\HelpersApi;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $this->middleware('permission:hook-list');


        $this->page_breadcrumbs[] = [
            'page' => route('admin.hook.index'),
            'title' => __('Thống kê đơn hàng')
        ];
    }
    public function index(Request $request)
    {
        ActivityLog::add($request, 'Truy cập thống kê nạp thẻ charge-report');
        if ($request->ajax) {
            $datatable = Order::orderBy('id','desc')->where('module','hook');
            if ($request->filled('id')) {
                $datatable->where('id', $request->get('id'));
            }
            if ($request->filled('order_id')) {
                $datatable->where('order', $request->get('order_id'));
            }
            if ($request->filled('gate_id')) {
                $datatable->where('gate_id', $request->get('gate_id'));
            }

            if ($request->filled('started_at')) {
                $datatable->where('created_at', '>=', Carbon::createFromFormat('d/m/Y H:i:s', $request->get('started_at')));
            }
            if ($request->filled('ended_at')) {
                $datatable->where('created_at', '<=', Carbon::createFromFormat('d/m/Y H:i:s', $request->get('ended_at')));
            }
            return \datatables()->eloquent($datatable)
                ->editColumn('created_at', function ($data) {
                    return date('d/m/Y H:i:s', strtotime($data->created_at));
                })
                ->editColumn('gate_id', function ($data) {
                    return config('hook.gate_id.'.$data->gate_id);
                })
                ->editColumn('price', function ($data) {
                    return number_format($data->price);
                })
                ->addColumn('user', function($row) {
                    if(isset($row->author->username)){
                        return $row->author->username;
                    }
                    else{
                        return "Không tìm thấy shop";
                    }
                })
                ->addColumn('bank', function($row) {
                    $result = "";
                    if($row->gate_id == 1){
                       $params = json_decode($row->params);
                       $result .= $row->title;
                       $result .= " - ";
                       $result .= config('hook.gate_id.'.$row->gate_id);
                    }
                    else if($row->gate_id == 2){
                        if($row->bank->key != ""){
                            $result .= $row->bank->key;
                        }
                        if($row->bank->username != ""){
                            $result .= " - ".$row->bank->username;
                        }
                        if($row->bank->holder_name != ""){
                            $result .= ' - '.$row->bank->holder_name;
                        }
                    }
                    return $result;
                })
                ->addColumn('action', function($row) {
                    $temp= "<a  rel=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-success' data-toggle=\"modal\" data-target=\"#ReCallback\" title=\"Callback\"><i class=\"flaticon-arrows\"></i></a>";
                    return $temp;
                })
                ->toJson();
        }
        return view('admin.hook.item.index')
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

    public function ReCallback(Request $request){
        try{
            $id = $request->id;
            $order = Order::where('id',$id)->first();
            if(!$order){
                return response()->json([
                    'success' => false,
                    'message' => __('Không tìm thấy đơn hàng'),
                ]);
            }
            $shop = User::where('account_type',2)->where('id',$order->author_id)->where('is_agency_charge',1)->where('status',1)->first();
            if(!$shop){
                return response()->json([
                    'success' => false,
                    'message' => __('Không tìm thấy shop callback'),
                ]);
            }
            $urlCallback = $shop->url_callback; // url callback
            $arrayApi = array();
            $arrayApi['order_id'] = $order->order; // mã đơn hàng trên shop
            $arrayApi['gateway'] = $order->title; // ngan hang chuyen tien
            $arrayApi['status'] = 1; // trạng thái đơn hàng thành công
            $arrayApi['shop_key'] = $shop->agency_code; // mã shop đc cấu hình trên website
            $arrayApi['shop_name'] = $shop->username; // ten shop đc cấu hình trên website
            $arrayApi['amount'] = $order->price; // số tiền api trả về
            $arrayApi['content'] = $order->description; // nội dung thanh toán
            $arrayApi['tranid'] = $order->id; //id mã giao dịch của hook
            $callback = HelpersApi::CallbackApi($arrayApi,$urlCallback,$shop->id);
            $order->content = $callback;
            $order->save();
            return response()->json([
                'success' => true,
                'message' => __('Thành công'),
                'msg' => $order->content,
                'id' => $order->id
            ]);
        }
        catch(\Exception $e){
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => __('Có lỗi phát sinh vui lòng thử lại.'),
            ]);
        }
        

    }
}
