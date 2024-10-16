<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\PlusMoney;
use App\Models\SessionTracker;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserQTVController extends Controller
{

    protected $page_breadcrumbs;
    //Quản trị viên (Nội bộ)
    protected $account_type=1;

    public function __construct()
    {
        //set permission to function
        $this->middleware('permission:user-qtv-list');
        $this->middleware('permission:user-qtv-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-qtv-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-qtv-delete', ['only' => ['destroy']]);
        $this->middleware('permission:plus-minus-money', ['only' => ['getMoney','postMoney','getUserToMoney']]);


        $this->page_breadcrumbs[] = [
            'page' => route('admin.user-qtv.index'),
            'title' => __("Thành viên quản trị")
        ];
    }

    public function index(Request $request)
    {

        ActivityLog::add($request, 'Truy cập danh sách user-qtv');
        if($request->ajax) {
            $datatable= User::with(['roles'=>function($query){
                $query->select(['id','title','name']);
            }])
                ->where("account_type",$this->account_type)
                ->orderByRaw('FIELD(`status`,1,2,3,4,0,-1,99)');;

            if ($request->filled('id'))  {
                $datatable->where(function($q) use($request){
                    $q->orWhere('id', 'LIKE', '%' . $request->get('id') . '%');
                });
            }


             if ($request->filled('incorrect_txns')) {
                 if($request->incorrect_txns==1){
                     $datatable->whereRaw('(balance_in - balance_out - balance) != 0');
                 }
                 else{
                     $datatable->havingRaw('(balance_in - balance_out - balance) = 0');
                 }

             }

            if ($request->filled('username')) {
                $datatable->where('username', 'LIKE', '%' . $request->get('username') . '%');
            }
            if ($request->filled('email')) {
                $datatable->where('email', 'LIKE', '%' . $request->get('email') . '%');
            }

            if ($request->filled('roles_id')) {
                //nếu chọn duy nhất option -1 (Không có)
                if(is_array($request->roles_id) &&  in_array('-1',$request->roles_id) && count($request->roles_id)==1){
                    $datatable->doesntHave('roles');
                }

                //nếu có chọn option -1 (Không có) kèm các role khác
                elseif(is_array($request->roles_id) &&  in_array('-1',$request->roles_id)){
                    $datatable->doesntHave('roles');
                    $datatable->orWhereHas('roles', function ($query) use ($request) {
                        $query->whereIn('id', $request->get('roles_id'));
                    });
                }
                //nếu có chọn option có roles và ko có  option -1 (Không có)
                else{
                    $datatable->WhereHas('roles', function ($query) use ($request) {
                        $query->whereIn('id', $request->get('roles_id'));
                    });
                }
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

            return \datatables()->eloquent($datatable)->whitelist(['id'])
                ->only([
                    'id',
                    'username',
                    'email',
                    'roles',
                    'balance',
                    'balance_in',
                    'balance_out',
                    'phone',
                    'image',
                    'status',
                    'created_at',
                    'action',

                ])

                ->editColumn('created_at', function($row) {
                    return date('d/m/Y H:i:s', strtotime($row->created_at));
                })
                ->addColumn('action', function($row) {


                    $temp= "<a href=\"" .route('admin.get_money',['mode'=>1,'field'=>'email','value'=>$row->email])."\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary\"  title=\"Cộng tiền\"><i class=\"la la-plus\"></i></a>";
                    $temp.= "<a href=\"" .route('admin.get_money',['mode'=>0,'field'=>'email','value'=>$row->email])."\"  class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary'  title=\"Trừ tiền\"><i class=\"la la-minus\"></i></a>";
                    if(auth()->user()->can('user-qtv-edit')){
                        $temp.= "<a href=\"".route('admin.user-qtv.edit',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary \" title=\"Sửa\"><i class=\"la la-edit\"></i></a>";

                    };


                    if ($row->status == 0) {
                        if(auth()->user()->can('user-qtv-unlock')){
                            $temp .= "<a  rel=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger unlock_toggle' data-toggle=\"modal\" data-target=\"#unlockModal\" class=\"unlock_toggle\" title=\"Mở khóa\"><i class=\"la la-unlock-alt\"></i></a>";
                        };
                    } else {
                        if(auth()->user()->can('user-qtv-unlock')){
                            $temp .= "<a  rel=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger lock_toggle' data-toggle=\"modal\" data-target=\"#lockModal\" class=\"lock_toggle\" title=\"Khóa\"><i class=\"la la-lock\"></i></a>";

                        };
                    }
                    if(config('module.user-qtv.need_set_permission')){
                        $temp.= "<a href=\"".route('admin.user-qtv.set_permission',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger \" title=\"Phân quyền\"><i class=\"la la-sitemap\"></i></a>";
                    }

                    if(auth()->user()->can('user-qtv-delete')){
                        $temp.= "<a  rel=\"".$row->id."\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger delete_toggle' data-toggle=\"modal\" data-target=\"#deleteModal\" class=\"delete_toggle\" title=\"Xóa\"><i class=\"la la-trash\"></i></a>";
                    };

                    return $temp;
                })
                ->whitelist(['id'])
                ->toJson();
        }

        $roles=Role::orderBy('order','asc')->get();
        return view('admin.user-qtv.index')->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('roles',$roles);
    }

    public function create(Request $request)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Thêm mới")
        ];

        $roles=Role::orderBy('order','asc')->get();



        ActivityLog::add($request, 'Vào form create user-qtv');

        return view('admin.user-qtv.create_edit')
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('roles', $roles);
    }



    public function store(Request $request)
    {

        $roleAdmin = Role::where('name','admin')->first();
        if(!$roleAdmin){
            return redirect()->back()->withErrors(__('Hệ thống chưa khởi tạo vai trò Admin.Liên hệ admin để xử lý'))->withInput();
        }

        if(!auth()->user()->hasRole('admin') && in_array($roleAdmin->id,$request->role_ids??[])){
            return redirect()->back()->withErrors(__('Bạn không có quyền tạo hoặc chỉnh sửa tài khoản Admin'))->withInput();
        }


        $this->validate($request, [
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            //'phone' => 'required|unique:users',
            'username' => 'required|min:3|max:16|unique:users|regex:/^([A-Za-z0-9])+$/i',
            'password' => 'required|min:6|max:32',
            'password2' => 'required|min:6|max:32',
            //'password_confirmation' => 'required|same:password',
        ], [
            'username.required' => 'Vui lòng nhập tên tài khoản',
            'username.min' => 'Tên tài khoản ít nhất 3 ký tự.',
            'username.unique' => 'Tên tài khoản đã được sử dụng.',
            'username.regex' => 'Tên tài khoản không ký tự đặc biệt',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'username.max' => 'Tên tài khoản không quá 16 ký tự.',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu không vượt quá 32 ký tự.',
            'password_confirmation.same' => 'Mật khẩu xác nhận không đúng.',

            'password2.required' => 'Vui lòng nhập mật khẩu',
            'password2.min' => 'Mật khẩu 2 phải ít nhất 6 ký tự.',
            'password2.max' => 'Mật khẩu 2 không vượt quá 32 ký tự.',
            //'password2_confirmation.same' => 'Mật khẩu xác nhận không đúng.',

            'email.required' => 'Vui lòng nhập trường này',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            //'phone.unique'	=> 'Số điện thoại đã được sử dụng.',
            //'created_at.required' => 'Vui lòng nhập ngày tạo',
            //'created_at.date_format' => 'Vui lòng nhập đúng định dạng ngày tháng (dd/mm/YYYY H:i:s)',
        ]);

        $input = $request->all();
        if ($request->filled('password')) {
            $input['password'] = \Hash::make($request->password);

        }
        if ($request->filled('password2')) {
            $input['password2'] = \Hash::make($request->password2);

        }
        $input['account_type'] = $this->account_type;
        $input['created_by'] = auth()->user()->id;
        $data = User::create($input);

        //update roles of user
        $data->syncRoles(isset($request->role_ids) ? $request->role_ids : []);


        ActivityLog::add($request, 'Tạo mới thành công user-qtv #'.$data->id);

        if ($request->filled('submit-close')) {
            return redirect()->route('admin.user-qtv.index')->with('success', __('Thêm mới thành công !'));
        } else {
            return redirect()->back()->with('success', __('Thêm mới thành công !'));
        }
    }
    public function show(Request $request,$id)
    {
        //$data = User::findOrFail($id);
        //ActivityLog::add($request, 'Show user-qtv #'.$data->id);
        //return view('admin.user-qtv.show', compact('datatable'));
    }
    public function edit(Request $request,$id)
    {

        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Cập nhật")
        ];
        $data = User::with('roles')->where("account_type",$this->account_type)->findOrFail($id);
        if(!auth()->user()->hasRole('admin') && $data->hasRole('admin')){
            return redirect()->back()->withErrors(__('Bạn không có quyền tạo hoặc chỉnh sửa tài khoản Admin'))->withInput();
        }
        $roles=Role::orderBy('order','asc')->get();


        ActivityLog::add($request, 'Vào form edit user-qtv #'.$data->id);
        return view('admin.user-qtv.create_edit')
            ->with('data', $data)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('roles', $roles);
    }

    public function update(Request $request,$id)
    {
        $data = User::where("account_type",$this->account_type)->findOrFail($id);


        //kiểm tra có  quyền chỉnh sửa tài khoản admin
        if(!auth()->user()->hasRole('admin') && $data->hasRole('admin')){
            return redirect()->back()->withErrors(__('Bạn không có quyền tạo hoặc chỉnh sửa tài khoản Admin'))->withInput();
        }

        $this->validate($request,[
            'email'=>'required|unique:users,email,'.$id
        ],[
            'email.required' => 'Vui lòng nhập trường này',
            'email.email'	=> 'Địa chỉ email không đúng định dạng.',
            'email.unique'	=> 'Địa chỉ email đã được sử dụng.',
        ]);

        $input = $request->except('username', 'password','password2', 'account_type', 'balance');

        if($request->filled('password'))
        {
            $input['password'] = \Hash::make($request->password);

        }
        if($request->filled('password2'))
        {
            $input['password2'] = \Hash::make($request->password2);
        }
        $data = User::findOrFail($id);

        $data->update($input);
        //update roles of user
        $data->syncRoles(isset($request->role_ids) ? $request->role_ids : []);



        ActivityLog::add($request, 'Cập nhật thành công user-qtv #'.$data->id);
        if($request->filled('submit-close')){
            return redirect()->route('admin.user-qtv.index')->with('success',__('Cập nhật thành công !'));
        }
        else {
            return redirect()->back()->with('success',__('Cập nhật thành công !'));
        }
    }
    public function destroy(Request $request)
    {



        $input=explode(',',$request->id);

        $currentUserRole=auth()->user()->hasRole('admin');

         $data=User::with(['roles'=>function($query){
         }])->whereIn('id',$input)
             ->where("account_type",$this->account_type)
            ->get();

         foreach ($data as $aUser){
             $isAdmin=false;
             foreach ($aUser->roles??[] as $role){

                if($role->name=='admin'){
                    $isAdmin=true;
                    break;
                }
             }
             //nếu không phải admin thì không cho cập nhật,xóa user có quyền admin
             if(!$currentUserRole  &&  $isAdmin==true){
             }
             else{
                 $aUser->update([
                     'status'=>0
                 ]);
                 //nếu cho xóa user vĩnh viễn
                 //$aUser->delete();
             }
         }
        ActivityLog::add($request, 'Xóa thành công user-qtv #'.json_encode($input));

        return redirect()->back()->with('success',__('Xóa thành công !'));
    }
    public function update_field(Request $request)
    {

        $input=explode(',',$request->id);
        $field=$request->field;
        $value=$request->value;
        $whitelist=['status'];

        if(!in_array($field,$whitelist)){
            return response()->json([
                'success'=>false,
                'message'=>__('Trường cập nhật không được chấp thuận'),
                'redirect'=>''
            ]);
        }


        $data=User::whereIn('id',$input)->where("account_type",$this->account_type)->update([
            $field=>$value
        ]);

        ActivityLog::add($request, 'Cập nhật field thành công user-qtv '.json_encode($whitelist).' #'.json_encode($input));

        return response()->json([
            'success'=>true,
            'message'=>__('Cập nhật thành công !'),
            'redirect'=>''
        ]);

    }
    public function lock(Request $request)
    {

        $input = $request->id;
        $data = User::where("account_type",$this->account_type)->findOrFail($input);
        $data->update([
            'status' => 0,
            'locker_by' => auth()->user()->username
        ]);
        SessionTracker::endSessionByUser($data->id);

        ActivityLog::add($request, 'Khóa thành công user-qtv #'.$data->id);
        return redirect()->back()->with('success', trans('Khóa tài khoản thành công'));
    }
    public function unlock(Request $request)
    {

        $input = $request->id;
        $data = User::where("account_type",$this->account_type)->findOrFail($input);
        $data->update([
            'status' => 1,
        ]);

        ActivityLog::add($request, 'Mở khóa thành công user-qtv #'.$data->id);
        return redirect()->back()->with('success', 'Mở khóa tài khoản thành công');
    }
    public function view_profile(Request $request){


        $username=$request->username;
        $data=User::where('username',$username)->where("account_type",$this->account_type)->firstOrFail();

        //if(Auth::guard()->user()->username !='admin' && $user->username=='admin' ){
        //    return redirect()->back()->withErrors("Bạn không có quyền set tài khoản Admin")->withInput();
        //}

        ActivityLog::add($request, 'Xem profile user-qtv #'.$data->id);
        return view('admin.user-qtv.view-profile')->with('user',$data);
    }
    public function getMoney(Request $request){

        $this->page_breadcrumbs=[[
            'page' => '#',
            'title' => __("Cộng trừ tiền cho thành viên")
        ]];

        ActivityLog::add($request, 'Vào form cộng tiền user-qtv');
        return view('admin.user-qtv.money')->with('page_breadcrumbs', $this->page_breadcrumbs);
    }
    public function postMoney(Request $request){



        $this->validate($request, [
            'amount' => 'required',
            'password2' => 'required',
        ], [
            'amount.required' => "Vui lòng nhập số tiền",
            'password2.required' => "Vui lòng nhập mật khẩu cấp 2",

        ]);


        //check password2
        if(!\Hash::check($request->password2,\Auth::user()->password2)){
            session()->put('fail_password2',  session()->get('fail_password2')+1);
            DB::rollBack();
            return redirect()->back()->withErrors(__('Mật khẩu cấp 2 không đúng'))->withInput();;
        }
        else{
            session()->put('fail_password2', 0);
        }



        if($request->mode==1){
            $this->validate($request, [
                'source_type' => 'required|numeric',
                'field' => 'required|in:id,username,email',
            ], [
                'source_type.required' => "Vui lòng chọn nguồn tiền cộng",
                'source_type.numeric' => "Vui lòng chọn nguồn tiền cộng",
                'field.required' => 'Trường thông tin tìm kiếm không phù hợp',
                'field.in' => 'Trường thông tin tìm kiếm không phù hợp',
            ]);

        }

        if($request->source_type==1 && $request->source_bank==""){
            return redirect()->back()->withErrors("Vui lòng chọn ngân hàng/ví" )->withInput();
        }
        if($request->source_type==2 && $request->source_bank==""){
            return redirect()->back()->withErrors("Vui lòng chọn ngân hàng/ví" )->withInput();
        }
        if($request->source_type==4 && $request->source_bank==""){
            return redirect()->back()->withErrors("Vui lòng chọn ngân hàng/ví" )->withInput();
        }

        // Start transaction!

        DB::beginTransaction();



        try {


            $delayTime=30;
            //tìm user cộng trừ tiền
            $userTransaction = User::where($request->field, $request->username)->lockForUpdate()->first();




            if (!$userTransaction) {

                DB::rollBack();
                return redirect()->back()->withErrors('Không tìm thấy người dùng');
            }

            if(abs(strtotime(Carbon::now()) - strtotime($userTransaction->last_add_balance))<$delayTime){

                DB::rollBack();
                return redirect()->back()
                    ->withErrors('Vui lòng thực hiện thao tác tiếp theo sau '.($delayTime-abs(strtotime(Carbon::now()) -strtotime($userTransaction->last_add_balance)).'s' ))
                    ->withInput();
            }


            $amount=(int)str_replace(array(' ', ',','.'), '', $request->amount);

            if($amount<=0){
                DB::rollBack();
                return redirect()->back()->withErrors('Số tiền thực hiện phải lớn hơn 0')->withInput();
            }
            //nếu cộng tiền

            if($request->mode==1)
            {

                $userTransaction->balance=$userTransaction->balance+$amount;
                $userTransaction->balance_in=$userTransaction->balance_in+$amount;
                $userTransaction->last_add_balance=Carbon::now();
                $userTransaction->save();

                PlusMoney::create([
                    'user_id'=>$userTransaction->id,
                    'is_add'=>'1',//Cộng tiền
                    'amount'=>$amount,
                    'source_type'=>$request->source_type,
                    'source_bank'=>$request->source_bank,
                    'processor_id'=>auth()->user()->id,
                    'description'=>$request->description,
                    'status'=>1,

                ])->txns()->create([
                    'user_id'=>$userTransaction->id,
                    'trade_type'=>'plus_money', //cộng tiền
                    'is_add'=>'1',//Cộng tiền
                    'amount'=>$amount,
                    'last_balance'=>$userTransaction->balance,
                    'description'=>'Cộng tiền tài khoản '.' [ +'.currency_format($amount).' ]',
                    'ip'=>$request->getClientIp(),
                    'status'=>1
                ]);
            }
            //nếu trừ tiền
            elseif($request->mode==0)
            {


                //nếu số tiền nhỏ hơn balance sẽ không cho trừ
                if($userTransaction->balance<$amount){
                    DB::rollBack();
                    return redirect()->back()->withErrors('Số dư của tài khoản không đủ để trừ.Vui lòng thử lại')->withInput();
                }

                if(abs(strtotime(Carbon::now()) - strtotime($userTransaction->last_minus_balance))<$delayTime){
                    DB::rollBack();
                    return redirect()->back()
                        ->withErrors('Vui lòng thực hiện thao tác tiếp theo sau '.($delayTime-abs(strtotime(Carbon::now()) -strtotime($userTransaction->last_minus_balance)).'s' ))
                        ->withInput();
                }

                $userTransaction->balance=$userTransaction->balance-$amount;
                $userTransaction->balance_out=$userTransaction->balance_out+$amount;
                $userTransaction->last_minus_balance=Carbon::now();
                $userTransaction->save();


                PlusMoney::create([
                    'user_id'=>$userTransaction->id,
                    'is_add'=>'0',//Trừ tiền
                    'amount'=>$amount,
                    'source_type'=>$request->source_type,
                    'source_bank'=>$request->source_bank,
                    'processor_id'=>auth()->user()->id,
                    'description'=>$request->description,
                    'status'=>1,

                ])->txns()->create([
                    'user_id'=>$userTransaction->id,
                    'trade_type'=>'minus_money', //trừ tiền
                    'is_add'=>'0',//Trừ tiền
                    'amount'=>$amount,
                    'last_balance'=>$userTransaction->balance,
                    'description'=>'Trừ tiền tài khoản '.' [ -'.currency_format($amount).' ]',
                    'ip'=>$request->getClientIp(),
                    'status'=>1
                ]);
            }
            else{
                DB::rollBack();
                return redirect()->back()->withErrors('Không có chức năng yêu cầu.Vui lòng thử lại')->withInput();
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            Log::error($e);
            return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
        }
        // Commit the queries!
        DB::commit();
        if($request->mode==1){

            ActivityLog::add($request, 'Cộng tiền tài khoản '.$userTransaction->username.' [ +'.currency_format($amount).' ]'.' thành công');

            return redirect()->route('admin.get_money')
                ->with('success','Cộng tiền tài khoản '.$userTransaction->username.' [ +'.currency_format($amount).' ]'.' thành công')
                ->withInput($request->only('field','username'));
        }
        else{

            ActivityLog::add($request, 'Trừ tiền tài khoản '.$userTransaction->username.' [ -'.currency_format($amount).' ]'.' thành công');


            return redirect()->route('admin.get_money')
                ->with('success','Trừ tiền tài khoản '.$userTransaction->username.' [ -'.currency_format($amount).' ]'.' thành công')
                ->withInput($request->only('field','username'));
        }
    }
    public function getUserToMoney(Request $request)
    {


        $this->validate($request, [
            'username' => 'required',
            'field' => 'required|in:id,username,email',

        ], [
            'username.required' => 'Vui lòng nhập tên tài khoản',
            'field.required' => 'Trường thông tin tìm kiếm không phù hợp',
            'field.in' => 'Trường thông tin tìm kiếm không phù hợp',

        ]);

        $user = User::where($request->field, $request->username)->firstOrFail();

        $data=PlusMoney::with('txns','processor','user')
            ->orderBy('created_at', 'DESC')
            ->where('user_id', $user->id)
            ->limit(10)->get();

        ActivityLog::add($request, 'Lấy lịch sử cộng tiền user-qtv'.$user->id);
        return view('admin.user-qtv.show-txns')
            ->with('data', $data)
            ->with('user', $user);

    }
    public function set_permission(Request $request,$id){

        if(!config('module.user-qtv.need_set_permission')){
            return redirect()->back()->withErrors(__('Chức năng chưa được kích hoạt'));
        }

        $this->page_breadcrumbs[] = [
            'page' => '#',
            'title' => __("Phân quyền truy cập")
        ];


        $data = User::where('account_type',1)->findOrFail($id);

        //permisson info
        $permissions = Permission::orderBy('order', 'asc')->get();
        $permissionsSelected = $data->permissions()->pluck('id')->toArray();
        $array = array();
        foreach ($permissions as $permission) {
            if($permission->parent_id==0 || $permission->parent_id.""==""){
                $permission->parent_id="#";
            }
            if($data->hasPermissionTo($permission)){
                $hasPermission=true;
            }
            else{
                $hasPermission=false;
            }
            $array[]=[
                "id"=>$permission->id."",
                "parent"=>$permission->parent_id."",
                "text"=>htmlentities($permission->title)."",
                "state"=>[
                    'opened'=>true
                ],
            ];

        }
        $permissionsJson=json_encode($array);


        ActivityLog::add($request, 'Vào form cập nhật permission user-qtv #'.$data->id);

        return view('admin.user-qtv.set_permission')
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('data', $data)
            ->with('permissionsJson', $permissionsJson)
            ->with('permissionsSelected', $permissionsSelected);
    }
    public function post_set_permission(Request $request,$id){

        if(!config('module.user-qtv.need_set_permission')){
            return redirect()->back()->withErrors(__('Chức năng chưa được kích hoạt'));
        }

        $data = User::where('account_type',1)->findOrFail($id);
        $data->permissions()->sync(isset($request->permission_ids) ? explode(",",$request->permission_ids) : []);

        ActivityLog::add($request, 'Cập nhật permission thành công user-qtv #'.$data->id);
        return redirect()->back()->with('success',__('Phân quyền truy cập thành công'));

    }

}
