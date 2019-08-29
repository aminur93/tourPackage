<?php

namespace App\Http\Controllers;

use App\PackgeType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PackgeTypeController extends Controller
{
    public function index()
    {
        return view('admin.packageType.index');
    }
    
    public function store(Request$request)
    {
        $type = new PackgeType();
        
        $type->name = $request->name;
        
        $type->save();
        
        return redirect()->back()->with('msg','Package Type Added Successfully');
    }
    
    public function getdata()
    {
        $packageType = PackgeType::all();
    
        return DataTables::of($packageType)
            ->addIndexColumn()
        
            ->editColumn('action', function ($packageType) {
                $return = "<div class=\"btn-group\">";
                if (!empty($packageType->name))
                {
                    $return .= "<a data-pid='$packageType->id' data-pname='$packageType->name' data-toggle=\"modal\" data-target=\"#editModal\" class=\"btn btn-xs btn-warning\">
                                 <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                                  </a>

                                  <a rel=".$packageType->id." rel1='delete' class=\"btn btn-xs btn-danger deleteRecord\" data-toggle=\"tooltip\" title=\"Delete\">
                                        <i class=\"ace-icon fa fa-remove bigger-120\"></i>
                                    </a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action'
            ])
        
            ->make(true);
    }
    
    public function update(Request $request)
    {
        $type = PackgeType::findOrFail($request->package_id);
        
        $type->name = $request->name;
        
        $type->update();
        
        return redirect()->back()->with('msg','Package Type Updated Successfully');
    }
    
    public function destroy($id)
    {
        $type = PackgeType::findOrFail($id);
        $type->delete();
        
        return redirect()->back()->with('msg','Package Type Deleted Successfully');
    }
}
