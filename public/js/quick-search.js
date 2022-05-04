    function quickSearch(content) {
    const input = content.value;
    const products = document.getElementById('products');
    products.innerHTML = '<div class="spinner-border" role="status"></div>';
    let search = { text : content.value }
    const url = "{{env('APP_URL')}}";

        if (input){
            sendPost('/search/quick', search).then((result) => {
                let links ='';
                result.forEach(function(item) {
                links = links + '<a href="' + url + '/products/' + item.id + '\"' + ' class="btn btn-outline-secondary col-12 col-md-5 m-1">' + item.title.toUpperCase() + '</a>';
                })
                if(links){
                    products.innerHTML = links;
                } else {
                    products.innerHTML = '<p class="col" >Кажется, ничего не найдено ;(</p>' + '<a href="' + url + '/search/create"' +  'class="btn col-12 btn-secondary btn-lg mb-4">Начать поиск по параметрам</a>';
                }
            });
        } else {
            products.innerHTML = '<p class="col">Похоже, задан пустой запрос</p>' + '<a href="' + url + '/search/create"' +  'class="btn col-12 btn-secondary btn-lg mb-4">Начать поиск по параметрам</a>';
        }
    }
    async function sendPost(url, data){

    let response = await fetch(url, {
    method: 'POST',
    headers: {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
    .getAttribute('content'),
    'Content-Type': 'application/json; charset=utf-8',
},
    body: JSON.stringify(data)
});
    return await response.json();
}
