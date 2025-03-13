let pagination_links = $('.pagination .page-link')

pagination_links.on('click', function (e) {
    e.preventDefault()

    if ($(this).parent().hasClass('active')) return;


    let page = this.getAttribute('data-page')
    let count = 4;
    let el = this;


    $.ajax({
        type: 'GET',
        url: app_url + `/front-api/news/${page}/${count}`,
        success:function(pagination){
            let data = pagination.data

            $(pagination_links).parent().removeClass('active');
            $(el).parent().addClass('active');
            $(el).blur()

            $('.news-item').remove()

            let html = '';

            for (let i=0; i<data.length; i++){
                html += '<div class="col-12 mb-5 p-3 border rounded news-item">';
                html += `<a href="${data[i].link}">`;
                html += `<h2 class="mb-2">${data[i].name}</h2>`;
                html += `<img src="${data[i].image_link}" alt="${data[i].name}" class="img-fluid mb-2">`;
                if (data[i].updated_at){
                    html += `<div class="text-end">${data[i].updated_at_formatted}</div>`;
                }else {
                    html += `<div class="text-end">${data[i].created_at_formatted}</div>`;
                }
                html += '</a>';
                html += '</div>';
            }

            if (history.pushState) {
                let baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                let newUrl = baseUrl + '?page='+ page;
                history.pushState(null, null, newUrl);
            }

            $('.news-block').html(html)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });

})
