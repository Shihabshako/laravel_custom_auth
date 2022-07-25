<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function goToLogin()
    {
        return redirect("login");
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "email" => ["required", "email", "unique:users,email"]
        ]);

        if($validator->fails()){
            $request->session()->flash("error", $validator->errors()->first());
            return redirect("login");
        }

        User::create([
            "email" => $request["email"],
            "name" => $request["name"],
            "password" => Hash::make($request["password"])
        ]);

        return redirect("login");
    }

    public function login(Request $request)
    {
        $user = User::query()->where("email", "=", $request["email"])->first();
        $password = $request["password"];
        if ($user && Hash::check($password, $user->password)) {
            $request->session()->put("email", $user->email);
            $request->session()->put("name", $user->name);
            return redirect("home");
        } else {
            $request->session()->flash("error", "Invalid Credential!!!");
            return redirect("login");
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect("login");
    }
}
