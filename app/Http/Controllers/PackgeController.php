<?php

namespace App\Http\Controllers;

use App\Packge;
use App\PackgeImage;
use App\PackgeType;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Facades\DataTables;

class PackgeController extends Controller
{
    public function index()
    {
        return view('admin.package.index');
    }
    
    public function create()
    {
        $type = PackgeType::all();
        return view('admin.package.add',compact('type'));
    }
    
    public function store(Request $request)
    {
        $package = new Packge();
        
        $filename = '';
    
        if( $request->hasFile('image')) {
            $image = $request->file('image');
            $path = public_path().'/banner/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
        
        }
        
        $package->packageType_id = $request->packagetype_id;
        $package->package_name = $request->package_name;
        $package->destination_name = $request->destination_name;
        $package->duration = $request->duration;
        $package->banner = $filename;
        
        $package->status = 1;
        
        $package->save();
        
        $last_id = DB::getPdo()->lastInsertId();
    
        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('image',$name);
                $images[]=$name;
            }
        }
        /*Insert your data*/
    
        PackgeImage::insert( [
            'package_id' => $last_id,
            'image'=>  implode("|",$images)
        ]);
        
        return redirect()->back()->with('msg','You are added package successfully');
    }
    
    public function getdata()
    {
        $package = DB::table('tour_packages')
                  ->select(
                      'tour_packages.id',
                      'tour_packages.package_name',
                      'tour_packages.destination_name',
                      'tour_packages.duration',
                      'tour_packages.banner',
                      'tour_packages.status',
                      'packagetype.name'
                  )
                   ->leftjoin('packagetype','tour_packages.packageType_id','=','packagetype.id')
                   ->get();
        //dd($package);die;
    
        return DataTables::of($package)
            ->addIndexColumn()
    
            ->addColumn('picture', function ($package) {
                return '<img style="width: 50px;" src="./banner/'.$package->banner.'"/>';
            })
    
    
            ->editColumn('action', function ($package) {
                $return = "<div class=\"btn-group\">";
                if (!empty($package->package_name))
                {
                    $return .= "<a href=\"/package/edit/$package->id\"  class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"Edit\">
                                 <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                                  </a>

                                  <a rel=".$package->id." rel1='delete' class=\"btn btn-xs btn-danger deleteRecord\" data-toggle=\"tooltip\" title=\"Delete\">
                                        <i class=\"ace-icon fa fa-remove bigger-120\"></i>
                                    </a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action',
                'picture'
            ])
        
            ->make(true);
    }
    
    public function edit($id)
    {
        $package = Packge::findOrFail($id);
        $type = PackgeType::all();
        $pimage = PackgeImage::where('package_id',$package->id);
        return view('admin.package.edit',compact('type','package','pimage'));
    }
    
    public function update(Request $request, $id)
    {
        $package = Packge::findOrFail($id);
    
        $filename = '';
    
        if( $request->hasFile('image')) {
            $image = $request->file('image');
            $path = public_path().'/banner/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
        }
    
        $package->packageType_id = $request->packagetype_id;
        $package->package_name = $request->package_name;
        $package->destination_name = $request->destination_name;
        $package->duration = $request->duration;
        $package->banner = $filename;
    
        $package->status = 1;
    
        $package->update();
    
        //$last_id = DB::getPdo()->lastInsertId();
    
        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('image',$name);
                $images[]=$name;
            }
        }
        /*Insert your data*/
    
        PackgeImage::where('package_id',$package->id)->update( [
            'package_id' => $package->id,
            'image'=>  implode("|",$images)
        ]);
    
        return redirect()->back()->with('msg','You are added package successfully');
    }
    
    public function destroy($id)
    {
//        $pimage = PackgeImage::where('package_id',$id)->first();
//        $pimages = explode('|',$pimage->image);
//        //dd($pimages);die;
//        $image_path = public_path().'/image/'.$pimages;
//        unlink($image_path);
//        $pimage->delete();
     
        
        $package = Packge::findOrFail($id);
        $p_image = public_path().'/banner/'.$package->banner;
        unlink($p_image);
        $package->delete();
        
        return redirect()->back()->with('msg','Package Deleted Successfully');
    }
}
