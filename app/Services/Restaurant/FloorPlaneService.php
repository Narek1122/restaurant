<?php

namespace App\Services\Restaurant;
use App\Models\Restaurant\FloorPlane;
use App\Services\FileSystemService;

class FloorPlaneService
{
    public $fileServ;

    public function __construct()
    {
        $this->fileServ = new FileSystemService('restaurant/floor_plane');
    }

    public function store($data)
    {
        $created = FloorPlane::create($data,['except' => ['img'] ]);

        if(isset($data['img'])){
            $img = $this->fileServ->createImage($created['id'],$data['img']);
            $created['img'] = $img;
            $created->save();
        }

        return $created;

    }

    public function getByRestaurantId(Int $id){
        $data = FloorPlane::where('restaurant_id',$id)->get();

        return $data;
    }

    public function find(int $id)
    {
        $data = FloorPlane::find($id);

        return $data;
    }

    public function update(Int $id,$data){
        $find = $this->find($id);
        $updated = $find->update($data,['except' => ['img'] ]);

        if(isset($data['img'])){
            if($find['img']){
                $this->fileServ->delete($find['img']);
            }
            $img = $this->fileServ->createImage($find['id'],$data['img']);
            $find['img'] = $img;
            $find->save();
        }
        return $updated;
    }

}
