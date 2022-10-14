<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Services\MatchesServiceImpl;
use App\Services\PlayersServiceImpl;
use App\Repositories\ClubDataRepository;
use App\Repositories\CoachesRepository;
use Carbon\Carbon;
/**
 * Class BookingServiceImpl
 *
 * @package App\Services
 */
class BookingServiceImpl implements BookingService
{
    /**
     * BookingServiceImpl constructor.
     *
     */
    public function __construct(MatchesServiceImpl $matchesServiceImpl, 
                                PlayersServiceImpl $playersServiceImpl,
                                BookingRepository $bookingRepository,
                                ClubDataRepository $clubDataRepository,
                                CoachesRepository $coachesRepository)
    {
        $this->matchesServiceImpl = $matchesServiceImpl;
        $this->playersServiceImpl = $playersServiceImpl;
        $this->bookingRepository = $bookingRepository;
        $this->clubDataRepository = $clubDataRepository;
        $this->coachesRepository = $coachesRepository;
    }


     /**
     * Method used to fetch the bookings summary list and count
     *
     * @return mixed
     */
    public function getBookingsList($request)
    {
        // Getting match data from getMatches function
        $matchData = $this->matchesServiceImpl->getBookedMatches($request);
        $bookedMatches = [];
        $userId = auth()->user()->id;

        foreach($matchData as $match) {
            $matchTime = $match['startTime'];
            $current = Carbon::now()->toDateTimeString();
            $currentDate = strtotime($current);

            // We are getting all matches above, so check on only players bookings
            if($match['booked_by'] == $userId) {
                unset($match['booked_by']);

                // If matchTime is less than currentTime, then the match is completed
                if($currentDate > $matchTime) {
                    $match['isMatchCompleted'] = 1;
                }
                array_push($bookedMatches, $match);
            }
        }

        // Sorting matches based on dates
        $bookedMatches = collect($bookedMatches)->sortBy('date')->toArray();
        return $bookedMatches;
    }

    public function addBooking($request)
    {
        $userId = auth()->user()->id;

        // Edit booking 
        if($request->isEdit == true) {

            // Validation for null booking id value
            if(!$request->booking_id) {
                return ['error' => 'Please enter the value of booking id!'];
            }

            // Validation for random booking id
            if(!$this->bookingRepository->getBookingDetails($request->booking_id)) {
                return ['error' => 'There is no match exist for this booking id!'];
            }

            // Booking array data to be filled in bookings table for updating booking date
            $bookingArray = [];
            $dateTime = $request->dateTime;
            $bookingArray['booking_date'] = date('Y-m-d', $dateTime[0]);
            $booked = $this->bookingRepository->updateBookingData($bookingArray, $request->booking_id);

            // Slots array data to be filled in slots table for updating slots
            $slotArray = [];
            foreach($dateTime as $i => $time) {
                $slotArray['slots'] = date('H:i:s', $time);
                $slot[$i] = $this->bookingRepository->updateSlotsData($slotArray, $request->booking_id);
            }

            // Match array data to be filled in matches table
            $matchArray = [];
            $matchArray['level'] = implode(',',$request->level);
            $match = $this->bookingRepository->updateMatchData($matchArray, $request->booking_id);

            return ['message' => 'Booking data updated successfully!'];
        }

        // Booking array data to be filled in bookings table
        $bookingArray = [];
        $dateTime = $request->dateTime;
        $bookingArray['user_id'] = $userId;
        $bookingArray['club_id'] = $request->club_id;
        $bookingArray['isBatBooked'] = count($request->bats) > 0 ? "1" : "0";
        $bookingArray['no_of_hours'] = count($request->dateTime);
        $bookingArray['booking_date'] = date('Y-m-d', $dateTime[0]);
        $bookingArray['order_id'] = mt_rand() . $userId;

        // Getting booked club data to calculate price and service charge
        $clubData = $this->clubDataRepository->getSingleClubData($request->club_id);
        if($request->game_type == 1) {
            $bookingPrice = ($clubData['data']['single_price'] * $bookingArray['no_of_hours']) + $clubData['data']['service_charge'] ;
        } else {
            $bookingPrice = ($clubData['data']['double_price'] * $bookingArray['no_of_hours']) + $clubData['data']['service_charge'];
        }
        $bookingArray['price'] = number_format((float)$bookingPrice, 3, '.', '');

        $bookingArray['court_type'] = $request->match_type;
        $bookingArray['currency_id'] = 129;
        $bookingArray['status'] = 1;

        //Adding bat price in booking table
        $batArray = [];
        $batPrice = 0;
        $bats = $request->bats;
        foreach($bats as $bat) {
            $batData = $this->bookingRepository->getBatDetails($bat['bat_id']);
            $batPrice += number_format((float)$batData->price * $bat['qty'], 3, '.', '');
        }
        $bookingArray['batPrice'] = $batPrice;

        //Adding coach id in booking table
        $bookingArray['coach_id'] = $request->coach_id;

        // Calculating coach price
        $coachPrice = 0;
        if($request->coach_id) {
            $coachData = $this->coachesRepository->getCoachDetails($request->coach_id);
            $coachPrice = number_format((float)$coachData->price, 3, '.', '');
        }

        //store the booking data in the database and get the booking_id for further use
        $booked = $this->bookingRepository->storeBookingData($bookingArray);

        // Adding bats in booking
        foreach($bats as $bat) {
            $batArray['booking_id'] = $booked;
            $batArray['bat_id'] = $bat['bat_id'];
            $batArray['quantity'] = $bat['qty'];
            $this->bookingRepository->storeBatsData($batArray);
        }

        // Storing booked slots in the database
        $slotArray = [];
        foreach($dateTime as $i => $time) {
            $slotArray['booking_id'] = $booked;
            $slotArray['slots'] = date('H:i:s', $time);
            $slot[$i] = $this->bookingRepository->storeSlotsData($slotArray);
        }

        // Match array data to be filled in matches table
        $matchArray = [];
        $matchArray['player_id'] = $request->player_id;
        $playersIds = $request->players;
        $matchArray['playersIds'] = implode(',',$playersIds);
        $matchArray['club_id'] = $request->club_id;
        $matchArray['booking_id'] = $booked;
        $matchArray['slot_id'] = implode(',',$slot);
        $matchArray['level'] = implode(',',$request->level);
        $matchArray['match_type'] = $request->match_type;
        $matchArray['game_type'] = $request->game_type;
        $matchArray['court_type'] = $request->court_type;
        $matchArray['is_friendly'] = $request->isFriendly;
        $matchArray['gender_allowed'] = $request->gender;
        $matchArray['status'] = "1";

        //store the match data in the database 
        $match = $this->bookingRepository->storeMatchesData($matchArray);

        // Payment array data to be filled in payments table
        $paymentArray = [];
        $paymentArray['user_id'] = $userId;
        $paymentArray['booking_id'] = $booked;
        $paymentArray['invoice'] = "E".str_replace(' ', '', time());
        $paymentArray['price'] = $bookingArray['price'] + $batPrice + $coachPrice;
        $paymentArray['payment_method'] = $request->payment_method;
        $paymentArray['isRefunded'] = "0";
        $paymentArray['isCancellationRequest'] = "0";
        $paymentArray['transaction_id'] = str_replace(' ', '', time());
        
        // Calculating total price of the booking based on coupons
        if($request->coupon_id) {
            $couponData = $this->bookingRepository->getCouponById($request->coupon_id);
            $paymentArray['coupons_id'] = $request->coupon_id;
            if($couponData->discount_type == 1) {
                $paymentArray['discount_price'] = $couponData->amount;
            } else {
                $paymentArray['discount_price'] = $couponData->amount * $paymentArray['price'] * 0.01;
            }
            $paymentArray['total_amount'] = number_format((float)$paymentArray['price'] - $paymentArray['discount_price'], 3, '.', '');
        } else {
            $paymentArray['total_amount'] = number_format((float)$paymentArray['price'], 3, '.', '');
        }
        $paymentArray['payment_status'] = "1";

        // Checking if player is using wallet for the booking
        if($request->isWallet == 0) {
            $paymentArray['wallet_amount'] = "0.000";
        } else { 
            // Getting total amount left in the wallet
            $walletAmount = $this->getWalletAmount();

            // If wallet amount is greater than 0
            if($walletAmount > "0.000") {
                if($walletAmount >= $paymentArray['total_amount']) {
                    $walletEntry = number_format((float)$paymentArray['total_amount'], 3, '.', '');
                    $moneyLeft = "0.000";
                } else {
                    $walletEntry = number_format((float)$walletAmount, 3, '.', '');
                    $moneyLeft = number_format((float)$paymentArray['total_amount'] - $walletAmount, 3, '.', '');
                }
                $walletArray = [];
                $walletArray['user_id'] = $userId;
                $walletArray['booking_id'] = $booked;
                $walletArray['currency_id'] = "129";
                $walletArray['amount'] = $walletEntry;
                $walletArray['status'] = "2";
    
                // Storing wallet transaction data in the db
                $walletLeft = $this->bookingRepository->storeTransaction($walletArray);
                $paymentArray['wallet_amount'] = $walletEntry;
            } else {
                $paymentArray['wallet_amount'] = "0.000";
            }
        }
        $paymentArray['online_amount'] = number_format((float)$paymentArray['total_amount'] - $paymentArray['wallet_amount'], 3, '.', '');
        $paymentArray['refund_price'] = "0.000";
        $paymentArray['currency_id'] = "129";
        
        // Storing payment data in the db
        $payment = $this->bookingRepository->storePaymentData($paymentArray);
        return ['message'=> 'Booking successfull'];
    }


    public function getBookingSlots($request) 
    {
        $result = [];

        // Validations for the entered values in the api
        if(!$request->date) {
            return ['message' => "Please enter a date"];
        }
        if(!$request->club_id) {
            return ['message' => "Please enter a club_id"];
        }
        if(!$request->court_type) {
            return ['message' => "Please enter a court_type"];
        }
        if($request->court_type !=1 && $request->court_type !=2) {
            return ['message' => "The court_type value either be 1 or 2."];
        }

        // Validation for the entered date
        $selectedDate = date('Y-m-d', ($request->date));
        $current = Carbon::now()->toDateString();
        $d2 = date('Y-m-d', strtotime('+30 days'));

        // Validation for the selected date, the date should be greater than current date and less than next 30 days
        if($selectedDate < $current || $selectedDate > $d2) {
            return ['message' => "Please enter a valid date."];
        }

        // Since we are getting time in GMT which is 5 hrs and 30 mins before our current time zone we have to add this time when we select the current date
        if($selectedDate == $current) {
            $time = Carbon::parse($request->date);
            $newTime = $time->addHours(5);
            $newTime = $time->addMinutes(30);
            $dateNow = Carbon::parse($newTime)->format('H:i');
        }

        // Getting booked slots 
        $data = $this->bookingRepository->getBookingSlots($selectedDate, $request->club_id);

        // Getting all the time slots when club is open
        $clubSlots = $this->bookingRepository->getClubSlots($request->club_id);
        if($clubSlots == null) {
            return ['message' => "The club_id is not exist in the database."];
        }
        $startTime = (int)$clubSlots->start_time;
        $endTime = (int)$clubSlots->end_time;

        // Getting all the time slots when the club is open
        $clubsArray = [];
        for ($i = $startTime; $i < $endTime; $i += 1) {
            $date = date("H:i", strtotime("00-00-00 $i:00:00"));
            $clubsArray[] = $date;
        }

        if(count($data) > 0) {
            $slotsArray = [];

            // Getting club data to check max courts available
            $clubData = $this->clubDataRepository->getSingleClubData($request->club_id);
            if($request->court_type == 1) {
                $maxCourts = $clubData['data']->indoor_courts;
            } elseif ($request->court_type == 2) {
                $maxCourts = $clubData['data']->outdoor_courts;
            }
    
            // Getting booked slots on particular date 
            foreach ($data as $i => $row) {
                foreach ($row['bookingSlots'] as $key => $value) {
                    $slot = $value['slots'];
                    $count = $this->bookingRepository->getCourtsCounts($request, $slot);
                    if($count == $maxCourts) {
                        $date = date("H:i", strtotime("00-00-00 $slot"));
                        $slotsArray[$key] = $date;
                    }
                }
            }

            // Getting all the time slots of the day
            for ($n = 0; $n < 24; $n+=1)
            {
                $date = sprintf('%02d:%02d', $n , $n % 1);
                $result[$n]['id'] = $n + 1;
                $result[$n]['slot'] = $date;

                // Timings when club is open
                if(in_array($date, $clubsArray)) {
                    $result[$n]['isAvailable'] = true;
                } else { 
                    // Timings when club is closed
                    $result[$n]['isAvailable'] = false;
                }

                // Timings when slots is booked
                if (in_array($date, $slotsArray) ) {
                    $result[$n]['isAvailable'] = false;
                }

                // Timings when current time is exceed the slots
                if($selectedDate == $current) {
                    if($date < $dateNow) {
                        $result[$n]['isAvailable'] = false;
                    }
                }
            }
        } else {
            // Getting all the time slots of the day
            for ($n = 0; $n < 24; $n+=1)
            {
                $date = sprintf('%02d:%02d', $n , $n % 1);
                $result[$n]['id'] = $n + 1;
                $result[$n]['slot'] = $date;
                                
                // Timings when club is open
                if(in_array($date, $clubsArray)) {
                    $result[$n]['isAvailable'] = true;
                } else {
                    // Timings when club is closed
                    $result[$n]['isAvailable'] = false;
                }

                // Timings when current time is exceed the slots
                if($selectedDate == $current) {
                    if($date < $dateNow) {
                        $result[$n]['isAvailable'] = false;
                    }
                }
            }
        }
        return $result;
    }

    public function getWalletAmount()
    {
        // Getting wallet data from the db
        $data = $this->bookingRepository->getWalletData();
        $wallet_amount = 0;
        $amount_refund = 0;
        $amount_booked = 0;
        foreach($data as $amount) {
            //Calculating refund amout from the wallet
            if($amount->status == 1) {
                $amount_refund += $amount['amount'];
            } else {
                //Calculating booking amout from the wallet
                $amount_booked += $amount['amount'];
            }
            $wallet_amount = $amount_refund > $amount_booked ? number_format((float)$amount_refund - $amount_booked, 3, '.', '') : "0.000";
        }
        return $wallet_amount;
    }

    public function getWallet()
    {
        // Get wallet data from the db
        $data = $this->bookingRepository->getWalletData();
        $dataArray = [];

        // Making an array of all wallet transactions
        foreach($data as $i => $row) {
            $dataArray[$i]['booking_id'] = $row['booking_id'];
            $dataArray[$i]['status'] = $row['status'];
            $dataArray[$i]['amount'] = $row['amount'];
            $dataArray[$i]['date'] = $row['created_at']->toDateString();
        }
        return $dataArray;
    }

    public function getCoupons()
    {
        $lang = auth()->user()->lang;

        $data = $this->bookingRepository->getCoupons();
        $dataPacket = [];
        $dataArray = [];

        foreach($data as $i => $row) {
            $dataArray[$i]['id'] = $row['id'];

            // Getting name and code of the coupon based on the selected language
            if($lang == "en") {
                $dataArray[$i]['name'] = $row['name'];
                $dataArray[$i]['code'] = $row['code'];
            } elseif ($lang == "ar") {
                $dataArray[$i]['name'] = $row['name_arabic'];
                $dataArray[$i]['code'] = $row['code_arabic'];
            }
            
            if($row['discount_type'] == 1) {
                $dataArray[$i]['amount'] = $row['amount'];
            } else {
                $dataArray[$i]['amount'] = number_format($row['amount'],0,'.','');
            }
            $dataArray[$i]['minimum_amount'] = $row['minimum_amount'];
            $dataArray[$i]['discount_type'] = $row['discount_type'];
            $dataArray[$i]['no_of_times'] = $row['no_of_times'];
            $dataArray[$i]['no_of_users_used'] = $row['no_of_users_used'];

            // Here $coupons['max_users'] is number of users used a coupon, $row['no_of_users_used'] is total number of times coupon can be used
            // Here $coupons['isUsed'] is number of times a user is used a particular coupon , $row['no_of_times'] is the number of times coupon can be used by a user
            // Checking number of times coupons in used
            $coupons = $this->bookingRepository->getCouponsCount($row['id']);
            if($coupons['max_users'] < $row['no_of_users_used']) {
                if($coupons['isUsed'] < $row['no_of_times']) {
                    array_push($dataPacket, $dataArray[$i]);
                }
            }
        }
        return $dataPacket;
    }

    public function applyCoupon($request)
    {
        $finalPacket = [];

        // Getting club details to calculate club price
        $clubData = $this->clubDataRepository->getSingleClubData($request->club_id);
        if($request->game_type == 1) {
            $bookingPrice = $clubData['data']['single_price'] * count($request->dateTime);
        } else {
            $bookingPrice = $clubData['data']['double_price'] * count($request->dateTime);
        }
        $finalPacket['club_price'] = number_format((float)$bookingPrice, 3, '.', '');
        
        // Service Charge
        $finalPacket['service_charge'] = number_format((float)$clubData['data']['service_charge'], 3, '.', '');

        //Adding bat price in booking table
        $batPrice = 0;
        $bats = $request->bats;
        foreach($bats as $bat) {
            $batData = $this->bookingRepository->getBatDetails($bat['bat_id']);
            $batPrice += number_format((float)$batData->price * $bat['qty'], 3, '.', '');
        }

        // Calculating coach price
        $coachPrice = 0;
        if($request->coach_id) {
            $coachData = $this->coachesRepository->getCoachDetails($request->coach_id);
            $coachPrice = number_format((float)$coachData->price, 3, '.', '');
        }

        $finalPacket['batPrice'] = number_format((float)$batPrice, 3, '.', '');
        $finalPacket['coachPrice'] = number_format((float)$coachPrice, 3, '.', '');
        $finalPacket['sub_total'] = number_format((float)$batPrice + (float)$coachPrice + $bookingPrice, 3, '.', '');
        
        if($request->coupon_id) {
            $couponData = $this->bookingRepository->getCouponById($request->coupon_id);

            // Condition for invalid coupon id
            if(!$couponData) {
                return ['message' => 'No coupon for this coupon_id'];
            }

            $finalPacket['coupons_id'] = $request->coupon_id;
            $finalPacket['coupon_name'] = $couponData->code;
            
            // Check on discount_type. If it is 1, then it is amount, if it is 2, then it is percentage.
            if($couponData->discount_type == 1) {
                $finalPacket['isPercentage'] = false;
                $finalPacket['discount_price'] = $couponData->amount;
            } else {
                $finalPacket['isPercentage'] = true;
                $finalPacket['discount_price'] = number_format((float)($couponData->amount) * ($finalPacket['sub_total'] + $finalPacket['service_charge']) * (0.01), 3, '.', '');
            }

            // Calculating total amount to be paid
            $finalPacket['total_amount'] = number_format((float)$finalPacket['sub_total'] + $finalPacket['service_charge'] - $finalPacket['discount_price'], 3, '.', '');
            
            // Calculating amount to be used from the wallet
            $finalPacket['wallet_amount'] = number_format((float)$this->getWalletAmount(), 3, '.', '');
            if($finalPacket['wallet_amount'] == "0.000") {
                $finalPacket['wallet_amount'] = "";
            }
        } else {
            // In case we want to remove the coupon 
            $finalPacket['coupons_id'] = $request->coupon_id;
            $finalPacket['coupon_name'] = "";
            $finalPacket['isPercentage'] = false;
            $finalPacket['discount_price'] = "";
            $finalPacket['total_amount'] = number_format((float)$finalPacket['sub_total'] + $finalPacket['service_charge'], 3, '.', '');
            $finalPacket['wallet_amount'] = number_format((float)$this->getWalletAmount(), 3, '.', '');
            if($finalPacket['wallet_amount'] == "0.000") {
                $finalPacket['wallet_amount'] = "";
            }
        }
        return $finalPacket;
    }
}