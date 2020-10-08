<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$Users = 	array(
              // ['email'=>'dhiani@staff.ubaya.ac.id','password'=>'dhiani','Status'=>1],
              // ['email'=>'prijambodo@staff.ubaya.ac.id','prijambodo','Status'=>1],
              // ['email'=>'susana@staff.ubaya.ac.id','password'=>'susana','Status'=>1],
              // ['email'=>'mayalouk@staff.ubaya.ac.id','password'=>'mayalouk','Status'=>1],
              // ['email'=>'ellysa@staff.ubaya.ac.id','password'=>'ellysa','Status'=>1],
              // ['email'=>'andre@staff.ubaya.ac.id','password'=>'andre','Status'=>1],
              // ['email'=>'daniel.soesanto@staff.ubaya.ac.id','password'=>'danielsoesanto','Status'=>1],
              // ['email'=>'monica@staff.ubaya.ac.id','password'=>'monica','Status'=>1],
              // ['email'=>'ferdi@staff.ubaya.ac.id','password'=>'ferdi','Status'=>1],
              // ['email'=>'lisana@staff.ubaya.ac.id','password'=>'lisana','Status'=>1],

              // ['email'=>'s6134059@student.ubaya.ac.id','password'=>'daiva','Status'=>1],
              // ['email'=>'s6134111@student.ubaya.ac.id','password'=>'steven','Status'=>1],
              // ['email'=>'s6134115@student.ubaya.ac.id','password'=>'aldo','Status'=>1],
              // ['email'=>'s6134087@student.ubaya.ac.id','password'=>'ika','Status'=>1],
              // ['email'=>'s6134108@student.ubaya.ac.id','password'=>'christine','Status'=>1],
              // ['email'=>'s6134030@student.ubaya.ac.id','password'=>'aloysius','Status'=>1],
              // ['email'=>'s6134021@student.ubaya.ac.id','password'=>'michael','Status'=>1],
              // ['email'=>'s6134040@student.ubaya.ac.id','password'=>'christian','Status'=>1],
              // ['email'=>'s6134004@student.ubaya.ac.id','password'=>'andreas','Status'=>1],
              // ['email'=>'s6134020@student.ubaya.ac.id','password'=>'hadi','Status'=>1],

              // ['email'=>'s6134066@student.ubaya.ac.id','password'=>'wanandi','Status'=>1],
              // ['email'=>'s6134042@student.ubaya.ac.id','password'=>'febrianto','Status'=>1],
              // ['email'=>'s6137034@student.ubaya.ac.id','password'=>'meliza','Status'=>1],
              // ['email'=>'s6138015@student.ubaya.ac.id','password'=>'kevin','Status'=>1],
              // ['email'=>'s6134001@student.ubaya.ac.id','password'=>'fendy','Status'=>1],

              // ['email'=>'s6134130@student.ubaya.ac.id','password'=>'dyah','Status'=>1],
              // ['email'=>'s160414009@student.ubaya.ac.id','password'=>'evin','Status'=>1],
              // ['email'=>'s6137010@student.ubaya.ac.id','password'=>'yohanes','Status'=>1],
              // ['email'=>'s6134110@student.ubaya.ac.id','password'=>'david','Status'=>1],
              // ['email'=>'s6134015@student.ubaya.ac.id','password'=>'anthony','Status'=>1],

              // ['email'=>'s6138019@student.ubaya.ac.id','password'=>'mikhael','Status'=>1],
              // ['email'=>'s160415057@student.ubaya.ac.id','password'=>'edwin','Status'=>1],
              // ['email'=>'s160415147@student.ubaya.ac.id','password'=>'altdho','Status'=>1],
              // ['email'=>'s6134082@student.ubaya.ac.id','password'=>'adrian','Status'=>1],
              // ['email'=>'s6134034@student.ubaya.ac.id','password'=>'calvin','Status'=>1],

              // ['email'=>'s160414016@student.ubaya.ac.id','password'=>'gabriella','Status'=>1],
              // ['email'=>'s6137006@student.ubaya.ac.id','password'=>'rendy','Status'=>1],
              // ['email'=>'s6134096@student.ubaya.ac.id','password'=>'erwin','Status'=>1],
              // ['email'=>'s6134109@student.ubaya.ac.id','password'=>'welly','Status'=>1],
              // ['email'=>'s160415090@student.ubaya.ac.id','password'=>'roy','Status'=>1],

              // ['email'=>'s6134061@student.ubaya.ac.id','password'=>'lisania','Status'=>1],
              // ['email'=>'s6134065@student.ubaya.ac.id','password'=>'christiana','Status'=>1],
              // ['email'=>'s6138038@student.ubaya.ac.id','password'=>'marcellinus','Status'=>1],
              // ['email'=>'s6134002@student.ubaya.ac.id','password'=>'murdiyono','Status'=>1],
              // ['email'=>'s6124095@student.ubaya.ac.id','password'=>'kelvin','Status'=>1],

              // ['email'=>'s6134037@student.ubaya.ac.id','password'=>'daniel','Status'=>1],
              // ['email'=>'s6134070@student.ubaya.ac.id','password'=>'steven','Status'=>1],
              // ['email'=>'s6134035@student.ubaya.ac.id','password'=>'yolanda','Status'=>1],
              // ['email'=>'s6124034@student.ubaya.ac.id','password'=>'victor','Status'=>1],

              // ['email'=>'s6134093@student.ubaya.ac.id','password'=>'revaldy','Status'=>1],
              // ['email'=>'s6134107@student.ubaya.ac.id','password'=>'nandya','Status'=>1],
              // ['email'=>'s6134114@student.ubaya.ac.id','password'=>'reynaldo','Status'=>1],

              ['email'=>'budi@staff.ubaya.ac.id','password'=>'budi','Status'=>1],
              ['email'=>'joko_siswantoro@staff.ubaya.ac.id','password'=>'joko','Status'=>1],
              ['email'=>'benarkah@staff.ubaya.ac.id','password'=>'benarkah','Status'=>1],
              ['email'=>'endah@staff.ubaya.ac.id','password'=>'endah','Status'=>1],
              ['email'=>'faridnaufal@staff.ubaya.ac.id','password'=>'faridnaufal','Status'=>1],
              ['email'=>'hdinata@staff.ubaya.ac.id','password'=>'hdinata','Status'=>1],
              ['email'=>'lili@staff.ubaya.ac.id','password'=>'lili','Status'=>1],
              ['email'=>'tyrza@staff.ubaya.ac.id','password'=>'tyrza','Status'=>1],
              ['email'=>'daniel@staff.ubaya.ac.id','password'=>'daniel','Status'=>1],
              ['email'=>'fitri_dk@staff.ubaya.ac.id','password'=>'fitri','Status'=>1],
              ['email'=>'ongko@staff.ubaya.ac.id','password'=>'ongko','Status'=>1],
              ['email'=>'melissa@staff.ubaya.ac.id','password'=>'melissa','Status'=>1],
 			  );
		DB::table('User')->insert($Users);
    }
}
