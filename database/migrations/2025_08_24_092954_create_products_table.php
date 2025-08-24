
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('tamil_name')->nullable();

            $table->decimal('base_price', 12, 2);
            $table->decimal('selling_price', 12, 2);

            $table->string('packet_or_box'); // will store either 'packet' or 'box'

            $table->integer('quantity');

            $table->text('description'); // for CKEditor content

           $table->string('slug', 191)->unique();


            $table->string('items');

            $table->json('images')->nullable(); // to store multiple image file paths as JSON

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
