function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.toggle("active");
}

document.querySelector(".main-content").addEventListener("click", () => {
  if (window.innerWidth <= 768) {
    document.getElementById("sidebar").classList.remove("active");
  }
});
