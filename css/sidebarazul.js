function toggleNav() {
    var sidebar = document.querySelector(".sidebar");
    var main = document.querySelector("#main");
    var openbtn = document.querySelector(".openbtn");
    if (sidebar.style.width === "200px") {
      sidebar.style.width = "0";
      main.style.marginLeft = "0";
      openbtn.innerHTML = "&#9776;";
    } else {
      sidebar.style.width = "200px";
      main.style.marginLeft = "200px";
      openbtn.innerHTML = "&times;";
    }
  }