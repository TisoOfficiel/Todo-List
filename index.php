<?php
         
    $errors = "";
    //Connexion à la base de donnée 
    $db =mysqli_connect('localhost','root','', 'test');

    //Ajout d'une tache
    //Vérification de l'envoie du formulaire
    if(isset($_POST['submit'])){
        $task  = $_POST['action'];
        //Vérification que l'input action n'est pas vide
        if (empty($_POST['action'])){
            $errors = "Le champs est vide, remplissez le";
        }else{
            mysqli_query($db, "INSERT INTO TodoList (Titre) VALUES ('$task')");
            header('location: index.php');
        }
    };    

    //Suppression d'une tache
    if (isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM TodoList WHERE ID =$id;");
        header('location: index.php');               
    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
    }
    //Catch de toutes les taches
    $stack = mysqli_query($db, "SELECT * FROM TodoList");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>Todo List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <section>
        <div class="form-container">
            <h1>TODO LIST</h1>
            <form action="index.php" method="POST">
                <?php if(isset($errors)){?>
                    <p><?php echo $errors ?></p>
                <?php } ?>
                <div class="form-add">
                    <input type="text" class="input" name="action">
                    <input type="submit" name="submit">
                </div>
            </form>
            <?php   while($row = mysqli_fetch_array($stack)){?>
                <div class="row">
                    <p><?php echo $row['Titre'] ?> </p>
                    <div><a href="index.php?del_task=<?php echo $row['ID']; ?>"><i class="material-icons red">delete</i></a></div>
                </div>
            <?php } ?>
        </div>
    </section>

</body>
</html>