<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\AdminUser::class,5)->create();
        $user=\App\AdminUser::find(1);
        $user->name='Alex';
        $user->email='2190114886@qq.com';
        $user->password=bcrypt('admin888');
        $user->save();

        $user2=\App\AdminUser::find(2);
        $user2->name='Joe';
        $user2->email='32781438646@qq.com';
        $user2->password=bcrypt('admin888');
        $user2->save();
    }
}
