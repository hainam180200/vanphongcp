<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Group;
use App\Models\Group_Item;
use App\Models\Group_Item_Index;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Html;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_breadcrumbs;
    protected $module;
    protected $moduleCategory;
    public function __construct(Request $request)
    {

        $this->module=$request->segments()[1]??"";
        $this->moduleCategory=$this->module.'-group';

        //set permission to function
        $this->middleware('permission:'. $this->module.'-list');
        $this->middleware('permission:'. $this->module.'-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:'. $this->module.'-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:'. $this->module.'-delete', ['only' => ['destroy']]);


        if( $this->module!=""){
            $this->page_breadcrumbs[] = [
                'page' => route('admin.'.$this->module.'.index'),
                'title' => __(config('module.'.$this->module.'.title'))
            ];
        }
    }


    public function index(Request $request)
    {
        ActivityLog::add($request, 'Truy cập danh sách '.$this->module);
        if($request->ajax) {
            $datatable= Group::where('module','=',$this->module)->orderBy('order');

            if ($request->filled('group_id')) {

                $datatable->whereHas('groups', function ($query) use ($request) {
                    $query->where('group_id',$request->get('group_id'));
                });
            }


            if ($request->filled('id'))  {
                $datatable->where(function($q) use($request){
                    $q->orWhere('id', 'LIKE', '%' . $request->get('id') . '%');
                });
            }

            if ($request->filled('title'))  {
                $datatable->where(function($q) use($request){
                    $q->orWhere('title', 'LIKE', '%' . $request->get('title') . '%');
                });
            }
            if ($request->filled('position')) {
                $datatable->where('position',$request->get('position') );
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

            return \datatables()->eloquent($datatable)

                ->only([
                    'id',
                    'title',
                    'image',
                    'locale',
                    'groups',
                    'order',
                    'position',
                    'description',
                    'status',
                    'action',
                    'created_at',
                ])


                ->editColumn('created_at', function($data) {
                    return date('d/m/Y H:i:s', strtotime($data->created_at));
                })
                ->addColumn('action', function($row) {
                    $temp= "<a href=\"".route('admin.'.$this->module.'.edit',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary \" title=\"Sửa\"><i class=\"la la-edit\"></i></a>";
                    $temp.= "<a href=\"\"  rel=\"$row->id\" data-id=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-primary btn-show-item' class=\"listitem_toggle\" title=\"Danh sách trong nhóm\"><i class=\"la la-list-ol\"></i></a>";
                    $temp.= "<a  rel=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger delete_toggle' data-toggle=\"modal\" data-target=\"#deleteModal\" class=\"delete_toggle\" title=\"Xóa\"><i class=\"la la-trash\"></i></a>";
                    return $temp;
                })
                ->toJson();
        }
        $dataCategory = Group::where('module', '=',  $this->moduleCategory)->orderBy('order','asc')->get();
        return view('admin.product.group.index')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('dataCategory', $dataCategory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Thêm mới")
        ];

        $dataCategory = Group::where('module', '=', $this->moduleCategory)->orderBy('order','asc')->get();

        ActivityLog::add($request, 'Vào form create '.$this->module);
        return view('admin.product.group.create_edit')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('dataCategory', $dataCategory);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
        ],[
            'title.required' => __('Vui lòng nhập tiêu đề'),
        ]);
        $input=$request->all();
        $input['module']=$this->module;
        $input['author_id']=auth()->user()->id;
        $data=Group::create($input);

        //set category
        if( isset($input['group_id'] ) &&  $input['group_id']!=0){
            $data->groups()->attach($input['group_id']);
        }
        ActivityLog::add($request, 'Tạo mới thành công '.$this->module.' #'.$data->id);
        if($request->filled('submit-close')){
            return redirect()->route('admin.'.$this->module.'.index')->with('success',__('Thêm mới thành công !'));
        }
        else {
            return redirect()->back()->with('success',__('Thêm mới thành công !'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Cập nhật")
        ];
        $data = Group::where('module', '=', $this->module)->findOrFail($id);
        $dataCategory = Group::where('module', '=', $this->moduleCategory)->orderBy('order','asc')->get();

        ActivityLog::add($request, 'Vào form edit '.$this->module.' #'.$data->id);
        return view('admin.product.group.create_edit')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('data', $data)
            ->with('dataCategory', $dataCategory);
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
        //return $request->all();
        $data =  Group::where('module', '=', $this->module)->findOrFail($id);

        $this->validate($request,[
            'title'=>'required',
        ],[
            'title.required' => __('Vui lòng nhập tiêu đề'),
        ]);

        $input=$request->all();
        $input['module']=$this->module;
        $data->update($input);
        //set category

        // if( isset($input['group_id'] ) &&  $input['group_id']!=0){
        //     $data->groups()->sync($input['group_id']);
        // }
        // else{
        //     $data->groups()->sync([]);
        // }
        ActivityLog::add($request, 'Cập nhật thành công '.$this->module.' #'.$data->id);
        if($request->filled('submit-close')){
            return redirect()->route('admin.'.$this->module.'.index')->with('success',__('Cập nhật thành công !'));
        }
        else {
            return redirect()->back()->with('success',__('Cập nhật thành công !'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $input=explode(',',$request->id);
        Group::where('module','=',$this->module)->whereIn('id',$input)->update(['status' => 0]);
        ActivityLog::add($request, 'Xóa thành công '.$this->module.' #'.json_encode($input));
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
        $data=Item::where('module','=',$this->module)::whereIn('id',$input)->update([
            $field=>$value
        ]);

        ActivityLog::add($request, 'Cập nhật field thành công '.$this->module.' '.json_encode($whitelist).' #'.json_encode($input));

        return response()->json([
            'success'=>true,
            'message'=>__('Cập nhật thành công !'),
            'redirect'=>''
        ]);

    }
     // AJAX Reordering function
     public function order(Request $request)
     {
 
         $source = e($request->get('source'));
         $destination = $request->get('destination');
         $item = Group_Item_Index::find($source);
         $item->save();
 
         $ordering = json_decode($request->get('order'));
 
 
         $rootOrdering = json_decode($request->get('rootOrder'));
         if ($ordering) {
             foreach ($ordering as $order => $item_id) {
                 if ($itemToOrder = Group_Item_Index::find($item_id)) {
                     $itemToOrder->order = $order;
                     $itemToOrder->save();
                 }
             }
         } else {
             foreach ($rootOrdering as $order => $item_id) {
                 if ($itemToOrder = Group_Item_Index::find($item_id)) {
                     $itemToOrder->order = $order;
                     //dd($order);
                     $itemToOrder->save();
                 }
             }
         }
         ActivityLog::add($request, 'Thay đổi STT thành công '.$this->module.' #'.$item->id);
         return 'ok ';
     }
 
 
 
 
     public function search(Request $request){
         $module = str_replace('-group','',$this->module);
         $group_id = $request->id;
         $all_item_in_groups = Group_Item_Index::where('group_id',$group_id)->pluck('item_id');
         $datatable= Item::with(array('groups_items_index' => function ($query) {
             $query->where('module', $this->module);
             $query->select('groups_items_index.id','title');
         }))
         ->whereNotIn('id',$all_item_in_groups)
         ->where('module',$module)->where('status',1);
         if ($request->filled('find'))  {
             $datatable->where(function($q) use($request){
                 $q->orWhere('title', 'LIKE', '%' . $request->get('find') . '%');
                 $q->orWhere('id', 'LIKE', '%' . $request->get('find') . '%');
             });
         }
         $datatable=$datatable->paginate(10);
         return view('admin.module.group.search')
             ->with('datatable',$datatable)->render();
     }
 
     public function showItemGroup(Request $request){
         $id = $request->id;
         $module = $this->module;
         $data = Group_Item_Index::with('item')->where('group_id',$id)->select('id','group_id','item_id','order')->orderBy('order','asc')->get();
         return response()->json([
             'status' => 1,
             'id' => $id,
             'module' => $module,
             'data' => $data,
         ]);
     }
     public function updateItemGroup(Request $request){
 
         $id = $request->id;
         $group_id = $request->group_id;
 
 
         // kiểm tra id
 
         $item = Item::select('id','title')->where('id',$id)->select('id','title','price','description','status','order')->first();
 
 
         if(!$item){
             return response()->json([
                 'status' => 0,
                 'message' => "Bài viết không hợp lệ",
             ]);
         }
 
         if($item->status == 0){
             return response()->json([
                 'status' => 0,
                 'message' => "Game không hoạt động",
             ]);
         }
 
         $group=Group::where('module','=',$this->module)->where('id',$group_id)->first();
 
         if(!$group){
             return response()->json([
                 'status' => 0,
                 'message' => "Dữ liệu group không hợp lệ",
             ]);
         }
 
         // check xem group đã có item này hay chưa
         $check = Group_Item_Index::where('group_id',$group->id)->where('item_id',$item->id)->first();
         if($check){
             return response()->json([
                 'status' => 0,
                 'message' => "Dữ liệu đã được ở trong nhóm",
             ]);
         }
 
         $data = Group_Item_Index::create([
             'group_id' => $group->id,
             'item_id' => $item->id
         ]);
         $group_item = Group_Item_Index::with('item')->where('group_id',$group_id)->where('item_id',$id)->select('id','group_id','item_id','order')->first();
         return response()->json([
             'status' => 1,
             'data' => $group_item,
         ]);
     }
 
     public function deleteItemGroup(Request $request){
         $id = $request->id;
         $group_item = Group_Item_Index::where('id',$id)->first();
         if(!$group_item){
             return response()->json([
                 'status' => 0,
                 'message' => 'item không tồn tại trong nhóm',
             ]);
         }
         $delete = Group_Item_Index::where('id',$id)->delete();
         if($delete){
             return response()->json([
                 'status' => 1,
                 'message' => 'Xóa thành công',
             ]);
         }
     }
}
