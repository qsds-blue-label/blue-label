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

    
}