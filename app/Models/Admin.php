<?php
namespace App\Models;

class Admin extends User{
    protected $table = 'users';
    protected static function booted():void{
        static::addGlobalScope('admin',function($query){
            $query->where('role','admin');
        });
    }
    public static function createAdmin(array $data):static
    {
        return static::create(array_merge($data,['role'=>'admin']));
    }

}
