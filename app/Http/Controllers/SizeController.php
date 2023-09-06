<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
class SizeController extends Controller
{
    public function index(){
        return view('admin.size');
    }

    public function getpagination(Request $request){
        $columns = array( 
            0 =>'id', 
            1 =>'name',
        );

        $totalData = Size::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {            
        $posts = Size::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  Size::where('id','LIKE',"%{$search}%")
                    ->orWhere('size', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = Size::where('id','LIKE',"%{$search}%")
                    ->orWhere('size', 'LIKE',"%{$search}%")
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
        $nestedData['size'] = $post->size;
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


    public function add(Request $request){
        $data=new Size;
        $data->size=$request->input('size');
        $data=$data->save();
        if($data){
            return back()->with('msg',"Category Save Successfully");
        }else{
            return back()->with('msg',"Some Error");
        }
    }
}
