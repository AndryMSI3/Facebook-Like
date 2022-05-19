
let lien = document.getElementsByName("lien");

 let liste = document.getElementById("drop_bar");
let boite_recherche = document.getElementById("drop_box");


let nom_lien;
function showHint(str)
{
    if (str.length == 0) 
    { 
        return 0;
    } 
    else 
    {
        let i 
        let id;
        let tab_name = [];
        var xmlhttp = new XMLHttpRequest();
        liste.style.paddingBottom = "15px";
        boite_recherche.style.boxShadow="0px 2px 5px #b7b7b7";
        xmlhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200) 
            {
              // alert(this.responseText);
              let something = false;;
              tab_name = this.responseText.split(",");
              
              for(i = 1; i <= 5; i++)
              {
                id = "lien"+i;
                document.getElementById(id).innerText = tab_name[i-1];
                if(tab_name[i-1] == "" || tab_name[i-1] === undefined || tab_name[i-1] === null)
                {
                  document.getElementById(id).style.display = "none";

                }
                else
                {
                  something = true;
                  document.getElementById(id).style.display = "block";
                }
              }
              if(something == false)
              {
                document.getElementById("lien1").innerText = "No suggestion";
                document.getElementById("lien1").style.display = "block";

              }
            }
        };
        xmlhttp.open("GET", "Connection.php?q=" + str, true);
        xmlhttp.send();
    }
}
window.onclick = function(event) 
{
    if (event.target == boite_recherche || event.target == liste ||event.target == lien[0]||
      event.target == lien[1]||event.target == lien[2]||event.target == lien[3])
    {
      return;
    }
    else
    {
      boite_recherche.style.boxShadow="none";
      lien.forEach(element => {
        element.style.display = "none";
      });
    }
}
