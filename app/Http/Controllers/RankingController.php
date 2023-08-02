<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\SubCriteria;
use App\Models\Alternative;

class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['criterias'] = Criteria::all();
        $data['alternatives'] = Alternative::all();
        return view('rankings', $data);
    }

    public function doRanking(Request $request)
    {
        $tfnSkala = [
            (object)[
                "tria" => [1, 1, 1],
                "reci" => [1, 1, 1]
            ],
            (object)[
                "tria" => [0.5, 1, 1.5],
                "reci" => [0.666, 1, 2]
            ],
            (object)[
                "tria" => [1, 1.5, 2],
                "reci" => [0.5, 0.666, 1]
            ],
            (object)[
                "tria" => [1.5, 2, 2.5],
                "reci" => [0.4, 0.5, 0.666]
            ],
            (object)[
                "tria" => [2, 2.5, 3],
                "reci" => [0.333, 0.4, 0.5]
            ],
            (object)[
                "tria" => [2.5, 3, 3.5],
                "reci" => [0.285, 0.333, 0.4]
            ],
            (object)[
                "tria" => [3, 3.5, 4],
                "reci" => [0.25, 0.285, 0.333]
            ],
            (object)[
                "tria" => [3.5, 4, 4.5],
                "reci" => [0.222, 0.25, 0.285]
            ],
            (object)[
                "tria" => [4, 4.5, 2],
                "reci" => [0.5, 0.222, 0.25]
            ]
        ];
        $inputCriteria = array_map('intval', $request->input);

        $data['criterias'] = Criteria::all();
        $data['inputCriterias'] = array_chunk($inputCriteria, count($data['criterias']));

        $lmuArray = [];
        foreach($data['inputCriterias'] as $indexInput => $sub) {
            foreach($sub as $indexSub => $item) {
                if ($item == 0) {
                    $lmuArray[] = $tfnSkala[$data['inputCriterias'][$indexSub][$indexInput] - 1]->reci;
                } else {
                    $lmuArray[] = $tfnSkala[$item - 1]->tria;
                }
            }
        }

        $data['conversionCriterias'] = array_chunk(array_merge(...$lmuArray), 12);

        // sub criteria function
        $getSubByCriteria = SubCriteria::select('criteria_id')->distinct()->get();
        $subCriteriaLength = $getSubByCriteria->count();
        $subCriteriaCount = \DB::table('sub_criterias')
            ->select('criteria_id', \DB::raw('COUNT(*) as count'))
            ->groupBy('criteria_id')
            ->pluck('count')
            ->toArray();

        $inputSubCriteria = [];
        for ($i = 1; $i <= $subCriteriaLength; $i++) {
            $parseNumber = array_map('intval', $request->input("sub_input_" . $i));
            $inputSubCriteria[] = array_chunk($parseNumber, $subCriteriaCount[$i - 1]);
        }

        // sub criteria 1
        $data['inputSubCriteria1'] = $inputSubCriteria[0];
        $lmuSubCriteria1 = [];

        foreach($data['inputSubCriteria1'] as $indexInput => $sub) {
            foreach($sub as $indexSub => $item) {
                if ($item == 0) {
                    $lmuSubCriteria1[] = $tfnSkala[$data['inputSubCriteria1'][$indexSub][$indexInput] - 1]->reci;
                } else {
                    $lmuSubCriteria1[] = $tfnSkala[$item - 1]->tria;
                }
            }
        }

        // sub criteria 2
        $data['inputSubCriteria2'] = $inputSubCriteria[1];
        $lmuSubCriteria2 = [];

        foreach($data['inputSubCriteria2'] as $indexInput => $sub) {
            foreach($sub as $indexSub => $item) {
                if ($item == 0) {
                    $lmuSubCriteria2[] = $tfnSkala[$data['inputSubCriteria2'][$indexSub][$indexInput] - 1]->reci;
                } else {
                    $lmuSubCriteria2[] = $tfnSkala[$item - 1]->tria;
                }
            }
        }

        // sub criteria 3
        $data['inputSubCriteria3'] = $inputSubCriteria[2];
        $lmuSubCriteria3 = [];

        foreach($data['inputSubCriteria3'] as $indexInput => $sub) {
            foreach($sub as $indexSub => $item) {
                if ($item == 0) {
                    $lmuSubCriteria3[] = $tfnSkala[$data['inputSubCriteria3'][$indexSub][$indexInput] - 1]->reci;
                } else {
                    $lmuSubCriteria3[] = $tfnSkala[$item - 1]->tria;
                }
            }
        }

        // sub criteria 4
        $data['inputSubCriteria4'] = $inputSubCriteria[3];
        $lmuSubCriteria4 = [];

        foreach($data['inputSubCriteria4'] as $indexInput => $sub) {
            foreach($sub as $indexSub => $item) {
                if ($item == 0) {
                    $lmuSubCriteria4[] = $tfnSkala[$data['inputSubCriteria4'][$indexSub][$indexInput] - 1]->reci;
                } else {
                    $lmuSubCriteria4[] = $tfnSkala[$item - 1]->tria;
                }
            }
        }

        // $data['conversionSubCriterias'] = [
        //     array_chunk(array_merge(...$lmuSubCriteria1), pow($subCriteriaCount[0], 2)),
        //     array_chunk(array_merge(...$lmuSubCriteria2), pow($subCriteriaCount[1], 2)),
        //     array_chunk(array_merge(...$lmuSubCriteria3), pow($subCriteriaCount[2], 2)),
        //     array_chunk(array_merge(...$lmuSubCriteria4), pow($subCriteriaCount[3], 2))
        // ];

        $data['conversionSubCriteria1'] = array_chunk(array_merge(...$lmuSubCriteria1), 9);
        $data['conversionSubCriteria2'] = array_chunk(array_merge(...$lmuSubCriteria2), 6);
        $data['conversionSubCriteria3'] = array_chunk(array_merge(...$lmuSubCriteria3), 9);
        $data['conversionSubCriteria4'] = array_chunk(array_merge(...$lmuSubCriteria4), 6);

        return view('result', $data);
    }
}
