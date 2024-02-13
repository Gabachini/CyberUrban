<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
        <title>Admin Dashboard | Keyframe Effects</title>
        <link rel="stylesheet" href="css/StyleUser.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    </head>
    <body>
    <input type="checkbox" id="menu-toggle">
        <div class="sidebar">   
            <div class="side-content">
                <div class="side-menu">
                    <ul>
                        <li>
                        <a href="InfoPersonalTr.php">
                                <span class="las la-home"></span>
                                <small>Información personal</small>
                            </a>
                        </li>
                        <li>
                        <a href="InfoServiTr.php">
                                <span class="las la-user-alt"></span>
                                <small>Servicios</small>
                            </a>
                        </li>
                        <li>
                        <a href="InfoProgrTr.php">
                                <span class="las la-envelope"></span>
                                <small>Programas</small>
                            </a>
                        </li>
                        <li>
                        <a href="InfoIncidenTr.php" class="active">
                                <span class="las la-clipboard-list"></span>
                                <small>Incidencias</small>
                            </a>
                        </li>
                        <li>
                        <a href="InfoDepSerProg.php">
                                <span class="las la-shopping-cart"></span>
                                <small>Reservas</small>
                            </a>
                        </li>
                        <li>
                        <a href="InfoResenyesTr.php">
                                <span class="las la-tasks"></span>
                                <small>Reseñas</small>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <header>
                <div class="header-content">
                    <label for="menu-toggle">
                        <span class="las la-bars"></span>
                    </label>
                    <div class="header-menu">
                        <a href="Index.html" class="active">
                            <div class="user">
                                <div class="bg-img"></div>
                                <span class="las la-power-off"></span>
                                <span>Logout</span>
                            </div>
                        </a>
                    </div>
                </div>
            </header>
        </div>
    </body>
</html>