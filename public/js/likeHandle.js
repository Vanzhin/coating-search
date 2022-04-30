function likeHandle(like) {
    const id = like.getAttribute('like');
    like.style.pointerEvents='none';
    like.firstElementChild.remove();
    like.innerHTML = '<i class="fa-regular fa-clock"></i>';
    productLikeSend('/like/' + id).then((result) => {
        like.firstElementChild.remove();
        if(result === 'dislike'){
            like.innerHTML = '<i class="fa-solid fa-star"></i>';

        } else{
            like.innerHTML = '<i class="fa-regular fa-star"></i>';
        }
        like.style.pointerEvents='auto';
    })

}
async function productLikeSend(url){

    let response = await fetch(url, {
        method: 'GET',
    });
    return await response.json();
}
