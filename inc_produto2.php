<?php
     include("conexao.php");

     if(isset($_POST['nome']) && isset($_POST['datadia']) && isset($_POST['hora']) && isset($_POST['assentos']) && isset($_POST['email']) && isset($_POST['telefone'])){
        $nome = $mysqli->real_escape_string($_POST['nome']);
        $datadia = $mysqli->real_escape_string($_POST['datadia']);
        $hora = $mysqli->real_escape_string($_POST['hora']);
        $assentos = $mysqli->real_escape_string($_POST['assentos']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $telefone = $mysqli->real_escape_string($_POST['telefone']);
    
        // Verificar se o usuário já existe
        $sql = "SELECT * FROM reserva WHERE nome = '$nome'";
        $sql_query = $mysqli->query($sql);
    
        if($sql_query->num_rows > 0){
            echo "<p>Usuário já cadastrado</p>";
        } else{
            $sql = "INSERT INTO reserva(nome, datadia, hora, assentos, email, telefone) VALUES ('$nome', '$datadia', '$hora', '$assentos', '$email', '$telefone')";
    
            if($mysqli->query($sql) === TRUE){
                echo "<p>$nome sua reserva foi confirmada as $hora de $datadia!</p>";
            } else{
                echo "<p>Erro: </p>". $mysqli->error;
            }
        }
    }
        
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Pasta Perfetta</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
 /* Reset básico */
 * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Estilos gerais do body */
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    color: #333; /* Cor de Texto Escuro */
}

/* Container */
.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
  
/* Estilos do header */
header {
    background-color: #d8d5a9; /* Pistache */
    color: #4a4a2d; /* Verde Escuro */
    padding: 50px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 100px;
}

header .logo img {
    width: 150px;
    height: auto;
    border-radius: 10%;
    margin-bottom: 50px;
}

header nav {
    flex-grow: 1;
}

header nav ul {
    display: flex;
    list-style: none;
    gap: 15px;
    padding: 0;
}

header nav ul li {
    margin: 0;
}

header nav ul li a {
    color: #000000; /* Verde Escuro */
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

header nav ul li a:hover {
    color: #000000; /* Tom de Pistache Escuro */
}

.btn-reserva {
    background-color: #a3a67f; /* Tom de Pistache Escuro */
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.btn-reserva:hover {
    background-color: #9b9b6f; /* Tom de Pistache Escuro mais claro */
}

        
        h2 {
    color: #d8d5a9;
    border-bottom: 3px solid #d8d5a9;
    padding-bottom: 50px;
    font-size: 2em;
    text-align: center;
    top: 120px;  /* Move o título 20px para baixo */
    transform: translateY(40px);  /* Move o título suavemente para baixo */
}



main{
    text-align: center;
    margin-bottom: 25px;
}

        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input, textarea {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus, textarea:focus {
            border-color: #007BFF;
            outline: none;
        }

        footer {
            background-color: #d8d5a9;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }

        .social-media a {
            color: white;
            margin: 0 10px;
            font-size: 20px;
            transition: color 0.3s;
        }

        .social-media a:hover {
            color: #007BFF;
        }

        .mapa {
            margin-top: 20px;
        }

        iframe {
            width: 100%;
            height: 300px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
                align-items: center;
            }

            .btn-reserva {
                margin: 10px 0;
            }

            .reserva-form {
                padding: 20px;
            }

            iframe {
                height: 200px;
            }
        }
</style>
<body>
<header>
        <div class="logo">
            <a href="inc_produto2.php">
            <img src="La pasta logo.png" width="150" height="150" alt="LOGO">
            </a>
            </div>
        
      
        <nav>
            <ul>
                <li><a href="menu.html">Menu</a></li>
                <li><a href="sobre-nos.html">sobre-nos</a></li>
                <li><a href="index.html">inicio</a></li>
                <li><a href="carrinho.php">compras</a></li>
            </ul>
        </nav>
    
        <div class="menu-icon">
            <input type="checkbox" id="chk" style="display: none;">
            <label for="chk">
                <i class="fa fa-bars"></i>
            </label>
        </div>
    </header>
    

    <main>
        <h2>Cadastro de produtos</h2>
        <form action="" method="post">
            <label for="nome">Nome:</label>
            <br>
            <input type="text" name="nome" id="nome" required>
            <br><br>
            <label for="datadia">Data de reserva:</label>
            <br>
            <input type="date" name="datadia" id="datadia" required>
            <br><br>
            <label for="email">Email:</label>
            <br>
            <input type="email" name="email" id="email" required>
            <br><br>
            <label for="hora">Hora:</label>
            <br>
            <input type="time" name="hora" id="hora" placeholder="Hora" required>
            <br><br>
            <label for="assentos">Numero de assentos:</label>
            <br>
            <input type="number" name="assentos" id="assentos" placeholder="Assentos" required>
            <br><br>
            <label for="telefone">Telefone:</label>
            <br>
            <input type="tel" name="telefone" id="telefone" pattern="^\([1-9]{2}\) [9]{0,1}[6-9]{1}[0-9]{3}\-[0-9]{4}$" required>
            <br><br>
            <input type="submit" value="Criar Conta">
            <br><br>
        </form>
    </main>

</body>
</html>
<footer>
        <div class="container">
            <div class="contato">
                <p>Endereço: Rua Exemplo, 123, São Paulo, SP</p>
                <p>Telefone: (11) 1234-5678</p>
                <p>Email: contato@lapastaperfetta.com.br</p>
            </div>
            <div class="social-media">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
            <div class="mapa">
                <iframe src="https://www.google.com/maps/embed?pb=..." allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
    </footer>
</body>
</html>
