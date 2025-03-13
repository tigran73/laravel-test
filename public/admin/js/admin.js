let pagination_links = $('.pagination .page-link')

pagination_links.on('click', function (e) {
    e.preventDefault()

    if ($(this).parent().hasClass('active')) return;


    let page = this.getAttribute('data-page')
    let count = 5;
    let el = this;


    $.ajax({
        type: 'GET',
        url: app_url + `/api/admin/${pagination_type}/${page}/${count}`,
        success: function (pagination) {
            let news = pagination.news

            $(pagination_links).parent().removeClass('active');
            $(el).parent().addClass('active');
            $(el).blur()

            $('.news-rows').remove()

            let html = '';

            for (let i = 0; i < news.length; i++) {
                html += '<tr class="news-rows">';
                html += `<th scope="row">${news[i].id}</th>`;
                html += `<td>${news[i].name}</td>`;
                html += `<td>
                            <div class="d-flex">
                            <a class="btn btn-info me-2" href="${news[i].link_show}">Show</a>
                            <a class="btn btn-warning me-2" href="${news[i].link_edit}">Edit</a>
                            <form action="${news[i].link_delete}" method="POST">
                                        <input type="hidden" name="_token" value="${pagination.csrf}" autocomplete="off">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            </div>
                        </td>`;
                html += '</tr>';
            }

            if (history.pushState) {
                let baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                let newUrl = baseUrl + '?page=' + page;
                history.pushState(null, null, newUrl);
            }

            $(`.${pagination_type}-table tbody`).html(html)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });

})
