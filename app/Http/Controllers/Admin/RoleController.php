<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ActivityLog;
use Html;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $user;
    protected $page_breadcrumbs;

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            //if (strtolower(Auth::guard()->user()->username) != "admin") {
            //    abort('403');
            //}
            return $next($request);
        });

        //set role to function
        $this->middleware('role:admin');
        //$this->middleware('role:role-create', ['only' => ['create','store']]);
        //$this->middleware('role:role-edit', ['only' => ['edit','update']]);
        //$this->middleware('role:role-delete', ['only' => ['destroy']]);

        $this->page_breadcrumbs = [
            [   'page' => route('admin.role.index'),
                'title' => "Nhóm vai trò",
            ],

        ];
    }

    public function index(Request $request)
    {

        ActivityLog::add($request, 'Truy cập danh sách role');
        $data=Role::orderBy('order','asc')->get();
        $datatable=$this->getHTMLCategory($data);


        return view('admin.role.index')
            ->with('page_breadcrumbs',$this->page_breadcrumbs)
            ->with('datatable',$datatable);

    }


    /**
     * Show the form for creating a new newscategory
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $dataCategory= Role::orderBy('order','asc')->get();
        $permissions = Permission::orderBy('order', 'asc')->get();

        $array = array();
        foreach ($permissions as $permission) {
            if($permission->parent_id==0 || $permission->parent_id.""==""){
                $permission->parent_id="#";
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

        ActivityLog::add($request, 'Vào form create role');
        return view('admin.role.create_edit', compact('dataCategory','permissionsJson'));
    }

    /**
     * Store a newly created newscategory in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[
            'title'=>'required|unique:roles',
            'name'=>'required|unique:roles'
        ],[
            'title.required' => __('Vui lòng nhật tiêu đề'),
            'title.required' => __('Vui lòng nhâp từ khóa name'),
            'name.required' =>__('Keyword đã tồn tại'),
            'name.unique' =>__('Keyword đã tồn tại')
        ]);

        $input=$request->all();
        $data=Role::create($input);

        $data->permissions()->sync(isset($request->permission_ids) ? explode(",",$request->permission_ids) : []);

        ActivityLog::add($request, 'Tạo mới thành công role #'.$data->id);
        return redirect()->route('admin.role.index')
            ->with('success',__('Thêm mới thành công !'));

    }

    /**
     * Display the specified newscategory.
     *
     * @param  int $id
     * @return Response
     */
    public function show(Request $request,$id)
    {
        //$data = Role::findOrFail($id);
        //ActivityLog::add($request, 'Show role #'.$data->id);
        //return view('admin.role.show', compact('item'));
    }

    /**
     * Show the form for editing the specified newscategory.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(Request $request,$id)
    {
        $data = Role::findOrFail($id);

        $dataCategory= Role::where('id','!=',$id)->orderBy('order','asc')->get();
        //permisson info
        $permissions = Permission::orderBy('order', 'asc')->get();
        $permissionsSelected = $data->permissions()->pluck('id')->toArray();
        //dd($permissionsSelected);
        $array = array();
        foreach ($permissions as $permission) {

            if($permission->parent_id==0 || $permission->parent_id.""==""){
                $permission->parent_id="#";
            }

            //if($permission->name=="activity-log-list"){
            //    dd('stop',$data->hasPermissionTo($permission));
            //}

            //if($data->hasPermissionTo($permission)){
            //    $hasPermission=true;
            //}
            //else{
            //    $hasPermission=false;
            //}
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

        ActivityLog::add($request, 'Vào form edit role #'.$data->id);
        return view('admin.role.create_edit', compact('data','dataCategory','permissionsJson','permissionsSelected'));

    }

    /**
     * Update the specified newscategory in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request,$id)
    {

        $data = Role::findOrFail($id);

        $this->validate($request,[
            'title'=>'required|unique:roles,title,'.$id,
            'name'=>'required|unique:roles,name,'.$id
        ],[
            'title.required' => __('Vui lòng nhật tiêu đề'),
            'title.required' => __('Vui lòng nhâp từ khóa name'),
            'name.required' =>__('Keyword đã tồn tại'),
            'name.unique' =>__('Keyword đã tồn tại')
        ]);

        $input = $request->all();
        $data->update($input);

        $data->permissions()->sync(isset($request->permission_ids) ? explode(",",$request->permission_ids) : []);
        ActivityLog::add($request, 'Cập nhật thành công role #'.$data->id);
        return redirect()->route('admin.role.index')->with('success',__('Cập nhật vai trò thành công '.'['.$data->title.']'));

    }

    /**
     * Remove the specified newscategory from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(Request $request)
    {

        $input=explode(',',$request->id);
        Role::destroy($input);
        ActivityLog::add($request, 'Xóa thành công role #'.json_encode($input));
        return redirect()->route('admin.role.index')->with('success',__('Xóa thành công !'));
    }


    // AJAX Reordering function
    public function order(Request $request)
    {


        $source = e($request->get('source'));
        $destination = $request->get('destination');

        $item = Role::find($source);
        $item->parent_id = isset($destination)?$destination:0;
        $item->save();

        $ordering = json_decode($request->get('order'));

        $rootOrdering = json_decode($request->get('rootOrder'));

        if ($ordering) {
            foreach ($ordering as $order => $item_id) {
                if ($itemToOrder = Role::find($item_id)) {
                    $itemToOrder->order = $order;
                    $itemToOrder->save();
                }
            }
        } else {
            foreach ($rootOrdering as $order => $item_id) {
                if ($itemToOrder = Role::find($item_id)) {
                    $itemToOrder->order = $order;
                    $itemToOrder->save();
                }
            }
        }
        ActivityLog::add($request, 'Thay đổi STT thành công role #'.$item->id);
        return 'ok ';
    }
    // Getter for the HTML menu builder
    function getHTMLCategory($menu)
    {
        return $this->buildMenu($menu);
    }
    function buildMenu($menu, $parent_id = 0)
    {
        $result = null;
        foreach ($menu as $item)
            if ($item->parent_id == $parent_id) {
                $result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
              <div class='dd-handle nested-list-handle'>
                <span class='la la-arrows-alt'></span>
              </div>
              <div class='nested-list-content'>";
                if($parent_id!=0){
                    $result.="<div class=\"m-checkbox\">
                                    <label class=\"checkbox checkbox-outline\">
                                    <input  type=\"checkbox\" rel=\"{$item->id}\" class=\"children_of_{$item->parent_id}\"  >
                                    <span></span> ".HTML::entities($item->title)."
                                    </label>
                                </div>";


                }
                else{

                    $result.="<div class=\"m-checkbox\">
                                    <label class=\"checkbox checkbox-outline\">
                                    <input  type=\"checkbox\" rel=\"{$item->id}\" class=\"children_of_{$item->parent_id}\"  >
                                    <span></span> ".HTML::entities($item->title)."
                                    </label>
                                </div>";
                }
                $result .= "<div class='btnControll'>";

                $result .= " <a href='#' class='btn btn-sm btn-primary edit_toggle' data-url='" . route("admin.role.edit",$item->id) . "' rel='{$item->id}' >Sửa</a>
                    <a href=\"#\" class=\"btn btn-sm btn-danger  delete_toggle \" rel=\"{$item->id}\">
                                        Xóa
                    </a>
                </div>
              </div>" . $this->buildMenu($menu, $item->id) . "</li>";
            }
        return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
    }
}
