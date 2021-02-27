<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->toArray();

        return $users;
    }

    public function signUp(SignupRequest $request)
    {
        $userData = $request->all();
        $userData['password'] = Hash::make($userData['password']);
        $user = new User();
        $user->fill($userData);
        $user->save();

        return $user->attributesToArray();

    }

    public function setVacation(Request $request, $id)
    {
        $on_vacation = $request->get('on_vacation') ? 1 : 0;
        if ($id){
            $user = User::find($id);
            if($user) {
                $user->on_vacation = $on_vacation;
                $user->save();

                return $user;
            }
        }
        return abort(404, 'User not found');

    }

}
