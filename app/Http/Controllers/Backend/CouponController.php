<?php
namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use File;
use App\Models\Bat;
use App\Models\VendorBats;
use App\Models\Club;
use App\Models\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CouponController extends Controller
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
            $title = 'Coupons Listing';
            $coupons =  Coupon::leftJoin('currencies', 'currencies.id' ,'=', 'coupons.currency_id')
                      ->select('coupons.*', 'currencies.code as ccode')
                      ->get();
        return view('backend.pages.coupons', compact('title','coupons'));
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
            $title = 'Create Coupon';
            return view('backend.pages.couponCreate', compact('title'));
        }
        catch (\Exception $e) {
            return redirect('/admin/coupons/')->with('error', 'Something went wrong.');
        }
    }


    public function add(Request $request)
    {


         try{

            $data = $request->except('_method','_token','submit');
            $data['currency_id'] = '129';
               $result =  Coupon::insert($data);

            if($result){
            return redirect('/admin/coupons')->with('success', 'Coupons Created Successfully.');
            }
        }
        catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect('/admin/coupons')->with('error', 'Something went wrong.');
        }


    }

    //  Delete
    public function delete(Request $request, $id)
    {
        try{
            $coupon = Coupon::findOrFail($id);
            $currentStatus = $coupon->status;
            if($currentStatus == '1'){
                $coupon->status = '2';
            }
            else {
              $coupon->status = '1';
            }
            $coupon->save();

           return redirect('/admin/coupons')->with('success', 'Status Updated Successfully.');

        }
        catch (\Exception $e) {
            return redirect('/admin/coupons')->with('error', 'Something went wrong.');

         }
    }

    public function edit($id)
    {
        try{
            $couponData= Coupon::where('id', $id)->first();
            $title = 'Edit Coupon';
            return view('backend.pages.couponEdit', compact('title','couponData'));
        }
        catch (\Exception $e) {
            return redirect('/admin/coupons')->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request, $id)
       {

        try{

           $coupon = Coupon::findOrFail($id);
           $data = $request->except('_method','_token','submit');
           $coupon->update($data);
           return redirect('/admin/coupons')->with('success', 'Coupons Updated successfully');
        }
        catch (\Exception $e) {
           // dd($e->getMessage());
            return redirect('/admin/coupons')->with('error', 'Something went wrong.');
        }
    }




}


