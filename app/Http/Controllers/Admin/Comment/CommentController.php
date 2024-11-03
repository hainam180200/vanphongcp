<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Library\Files;
use App\Models\ActivityLog;
use App\Models\Comment;
use App\Models\Group;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Doctrine\Common\Cache\Psr6\get;

class CommentController extends Controller
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


        $this->module="comment";
        $this->moduleCategory=null;

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

        if($request->ajax) {
            $datatable= Comment::query();

            if ($request->filled('id'))  {
                $datatable->where(function($q) use($request){
                    $q->orWhere('id', $request->get('id'));
                });
            }
            if ($request->filled('content'))  {
                $datatable->where(function($q) use($request){
                    $q->orWhere('content', 'LIKE', '%' . $request->get('content') . '%');
                });
            }
            if ($request->filled('title'))  {
                $datatable->where(function($q) use($request){
                    $q->orWhere('title', 'LIKE', '%' . $request->get('content') . '%');
                });
            }
            if ($request->filled('username')) {
                $datatable->where(function($q) use($request){
                    $q->orWhere('author', 'LIKE', '%' . $request->get('author') . '%');
                });
            }

            if ($request->filled('status')) {
                $datatable->where('status',$request->get('status') );
            }
            if ($request->filled('type')) {
                $datatable->where('status',$request->get('type') );
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
                    'author',
                    'content',
                    'status',
                    'type',
                    'address',
                    'title',
                    'phone',
                    'email',
                    'action',
                    'created_at',
                ])
                ->editColumn('created_at', function($data) {
                    return date('d/m/Y H:i:s', strtotime($data->created_at));
                })
                ->addColumn('action', function($row) {
                    $temp= "<a href=\"".route('admin.'.$this->module.'.show',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-sm  btn-icon btn-hover-text-white btn-hover-bg-primary \" title=\"Xem\"><i class=\"la la-eye\"></i></a>";
                    return $temp;
                })

                ->toJson();
        }

        return view('admin.comment.item.index')
            ->with('module', $this->module)
            ->with('page_breadcrumbs', $this->page_breadcrumbs);
    }
    public function show(Request $request, $id)
    {
        $data = Comment::where('id',$id)->firstOrFail();
        ActivityLog::add($request, 'Truy cập chi tiết ý kiến '.$data->id);
        return view('admin.comment.item.show')
            ->with('module', $this->module)
            ->with('data', $data)
            ->with('page_breadcrumbs', $this->page_breadcrumbs);
    }
    public function destroy(Request $request)
    {
        $input=explode(',',$request->id);

        Comment::whereIn('id',$input)->delete();
        ActivityLog::add($request, 'Xóa thành công '.$this->module.' #'.json_encode($input));
        return redirect()->back()->with('success',__('Xóa thành công !'));
    }
    public function updateComment(Request $request, $id){
        // tìm đơn hàng
        $data = Comment::with('user')->where('id',$id)->first();
        $status_old = $data->status;
        if(!$data){
            return redirect()->back()->withErrors(__('Bình luận không hợp lệ !'));
        }
        $status = $request->status;
        DB::beginTransaction();
        $data->status = $status;
        $data->save();
        ActivityLog::add($request, 'Cập nhật trạng thái bình luận #'.$data->id. ' từ trạng thái '.$status_old. ' sang trạng thái '.$status);
        DB::commit();
        return redirect()->back()->with('success',__('Cập nhật trạng thái bình luận thành công !'));
    }
}
