<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class WalletController extends Controller
{
    public function balance(){
        $user = auth('api')->user();
        return response()->json(['solde'=>$user->solde,]);
    }
    public function spend (Request $request){
        $validator = Validator::make($request->all(), [
            'montant' => 'required|integer|min:10',
        ],['montant.required' => 'Le champ montant est obligatoire.',
            'montant.integer'  => 'Le montant doit être un entier.',
            'montant.min'      => 'Le montant minimum est de 10 points.',]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $user    = auth('api')->user();
        $montant = $request->montant;

        if ($user->solde < $montant) {
            return response()->json([
                'message' => 'Solde insuffisant'
            ], 422);
        }
        $user->solde -= $montant;
        $user->save();

        return response()->json([
            'message'       => 'Dépense effectuée avec succès',
            'nouveau_solde' => $user->solde,
        ]);
    }
}
