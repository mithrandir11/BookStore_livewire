<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IAddressRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    protected $addressRepository;
    public function __construct(IAddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(Request $request){
        $validated = $request->validate([
            'full_address' => ['required','string'],
            'recipient_name' => ['required','string'],
            'phone_number' => ['required','string'],
            'city' => ['required','string'],
            'state' => ['required','string'],
            'postal_code' => ['required'],
        ]);
        $validated['user_id'] = $request->user()->id;
        $address = $this->addressRepository->create($validated);
        return Response::success(null, $address);
    }

    public function getUserAddresses(Request $request){
        $address = $this->addressRepository->getUserAddresses($request->user()->id);
        return Response::success(null, $address);
    }
}
