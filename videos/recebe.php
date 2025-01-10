<?php
if (isset($_POST['data'])) {
  $data = $_POST['data'];
  // Exibir os dados recebidos para ver se chegaram corretamente
  echo "Dados recebidos: " . htmlspecialchars($data);
} else {
  echo "Nenhum dado foi enviado.";
}
