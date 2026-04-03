<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class AdminWalletController extends Controller
{
    public function credit(Request $request,User $user){
        $validator = Validator::make($request->all(),['montant' => 'required|integer|min:1',
        ], [
            'montant.required' => 'Le champ montant est obligatoire.',
            'montant.integer'  => 'Le montant doit être un entier.',
            'montant.min'      => 'Le montant doit être strictement positif.',]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user->solde+=$request->montant;
        $user->save();
        return response()->json([
            'message'       => 'Crédit effectué avec succès',
            'user_id'       => $user->id,
            'nouveau_solde' => $user->solde,
        ]);
    }
    public function debit(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'montant' => 'required|integer|min:1',
        ], [
            'montant.required' => 'Le champ montant est obligatoire.',
            'montant.integer'  => 'Le montant doit être un entier.',
            'montant.min'      => 'Le montant doit être strictement positif.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if ($user->solde < $request->montant) {
            return response()->json([
                'message' => 'Solde insuffisant pour ce débit'
            ], 422);
        }

        $user->solde -= $request->montant;
        $user->save();

        return response()->json([
            'message'       => 'Débit effectué avec succès',
            'user_id'       => $user->id,
            'nouveau_solde' => $user->solde,
        ]);
    }

}
