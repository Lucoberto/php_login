<html>
    <head>
        <title>Add data</title>
    </head>
    <body>
        <form action="add_comment.php" method="POST">
            <h2>Add comment</h2>
            <a>Name: <input type="text" name="name"></a>
            <br>
            <a>Email: <input type="email" name="email"></a>
            <br>
            <textarea></textarea>
            <input type="submit" value="Send">
        </form>
        <form action="../login/logout.php" method="POST">
            <input type="submit" value="Logout">
        </form>
    </body>
</html>

<php?
    session_start(); 
    