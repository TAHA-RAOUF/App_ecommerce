<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes de {{ $user->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        thead {
            background-color: #007bff;
            color: white;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
        th {
            position: sticky;
            top: 0;
        }
        /* Style du bouton */
        .home-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .home-btn:hover {
            background-color: #0056b3;
        }
        .home-btn svg {
            margin-right: 8px;
            vertical-align: middle;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<h1>Commandes de {{ $user->name }}</h1>
<table>
    <thead>
        <tr>
            <th>Command Number</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Placed At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $totalPrice = 0; @endphp <!-- Variable pour stocker le prix total -->
        
        @foreach ($user->commands as $command)
            <tr>
                <td>{{ $command->command_number }}</td>
                <td>{{ $command->total_price }}</td>
                <td>{{ $command->status }}</td>
                <td>{{ $command->created_at }}</td>
                <td>
                    <form action="{{ route('commands.destroy', $command->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this command?')">Delete</button>
                    </form>
                </td>
            </tr>
            @php $totalPrice += $command->total_price; @endphp <!-- Ajouter au total -->
        @endforeach
        
        <tr>
            <td colspan="1"><strong>Total:</strong></td>
            <td colspan="4"><strong>{{ $totalPrice }}</strong></td> <!-- Afficher le total -->
        </tr>
    </tbody>
</table>

<!-- Bouton de retour à l'accueil -->
<div class="text-center mt-6">
    <a href="{{ url('/') }}" class="home-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708L8 1.707l5.646 5.647a.5.5 0 0 0 .708-.708l-6-6z"/>
            <path d="M13 2.5v6a.5.5 0 0 0 1 0v-6a1.5 1.5 0 0 0-1-1.415V2.5zM6.5 14v-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V7.707l-.646-.647a.5.5 0 1 0-.708.708L13 7.707V13.5h-3v-3.5h-2v3.5H3V7.707l2-2V2.5a1.5 1.5 0 0 0-1 1.415v6a.5.5 0 1 0 1 0v-6A.5.5 0 0 1 5 2.5V7H3.707l-2 2V14a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5z"/>
        </svg>
        Accueil
    </a>
</div>

</body>
</html>
