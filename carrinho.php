<?php
include("conexao1.php");
session_start();

// Ações de adicionar ou remover produtos do carrinho
if (isset($_GET['acao'])) {
    $id = intval($_GET['id']);  // Captura o ID do produto

    // Adicionar produto ao carrinho
    if ($_GET['acao'] == 'add') {
        if (!isset($_SESSION['carrinho'][$id])) {
            $query = "SELECT * FROM produtos WHERE id = $id";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $produto = mysqli_fetch_assoc($result);
                $_SESSION['carrinho'][$id] = [
                    'nome' => $produto['nome'],
                    'preco' => $produto['preco'],
                    'imagem' => $produto['imagem'],
                    'quantidade' => 1
                ];
            } else {
                echo "Erro ao pegar o produto: " . mysqli_error($conn);
                exit;
            }
        } else {
            $_SESSION['carrinho'][$id]['quantidade']++;
        }
        header("Location: carrinho.php");
        exit;
    }

    // Remover produto do carrinho
    if ($_GET['acao'] == 'remover') {
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
        header("Location: carrinho.php");
        exit;
    }
}

// Finalizar compra (Inserir os produtos na tabela de pedidos)
if (isset($_POST['finalizar_compra'])) {
    if (!empty($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $id => $item) {
            // Insere cada item do carrinho na tabela de pedidos
            $total = $item['quantidade'] * $item['preco'];
            $query = "INSERT INTO pedidos (id_produto, quantidade, preco, total) VALUES ($id, {$item['quantidade']}, {$item['preco']}, $total)";
            if (!mysqli_query($conn, $query)) {
                echo "Erro ao finalizar compra: " . mysqli_error($conn);
                exit;
            }
        }
        // Limpa o carrinho após a compra
        unset($_SESSION['carrinho']);
        header("Location: carrinho2.php"); // Redireciona para uma página de sucesso
        exit;
    } else {
        echo "Seu carrinho está vazio!";
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
    color: #333;
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
    margin-bottom: 200px;
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
    color: #000000;
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
    background-color: #9b9b6f;
}

/* Estilos do hero */
.hero {
    background: url('path/to/your/hero-image.jpg') no-repeat center center/cover;
    color: #fff;
    text-align: center;
    padding: 100px 20px;
    position: relative;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero h1 {
    font-size: 3em;
    margin-bottom: 20px;
    font-weight: 700;
}

.btn-explore {
    background-color: #a3a67f; /* Tom de Pistache Escuro */
    color: #fff;
    padding: 15px 30px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.btn-explore:hover {
    background-color: #9b9b6f;
}

/* Seção de Produtos */
.produtos .container-produtos {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
    margin-top: 100px;
}

.produto-card {
    background-color: #fff;
    border-radius: 10px;
    width: 250px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    transition: transform 0.3s;
}

.produto-card:hover {
    transform: translateY(-10px);
}

.produto-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.produto-info {
    padding: 15px;
}

.produto-info h3 {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 10px;
}

.produto-info p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 15px;
}

.btn-add {
    display: inline-block;
    background-color: #9b9b6f;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn-add:hover {
    background-color: #d8d5a9;
}

/* Carrinho */
.carrinho {
    margin-top: 30px;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 80%;
    margin-left: auto;
    margin-right: auto;
}

.carrinho table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
}

.carrinho table th,
.carrinho table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

.carrinho table th {
    background-color: #f4f4f4;
}

.btn-remove {
    display: inline-block;
    color: #f44336;
    text-decoration: none;
    font-size: 14px;
    padding: 8px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn-remove:hover {
    background-color: #ffdddd;
}

.btn-finalizar {
    background-color: #9b9b6f;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-finalizar:hover {
    background-color: #d8d5a9;
}

/* Estilos do footer */
footer {
    background-color: #d8d5a9;
    color: black;
    text-align: center;
    padding: 15px;
    position: fixed;
    bottom: 0;
    width: 100%;
}

footer p {
    font-size: 14px;
}

/* Media Queries para Responsividade */

/* Para telas pequenas (ex: celulares) */
@media (max-width: 768px) {
    header {
        flex-direction: column;
        align-items : center;
        padding: 20px 0;
    }

    header .logo img {
        width: 120px;
        margin-bottom: 20px;
    }

    header nav ul {
        flex-direction: column;
        align-produ$produtos: center;
    }

    header nav ul li {
        margin-bottom: 10px;
    }

    .produtos .container-produtos {
        justify-content: center;
    }

    .produto-card {
        width: 200px;
    }

    .carrinho {
        width: 90%;
    }

    footer {
        position: relative;
        padding: 20px;
    }
}

/* Para tablets */
@media (max-width: 1024px) {
    header {
        flex-direction: column;
        align-items : center;
        padding: 30px 0;
    }

    .produtos .container-produtos {
        justify-content: center;
    }

    .produto-card {
        width: 220px;
    }

    .carrinho {
        width: 80%;
    }
}


    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.html">
            <img src="La pasta logo.png" width="150" height="150" alt="LOGO">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Início</a></li>
                <li><a href="menu.html">Menu</a></li>
                <li><a href="sobre-nos.html">Sobre nós</a></li>
                <li><a href="inc_produto2.php">Reserva</a></li>
            </ul>
        </nav>
    </header>

    <!-- Página de produtos -->
    <section class="produtos">
        <h2>Cardápio</h2>
        <div class="container-produtos">
            <?php
            // Consulta para pegar os produtos
            $query = "SELECT * FROM produtos";
            $result = mysqli_query($conn, $query);

            // Verifica se a consulta retornou algum erro
            if (!$result) {
                die("Erro ao consultar produtos: " . mysqli_error($conn));
            }

            // Verifica se há produtos
            if (mysqli_num_rows($result) > 0):
                while ($produto = mysqli_fetch_assoc($result)):
            ?>
                    <div class="produto-card">
                        <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                        <div class="produto-info">
                            <h3><?php echo $produto['nome']; ?></h3>
                            <p>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                            <a href="carrinho.php?acao=add&id=<?php echo $produto['id']; ?>" class="btn-add">Adicionar ao carrinho</a>
                        </div>
                    </div>
            <?php
                endwhile;
            else:
                echo "<p>Não há produtos disponíveis no momento.</p>";
            endif;
            ?>
        </div>
    </section>

    <!-- Carrinho de Compras -->
    <section class="carrinho">
        <h2>Carrinho de Compras</h2>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($_SESSION['carrinho'])):
                    foreach ($_SESSION['carrinho'] as $id => $item):
                ?>
                        <tr>
                            <td><?php echo $item['nome']; ?></td>
                            <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                            <td><?php echo $item['quantidade']; ?></td>
                            <td>
                                <a href="carrinho.php?acao=remover&id=<?php echo $id; ?>" class="btn-remove">Remover</a>
                            </td>
                        </tr>
                <?php
                    endforeach;
                else:
                    echo "<tr><td colspan='4'>Seu carrinho está vazio.</td></tr>";
                endif;
                ?>
            </tbody>
        </table>
        <form action="carrinho.php" method="POST">
            <button type="submit" name="finalizar_compra" class="btn-finalizar">Finalizar Compra</button>
        </form>
    </section>
</body>
</html>
