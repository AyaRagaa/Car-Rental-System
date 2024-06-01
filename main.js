document.addEventListener("DOMContentLoaded", function () {
    // Fetch reservations data from the server
    fetchReservations();
});

function fetchReservations() {
    // Make an AJAX request to fetch reservations
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "getReservations.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response and display reservations
            const reservationsContainer = document.getElementById('reservations-container');
            if (reservationsContainer) {
                reservationsContainer.innerHTML = xhr.responseText;
            }
        }
    };
    xhr.send();
}
