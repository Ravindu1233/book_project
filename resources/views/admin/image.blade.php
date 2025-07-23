namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'type', 'book_id'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
