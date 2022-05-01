<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    class AuthController extends Controller
    {
        public function __constructor()
        {
            $this->middleware('auth:api', ['except' => ['login']]);
        }

        public function login(): JsonResponse
        {
            $credentials = request(['email', 'password']);
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        }

        private function respondWithToken($token): JsonResponse
        {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_date' => \auth()->factory()->getTTL() * 60
            ]);
        }

        public function me(): JsonResponse
        {
            return response()->json(\auth()->user());
        }

        public function logout()
        {
            \auth()->logout();
            return response()->json(['message' => 'Successfully logged out']);
        }
    }
