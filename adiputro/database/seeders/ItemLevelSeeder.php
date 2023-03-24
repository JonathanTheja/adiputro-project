<?php

namespace Database\Seeders;

use App\Models\ItemLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    function setItemLevels($item_levels, $level)
    {
        $item_levels->level = $level;
        $item_levels->save();

        foreach ($item_levels->children as $key => $item_level) {
            $this->setItemLevels($item_level, $level+1);
        }
    }

    public function run()
    {
        //
        DB::table("item_level")->insert([
            [
                // 'role_id' => 1,
                'name'=>'Bus',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>null
            ],
            [
                // 'role_id' => 1,
                'name'=>'Minibus',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>null
            ],
            [
                // 'role_id' => 1,
                'name'=>'SDD',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>1
            ],
            [
                // 'role_id' => 1,
                'name'=>'SUB ASSEMBLY',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>3
            ],
            [
                // 'role_id' => 1,
                'name'=>'Elf',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>2
            ],
            [
                // 'role_id' => 1,
                'name'=>'Fuso',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>2
            ],
            [
                // 'role_id' => 1,
                'name'=>'Elf Short 4P',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>5
            ],
            [
                // 'role_id' => 1,
                'name'=>'Body Welding',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>7
            ],

        ]);

        $item_levels = ItemLevel::tree()->get()->toTree();
        foreach ($item_levels as $key => $item_level) {
            $this->setItemLevels($item_level,0);
        }
    }
}
