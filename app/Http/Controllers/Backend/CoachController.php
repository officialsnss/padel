<?php
namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use File;
use App\Models\Club;
use App\Models\User;
use App\Models\Coach;
use App\Models\Booking;
use App\Models\CoachUnavailability;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Redirect;
class CoachController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index()
    {
        try{
            $title = 'Coaches Listing';
            $coaches =  Coach::leftJoin('users','users.id','=' ,'coaches_details.user_id')
                     ->leftJoin('currencies', 'currencies.id' ,'=', 'coaches_details.currency_id')
                    //  ->where('coaches_details.status', '1')
                     ->where('coaches_details.isDeleted', '0')
                     ->select('coaches_details.*','users.*','currencies.code as currencyCode','coaches_details.id as cid','coaches_details.status as coachstatus')
                     ->get();
           return view('backend.pages.coaches', compact('title','coaches'));
        }
        catch (\Exception $e) {
          dd($e->getMessage());
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
        $request->validate([
            'coach_email'=> 'required|email|unique:users,email',

        ]);

         try{
            $data['name'] = $request->coach_name;
            $data['name_arabic'] = $request->name_arabic;
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
                  'arabic_description' => $request->arabic_description,
                  'price' => $request->price,
                  'currency_id' => 129,
                  'clubs_assigned' => $ids

              ]);

             }

            if($final){
                   return redirect('/admin/coaches')->with('success', 'Coach Added Successfully.');
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
        $coach = Coach::findOrFail($id);
        $user = User::where('id', $coach->user_id)->first();
        $request->validate([
            'coach_email'=> 'required|email|unique:users,email,'.$user->id,

        ]);
         try{



           $user['name'] = $request->coach_name;
           $user['email'] = $request->coach_email;
           $user['name_arabic'] = $request->name_arabic;
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
                $coach['arabic_description'] = $request->arabic_description;
                $coach['clubs_assigned'] = $ids;
                $coach->save();
            }
           return redirect('/admin/coaches')->with('success', 'Coach Updated successfully');
        }
        catch (\Exception $e) {
           // dd($e->getMessage());
            return redirect('/admin/coaches')->with('error', 'Something went wrong.');
        }
    }


    public function holidays()
    {
        try{
            $title = 'Off Days';
            $coachId = auth()->user()->id;

            $holidays =  CoachUnavailability::leftJoin('users','users.id','=' ,'coaches_unavailability.coach_id')
                     ->where('coaches_unavailability.isDeleted', '0')
                     ->select('coaches_unavailability.*','users.*','coaches_unavailability.id as cid','coaches_unavailability.status as cstatus');

           $holidays = $holidays->where('coaches_unavailability.coach_id', $coachId);
           $holidays = $holidays->get();
           return view('backend.pages.holidays', compact('title','holidays'));
        }
        catch (\Exception $e) {

            return redirect('/admin')->with('error', 'Something went wrong.');
        }
    }

    public function offDays($id)
    {
        try{
            $title = 'Off Days';

            $holidays =  CoachUnavailability::leftJoin('users','users.id','=' ,'coaches_unavailability.coach_id')
                     ->where('coaches_unavailability.isDeleted', '0')
                     ->select('coaches_unavailability.*','users.*','coaches_unavailability.id as cid','coaches_unavailability.status as cstatus')
                     ->where('coaches_unavailability.coach_id', $id)
                   //  ->where('coaches_unavailability.status', '2');
                      ->get();
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
           $title = 'Apply off';

           return view('backend.pages.holidaysAdd', compact('title'));
       }
       catch (\Exception $e) {
           return redirect('/admin/off-days/')->with('error', 'Something went wrong.');
       }
   }

   public function holidaysAdd(Request $request)
   {
        try{
            $coachId = auth()->user()->id;

            if($request->leave_type == 2 && !empty($request->day_start_date)){
                $start_date = $request->day_start_date;
            } elseif($request->leave_type == 1 && !empty($request->start_date)) {
                $start_date = $request->start_date;
            } else {
                return redirect('/admin/off-days')->with('error', 'Start date cannot be empty.');
            }

            $isBooking = Booking::where('coach_id', $coachId)
                             ->whereBetween('booking_date', [$start_date, $request->end_date])
                             ->whereIn('status', [1,2])
                            ->count();
            // dd($start_date);


          if($isBooking > 0){
            return Redirect::back()->with('error', 'Sorry, You cannot apply off as you have already booked.');
          }
          else{
            $data['coach_id'] =  $coachId;
            $data['start_date'] = $start_date;
            $data['end_date'] = $request->end_date;
            $data['start_time'] = $request->start_time;
            $data['end_time'] = $request->end_time;
            $data['type'] = $request->leave_type;
            $data['reason'] =  $request->reason;
            $data['status'] =  '2';
            $result =  CoachUnavailability::insert($data);
            if($result){
                    return redirect('/admin/off-days')->with('success', 'Apply holiday Successfully.');
            }
        }
       }
       catch (\Exception $e) {
           dd($e->getMessage());
           return redirect('/admin/off-days')->with('error', 'Something went wrong.');
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
           return redirect('/admin/off-days')->with('error', 'Something went wrong.');
       }
   }

   public function holidaysUpdate(Request $request, $id)
   {

     try{

       $coachesAvail = CoachUnavailability::findOrFail($id);
       if($request->leave_type == 2 && !empty($request->day_start_date)){
        $start_date = $request->day_start_date;
        $end_date = null;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        } elseif($request->leave_type == 1 && !empty($request->start_date)) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $start_time = null;
            $end_time = null;
        } else {
            return redirect('/admin/off-days')->with('error', 'Start date cannot be empty.');
        }

       $coachesAvail->start_date = $start_date;
       $coachesAvail->end_date = $end_date;
       $coachesAvail->start_time = $start_time;
       $coachesAvail->end_time = $end_time;
       $coachesAvail->type = $request->leave_type;
       $coachesAvail->reason = $request->reason;
      // $page->slug = Str::slug($request->title);
       $coachesAvail->save();
       return redirect('/admin/off-days')->with('success', 'Updated successfully');
    }
    catch (\Exception $e) {
       dd($e->getMessage());
        return redirect('/admin/off-days')->with('error', 'Something went wrong.');
    }
}

 // Delete
    public function holidaysdelete(Request $request, $id)
        {
            try{
                $coach_av = CoachUnavailability::findOrFail($id);
                $coach_av->isDeleted = '1';
                $coach_av->save();

            return redirect('/admin/off-days')->with('success', 'Deleted Successfully.');

            }
            catch (\Exception $e) {
                return redirect('/admin/off-days')->with('error', 'Something went wrong.');

            }
        }

         // Delete
    public function holidaysApprove(Request $request, $id)
    {
        try{
            $coach_av = CoachUnavailability::findOrFail($id);
            $coach_av->status = '1';
            $coach_av->save();

        return redirect()->back()->with('success', 'Leave Approved Successfully.');

        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');

        }
    }
      // Delete
      public function holidaysReject(Request $request, $id)
      {
          try{
              $coach_av = CoachUnavailability::findOrFail($id);
              $coach_av->status = '0';
              $coach_av->save();

          return redirect()->back()->with('success', 'Leave Rejected.');

          }
          catch (\Exception $e) {
              return redirect()->back()->with('error', 'Something went wrong.');

          }
      }

        // Reset Password
        public function resetPassword(Request $request, $id)
        {
           try{
                $user = User::findOrFail($id);
                $userId = $id;
                $userEmail = $user->email;
                $title = 'Reset Password';
                return view('backend.pages.coach.resetPassword', compact('title', 'userEmail','userId'));
           }
           catch (\Exception $e) {
              return redirect('/admin/coaches')->with('error', 'Something went wrong.');
           }
        }

        // Reset Password
        public function newPassword(Request $request, $id)
        {
            // dd($request->all());

                $request->validate([
                    'password' => 'required|min:8',
                    'password_confirmation' => 'required|same:password'
                ]);
              try{
                $user = User::findOrFail($id);
                $user->password = bcrypt($request->password);

                $user->save();

                return redirect('/admin/coaches')->with('success', 'Password reset successfully');
            }
            catch (\Exception $e) {
                return redirect('/admin/coaches')->with('error', 'Something went wrong.');
             }

        }

    // Coach Status Updation
    public function updateStatus(Request $request)
    {
        try{
            $coach = Coach::findOrFail($request->id);
            $coach->status = $request->status;
            $coach->save();
            return response()->json(['message' => 'Status updated successfully.']);
        }
        catch (\Exception $e) {
            return redirect('/admin/coaches')->with('error', 'Something went wrong.');
        }
    }
}


