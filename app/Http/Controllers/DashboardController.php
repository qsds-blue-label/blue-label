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

        $candidates = Candidate::with(['votes'])->get();

        $today = Carbon::today()->format('Y-m-d');
        $lastWeek = Carbon::today()->subDays(60)->format('Y-m-d');

        // TOTAL VOTES
        $overAllVoteData = $this->getTotalVotes($candidates);
        // PER MONTH VOTES
        $perMonth = $this->getPerMonthVotes($candidates, $today, $lastWeek);
        // PER BARANGAY VOTES
        $perBarangay = $this->getPerBarangayVotes($candidates, $today, $lastWeek);
        // PER MUNICIPALITY VOTES
        $perMunicipality = $this->getPerMunicipalityVotes($candidates, $today, $lastWeek);


        $dataChart = array(
            'overall' => $overAllVoteData,
            'monthly' => $perMonth,
            'barangay' => $perBarangay,
            'municipality' => $perMunicipality,
        );

        // dd($dataChart);

        return view('index', $dataChart);
    }

    public function getTotalVotes($candidates) {
        $voteData = Votes::with(['candidate'])->get();

        $overAllVoteData = array();
        foreach ($candidates as $vote) {
            $data = $vote;
            $data->totalCount = count($vote->votes);
            array_push($overAllVoteData, $data);
        }
        return $overAllVoteData;
    }

    public function getPerMonthVotes($candidates, $today, $lastWeek) {

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

        return $perMonth;
    }

    public function getPerMunicipalityVotes($candidates, $today, $lastWeek) {
        $municipalityResult = Votes::with(['candidate', 'voter_data'])
            ->whereBetween('date', [$lastWeek, $today])
            ->orderBy('date', 'ASC')
            ->get()
            ->groupBy(function($val) {
                return $val->voter_data->municipality;
            });
        $municipalityList = array();
        $municipalityData = array();
        $perMunicipality = array();
        foreach ($municipalityResult as $key => $res) {
            $dataMunicipality = array();
            $dataMunicipality['barangay'] = $key;

            array_push($municipalityList, $key);

            $votes = [];
            foreach ($res as $object) {
                if (isset($object->candidate_id)) {
                    $vote = $object->candidate->cadidate_code;
                    if (!isset($votes[$vote])) {
                        $votes[$vote] = 0;
                    }
                    $votes[$vote]++;
                }
            }
            $dataMunicipality['votes'] = $votes;
            array_push($municipalityData, $dataMunicipality);
        }

        $municipalityCandidateTotal = array();
        foreach ($candidates as $cand) {
            $count = 0;
            foreach ($municipalityData as $keyMon =>  $barData) {
                $totVote = array();
                foreach ($barData['votes'] as $key => $barDataVote) {
                    if($key === $cand->cadidate_code) {
                        $municipalityCandidateTotal[$key][$count] = $barDataVote;
                    }
                }
                $count++;
            }
        }

        $perMunicipality['municipalityList'] = $municipalityList;
        $perMunicipality['votes'] = $municipalityCandidateTotal;
        return $perMunicipality;
    }

    public function getPerBarangayVotes($candidates, $today, $lastWeek) {
        $barangayResult = Votes::with(['candidate', 'voter_data'])
            ->whereBetween('date', [$lastWeek, $today])
            ->orderBy('date', 'ASC')
            ->get()
            ->groupBy(function($val) {
                return $val->voter_data->barangay;
            });
        $barangayList = array();
        $barangayData = array();
        $perBarangay = array();
        foreach ($barangayResult as $key => $res) {
            $dataBarangay = array();
            $dataBarangay['barangay'] = $key;

            array_push($barangayList, $key);

            $votes = [];
            foreach ($res as $object) {
                if (isset($object->candidate_id)) {
                    $vote = $object->candidate->cadidate_code;
                    if (!isset($votes[$vote])) {
                        $votes[$vote] = 0;
                    }
                    $votes[$vote]++;
                }
            }
            $dataBarangay['votes'] = $votes;
            array_push($barangayData, $dataBarangay);
        }

        $barangayCandidateTotal = array();
        foreach ($candidates as $cand) {
            $count = 0;
            foreach ($barangayData as $keyMon =>  $barData) {
                $totVote = array();
                foreach ($barData['votes'] as $key => $barDataVote) {
                    if($key === $cand->cadidate_code) {
                        $barangayCandidateTotal[$key][$count] = $barDataVote;
                    }
                }
                $count++;
            }
        }

        $perBarangay['barangayList'] = $barangayList;
        $perBarangay['votes'] = $barangayCandidateTotal;
        return $perBarangay;
    }
}
