<?php

namespace Haokeed\LaravelShop\Data\Goods\Models;


class Category extends Model
{
    protected $fillable = ['name', 'is_root', 'level', 'pid', 'path'];

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'pid');
    }

    // 定一个一个访问器，获取所有祖先类目的 ID 值
    public function getPathIdsAttribute()
    {
        // trim($str, '-') 将字符串两端的 - 符号去除
        // explode() 将字符串以 - 为分隔切割为数组
        // 最后 array_filter 将数组中的空值移除
        return array_filter(explode('-', trim($this->path, '-')));
    }

    public function getPathsAttribute()
    {
        return $this->path . $this->id;
    }

    // 定义一个访问器，获取所有祖先类目并按层级排序
    public function getAncestorsAttribute()
    {
        return Category::query()
            ->whereIn('id', $this->path_ids)
            ->orderBy('level')
            ->get();
    }

    /**
     * 获取所有的子集元素
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getChildrensAttribute()
    {
        return Category::query()
            ->where('path', 'like', $this->paths . '%')
            ->orderBy('level')
            ->get();
    }

    // 定义一个访问器，获取以 - 为分隔的所有祖先类目名称以及当前类目的名称
    public function getFullNameAttribute()
    {
        return $this->ancestors// 获取所有祖先类目
        ->pluck('name')// 取出所有祖先类目的 name 字段作为一个数组
        ->push($this->name)// 将当前类目的 name 字段值加到数组的末尾
        ->implode('-'); // 用 - 符号将数组的值组装成一个字符串
    }

    public function test()
    {

        // 如果需要添加一个分类,用户会自己填写 path,level
        // 需要一个事件监听Category创建的之前的动作
//        return Category::create([
//            'name' => "1开",
//            'pid' => 2,
//            'is_root' => 1,
//            'level'=>1,
//            'path'=>'-'
//        ]);


        return Category::where('id', 4)->first()->children->toArray();
    }
}
