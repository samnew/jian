<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 列表
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        return view("post/index", compact('posts'));
    }

    // 文章详情页
    public function show(Post $post)
    {
        return view("post/show", compact('post'));
    }

    // 创建页面
    public function create()
    {
        return view("post/create");
    }

    // 创建逻辑
    public function store()
    {
        // 验证
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=> 'required|string|min:10',
        ]);

        $params = request(['title','content']);
        Post::create($params);

        return redirect("/posts");
    }

    // 编辑页面
    public function edit()
    {
        return view("post/edit");
    }

    // 编辑逻辑
    public function update()
    {

    }

    // 删除逻辑
    public function delete()
    {

    }

    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }
}
