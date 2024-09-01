//Fetch API
document.addEventListener('DOMContentLoaded', () => {
    
    var bonas = document.getElementById('onas');
    bonas.addEventListener("click", () => 
    {
        console.log("Strona O nas"); 
        pokazOnas();
        });
    var bgaleria = document.getElementById('galeria');
    bgaleria.addEventListener("click", () => 
    { 
            console.log("Galeria zdjęć");
            pokazGalerie();
        });

    var formula = document.getElementById('formularz');
    formula.addEventListener("click", () =>
    {
        console.log("Formularz");
        pokazFormularz();
    });
    var kont = document.getElementById('indexx');
    kont.addEventListener("click", () =>
    {
        console.log("Kontakt");
        pokazKontakt();
    });
});

       function pokazOnas() 
       {
        fetch("http://localhost/Lab11p/skrypty/onas.php")
            .then((response) => {
                if (response.status !== 200) {
                    return Promise.reject('Coś poszło nie tak!');
                 }
                 return response.text();
            })
             .then((data) => {
                 document.getElementById('main').innerHTML=data;
             })
            .catch((error) => {
                  console.log(error);
            });
       }
       function pokazGalerie() {
            fetch("http://localhost/Lab11p/skrypty/galeria.php")
                .then((response) => {
                     if (response.status !== 200) {
                         return Promise.reject('Coś poszło nie tak!');
                      }
                     return response.text();
                 })
                 .then((data) => {
                     document.getElementById('main').innerHTML=data;
                 })
                 .catch((error) => {
                     console.log(error);
                });
       }
       function pokazFormularz()
       {
        fetch("http://localhost/Lab11p/skrypty/formularz.php")
        .then((response) => {
             if (response.status !== 200) {
                 return Promise.reject('Coś poszło nie tak!');
              }
             return response.text();
         })
         .then((data) => {
             document.getElementById('main').innerHTML=data;
         })
         .catch((error) => {
             console.log(error);
        });
        }
        function pokazKontakt()
        {
        fetch("http://localhost/Lab11p/skrypty/glowna2.php")
        .then((response) => {
            if (response.status !== 200) {
                return Promise.reject('Coś poszło nie tak!');
            }
            return response.text();
        })
        .then((data) => {
            document.getElementById('main').innerHTML=data;
        })
        .catch((error) => {
            console.log(error);
        });
        }
        
        function dodaj2() {
            let data = {};
            var values = new Array();
            data.Nazwisko = $('#Nazwisko').val().toString();
            data.email = $('#email').val().toString();
            data.radioboxy = $("input:radio[name='radioboxy']:checked").val().toString();
            data.age = $('#age').val().toString();
            $.each($("input[name='jezyki[]']:checked"), function(){
                values.push($(this).val());
                console.log(values);
            });
            console.log("wartosc = " + values);
            data.jezyki = values;
            data.jezyki = $('jezyki[]').val().toString();
            data.Kraje = $('#Kraje').children("option:selected").val().toString();
            if(data == null)
            {
                return;
            }
            $.ajax({
                type: "POST",
                url: "skrypty/formularz.php",
                data:data,
                success: function(result){
                    $('#main')[0].innerHTML = result;
                },
                error: function(xhr,status,error)
                {
                    console.error(xhr,status,error);
                }
            }
            )
           } 
           function dodaj() {
            let data = {};
            var values = new Array();
            data.Nazwisko = $('#Nazwisko').val().toString();
            data.email = $('#email').val().toString();
            data.radioboxy = $("input:radio[name='radioboxy']:checked").val().toString();
            data.age = $('#age').val().toString();
            $.each($("input[name='jezyki[]']:checked"), function(){
                values.push($(this).val());
            });
            data.jezyki = values;
            console.log("wartosc = " + values);
            data.Kraje = $('#Kraje').children("option:selected").val().toString();
            if(data == null)
            {
                return;
            }
            $.ajax({
                type: "POST",
                url: "skrypty/formularz.php",
                data:data,
                success: function(result){
                    $('#main')[0].innerHTML = result;
                },
                error: function(xhr,status,error)
                {
                    console.error(xhr,status,error);
                }
            }
            )
           } 
           function pokaz() {
            $.ajax({
                type: "GET",
                url: "skrypty/pokaz.php",
                data:"html",
                success: function(result){
                    $('#database-display').html(result);
                },
                error: function(xhr,status,error)
                {
                    console.error(xhr,status,error);
                }
            }
            )
           } 