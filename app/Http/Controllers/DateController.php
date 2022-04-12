<?php

namespace App\Http\Controllers;

use App\Models\Date;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DateController extends Controller
{
    public function index()
    {
        /*load all Courses */
        return Date::with(['students', 'tutors', 'courses', 'programs', 'offers'])->get();
    }

    public function getDateById(int $id): JsonResponse
    {
        $date = Date::with(['students', 'tutors', 'courses', 'programs', 'offers'])->where('id', $id)->first();
        return $date != null ? response()->json($date, 200) : response()->json(null, 200);
    }

    public function save(Request $request): JsonResponse
    {
        /**
         * usa a transaction for saving model including relations
         */
        DB::beginTransaction();
        try {
            $date = new Date();
            $date->courses_id = $request->courses_id;
            $date->programs_id = $request->programs_id;
            $date->offers_id = $request->programs_id;
            $date->tutors_id = $request->tutors_id;
            $date->students_id = $request->students_id;
            $date->date_time = $request->date_time;
            $date->accepted = $request->accepted;
            $date->save();
            DB::commit();
            return response()->json($date, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json('saving offer failed ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $date = Date::with(['students', 'tutors', 'courses', 'programs', 'offers'])->where('id', $id)->first();
            if ($date != null) {
                $date->update($request->all());
                $date->save();
            }
            DB::commit();
            $date1 = Date::with(['students', 'tutors', 'courses', 'programs', 'offers'])->where('id', $id)->first();
            // return a vaild http response
            return response()->json($date1, 201);
        } catch (Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating offer failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse
    {
        $date = Date::with(['students', 'tutors', 'courses', 'programs', 'offers'])->where('id', $id)->first();
        if ($date != null) {
            $date->delete();
        } else {
            throw Exception('Date could not be deleted - it doesn\'t exist');
        }
        $course = $date->courses()->first()->course_name;
        $courseDate = $date->date_time;
        return response()->json('Date (' . $course . ' - ' . $courseDate . ') succesfully deleted', 200);
    }
}
