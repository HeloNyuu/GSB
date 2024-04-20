

var i = 1;
function ajouterEchantillon(input)
{
    if(i < 10)
    {
        $(".echantillon:last").clone().insertAfter(".echantillon:last"); 
        i++;
    } else {
        alert("Vous ne pouvez pas ajouter plus de 10 échantillons.");
    }
}