<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seed数据填充 方便测试
        /*\App\User::create([
            'name'=>'Alex',
            'email'=>'32781438646@qq.com',
            'password'=>bcrypt('admin888')
        ]);
        */
        //factoru模型工厂数据填充 方便测试
        factory(\App\Http\Model\User::class,20)->create();
        $user=\App\Http\Model\User::find(1);
        $user->name='Alex';
        $user->email='2190114886@qq.com';
        $user->password=bcrypt('admin888');
        $user->is_admin=1;
        $user->email_active=1;
        $user->save();

        $user2=\App\Http\Model\User::find(2);
        $user2->name='Joe';
        $user2->email='32781438646@qq.com';
        $user2->password=bcrypt('admin888');
        $user2->email_active=1;
        $user2->save();
    }
}
