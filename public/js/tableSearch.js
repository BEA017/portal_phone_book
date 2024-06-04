
function myFunction() {
    var input = document.getElementById('myInput');
    var filter = input.value.toUpperCase();
    var table = document.getElementById('dataTable');
    var rows = table.getElementsByClassName('row');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('div');
        var found = false;

        for (var j = 0; j < cells.length; j++) {
            var cell = cells[j];

            if (cell) {
                var textValue = cell.textContent || cell.innerText;

                if (textValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }

        if (found) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

function AnyTablesSearch() {
    var input = document.getElementById('myInput');
    var filter = input.value.toUpperCase();
    var table = document.getElementById('dataTable');
    var rows = table.getElementsByTagName('tr');

    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var found = false;

        for (var j = 0; j < cells.length; j++) {
            var cell = cells[j];

            if (cell) {
                var textValue = cell.textContent || cell.innerText;

                if (textValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }

        if (found) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}
