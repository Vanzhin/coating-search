    document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll("a.compare");
    buttons.forEach(button => button.addEventListener("click", function() {
    button.classList.toggle("disabled");
    button.innerHTML = '<div class="spinner-border" role="status"></div>';
    const id = this.getAttribute('compare');
    sendProductToCompare('/products/compare/' + id).then(() => {
    // location.reload();
    button.classList.toggle("disabled");

})
}));
});
    async function sendProductToCompare(url){

    let response = await fetch(url, {
    method: 'GET',
});
    let result = await response.json();
    const prod_id = result.product_id;
    const badges = document.querySelectorAll('.product-to-compare');
    const compare_btns = document.querySelectorAll('.compare-btn');

    const btn = document.getElementById('prod-'+ prod_id);
    btn.classList.toggle("add");

    if(result.total > 1){
    badges.forEach(badge => badge.innerText = result.total)
    compare_btns.forEach(compare_btn => compare_btn.classList.remove('disabled'))
} else if(result.total === 0){
    badges.forEach(badge => badge.innerText = '')
    compare_btns.forEach(compare_btn => compare_btn.classList.add('disabled'))
} else{
    badges.forEach(badge => badge.innerText = result.total)
    compare_btns.forEach(compare_btn => compare_btn.classList.add('disabled'))
}
    if(btn.classList.contains('add')){
    btn.innerHTML = '<i class="fa-solid fa-minus"></i><span class="d-none d-md-inline-flex">Убрать из сравнения</span>';

} else {
    btn.innerHTML = '<i class="fa-solid fa-plus"></i><span class="d-none d-md-inline-flex">Добавить в сравнение</span>';
}
    btn.classList.toggle('btn-warning');
    btn.classList.toggle('btn-secondary');
    return result.ok;
}
