document.getElementById('visitorForm').addEventListener('submit', function(event) {
    var date = document.getElementById('date').value;
    var name = document.getElementById('name').value;
    var building = document.getElementById('building').value;
    var purpose = document.getElementById('purpose').value;
    var phone = document.getElementById('phone').value;
    var checkin = document.getElementById('checkin').value;
    var checkout = document.getElementById('checkout').value;

    if (!date || !name || !building || !purpose || !phone || !checkin || !checkout) {
        alert('Please fill out all fields');
        event.preventDefault();
    }
});
