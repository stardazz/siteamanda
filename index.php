<?php include "header.php" ?>
        
<div class='container mt-5 mb-5'>

    <?php

        //Inclui o arquivo de conexão com o Banco de Dados
        include "conexaoBD.php";

        //Variável PHP que recebe a Query para selecionar todos os campos da tabela Produtos
        $listarProdutos = "SELECT * FROM Produtos";

        //Verificar se há algum parâmetro sendo recebido via URL (metodo GET) utilizando afunção isset()
        if(isset($_GET['filtroProduto'])){
            $filtroProduto = $_GET['filtroProduto'];

            if($filtroProduto != 'todos'){
                $listarProdutos = $listarProdutos . " WHERE statusProduto LIKE '$filtroProduto' ";
            }

            switch ($filtroProduto){
                case 'todos' : $mensagemFiltro = "mo total";
                break;

                case 'disponivel' : $mensagemFiltro = "disponíveis";
                break;

                case 'esgotado' : $mensagemFiltro = "esgotados";
                break;
            }

        }
        else{
            $filtroProduto = "todos";
            $mensagemFiltro = "no total";
        }

        $res            = mysqli_query($conn, $listarProdutos); //Recebe true OR false com base na execução
        $totalProdutos  = mysqli_num_rows($res); //Retorna a quantidade de registros encontrados

        if($totalProdutos > 0){
            if($totalProdutos == 1){
                //Se o total de produtos for igual a um, exibe mensagem no singular
                echo "<div class='alert alert-info text-center'>Há <strong>$totalProdutos</strong> produto cadastrado!</div>";
            }
            else{
                //Se o total de produtos não for igual a um, exibe mensagem no plural
                echo "<div class='alert alert-info text-center'>Há <strong>$totalProdutos</strong> produtos cadastrados!</div>";
            }
        }
        else{
            echo "<div class='alert alert-info text-center'>Não há Produtos cadastrados no sistema!</div>";
        }

        echo "
            <form name='formFiltro' action='index.php' method='GET'>
                <div class='form-floating mt-3'>
                    <select class='form-select' name='filtroProduto' required>
                        <option value='todos'";if($filtroProduto == 'todos'){echo "selected";}; echo">Exibir todos os Produtos</option>
                        <option value='disponivel'";if($filtroProduto == 'disponivel'){echo "selected";}; echo">Exibir apenas Produtos disponíveis</option>
                        <option value='esgotado'";if($filtroProduto == 'esgotado'){echo "selected";}; echo">Exibir apenas Produtos esgotados</option>
                    </select>
                    <label for='filtroProduto'>Selecione um Filtro</label>
                    <br>
                </div>
                <button type='submit' class='btn btn-success' style='float:right'><i class='bi bi-funnel'></i> Filtrar Produtos</button>
                <br>
            </form>
        ";

    ?>

    <hr>

    <!-- Exibe a grid com os cards -->
    <div class="row">

        <?php
            //Loop para armazenar os registros da tabela em variáveis PHP
            while($registro = mysqli_fetch_assoc($res)){
                $idProduto        = $registro['idProduto'];
                $fotoProduto      = $registro['fotoProduto'];
                $nomeProduto      = $registro['nomeProduto'];
                $descricaoProduto = $registro['descricaoProduto'];
                $valorProduto     = $registro['valorProduto'];
                $statusProduto    = $registro['statusProduto'];

                echo "
                    <div class='col-sm-3'>

                        <div class='card' style='width:100%; height:100%'>

                            <div class='card-body' style='height:100%'>
                                <a href='visualizarProduto.php?idProduto=$idProduto' style='text-decoration:none' title='Visualizar mais detalhes de $nomeProduto'>
                                     <div class ='position-relative'>";
                                    if($statusProduto == 'esgotado'){
                                        echo "
                                        <div class='position-absolute top-50 start-50 translate-middle bg-danger text-white px-6 py-2 fs-6 fw-bold rounded shadow' style='z-index: 10; opacity: 0.85;'>
                                        ESGOTADO
                                        </div>
                                        ";
                                    }
                                    echo "
                                    <img class='card-img-top' src='$fotoProduto' alt='Foto de $nomeProduto'";
                                    if($statusProduto == 'esgotado'){
                                        echo "style='filter:grayscale(100%)';";
                                    }
                                    echo">

                                    
                                    </div>
                                </a>
                            </div>

                            <div class='card-body text-center'>
                                <h4 class='card-title'>$nomeProduto</h4>
                                <p class='card-text'>Valor: <strong>R$ $valorProduto</strong>
                                <div class='d-grid' style='border-size:border-box'>
                                    <a class='btn btn-outline-success' href='visualizarProduto.php?idProduto=$idProduto' style='text-decoration:none' title='Visualizar mais detalhes de $nomeProduto'>
                                        <i class='bi bi-eye'></i> Visualizar Produto
                                    </a>
                                </div>
                            </div>

                        </div> 

                    </div>
                ";
            }
        ?>

    </div>

</div>

<?php include "footer.php" ?>