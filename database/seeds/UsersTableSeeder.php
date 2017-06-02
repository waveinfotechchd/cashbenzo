<?php

use App\Events\Inst;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        // Create admin account
        DB::table('users')->insert([
            'usertype' => 'Admin',
            'first_name' => 'John',
            'last_name' => 'Deo',            
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'image_icon' => 'upload/members/john-5d8c77eb422e0df92e3bc80d445f4661-b.jpg',
            'remember_token' => str_random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
         
        
        DB::table('settings')->insert([            
            'site_name' => 'Cofounders',            
            'site_email' => 'admin@admin.com',
            'site_logo' => 'logo.png',
            'site_favicon' => 'favicon.png',
            'site_description' => 'Find Cofounders- Cofounders',
            'site_copyright' => 'Copyright © 2017 Cofounders. All Rights Reserved.',
            'home_slide_title' => 'Find Cofounders- Cofounders',
            'home_slide_image1' => 'home_slide_image1.png',
            'home_slide_image2' => 'home_slide_image2.png',
            'home_slide_image3' => 'home_slide_image3.png',
            'page_bg_image' => 'page_bg_image.png',
            'about_title' => 'About Us',
            'contact_title' => 'Contact Us',
            'terms_of_title' => 'Terms and Condition',
            'privacy_policy_title' => 'Privacy Policy' 
        ]);
         
	
		
       // factory('App\User', 20)->create();
    }
}
