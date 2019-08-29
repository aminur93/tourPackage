<?php

namespace App\Http\Controllers;

use App\TourPackage;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Facades\DataTables;

class PackageActivationController extends Controller
{
    public function index()
    {
        return view('admin.packageact.index');
    }
    
    public function getdata()
    {
        $act = DB::table('packageactivity')
               ->leftJoin('tour_packages','packageactivity.package_id','=','tour_packages.id')
            ->get();
    
        return DataTables::of($act)
            ->addIndexColumn()
        
            ->editColumn('action', function ($act) {
                $return = "<div class=\"btn-group\">";
                if (!empty($act->id))
                {
                    $return .= "
                                  <a rel=".$act->id." rel1='delete' class=\"btn btn-xs btn-danger deleteRecord\" data-toggle=\"tooltip\" title=\"Delete\">
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
    
    public function destro($id)
    {
        $act = TourPackage::findOrFail($id);
        $act->delete();
        
        return redirect()->back()->with('msg','Deleted Successfully');
    }
}
