<html>
    <body>
        <form action="scraper.php" method="POST">
            <h2>Select data</h2>
            <select name="selection">
                <option value="printer">Printer</option>
                <option value="projector">Projector</option>
                <option value="scanner">Scanner</option>
            </select>
            <input type="submit" value="Send">
        </form>
        <form action="../login/logout.php" method="POST">
            <input type="submit" value="Logout">
        </form>
    </body>
</html>

<?php
    function load_data($data){
        // Carga el archivo mediante el objeto simplexml_load_file
        $xml_data = simplexml_load_file("index.xml") or die("Err: Can't create the object");
        show_data($data, $xml_data);
    }

    function show_data($data, $xml_data){
        // Itera sobre el contenido que tiene el archivo xml y selecciona el hijo children()
        foreach ($xml_data->children() as $device){
            // Conprobacion del nombre que guarda la variable $device
            if ($device->getName() == $data) {
                // ucfirst() pone la primera letra en mayusculas
                echo "<br><br>" . ucfirst($device->getName()) . "<br>";
                // itera sobre $device y obtiene el hijo con children()
                foreach ($device->children() as $device_elements){
                    echo "<br>" . $device_elements->getName() . ": " . $device_elements;
                }
            }
        }
    }

    function data_reception(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST["selection"];
            load_data($data);   
        }
    }

    function session_started(){
        session_start();
        if (isset($_SESSION['name'])){
            echo "Session started<br>" . $_SESSION['name'];
            data_reception();
        } else {
            echo "Login please!";
            header("Location: ../index.html");
        }
    }

    session_started();
?>