<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="../css/anotacao.css?=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../css/navbar.css?=<?php echo time(); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Notas</title>

</head>

<body>
    <?php
    include("../navbar.php");

    ?>
    <div class="tela">
        <button class="adicionar" id="adicionar">
            <i class="fas fa-plus"></i> Nova Anotação
        </button>

        <!-- <div class="nota">
            <div class="configuracao">
                <button class="editar">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="deletar">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>

            <div class="main hidden"></div>
            <textarea></textarea>
        </div> -->

        <!--https://cdnjs.com/-->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/3.0.8/marked.min.js" integrity="sha512-OA0KzIFyfjEiECfdTeeqyDa++XmSLWyIBr8bWf2lpdv3qNr2TxpR9uaL2fKaz/Nz35kVVPEagjhWdWat/khWXw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/anotacao.js?=<?php echo time(); ?>"></script>
</body>

</html>