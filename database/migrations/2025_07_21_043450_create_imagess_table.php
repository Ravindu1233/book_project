use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->enum('type', ['book', 'author']); // type to identify the image purpose
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('images');
    }
};
