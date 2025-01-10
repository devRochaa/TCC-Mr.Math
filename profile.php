<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/profilePage.css?=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/navbar.css?=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <?php
    include("navbarH.php");
    if (isset($_SESSION['aviso_telefone'])) {
        echo "<script>alert('Telefone Inválido');</script>";

        unset($_SESSION['aviso_telefone']);
    }

    include("conexao.php");
    $email = $_SESSION['usuario'];
    $sql = "SELECT nome, sobrenome, senha, rm, telefone, bio, pfp, senha FROM usuarios where email='$email'";
    $result = mysqli_query($conexao, $sql);
    $usuario = mysqli_fetch_assoc($result);



    ?>
    <div class="second-body">

        <div class="container-display">

            <!--Informações-->
            <div class="info-container">
                <div class="imagem-container">
                    <img class="imagem-perfil" src="<?php if (isset($usuario['pfp'])) {
                                                        echo "img/pfp/", $usuario['pfp'];
                                                    } else {
                                                        echo 'img/pfp/profile.png';
                                                    } ?>">
                    <form action="account_process/upload.php" method="post" enctype="multipart/form-data">
                        <a id='botaofalso' class="edit-image-button">Editar Imagem</a>
                        <input type="file" name='pfp' id="fileInput" style="display: none;">
                        <input type="submit" name="enviar" id="btnsubmit" style="display: none;">

                    </form>
                </div>
                <div class="input-container">
                    <h2 class="title">Informações</h2>
                    <form action="account_process/process_info.php" method="POST">
                        <div class="input-display">

                            <input class="text-input" name="nome" id="nome" placeholder="Nome">
                            <input class="text-input" name="sobrenome" id="sobrenome" placeholder="Sobrenome">
                            <input class="text-input" name="telefone" id="telefone" placeholder="Telefone ('1412345678')" maxlength="11">
                            <input class="text-input" id="email" placeholder="Email" readonly>
                            <input class="text-input" id="rm" placeholder="RM" readonly>
                            <input class="text-input" id="senha" type="password" placeholder="Senha" readonly>

                        </div>
                        <div class="bio-display">
                            <input class="bio-input" name='bio' id="bio" placeholder="Bio">
                        </div>
                        <div class="button-display">
                            <button type='submit' class="button">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
        <center> <a href='account_process/logout.php' style="text-decoration:none;"><button class="logout-button">Logout</button></a> </center>
        <!--Alterar Senha e apagar dados-->
        <div class="bottom-display">
            <div class="info-password-container">
                <div class="input-container">
                    <h2 class="title">Alterar a senha</h2>


                    <form onsubmit="return false;" id="formulario">


                        <div class="input-password-display">
                            <div class="input-structure">
                                <input class="text-password-input" id="senha_atual" name="senha" placeholder="Senha Atual" type="password">
                                <span id="mostrar1" class="icon"><i class="fa-regular fa-eye"></i></span>
                            </div>
                            <div class="input-structure">
                                <input class="text-password-input" id="senha_nova" name="novasenha" placeholder="Nova Senha" type="password">
                                <span id="mostrar2" class="icon"><i class="fa-regular fa-eye"></i></span>
                            </div>
                            <div class="input-structure">
                                <img id="result">
                                <input class="text-password-input" id="confirmar_senha" name='confirmar_senha' placeholder="Confirmar Nova Senha" type="password">
                                <span id="mostrar3" class="icon"><i class="fa-regular fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="div_trocar_senha"></div>
                        <div class="button-password-display">

                            <a class="link" href="#">Esqueci a senha</a>
                            <button type='submit' id="trocar" class="button">Trocar Senha</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="delete-info-container">
            <div class="input-container">
                <h2 class="title">Apagar seus dados</h2>
                <div class="checkbox-display">
                    <div class="checkbox-structure">
                        <label>Todos os seus dados</label>
                    </div>
                    <div class="checkbox-structure">
                        <label>e informações serão perdidos.</label> <br>
                    </div>
                </div>
                <div class="delete-display">
                    <div class="delete-confirm-structure">
                        <a>Digite APAGAR para confirmar</a>
                        <input id="ipt_apagar" class="delete-input" type="text" placeholder="APAGAR">
                    </div>
                </div>
                <div class="checkbox-form-button-display">
                    <button id="APAGAR" class="delete-button">Apagar</button>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="js/profile.js?=<?php echo time(); ?>"></script>

    <script>
        $("#APAGAR").click(function() {
            const ipt_apagar = $("#ipt_apagar").val();
            if (ipt_apagar === "APAGAR") {
                Swal.fire({
                    title: "Você tem certeza?",
                    text: "Você não será capaz de reverter isso!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    cancelButtonText: "Cancele, vou continuar!",
                    confirmButtonText: "Sim, delete..",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        let contador = 3;
                        Swal.fire({
                            icon: "error",
                            title: "Rapazinho sem valor",
                            text: 'Sua conta vai ser apagada em ' + contador + ' segundos',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        const intervalo = setInterval(() => {
                            contador--;

                            // Atualiza o texto no SweetAlert
                            Swal.update({
                                text: 'Sua conta vai ser apagada em ' + contador + ' segundos',
                            });


                            if (contador === 0) {
                                clearInterval(intervalo);
                                window.location.href = "account_process/apagar.php";
                            }
                        }, 1000);

                    } else {
                        swal("Não foi possível deletar!", "APAGAR está escrito errado", "error");
                    }

                });
            }
        });
        var senha_real = "<?php echo $usuario['senha']; ?>";
        //Após selecionar e dar ok 

        const botaofalso = document.getElementById('botaofalso');
        const fileInput = document.getElementById("fileInput");
        const btnsubmit = document.getElementById("btnsubmit");


        // Evento de clique no botão
        botaofalso.addEventListener('click', function() {
            // Simula o clique no input de ficheiro
            fileInput.click();

        });

        fileInput.addEventListener('change', function() {
            // Se um arquivo for selecionado, submete o formulário
            if (fileInput.value !== "") {
                btnsubmit.click();
            }
        });

        var usuario = {
            nome: "<?php echo $usuario['nome']; ?>",
            sobrenome: "<?php echo $usuario['sobrenome']; ?>",
            senha: "<?php echo $usuario['senha']; ?>",
            rm: "<?php echo $usuario['rm']; ?>",
            telefone: "<?php echo $usuario['telefone']; ?>",
            bio: "<?php echo $usuario['bio']; ?>",
            email: "<?php echo $email; ?>"
        };

        const ipt_nome = document.getElementById('nome');
        ipt_nome.value = usuario.nome;
        const ipt_sobrenome = document.getElementById('sobrenome');
        ipt_sobrenome.value = usuario.sobrenome;
        const ipt_telefone = document.getElementById('telefone');
        ipt_telefone.value = usuario.telefone;
        const ipt_email = document.getElementById('email');
        ipt_email.value = usuario.email;
        const ipt_rm = document.getElementById('rm');
        ipt_rm.value = usuario.rm;
        const ipt_senha = document.getElementById('senha');
        ipt_senha.value = usuario.seha;
        const ipt_bio = document.getElementById('bio');
        ipt_bio.value = usuario.bio;
    </script>


</body>

</html>