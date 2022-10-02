<?php

	session_start();
	if ($_SESSION['uprawnienia'] != "admin")
            header("location:index.php");
        require_once "baza.php";

        $conn = @new mysqli('localhost', 'root', '', 'mydb');
        if ($conn->connect_errno!=0)
        {
           echo "Error: ".$conn->connect_errno;
        }
        else
        {
            $stmt = $conn->prepare("DELETE FROM post WHERE idPost=?");
	        $stmt->bind_param('i', $_POST['usunId']);
			//bind_param() - przypisuje wartości zmiennej - pobiera wartości przez referencję
			
            $stmt->execute();
			//execute() wysyła całość do bazy danych - wykonuje przygotowaną instrukcję
			
            unset($_SESSION['blad']);
			// unset - Usuwa ustawienie danej zmiennej
			
            $stmt->close();
            header("Location: index.php");
        }
        $conn->close();
?>