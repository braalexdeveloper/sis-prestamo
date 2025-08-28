<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::all();
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        return view('loans.create');
    }



    /* public function getClientByDni(Request $request)
{
    try {
        //$dni = $request->input('dni');
        $dni = $request->dni;
        $client = Client::where('dni', $dni)->first();

        if ($client) {
            return response()->json([
                'status' => 'success',
                'client' => $client
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Cliente no encontrado'
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
}*/

    public function getClientByDni(Request $request)
    {
        try {
            $dni = $request->dni;
            $client = Client::where('dni', $dni)->first();

            if ($client) {
                return response()->json([
                    'status' => 'success',
                    'client' => $client
                ])->header('Content-Type', 'application/json'); // ← FORZAR JSON
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cliente no encontrado'
                ])->header('Content-Type', 'application/json'); // ← FORZAR JSON
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500)->header('Content-Type', 'application/json'); // ← FORZAR JSON
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "client_id" => 'required',
            "user_id"=>'required',
            "amount" => 'required|numeric',
            "interest_rate" => 'required|numeric',
            "start_date" => 'required',
            "due_date" => 'required'
        ]);
    
        Loan::create([
            "client_id" => $request->client_id,
            "user_id"=>Auth::id(),
            "amount" => $request->amount,
            "interest_rate" => $request->interest_rate,
            "start_date" => $request->start_date,
            "due_date" => $request->due_date,
        ]);

        return redirect()->route('loans.index')->with('success', "Prestamo creado correctamente!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loan=Loan::findOrFail($id);

        return view('loans.edit',compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
             "amount" => 'required|numeric',
            "interest_rate" => 'required|numeric',
            "start_date" => 'required',
            "due_date" => 'required',
            "status"=>'required'
        ]);
    
        $loan=Loan::findOrFail($id);
       
        $loan->amount=$request->amount;
        $loan->interest_rate=$request->interest_rate;
        $loan->start_date=$request->start_date;
        $loan->due_date=$request->due_date;
        $loan->status=$request->status;

        $loan->save();

        return redirect()->route('loans.index')->with('success', "Prestamo actualizado correctamente!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loan=Loan::findOrFail($id);

        $loan->delete();
        return redirect()->route('loans.index')->with('success', "Prestamo eliminado correctamente!");
    }
}
