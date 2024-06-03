<?php
    echo "<h1>Adding data</h1>";

    function add_form_data(){
        $load_xml_data = new DOMDocument();
        $load_xml_data->load('index.xml');
    }

    add_form_data();