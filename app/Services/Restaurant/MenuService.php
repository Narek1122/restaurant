<?php

namespace App\Services\Restaurant;
use App\Models\Restaurant\Menu;
use App\Models\Restaurant\MenuCategory;
use App\Services\FileSystemService;

class MenuService
{
    public $fileServ;

    public function __construct()
    {
        $this->fileServ = new FileSystemService('restaurant/menu');
    }

    public function index()
    {
        $data = Menu::get();
        return $data;
    }

    public function create(Int $id, $data)
    {
        $cat = MenuCategory::firstOrNew(['name' => $data['category']]);
        $cat->save();
        $data['category_id'] = $cat['id'];

        $created = Menu::create($data,['except' => ['img'] ]);

        if(isset($data['img'])){
            $img = $this->fileServ->createImage($created['id'],$data['img']);
            $created['img'] = $img;
            $created->save();
        }

        return $created;

    }

    public function delete(Int $id)
    {
        $data = Menu::find($id);
        if($data['img']){
            $this->fileServ->delete($data['img']);
        }
        return $data->delete();

    }

    public function update(Int $id,$data)
    {
       $cat = MenuCategory::firstOrNew(['name' => $data['category']]);
       $cat->save();
       $data['category_id'] = $cat['id'];

        $find = Menu::find($id);

        $updated = $find->update($data);

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
