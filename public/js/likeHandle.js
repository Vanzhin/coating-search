function likeHandle(like) {
    const id = like.getAttribute('like');
    like.style.pointerEvents='none';
    like.firstElementChild.remove();
    like.innerHTML = '<i class="fa-regular fa-clock"></i>';
    productLikeSend('/like/' + id).then((result) => {
        like.firstElementChild.remove();
        LikedProductUpdate(result.total, 'my-products', 'my-products-btn');
        if(result.state === 'dislike'){
            like.innerHTML = '<i class="fa-solid fa-star"></i>';

        } else{
            like.innerHTML = '<i class="fa-regular fa-star"></i>';
        }
        like.style.pointerEvents='auto';
    })

}
async function productLikeSend(url)
{

    let response = await fetch(url, {
        method: 'GET',
    });
    return await response.json();
}
function LikedProductUpdate(total, badgesClassName, buttonsClassName)
{
    const badges = document.querySelectorAll('.' + badgesClassName);
    const compare_btns = document.querySelectorAll('.' + buttonsClassName);
    if(total === 0) {
        badges.forEach(badge => badge.innerText = '');
        compare_btns.forEach(compare_btn => compare_btn.classList.add('disabled'));
    } else {
        badges.forEach(badge => badge.innerText = total);
        compare_btns.forEach(compare_btn => compare_btn.classList.remove('disabled'))
    }
}
