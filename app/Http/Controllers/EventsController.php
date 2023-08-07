<?

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public function storeEvent(Request $request)
    {
        $data = $request->only('name', 'description', 'date_from', 'date_to');

        // Save the poster image if provided
        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $path = $poster->store('posters', 'public'); // Store the image in the 'public/storage/posters' directory
            $data['poster'] = $path;
        }

        Events::create($data);

    }
}
