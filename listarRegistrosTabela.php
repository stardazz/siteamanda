<?php include "header.php" ?>

<div class='container mt-3 mb-3'>

    <?php

        echo "<h3 class='text-center'>Listar registros em uma TABELA:</h3>";

        //Query para listar TODOS os registros da tabela Produtos
        $listarProdutos = "SELECT * FROM Produtos";

        include "conexaoBD.php";
        //A função mysqli_query é responsável pela execução de comandos SQL no Banco de Dados
        $res = mysqli_query($conn, $listarProdutos) or die ("Erro ao tentar listar Produtos!");
        $totalProdutos = mysqli_num_rows($res); //Busca o total de registros retornados pela Query

        echo "<div class='alert alert-info text-center'>Há <strong>$totalProdutos</strong> produto(s) cadastrado(s) no sistema!</div>";

        //Parte 1 - Montar o cabeçalho da tabela para exibir os registros
        echo "
            <table class='table'>
                <thead class='table-dark'>
                    <tr>
                        <th>ID</th>
                        <th>FOTO</th>
                        <th>NOME</th>
                        <th>DESCRIÇÃO</th>
                        <th>VALOR</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
        ";

        //Parte 2 - Enquanto houver registros, executa a função abaixo para armazenar em variáveis PHP
        while($registro = mysqli_fetch_assoc($res)){
            $idProduto        = $registro['idProduto'];
            $fotoProduto      = $registro['fotoProduto'];
            $nomeProduto      = $registro['nomeProduto'];
            $descricaoProduto = $registro['descricaoProduto'];
            $valorProduto     = $registro['valorProduto'];
            $statusProduto    = $registro['statusProduto'];

            //Parte 3 - Exibe os valores armazenados nas variáveis
            echo "
                <tr>
                    <td>$idProduto</td>
                    <td><img src='$fotoProduto' title='Foto de $nomeProduto' style='width:50px'></td>
                    <td>$nomeProduto</td>
                    <td>$descricaoProduto</td>
                    <td>$valorProduto</td>
                    <td>$statusProduto</td>
                </tr>
            ";
        }
        //Parte 4 - Encerrar a tabela e a conexão com o BD
        echo "</tbody>";
        echo "</table>";
        mysqli_close($conn);
    ?>

</div>

<?php include "footer.php" ?>