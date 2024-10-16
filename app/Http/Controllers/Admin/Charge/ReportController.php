<?php

namespace App\Http\Controllers\Admin\Charge;

use App\Http\Controllers\Controller;
use App\Library\Helpers;
use App\Models\ActivityLog;
use App\Models\Charge;
use App\Models\Telecom;
use App\Models\TelecomValue;
use App\Models\TelecomValueAgency;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ReportController extends Controller
{


    public function __construct(Request $request)
    {

        //set permission to function
        $this->middleware('permission:charge-report-list');
        //$this->middleware('permission:'. $this->module.'-create', ['only' => ['create', 'store','duplicate']]);
        //$this->middleware('permission:'. $this->module.'-edit', ['only' => ['edit', 'update']]);
        //$this->middleware('permission:'. $this->module.'-delete', ['only' => ['destroy']]);


        $this->page_breadcrumbs[] = [
            'page' => route('admin.charge-report.index'),
            'title' => __('Thống kê nạp thẻ')
        ];
    }


    public function index(Request $request)
    {


        ActivityLog::add($request, 'Truy cập thống kê nạp thẻ charge-report');
        if ($request->ajax) {
            $datatable = Charge::with('user')->with('processor');
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

            if ($request->filled('find')) {
                $datatable->where(function ($query) use ($request) {
                    $query->orWhere('pin', Helpers::Encrypt($request->get('find'),config('module.charge.key_encrypt')));
                    $query->orWhere('serial', $request->get('find'));
                });
            }
            if ($request->filled('gate_id')) {
                $datatable->where('gate_id', $request->get('gate_id'));
            }

            if ($request->filled('key')) {
                $datatable->where('telecom_key', $request->get('key'));
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

                //->only([
                //    'id',
                //    'pin',
                //    'serial',
                //
                //])

                ->editColumn('ratio', function ($data) {
                    return percent_format($data->ratio) . "%";
                })
                ->editColumn('declare_amount', function ($data) {
                    return currency_format($data->declare_amount);
                })
                ->editColumn('pin', function ($data) {
                    return $data->pin;
                    $temp = Helpers::Decrypt($data->pin, config('module.charge.key_encrypt'));
                    if ($data->status == 1 && $data->status == 0 && $data->status == 3) {
                        return $temp;
                    } else {
                        return $temp = "****" . substr($temp, 4, strlen($temp));
                    }
                })
                ->addColumn('user_auth', function($row) {
                    $result = "";
                    if($row->user->fullname_display != ""){
                        $result .= $row->user->fullname_display;
                    }
                    if($row->user->email != ""){
                        $result .= ' - '.$row->user->email;
                    }
                    return $result;
                })
                ->editColumn('created_at', function ($data) {
                    return date('d/m/Y H:i:s', strtotime($data->created_at));
                })
                ->addColumn('action', function ($row) {
                    $temp = "";
                    if ($row->status != 1 && $row->status != 3) {
                        $temp = "<form action=\"".route('admin.charge-report.callback')."\" method=\"post\" >";
                        $temp .= " <input type=\"hidden\" name=\"_token\" value=\"" . csrf_token() . "\">";
                        $temp .= " <input type=\"hidden\" name=\"id\" value=\"" . $row->id . "\">";
                        $temp .= "<select name=\"gate_id\" required class=\"form-control  input-sm\" style=\"margin-bottom:10px;\">";
                        $temp .= "<option value=\"\" selected>-- Chọn cổng gạch thẻ --</option>";
                        foreach (config('module.telecom.gate_id') ?? [] as $key => $value) {

                            $temp .= "<option value=\"" . $key . "\">" . $value . "</option>";
                        }
                        $temp .= "</select>";

                        $temp .= " <select name=\"amount\" class=\"form-control  input-sm\" style=\"width: 120px;\">";

                        foreach (config('module.charge.status-callback') ?? [] as $key => $value) {
                            $temp .= "<option value=\"" . $key . "\" " . ($row->declare_amount == $key ? 'selected' : '') . ">" . $value . "</option>";
                        }

                        $temp .= "</select>";
                        $temp .= "<input type=\"text\"
                           class=\"form-control  input-sm\"
                           name=\"description\" placeholder=\"Ghi chú\"
                           style=\"margin-top:5px;width: 140px;\">&nbsp;<input
                            type=\"submit\" value=\"OK\"
                            class=\"btn btn-sm btn-danger btn-confirm\"
                            style=\"margin-top:5px;\">";

                        $temp .= "</form>";
                    } else {
                        if ($row->description != "") {
                            $temp .= "Ghi chú: " . $row->description;
                        }
                        if ($row->processor_id != "") {
                            $temp .= "<br>" . $row->processor->username;
                        }
                    }
                    return $temp;


                })

                ->with('totalSumary', function() use ($datatable) {
                   return $datatable->first([
                       DB::raw('SUM(declare_amount) as total_declare_amount'),
                       DB::raw('SUM(IF(status = 1, amount, 0)) as total_success'),
                       DB::raw('SUM(IF(status = 3, amount, 0)) as total_wrong_amount'),
                       DB::raw('SUM(real_received_amount) as total_received_amount')
                   ]);

                })
                ->toJson();
        }

        $telecom = Telecom::where('type_charge', 0)->pluck('title','key')->toArray();

        return view('admin.charge.report.index')
            ->with('module', null)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('telecom', $telecom);

    }


    public function postCallback(Request $request)
    {


        // Start transaction!
        DB::beginTransaction();

        try {
            //kiểu nạp auto
            $type_charge = 0;

            //tìm id của nạp thẻ với trạng thái đang xử lý
            $charge = Charge::where('id', $request->id)->where('status', '!=', 1)->lockForUpdate()->first();

            if (!$charge) {
                DB::rollBack();
                return redirect()->back()->withErrors('Không tìm thấy hoặc thẻ cào đã được xử lý');
            }

            //tìm user người nạp
            $userTransaction = User::where('id', $charge->user_id)->lockForUpdate()->first();
            if (!$userTransaction) {
                DB::rollBack();
                return redirect()->back()->withErrors('Không tìm thấy người dùng');

            }

            //check status  là sai
            if ($request->amount == 0) {
                //set trạng thái thẻ sai
                $charge->response_mess = "Nạp thẻ sai mã thẻ hoặc serial";
                $charge->amount = 0;
                $charge->status = 0;
                $charge->processor_id = Auth::user()->id;
                if ($request->filled('description')) {
                    $charge->description = $request->description;
                } else {
                    $charge->description = "[THẺ CỘNG LẠI]";
                }

                $charge->process_at = Carbon::now();
                $charge->save();

            } //trường hợp đúng
            else {

                //lấy chiết khấu nhà mạng
                $telecom = Telecom::where('type_charge', 0)
                    ->where('gate_id', $request->gate_id)
                    ->where('key', $charge->telecom_key)
                    ->first();


                if (!$telecom) {
                    DB::rollBack();
                    return redirect()->back()->withErrors('Mệnh giá bạn chọn không tìm thấy hoặc bị khóa bởi Admin');
                }

                //ratio
                $telecom_value = TelecomValue::where('telecom_id', $telecom->id)
                    ->where('amount', $request->amount)->first();

                if (!$telecom_value) {
                    DB::rollBack();
                    return redirect()->back()->withErrors('Mệnh giá bạn chọn không tìm thấy hoặc bị khóa bởi Admin');
                }

                // check nếu mà đúng mệnh giá
                if ($charge->declare_amount == $request->amount) {

                    //set trạng thái thẻ đúng
                    $charge->amount = $request->amount;
                    $charge->response_mess = 'Nạp thành công thẻ ' . $charge->telecom_key . ' mệnh giá ' . number_format($charge->amount) . ' đ';
                    $charge->status = 1;
                    if ($userTransaction->is_agency_charge == 1) {
                        $telecom_value_agency = TelecomValueAgency::where('telecom_id', $telecom->id)
                            ->where('username', $userTransaction->username)
                            ->where('amount', $request->amount)->first();

                        if ($telecom_value_agency) {
                            $ratio = $telecom_value_agency->ratio;
                        } else {
                            $ratio = $telecom_value->agency_ratio_true_amount;
                        }

                    } else {
                        $ratio = $telecom_value->ratio_true_amount;
                    }

                } else {
                    //set trạng thái thẻ sai mệnh giá
                    $charge->status = 3;
                    $charge->response_mess = "Nạp thẻ sai mệnh giá";
                    $charge->amount = $request->amount;

                    if ($userTransaction->is_agency_charge == 1) {

                        $ratio = $telecom_value->agency_ratio_false_amount;
                    } else {
                        $ratio = $telecom_value->ratio_false_amount;
                    }
                }


                //tính tiền thực nhận
                $real_received_amount = ($ratio * $request->amount) / 100;

                //cộng tiền cho user
                if ($real_received_amount < 0) {
                    return redirect()->back()->withErrors('Số tiền thanh toán không hợp lệ');
                }
                $userTransaction->balance = $userTransaction->balance + $real_received_amount;
                $userTransaction->balance_in=$userTransaction->balance_in+$real_received_amount;
                $userTransaction->save();

                //lưu thông tin nạp thẻ
                $charge->ratio = $ratio;
                $charge->real_received_amount = $real_received_amount;
                $charge->processor_id = Auth::user()->id;
                if ($request->filled('description')) {
                    $charge->description = $request->description;
                } else {
                    $charge->description = "[THẺ CỘNG LẠI]";
                }

                $charge->process_at = Carbon::now();
                $charge->save();


                $charge->txns()->create([
                    'user_id' => $userTransaction->id,
                    'trade_type' => 'charge',
                    'is_add' => '1', //cộng tiền
                    'amount' => $real_received_amount,
                    'last_balance' => $userTransaction->balance,
                    'description' => "Nạp thẻ ".Helpers::Decrypt($charge->pin, config('module.charge.key_encrypt')). ' - '.$charge->serial. ' - '.$charge->ratio."%",
                    'ip' => $request->getClientIp(),
                    'status' => 1
                ]);
                //gọi callback cho các user
                //                if($userTransaction->url_callback!=""){
                //
                //                    $data = array();
                //                    $data['type'] = $charge->telecom_key;
                //                    $data['pin'] = $charge->pin;
                //                    $data['serial'] = $charge->serial;
                //                    $data['declare_amount'] = $charge->declare_amount;
                //                    $data['amount'] = $charge->amount;
                //                    $data['tranid'] = $charge->id;
                //                    $data['status'] = $charge->status;
                //                    $data['message'] = $charge->response_mess;
                //                    $data['callback_sign'] = md5($userTransaction->partner_key.$charge->id.$charge->pin.$charge->serial);
                //                    $dataPost = http_build_query($data);
                //                    $url =$userTransaction->url_callback;
                //
                //                    $ch = curl_init();
                //                    curl_setopt($ch, CURLOPT_URL, $url);
                //                    curl_setopt($ch, CURLOPT_POST, 1);
                //                    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
                //                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
                //                    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
                //                    curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
                //                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
                //                    curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 10);
                //
                //                    curl_exec($ch);
                //                    curl_close($ch);
                //
                //
                //
                //                }


            }

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
        }

        // Commit the queries!
        DB::commit();
        ActivityLog::add($request, 'Xử lý callback thẻ thành công charge-report #' . $charge->id);
        return redirect()->back()->with('success', 'Xử lý giao dịch thẻ thành công #' . $charge->id);
    }


}
