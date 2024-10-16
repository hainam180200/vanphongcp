<?php

namespace App\Http\Controllers\Admin\PlusMoney;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\PlusMoney;
use App\Models\Txns;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{


    public function __construct(Request $request)
    {

        //set permission to function
        $this->middleware('permission:plusmoney-report-list');
        //$this->middleware('permission:'. $this->module.'-create', ['only' => ['create', 'store','duplicate']]);
        //$this->middleware('permission:'. $this->module.'-edit', ['only' => ['edit', 'update']]);
        //$this->middleware('permission:'. $this->module.'-delete', ['only' => ['destroy']]);


        $this->page_breadcrumbs[] = [
            'page' => route('admin.plusmoney-report.index'),
            'title' => __('Lịch sử cộng tiền')
        ];
    }


    public function index(Request $request)
    {


        ActivityLog::add($request, 'Truy cập biến động số dư plusmoney-report');
        if ($request->ajax) {
            $datatable = PlusMoney::with('user','processor');

            if ($request->filled('id')) {
                $datatable->where('id', $request->get('id'));
            }

            if ($request->filled('username')) {


                $datatable->whereHas('user', function ($query) use ($request) {

                    $query->orWhere('username', $request->get('username'));
                    $query->orWhere('email', $request->get('username'));
                });
            }

            if ($request->filled('status')) {
                $datatable->where('status', $request->get('status'));
            }
            if ($request->filled('description')) {
                $datatable->where('description', 'LIKE', '%' . $request->get('description') . '%');
            }

            if ($request->filled('started_at')) {
                $datatable->where('created_at', '>=', Carbon::createFromFormat('d/m/Y H:i:s', $request->get('started_at')));
            }
            if ($request->filled('ended_at')) {
                $datatable->where('created_at', '<=', Carbon::createFromFormat('d/m/Y H:i:s', $request->get('ended_at')));
            }
            //$subDatatable= $datatable;
            return \datatables()->eloquent($datatable)

                //->only([
                //    'id',
                //    'pin',
                //    'serial',
                //
                //])

                ->editColumn('created_at', function ($data) {
                    return date('d/m/Y H:i:s', strtotime($data->created_at));
                })
                ->with('totalSumary', function() use ($datatable) {
                    return $datatable->first([
                        DB::raw('SUM(IF(is_add = 1, 1, 0)) as total_add '),
                        DB::raw('SUM(IF(is_add = 1, amount, 0)) as total_add_amount'),
                        DB::raw('SUM(IF(is_add = 0, 1, 0)) as total_minus'),
                        DB::raw('SUM(IF(is_add = 0, amount, 0)) as total_minus_amount')
                    ]);

                })
                ->toJson();
        }


        return view('admin.plusmoney.report.index')
            ->with('module', null)
            ->with('page_breadcrumbs', $this->page_breadcrumbs);
    }


    public function show(Request $request,$id)
    {
        $datatable=Txns::with('user')->findOrFail($id);

        ActivityLog::add($request, 'Xem chi tiết biến động số dư plusmoney-report #'.$id);

        return view('admin.plusmoney.report.show', compact('datatable'));
        //$data = Group::findOrFail($id);
        //ActivityLog::add($request, 'Show '.$this->module.' #'.$data->id);
        //return view('admin.module.item.show', compact('datatable'));
    }

}
