<html>
    <body>
        <?php
            
            // recibir data del formulario y pasarlo por un array
            function data_reception(){
                require_once './filter.php';
                $register_data = array($_POST["name"], $_POST["password"]);
                $result = filter($register_data);
                if ($result){
                    return $register_data;
                } else {
                    header('location: ../index.html');
                    exit();
                }
                
            }
            
            // verificar usuario en caso de que exista que retorne un mensaje
            function user_verification($user, $connection){
                $users_selection = "SELECT user FROM login";
                $query_result = $connection->query($users_selection);
                foreach($query_result as $db_users){
                    if ($db_users["user"] == $user[0]){
                        echo "The user exists";
                        header("Location: ../index.html");
                        return;
                    }
                }
                encrypt_password(data_reception());
            }

            // db connection
            function db_connect(){
                // datos para conexion a la db
                $server = "localhost";
                $username = "root";
                // Hacer contraseña secreta
                $password = "Tolosa22";
                $dbname = "users";
                
                $connection = new mysqli($server, $username, $password, $dbname);
                
                // Comprobacion de la conexion "->" accede al error que puede dar $connection
                /*if (!$connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);*/
                
                if (!$connection) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                    echo "Connected successfully<br>";
                    return $connection;
                    //insert_resgister_data($connection);
            }

            // Registrar un usuario en la db
            function insert_resgister_data($connection, $password, $user){
                $register_query = "INSERT INTO login (user, password) Values ('$user[0]', '$password')";

                // === hace que estrictamente tenga que ser TRUE
                if ($connection->query($register_query) === TRUE){
                    echo "Your account has been created";
                } else {
                    echo "Error: " . $register_query . "<br>" . $connection->error;
                }
            }

            // encrypt module
            function encrypt_password($register_data){
                $password_unencrypted = $register_data[1];
                // PASSWORD_DEFAULT es un algorimo de hash
                $password_encrypted = password_hash($password_unencrypted, PASSWORD_DEFAULT);
                echo "This is your hash: <br>" . $password_encrypted;
                insert_resgister_data(db_connect(), $password_encrypted, $register_data);
            }
            user_verification(data_reception(), db_connect());
            //encrypt_password(data_reception());
        ?>
    </body>
</html>