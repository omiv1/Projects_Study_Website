<?php 
function wyslij()
{
        $args = 
     [
      'tech' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' =>FILTER_REQUIRE_ARRAY],
     ];
        $dane = filter_input_array(INPUT_POST, $args) ["tech"];
                $tablica = array(
                    "C" => 0,
                    "CPP" => 0,
                    "Java" => 0,
                    "C#" => 0,
                    "HTML" => 0,
                    "CSS" => 0,
                    "XML" => 0,
                    "PHP" => 0,
                    "JavaScript" => 0
                );
              foreach($dane as $d){
                $tablica[$d]++;
              }
                $plik = fopen("ankieta.txt", "r");
                $line = fgets($plik);
                fclose($plik);
                if($line != "")
                {
                    $json_array = json_decode($line,true);//json_decode zapisuje w formie CPP=>1 (tablicy)// musi byc typu string
                    foreach($json_array as $key => $value)
                    {
                        $tablica[$key] += $value;
                    }
                }
                $plik = fopen("ankieta.txt","w");
                fwrite($plik, json_encode($tablica)); //json_endoce zaspisuje w formie CPP:1, JAVA:2(Stringa), argument musi byc typu array
                fclose($plik);
                foreach($tablica as $key => $value)
                {
                    echo '<p>' . $key . ':' .$value . '</p>';
                }

}
if (filter_input(INPUT_POST, "submit")) {
    $akcja = filter_input(INPUT_POST, "submit");
    switch ($akcja) {
        case "Wyślij" : wyslij();break;
    }
}
?>

