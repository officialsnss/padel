<?php
namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use File;
use App\Models\Bat;
use App\Models\VendorBats;
use App\Models\Club;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BatController extends Controller
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
            $title = 'Bats Listing';
            $bats =  Bat::get();
           return view('backend.pages.bat', compact('title','bats'));
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
            $title = 'Create Bat';
            return view('backend.pages.batCreate', compact('title'));
        }
        catch (\Exception $e) {
            return redirect('/admin/bats/')->with('error', 'Something went wrong.');
        }
    }


    public function add(Request $request)
    {
    //    $request->validate([
    //          'bat_name' => 'required|string',
    //        //  'description' => 'required|string',
    //  ]);

         try{
            $data['name'] = $request->bat_name;
            $data['description'] = $request->desc;
            $data['name_arabic'] = $request->name_arabic;
            $data['description_arabic'] = $request->desc_arabic;

             if($request->file('featured_image')){
                $file= $request->file('featured_image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move(base_path('Images/bat_images'), $filename);
                $data['featured_image']= $filename;
                 }
               $result =  Bat::insert($data);

            if($result){
            return redirect('/admin/bats')->with('success', 'Bat Created Successfully.');
            }
        }
        catch (\Exception $e) {
           // dd($e->getMessage());
            return redirect('/admin/bats')->with('error', 'Something went wrong.');
        }


    }

    //  Delete
    public function delete(Request $request, $id)
    {
        try{
            $bats = Bat::findOrFail($id);
            $bats->status = '2';
            $bats->save();

           return redirect('/admin/bats')->with('success', 'Deleted Successfully.');

        }
        catch (\Exception $e) {
            return redirect('/admin/bats')->with('error', 'Something went wrong.');

         }
    }

    public function edit($id)
    {
        try{
            $batData= Bat::where('id', $id)->first();
            $title = 'Edit Bat';
            return view('backend.pages.batEdit', compact('title','batData'));
        }
        catch (\Exception $e) {
            return redirect('/admin/bats')->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request, $id)
       {

            // $request->validate([
            //     'bat_name' => 'required|string',

            // ]);
        try{

           $bat = Bat::findOrFail($id);
          // $data = $request->except('_method','_token','submit');

           if($request->file('featured_image')){
             if($bat->featured_image){
                $imagePath = base_path('Images/bat_images/'. $bat->featured_image);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }
            }
            $file= $request->file('featured_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(base_path('Images/bat_images'), $filename);
            $bat->featured_image= $filename;
             }
           $bat->name = $request->bat_name;
           $bat->description = $request->desc;
           $bat->name_arabic = $request->name_arabic;
           $bat->description_arabic = $request->desc_arabic;
          // $page->slug = Str::slug($request->title);
           $bat->save();
           return redirect('/admin/bats')->with('success', 'Bat Updated successfully');
        }
        catch (\Exception $e) {
            //dd($e->getMessage());
            return redirect('/admin/bats')->with('error', 'Something went wrong.');
        }
    }

    //Vendor Bats
    public function vendorBats()
    {
        try{
            $title = 'Bats';
            $userId = auth()->user()->id;
            $club =  Club::where('user_id',$userId)
                     ->first();
            $clubId = $club->id;
            $bats =  VendorBats::leftJoin('bats','bats.id','=', 'vendor_bats.bat_id')
                     ->leftJoin('currencies', 'currencies.id' ,'=', 'vendor_bats.currency_id')
                     ->where('vendor_bats.club_id', $clubId)
                     ->select('vendor_bats.id as batid', 'currencies.*','vendor_bats.*','bats.*')
                     ->get();
           return view('backend.pages.vendorBats', compact('title','bats'));
        }
        catch (\Exception $e) {
         // dd($e->getMessage());
            return redirect('/admin')->with('error', 'Something went wrong.');
        }
    }

    //Vendor Bat Create
    public function vendorCreate()
    {
        try{
            //$title = '';
            $bats =  Bat::where('status', 1)->get();
            return view('backend.pages.vendorBatCreate', compact('bats'));
        }
        catch (\Exception $e) {
            return redirect('/admin/vendor/bats/')->with('error', 'Something went wrong.');
        }
    }

    public function vendorAdd(Request $request)
    {
      try{
            $userId = auth()->user()->id;
            $club =  Club::where('user_id',$userId)
                     ->first();
            $clubId = $club->id;
            $data['club_id'] =  $clubId;
            $data['bat_id'] = $request->bat_id;
            $data['price'] = $request->price;
            $data['currency_id'] = '129';
            $data['quantity'] = $request->quantity;

            $result =  VendorBats::insert($data);

            if($result){
            return redirect('/admin/vendor/bats')->with('success', 'Added Successfully.');
            }
        }
        catch (\Exception $e) {
            //dd($e->getMessage());
            return redirect('/admin/vendor/bats')->with('error', 'Something went wrong.');
        }


    }

    public function vendorEdit($id)
    {
        try{
            $batData= VendorBats::where('id', $id)->first();
            $bats =  Bat::where('status', 1)->get();
            return view('backend.pages.vendorBatEdit', compact('batData','bats'));
        }
        catch (\Exception $e) {
            //dd($e->getMessage());
            return redirect('/admin/vendor/bats')->with('error', 'Something went wrong.');
        }
    }


    public function vendorUpdate(Request $request, $id)
    {


     try{

        $vendorbats = VendorBats::findOrFail($id);
        $userId = auth()->user()->id;
        $club =  Club::where('user_id',$userId)
        ->first();
        $clubId = $club->id;
        $vendorbats->club_id =  $clubId;
        $vendorbats->bat_id = $request->bat_id;
        $vendorbats->price = $request->price;
        $vendorbats->quantity = $request->quantity;
        $userId = auth()->user()->id;

       // $page->slug = Str::slug($request->title);
        $vendorbats->save();
        return redirect('/admin/vendor/bats')->with('success', 'Updated successfully');
     }
     catch (\Exception $e) {
         //dd($e->getMessage());
         return redirect('/admin/vendor/bats')->with('error', 'Something went wrong.');
     }
    }

    // Bat Status Updation
    public function updateStatus(Request $request)
    {
        try{
            $coach = Bat::findOrFail($request->id);
            $coach->status = $request->status;
            $coach->save();
            return response()->json(['message' => 'Status updated successfully.']);
        }
        catch (\Exception $e) {
            return redirect('/admin/coaches')->with('error', 'Something went wrong.');
        }
    }



}


