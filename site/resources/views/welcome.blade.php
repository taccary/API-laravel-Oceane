<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenue sur l'API Océane</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #f3f4f6;
            color: #222;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
            padding: 3rem 2rem;
            max-width: 480px;
            text-align: center;
        }
        h1 {
            color: #e53e3e;
            margin-bottom: 1rem;
        }
        p {
            margin-bottom: 2rem;
            color: #444;
        }
        a.btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: #e53e3e;
            color: #fff;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(229,62,62,0.08);
            transition: background 0.2s;
        }
        a.btn:hover {
            background: #c53030;
        }
        .footer {
            margin-top: 2rem;
            color: #888;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur l'API Océane</h1>
        <p>
            Ce serveur héberge une API REST permettant d'accéder aux données du service Océane.<br>
            Pour découvrir et tester les différentes routes disponibles, consultez la documentation interactive ci-dessous.
        </p>
        <a href="/API-doc/swagger-ui/index.html" target="_blank" class="btn">Accéder à la documentation API (Swagger UI)</a>
        <div class="footer">
            &copy; {{ date('Y') }} Océane API
        </div>
    </div>
</body>
</html>
