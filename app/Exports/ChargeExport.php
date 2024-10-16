<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Charge;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ChargeExport implements FromCollection, WithHeadings
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
        $data = Charge::with('user')
                ->with('processor')
                ->whereMonth('created_at', '=', $this->month)
                ->whereYear('created_at', '=',  $this->year)
                ->get();

        foreach($data as $item){
            $account = '';
            if($item->user->fullname_display){
                $account .= $item->user->fullname_display;
            }
            if($item->user->email){
                $account .= ' - '.$item->user->email;
            }

            $status = null;
            if($item->status == 0){
                $status = "Thẻ sai";
            }
            elseif($item->status == 1){
                $status = "Thẻ đúng";
            }
            elseif($item->status == 2){
                $status = "Chờ xử lý";
            }
            else if($item->status == 3){
                $status = "Sai mệnh giá";
            } 
            else if($item->status == 999){
                $status = "Lỗi nạp thẻ";
            } 
            else if($item->status == -999){
                $status = "Lỗi nạp thẻ";
            } 
            else if($item->status == -1){
                $status = "Phát sinh lỗi nạp thẻ";
            } 
            $data_excel[] = [
                'id' => $item->id,
                'created_at' => $item->created_at->format('H:i d-m-Y'),
                'account' => $account,
                'declare_amount' => $item->declare_amount,
                'ratio' => $item->ratio,
                'real_received_amount' => $item->real_received_amount,
                'status' => $status,
            ];
        }
        if(!empty($data_excel)){
            return collect($data_excel);
        }
        return collect(null);
    }
    public function headings() :array {
    	return ["ID","Tài khoản","Mệnh giá","Chiết khấu","Thực nhận","Trạng thái"];
    }
}
