<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MembershipResource;
use App\Laravue\Models\Barangay;
use App\Laravue\Models\City;
use App\Laravue\Models\Membership;
use App\Laravue\Models\Profile;
use App\Laravue\Models\Province;
use App\Laravue\Models\Region;
use App\Laravue\Models\Setting;
use App\Laravue\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    const ITEM_PER_PAGE = 15;

    /**
     * Display a listing of the resource.
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        // user is admin
        if ($currentUser->isAdmin()) {
            // set some params
            $data = new Membership();
            $data->status = "ADMIN";

            // get query params
            $searchParams = $request->all();
            $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
            $keyword = Arr::get($searchParams, 'title', '');
            $id = Arr::get($searchParams, 'id', '');
            $status = Arr::get($searchParams, 'status', '');
            $sort = Arr::get($searchParams, 'sort', '');

            // query for membersihp data
            $memberships = Membership::with('profile')->with('approver');

            if ($keyword != '') {
                $users = User::select('id')
                    ->where(function ($query) use ($keyword) {
                        $query->where('first_name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                    })
                    ->get();
                $ids = Arr::pluck($users, 'id');
                $memberships = $memberships->whereIn('user_id',$ids);
            }
            if ($status != '') {
                $memberships = $memberships->where('status', $status);
            }
            if ($sort != '') {
                if($sort == '-created_at'){
                    $memberships = $memberships->orderBy('status', 'DESC');
                }else{
                    $memberships = $memberships->orderBy('status', 'ASC');
                }
            }
            if ($id != '') {
                $memberships = $memberships
                    ->where('id', $id)
                    ->get();

                $region = $memberships[0]->profile->region;
                $province = $memberships[0]->profile->province;
                $city = $memberships[0]->profile->city;
                $barangay = $memberships[0]->profile->barangay;

                $provData = Province::where('provCode', $province)->get();
                $cityData = City::where('citymunCode', $city)->get();
                $brgyData = Barangay::where('brgyCode', $barangay)->get();
                $regData = Region::where('regCode', $region)->get();

                $memberships[0]->profile->regDesc = $regData[0]['regDesc'];
                $memberships[0]->profile->provDesc = $provData[0]['provDesc'];
                $memberships[0]->profile->cityDesc = $cityData[0]['citymunDesc'];
                $memberships[0]->profile->brgyDesc = $brgyData[0]['brgyDesc'];
            } else {
                $memberships = $memberships->paginate($limit);
            }

            $data->memberships = $memberships;
            $data = [$data];
        } else {
            $data = Membership::where('user_id', $currentUser->id)
                ->with('profile')
                ->with('approver')
                ->get();
            if (count($data) == 0) {
                $data = new Membership();
                $data->status = "NONE";
                $data->profile = $currentUser;
                $data = [$data];

            } else {
                $region = $data[0]->profile->region;
                $province = $data[0]->profile->province;
                $city = $data[0]->profile->city;
                $barangay = $data[0]->profile->barangay;

                $provData = Province::where('provCode', $province)->get();
                $cityData = City::where('citymunCode', $city)->get();
                $brgyData = Barangay::where('brgyCode', $barangay)->get();
                $regData = Region::where('regCode', $region)->get();

                $data[0]->profile->regDesc = $regData[0]['regDesc'];
                $data[0]->profile->provDesc = $provData[0]['provDesc'];
                $data[0]->profile->cityDesc = $cityData[0]['citymunDesc'];
                $data[0]->profile->brgyDesc = $brgyData[0]['brgyDesc'];
            }
        }
        return MembershipResource::make($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//         return $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'last_name' => ['required'],
                'first_name' => ['required'],
                'civil_status' => ['required'],
                'birth_date' => ['required'],
                'birth_place' => ['required'],
                'house_number' => ['required'],
                'barangay' => ['required'],
                'city' => ['required'],
                'province' => ['required'],
                'region' => ['required'],
                'email_address' => ['required'],
                'contact_number' => ['required'],
                'department' => ['required'],
                'service_years' => ['required'],
                'service_status' => ['required'],
                'rank_unit' => ['required'],
                'gross_income' => ['required'],
                'pay_jurisdiction' => ['required'],
                'pay_slip_account_no' => ['required'],
                'pledge_subscription' => ['required'],
                'initial_capital_payment' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $settings = Setting::where('is_active', '1')->get();
            $membership_fee = $settings[0]->membership_fee;
            $user_id = Auth::user()->id;
            $params = $request->all();
            //create profile first
            $profile = Profile::create([
                'last_name' => $params['last_name'],
                'first_name' => $params['first_name'],
                'middle_name' => $params['middle_name'],
                'civil_status' => $params['civil_status'],
                'birth_date' => $params['birth_date'],
                'birth_place' => $params['birth_place'],
                'house_number' => $params['house_number'],
                'street' => $params['street'],
                'barangay' => $params['barangay'],
                'city' => $params['city'],
                'province' => $params['province'],
                'region' => $params['region'],
                'email_address' => $params['email_address'],
                'contact_number' => $params['contact_number'],
                'department' => $params['department'],
                'department_others' => $params['department_others'],
                'service_years' => $params['service_years'],
                'service_status' => $params['service_status'],
                'rank_unit' => $params['rank_unit'],
                'gross_income' => $params['gross_income'],
                'pay_jurisdiction' => $params['pay_jurisdiction'],
                'membership_fee' => $membership_fee,
                'pay_slip_account_no' => $params['pay_slip_account_no'],
                'pledge_subscription' => $params['pledge_subscription'],
                'initial_capital_payment' => $params['initial_capital_payment'],
                'user_id' => $user_id
            ]);
            //create the membership record
            $membership = Membership::create([
                'user_id' => $user_id,
                'profile_id' => $profile->id
            ]);

            return new MembershipResource($membership);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Laravue\Models\Membership $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Laravue\Models\Membership $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Laravue\Models\Membership $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        $params = $request->all();
        $membership->status = $params['update_status'];
        $membership->approval_date = date('Y-m-d h:i:s');
        $membership->approver = Auth::user()->id;
        $membership->view = 1;
        $membership->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Laravue\Models\Membership $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
