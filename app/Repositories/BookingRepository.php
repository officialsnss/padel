<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Booking; 
use App\Models\BookingSlots; 
use App\Models\TimeSlots; 
use App\Models\Wallets; 
use App\Models\Coupons; 
use App\Models\Payment; 
use App\Models\Matches; 
use App\Models\BookedBats; 
use App\Models\VendorBats; 
use DB;

/**
 * Class BookingRepository
 */
class BookingRepository extends BaseRepository
{
    public function __construct()
    {
    }

    /**
     * Method used to fetch the Bookings Data
     *
     * @param $request
     *
     * @return mixed
     */
    public function storeBookingData($booking)
    {
      $data = Booking::create($booking); 
      return $data->id;
    }

    public function storeSlotsData($slot)
    {
      $data = BookingSlots::create($slot); 
      return $data->id;
    }

    public function storeBatsData($bat)
    {
      return BookedBats::create($bat); 
    }

    public function storeMatchesData($match)
    {
      return Matches::create($match);
    }

    public function getBookingSlots($date, $club_id)
    {
      return Booking::where('booking_date', $date)
                      ->where('club_id', $club_id)
                      ->where('status','!=', 3)
                      ->with('bookingSlots')
                      ->with('clubs')
                      ->get(); 
    }

    public function getCourtsCounts($request, $slots) 
    {
      $outsideBooking = DB::table('outside_bookings')
                        ->where(['club_id'=> $request->club_id, 'booking_date'=> date('Y-m-d', $request->date),'court_type' => $request->court_type])
                        ->where('slot', $slots)
                        ->count();
      $insideBooking = Booking::leftJoin('booking_slots','booking_slots.booking_id', '=','bookings.id')
                        ->where(['bookings.booking_date'=> date('Y-m-d', $request->date),'bookings.court_type' => $request->court_type,'bookings.club_id' => $request->club_id])
                        ->where('booking_slots.slots', $slots)
                        ->count();
      return $insideBooking + $outsideBooking;
    }

    public function getClubSlots($clubId)
    {
      return TimeSlots::where('club_id', $clubId)->first();
    }

    public function getWalletData()
    {
        $userId = auth()->user()->id;
        return Wallets::where('user_id', $userId)->get();
    }

    public function getCoupons()
    {
        return Coupons::where('status', "1")->get();
    }

    public function getCouponById($coupon_id)
    {
        return Coupons::where('status', "1")->where('id', $coupon_id)->first();
    }

    public function getCouponsCount($id)
    {
        $userId = auth()->user()->id;
        $max_users = Payment::where('coupons_id', $id)
                              ->count();
        $isUsed = Payment::where('coupons_id', $id)
                              ->where('user_id', $userId)
                              ->count();
        return ['max_users' => $max_users, 'isUsed' => $isUsed];
    }

    public function storeTransaction($wallet) 
    {
      return Wallets::create($wallet);
    }

    public function storePaymentData($payment) 
    {
      return Payment::create($payment);
    }

    public function getBatDetails($bat_id)
    {
      return VendorBats::where('bat_id', $bat_id)
              ->first(); 
    }

    public function getBookingDetails($booking_id)
    {
      return Booking::where('id', $booking_id)
              ->first();
    }
    
    public function updateBookingData($data, $booking_id)
    {
      return Booking::where('id', $booking_id)
              ->update($data);
    }
    
    public function updateSlotsData($data, $booking_id)
    {
      return BookingSlots::where('booking_id', $booking_id)
              ->update($data);
    }

    public function updateMatchData($data, $booking_id)
    {
      return Matches::where('booking_id', $booking_id)
              ->update($data);
    }

    public function getBookingByDate($date)
    {
      return Booking::where(['booking_date'=> date('Y-m-d', $date)])
                ->with('bookingSlots')->whereHas('bookingSlots', function ($q) use ($date) {
                      $q->where('slots', '=', date('H:i:s', $date));
                })->get();
    }
}