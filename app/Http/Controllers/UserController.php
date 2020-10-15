<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Return user list
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return $this->validResponse($users);
    }

    /**
     * Create an instance of User
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->validResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Return an instance of User
     * @param int $idUser
     * @return JsonResponse
     */
    public function show(int $idUser)
    {

        $user = User::findOrFail($idUser);

        return $this->validResponse($user);
    }

    /**
     * Update an specific user
     * @param Request $request
     * @param int $idUser
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $idUser)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,' . $idUser,
            'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $user = User::findOrFail($idUser);

        $user->fill($request->all());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->isClean()) {
            return $this->errorResponse('at least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->validResponse($user);
    }

    /**
     * Delete an instance of User
     * @param int $idUser
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $idUser)
    {
        $user = User::findOrFail($idUser);

        $user->delete();

        return $this->validResponse($user);
    }

    /**
     * Identifies the current user
     * @param Request $request
     * @return JsonResponse
     */
    public function me(Request $request)
    {
        return $this->validResponse($request->user());
    }
}
