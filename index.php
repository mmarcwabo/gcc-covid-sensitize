<?php
session_start();
        ?>
<!DOCTYPE html>
<html>
    <head>
        <title>GCC Contre Covid-19</title>
        <link rel="stylesheet" href="style/bootstrap.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="background-color: #eee;">
        <div class="container">

            <div class="page-header" style="text-align: center; padding: 7px;">
                <h1>GCC dit Stop Covid-19</h1>      
            </div> 
            <div style="text-align: center; padding: 7px;">
                <img src="img/logo-gcc.jpg" class="img-circle" alt="Goma Cycling Club" height="211" width="211">  
            </div>         
            <h2 class="title">Aidez-nous à sensibiliser pour limiter la propagation covid-19</h2>

            <form name="getGccCustom" action="image.php" method="POST" enctype="multipart/form-data">
                <div id="message-to-download"></div>
                <div class="form-group">
                    <label>Quel est votre nom ?</label>
                    <input type="text" name="name" class="form-control" placeholder="Saisissez votre nom" />
                </div>
                <div class="form-group">
                    <label>Que faites-vous dans la vie ? </label>
                    <input type="text" name="role" class="form-control" placeholder="Que faites-vous dans la vie?" />
                </div>
                <div class="form-group">
                    <label>Ajouter votre photo : </label>
                    <input type="file" class="form-control" name="photo" />
                </div>
                <button type="submit" class="btn btn-success">Obtenir ma carte de sensibilisation</button>
                
            </form>
            <form>
            <br/>
            <div class="form-group">
            <a href="<?php echo $_SESSION['current_image'] ?>" download>
                <button class="btn btn btn-success">
                    <i class="fa fa-download"></i> Download
                </button>
            </a>
            </div>
            </form>
        </div>


        <script src="style/bootstrap.min.js"></script>
    </body>
</html>
