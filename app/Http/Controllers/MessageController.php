<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        /* load all messages */
        return Message::with(['students', 'tutors', 'courses', 'programs', 'offers'])->get();
    }

    public function getMessageById(int $id): JsonResponse
    {
        $message = Message::with(['students', 'tutors', 'courses', 'programs', 'offers'])->where('id', $id)->first();
        return $message != null ? response()->json($message, 200) : response()->json(null, 200);
    }

    public function save(Request $request): JsonResponse
    {
        /**
         * usa a transaction for saving model including relations
         */
        DB::beginTransaction();
        try {
            $message = new Message();
            $message->text = $request->text;
            $message->date_time = $request->date_time;
            $message->programs_id = $request->programs_id;
            $message->students_id = $request->students_id;
            $message->tutors_id = $request->tutors_id;
            $message->courses_id = $request->courses_id;
            $message->offers_id = $request->offers_id;
            $message->save();
            DB::commit();
            return response()->json($message, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json('saving message failed ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $message = Message::with(['students', 'tutors', 'courses', 'programs', 'offers'])
                ->where('id', $id)->first();
            if ($message != null) {
                $message->update($request->all());
                $message->save();
            }
            DB::commit();
            $message1 = Message::with(['programs'])
                ->where('id', $id)->first();
            // return a vaild http response
            return response()->json($message1, 201);
        } catch (Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating message failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse
    {
        $message = Message::where('id', $id)->first();
        if ($message != null) {
            $message->delete();
        } else {
            throw Exception('Message could not be deleted - it doesn\'t exist');
        }
        return response()->json('Message (' . $id . ') succesfully deleted', 200);
    }
}
