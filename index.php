<?php 
    session_start();
    require "config.php";
    require "Classes/Usuarios.php";
    require "Classes/Documentos.php";

    if(!isset($_SESSION['logado'])) {
        header('Location: login.php');
        exit;
    }

    $usuarios = new Usuarios($pdo);
    $usuarios->setUsuarios($_SESSION['logado']);

    $documentos = new Documentos($pdo);
    $lista = $documentos->getDocumentos();
?>

<h1>Sistema</h1>
<hr>

<?php if($usuarios->VerificarPermissao('ADD')): ?>
    <a href="adicionar.php">Adicionar Documento</a>
<?php endif; ?>

<?php if($usuarios->VerificarPermissao('SECRET')): ?>
    <a href="secreto.php">Página Secreta</a>
    <br><br>
<?php endif; ?>
<table border='1' width="100%">
    <tr>
        <th>Nome do arquivo</th>
        <th>Ações</th>
    </tr>
    <?php foreach($lista as $item): ?>
        <tr>
            <td><?php echo utf8_encode($item['titulo']); ?></td>
            <td style="text-align:center;">
            <?php if($usuarios->VerificarPermissao('EDIT')): ?>
                <a href="editar.php">Editar</a>
            <?php endif; ?>
            <?php if($usuarios->VerificarPermissao('DELL')): ?>
                <a href="excluir.php">Excluir</a>
            <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
