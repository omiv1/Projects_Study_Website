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

    var bformula = document.getElementById('formularz');
    bformula.addEventListener("click", () =>
    {
        console.log("Formularz");
        pokazFormularz();
    });
    var bkont = document.getElementById('index');
    bkont.addEventListener("click", () =>
    {
        console.log("Kontakt");
        pokazKontakt();
    });
});

       function pokazOnas() 
       {
        fetch("http://localhost/Lab11/skrypty/onas.php")
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
            fetch("http://localhost/Lab11/skrypty/galeria.php")
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
        fetch("http://localhost/Lab11/skrypty/formularz.php")
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
        fetch("http://localhost/Lab11/skrypty/glowna2.php")
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

   // jQuery
// $(document).ready(function() {
//     $(".navigation-btn").click(function() {
//         $(".navigation-btn").removeClass("active"); // Usuń aktywną klasę ze wszystkich przycisków
//         $(this).addClass("active"); // Dodaj aktywną klasę do klikniętego przycisku

//         var page = $(this).data("page"); // Pobierz atrybut data-page z przycisku
//         console.log("Strona " + page);
//         pokazStrone("skrypty/" + page + ".php");
//     });

//     // Dodaj obsługę pozostałych przycisków
//     // ...
// });

// function pokazStrone(url) {
//     $("#main").fadeOut(500, function() {
//         $.ajax({
//             url: url,
//             method: "GET",
//             success: function(data) {
//                 $("#main").html(data).fadeIn(500);
//             },
//             error: function(error) {
//                 console.log(error);
//             }
//         });
//     });
//}
