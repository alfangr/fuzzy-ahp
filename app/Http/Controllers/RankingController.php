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
            [
                "tria" => [1, 1, 1],
                "reci" => [1, 1, 1]
            ],
            [
                "tria" => [0.5, 1, 1.5],
                "reci" => [0.666, 1, 2]
            ],
            [
                "tria" => [1, 1.5, 2],
                "reci" => [0.5, 0.666, 1]
            ],
            [
                "tria" => [1.5, 2, 2.5],
                "reci" => [0.4, 0.5, 0.666]
            ],
            [
                "tria" => [2, 2.5, 3],
                "reci" => [0.333, 0.4, 0.5]
            ],
            [
                "tria" => [2.5, 3, 3.5],
                "reci" => [0.285, 0.333, 0.4]
            ],
            [
                "tria" => [3, 3.5, 4],
                "reci" => [0.25, 0.285, 0.333]
            ],
            [
                "tria" => [3.5, 4, 4.5],
                "reci" => [0.222, 0.25, 0.285]
            ],
            [
                "tria" => [4, 4.5, 2],
                "reci" => [0.5, 0.222, 0.25]
            ]
        ];
        $inputCriteria = array_map('intval', $request->input);

        $data['criterias'] = Criteria::all();
        $data['inputCriterias'] = array_chunk($inputCriteria, count($data['criterias']));
        // return $tfnSkala[0];
        // return $data['inputCriterias'];

        $data['conversionCriterias'] = [
            [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
            [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13],
            [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 14],
            [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 15],
        ];

        return view('result', $data);
    }
}
