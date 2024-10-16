<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StoreCardExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($year,$month) {
        $this->year = $year;
        $this->month = $month;
    }
    public function collection()
    {
        $data = Order::with('author')
                    ->where('module','store_card')
                    ->whereMonth('created_at', '=', $this->month)
                    ->whereYear('created_at', '=',  $this->year)
                    ->get();
        foreach($data as $item){
            $account = '';
            if($item->author->fullname_display){
                $account .= $item->author->fullname_display;
            }
            if($item->author->email){
                $account .= ' - '.$item->author->email;
            }
            $status = null;
            if($item->status == 0){
                $status = "Thất bại";
            }
            elseif($item->status == 1){
                $status = "Thành công";
            }
            elseif($item->status == 2){
                $status = "Đang chờ";
            }
            elseif($item->status == 3){
                $status = "Đã hủy";
            }
            elseif($item->status == 4){
                $status = "Lỗi gọi nhà cung cấp";
            }
            elseif($item->status == 5){
                $status = "Lỗi hệ thống";
            }
            $data_excel[] = [
                'id' => $item->id,
                'created_at' => $item->created_at->format('H:i d-m-Y'),
                'account' => $account,
                'telecom' => json_decode($item->params)->telecom,
                'amount' => json_decode($item->params)->amount,
                'quantity' => json_decode($item->params)->quantity,
                'ratio' => $item->ratio. ' %',
                'real_received_price' => number_format($item->real_received_price). ' VNĐ',
                'gate_id' => config('module.store-telecom.gate_id.'.$item->gate_id),
                'status' => $status,
            ];
        }
        if(!empty($data_excel)){
            return collect($data_excel);
        }
        return collect(null);
    }
    public function headings() :array {
    	return ["ID",'Thời gian',"Tài khoản","Nhà mạng","Mệnh giá","Số lượng","Chiết khấu","Tổng tiền","Nhà cung cấp","Trạng thái"];
    }
}
