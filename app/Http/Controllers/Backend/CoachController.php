<?php
namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use File;
use App\Models\Club; 
use App\Models\User; 
use App\Models\Coach; 
use App\Models\CoachUnavailability;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class CoachController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   

    public function index()
    {
        try{
            $title = 'Coaches Listing';
            $coaches =  Coach::leftJoin('users','users.id','=' ,'coaches_details.user_id')
                     ->leftJoin('currencies', 'currencies.id' ,'=', 'coaches_details.currency_id')
                     ->where('coaches_details.status', '1')
                     ->where('coaches_details.isDeleted', '0')
                     ->select('coaches_details.*','users.*','currencies.code as currencyCode','coaches_details.id as cid')
                     ->get();
           return view('backend.pages.coaches', compact('title','coaches'));
        }
        catch (\Exception $e) {
          //dd($e->getMessage());
            return redirect('/admin')->with('error', 'Something went wrong.');
        }      
    }

    // Bat Create

    public function create()
    { 
        try{
            $title = 'Add Coach';
            $clubs = Club::where('status', 1)->pluck('name','id');
            return view('backend.pages.coachAdd', compact('title','clubs'));
        }
        catch (\Exception $e) {
            return redirect('/admin/coaches/')->with('error', 'Something went wrong.');
        }
    }


    public function add(Request $request)
    {
      
         try{
            $data['name'] = $request->coach_name;
            $data['email'] = $request->coach_email;
            $data['password'] = Hash::make($request->password);
            $data['role'] = '4';
             if($request->file('profile_img')){
                $file= $request->file('profile_img');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move(base_path('Images/user_Images'), $filename);
                $data['profile_pic']= $filename;
                 }
               $result =  User::insertGetId($data);  
               if($result){
                $assign =  $request->assign_club;
                $all_clubs = [];
                foreach($assign as $c_id){
                   $all_clubs[] = $c_id;
                }
                $ids = implode(',', $all_clubs);
                $final = Coach::create([
                  'user_id' => $result,
                  'experience' => $request->experience,
                  'description' => $request->desc,
                  'price' => $request->price,
                  'currency_id' => 129,
                  'clubs_assigned' => $ids
                
              ]);
             
             }
        
            if($final){
                   return redirect('/admin/coaches')->with('success', 'Coach Addec Successfully.');
            }
        }
        catch (\Exception $e) {
            //dd($e->getMessage());
            return redirect('/admin/coaches')->with('error', 'Something went wrong.');
        }

    
    }

    //  Delete
    public function delete(Request $request, $id)
    {
        try{
            $coach = Coach::findOrFail($id);
            $coach->isDeleted = '1';
            $coach->save(); 
         
           return redirect('/admin/coaches')->with('success', 'Coach Deleted Successfully.');
           
        }
        catch (\Exception $e) {
            return redirect('/admin/coaches')->with('error', 'Something went wrong.');
        
         }
    }

    public function edit($id)
    {
        try{
            $coachData =  Coach::leftJoin('users','users.id','=' ,'coaches_details.user_id')
            ->leftJoin('currencies', 'currencies.id' ,'=', 'coaches_details.currency_id')
            ->where('coaches_details.id', $id)
            ->select('coaches_details.*','users.*','currencies.code as currencyCode','coaches_details.id as cid')
            ->first();
            $title = 'Edit Coach';
            $clubs = Club::where('status', 1)->pluck('name','id');
            return view('backend.pages.coachEdit', compact('title','coachData','clubs'));
        }
        catch (\Exception $e) {
            return redirect('/admin/coaches')->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request, $id)
       {
        
         try{ 
          
           $coach = Coach::findOrFail($id);
           $user = User::where('id', $coach->user_id)->first();
           $user['name'] = $request->coach_name;
           $user['email'] = $request->coach_email;
          // $data = $request->except('_method','_token','submit');
         
           if($request->file('profile_img')){
          
             if($user->profile_pic){
                $imagePath = base_path('Images/user_Images/'. $user->profile_pic);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }
            }
            $file= $request->file('profile_img');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(base_path('Images/user_Images'), $filename);
            $user->profile_pic= $filename;
             }
            $savedUser = $user->save(); 
           if( $savedUser) {
                $assign =  $request->assign_club;
                $all_clubs = [];
                foreach($assign as $c_id){
                    $all_clubs[] = $c_id;
                }
                $ids = implode(',', $all_clubs);
                $coach['experience'] = $request->experience;
                $coach['price'] = $request->price; 
                $coach['description'] = $request->desc;  
                $coach['clubs_assigned'] = $ids; 
                $coach->save(); 
            }
           return redirect('/admin/coaches')->with('success', 'Bat Updated successfully');
        }
        catch (\Exception $e) {
           // dd($e->getMessage());
            return redirect('/admin/coaches')->with('error', 'Something went wrong.');
        }
    }


    public function holidays()
    {
        try{
            $title = 'Holidays';
            $coachId = auth()->user()->id;
            
            $holidays =  CoachUnavailability::leftJoin('users','users.id','=' ,'coaches_unavailability.coach_id')
                     ->where('coaches_unavailability.status', '1')
                     ->where('coaches_unavailability.isDeleted', '0')
                     ->select('coaches_unavailability.*','users.*','coaches_unavailability.id as cid');
                     if(auth()->user()->role == '4'){
                        $holidays = $holidays->where('coaches_unavailability.coach_id', $coachId);
                     }
                    
                     $holidays = $holidays->get();
           return view('backend.pages.holidays', compact('title','holidays'));
        }
        catch (\Exception $e) {
         
            return redirect('/admin')->with('error', 'Something went wrong.');
        }      
    }

   // Bat Create

   public function holidaysCreate()
   { 

       try{
           $title = 'Apply Holiday';
          
           return view('backend.pages.holidaysAdd', compact('title'));
       }
       catch (\Exception $e) {
           return redirect('/admin/holidays/')->with('error', 'Something went wrong.');
       }
   }
   
   public function holidaysAdd(Request $request)
   {
    
        try{
           $coachId = auth()->user()->id;
           $data['coach_id'] =  $coachId;
           $data['start_date'] = $request->start_date;
           $data['end_date'] = $request->end_date;
           $data['reason'] =  $request->reason;
           $result =  CoachUnavailability::insert($data);  
             
           if($result){
                  return redirect('/admin/coach/holidays')->with('success', 'Apply holiday Successfully.');
           }
       }
       catch (\Exception $e) {
           // dd($e->getMessage());
           return redirect('/admin/coach/holidays')->with('error', 'Something went wrong.');
       }

   
   }

   
   public function holidaysEdit($id)
   {
       try{
           $coachesAvailData= CoachUnavailability::where('id', $id)->first();
           //$title = 'Edit';
          
           return view('backend.pages.holidaysEdit', compact('coachesAvailData'));
       }
       catch (\Exception $e) {
           return redirect('/admin/coach/holidays')->with('error', 'Something went wrong.');
       }
   }

   public function holidaysUpdate(Request $request, $id)
   {
     try{ 
      
       $coachesAvail = CoachUnavailability::findOrFail($id);
     
       $coachesAvail->start_date = $request->start_date;
       $coachesAvail->end_date = $request->end_date;
       $coachesAvail->reason = $request->reason;
      // $page->slug = Str::slug($request->title);
       $coachesAvail->save(); 
       return redirect('/admin/coach/holidays')->with('success', 'Updated successfully');
    }
    catch (\Exception $e) {
       // dd($e->getMessage());
        return redirect('/admin/coach/holidays')->with('error', 'Something went wrong.');
    }
}

 // Region Delete
    public function holidaysdelete(Request $request, $id)
        {
            try{
                $coach_av = CoachUnavailability::findOrFail($id);
                $coach_av->isDeleted = '1';
                $coach_av->save(); 
            
            return redirect('/admin/coach/holidays')->with('success', 'Deleted Successfully.');
            
            }
            catch (\Exception $e) {
                return redirect('/admin/coach/holidays')->with('error', 'Something went wrong.');

            }
        }
     
}


