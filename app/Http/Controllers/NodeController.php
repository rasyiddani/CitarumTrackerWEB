<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Database as FirebaseDatabase;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class NodeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $limit = $request->input('limit', 10);

            $node = $request->input('node', null);

            if (!$node) {
                return apiResponse('Mohon isi nilai node', 400);
            }

            $list = DB::table('nodes')
                ->where('node', $node)
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();

            $impedanceValues = $list->pluck('impedance')
                ->map(function ($value) {
                    return is_numeric($value) ? (float) $value : null;
                })
                ->filter();

            $min = $impedanceValues->min();
            $max = $impedanceValues->max();

            $list = $list->reverse()->values();

            $data = [
                'max'   => $max,
                'min'   => $min,
                'list'  => $list,
            ];

            return apiResponse('Data nodes berhasil didapatkan', 200, $data);
        } catch (Throwable $th) {
            Log::info($th);

            return apiResponse('Error', 400);
        }
    }

    public function addNode()
    {
        DB::table('nodes')
            ->insert([
                'created_at'    => date('Y-m-d H:i:s'),
                'node'          => 'Node 1',
                'fasa'          => rand(1, 10),
                'imaginer'      => rand(1, 10),
                'latitude'      => '5.941306',
                'longitude'     => '106.987722',
                'magnitude'     => rand(1, 10),
                'real'          => rand(1, 10),
                'impedance'     => rand(10000, 10100),
                'time'          => date('H:i:s'),
            ]);

        DB::table('nodes')
            ->insert([
                'created_at'    => date('Y-m-d H:i:s'),
                'node'          => 'Node 7',
                'fasa'          => rand(1, 10),
                'imaginer'      => rand(1, 10),
                'latitude'      => '5.941306',
                'longitude'     => '106.987722',
                'magnitude'     => rand(1, 10),
                'real'          => rand(1, 10),
                'impedance'     => rand(10000, 10100),
                'time'          => date('H:i:s'),
            ]);
    }

    public function fetchNodeData(Request $request)
    {
        $node = $request->input('nodes', []);

        $node = explode(',', $node);

        $data = DB::table('nodes')
            ->whereIn('node', $node)
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        $data = $data->reverse();

        $groupedData = $data->groupBy('node')->map(function ($group) {
            return $group->map(function ($item) {
                return [
                    'x' => $item->created_at,
                    'y' => $item->impedance,
                ];
            });
        });

        return response()->json($groupedData);
    }

    public function nodeList()
    {
        try {
            $nodes = DB::table('nodes')
                ->distinct()
                ->where('node', 'REGEXP', '^[a-zA-Z0-9]+$')
                ->orderBy('node', 'asc')
                ->pluck('node')
                ->toArray();

            $list = [];

            foreach ($nodes as $node) {
                $impedance = DB::table('nodes')
                    ->where('node', $node)
                    ->orderBy('created_at', 'desc')
                    ->first()
                    ->impedance;

                $list[] = [
                    'node'          => $node,
                    'impedance'     => intval($impedance),
                ];
            }

            $data = [
                'name'  => "Citarum Sector 5",
                'list'  => $list
            ];

            return apiResponse('List nodes berhasil didapatkan', 200, $data);
        } catch (Throwable $th) {
            Log::info($th);

            return apiResponse('Error', 400);
        }
    }

    public function show($id)
    {
        $data = DB::table('nodes')
            ->where('id', $id)
            ->first();

        $data->created_at = indoDateFull($data->created_at);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $id = DB::table('nodes')
                ->insertGetId([
                    'created_at'        => date('Y-m-d H:i:s'),
                    'node'              => $request->node,
                    'fasa'              => $request->fasa,
                    'imaginer'          => $request->imaginer,
                    'latitude'          => $request->latitude,
                    'longitude'         => $request->longitude,
                    'magnitude'         => $request->magnitude,
                    'real'              => $request->real,
                    'impedance'         => $request->impedance,
                    'time'              => $request->time,
                ]);

            DB::commit();

            $data = DB::table('nodes')
                ->where('id', $id)
                ->first();

            return apiResponse('Node berhasil ditambahkan', 201, $data);
        } catch (Throwable $th) {
            DB::rollback();

            Log::info($th);

            return apiResponse('Error', 400);
        }
    }

    public function table(Request $request)
    {
        $data = DB::table('nodes')
            ->where('node', $request->node);

        if (!$request->has('order')) {
            $data->orderBy('created_at', 'desc');
        }

        return DataTables::of($data)
            ->editColumn('created_at', function ($row) {
                return indoDateFull($row->created_at);
            })
            ->addColumn('status', function ($row) {
                $settings = DB::table('settings')
                    ->first();

                if ($row->impedance > $settings->value) {
                    return view('components.spans.danger', [
                        'caption' => $settings->over
                    ]);
                } else {
                    return view('components.spans.primary', [
                        'caption' => $settings->under
                    ]);
                }
            })
            ->addColumn('action', function ($row) {
                return view('components.buttons.dashboard.index', [
                    'id' => $row->id
                ]);
            })
            ->addIndexColumn()
            ->make(true);
    }
}
