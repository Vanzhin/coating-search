let productCount = 0;
const buttons = document.querySelectorAll("button.btn-click");
const badge = document.getElementById('compare');
buttons.forEach(button => button.addEventListener("click", function() {
    if (button.getAttribute('compare')){
        button.innerHTML = 'Сравнить';
        button.removeAttribute('compare')
        badge.innerHTML = --productCount;


    } else {
        button.innerHTML = 'В списке';
        button.setAttribute('compare', 'true');
        badge.innerHTML = ++productCount;

    }
    if (productCount <= 0){
        badge.innerHTML = '';
    }
    console.log(productCount);
}));
