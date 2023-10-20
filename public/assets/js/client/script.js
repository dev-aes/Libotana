const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
let pond;

$(() => {});

//=========================================================
// Custom Functions()
document.addEventListener("DOMContentLoaded", function (event) {
    // initiate global glightbox

    setTimeout(() => {
        GLightbox({
            selector: ".glightbox",
        });
    }, 1000);
});
