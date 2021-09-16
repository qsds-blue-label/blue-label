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


class ImportController extends Controller {
    public function downloadExcel(){
        return Excel::download(new UsersExport, 'billing-report.xlsx');
    }

    public function index(Request $request) {
        $list = Imported_files::orderBy('id', 'DESC')->get();
        return view('import', ['list' => $list]);
    }

    public function import(Request $request) { 
        $excel = Importer::make('Excel');
        $date = $request->date;
        $filepath = $request->file('file')->getRealPath();
        $excel->load($filepath);
        $collection = $excel->getCollection();
        $i = 0;
        
        $import = new Imported_files;
        $import->uploaded_by            = 1;
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
        //$query_sales = "SELECT * FROM tbl_sales INNER JOIN tbl_users ON tbl_sales.user_id=tbl_users.user_id  LEFT JOIN tbl_customer ON tbl_sales.cust_id=tbl_customer.cust_id  WHERE  sales_date BETWEEN  '$today' AND '$date_add' $user_query  $customer_query $query_status $query_register $query_type GROUP BY tbl_sales.sales_no ORDER BY sales_id DESC  LIMIT $length  OFFSET  $start ";
        var_dump($_POST['length']);
    } 

    
}