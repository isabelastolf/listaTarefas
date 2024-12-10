<?php

    require_once('database/conn.php');

    $tasks = [];

    $sql = $pdo->query("SELECT * FROM task ORDER BY id ASC");

    if($sql->rowCount() > 0) {
        $tasks = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/styles/style.css"/> <!-- CSS -->
    <script src="https://kit.fontawesome.com/79a3841d9a.js" crossorigin="anonymous"></script> <!-- ICONS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> <!-- JQUERY -->
    <title>TO DO LIST</title>
</head>
<body>
    <div id="to-do">
        <h1> Things to do </h1>

        <form action="actions/create.php" method="POST" class="to-do-form">
            <input type="text" name="description" placeholder="write your task here" required> <!-- CAMPO DESCREVER TAREFA -->
            <button type="submit" class="form-button"> <!-- BOTÃO ADICIONAR TAREFA -->
                <i class="fa-solid fa-plus"></i>
            </button>
        </form>

        <div id="tasks"> <!-- LISTA DE TAREFAS -->
            <?php foreach($tasks as $task): ?>  
            <div class="task">
                <input 
                    type="checkbox" 
                    name="progress" 
                    class="progress <?= $task['completed'] ? 'done' : '' ?>"
                    data-task-id="<?= $task['id']?>"
                    <?= $task['completed'] ? 'checked' : '' ?>> <!-- CHECKBOX CONCLUIDA TAREFA-->

                <p class="task-description"> <!-- NOME DA TAREFA-->
                    <?= $task['description'] ?>
                </p> 

                <div class="task-actions">
                    <a class="action-button edit-button"> <!-- BOTÃO ATUALIZAR TAREFA -->
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    <a href="actions/delete.php?id=<?= $task['id']?>" method='GET' class="action-button delete-button"> <!-- BOTÃO EXCLUIR TAREFA -->
                        <i class="fa-regular fa-trash-can"></i>
                    </a>
                </div>

                <form action="actions/update.php" method="POST" class="to-do-form edit-task hidden">
                    <input 
                        type="text" 
                        class="hidden" 
                        name="id" 
                        value="<?= $task['id']?>"
                    >
                    <input 
                        type="text" 
                        name="description" 
                        placeholder="edit your task here" 
                        value="<?= $task['description']?>"
                    > <!-- CAMPO EDITAR TAREFA -->
                    <button type="submit" class="form-button confirm-button"> <!-- BOTÃO GRAVAR EDICAO TAREFA -->
                        <i class="fa-solid fa-check"></i>
                    </button>
                </form>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <script src="./src/script/script.js"></script> <!-- JAVASCRIPT -->
</body>
</html>