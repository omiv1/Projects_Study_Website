<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Szybki kurs HTML </title>
</head>
<body>
	<div id="kontener">
	<div id="baner"> <h2>Szybki kurs HTML</h2></div>
	<div id="menu"> <a href="index.html">Podstawowe znaczniki</a> 
		<a href="tabele.html">Tworzenie tabel</a> 
		<a href="formularze.html">Budowa formularzy</a> </div>
	<div id="tresc"> <h3>Podstawowe znaczniki html to:</h3> <ul>
		<li>&lt;form&gt; - znacznik podstawowy zawierający pola formularza</li> 
		<li>&lt;input&gt; - znaczniki umożliwia wstawianie różnych pól 
			(pole tekstowe, przycisk typu radio, przycisk typu chackbox)
			w zależności od wartości jego atrybutu typu</li> 
		<li>&lt;select&gt; - pole formularza typu lista rozwijana</li>
		<li>&lt;textarea&gt; - pole formularza typu obszar tekstowy</li>
		<li>&lt;button&gt; - pole forularza typu obszar tekstowy</li>
		</ul></div>
	<div id="formularz"> <h3>Przykładowy formularz HTML:</h3>
		<form action='pliki.php' method="get">
		<table >
		<tbody>
			<tr>
				<td>Nazwisko:</td>
				<td><input type="text" name="nazwisko"/></td>
			</tr>
			<tr>
				<td>Wiek:</td>
				<td><input type="number" name="wiek"/></td>
			</tr>
			<tr>
				<td>Państwo:</td>
				<td>
					<select size="1" name="panstwo">
					<option value="Polska">Polska</option>
					<option value="Niemcy">Niemcy</option>
					<option value="Francja">Francja</option>
					<option value="Szwecja">Szwecja</option>
					<option value="Czechy">Czechy</option>
					</select></td>
			</tr>
			<tr>
				<td>Adres e-mail:</td>
				<td><input type="" name="email"/></td>
		</tbody>
		</table>
		
		<br><b>Zamawiam tutorial z języka:</b><br><br>
		<input type="checkbox" name="jezyk[]" value="PHP" /> PHP
		<input type="checkbox" name="jezyk[]" value="C/C++" /> C/C++
		<input type="checkbox" name="jezyk[]" value="Java" /> Java <br><br />
		
		<b>Sposób zapłaty:</b> <br><br/>
		<input type="radio" name="metoda" value="eurocard" /> eurocard
		<input type="radio" name="metoda" value="visa" /> visa
		<input type="radio" name="metoda" value="przelew" /> przelew bankowy <br>
		<input type="submit" name="submit" value="Wyczysc" />
				<input type="submit" name="submit" value="Zapisz" />
				<input type="submit" name="submit" value="Pokaz" />
				<input type="submit" name="submit" value="PHP" />
				<input type="submit" name="submit" value="CPP" />
				<input type="submit" name="submit" value="Java" />
		</form>
	</div>
	<?php
	//Funkcje pomocnicze:
	function dodaj2() {
	$dane = "";
	if (isset($_REQUEST["nazw"])) {
	$dane .= htmlspecialchars($_REQUEST['nazw'])." ";
	}
		$plik = fopen ("dane.txt","a");
		flock($plik,LOCK_EX);
		fwrite($plik,$dane . "/n");
		flock($plik,LOCK_UN);
		fclose($plik);
	//zbierz pozostałe dane z formularza – dodając je do łańcucha $dane
	//zapisz łańcuch z danymi do pliku dane.txt w postaci wiersza np.:
	//Agatowska 21 Polska agatka@gmail.com PHP,CPP,Java Visa
	} 
	function dodaj() {
		if (isset($_REQUEST["nazwisko"])) {
			$dane = $_REQUEST["nazwisko"] . " " . $_REQUEST["wiek"] . " " . $_REQUEST["panstwo"] . " " . $_REQUEST["email"] . " ";
			if (isset($_REQUEST["jezyk"])) {
				$dane .= implode(",", $_REQUEST["jezyk"]);
			}
			$dane .= " " . $_REQUEST["metoda"];

		$plik = fopen ("dane.txt","a");
		flock($plik,LOCK_EX);
		fwrite($plik,$dane . "\n");
		flock($plik,LOCK_UN);
		fclose($plik);
		}
	}
	function pokaz() {
		$data = file_get_contents("dane.txt");
		$lines = explode("\n", $data);
		foreach ($lines as $line) {
			echo $line . "<br>";
		}
	}

	function pokaz_zamowienie2($tut) {
		$data = file_get_contents("dane.txt");
		$lines = explode("\n", $data);
		foreach ($lines as $line) {
			$fields = explode(" ", $line);
			if (in_array($tut, $fields)) {
				echo $line . "<br>";
			}
		}
	}
	function pokaz_zamowienie($tut) {
		$data = file_get_contents("dane.txt");
		$lines = explode("\n", $data);
		foreach ($lines as $line) {
			$part = explode(" ", $line);
			if (isset($part[4]) && strpos($part[4], $tut) !== false) {
				echo $line . "<br>";
			}
		}
	}	


	// Skrypt właściwy do obsługi akcji (żądań):
	if (isset($_REQUEST["submit"])) {
		$akcja = $_REQUEST["submit"];
		switch ($akcja) {
			case "Zapisz":
			 dodaj();
			 break;
			case "Pokaz":
			 pokaz();
			 break;
			case "Java":
			 pokaz_zamowienie("Java");
			 break;
			case "PHP":
			 pokaz_zamowienie("PHP");
			 break;
			case "CPP":
			 pokaz_zamowienie("C/C++");
			 break;
			default:
			 // Obsłuż pozostałe przypadki
		}
	}
	// echo "<h2>Zawartość tablicy \$_SERVER:</h2>";
	// echo "<pre>";
	// print_r($_SERVER);
	// echo "</pre>";
	?>
		
	<div id="stopka"> <br>&copy;BP </div>
	</div>
</body>
</html>
