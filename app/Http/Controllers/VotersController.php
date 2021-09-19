<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Importer;
use Exporter;
use App\Models\Voters;
use App\Models\Votes;
use App\Models\Candidate;
use App\Models\Imported_files;
use DB;

class VotersController extends Controller {

    public function index(Request $request) {
        $list = Voters::orderBy('id', 'DESC')->get();
        return view('voters', ['list' => $list]);
    }
    
    public function list(Request $request) {
        $data = array();
        $search = $_POST['search'];
        $draw = $_POST['draw'];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $filters_query = '';
        if($search['value'] !=''){
            $filters_query=  "WHERE    CONCAT_ws('-', voters_name,voters_address,legend,precent,municipality,barangay,district,age) LIKE '%{$search['value']}%'";
        }
        $list  = DB::select("SELECT * from voters  $filters_query LIMIT $length  OFFSET  $start  ");
        foreach ($list as $k) {
           $button_details = '
               <div class="btn-group">
                    <button type="button" class="btn btn-info" title="View Details"  imported_id="'.$k->id .'" onclick="edit_details(this)"> <i class="fas fa-edit"></i></button>
                </div>
           ';
            $data[] = array($k->voters_name,$k->voters_address,$k->legend,$k->precent,$k->municipality,$k->barangay,$k->district,$k->age,$button_details);
        }
        $total_rows = DB::select("SELECT COUNT(*) AS total FROM  voters  $filters_query");
        $total_pages  = ceil($total_rows[0]->total);
        echo json_encode(array('draw' => $draw, 'recordsTotal', $total_pages,  'data' => $data,'search'=>$search,'length'=>$length,'draw'=>$draw,'start'=>$start, 'recordsFiltered' => $total_pages ));
       
    } 

    
}