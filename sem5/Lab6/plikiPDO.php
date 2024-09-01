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
		<input type="checkbox" name="jezyk[]" value="JavaScript" /> JavaScript
		<input type="checkbox" name="jezyk[]" value="Java" /> Java <br><br />
		
		<b>Sposób zapłaty:</b> <br><br/>
		<input type="radio" name="metoda" value="eurocard" /> eurocard
		<input type="radio" name="metoda" value="visa" /> visa
		<input type="radio" name="metoda" value="przelew" /> przelew bankowy <br>
		<input type="submit" name="submit" value="Wyczysc" />
				<input type="submit" name="submit" value="Dodaj" />
				<input type="submit" name="submit" value="Pokaz" />
				<input type="submit" name="submit" value="PHP" />
				<input type="submit" name="submit" value="CPP" />
				<input type="submit" name="submit" value="Java" />
				<input type="submit" name="submit" value="JavaScript" />
				<input type="submit" name="submit" value="Statystyki" />
		</form>
	</div>
	<?php
	include_once("funkcje.php");
	include_once("bazaPDO.php");
	//tworzymy uchwyt do bazy danych:
	$bd = new BazaPDO("localhost", "klienci","root","");
	$akcja = filter_input(INPUT_GET, "submit", FILTER_SANITIZE_STRING);
	// if ($akcja) 
	// {
	// 	switch ($akcja) 
	// 	{
	// 		case "Dodaj" : $bd->dodajdoBD($bd); break;
	// 		case "Pokaz" : echo $bd->select("select Nazwisko,Zamowienie from klienci", ["Nazwisko","Zamowienie"]); break;
	// 	}
	// }
	if ($akcja) {
		switch ($akcja) {
			case "Dodaj":
				$bd->dodajdoBD($bd);
				break;
			case "Pokaz":
				echo $bd->select("select nazwisko,wiek,panstwo,email,zamowienie,metoda from klienci", ["nazwisko","wiek","panstwo","email","zamowienie","metoda"]);
				break;
			case "Java":
				echo $bd->select("select nazwisko,wiek,panstwo,email,zamowienie,metoda from klienci where zamowienie like '%Java%' AND NOT zamowienie LIKE '%JavaScript%'", ["nazwisko","wiek","panstwo","email","zamowienie","metoda"]);
				break;
			case "PHP":
				echo $bd->select("select nazwisko,wiek,panstwo,email,zamowienie,metoda from klienci where zamowienie like '%PHP%' ", ["nazwisko","wiek","panstwo","email","zamowienie","metoda"]);
				break;
			case "CPP":
				echo $bd->select("select nazwisko,wiek,panstwo,email,zamowienie,metoda from klienci where zamowienie like '%C/C++%' ", ["nazwisko","wiek","panstwo","email","zamowienie","metoda"]);
				break;
			case "JavaScript":
				echo $bd->select("select nazwisko,wiek,panstwo,email,zamowienie,metoda from klienci where zamowienie like '%JavaScript%' ", ["nazwisko","wiek","panstwo","email","zamowienie","metoda"]);
				break;
			case "Statystyki":
				$bd->statystyki($bd);
				break;
			default:
				break;
		}
	}
	?>
	<?php
	// include_once "funkcje.php";

	// $akcja = filter_input(INPUT_GET, "submit", FILTER_SANITIZE_STRING);
	// if ($akcja) {
	// 	switch ($akcja) {
	// 		case "Zapisz":
	// 			dodaj();
	// 			break;
	// 		case "Pokaz":
	// 			pokaz();
	// 			break;
	// 		case "Java":
	// 			pokaz_zamowienie("Java");
	// 			break;
	// 		case "PHP":
	// 			pokaz_zamowienie("PHP");
	// 			break;
	// 		case "CPP":
	// 			pokaz_zamowienie("C/C++");
	// 			break;
	// 		case "JavaScript":
	// 			pokaz_zamowienie("JavaScript");
	// 			break;
	// 		case "Statystyki":
	// 			statystyki();
	// 			break;
	// 		default:
	// 			break;
	// 	}
	// }
	?>
		
	<div id="stopka"> <br>&copy;BP </div>
	</div>
</body>
</html>
