<?php include "header.php" ?>

<div class='container mt-3 mb-3'>

    <div class='row'>

        <!-- Coluna para exibir o select para listar Usuários -->
        <div class='col-sm-6'>
            <div class='form-floating mt-3 mb-3'>
                <select class='form-select' name='nomeUsuario'>
                    <?php
                        include "conexaoBD.php";
                        $listarUsuarios = "SELECT * FROM Usuarios";
                        $res = mysqli_query($conn, $listarUsuarios) or die ("Erro ao tentar carregar Usuários!");
                        while($registro = mysqli_fetch_assoc($res)){
                            $idUsuario   = $registro['idUsuario'];
                            $nomeUsuario = $registro['nomeUsuario'];
                            echo "<option value='$idUsuario'>$nomeUsuario</option>";
                        }
                    ?>
                </select>
                <label for='nomeUsuario'>Selecione um Usuário</label>
            </div>
        </div>

        <!-- Coluna para exibir o select para listar Produtos -->
        <div class='col-sm-6'>
            <div class='form-floating mt-3 mb-3'>
                <select class='form-select' name='nomeProduto'>
                    <?php
                        include "conexaoBD.php";
                        $listarProdutos = "SELECT * FROM Produtos";
                        $res = mysqli_query($conn, $listarProdutos) or die ("Erro ao tentar carregar Produtos!");
                        while($registro = mysqli_fetch_assoc($res)){
                            $idProduto   = $registro['idProduto'];
                            $nomeProduto = $registro['nomeProduto'];
                            echo "<option value='$idProduto'>$nomeProduto</option>";
                        }
                    ?>
                </select>
                <label for='nomeProduto'>Selecione um Produto</label>
            </div>
        </div>

    </div>

</div>

<?php include "footer.php" ?>