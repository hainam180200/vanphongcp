<?php

namespace App\Http\Controllers\Admin\StoreTelecom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;
use App\Models\StoreTelecom;
use App\Models\StoreTelecomValue;
use App\Models\StoreCard;
use App\Models\Txns;
use App\Models\Order;
use Carbon\Carbon;
use App\Library\Helpers;
use App\Models\User;
// use DateTime;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Request $request)
    {

        //set permission to function
        $this->middleware('permission:store-card-report-list');
        $this->middleware('permission:store-card-report-show', ['only' => ['show','updateOrder']]);


        $this->page_breadcrumbs[] = [
            'page' => route('admin.store-card-report.index'),
            'title' => __('Thống kê mua thẻ')
        ];
    }
    public function index(Request $request)
    {
        ActivityLog::add($request, 'Truy cập thống kê mua thẻ store-card-report');
        if ($request->ajax) {
            $datatable = Order::with('author')->where('module','store_card');


            if ($request->filled('id')) {
                $datatable->where('id', $request->get('id'));
            }
            if ($request->filled('tranid')) {
                $datatable->where('tranid', $request->get('tranid'));
            }


            if ($request->filled('username')) {
                $datatable->whereHas('author', function ($query) use ($request) {
                    $query->where(function ($qChild) use ($request){
                        $qChild->orWhere('username', $request->get('username'));
                        $qChild->orWhere('email', $request->get('username'));
                        $qChild->orWhere('fullname_display', 'LIKE', '%' . $request->get('username') . '%');
                    });

                });
            }

            if ($request->filled('find')) {
                $datatable->where(function ($query) use ($request) {
                    $query->orWhere('pin', Helpers::Encrypt($request->get('find'),config('module.charge.key_encrypt')));
                    $query->orWhere('serial', $request->get('find'));
                });
            }
            if ($request->filled('gate_id')) {
                $datatable->where('gate_id', $request->get('gate_id'));
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
            //$subDatatable= $datatable;
            return \datatables()->eloquent($datatable)

                ->only([
                    'id',
                    'user',
                    'telecom',
                    'params',
                    'amount',
                    'quantity',
                    'ratio',
                    'description',
                    'real_received_price',
                    'gate_id',
                    'tranid',
                    'status',
                    'action',
                    'created_at',
                ])
                ->addColumn('user', function($row) {
                    $result = "";
                    if($row->author->fullname_display != ""){
                        $result .= $row->author->fullname_display;
                    }
                    if($row->author->email != ""){
                        $result .= ' - '.$row->author->email;
                    }
                    return $result;
                })
                ->editColumn('ratio', function ($data) {
                    return percent_format($data->ratio) . "%";
                })
                ->editColumn('real_received_price', function ($data) {
                    return number_format($data->real_received_price) . " VNĐ";
                })
                ->editColumn('created_at', function ($data) {
                    return date('d/m/Y H:i:s', strtotime($data->created_at));
                })
                ->addColumn('telecom', function($row) {
                   return json_decode($row->params)->telecom;
                })
                ->addColumn('amount', function($row) {
                   return json_decode($row->params)->amount;
                })
                ->addColumn('quantity', function($row) {
                   return json_decode($row->params)->quantity;
                })
                ->addColumn('action', function($row) {
                    $temp= "<a href=\"".route('admin.store-card-report.show',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary \" title=\"Xem chi tiết\"><i class=\"flaticon-medical\"></i></a>";
                    return $temp;
                })
                ->toJson();
        }

        $telecom = StoreTelecom::pluck('title','key')->toArray();

        return view('admin.store-telecom.report.index')
            ->with('module', null)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('telecom', $telecom);
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
    public function show(Request $request, $id)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Chi tiết đơn hàng")
        ];
        $data = Order::with('author')->where('id',$id)->firstOrFail();
        ActivityLog::add($request, 'Truy cập thống kê nạp thẻ charge-report #'.$data->id);
        return view('admin.store-telecom.report.show')
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
    public function updateOrder(Request $request, $id){
        // tìm đơn hàng
        $data = Order::with('author')->where('id',$id)->first();
        $status_old = $data->status;
        if(!$data){
            return redirect()->back()->withErrors(__('Đơn hàng không hợp lệ !'));
        }
        if($data->status == 0){
            return redirect()->back()->withErrors(__('Đơn hàng đang ở trạng thái thất bại !'));
        }
        if($data->status == 1){
            return redirect()->back()->withErrors(__('Đơn hàng đang ở trạng thái thành công !'));
        }
        if($data->status == $request->status){
            return redirect()->back()->withErrors(__('Đơn hàng đang ở trạng thái này !'));
        }
        $status = $request->status;
        if($status != 1 && $status != 0){
            return redirect()->back()->withErrors(__('Chỉ cập nhật đơn hàng về trạng thái thành công hoặc thất bại !'));
        }
        DB::beginTransaction();
        try {
            // trường hợp cập nhật đơn hàng về thất bại
            if($status == 0){
                // tìm người mua
                $userTransaction = User::where('id', $data->author_id)->lockForUpdate()->first();
                if(!$userTransaction){
                    return redirect()->back()->withErrors(__('Không tìm thấy chủ đơn hàng !'));
                }
                // hoàn lại tiền cho user
                $userTransaction->balance = $userTransaction->balance + $data->real_received_price;
                // cộng số tiền vào cho user
                $userTransaction->balance_in = $userTransaction->balance_in + $data->real_received_price;
                $userTransaction->save();
                $data->status = 0;
                $data->save();
                $txns = Txns::create([
                    'user_id'=>$userTransaction->id,
                    'trade_type'=>'plus_money', //cộng tiền
                    'is_add'=>'1',//Cộng tiền
                    'amount'=>$data->real_received_price,
                    'last_balance'=>$userTransaction->balance,
                    'description'=>'Hoàn tiền giao dịch thẻ lỗi',
                    'ip'=>$request->getClientIp(),
                    'status'=>1
                ]);
            }
            // cập nhật thành công
            else if($status == 1){
                $data->status = 1;
                $data->save();
            }
            else{
                DB::rollback();
                return redirect()->back()->withErrors(__('Chỉ cập nhật đơn hàng về trạng thái thành công hoặc thất bại !'));
            }
        }catch(\Exception $e){
            DB::rollback();
            Log::error($e);
            return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
        }
        ActivityLog::add($request, 'Cập nhật trạng thái đơn hàng #'.$data->id. ' từ trạng thái '.$status_old. ' sang trạng thái '.$status);
        DB::commit();
        return redirect()->back()->with('success',__('Cập nhật trạng thái đơn hàng thành công !'));
        
    }
}
