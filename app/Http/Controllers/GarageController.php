<?php


namespace App\Http\Controllers;

use JWTAuth;
use App\Models\Garage;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GarageController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }



    public function index()
    {

        return Garage::all();
        /*
        return $this->user
            ->Garage()
            ->get(['id', 'city', 'street', 'b_number', 'capacity','name'])
            ->toArray(); */
    }



    public function show($id)
    {

       return Garage::find($id);
        /* $Garage = $this->user->garages()->find($id);

        if (!$Garage) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product with id ' . $id . ' cannot be found'
            ], 400);
        }

        return $Garage;*/
    }

    public function store(Request $request)
    {
        // dd($request->city);
        //dd($request->is_owner);
        $this->validate($request, [
            'id' => 'required',
            'city' => 'required',
            'street' => 'required',
            'b_number' => 'required',
            'capacity' => 'required',
            'name' => 'required'
        ]);

        // Create using when you have timestamps auto insert
        $garage = Garage::create([
            'name' => $request->name,
            'city' => $request->city,
            'street' => $request->street,
            'b_number' => $request->b_number,
            'capacity' => $request->capacity,
            'owner_id' => $request->user()->id
        ]);

        // When not have timestamps ( Created_at and Updated_at )
        // $garage = Garage::insert([
         //   'name' => $request->name,
         //   'city' => $request->city,
         //   'street' => $request->street,
         //  'b_number' => $request->b_number,
        //  'capacity' => $request->capacity
        // ]);

        if($garage) {
            return response()->json([
                'success' => true,
                'garage' => $garage
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, garage could not be added'
            ], 500);
        }
    }




    public function update(Request $request, $id)
    {
        // dd($request->city);
        //dd($request->is_owner);

        $garage = Garage::find($id);

        $garage -> name = $request -> name;
        $garage -> city = $request -> city;
        $garage -> street = $request -> street;
        $garage -> b_number = $request -> b_number;
        $garage -> capacity = $request -> capacity;

        if ($garage -> update())
        {
            return response() -> json(['status' => 'success']);
        } else {
            return response() -> json(['status' => 'can not be updated']);
        }

    }

    public function destroy( $id)
{

    $garage = Garage::find($id);
    if ($garage -> delete())
    {
        return response() -> json(['status' => 'success']);
    } else {
        return response() -> json(['status' => 'can not be updated']);
    }




}

}
