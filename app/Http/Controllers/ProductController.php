<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    public function index(){
        return view('admin.product');
    }

    public function getpagination(Request $request){
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2=> 'slug',
            3=> 'image',
        );

        $totalData = Product::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {            
        $posts = Product::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  Product::where('id','LIKE',"%{$search}%")
                    ->orWhere('name', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = Product::where('id','LIKE',"%{$search}%")
                    ->orWhere('name', 'LIKE',"%{$search}%")
                    ->count();
        }

        $data = array();
        if(!empty($posts))
        {
        foreach ($posts as $post)
        {
        // $show =  route('posts.show',$post->id);
        // $edit =  route('posts.edit',$post->id);
        // $img=public_path("product")."/".$post->image;
        $img="/product"."/".$post->image;
        $nestedData['id'] = $post->id;
        $nestedData['name'] = $post->name;
        $nestedData['slug'] = $post->slug;
        $nestedData['image'] = "<img src='$img' style='width:80px; height:80px;'>";    
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


    public function productForm(){
        $categories=Category::where('status','1')->get();
        return view('admin.product-form',compact('categories'));
    }


    public function add(Request $request){
        $request->validate([
            "name"=>'required',
            "slug"=>'required|unique:products,slug',
            "category_id"=>'required',
            "image"=>'required'
        ]);
        $name = $request->input('name') ?? '';
        $slug = $request->input('slug') ?? ''; 
        $brand = $request->input('brand') ?? ''; 
        $modal = $request->input('modal') ?? ''; 
        $short_desc = $request->input('short_desc') ?? ''; 
        $desc = $request->input('desc') ?? ''; 
        $keywords = $request->input('keywords') ?? ''; 
        $technical_specification = $request->input('technical_specification') ?? ''; 
        $users = $request->input('users') ?? ''; 
        $warranty = $request->input('warranty') ?? ''; 
        $category_id=$request->input('category_id');
        if($file=$request->has('image')){
            $file=$request->file('image');
            $image=time().'-'.$file->getClientOriginalName();
            $file->move(public_path('product'),$image);
        }

        $data=new Product;
        $data->name=$name;
        $data->slug=$slug;
        $data->brand=$brand;
        $data->modal=$modal;
        $data->short_desc=$short_desc;
        $data->desc=$desc;
        $data->keywords=$keywords;
        $data->technical_specification=$technical_specification;
        $data->users=$users;
        $data->warranty=$warranty;
        $data->image=$image;
        $data->category_id=$category_id;
        $data=$data->save();
        if($data){
            return back()->with('msg',"Product Save");
        }else{
            return back()->with('msg',"Some Error");
        }

    }
}
