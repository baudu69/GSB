<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GsbBloc4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->visiteur();
        $this->type_praticien();
        $this->praticien();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visiteur');
        Schema::dropIfExists('praticien');
        Schema::dropIfExists('type_praticien');
    }

    private function visiteur() {
        Schema::create('visiteur', function (Blueprint $table) {
            $table->increments('id_visiteur');
            $table->integer('id_laboratoire');
            $table->integer('id_secteur');
            $table->string('nom_visiteur');
            $table->string('prenom_visiteur');
            $table->string('adresse_visiteur');
            $table->char('cp_visiteur', 5);
            $table->string('ville_visiteur');
            $table->date('date_embauche');
            $table->string('login_visiteur', 50);
            $table->string('pwd_visiteur', 200);
            $table->char('type_visiteur', 1);
        });
    }

    private function praticien() {
        Schema::create('praticien', function (Blueprint $table) {
            $table->increments('id_praticien');
            $table->integer('id_type_praticien');
            $table->string('nom_praticien');
            $table->string('prenom_praticien');
            $table->char('cp_praticien', 5);
            $table->string('ville_praticien');
            $table->decimal('coef_notoriete', 11, 2);
            $table->foreign('id_type_praticien')
                ->references('id_type_praticien')
                ->on('type_praticien');
        });
    }

    private function type_praticien() {
        Schema::create('type_praticien', function (Blueprint $table) {
            $table->increments('id_type_praticien');
            $table->string('lib_type_praticien');
            $table->string('lieu_type_praticien');
        });
    }
}
