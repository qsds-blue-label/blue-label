<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\FileExport;
use Importer;
use Exporter;
use App\Models\Voters;
use App\Models\Votes;
use App\Models\Candidate;
use App\Models\Imported_files;
use Session;
use DB;


class ImportController extends Controller {
    public function downloadExcel(){
        return Excel::download(new UsersExport, 'billing-report.xlsx');
    }

    public function index(Request $request) {
        $list = Imported_files::orderBy('id', 'DESC')->get();
        return view('import', ['list' => $list]);
    }

    public function import(Request $request) { 
        $user = Session::get('user');
        $excel = Importer::make('Excel');
        $date = $request->date;
        $filepath = $request->file('file')->getRealPath();
        $excel->load($filepath);
        $collection = $excel->getCollection();
        return $collection;
        $i = 0;
        
        $import = new Imported_files;
        $import->uploaded_by            = $user->id;
        $import->number_of_rows         = count($collection);
        $import->save();
        if($import->id){
            for ($i=0; $i < count($collection) ; $i++) { 
               
                if($i > 1){ 
                    $candidate_code = strtoupper($collection[$i][9]);
                    $precent = $collection[$i][4];
                    // check if voters is already added
                    $list = Voters::select('*')->where('voters_name', $collection[$i][1])->where('precent',$precent)->first();
                    $candidate = Candidate::select('*')->where('cadidate_code', $candidate_code)->first();
                    if($candidate){
                        $candidate_id = $candidate->id; 
                        if(!$list){
                            $data = new Voters;
                            $data->voters_name         = $collection[$i][1];
                            $data->voters_address      = $collection[$i][2];
                            $data->legend              = $collection[$i][3];
                            $data->precent             = $collection[$i][4];
                            $data->barangay            = $collection[$i][5];
                            $data->municipality        = $collection[$i][6];
                            $data->district            = $collection[$i][7];
                            $data->age                 = $collection[$i][8];
                            $save = $data->save();
                            $data2 = new Votes;
                            $data2->imported_id         = $import->id;
                            $data2->voters_id           = $data->id;
                            $data2->candidate_id        = $candidate_id;
                            $data2->date                =  $date;
                            $data2->save();
                        }else{
                            $is_exist  = Votes::select('*')->whereDate('date','=',$date)->where('voters_id',$list->id)->first();
                            if(!$is_exist){
                                $data2 = new Votes;
                                $data2->imported_id          = $import->id;
                                $data2->voters_id            = $list->id;
                                $data2->candidate_id         = $candidate_id;
                                $data2->date                 = $date;
                                $data2->save();
                            }
                        }
                    }
                
                
                }
            }
        }
        // foreach ($collection as $key) {
        //     // if($i++ > 1) {
        //     //    var_dump($key[$i]);
        //     // }
        //     var_dump($key[$i]);
        // }
    
      //return response()->json(array('msg'=> $collection), 200);
    }

    public function list(Request $request) {
        $data = array();
        $search = $_POST['search'];
        $draw = $_POST['draw'];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $filters_query = '';
        if($search['value'] !=''){
            $filters_query=  "WHERE    CONCAT_ws('-', name) LIKE '%{$search['value']}%'";
        }
        $list  = DB::select("SELECT *,imported_files.id AS imported_id FROM imported_files  INNER JOIN users ON  imported_files.uploaded_by = users.id   $filters_query LIMIT $length  OFFSET  $start  ");
        foreach ($list as $k) {
            //$button_details = '<a  href="javascript:;" data-toggle="tooltip" title="Add Payment"  importted_id="'.$k->imported_id .'"  onclick="add_payment(this)"  ><i class="icon-diff-added position-left text-primary"></i> Details</a>';
           $button_details = '
               <div class="btn-group">
                <button type="button" class="btn btn-info" title="View Details"  imported_id="'.$k->imported_id .'" onclick="view_details(this)"> <i class="fas fa-eye"></i></button>
                <button type="button" class="btn btn-info" title="View Details"  imported_id="'.$k->imported_id .'" onclick="delete_import(this)"> <i class="fas fa-trash"></i></button>
                </div>
           ';
            $data[] = array('IMPORT-0000'.$k->imported_id.'',date('F d, Y h:i A', strtotime($k->created_at)),$k->name,$k->number_of_rows,$button_details);
        }
        $total_rows = DB::select("SELECT COUNT(*) AS total FROM  imported_files INNER JOIN users ON  imported_files.uploaded_by = users.id   $filters_query");
        $total_pages  = ceil($total_rows[0]->total);
        echo json_encode(array('draw' => $draw, 'recordsTotal', $total_pages,  'data' => $data,'search'=>$search,'length'=>$length,'draw'=>$draw,'start'=>$start, 'recordsFiltered' => $total_pages ));
       
    } 

    public function delete(Request $request) {
        DB::table('imported_files')->delete($request->imported_id);
    }

    public function details(Request $request) {
        return view('import-details');
    }

    public function export(Request $request) {
        return Excel::download(new FileExport($request->number_of_votes), 'votes_template.xlsx');
    }

    

    
}