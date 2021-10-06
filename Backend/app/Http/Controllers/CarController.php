<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use Illuminate\Support\Carbon;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cars::orderBy('created_at', 'ASC')->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'car.CarMake' => 'required',
            'car.Model' => 'required',
            'car.Year' => 'required|integer|between:1870,2021',
            'car.CarPlate' => 'required|max:15',
            'car.CarReviewDateTo' => 'required|date|date_format:Y-m-d',
            'car.InsuranceTo' => 'required|date|date_format:Y-m-d',
            'car.Milage' => 'required|integer|between:1,5000000',
            'car.OilChangeDate' => 'required|date|date_format:Y-m-d'
        ]);

        $newCar = new Cars;
        $newCar->CarMake = $request->car["CarMake"];
        $newCar->Model = $request->car["Model"];
        $newCar->Year = $request->car["Year"];
        $newCar->CarPlate = $request->car["CarPlate"];
        $newCar->CarReviewDateTo = $request->car["CarReviewDateTo"];
        $newCar->InsuranceTo = $request->car["InsuranceTo"];
        $newCar->Milage = $request->car["Milage"];
        $newCar->OilChangeDate = $request->car["OilChangeDate"];
       
        $newCar->save();

        return $newCar;

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Car = Cars::find($id);

        if($Car){

            return $Car;
        }else{
            return "Nie znaleziono pojazdu.";
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'car.CarMake' => 'required',
            'car.Model' => 'required',
            'car.Year' => 'required|integer|between:1870,2021',
            'car.CarPlate' => 'required|max:15',
            'car.CarReviewDateTo' => 'required|date|date_format:Y-m-d',
            'car.InsuranceTo' => 'required|date|date_format:Y-m-d',
            'car.Milage' => 'required|integer|between:1,5000000',
            'car.OilChangeDate' => 'required|date|date_format:Y-m-d'
        ]);
        
        $existingCar = Cars::find($id);
        
        if($existingCar){
            $existingCar->CarMake = $request->car["CarMake"];
            $existingCar->Model = $request->car["Model"];
            $existingCar->Year = $request->car["Year"];
            $existingCar->CarPlate = $request->car["CarPlate"];
            $existingCar->CarReviewDateTo = $request->car["CarReviewDateTo"];
            $existingCar->InsuranceTo = $request->car["InsuranceTo"];
            $existingCar->Milage = $request->car["Milage"];
            $existingCar->OilChangeDate = $request->car["OilChangeDate"];
            
            $existingCar->save();

            return $existingCar;
        }

        return response('Vehicle not found.', 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carToDelete = Cars::find($id);

        if($carToDelete){
            $carToDelete->delete();

            return response('Vehicle has been deleted.', 200);
        }
        return response('Vehicle not found.', 400);

    }
}
