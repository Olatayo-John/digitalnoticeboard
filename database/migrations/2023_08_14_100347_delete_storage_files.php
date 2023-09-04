<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $folders = array('settings', 'user/profile', 'user/resume', 'client/profile','project/task');

        foreach ($folders as $folder) {
            //all files in folder
            $files = Storage::disk('public')->allFiles($folder);

            foreach ($files as $file) {
                //delete files
                Storage::disk('public')->delete($file);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
