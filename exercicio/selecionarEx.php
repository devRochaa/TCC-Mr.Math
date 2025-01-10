<!DOCTYPE html>
<html lang="PT-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aulas</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/navbar.css?=<?php echo time(); ?>">
  <link rel="stylesheet" href="../css/selecionar.css?=<?php echo time(); ?>">
</head>

<body>
  <?php
  include("../navbar.php");
  include("../conexao.php");
  if (isset($_SESSION['id_materia'])) {
    unset($_SESSION['id_materia']);
  }
  ob_start();

  $sim = 'nao';

  $sql = "SELECT nome,id, descricao, thumb FROM materia";
  $result = mysqli_query($conexao, $sql);
  $materias = [];

  while ($row = $result->fetch_assoc()) {
    $materias[] = [
      'id' => $row['id'],
      'nome' => $row['nome'],
      'descricao' => $row['descricao'],
      'thumb' => $row['thumb']
    ];
  }




  ?>
  <div class="container">
    <div class="corpo">


      <?php if (!empty($materias)) { ?>
        <?php foreach ($materias as $materias) { ?>
          <div class="card">
            <img src="<?php if ($materias['thumb']) {
                        echo $materias['thumb'];
                      } else {
                        echo '../img/exercicios.png';
                      } ?>">
            <script>
              let ipt_materia = '';
            </script>
            <div>
              <h1><?php echo $materias['nome']; ?></h1>
              <h2> <?php echo $materias['descricao']; ?></h2>
              <form action="recebe.php" method="POST">
                <input type="text" id="<?php echo $materias['id']; ?>" name="id_materia" style="display:none;">
                <script>
                  ipt_materia = document.getElementById('<?php echo $materias['id']; ?>');
                  ipt_materia.value = <?php echo $materias['id']; ?>;
                </script>
                <button role="button" name="enviar" type="submit">Ver</button>
              </form>
            </div>
          </div>

      <?php }
      } ?>

    </div>
  </div>
</body>