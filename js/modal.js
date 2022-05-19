// Get the modal
var modal = document.getElementById("modal-account-creation");
// Get the button that opens the modal
var btn = document.getElementById("account-creation-button");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
btn.onclick = function(){modal.style.display = "block";}
// When the user clicks on the button, open the modal
var error = document.getElementById("error");
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
if(error.getAttribute("value") != "")
{
  modal.style.display = "block";
}
let ddn_jour = document.getElementById("birthday-day");
let ddn_mois = document.getElementById("birthday-month");
let ddn_annee = document.getElementById("birthday-year");
function change_birthday()
{
  if(ddn_mois.value == "january" || ddn_mois.value == "march" || ddn_mois.value == "may"
  || ddn_mois.value == "july"|| ddn_mois.value == "august"|| ddn_mois.value == "october"
  || ddn_mois.value == "december")
  {
    ddn_jour.max = 31;
  }
  else if(ddn_mois.value == "april" ||ddn_mois.value == "june"||ddn_mois.value == "september" 
  || ddn_mois.value == "november")
  {
    ddn_jour.max = 30;
    if(ddn_jour.value == 31)
    {
      ddn_jour.value = 30;
    }
  }
  else if(ddn_mois.value =="february")
  {
    if(ddn_annee.value % 4 == 0)
    {
      ddn_jour.max = 29;
      if(ddn_jour.value > 29)
      {
          ddn_jour.value = 29;
      }
    }
    else
    {
      ddn_jour.max = 28;
      if(ddn_jour.value > 28)
      {
          ddn_jour.value = 28;
      }
    }
  }
}