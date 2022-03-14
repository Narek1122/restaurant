<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService
{

    public function getAll(Int $pagintate = 5,String $order_by = 'id',String $order_pos = 'DESC'){
        return User::orderBy($order_by, $order_pos)
            ->where('id', '!=', Auth::user()->id)
            ->paginate($pagintate);
    }

    public function find(Int $id){
        return User::find($id);
    }

    public function update(Int $id,Array $data){
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    public function adminEdit(Int $id,Array $validated){

        $validated = array_filter($validated,function($value){
            return !empty($value);
        });

        $user = $this->update($id,$validated);

        if(isset($validated['roles'])){
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($validated['roles']);
        }

    }

    public function delete(Int $id){
       $this->find($id)->delete();
    }

}
