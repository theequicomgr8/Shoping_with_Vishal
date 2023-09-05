<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index(){
        return view('admin.category');
    }

    public function getpagination(Request $request){
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2=> 'slug',
        );

        $totalData = Category::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {            
        $posts = Category::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  Category::where('id','LIKE',"%{$search}%")
                    ->orWhere('category_name', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = Category::where('id','LIKE',"%{$search}%")
                    ->orWhere('category_name', 'LIKE',"%{$search}%")
                    ->count();
        }

        $data = array();
        if(!empty($posts))
        {
        foreach ($posts as $post)
        {
        // $show =  route('posts.show',$post->id);
        // $edit =  route('posts.edit',$post->id);
        $nestedData['id'] = $post->id;
        $nestedData['name'] = $post->category_name;
        $nestedData['slug'] = $post->category_slug;
        $nestedData['options'] = "&emsp;<a href='edit/{$post->id}' title='SHOW' >Edit</a>
                                &emsp;<a href='delete/{$post->id}' title='EDIT' >Delete</a>";
        $data[] = $nestedData;

        }
        }

        $json_data = array(
        "draw"            => intval($request->input('draw')),  
        "recordsTotal"    => intval($totalData),  
        "recordsFiltered" => intval($totalFiltered), 
        "data"            => $data   
        );

        echo json_encode($json_data); 
    }


    public function add(){
        // return view()
    }
}
