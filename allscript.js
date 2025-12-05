function checkdelet(event) {
    event.preventDefault(); // stop reload

    swal({
        title: "Are you sure?",
        text: "Once deleted, you cannot recover it!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            // If user confirms → redirect manually
            window.location.href = event.target.href;
        } else {
            swal("Your file is safe!");
        }
    });

    return false; // extra safety
}


    function checkedit() {
        return confirm("Are you sure you want to edit?");
    }

const btnDashboard = document.querySelector(".btn-dashboard"); // New selector for dashboard button
const btnAjouterCours = document.querySelector(".btn-ajouter-cours");
const formCours = document.querySelector(".part-cours");
const formEquipement = document.querySelector(".part-equipement");
const dashbordAll = document.querySelector(".stats-grid");
const btnAjouterEquipement = document.querySelector(".btn-ajouter-equipement");
const listCours = document.querySelector(".list-cours");
const listEquipement = document.querySelector(".list-equipement");
const textDashboard = document.querySelector(".text-dashboard");
const partTypeCours = document.querySelector("#part-type-cours");

// --- Helper function to manage visibility ---
function setVisibility(dashboard, addCours, addEquipement, listCoursVisible, listEquipementVisible) {
    dashbordAll.style.display = dashboard ? "grid" : "none";
    formCours.style.display = addCours ? "block" : "none";
    formEquipement.style.display = addEquipement ? "block" : "none";
    listCours.style.display = listCoursVisible ? "block" : "none";
    listEquipement.style.display = listEquipementVisible ? "block" : "none";
}

// 1. Dashboard Button Handler
btnDashboard.addEventListener("click", (e) => {
    e.preventDefault();
    setVisibility(true, false, false, false, false);
    textDashboard.style.display = "block";
    partTypeCours.style.display = ""
});


// 2. Add Course Button Handler
btnAjouterCours.addEventListener("click", (e) => {
    e.preventDefault();
    setVisibility(false, true, false, true, false);
    textDashboard.style.display = "none";
    partTypeCours.style.display = "none"
});

// 3. Add Equipment Button Handler
btnAjouterEquipement.addEventListener('click', (e) => { // Added 'e' and 'e.preventDefault()'
    e.preventDefault();
    // Show Equipment Form and Equipment List, hide others
    setVisibility(false, false, true, false, true);
    textDashboard.style.display = "none";
    partTypeCours.style.display = "none"
});
setVisibility(true, false, false, false, false);