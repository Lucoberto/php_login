<html>
    <body>
        <?php
            // Función para recibir datos del formulario y pasarlos por un array
            function data_reception(){
                $login_data = array($_POST["name"], $_POST["password"]);
                return $login_data;
            }

            // Función para establecer la conexión a la base de datos
            function db_connect(){
                // Datos para conexión a la base de datos
                $server = "localhost";
                $username = "root";
                $password = "Tolosa22";
                $dbname = "users";

                // Crear conexión
                $connection = new mysqli($server, $username, $password, $dbname);

                // Verificar la conexión
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                
                echo "Connected successfully<br>";
                return $connection;
            }

            // Función para seleccionar datos de la base de datos
            function data_selection($connection, $login_data){
                // Seleccionar un usuario y contraseña concretos
                $select_data = "SELECT user, password FROM login WHERE user = '" . $login_data[0] . "'";
                $query_result = $connection->query($select_data);
                
                // Comprobar si se devolvieron resultados
                if ($query_result->num_rows > 0){
                    while ($row = $query_result->fetch_assoc()){
                        // Enviar datos a la función para desencriptar la contraseña
                        decrypt_password($login_data, $row);
                    } 
                } else {
                    echo "0 results<br>";
                }
            }
            // inicia la sesion manteniendo las variables
            function start_session($username, $password){
                // inicio de la sesion
                session_start();
                // variables de la sesion
                $_SESSION["name"] = $username;
                $_SESSION["password"] = $password;
                echo "<br>" . $_SESSION["name"] . "<br>" . $_SESSION["password"];
                header("Location: ../inventory/scraper.php");
            }

            // Función para desencriptar la contraseña
            function decrypt_password($login_data, $db_data){
                // Verificar la contraseña desencriptada
                if (password_verify($login_data[1], $db_data["password"])){
                    echo "Login successful";
                    start_session($login_data[0], $login_data[1]);
                } else {
                    echo "Incorrect username or password";
                }
            }
            // Seleccionar datos de la base de datos y verificar la autenticación
            data_selection(db_connect(), data_reception());
        ?>
    </body>
</html>
