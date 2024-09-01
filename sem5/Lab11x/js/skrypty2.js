document.addEventListener('DOMContentLoaded', () => {
    var bonas = document.getElementById('onas');
    bonas.addEventListener("click", () => {
        console.log("Strona O nas"); 
        pokazOnas();
    });

    var bgaleria = document.getElementById('galeria');
    bgaleria.addEventListener("click", () => { 
        console.log("Galeria zdjęć");
        pokazGalerie();
    });

    var formula = document.getElementById('formularz');
    formula.addEventListener("click", () => {
        console.log("Formularz");
        pokazFormularz();
    });

    var kont = document.getElementById('index');
    kont.addEventListener("click", () => {
        console.log("Kontakt");
        pokazKontakt();
    });
});

function pokazOnas() {
    pokazStrone("skrypty/onas.php");
}

function pokazGalerie() {
    pokazStrone("skrypty/galeria.php");
}

function pokazFormularz() {
    pokazStrone("skrypty/formularz.php");
}

function pokazKontakt() {
    pokazStrone("skrypty/glowna2.php");
}

// Funkcja do pokazywania stron
function pokazStrone(url) {
    $("#main").fadeOut(500, function() {
        $.ajax({
            url: url,
            method: "GET",
            success: function(data) {
                $("#main").html(data).fadeIn(500);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
}
        // function czysc()
        // {
        //     $.ajax({
        //         type: "POST",
                
        //     })
        // }
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