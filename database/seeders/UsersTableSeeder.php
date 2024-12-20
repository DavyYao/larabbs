<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成数据集合
        User::factory()->count(10)->create();

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'DavvYao';
        $user->email = '313984045@qq.com';
        $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');
        $user->save();
        
        $user = User::find(2);
        $user->name = 'Kk石头';
        $user->email = '939705238@qq.com';
        $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        // 将 2 号用户指派为『管理员』
        $user->assignRole('Maintainer');
        $user->save();
    }
}
