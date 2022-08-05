<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Players;
use Illuminate\Http\Request;
use Illuminate\Http\Uploaded;
use Redirect;
class PlayerController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
   

    // Player Ordering Module
    public function index()
    {
       
       $players =  Players::leftJoin('users','users.id','=','players_details.user_id')
                            ->orderBy('players_details.ordering','ASC')
                            ->select('players_details.*', 'users.name','users.email')
                            ->get();
        $title = 'Players Listing';
    
        return view('backend.pages.players', compact('title','players'));
    }

    public function reorder(Request $request)
    {
        $players = Players::all();
        
        foreach ($players as $player) {
            foreach ($request->order as $order) {
                if ($order['id'] == $player->id) {
                    $player->update(['ordering' => $order['position']]);
                   
                }
            }
        }
       
        return response()->json(['message' => 'Order Update Successfully.', 'status' => 200]);
       
    }

       // Customer Status Updation
       public function popularStatus(Request $request)
       {
       
           try{
               $player = Players::findOrFail($request->player_id);
               $player->isPopular = $request->status;
               $player->save();
   
               return response()->json(['message' => 'Status updated successfully.']);
           }
           catch (\Exception $e) {
            
               return redirect('/admin/players/')->with('error', 'Something went wrong.');
           }
       }
 

   
}