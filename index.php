<?php
session_start();
include_once './libs/config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>GCC Contre Covid-19</title>
        <link rel="stylesheet" href="style/bootstrap.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style/main.css">
    </head>
    <body style="background-color: #eee;">
        <div class="container">
            <div class="page-header" style="text-align: center; padding: 7px;">
                <h1>GCC dit Stop Covid-19</h1>      
            </div> 
            <div style="text-align: center; padding: 7px;">
                <img src="img/logo-gcc.jpg" class="img-circle" alt="Goma Cycling Club" height="169" width="169">  
            </div>         
            <h3 class="" style="text-align: center; padding: 4px;">Aidez-nous à sensibiliser pour limiter la propagation du Corona virus et du Covid-19</h3>
            <?php if (isset($_SESSION['current_image'])) { ?>

                <br/>
                <div class="form-group" style="text-align: center; padding: 7px;">
                    <a href="<?php echo URL . $_SESSION['current_image']; ?>" download>
                        <button class="btn btn-success">
                            <i class="fa fa-download"></i> Télecharger ma carte de sensibilisation ici
                        </button>
                    </a>
                </div>

            <?php } ?>
            <form name="getGccCustom" action="image.php" method="POST" enctype="multipart/form-data">
                <div id="message-to-download"></div>
                <div class="form-group">
                    <label>Quel est votre nom ?</label>
                    <input type="text" name="name" class="form-control" placeholder="Saisissez votre nom" required/>
                </div>
                <div class="form-group">
                    <label>Que faites-vous dans la vie ? </label>
                    <input type="text" name="role" class="form-control" placeholder="Que faites-vous dans la vie?" required />
                </div>
                <div class="form-group">
                    <label>Ajouter votre photo : </label>
                    <input type="file" class="form-control" name="photo" />
                </div>
                <button id="register" type="submit" class="btn btn-success">Obtenir ma carte de sensibilisation</button>          
            </form>
                <br>
        </div>
        <div id="footer">
            Made with ❤️ by <a href="https://exsofth.com">Exsofth Dev Team</a>
        </div>
        <script src="style/bootstrap.min.js"></script>
        <script src="style/jquery.js"></script>
        </body>
</html>
