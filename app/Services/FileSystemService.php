<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;


class FileSystemService
{
     protected $type = 'restaurant';

     public function __construct($type)
     {
          $this->type = $type;
     }

     public function createImage(Int $id,$file){

       $path = $this->type . '/' . $id ;

       return $this->create($file,$path);

     }

     public function create($data,String $path){

          $file = Storage::disk('local')->put('public/'.$path, $data);
          //$file = Storage::put($path,$data);

          return $file;
     }

     public function delete(String $path){
          return Storage::delete($path);
     }



}
