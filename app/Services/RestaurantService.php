<?php

namespace App\Services;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\FileSystemService;
use App\Models\Image;

class RestaurantService
{
     public $fileServ;

     public function __construct()
     {
          $this->fileServ = new FileSystemService('restaurant');
     }

     public function store(Array $data){
          
          $res = Restaurant::create($data);

          if(isset($data['logo'])){
              $file = $this->fileServ->createImage($res['id'],$data['logo']);  
              $image = new Image(['path' => $file,'main_img' => 1]);
              $res->images()->save($image);    
          }

          if(isset($data['images'])){
               foreach($data['images'] as $img){
               $file = $this->fileServ->createImage($res['id'],$img);  
               $image = new Image(['path' => $file]);
               $res->images()->save($image);  
               }   
           }

          
          if(isset($data['1_start'])){
            for($i=1;$i<8;$i++){
               $st = $i . '_start';
               $en = $i . '_end'; 
               if($data[$st] && $data[$en]){
                    $res->days()->attach($i,['start' => $data[$st], 'end' => $data[$en]]); 
               }
          }   
          }
          

          return $res;

          
          
     }

}