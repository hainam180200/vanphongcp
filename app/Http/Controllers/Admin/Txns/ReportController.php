<?php

namespace App\Http\Controllers\Admin\Txns;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Txns;
use Carbon\Carbon;
use Illuminate\Http\Request;



class ReportController extends Controller
{


    public function __construct(Request $request)
    {

        //set permission to function
        $this->middleware('permission:txns-report-list');
        //$this->middleware('permission:'. $this->module.'-create', ['only' => ['create', 'store','duplicate']]);
        //$this->middleware('permission:'. $this->module.'-edit', ['only' => ['edit', 'update']]);
        //$this->middleware('permission:'. $this->module.'-delete', ['only' => ['destroy']]);


        $this->page_breadcrumbs[] = [
            'page' => route('admin.txns-report.index'),
            'title' => __('Biến động số dư')
        ];
    }


    public function index(Request $request)
    {


        ActivityLog::add($request, 'Truy cập biến động số dư txns-report');
        if ($request->ajax) {
            $datatable = Txns::with('user');

            if ($request->filled('id')) {
                $datatable->where('id', $request->get('id'));
            }

            if ($request->filled('username')) {
                $datatable->whereHas('user', function ($query) use ($request) {
                    $query->where(function ($qChild) use ($request){
                        $qChild->orWhere('username', $request->get('username'));
                        $qChild->orWhere('fullname_display', 'LIKE', '%' . $request->get('username') . '%');
                    });
                });
            }
            if ($request->filled('email')) {
                $datatable->whereHas('user', function ($query) use ($request) {
                    $query->where('email', $request->get('email'));
                });
            }
            if ($request->filled('trade_type')) {
                $datatable->where('trade_type', $request->get('trade_type'));
            }
            if ($request->filled('is_add')) {
                $datatable->where('is_add', $request->get('is_add'));
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

                //->only([
                //    'id',
                //    'pin',
                //    'serial',
                //
                //])

                ->editColumn('created_at', function ($data) {
                    return date('d/m/Y H:i:s', strtotime($data->created_at));
                })
                ->addColumn('user_name', function ($row) {
                    $temp = '';
                    if(isset($row->user->fullname_display)){
                        $temp .= $row->user->fullname_display;
                    }
                    if(isset($row->user->email)){
                        $temp .= ' - ';
                        $temp .= $row->user->email;
                    }
                    return $temp;
                })
                ->addColumn('action', function ($row) {
                    $temp = "<button type=\"button\" class=\"btn btn-outline-secondary load-modal\" rel=\"".route('admin.txns-report.show',$row->id)."\">".__('Chi tiết')."</button>";
                    return $temp;


                })
                ->toJson();
        }


        return view('admin.txns.report.index')
            ->with('module', null)
            ->with('page_breadcrumbs', $this->page_breadcrumbs);
    }


    public function show(Request $request,$id)
    {
        $datatable=Txns::with('user')->findOrFail($id);

        ActivityLog::add($request, 'Xem chi tiết biến động số dư txns-report #'.$id);

        return view('admin.txns.report.show', compact('datatable'));
        //$data = Group::findOrFail($id);
        //ActivityLog::add($request, 'Show '.$this->module.' #'.$data->id);
        //return view('admin.module.item.show', compact('datatable'));
    }

}
