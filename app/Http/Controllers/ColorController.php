<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
class ColorController extends Controller
{
    public function index(){
        return view('admin.color');
    }

    public function getpagination(Request $request){
        $columns = array( 
            0 =>'id', 
            1 =>'color_name',
        );

        $totalData = Color::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {            
        $posts = Color::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  Color::where('id','LIKE',"%{$search}%")
                    ->orWhere('color_name', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = Color::where('id','LIKE',"%{$search}%")
                    ->orWhere('color_name', 'LIKE',"%{$search}%")
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
        $nestedData['color_name'] = $post->color_name;
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
        $data=new Color;
        $data->color_name=$request->input('color_name');
        $data=$data->save();
        if($data){
            return back()->with('msg',"Category Save Successfully");
        }else{
            return back()->with('msg',"Some Error");
        }
    }
}
