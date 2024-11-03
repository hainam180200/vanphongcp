<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Group_Item;
use App\Models\SubItem;
use App\Models\Comment;

use App\Models\Item;
use ArrayObject;
use App\Library\HelpersDevice;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        return view('frontend.pages.contact');
    }
    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:255',
            'content' => 'required',
            'author' => 'required|string|max:100',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|max:100',
            'type' => 'required',
        ],[
            'type.required' => __('Vui lòng chọn chuyên mục'),
            'title.required' => __('Vui lòng nhập tiêu đề'),
            'title.string' => 'Tiêu đề phải là một chuỗi ký tự.',
            'title.max' => 'Tiêu đề không được dài quá 255 ký tự.',
            'content.required' => __('Vui lòng nhập nội dung'),
            'author.required' => __('Vui lòng nhập người hỏi'),
            'author.max' => __('Tên quá dài'),
            'address.required' => __('Vui lòng nhập địa chỉ'),
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'email.required' => __('Vui lòng nhập email'),
            'email.email' => __('Vui lòng nhập đúng định dạng mail'),
            'email.max' => 'Email không được dài quá 255 ký tự.',
        ]);
        $input = $request->all();

        Comment::create($input);
        return redirect()->back()->with('success',__('Gửi ý kiến thành công !'));

    }


}
