/*function fillInputsSAEmployee(row) {

    var cells = row.getElementsByTagName("td");
     document.getElementById("inputId").value = row.id;
    document.getElementById("inputName").value = cells[0].innerText;
    document.getElementById("inputMail").value = cells[3].innerText;
    document.getElementById("inputWorkPhone").value = cells[4].innerText;
    document.getElementById("inputInternalPhone").value = cells[5].innerText;
    document.getElementById("inputPersonalPhone").value = cells[6].innerText;
    document.getElementById("inputAddress").value = cells[6].innerText;
}*/

// function submitForm(action) {
//     document.getElementById('tableForm').action = action;
//     document.getElementById('tableForm').submit();
// }
document.addEventListener("DOMContentLoaded", function() {
    let form = document.getElementById("tableForm");
    let submitBtn = document.getElementById("submitBtn");

    form.addEventListener("input", function() {
        let isValid = form.checkValidity();
        submitBtn.disabled = !isValid;
    });
});
