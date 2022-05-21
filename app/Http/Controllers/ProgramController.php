<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    public function index()
    {
        /* load all programs */
        return DB::table('programs')->get();
    }

    public function getProgramByName(string $name): JsonResponse
    {
        $program = Program::where('program_name', $name)->first();
        return $program != null ? response()->json($program, 200) : response()->json(null, 200);
    }

    public function getProgramById(int $id): JsonResponse
    {
        $program = Program::where('id', $id)->first();
        return $program != null ? response()->json($program, 200) : response()->json(null, 200);
    }

    public function save(Request $request): JsonResponse
    {
        /**
         * usa a transaction for saving model including relations
         */
        DB::beginTransaction();
        try {
            $program = new Program();
            $program->program_name = $request->program_name;
            $program->save();
            DB::commit();
            return response()->json($program, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json('saving program failed ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, string $name): JsonResponse
    {
        DB::beginTransaction();
        try {
            $program = Program::where('program_name', $name)->first();
            if ($program != null) {
                $program->update($request->all());
                $program->save();
            }
            DB::commit();
            $program1 = Program::where('program_name', $name)->first();
            // return a vaild http response
            return response()->json($program1, 201);
        } catch (Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating program failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(string $name): JsonResponse
    {
        $program = Program::where('program_name', $name)->first();
        if ($program != null) {
            $program->delete();
        } else {
            throw Exception('Program could not be deleted - it doesn\'t exist');
        }
        return response()->json('Program (' . $name . ') succesfully deleted', 200);
    }
}
