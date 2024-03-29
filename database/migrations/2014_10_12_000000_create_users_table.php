<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('photo', 200)->default('');
            $table->string('cellphone', 20)->default('');
        });

        Schema::create('touristlist', function (Blueprint $table) {
            $table->id('tlid');
            $table->foreignId('uid')->references('id')->on('users');
            $table->string('title');
            $table->timestamps();
            $table->date('start_date');
            $table->date('end_date');
        });

        Schema::create('prepare', function (Blueprint $table) {
            $table->id('preid');
            $table->foreignId('tlid')->references('tlid')->on('touristlist');
            $table->string('pretitle');
            $table->string('pretext', 1000);
            $table->string('checked', 2);
            $table->string('type', 2);
        });

        Schema::create('prepareitem', function (Blueprint $table) {
            $table->id('preiid');
            $table->foreignId('preid')->references('preid')->on('prepare');
            $table->string('preititle');
            $table->string('preitext', 1000);
            $table->string('checked', 2);
            $table->string('type', 2);
        });

        Schema::create('attractions', function (Blueprint $table) {
            $table->id('aid');
            $table->string('aname')->unique();
        });

        Schema::create('journey', function (Blueprint $table) {
            $table->id('jid');
            $table->foreignId('tlid')->references('tlid')->on('touristlist');
            $table->foreignId('aid')->references('aid')->on('attractions');
            // $table->string('jname');
            $table->date('arrived_date');
            $table->date('leaved_date');
            $table->time('arrived_time')->nullable();
            $table->time('leaved_time')->nullable();
            $table->string('jmemo', 10000)->nullable();
            $table->string('jreview', 150)->nullable();
            $table->string('jrate', 3)->nullable();
            $table->string('jchecked', 2);
        });

        Schema::create('jimage', function (Blueprint $table) {
            $table->id('jiid');
            $table->foreignId('jid')->references('jid')->on('journey');
            $table->string('jimg', 200);
        });

        Schema::create('jbudget', function (Blueprint $table) {
            $table->id('jbid');
            $table->foreignId('jid')->references('jid')->on('journey');
            $table->string('jbname', 150)->nullable();
            $table->string('jbamount', 11)->nullable();
        });

        Schema::create('project', function (Blueprint $table) {
            $table->id('pid');
            $table->foreignId('aid')->references('aid')->on('attractions');
            $table->string('pname', 200);
        });

        Schema::create('journeyproject', function (Blueprint $table) {
            $table->id('jpid');
            $table->foreignId('jid')->references('jid')->on('journey');
            $table->foreignId('pid')->references('pid')->on('project');
            // $table->string('jpname');
            $table->date('jpstart_date');
            $table->date('jpend_date');
            $table->time('jpstart_time')->nullable();
            $table->time('jpend_time')->nullable();
            $table->string('jpmemo', 10000)->nullable();
            $table->string('jpreview', 150)->nullable();
            $table->string('jprate', 3)->nullable();
            $table->string('jpchecked', 2);
        });

        Schema::create('jpbudget', function (Blueprint $table) {
            $table->id('jpbid');
            $table->foreignId('jpid', 20)->references('jpid')->on('journeyproject');
            $table->string('jpbname');
            $table->string('jpbamount', 11);
        });

        Schema::create('jpimage', function (Blueprint $table) {
            $table->id('jpiid');
            $table->foreignId('jpid')->references('jpid')->on('journeyproject');
            $table->string('jpimg', 200);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('touristlist');
        Schema::dropIfExists('prepare');
        Schema::dropIfExists('prepareitem');
        Schema::dropIfExists('journey');
        Schema::dropIfExists('jimage');
        Schema::dropIfExists('jbudget');
        Schema::dropIfExists('attractions');
        Schema::dropIfExists('project');
        Schema::dropIfExists('journeyproject');
        Schema::dropIfExists('jpimage');
        Schema::dropIfExists('jpbudget');
    }
};
