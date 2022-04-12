<?php

namespace App\Http\Controllers;

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
        return Offer::with(['users', 'courses', 'programs'])->get();
    }

    public function getOfferById(int $id): JsonResponse
    {
        $offer = Offer::where('id', $id)->with(['users', 'courses', 'programs'])->first();
        return $offer != null ? response()->json($offer, 200) : response()->json(null, 200);
    }

    public function save(Request $request): JsonResponse
    {
        /**
         * usa a transaction for saving model including relations
         */
        DB::beginTransaction();
        try {
            $offer = new Offer();
            $offer->courses_id = $request->courses_id;
            $offer->programs_id = $request->programs_id;
            $offer->users_id = $request->users_id;
            $offer->save();
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
            $offer = Offer::with(['users', 'courses', 'programs'])->where('id', $id)->first();
            if ($offer != null) {
                $offer->update($request->all());
                $offer->save();
            }
            DB::commit();
            $offer1 = Offer::with(['users', 'courses', 'programs'])->where('id', $id)->first();
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
        $offer = Offer::with(['users', 'courses', 'programs'])->where('id', $id)->first();
        if ($offer != null) {
            $offer->delete();
        } else {
            throw Exception('Offer could not be deleted - it doesn\'t exist');
        }
        return response()->json('Offer (' . $id . ') succesfully deleted', 200);
    }

}