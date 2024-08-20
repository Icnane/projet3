<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "bd formation";
    
    $Id = $_POST["id_formation"]; 
    $Nom = $_POST["nom"];
    $Prenom = $_POST["prenom"]; 
    $DateNais = $_POST["datenais"];
    $Contact = $_POST["contact"]; 
    $Ville = $_POST["ville"];
    $email = $_POST["pays"];
    $email = $_POST["email"];

    if (empty($id_formation)) {
        die("S'il vous plaît entrez votre id_formation");
    }
    if (empty($nom)) {
        die("S'il vous plaît entrez votre nom");
    }  
    if (empty($prenom)) {
        die("S'il vous plaît entrez votre prenom");
    }
    if (empty($datenais)) {
        die("S'il vous plaît entrez votre Date de Naissance");
    }  
    if (empty($contact)) {
        die("S'il vous plaît entrez votre contact");
    }
    if (empty($ville)) {
        die("S'il vous plaît entrez votre Ville");
    } 
    if (empty($pays)) {
        die("S'il vous plaît entrez votre pays");
    }  
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("S'il vous plaît entrez un email valide");
    }

    $datenais = date('Y-m-d', strtotime($datenais));

    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        die('Erreur de connexion (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }  
    
    $statement = $mysqli->prepare("INSERT INTO participants (Id, Nom, Prenom, DateNais, Contact, Ville, email) VALUES (?,?,?,?,?,?,?)");
    
    $statement->bind_param('sssssss', $id_participant, $nom, $prenom, $datenais, $contact, $ville, $pays, $email);
    
    if ($statement->execute()) {
        echo "Salut " . $nom . " " . $prenom . "!, votre enregistrement a été effectué avec succès.";
    } else {
        echo "Erreur : " . $mysqli->error; 
    }
    $statement->close();
    $mysqli->close();
    // Redirection vers la page d'accueil
    header("Location: index.html");
    exit();
}
?>