<?php

namespace App\Services\Restaurant;

use App\Models\Image;
use App\Models\Restaurant\Restaurant;
use App\Services\FileSystemService;
use function dd;

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

     public function update(Int $id,$data){
          $data = array_filter($data,function($value){
               return !empty($value);
             });

         $res = Restaurant::find($id);
         $res->update($data);

         if(isset($data['images'])){
          foreach($data['images'] as $img){
          $file = $this->fileServ->createImage($res['id'],$img);
          $image = new Image(['path' => $file]);
          $res->images()->save($image);
          }
          }

          if(isset($data['logo'])){
               $deleted = $this->fileServ->delete($res->mainImage['path']);
               $res->mainImage->delete();
               $file = $this->fileServ->createImage($res['id'],$data['logo']);
               $image = new Image(['path' => $file,'main_img' => 1]);
               $res->images()->save($image);
           }

          if(isset($data['1_start'])){

               for($i=1;$i<8;$i++){
                  $st = $i . '_start';
                  $en = $i . '_end';
                  if(isset($data[$st]) && isset($data[$en])){
                       $first = $res->days()->where('day_id',$i)->first();

                       if(isset($first)){
                         $res->days()->updateExistingPivot($first['id'], ['start' => $data[$st],'end' => $data[$en]]);

                       }else{
                         $res->days()->attach($i,['start' => $data[$st], 'end' => $data[$en]]);
                       }


                  }
             }
             }

             if(isset($data['delete_image'])){
                  foreach($data['delete_image'] as $dat){
                       if(!empty($dat)){
                         $deleted = $this->fileServ->delete($dat);
                         $res->images()->where('path',$dat)->delete();
                       }
                  }
             }

     }

     public function deleteImage(Int $id,$data){
          $res = Restaurant::find($id);
          $res->images()->where('path',$data['path'])->delete();
          dd(1);

     }

}
