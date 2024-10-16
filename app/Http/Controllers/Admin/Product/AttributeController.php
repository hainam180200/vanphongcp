<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Files;
use App\Models\ActivityLog;
use App\Models\Item;
use Html;

class AttributeController extends Controller
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

        $this->module='product-attribute';

        //set permission to function
        $this->middleware('permission:'. $this->module.'-list');
        $this->middleware('permission:'. $this->module.'-create', ['only' => ['create', 'store','duplicate']]);
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
        $data= Item::where('module','=',$this->module)->orderBy('order')->get();
        $data=$this->getHTMLCategory($data);
        $dataCategory = Item::where('module', '=', $this->module)->orderBy('order','asc')->get();
        return view('admin.product.attribute.index')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs)
            ->with('data', $data)
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

        $dataCategory = Item::where('module', '=', $this->module)->orderBy('order','asc')->get();

        ActivityLog::add($request, 'Vào form create '.$this->module);
        return view('admin.product.attribute.create_edit')
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
        if($request->filled('image')){
            $input['image']= Files::upload_image($request->file('image','images',null,null,null,false));
        }
        $data=Item::create($input);

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
    public function edit(Request $request, $id)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Cập nhật")
        ];
        $data = Item::where('module', '=', $this->module)->findOrFail($id);
        $dataCategory = Item::where('module', '=', $this->module)->where('id','!=',$id)->orderBy('order','asc')->get();

        ActivityLog::add($request, 'Vào form edit '.$this->module.' #'.$data->id);
        return view('admin.product.attribute.create_edit')
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
        $data =  Item::where('module', '=', $this->module)->findOrFail($id);

        $this->validate($request,[
            'title'=>'required',
        ],[
            'title.required' => __('Vui lòng nhập tiêu đề'),
        ]);

        $input=$request->all();
        $input['module']=$this->module;
        if($request->filled('image')){
            $input['image']= Files::upload_image($request->file('image','images',null,null,null,false));
        }
        $data->update($input);

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
    public function destroy(Request $request, $id)
    {
        $input=explode(',',$request->id);
        Item::where('module','=',$this->module)->whereIn('id',$input)->update(['status' => 0]);
        ActivityLog::add($request, 'Xóa thành công '.$this->module.' #'.json_encode($input));
        return redirect()->back()->with('success',__('Xóa thành công !'));
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
                                     <input  type=\"checkbox\" rel=\"{$item->id}\" class=\"children_of_{$item->parent_id}\">
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
                 if ($item->status == 1) {
					$result .= "<a href='#' class=''  title='Active'><img src='" . asset('/assets/backend/images/check.png') . "' alt='Active' /></a>&nbsp;";
				} else {
					$result .= "<a href='#' class='' title='Unactive'><img src='" . asset('/assets/backend/images/uncheck.png') . "' alt='Unactive' /></a>&nbsp;";
				}
 
                 $result .= "<a href='" . route("admin.".$this->module.".edit",$item->id) . "' class='btn btn-sm btn-primary'>Sửa</a>
                     <a href=\"#\" class=\"btn btn-sm btn-danger  delete_toggle \" rel=\"{$item->id}\">
                                         Xóa
                     </a>
                 </div>
               </div>" . $this->buildMenu($menu, $item->id) . "</li>";
             }
         return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
     }
}
