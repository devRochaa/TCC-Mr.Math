<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Burguer</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/desempenho.css">
</head>

<body>
    <?php
    include("../seguranca.php");
    include("../navbar.php");
    $email = $_SESSION['usuario'];
    $sql = "SELECT id from usuarios where email = '$email'";
    $result = $conexao->query($sql);
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
        }
    
    $sql = "SELECT aulas_assistidas, acertos, ex_feitos FROM desempenho where id_usuarios = $id";
    $result = $conexao->query($sql);
        while($row = $result->fetch_assoc()) {
            $aulas_assistidas = $row['aulas_assistidas'];
            $acertos = $row['acertos'];
            $ex_feitos = $row['ex_feitos'];
        }
    ?>
    <div class="container">
        <div class="corpo">
            <p class="desemp">DESEMPENHO</p>
            <hr>
            <p>Olá <?php echo $nome ?>! Esse é a tela de início</p>

            <div class="progress">
                <div class="card">
                    <h4>Aulas Assistidas</h4>
                    <p><?php echo $aulas_assistidas;?></p>
                </div>
                <div class="card">
                    <h4>Horas Estudadas</h4>
                    <p>2</p>
                </div>
                <div class="card">
                    <h4>Atividades Realizadas</h4>
                    <p><?php echo $ex_feitos;?></p>
                </div>
                <div class="card">
                    <h4>Acertos</h4>
                    <p><?php echo $acertos;?></p>
                </div>
            </div>

            <div class="boxis">
                <div class="box-graficos">
                    <div class="grafic_pizza">
                        <h2>Grafico 1</h2>
                    </div>
                    <div class="porcentagem_grafico">16,75%</div>
                    <div class="cont_pizza">
                        <div class="chart">
                            <canvas id="barchart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="box-grafic">
                    <div class="grafic_coluna">
                        <h2>Grafico 2</h2>
                    </div>
                    <div class="porcentagem_grafico">16,75%</div>
                    <div class="cont_coluna">
                        <div class="chart">
                            <canvas id="doughnut"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ex_feitos = "<?php echo $ex_feitos; ?>";
            var acertos = "<?php echo $acertos; ?>";
            var aulas_assistidas = "<?php echo $aulas_assistidas; ?>";
            const ctx = document.getElementById('barchart');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Aulas Assistidas', 'Horas Assistidas', 'Atividades Realizadas', 'Acerto'],
    datasets: [{
      label: '# of Votes',
      data: [aulas_assistidas, 2, ex_feitos, acertos],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

        </script>

        <script> //GRAFICO 2
            const ctx2 = document.getElementById('doughnut');

new Chart(ctx2, {
  type: 'doughnut',
  data: {
    labels: ['Aulas Assistidas', 'Horas Assistidas', 'Atividades Realizadas', 'Acerto'],
    datasets: [{
      label: '# of Votes',
      data: [aulas_assistidas, 2, ex_feitos, acertos],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
</div>