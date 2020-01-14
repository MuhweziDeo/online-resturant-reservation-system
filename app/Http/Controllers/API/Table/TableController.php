<?php

namespace App\Http\Controllers\API\Table;

use App\Http\API\Table\TableRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Models\Table;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TableController extends Controller
{
    public $tableRepository;

    public function __construct(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
        $this->middleware('is_auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $tables = $this->tableRepository->findAll();
        return response()->json(['data' => $tables]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTableRequest $request
     * @return JsonResponse
     */
    public function store(CreateTableRequest $request)
    {
        $data = $request->only('seat_number');
        $table = Table::create($data);
        return response()->json(["data" => $table, "message" => "Table created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return JsonResponse
     */
    public function show(Table $table)
    {
        return  response()->json(['data' => $table]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTableRequest $request
     * @param Table $table
     * @return JsonResponse
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
        $table->update($request->only('seat_number', 'reserved'));
        return response()->json(['data' => $table, 'message' => 'Table updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Table $table
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Table $table)
    {

        if(!auth('api')->user()->admin == true) {
           throw new AuthorizationException();
        }
        $table->delete();
        return response()->json(['message' => 'Table Deleted successfully', 'data' => $table]);
    }
}
