require('./bootstrap');

let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");
// let showAlertBtn = document.querySelector("#showAlertBtn");
// let addTaskForm = document.getElementById("addTaskForm");
closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
});

searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
});
// showAlertBtn.addEventListener("click",()=>{
//     // let userChoice = window.confirm('Would you like to add priority now?');
//     // if(userChoice == true) {
//     //     addTaskForm.submit()
//     //     window.location='task/{{$task->id}}/addPriority';  // you can also use element.submit() if your input type='submit'
//     // } else {
//     //     addTaskForm.submit()
//     // }
//     prompt("Hello");
// });

// following are the code to change sidebar button(optional)
function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
    } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");//replacing the iocns class
    }
}

