<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateQuestionsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('questions', function(Blueprint $table) {
                //Question identifier
                $table->increments('id');
                //User that posted this question
                $table->integer('author_id')->unsigned()->nullable();
                //Question's main title
                $table->text('title');
                //Question content
                $table->mediumText('body');
                //The answer selected by the author or due to other conditions
                $table->integer('answer_id')->unsigned()->nullable();
                //Status of the question
                $table->enum('status', ['open', 'closed', 'duplicate'])->default('open');
                //Generate timestamps for update and creation
                $table->timestamps();
                $table->softDeletes();
            });

            Schema::table('questions', function(Blueprint $table) {
                $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('questions');
        }
    }
