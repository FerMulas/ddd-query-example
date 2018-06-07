var currentPage = 1;
var totalPages = 0;
var query = "";
var ordination = [];
ordination['field'] = null;
ordination['direction'] = null;
var columns = ['id', 'title', 'link', 'city', 'mainImage'];

function getAppartments() {
    reset(false);
    var apartmentTableData = document.getElementById("apartmentTableData");
    var error = document.getElementById("error");

    var xmlHttp = new XMLHttpRequest();
    createQuery();

    console.log(query);

    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState === 4) {
            if (xmlHttp.status === 200) {
                createPagination(JSON.parse(xmlHttp.responseText));

                var apartmentData = JSON.parse(xmlHttp.responseText).results;

                apartmentData.forEach(function (elem) {
                    var tr = document.createElement('tr');
                    var td = document.createElement('td');

                    td.innerHTML = elem.id;
                    tr.appendChild(td);

                    td = document.createElement('td');
                    td.innerHTML = elem.title;
                    tr.appendChild(td);

                    td = document.createElement('td');
                    td.innerHTML = elem.link;
                    tr.appendChild(td);

                    td = document.createElement('td');
                    td.innerHTML = elem.city;
                    tr.appendChild(td);

                    td = document.createElement('td');
                    td.innerHTML = elem.mainImage;
                    tr.appendChild(td);

                    apartmentTableData.appendChild(tr);
                });
            } else {
                error.innerHTML = "Error: " + xmlHttp.responseText;
            }
        }
    };

    console.log(query);

    xmlHttp.open("GET", "http://0.0.0.0:8090/apartments?" + query, true);

    xmlHttp.send();

    setTimeout(cleanMessages, 3000);
}

function resetArrowSymbols() {
    for (var col in columns) {
        console.log(columns[col] + 'Ordination');
        document.getElementById(columns[col] + 'Ordination').classList.add("fa-sort");
        document.getElementById(columns[col] + 'Ordination').classList.remove("fa-sort-down");
        document.getElementById(columns[col] + 'Ordination').classList.remove("fa-sort-up");
    }
}

function reset(resetAll) {
    var apartmentTableData = document.getElementById("apartmentTableData");
    var error = document.getElementById("error");

    error.innerHTML = "";
    apartmentTableData.innerHTML = "";

    currentPage = 1;

    if (document.contains(document.getElementById("paginatorList"))) {
        document.getElementById("paginatorList").remove();
    }

    if (resetAll) {
        ordinationField = null;
        resetArrowSymbols();
    }
}

function cleanMessages() {
    var error = document.getElementById("error");
    var success = document.getElementById("success");

    success.innerHTML = "";
    error.innerHTML = "";
}

function createPagination(responseResult) {
    totalPages = responseResult.totalPages;
    if (!document.getElementById('paginatorList')) {
        var pagination = document.getElementById("pagination");

        var ul = document.createElement('ul');
        ul.setAttribute("id", "paginatorList");
        ul.className = "pagination justify-content-center";
        pagination.appendChild(ul);

        var li = document.createElement('li');
        li.className = "page-item";
        li.innerHTML = '<a id="previous" class="page-link" onclick="previousPage()" aria-label="Previous">' +
            '<span aria-hidden="true">&laquo;</span>' +
            '<span class="sr-only">Previous</span>' +
            '</a>';
        ul.appendChild(li);

        li = document.createElement('li');
        li.className = "page-item active";
        li.innerHTML = '<a onclick="setPage(' + 1 + ')" class="page-link">1</a>';
        ul.appendChild(li);

        for (var i = 2; i <= totalPages; i++) {
            li = document.createElement('li');
            li.className = "page-item";
            li.innerHTML = '<a onclick="setPage(' + i + ')" class="page-link">' + i + '</a>';
            ul.appendChild(li);
        }

        li = document.createElement('li');
        li.className = "page-item";
        li.innerHTML = '<a id="next" class="page-link" onclick="nextPage()" aria-label="Previous">' +
            '<span aria-hidden="true">&raquo;</span>' +
            '<span class="sr-only">Next</span>' +
            '</a>';
        ul.appendChild(li);
    }

    setActivePage();
}

function setPage(pageNumber) {
    currentPage = pageNumber;
    getAppartments();
}

function nextPage() {
    if (currentPage < totalPages) {
        currentPage++;
    }

    getAppartments();
}

function previousPage() {
    if (currentPage > 1) {
        currentPage--;
    }

    getAppartments();
}Float

function setActivePage() {
    var pages = document.getElementById('paginatorList').getElementsByTagName("li");

    for (var i = 0; i < pages.length; i++) {
        pages[i].classList.remove("active");
    }

    pages[currentPage].classList.add("active");

    if (currentPage === 1) {
        pages[0].classList.add("disabled")
    }

    if (currentPage === totalPages) {
        pages[pages.length - 1].classList.add("disabled")
    }
}

function changeOrdinationCriteria(field) {
    resetArrowSymbols();

    if (ordination['field'] === field) {
        ordination['direction'] = ordination['direction'] === 'ASC' ? 'DESC' : 'ASC';

    } else {
        ordination['field'] = field;
        ordination['direction'] = 'ASC';
    }

    var newClass = ordination['direction'] === 'ASC' ? 'fa-sort-up' : 'fa-sort-down';
    document.getElementById(field + "Ordination").classList.add(newClass);

    getAppartments();
}

function createQuery() {
    query = "page=" + currentPage + "&pageSize=5";

    if (ordination['field'] !== null) {
        query = query + "&ordinationField=" + ordination['field'] + "&ordinationDirection=" + ordination['direction'];
    }
}
