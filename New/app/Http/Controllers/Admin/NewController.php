<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use com_exception;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Categories;

class NewController extends Controller
{
    public function index(){
        $title = 'Tin tức';
        $newsList = News::paginate(10);
        return view('admin.news.list',compact('title','newsList'));
    }

    public function create(){
        $title = 'Thêm tin tức mới';
        $categories = Categories::where('category_type', '1')->get()->all();
        return view('admin.news.create', compact('title','categories'));
    }
    
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:150|unique:news',
            'image' => 'required',
            'content' => 'required',
            'category_id'=> 'required',
        ],[
            'title.required' => 'Chưa nhập tiêu đề',
            'title.max' => 'Tiêu đề không được quá 150 kí tự',
            'title.unique' => 'Bài viết đã tồn tại',
            'image.required' => 'Chưa nhập hình ảnh',
            'content.required' => 'Chưa nhập nội dung tin tức',
            'category_id.required'=> 'Chưa chọn danh mục tin tức',
        ]);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if(strcasecmp($extension,'jpg')===0
            || strcasecmp($extension,'jepg')===0
            || strcasecmp($extension,' png')===0){
                $image = Str::random(5)."_".$filename;
                while (file_exists("image/news/".$image)){
                    $image = Str::random(5)."_".$filename;  
            }
            $file->move("image/news/",$image);
            }
        }
        News::create([
            'title' => $request->title,
            'image' => $image,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('admin.news.index')->with('msg', 'Thêm tin tức thành công');
    }

    public function edit($id){
        $title = 'Sửa tin tức';
        $new = News::find($id);
        $categories = Categories::where('category_type', '1')->get()->all();
        return view('admin.news.edit',compact('title', 'new','categories'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required|max:150|unique:news,title,'.$id,
            'content' => 'required'
        ],[
            'title.required' => 'Chưa nhập tiêu đề',
            'title.max' => 'Tiêu đề không được quá 150 kí tự',
            'title.unique' => 'Bài viết đã tồn tại',
            'content.required' => 'Chưa nhập nội dung tin tức'
        ]);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if(strcasecmp($extension,'jpg')===0
            || strcasecmp($extension,'jepg')===0
            || strcasecmp($extension,' png')===0){
                $image = Str::random(5)."_".$filename;
                while (file_exists("image/news/".$image)){
                    $image = Str::random(5)."_".$filename;  
            }
            $file->move("image/news/",$image);
            }
        }
        $new = News::find($id);
        $data = [
            'title'=> $request->title,
            'content'=> $request->content,
        ];
        if($request->image){
            $data['image'] = $image;           
        }
        if($request->category_id){
            $data['category_id'] = $request->category_id;
        }

        $new->update($data);
        return redirect()->route('admin.news.index')->with('msg','Cập nhật thành công');
    }

    public function delete($id){
        News::find($id)->delete();
        return redirect()->back()->with('msg','Xoá tin tức thành công');
    }
    
}
