<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div id="searchbar" class="d-flex justify-content-between m-1 mt-2">
        <div>
            Show <select name="limit" id="limit">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select> entries
        </div>
        <input type="text" name="search" id="search" class="search m-1">
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name <a href="#" class="sort" value="firstname">&#9207;</a></th>
                <th scope="col">Email <a href="#" class="sort" value="email">&#9207;</a></th>
                <th scope="col">Username <a href="#" class="sort" value="username">&#9207;</a></th>
            </tr>
        </thead>
        <tbody>
            <!-- append -->
        </tbody>
    </table>
    <nav aria-label="Page navigation example" class="d-flex justify-content-between m-2">
        <span><span id="offset"></span> to <span id="rowPerPage"></span> of <span id="totalPage"></span></span>
        <ul class="pagination">

        </ul>
    </nav>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'POST',
                url: 'controller/pagination.php',
                dataType: 'json',
                success: function(res) {
                    fetchData(res);
                }
            });

            // previous page
            $(document).on('click', '.prevPage', function() {
                const page_no = $(this).attr('value');
                $.ajax({
                    type: 'get',
                    url: `controller/pagination.php?page_no=${page_no}`,
                    dataType: 'json',
                    success: function(res) {
                        fetchData(res)
                    }
                })
            });

            // next page
            $(document).on('click', '.nextPage', function() {
                const page_no = $(this).attr('value');
                $.ajax({
                    type: 'get',
                    url: `controller/pagination.php?page_no=${page_no}`,
                    dataType: 'json',
                    success: function(res) {
                        fetchData(res)
                    }
                })
            });



            var currentPage
            async function fetchData(res) {
                const result = await res;
                const data = result.data;
                const totalRowPerpage = result.totalRowPerpage;
                currentPage = result.currentPage;
                currentPage = currentPage - 1;
                currentPage = currentPage + 1;
                alert(currentPage)
                var html = '';
                data.forEach(col => {
                    html += `<tr>`;
                    html += `<td>${col.firstname} ${col.lastname}</td>`;
                    html += `<td>${col.email}</td>`;
                    html += `<td>${col.username}</td>`;
                    html += `</td>`;
                });

                $('tbody').html(html);

                var pagination = '';

                pagination += `<li class="page-item">
                                    <a class="page-link prevPage" href="#" value="${currentPage}">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>`;
                // numbers link

                pagination += `<li class="page-item">
                                    <a class="page-link nextPage" href="#" value="${currentPage}">
                                            <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>`;
                $('.pagination').html(pagination)
            }
        });
    </script>
</body>

</html>