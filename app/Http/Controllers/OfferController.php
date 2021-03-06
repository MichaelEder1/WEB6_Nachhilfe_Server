<?php

namespace App\Http\Controllers;

use App\Models\Date;
use App\Models\Offer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index()
    {
        /* load all offers */
        return Offer::with(['user', 'course', 'program'])->get();
    }

    public function getOfferById(int $id): JsonResponse
    {
        $offer = Offer::where('id', $id)->with(['user', 'course', 'program', 'dates'])->first();
        return $offer != null ? response()->json($offer, 200) : response()->json(null, 200);
    }

    public function getOfferByUserId(int $id): JsonResponse
    {
        $offer = Offer::where('user_id', $id)->with(['user', 'course', 'program', 'dates'])->get();
        return $offer != null ? response()->json($offer, 200) : response()->json(null, 200);
    }

    public function getOffersByCourse(string $code): JsonResponse
    {
        $res = [];
        $offers = $this->index();
        foreach ($offers as $offer) {
            if ($offer->course->code == $code) {
                $res[] = $offer;
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
            $offer = new Offer();
            $offer->title = $request->title;
            $offer->information = $request->information;
            $offer->course_id = $request->course_id;
            $offer->program_id = $request->program_id;
            $offer->user_id = $request->userId;
            $offer->isAvailable = $request->isAvailable;
            $offer->save();

            if (isset($request['dates']) && is_array($request['dates'])) {
                foreach ($request['dates'] as $date) {
                    $newDate = Date::firstOrNew([
                        'offer_id' => $offer->id,
                        'program_id' => $request->program_id,
                        'course_id' => $request->course_id,
                        'tutor_id' => $request->userId,
                        'student_id' => null,
                        'accepted' => false,
                        'date_time' => $date['date_time']
                    ]);
                    $newDate->save();
                }
            }
            DB::commit();
            return response()->json($offer, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json('saving offer failed ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $offer = Offer::with(['user', 'course', 'program', 'dates'])->where('id', $id)->first();
            if ($offer != null) {
                $offer->title = $request->title;
                $offer->information = $request->information;
                $offer->course_id = $request->course_id;
                $offer->program_id = $request->program_id;
                $offer->user_id = $request->userId;
                $offer->isAvailable = $request->isAvailable;
                $offer->save();

                if (isset($request['dates']) && is_array($request['dates'])) {
                    $existingDate = Date::with('offer')->where("offer_id", $offer->id)->delete();
                    foreach ($request['dates'] as $date) {
                        $newDate = Date::firstOrNew([
                            'offer_id' => $offer->id,
                            'program_id' => $request->program_id,
                            'course_id' => $request->course_id,
                            'tutor_id' => $request->userId,
                            'student_id' => null,
                            'accepted' => false,
                            'date_time' => $date['date_time']
                        ]);
                        $newDate->save();
                    }
                }
            }
            DB::commit();
            $offer1 = Offer::with(['user', 'course', 'program', 'dates'])->where('id', $id)->first();
            // return a vaild http response
            return response()->json($offer1, 201);
        } catch (Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating offer failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse
    {
        $offer = Offer::with(['user', 'course', 'program'])->where('id', $id)->first();
        if ($offer != null) {
            $offer->delete();
        } else {
            throw Exception('Offer could not be deleted - it doesn\'t exist');
        }
        return response()->json('Offer (' . $id . ') succesfully deleted', 200);
    }
}
