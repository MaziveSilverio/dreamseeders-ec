<?php

include "connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbbolsasdeestudo WHERE instid=".$_SESSION['instid']." AND bseid=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nome = $row['nome'];
        $duracao= $row['duracao'];
        $condicoesdeingresso = $row['condicoesdeingresso'];
        $areacientifica = $row['areacientifica'];
        $localdaformacao = $row['localdaformacao'];
        $descricao = $row['descricao'];
        $saidasprofissionais = $row['saidasprofissionais'];

    }else {
        header("location: index.php");
    }
}



if(isset($_POST['submit'])) {
  
    $instid = $_SESSION['instid'];
    $nome =htmlentities(mysqli_real_escape_string($conn , $_POST['nome']));
    $duracao =htmlentities(mysqli_real_escape_string($conn , $_POST['duracao']));
    $condicoesdeingresso =htmlentities(mysqli_real_escape_string($conn , $_POST['condicoesdeingresso']));
    $areacientifica =htmlentities(mysqli_real_escape_string($conn , $_POST['areacientifica']));
    $localdaformacao =$_POST['localdaformacao'];
    $descricao = $_POST['descricao'];
    $saidasprofissionais =$_POST['saidasprofissionais'];
    $estado = 'indefinido';
    $dataSeca = new DateTime('now');
    $data = $dataSeca->format('Y-m-d H:i:s');
    $bseid = $_SESSION['bseid'];
      
    $query = "UPDATE tbbolsasdeestudo 
        SET
        instid = '$instid', 
        nome ='$nome',
        duracao = '$duracao',
        condicoesdeingresso = '$condicoesdeingresso',
        areacientifica = '$areacientifica',
        localdaformacao = '$localdaformacao',
        descricao = '$descricao',
        saidasprofissionais = '$saidasprofissionais', 
        estado = '$estado'
    WHERE bseid=".$bseid;
    $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0 ) {
        $_SESSION['info'] = "<b style='color: blue;'>Curso atualizado com sucesso!</b>";
        header("location: mestradoall.php");
	}
	else {
		"<script>alert('Tente novamente!'); </script> " ;
	}

}

?>