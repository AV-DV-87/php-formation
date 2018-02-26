<?php
session_start(); //ouverture de la session existante depuis session_start du fichiers 1
echo "<pre>"; print_r($_SESSION); echo "</pre>";
//enregistré coté serveur ce fichier tmp/session est encodé et sécurisé.
//un cookies est créé coté client pour permettre de décodé les informations du fichier session
//permet de maintenir une connexion constante et de garder les données du client pour personnliser son expèrience