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

class VotesController extends Controller {


    public function index(Request $request) {
        $list  = DB::select('SELECT * FROM votes  INNER JOIN voters  ON votes.voters_id=voters.id  INNER JOIN candidate ON votes.candidate_id=candidate.id  ');
        return view('votes', ['list' => $list]);
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
        $list  = DB::select("SELECT * from votes  INNER JOIN voters  ON votes.voters_id=voters.id  INNER JOIN candidate ON votes.candidate_id=candidate.id  $filters_query LIMIT $length  OFFSET  $start  ");
        foreach ($list as $k) {
            $data[] = array('<b>'.$k->voters_name.'- id: '.$k->voters_id.'</b>- <small>'.$k->precent.'</small><p>'.$k->voters_address.'</p><p>'.$k->barangay.', '.$k->municipality.' '.$k->district.'</p>',$k->date,'<b>'.$k->cadidate_code.'</b> - '.$k->cadidate_name.'');
        }
        $total_rows = DB::select("SELECT COUNT(*) AS total FROM  votes  INNER JOIN voters  ON votes.voters_id=voters.id   INNER JOIN candidate ON votes.candidate_id=candidate.id $filters_query");
        $total_pages  = ceil($total_rows[0]->total);
        echo json_encode(array('draw' => $draw, 'recordsTotal', $total_pages,  'data' => $data,'search'=>$search,'length'=>$length,'draw'=>$draw,'start'=>$start, 'recordsFiltered' => $total_pages ));
       
    } 

    
}