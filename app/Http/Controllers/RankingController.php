<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
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
                    $lmuArray[] = $tfnSkala[$data['inputCriterias'][$indexInput - $indexInput][$indexSub + 1] - 1]->reci;
                } else {
                    $lmuArray[] = $tfnSkala[$item - 1]->tria;
                }
            }
        }

        // return array_chunk(array_merge(...$lmuArray), 12);

        $data['conversionCriterias'] = array_chunk(array_merge(...$lmuArray), 12);

        return view('result', $data);
    }
}
