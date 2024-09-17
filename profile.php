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
    <?php include("navbarH.php"); ?>
    <div class="second-body">

        <div class="container-display">

            <!--Informações-->
            <div class="info-container">
                <div class="imagem-container">
                    <img class="imagem-perfil" src="img/profile.png">
                    <a class="edit-image-button">Editar Imagem</a>
                </div>
                <div class="input-container">
                    <h2 class="title">Informações</h2>
                    <div class="input-display">
                        <input class="text-input" placeholder="Nome">
                        <input class="text-input" placeholder="Sobrenome">
                        <input class="text-input" placeholder="Telefone">
                        <input class="text-input" placeholder="Email" readonly>
                        <input class="text-input" placeholder="RM" readonly>
                        <input class="text-input" type="password" placeholder="Senha" readonly>
                    </div>
                    <div class="bio-display">
                        <input class="bio-input" placeholder="Bio">
                    </div>
                    <div class="button-display">
                        <button class="button">Trocar Senha</button>
                        <button class="button">Salvar Alterações</button>
                    </div>
                </div>
            </div>

            <!--Alterar Senha e apagar dados-->
            <div class="bottom-display">
                <div class="info-password-container">
                    <div class="input-container">
                        <h2>Alterar a senha</h2>
                        <div class="input-password-display">
                            <div class="input-structure">
                                <input class="text-password-input" placeholder="Senha Atual" type="password">
                                <span class="icon"><i class="fa-regular fa-eye"></i></span>
                            </div>
                            <div class="input-structure">
                                <input class="text-password-input" placeholder="Nova Senha" type="password">
                                <span class="icon"><i class="fa-regular fa-eye"></i></span>
                            </div>
                            <div class="input-structure">
                                <input class="text-password-input" placeholder="Confirmar Nova Senha" type="password">
                                <span class="icon"><i class="fa-regular fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="button-password-display">
                            <a class="link" href="#">Esqueci a senha</a>
                            <button class="button">Trocar Senha</button>
                        </div>
                    </div>
                </div>

                <div class="delete-info-container">
                    <div class="input-container">
                        <h2>Apagar seus dados</h2>
                        <div class="checkbox-display">
                            <div class="checkbox-structure">
                                <input class="checkbox-input" type="checkbox">
                                <label>Aulas Assistidas</label>
                            </div>
                            <div class="checkbox-structure">
                                <input class="checkbox-input" type="checkbox">
                                <label>Exercícios Feitos</label>
                            </div>
                        </div>
                        <div class="delete-display">
                            <div class="delete-confirm-structure">
                                <a>Digite APAGAR para confirmar</a>
                                <input class="delete-input" type="text" placeholder="APAGAR">
                            </div>
                        </div>
                        <div class="checkbox-form-button-display">
                            <button class="delete-button">Apagar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>