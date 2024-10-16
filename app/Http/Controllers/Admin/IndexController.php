<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ActivityLog;
use App\Models\Charge;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;
use Carbon\Carbon;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DepositBankExport;
use App\Exports\ChargeExport;
use App\Exports\StoreCardExport;
use App\Exports\DonateExport;

class IndexController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('role:admin');
        // $this->middleware('role:admin', ['only' => ['GrowthUser', 'ClassifyUser','GrowthTopupCard','GrowthStoreCard','GrowthTopupBank','GrowthDonate','ExportDepositBank','ExportCharge','ExportStoreCard','ExportDonate']]);
    }
    public function index(Request $request){
        $page_title = 'Dashboard';
        $page_breadcrumbs = [
            [   'page' => '1',
                'title' => 'Home',
            ],
        ];
        $product = Item::where('module', 'product')->orderBy('totalviews','desc')->limit(10)->get();
        $article = Item::where('module', 'article')->orderBy('totalviews','desc')->limit(10)->get();
        ActivityLog::add($request, 'Truy cập dashboard index');
        return view('admin.index', compact('page_title', 'page_breadcrumbs','product','article'));
    }
    public function GrowthUser(Request $request){
        $year = Carbon::now()->year;
        $month =  Carbon::now()->month;
        if ($request->filled('year')) {
            $year = $request->get('year');
        }
        if($year < Carbon::now()->year){
            $month = 12;
        }
        $data = User::select(DB::raw('count(*) as user, month(created_at) as m'))
                    ->where(function ($query) use ($request){
                        $query->where('is_idol', null);
                        $query->orWhere('is_idol',0);
                    })
                    ->where('account_type',2)
                    ->whereYear('created_at', '=', $year)
                    ->groupBy('m')
                    ->get();
        $growth_user = [];
        for($i=1; $i<=$month; $i++){
            $growth_user[$i] = 0;
            $growth_month[$i] = "Tháng ".$i;
        }
        foreach ($data as $item){
            $growth_user[$item->m] = $item->user;
        }
        // dd($growth);
        $growth = [
            'growth_user' => $growth_user,
            'growth_month' => $growth_month,
        ];
        return response()->json([
            "success"=> true,
            "data" => $growth,
        ], 200);
    }
    public function GrowthIdol(Request $request){
        $year = Carbon::now()->year;
        $month =  Carbon::now()->month;
        if ($request->filled('year')) {
            $year = $request->get('year');
        }
        if($year < Carbon::now()->year){
            $month = 12;
        }
        $data = User::select(DB::raw('count(*) as user, month(created_at) as m'))
                    ->where('is_idol',1)
                    ->where('account_type',2)
                    ->whereYear('created_at', '=', $year)
                    ->groupBy('m')
                    ->get();
        $growth_user = [];
        for($i=1; $i<=$month; $i++){
            $growth_user[$i] = 0;
            $growth_month[$i] = "Tháng ".$i;
        }
        foreach ($data as $item){
            $growth_user[$item->m] = $item->user;
        }
        // dd($growth);
        $growth = [
            'growth_user' => $growth_user,
            'growth_month' => $growth_month,
        ];
        return response()->json([
            "success"=> true,
            "data" => $growth,
        ], 200);
    }
    public function ClassifyUser(Request $request){
        $idol = User::where('account_type',2)->where('is_idol',1)->where('status',1)->count();
        $pedding_idol = User::where('account_type',2)->where('is_idol',2)->where('status',1)->count();
        $user = User::where('account_type',2)
        ->where(function ($query) use ($request){
            $query->where('is_idol', null);
            $query->orWhere('is_idol',0);
        })
        ->where('status',1)->count();
        $user_block = User::where('account_type',2)->where('status',0)->count();
        $user_qtv = User::where('account_type',1)->where('status',1)->count();
        $data = [
            'idol' => $idol,
            'pedding_idol' => $pedding_idol,
            'user' => $user,
            'user_block' => $user_block,
            'user_qtv' => $user_qtv,
        ];
        return response()->json([
            "success"=> true,
            "data" => $data,
        ], 200);
    }
    public function GrowthTopupCard(Request $request){
        $month =  Carbon::now()->month;
        $year = Carbon::now()->year;
        $day = Carbon::now()->day;
        if ($request->filled('year')) {
            $year = $request->get('year');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        if ($request->filled('month')) {
            $month = $request->get('month');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        $sum_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for($i=1; $i<=$day; $i++){
            $growth_card_fail[$i] = 0;
            $growth_card_succes[$i] = 0;
            $growth_card_pendding[$i] = 0;
            $growth_day[$i] = "Ngày ".$i;
        }
        $data_card_fail = Charge::select(DB::raw('count(*) as charge, day(created_at) as d'))->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('status',0)->groupBy('d')->get();
        foreach ($data_card_fail as $item){
            $growth_card_fail[$item->d] = $item->charge;
        }
        $data_card_succes = Charge::select(DB::raw('count(*) as charge, day(created_at) as d'))->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('status',1)->groupBy('d')->get();
        foreach ($data_card_succes as $item){
            $growth_card_succes[$item->d] = $item->charge;
        }
        $data_card_pendding = Charge::select(DB::raw('count(*) as charge, day(created_at) as d'))->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('status',2)->groupBy('d')->get();
        foreach ($data_card_pendding as $item){
            $growth_card_pendding[$item->d] = $item->charge;
        }
        $data = [
            'growth_card_fail' => $growth_card_fail,
            'growth_card_susscess' => $growth_card_succes,
            'growth_card_pendding' => $growth_card_pendding,
            'growth_day' => $growth_day,
        ];
        return response()->json([
            "success"=> true,
            "data" => $data,
        ], 200);
    }
    public function GrowthStoreCard(Request $request){
        $year = Carbon::now()->year;
        $month =  Carbon::now()->month;
        $day = Carbon::now()->day;
        if ($request->filled('year')) {
            $year = $request->get('year');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        if ($request->filled('month')) {
            $month = $request->get('month');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        for($i=1; $i<=$day; $i++){
            $growth_fail[$i] = 0;
            $growth_susscess[$i] = 0;
            $growth_pendding[$i] = 0;
            $growth_day[$i] = "Ngày ".$i;
        }
        $data_fail = Order::select(DB::raw('count(*) as item, day(created_at) as d'))->where('module','store_card')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('status',0)->groupBy('d')->get();
        foreach ($data_fail as $item){
            $growth_fail[$item->d] = $item->item;
        }
        $data_susscess = Order::select(DB::raw('count(*) as item, day(created_at) as d'))->where('module','store_card')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('status',1)->groupBy('d')->get();
        foreach ($data_susscess as $item){
            $growth_susscess[$item->d] = $item->item;
        }
        $data_pendding = Order::select(DB::raw('count(*) as item, day(created_at) as d'))->where('module','store_card')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)
        ->where(function ($query) use ($request){
            $query->where('status',2);
            $query->orWhere('status',4);
            $query->orWhere('status',5);
        })
        ->groupBy('d')->get();
        foreach ($data_pendding as $item){
            $growth_pendding[$item->d] = $item->item;
        }
        $data = [
            'growth_fail' => $growth_fail,
            'growth_susscess' => $growth_susscess,
            'growth_pendding' => $growth_pendding,
            'growth_day' => $growth_day,
        ];
        return response()->json([
            "success"=> true,
            "data" => $data,
        ], 200);
    }
    public function GrowthTopupBank(Request $request){
        $month =  Carbon::now()->month;
        $year = Carbon::now()->year;
        $day = Carbon::now()->day;
        if ($request->filled('year')) {
            $year = $request->get('year');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        if ($request->filled('month')) {
            $month = $request->get('month');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        for($i=1; $i<=$day; $i++){
            $growth_fail[$i] = 0;
            $growth_susscess[$i] = 0;
            $growth_pendding[$i] = 0;
            $growth_cancelled[$i] = 0;
            $growth_day[$i] = "Ngày ".$i;
        }
        $data_fail = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                    ->where('module','=','charge_bank')
                    ->where('payment_type',1)
                    ->whereMonth('created_at', '=', $month)
                    ->whereYear('created_at', '=', $year)
                    ->where('status',0)
                    ->groupBy('d')
                    ->get();
        foreach ($data_fail as $item){
            $growth_fail[$item->d] = $item->item;
        }
        $data_susscess = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                        ->where('module','=','charge_bank')
                        ->where('payment_type',1)
                        ->whereMonth('created_at', '=', $month)
                        ->whereYear('created_at', '=', $year)
                        ->where('status',1)
                        ->groupBy('d')
                        ->get();
        foreach ($data_susscess as $item){
            $growth_susscess[$item->d] = $item->item;
        }
        $data_pendding  = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                        ->where('module','=','charge_bank')
                        ->where('payment_type',1)
                        ->whereMonth('created_at', '=', $month)
                        ->whereYear('created_at', '=', $year)
                        ->where('status',2)
                        ->groupBy('d')
                        ->get();
        foreach ($data_pendding as $item){
            $growth_pendding[$item->d] = $item->item;
        }
        $data_cancelled  = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                        ->where('module','=','charge_bank')
                        ->where('payment_type',1)
                        ->whereMonth('created_at', '=', $month)
                        ->whereYear('created_at', '=', $year)
                        ->where('status',3)
                        ->groupBy('d')
                        ->get();
        foreach ($data_cancelled as $item){
            $growth_cancelled[$item->d] = $item->item;
        }
        $data = [
            'growth_fail' => $growth_fail,
            'growth_susscess' => $growth_susscess,
            'growth_pendding' => $growth_pendding,
            'growth_cancelled' => $growth_cancelled,
            'growth_day' => $growth_day,
        ];
        return response()->json([
            "success"=> true,
            "data" => $data,
        ], 200);
    }
    public function GrowthDonate(Request $request){
        $month =  Carbon::now()->month;
        $year = Carbon::now()->year;
        $day = Carbon::now()->day;
        if ($request->filled('year')) {
            $year = $request->get('year');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        if ($request->filled('month')) {
            $month = $request->get('month');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        for($i=1; $i<=$day; $i++){
            $growth_fail[$i] = 0;
            $growth_susscess[$i] = 0;
            $growth_pendding[$i] = 0;
            $growth_cancelled[$i] = 0;
            $growth_day[$i] = "Ngày ".$i;
        }
        $data_fail = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                    ->where('module','donate')
                    ->whereMonth('created_at', '=', $month)
                    ->whereYear('created_at', '=', $year)
                    ->where('status',0)
                    ->groupBy('d')
                    ->get();
        foreach ($data_fail as $item){
            $growth_fail[$item->d] = $item->item;
        }
        $data_susscess = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                    ->where('module','donate')
                    ->whereMonth('created_at', '=', $month)
                    ->whereYear('created_at', '=', $year)
                    ->where('status',1)
                    ->groupBy('d')
                    ->get();
        foreach ($data_susscess as $item){
            $growth_susscess[$item->d] = $item->item;
        }
        $data_pendding = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                    ->where('module','donate')
                    ->whereMonth('created_at', '=', $month)
                    ->whereYear('created_at', '=', $year)
                    ->where('status',2)
                    ->groupBy('d')
                    ->get();
        foreach ($data_pendding as $item){
            $growth_pendding[$item->d] = $item->item;
        }
        $data_pendding = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                    ->where('module','donate')
                    ->whereMonth('created_at', '=', $month)
                    ->whereYear('created_at', '=', $year)
                    ->where('status',2)
                    ->groupBy('d')
                    ->get();
        foreach ($data_pendding as $item){
            $growth_pendding[$item->d] = $item->item;
        }
        $data_cancelled = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                    ->where('module','donate')
                    ->whereMonth('created_at', '=', $month)
                    ->whereYear('created_at', '=', $year)
                    ->where('status',3)
                    ->groupBy('d')
                    ->get();
        foreach ($data_cancelled as $item){
            $growth_cancelled[$item->d] = $item->item;
        }
        $data = [
            'growth_fail' => $growth_fail,
            'growth_susscess' => $growth_susscess,
            'growth_pendding' => $growth_pendding,
            'growth_cancelled' => $growth_cancelled,
            'growth_day' => $growth_day,
        ];
        return response()->json([
            "success"=> true,
            "data" => $data,
        ], 200);
    }
    public function ExportDepositBank(Request $request){
        $year = $request->year;
        $month = $request->month;
        return Excel::download(new DepositBankExport($year,$month), 'Thống kê nạp tiền qua ngân hàng tự động '.$month.'-'.$year.'.xlsx');
    }
    public function ExportCharge(Request $request){
        $year = $request->year;
        $month = $request->month;
        return Excel::download(new ChargeExport($year,$month), 'Thống kê nạp thẻ '.$month.'-'.$year.'.xlsx');
    }
    public function ExportStoreCard(Request $request){
        $year = $request->year;
        $month = $request->month;
        return Excel::download(new StoreCardExport($year,$month), 'Thống kê mua thẻ '.$month.'-'.$year.'.xlsx');
    }
    public function ExportDonate(Request $request){
        $year = $request->year;
        $month = $request->month;
        return Excel::download(new DonateExport($year,$month), 'Thống kê donate '.$month.'-'.$year.'.xlsx');
    }

    public function GrowthOrder(Request $request){
        $month =  Carbon::now()->month;
        $year = Carbon::now()->year;
        $day = Carbon::now()->day;
        if ($request->filled('year')) {
            $year = $request->get('year');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        if ($request->filled('month')) {
            $month = $request->get('month');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        for($i=1; $i<=$day; $i++){
            $growth_0[$i] = 0;
            $growth_1[$i] = 0;
            $growth_2[$i] = 0;
            $growth_3[$i] = 0;
            $growth_4[$i] = 0;
            $growth_day[$i] = "Ngày ".$i;
        }
        $data_0 = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                    ->where('module','=','order')
                    ->whereMonth('created_at', '=', $month)
                    ->whereYear('created_at', '=', $year)
                    ->where('status',0)
                    ->groupBy('d')
                    ->get();
        foreach ($data_0 as $item){
            $growth_0[$item->d] = $item->item;
        }
        $data_1 = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                        ->where('module','=','order')
                        ->whereMonth('created_at', '=', $month)
                        ->whereYear('created_at', '=', $year)
                        ->where('status',1)
                        ->groupBy('d')
                        ->get();
        foreach ($data_1 as $item){
            $growth_1[$item->d] = $item->item;
        }
        $data_2  = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                        ->where('module','=','order')
                        ->whereMonth('created_at', '=', $month)
                        ->whereYear('created_at', '=', $year)
                        ->where('status',2)
                        ->groupBy('d')
                        ->get();
        foreach ($data_2 as $item){
            $growth_2[$item->d] = $item->item;
        }
        $data_3  = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                        ->where('module','=','order')
                        ->whereMonth('created_at', '=', $month)
                        ->whereYear('created_at', '=', $year)
                        ->where('status',3)
                        ->groupBy('d')
                        ->get();
        foreach ($data_3 as $item){
            $growth_3[$item->d] = $item->item;
        }
        $data_4  = Order::select(DB::raw('count(*) as item, day(created_at) as d'))
                        ->where('module','=','order')
                        ->whereMonth('created_at', '=', $month)
                        ->whereYear('created_at', '=', $year)
                        ->where('status',4)
                        ->groupBy('d')
                        ->get();
        foreach ($data_4 as $item){
            $growth_4[$item->d] = $item->item;
        }
        $data = [
            'growth_0' => $growth_0,
            'growth_1' => $growth_1,
            'growth_2' => $growth_2,
            'growth_3' => $growth_3,
            'growth_4' => $growth_4,
            'growth_day' => $growth_day,
        ];
        return response()->json([
            "success"=> true,
            "data" => $data,
        ], 200);
    }
    public function GrowthPrice(Request $request){
        $month =  Carbon::now()->month;
        $year = Carbon::now()->year;
        $day = Carbon::now()->day;
        if ($request->filled('year')) {
            $year = $request->get('year');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        if ($request->filled('month')) {
            $month = $request->get('month');
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        for($i=1; $i<=$day; $i++){
            $growth[$i] = 0;
            $growth_day[$i] = "Ngày ".$i;
        }
        $data = Order::select(DB::raw('SUM(real_received_price) as price, day(created_at) as d'))
                    ->where('module','=','order')
                    ->whereMonth('created_at', '=', $month)
                    ->whereYear('created_at', '=', $year)
                    ->where('status',4)
                    ->groupBy('d')
                    ->get();
        foreach ($data as $item){
            $growth[$item->d] = $item->price;
        }
        $data = [
            'growth' => $growth,
            'growth_day' => $growth_day,
        ];
        return response()->json([
            "success"=> true,
            "data" => $data,
        ], 200);
    }
}
