<?php ?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <title>titre</title>
        <link rel="stylesheet" href="css/style.css" />
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/class-project.js"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>



    </head>

    <body>
        <?php require_once 'header.php' ?>

        <div class="container">
            
            <button id="alphabetique" class="m-4">Trier les villes par ordre Alphabétique</button>
            <button id="alphabetique" class="m-4">Trier les villes par Population</button>
            <button id="alphabetique" class="m-4">Trier les villes par Superficie</button>
            <div class="card-columns" id="projects">

          </div>
          
        </div>
        <?php require_once 'footer.php' ?>

    </body>

</html>