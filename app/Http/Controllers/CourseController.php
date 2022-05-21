<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        /*load all Courses */
        return Course::with(['program'])->get();
    }

    public function getCourseByCode(string $code): JsonResponse
    {
        $course = Course::where('code', $code)->with(['program'])->first();
        return $course != null ? response()->json($course, 200) : response()->json(null, 200);
    }

    public function getCourseById(int $id): JsonResponse
    {
        $course = Course::where('id', $id)->with(['program'])->first();
        return $course != null ? response()->json($course, 200) : response()->json(null, 200);
    }

    public function getCourseByProgram(string $code): JsonResponse
    {
        $res = [];
        $courses = $this->index();
        foreach ($courses as $course) {
            if ($course->program->program_name == $code) {
                $res[] = $course;
            }
        }
        return $res != null ? response()->json($res, 200) : response()->json(null, 200);
    }

    public function save(Request $request): JsonResponse
    {
        /**
         * usa a transaction for saving model including relations
         */
        DB::beginTransaction();
        try {
            $course = new Course();
            $course->course_name = $request->course_name;
            $course->semester = $request->semester;
            $course->program_id = $request->programs_id;
            $course->code = $request->code;
            $course->save();
            DB::commit();
            return response()->json($course, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json('saving course failed ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, string $code): JsonResponse
    {
        DB::beginTransaction();
        try {
            $course = Course::with(['program'])
                ->where('code', $code)->first();
            if ($course != null) {
                $course->update($request->all());
                $course->save();
            }
            DB::commit();
            $course1 = Course::with(['program'])
                ->where('code', $code)->first();
            // return a vaild http response
            return response()->json($course1, 201);
        } catch (Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating course failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(string $code): JsonResponse
    {
        $course = Course::where('code', $code)->first();
        if ($course != null) {
            $course->delete();
        } else {
            throw Exception('Course could not be deleted - it doesn\'t exist');
        }
        return response()->json('Course (' . $code . ') succesfully deleted', 200);
    }

}
