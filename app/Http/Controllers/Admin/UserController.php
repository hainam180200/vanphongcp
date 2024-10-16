<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Otp;
use App\Models\PlusMoney;
use App\Models\SessionTracker;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Library\Files;
use Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{

    protected $page_breadcrumbs;
    //Thành viên
    protected $account_type=2;

    public function __construct()
    {
        //set permission to function
        $this->middleware('permission:user-list');
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('permission:plus-minus-money', ['only' => ['getMoney','postMoney','getUserToMoney']]);
        $this->middleware('permission:user-buff', ['only' => ['getBuffIdol','postBuffIdol']]);


        $this->page_breadcrumbs[] = [
            'page' => route('admin.user.index'),
            'title' => __("Thành viên")
        ];
    }

    public function index(Request $request)
    {

        ActivityLog::add($request, 'Truy cập danh sách user');
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

            if ($request->filled('fullname_display')) {
                $datatable->where('fullname_display', 'LIKE', '%' . $request->get('fullname_display') . '%');
            }
            if ($request->filled('username')) {
                $datatable->where('username', 'LIKE', '%' . $request->get('username') . '%');
            }
            if ($request->filled('email')) {
                $datatable->where('email', 'LIKE', '%' . $request->get('email') . '%');
            }



            if ($request->filled('status')) {
                $datatable->where('status',$request->get('status') );
            }
            if ($request->filled('is_idol')) {
                $datatable->where('is_idol',$request->get('is_idol') );
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
                    'fullname_display',
                    'email',
                    'is_idol',
                    'balance',
                    'balance_in',
                    'balance_out',
                    'phone',
                    'image',
                    'cover',
                    'status',
                    'created_at',
                    'action',

                ])

                ->editColumn('created_at', function($row) {
                    return date('d/m/Y H:i:s', strtotime($row->created_at));
                })
                ->editColumn('image', function($row) {
                    if(gettype(json_decode($row->image)) == 'object'){
                       return Files::media(get_object_vars(json_decode($row->image))['anh_crop']);
                    }
                    else{
                        return null;
                    }
                })
                ->addColumn('cover', function($row) {
                    if(gettype(json_decode($row->cover)) == 'object' && isset(get_object_vars(json_decode($row->cover))['image_Coverx342x220'])){
                        return Files::media(get_object_vars(json_decode($row->cover))['image_Coverx342x220']);
                    }
                    else{
                        return null;
                    }
                })
                ->addColumn('action', function($row) {
                    $temp= "<a href=\"" .route('admin.get_money',['mode'=>1,'field'=>'email','value'=>$row->email])."\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary\"  title=\"Cộng tiền\"><i class=\"la la-plus\"></i></a>";
                    $temp.= "<a href=\"" .route('admin.get_money',['mode'=>0,'field'=>'email','value'=>$row->email])."\"  class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary'  title=\"Trừ tiền\"><i class=\"la la-minus\"></i></a>";
                    if(auth()->user()->can('user-edit')){
                        $temp.= "<a href=\"".route('admin.user.edit',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary \" title=\"Sửa\"><i class=\"la la-edit\"></i></a>";

                    };
                    if(auth()->user()->can('user-buff')){
                        $temp.= "<a href=\"".route('admin.user.buff',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary \" title=\"Cài đặt profile\"><i class=\"flaticon-list \"></i></a>";

                    };
                    if ($row->status == 0) {
                        if(auth()->user()->can('user-unlock')){
                            $temp .= "<a  rel=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger unlock_toggle' data-toggle=\"modal\" data-target=\"#unlockModal\" class=\"unlock_toggle\" title=\"Mở khóa\"><i class=\"la la-unlock-alt\"></i></a>";
                        };
                    } else {
                        if(auth()->user()->can('user-unlock')){
                            $temp .= "<a  rel=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger lock_toggle' data-toggle=\"modal\" data-target=\"#lockModal\" class=\"lock_toggle\" title=\"Khóa\"><i class=\"la la-lock\"></i></a>";

                        };
                    }

                    if(auth()->user()->can('user-unlock')){
                        $temp.= "<a href=\"".route('admin.user.show',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger \" title=\"Xem chi tiết\"><i class=\"la la-eye\"></i></a>";
                    }

                    if(config('module.user.need_set_permission')){
                        $temp.= "<a href=\"".route('admin.user.set_permission',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger \" title=\"Phân quyền\"><i class=\"la la-sitemap\"></i></a>";
                    }

                    if(auth()->user()->can('user-delete')){
                        $temp.= "<a  rel=\"".$row->id."\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger delete_toggle' data-toggle=\"modal\" data-target=\"#deleteModal\" class=\"delete_toggle\" title=\"Xóa\"><i class=\"la la-trash\"></i></a>";
                    };

                    return $temp;
                })
                ->toJson();
        }

        $roles=Role::orderBy('order','asc')->get();
        return view('admin.user.index')->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('roles',$roles);
    }

    public function create(Request $request)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Thêm mới")
        ];

        $roles=Role::orderBy('order','asc')->get();



        ActivityLog::add($request, 'Vào form create user');

        return view('admin.user.create_edit')
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('roles', $roles);
    }



    public function store(Request $request)
    {

        $roleAdmin = Role::where('name','admin')->first();
        if(!$roleAdmin){
            return redirect()->back()->withErrors(__('Hệ thống chưa khởi tạo vai trò Admin.Liên hệ admin để xử lý'))->withInput();
        }

        if(!auth()->user()->hasRole('admin') && in_array($roleAdmin->id,$request->role_ids)){
            return redirect()->back()->withErrors(__('Bạn không có quyền tạo hoặc chỉnh sửa tài khoản Admin'))->withInput();
        }


        $this->validate($request, [
            'username' => 'required|unique:users,username',
            'agency_code' => 'required|unique:users,agency_code',
            'email' => 'required|unique:users,email',
            'username' => 'required|min:2|max:16|unique:users|regex:/^([A-Za-z0-9])+$/i',
            'password' => 'required|min:6|max:32',
        ], [
            'username.required' => 'Vui lòng nhập tên tài khoản',
            'username.min' => 'Tên tài khoản ít nhất 3 ký tự.',
            'username.unique' => 'Tên tài khoản đã được sử dụng.',
            'agency_code.required' => 'Vui lòng nhập key very',
            'agency_code.min' => 'key very ít nhất 2 ký tự.',
            'agency_code.unique' => 'key very đã được sử dụng.',
            'username.regex' => 'Tên tài khoản không ký tự đặc biệt',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'username.max' => 'Tên tài khoản không quá 16 ký tự.',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu không vượt quá 32 ký tự.',

            'email.required' => 'Vui lòng nhập trường này',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
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


        ActivityLog::add($request, 'Tạo mới thành công user #'.$data->id);

        if ($request->filled('submit-close')) {
            return redirect()->route('admin.user.index')->with('success', __('Thêm mới thành công !'));
        } else {
            return redirect()->back()->with('success', __('Thêm mới thành công !'));
        }
    }
    public function show(Request $request,$id)
    {
        $data = User::findOrFail($id);
        ActivityLog::add($request, 'Show user #'.$data->id);
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Xem chi tiết")
        ];
        return view('admin.user.show')
            ->with('data', $data)
            ->with('page_breadcrumbs', $this->page_breadcrumbs);
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

        $otp = Otp::where('email','LIKE', '%' . $data->email . '%')->first();
        ActivityLog::add($request, 'Vào form edit user #'.$data->id);
        return view('admin.user.create_edit')
            ->with('data', $data)
            ->with('otp', $otp)
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

        // $this->validate($request,[
        //     'email'=>'required|unique:users,email,'.$id
        // ],[
        //     'email.required' => 'Vui lòng nhập trường này',
        //     'email.email'	=> 'Địa chỉ email không đúng định dạng.',
        //     'email.unique'	=> 'Địa chỉ email đã được sử dụng.',
        // ]);

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



        ActivityLog::add($request, 'Cập nhật thành công user #'.$data->id);
        if($request->filled('submit-close')){
            return redirect()->route('admin.user.index')->with('success',__('Cập nhật thành công !'));
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
        ActivityLog::add($request, 'Xóa thành công user #'.json_encode($input));

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

        ActivityLog::add($request, 'Cập nhật field thành công user '.json_encode($whitelist).' #'.json_encode($input));

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

        ActivityLog::add($request, 'Khóa thành công user #'.$data->id);
        return redirect()->back()->with('success', trans('Khóa tài khoản thành công'));
    }
    public function unlock(Request $request)
    {

        $input = $request->id;
        $data = User::where("account_type",$this->account_type)->findOrFail($input);
        $data->update([
            'status' => 1,
        ]);

        ActivityLog::add($request, 'Mở khóa thành công user #'.$data->id);
        return redirect()->back()->with('success', 'Mở khóa tài khoản thành công');
    }
    public function view_profile(Request $request){


        $username=$request->username;
        $data=User::where('username',$username)->where("account_type",$this->account_type)->firstOrFail();

        //if(Auth::guard()->user()->username !='admin' && $user->username=='admin' ){
        //    return redirect()->back()->withErrors("Bạn không có quyền set tài khoản Admin")->withInput();
        //}

        ActivityLog::add($request, 'Xem profile user #'.$data->id);
        return view('admin.user.view-profile')->with('user',$data);
    }


    public function set_permission(Request $request,$id){

        if(!config('module.user.need_set_permission')){
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


        ActivityLog::add($request, 'Vào form cập nhật permission user #'.$data->id);

        return view('admin.user.set_permission')
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('data', $data)
            ->with('permissionsJson', $permissionsJson)
            ->with('permissionsSelected', $permissionsSelected);
    }
    public function post_set_permission(Request $request,$id){

        if(!config('module.user.need_set_permission')){
            return redirect()->back()->withErrors(__('Chức năng chưa được kích hoạt'));
        }

        $data = User::where('account_type',1)->findOrFail($id);
        $data->permissions()->sync(isset($request->permission_ids) ? explode(",",$request->permission_ids) : []);

        ActivityLog::add($request, 'Cập nhật permission thành công user #'.$data->id);
        return redirect()->back()->with('success',__('Phân quyền truy cập thành công'));

    }

    public function getBuffIdol(Request $request, $id){
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Chỉnh sửa giao diện hiển thị idol")
        ];
        $data = User::where('account_type',2)->where('is_idol',1)->findOrFail($id);
        $meta = $data->getAllMeta();

        ActivityLog::add($request, 'Vào form buff thông tin idol #'.$data->id);
        return view('admin.user.buff_data')
            ->with('data', $data)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('meta', $meta);
    }
    public function postBuffIdol(Request $request, $id){
        $data = User::where('account_type',2)->where('is_idol',1)->findOrFail($id);

        $input = array();

        if($request->filled('buff_rating')){
            $buff_rating = (float)$request->buff_rating;
            //return $buff_rating;
            if(!is_float($buff_rating)){
                return redirect()->back()->withErrors(__('Định dạng chỉ số rating không đúng !'));
            }

            $input['buff_rating'] = $buff_rating;
        }

        if($request->filled('buff_follow')){
            $buff_follow = (int)$request->buff_follow;
            if(!is_int($buff_follow)){
                return redirect()->back()->withErrors(__('Định dạng chỉ số folow không đúng !'));
            }
            $input['buff_follow'] = $buff_follow;
        }
        if($request->filled('buff_donate')){
            $donate = $request->buff_donate;
            if(count($donate['image_user']) != count($donate['name_user']) || count($donate['image_user']) != count($donate['amount_user'])){
                return redirect()->back()->withErrors(__('Định dạng chỉ số top donate không đúng !'));
            }
            for($i = 0; $i < count($donate['image_user']); $i++){
                $buff_donate[] = [
                    'image_user' => config('module.user.image_fake.'.$donate['image_user'][$i]),
                    'name_user' => $donate['name_user'][$i],
                    'amount_user' => $donate['amount_user'][$i],
                ];
            }
            $buff_donate = json_encode($buff_donate,JSON_UNESCAPED_UNICODE);
            $input['buff_donate'] = $buff_donate;
        }
        if($request->filled('frames_avatar')){
            $input['frames_avatar'] = $request->frames_avatar;
        }
        if($request->filled('frames_armorial')){
            $input['frames_armorial'] = $request->frames_armorial;
        }
        if($request->filled('effect_profile')){
            $input['effect_profile'] = $request->effect_profile;
        }
        $data->setManyMeta($input);
        return redirect()->back()->with('success',__('Cập nhật chỉ số cho Idol thành công'));
    }
}
