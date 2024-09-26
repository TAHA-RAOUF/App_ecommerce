<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\commane;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; // Assure-toi que le modèle Product est importé


class commande extends Controller
{
    public function showUserCommands($userId)
{
    $user = User::with('commands')->findOrFail($userId);

    return view('user.commands', compact('user'));
}
public function storeCommand(Request $request, $userId)
{
    $user = User::findOrFail($userId);
    
    $command = new commane();
    $command->command_number = 'CMD' . strtoupper(Str::random(10));
    $command->total_price = $request->input('total_price');
    $command->status = 'pending';
    $command->user()->associate($user); // Associate the user with the command
    $command->save();
    
    return redirect()->back()->with('success', 'Command placed successfully!');
}
public function showWelcome()
{
    // Récupérer l'utilisateur authentifié
    $user = auth()->user();

    // Passer l'utilisateur à la vue
    return view('welcome', compact('user'));
}
public function store(Request $request)
{
    // Valider les données envoyées
    $request->validate([
        'product_id' => 'required|integer',
        'quantity' => 'required|integer|min:1',
    ]);

    // Récupérer le produit correspondant à l'ID envoyé
    $product = Product::findOrFail($request->product_id);
    
    // Calculer le prix total
    $pricePerUnit = $product->price; // Prix récupéré dynamiquement du produit
    $totalPrice = $pricePerUnit * $request->quantity;

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Créer une nouvelle commande
    $commande = new commane(); // Supposons que le nom du modèle est "Command"
    $commande->user_id = $user->id; // Assigner l'ID de l'utilisateur connecté
    $commande->command_number = 'CMD' . time(); // Générer un numéro de commande unique
    $commande->total_price = $totalPrice; // Assigner le prix total
    $commande->status = 'pending'; // Statut par défaut de la commande

    // Sauvegarder la commande dans la base de données
    $commande->save();

    // Retourner une réponse JSON ou rediriger vers une autre page
    return response()->json(['success' => true, 'message' => 'Produit ajouté avec succès !']);
}

public function destroy($id)
{
    // Assure-toi que le modèle 'Commande' est importé en haut du fichier.
    $command = commane::findOrFail($id);
    
    // Appelle la méthode delete() sur l'instance du modèle récupéré
    $command->delete();

    return redirect()->back()->with('success', 'Commande supprimée avec succès !');
}

public function index()
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();
    
    // Récupérer les commandes de l'utilisateur
    $commands = $user->commands; // Assurez-vous que la relation 'commands' est bien définie dans votre modèle User
    
    // Passer les commandes et l'utilisateur à la vue
    return view('user.commands', compact('user', 'commands'));
}

}
