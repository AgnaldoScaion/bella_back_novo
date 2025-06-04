<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Página Não Encontrada | 404</title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #94a3b8;
            --error: #ef4444;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            line-height: 1.5;
            padding: 2rem;
        }
        
        .container {
            max-width: 600px;
            width: 100%;
            text-align: center;
            animation: fadeIn 0.6s ease-out;
        }
        
        .error-code {
            font-size: 8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1rem;
            line-height: 1;
        }
        
        .error-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        .error-message {
            font-size: 1.125rem;
            color: var(--gray);
            margin-bottom: 2rem;
            max-width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        
        .home-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary);
            color: white;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .home-button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .home-button:active {
            transform: translateY(0);
        }
        
        .illustration {
            max-width: 300px;
            margin: 0 auto 2rem;
            opacity: 0.9;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 640px) {
            .error-code {
                font-size: 6rem;
            }
            
            .error-title {
                font-size: 1.5rem;
            }
            
            .error-message {
                font-size: 1rem;
                max-width: 100%;
            }
            
            .illustration {
                max-width: 200px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- SVG illustration (can be replaced with an image) -->
        <svg class="illustration" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="var(--primary)" d="M45.1,-65.4C58.2,-58.4,68.8,-45.8,74.3,-31.3C79.8,-16.9,80.2,-0.6,76.5,13.9C72.8,28.4,65,41.1,53.5,51.8C42,62.5,26.8,71.3,10.3,76.4C-6.2,81.5,-23.9,82.9,-38.5,75.4C-53.1,67.9,-64.6,51.5,-70.9,33.6C-77.2,15.7,-78.2,-3.7,-72.8,-20.9C-67.3,-38.1,-55.4,-53.1,-40.5,-59.6C-25.6,-66.1,-7.7,-64.1,7.8,-57.9C23.3,-51.7,31.9,-41.3,45.1,-65.4Z" transform="translate(100 100)" />
        </svg>
        
        <h1 class="error-code">404</h1>
        <h2 class="error-title">Página não encontrada</h2>
        <p class="error-message">Desculpe, a página que você está procurando não existe ou foi movida. Verifique o URL ou volte para a página inicial.</p>
        <a href="../" class="home-button">
            Voltar para a página inicial
        </a>
    </div>
</body>
</html>