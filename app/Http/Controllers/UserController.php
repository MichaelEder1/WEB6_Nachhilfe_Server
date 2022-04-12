<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): Collection
    {
        return DB::table('users')->get();
    }

    public function getUserById(int $id): JsonResponse
    {
        $user = User::where('id', $id)->first();
        return $user != null ? response()->json($user, 200) : response()->json(null, 200);

    }

    public function save(Request $request): JsonResponse
    {
        /**
         * usa a transaction for saving model including relations
         */
        DB::beginTransaction();
        try {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->age = $request->age;
            $user->photo = $request->photo;
            $user->mail = $request->mail;
            $user->password = bcrypt($request->password);
            $user->phone_number = $request->phone_number;
            $user->education = $request->education;
            $user->degree = $request->degree;
            $user->role = $request->role;
            $user->save();
            DB::commit();
            return response()->json($user, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json('saving user failed ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', $id)->first();
            if ($user != null) {
                $user->update($request->all());
                $user->save();
            }
            DB::commit();
            $user1 = User::where('id', $id)->first();
            // return a vaild http response
            return response()->json($user1, 201);
        } catch (Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating user failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse
    {
        $user = User::where('id', $id)->first();
        if ($user != null) {
            $user->delete();
        } else {
            throw Exception('User could not be deleted - it doesn\'t exist');
        }
        $firstName = $user->first_name;
        $lastName = $user->last_name;
        return response()->json('User (' . $firstName . ' ' . $lastName . ') succesfully deleted', 200);
    }
}
