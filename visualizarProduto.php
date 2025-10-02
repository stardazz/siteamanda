<?php include "header.php" ?>

<div class="container text-center mt-5 mb-5">

    <?php

        //Verifica se há recebimento de parãmetro via método GET
        if(isset($_GET['idProduto'])){
            $idProduto = $_GET['idProduto'];

            //Inclui o arquivo de conexão com o BD
            include "conexaoBD.php";

            $exibirProduto = "SELECT * FROM Produtos WHERE idProduto = $idProduto";
            $res           = mysqli_query($conn, $exibirProduto); // Executa a QUERY
            $totalProdutos = mysqli_num_rows($res); //Retorna a quantidade de registros

            if($totalProdutos > 0){

                echo "<div class='row text-center'>";

                if($registro = mysqli_fetch_assoc($res)){
                    $idProduto        = $registro['idProduto'];
                    $fotoProduto      = $registro['fotoProduto'];
                    $nomeProduto      = $registro['nomeProduto'];
                    $descricaoProduto = $registro['descricaoProduto'];
                    $valorProduto     = $registro['valorProduto'];
                    $statusProduto    = $registro['statusProduto'];

                    ?>


                    <div class="d-flex justify-content-center mb-3">

            <div class="card" style="width:30%; border-style:none;">
                            
                <!-- Carousel -->
                <div id="Produto" class="carousel slide" data-bs-ride="carousel" >

                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#Produto" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#Produto" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#Produto" data-bs-slide-to="2"></button>
                    </div>

                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="position-relative">
                                <?php
                                if($statusProduto == 'esgotado'){
                                        echo "
                                        <div class='position-absolute top-50 start-50 translate-middle bg-danger text-white px-6 py-2 fs-6 fw-bold rounded shadow' style='z-index: 10; opacity: 0.85;'>
                                        ESGOTADO
                                        </div>
                                        ";
                                    }
                                ?>
                                <img src="<?php echo $fotoProduto ?>" alt="<?php echo $nomeProduto?>" class="d-block w-100"
                                    <?php
                                    if($statusProduto == 'esgotado'){
                                        echo "style='filter:grayscale(100%)'";
                                    }
                                        ?>
                                >
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="position-relative">
                                <?php
                                if($statusProduto == 'esgotado'){
                                        echo "
                                        <div class='position-absolute top-50 start-50 translate-middle bg-danger text-white px-6 py-2 fs-6 fw-bold rounded shadow' style='z-index: 10; opacity: 0.85;'>
                                        ESGOTADO
                                        </div>
                                        ";
                                    }
                                ?>
                                <img src="<?php echo $fotoProduto ?>" alt="<?php echo $nomeProduto?>" class="d-block w-100"
                                    <?php
                                    if($statusProduto == 'esgotado'){
                                        echo "style='filter:grayscale(100%)'";
                                    }
                                        ?>
                                >
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="position-relative">
                                <?php
                                if($statusProduto == 'esgotado'){
                                        echo "
                                        <div class='position-absolute top-50 start-50 translate-middle bg-danger text-white px-6 py-2 fs-6 fw-bold rounded shadow' style='z-index: 10; opacity: 0.85;'>
                                        ESGOTADO
                                        </div>
                                        ";
                                    }
                                ?>
                                <img src="<?php echo $fotoProduto ?>" alt="<?php echo $nomeProduto?>" class="d-block w-100"
                                    <?php
                                    if($statusProduto == 'esgotado'){
                                        echo "style='filter:grayscale(100%)'";
                                    }
                                        ?>
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#Produto" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#Produto" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
                
                <div class="card-body">
                    <h4 class="card-title"><b><?php echo $nomeProduto; ?></b></h4>
                    <p class="card-text"><?php echo $descricaoProduto; ?></p>
                    <p class="card-text">Valor: <b><?php echo $valorProduto; ?></b></p>
                    <div class="card bg-light">
                        <div class="card-body">
                            <?php
                            //Veerificar se há uma sessão iniciada
                            if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
                                     //Verificar se o produto está disponível
                                    if($statusProduto == 'disponivel'){
                                     //Verifica se o tipo de usuário é 'cliente'
                                      if($tipoUsuario == 'cliente'){
                            echo "
                                    <form action='#efetuarCompra.php method='POST'>
                                        <input type='hidden' name='idProduto' value='$idProduto'>
                                        <input type='hidden' name='fotoProduto' value='$fotoProduto'>
                                        <input type='hidden' name='nomeProduto' value='$nomeProduto'>
                                        <input type='hidden' name='valorProduto' value='$valorProduto'>
                                        <button class='btn btn-outline-success'>
                                            <i class='bi bi-bag plus' style='font-size:16pt;'></i>
                                            Efetuar Compra
                                        </button>
                                    </form> 
                                ";
                            }
                            else{
                                    echo "
                                        <form action='#formEditarProduto.php?idProduto=$idProduto' method='POST'>
                                            <input type='hidden' name='idProduto' value='$idProduto'>
                                            <button type='submit' class='btn btn-outline-primary'>
                                                <i class='bi bi-pencil-square'></i>
                                                Editar Produto
                                            </button>
                                        </form>
                                    ";
                                }
                        }
                        else{
                                        echo "
                                            <div class='alert alert-secondary'>
                                            Produto esgotado! :( <i class='bi-emoji-from'></i>
                                        ";
                                    }
                            }
                                
                            else{
                                if($statusProduto == 'disponivel'){
                                echo "
                                    <div class='alert alert-info'>
                                        <a href='formLogin.php' class='alert-link'>
                                        Acesse o sistema para poder comprar este produto!
                                        <i class='bi bi-person'></i>
                                        </a>
                                    </div>
                                ";
                            }

                         else{
                                        echo "
                                            <div class='alert alert-secondary'>
                                            Produto esgotado! :( <i class='bi-emoji-from'></i>
                                        ";
                                    }
                            }
                        ?>
                            

                        </div>
                        <br>
                    </div>
                </div>

            </div>

        </div>

        <?php

                }
            }
            else{
                echo "<div class='alert alert-warning text-center'>Produto não localizado!</div>";
            }
            echo "</div>";
        }
        else{
                echo "<div class='alert alert-warning text-center'>Não foi possível carregar o produto</div>";
        }

        ?>

        

    </div>

</div>

<?php include "footer.php" ?>