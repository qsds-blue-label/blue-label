<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

use App\Models\Votes;
use App\Models\Candidate;

class DashboardController extends Controller
{
    public function index(Request $request) {
        if(!Session::get('user')){
            return redirect('/login');
        }

        $voteData = Votes::with(['candidate'])->get();
        $candidates = Candidate::with(['votes'])->get();

        // TOTAL VOTES
        $overAllVoteData = array();
        foreach ($candidates as $vote) {
            $data = $vote;
            $data->totalCount = count($vote->votes);
            array_push($overAllVoteData, $data);
        }

        // PER MONTH VOTES
        $today = Carbon::today()->format('Y-m-d');
        $lastWeek = Carbon::today()->subDays(31)->format('Y-m-d');
        $monthlyResult = Votes::with(['candidate'])
            ->whereBetween('date', [$lastWeek, $today])
            ->orderBy('date', 'ASC')
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->date)->format('F-Y');
            });

        $monthlyData = array();
        $monthList = array();
        $perMonth = array();
        foreach ($monthlyResult as $key => $res) {
            $exp = explode("-", $key);
            $dataMonth = array();
            $dataMonth['month'] = $exp[0];

            $votes = [];
            foreach ($res as $object) {
                if (isset($object->candidate_id)) {
                    $vote = $object->candidate->cadidate_code;
                    if (!isset($votes[$vote])) {
                        $votes[$vote] = 0;
                    }
                    $votes[$vote]++;
                    // $votes['candidate'] = $object->candidate;
                }
            }
            
            $dataMonth['votes'] = $votes;
            array_push($monthlyData, $dataMonth);
            array_push($monthList, $exp[0]);
        }
        $monthlyCandidateTotal = array();
        foreach ($candidates as $cand) {
                $count = 0;
            foreach ($monthlyData as $keyMon =>  $monData) {
                $totVote = array();
                foreach ($monData['votes'] as $key => $monDataVote) {
                    if($key === $cand->cadidate_code) {
                        $monthlyCandidateTotal[$key][$count] = $monDataVote;
                    }
                }
                $count++;
            }
        }
        $perMonth['monthlist'] = $monthList;
        $perMonth['votes'] = $monthlyCandidateTotal;

        $dataChart = array(
            'overall' => $overAllVoteData,
            'monthly' => $perMonth,
        );

        // dd($dataChart);

        return view('index', $dataChart);
    }


    public function getMonth($month) {
        switch ($month) {
            case 1:
                return 'January';
                break;
            case 2:
                return 'February';
                break;
            case 3:
                return 'March';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'May';
                break;
            case 6:
                return 'June';
                break;
            case 7:
                return 'July';
                break;
            case 8:
                return 'August';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'October';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'December';
                break;
          }
    }
}
