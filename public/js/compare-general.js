    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll(".compare");
        buttons.forEach(button => button.addEventListener("click", function() {

            button.classList.toggle("disabled");
            button.innerHTML = '<i class="fa-regular fa-clock"></i>';

            const id = this.getAttribute('id');
            sendProductToCompare('/products/compare/' + id).then(() => {
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

    comparedProductUpdate(result.total, 'product-to-compare', 'compare-btn')
    toggleCompareIcon(prod_id)

    return result.ok;
}

function comparedProductUpdate(total, badgesClassName, buttonsClassName)
{
        const badges = document.querySelectorAll('.' + badgesClassName);
        const compare_btns = document.querySelectorAll('.' + buttonsClassName);
        if(total === 0){
            badges.forEach(badge => badge.innerText = '');
            compare_btns.forEach(compare_btn => compare_btn.classList.add('disabled'));

        } else if(total > 1) {
            badges.forEach(badge => badge.innerText = total);
            compare_btns.forEach(compare_btn => compare_btn.classList.remove('disabled'))
        } else{
            badges.forEach(badge => badge.innerText = total);
            compare_btns.forEach(compare_btn => compare_btn.classList.add('disabled'))
        }
}

function toggleCompareIcon(elemId)
{
        const btn = document.getElementById(elemId);
        btn.classList.toggle("add");
        if(btn.classList.contains('add')){
            btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bar-chart-fill" viewBox="0 0 16 16">\n' +
                '   <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>\n' +
                '   </svg>';

        } else {
            btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">\n' +
                '   <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>\n' +
                '   </svg>';
        }
}
