<?php ?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <title>titre</title>
        <link rel="stylesheet" href="css/style.css" />   
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

        <div class="container mt-2 border-right border-left">

            <br />
            <h2 class="ml-3">Bienvenue sur Tarn Greeter</h2>
            <br />
            <div class="row">
                <div class="col-md-4">
                    tis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem
                    aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
                    dolores eos qui ratione voluptatem sequi nesciunt. Neque por
                </div>
                <div class="col-md-8">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/QE-h-KZ55ts" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-4">
                    <img src="img/test1.jpg" />Albi<br/>
                    <br/><img src="img/test2.jpg" />Gaillac<br/>
                    <br/><img src="img/test3.jpg" /> Castres
                </div>
                <div class="col-md-6 d-flex flex-wrap">
                    <img src="img/test2.jpg" />
                    <img src="img/test3.jpg" />
                    <img src="img/test1.jpg" />
                    <img src="img/test3.jpg" />
                    <img src="img/test2.jpg" />
                    <img src="img/test1.jpg" />
                    <img src="img/test1.jpg" />
                    <img src="img/test2.jpg" />
                    <img src="img/test3.jpg" />
                </div>
            </div>

        </div>
        <?php require_once 'footer.php' ?>

    </body>

</html>