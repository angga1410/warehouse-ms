<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use Hash;
use Yajra\Datatables\Facades\Datatables;
use App\ResponseDto\DefaultResponse;

class UserController extends Controller
{
      public function doLogin(Request $request)
      {
         if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) 
         {
            return response()->json(["status" => "success"]);
         }
         return response()->json(["status" => "error"]);
      }

      public function logOut()
      {
         Auth::logout();
         return redirect()->to('/login');
      }

      public function viewUserList()
      {
         return view("user-list");
      }

      public function changePassword(Request $request)
      {
         //return $request->all();
         if(Hash::check($request->get('old_password'), Auth::user()->password) != false && $request->get('new_password') == $request->get('reentered_password'))
         {
            User::where('id','=',Auth::user()->id)
                  ->update(['password' =>  bcrypt($request->get('new_password'))]);

            flash("Successfully password changed!","success")->important();
            return redirect()->back();
         }

         flash("Please enter valid details")->important();
         return redirect()->back();
      }
      public function userListDt(Request $request)
      {
         $userList = User::all();

         $datatableRes = new DefaultResponse($userList);

        return $datatableRes->getResponse();
      }

      public function viewAddNewUser()
      {
         return view("add-user");
      }
      public function addNewUser(Request $request)
      {
         //return $request->all();
         $user = new User;
         $user->name       = $request->get("name");
         $user->email      = $request->get("email");
         $user->password   = bcrypt($request->get("password"));
         $user->department = $request->get("department");
         $user->save();

         $role = Role::where("name",$request->get("department"))->first();
         $user->roles()->attach($role->id);

         return response()->json(["status" => "success"]);
      }
      public function editUser(Request $request)
      {
         $changeStatus = User::where("id",$request->get("id"))->first();
         //status 1 = Approve.
         //Status 0 = Pending.
         if($changeStatus->status == 1){
            $changeStatus->status = 0;
         }
         else{
            $changeStatus->status = 1;
         }
         $changeStatus->update();
         return "success";
      }
      public function deleteUser(Request $request)
      {
         User::where("id",$request->get("id"))->delete();
         return "success";
      }
      public function updateUserView($id)
      {
         $user = User::where("id",$id)->first();
         return view('update-user',compact('user'));
      }
      public function updateUser(Request $request)
      {
         $userUpdate = User::where("id",$request->get("user_id"))->first();
         $userUpdate->name = $request->get("name");
         $userUpdate->email = $request->get("email");
         $userUpdate->department = $request->get("department");
         $userUpdate->status = $request->get("status");
         $userUpdate->update();

         $role = Role::where("name",$request->get("department"))->first();
         $userUpdate->roles()->sync($role->id);
        
         return redirect()->to("/user-list");
      }
}
